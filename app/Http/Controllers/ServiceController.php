<?php

namespace App\Http\Controllers;

use App\Models\ServiceUser;
use App\Models\User;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Carbon\Carbon;

class ServiceController extends Controller
{
    //
    public function showServiceForm(){
        return view('service-form');
    }

    public function showServiceView(){

    $serviceusers = DB::table('serviceuser')->orderBy('created_at', 'desc')->get();
    $unsuccesstask = ServiceUser::where('status', '0')->count();
    $successtask = ServiceUser::where('status', '1')->count();
        // dd($serviceusers);
        return view('services-view',compact('serviceusers', 'unsuccesstask', 'successtask'));
    }

    public function showServiceEdit($id){
        $user = ServiceUser::findOrFail($id);
        return view('service-edit',compact('user'));
    }

    public function servicestore(Request $request){
        // Validate the request data
        $request->validate([
            'name' => 'required|string|regex:/^[\p{Thai}\p{L}\p{N}\s]+$/u',
            'itemrepair' => 'required',
            'detailrepair' => 'required',
            'location' => 'required',
            'date' => 'required|date|after_or_equal:today',
            // Add more validation rules as needed
        ],
        [
            'name.required' => 'กรุณาใส่ชื่อผู้แจ้งซ่อม',
            'itemrepair.required' => 'กรุณาใส่ชื่อสิ่งที่ต้องการซ่อม',
            'detailrepair.required' => 'กรุณาใส่รายละเอียดการพัง',
            'location.required' => 'กรุณาแจ้งสถานที่',
            'date.required' => 'กรุณาแจ้งวันส่งงาน',
            'date.after_or_equal' => 'โปรดตรวจเช็ควันที่ในฟอร์ม',
            'name.regex' => 'โปรดตรวจสอบชื่อของคุณว่ามีอักษรพิเศษหรือไม่'
        ]
    );

        // Store the service data in the database
        ServiceUser::create([
            'name' => $request->name,
            'itemrepair' => $request->itemrepair,
            'detailrepair' => $request->detailrepair,
            'location' => $request->location,
            'date' => $request->date,
            'status' => 0
        ]);
        // You can use a model to save the data to the database

        Notification::create([
            'message' => "{$request->name} ได้ทำการแจ้งซ่อม {$request->itemrepair}",
        ]);

        return redirect()->route('service-form')->with('success', 'Sent form successfully.');
    }

    public function serviceupdate(Request $request, $id){
        // Validate the request data
        $request->validate([
            'name' => 'required|string|regex:/^[a-zA-Z0-9]+$/',
            'itemrepair' => 'required',
            'detailrepair' => 'required',
            'location' => 'required',
            'date' => 'required|date|after_or_equal:today',
            // Add more validation rules as needed
        ],
        [
            'name.required' => 'กรุณาใส่ชื่อผู้แจ้งซ่อม',
            'itemrepair.required' => 'กรุณาใส่ชื่อสิ่งที่ต้องการซ่อม',
            'detailrepair.required' => 'กรุณาใส่รายละเอียดการพัง',
            'location.required' => 'กรุณาแจ้งสถานที่',
            'date.required' => 'กรุณาแจ้งวันส่งงาน',
            'date.after_or_equal' => 'โปรดตรวจเช็ควันที่ในฟอร์ม',
            'name.regex' => 'โปรดตรวจสอบชื่อของคุณว่ามีอักษรพิเศษหรือไม่'
        ]
        );


        $user = ServiceUser::findorFail($id);
        // Check if the user exists
        if (!$user) {
            return redirect()->route('service-view')->with('error', 'Service not found.');
        }
        // Update the user data
        $data = [
            'name' => $request->name,
            'itemrepair' => $request->itemrepair,
            'detailrepair' => $request->detailrepair,
            'location' => $request->location,
            'date' => $request->date,
        ];
        // Update the user in the database

        $user->update($data);


        return redirect()->route('service-view')->with('success', 'Service updated successfully.');
    }

    public function servicedestroy($id){

        $serviceuser = ServiceUser::find($id);

        if ($serviceuser) {

            $serviceuser->delete();

            return redirect()->route('service-view')->with('success', 'Service delete successfully.');
        }
    return redirect()->route('service-view')->with('error', 'Cant find data to delete.');
    }

    public function toggle(Request $request, $id){
        $serviceUser = ServiceUser::findOrFail($id);
        $serviceUser->status = (int) $request->input('status');
        $saved = $serviceUser->save();
        
        \Log::info('Toggle request มาแล้วจ้า', [
        'id' => $id,
        'status' => $request->input('status')
    ]);

        return response()->json([
            'success' => true,
            'new_status' => $serviceUser->status
        ]);
    }

    public function exportExcel(Request $request){
    
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $startDate = $request->start_date . ' 00:00:00'; 
        $endDate = $request->end_date . ' 23:59:59';

        // ดึงข้อมูลตาม created_at
        $data = ServiceUser::whereBetween('created_at', [$startDate, $endDate])->get();

        // คำนวณสถิติ
        $totalRequests = $data->count();
        $completedRequests = $data->where('status', 1)->count();
        $pendingRequests = $data->where('status', 0)->count();

        // สถิติตามเดือน
        $monthlyStats = $data->groupBy(function($item) {
            return $item->created_at->format('Y-m');
        })->map(function($group) {
            return $group->count();
        });

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // ตั้งชื่อ Sheet
        $sheet->setTitle('Service Report');

        // === ส่วนหัวหลัก ===
        $sheet->mergeCells('A1:G1');
        $sheet->setCellValue('A1', 'รายงานคำขอแจ้งซ่อม');
        $sheet->getStyle('A1')->getFont()->setSize(18)->setBold(true);
        $sheet->getStyle('A1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('A1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()->setARGB('FF4472C4'); // สีน้ำเงิน
        $sheet->getStyle('A1')->getFont()->getColor()->setARGB('FFFFFFFF'); // ตัวอักษรสีขาว

        // === ข้อมูลช่วงวันที่ ===
        $sheet->mergeCells('A2:G2');
        $sheet->setCellValue('A2', "ช่วงวันที่: {$request->start_date} ถึง {$request->end_date}");
        $sheet->getStyle('A2')->getFont()->setSize(12)->setBold(true);
        $sheet->getStyle('A2')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('A2')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()->setARGB('FFE7E6E6'); // สีเทาอ่อน

        // === สถิติสรุป ===
        $currentRow = 4;
        $sheet->mergeCells("A{$currentRow}:G{$currentRow}");
        $sheet->setCellValue("A{$currentRow}", 'สถิติสรุป');
        $sheet->getStyle("A{$currentRow}")->getFont()->setSize(14)->setBold(true);
        $sheet->getStyle("A{$currentRow}")->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()->setARGB('FF70AD47'); // สีเขียว
        $sheet->getStyle("A{$currentRow}")->getFont()->getColor()->setARGB('FFFFFFFF');

        $currentRow++;

        // สถิติในแถวเดียว
        $sheet->setCellValue("A{$currentRow}", 'รวมทั้งหมด');
        $sheet->setCellValue("B{$currentRow}", $totalRequests . ' รายการ');
        $sheet->setCellValue("C{$currentRow}", 'เสร็จแล้ว');
        $sheet->setCellValue("D{$currentRow}", $completedRequests . ' รายการ');
        $sheet->setCellValue("E{$currentRow}", 'รอดำเนินการ');
        $sheet->setCellValue("F{$currentRow}", $pendingRequests . ' รายการ');

        // สีสถิติ
        $sheet->getStyle("A{$currentRow}:B{$currentRow}")->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()->setARGB('FFDCE6F1'); // สีฟ้าอ่อน
        $sheet->getStyle("C{$currentRow}:D{$currentRow}")->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()->setARGB('FFE2EFDA'); // สีเขียวอ่อน
        $sheet->getStyle("E{$currentRow}:F{$currentRow}")->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()->setARGB('FFFCE4D6'); // สีส้มอ่อน

        $currentRow += 2;

        // === สถิติรายเดือน ===
        if ($monthlyStats->count() > 0) {
            $sheet->mergeCells("A{$currentRow}:G{$currentRow}");
            $sheet->setCellValue("A{$currentRow}", 'สถิติรายเดือน');
            $sheet->getStyle("A{$currentRow}")->getFont()->setSize(14)->setBold(true);
            $sheet->getStyle("A{$currentRow}")->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                ->getStartColor()->setARGB('FFED7D31'); // สีส้ม
            $sheet->getStyle("A{$currentRow}")->getFont()->getColor()->setARGB('FFFFFFFF');

            $currentRow++;

            foreach ($monthlyStats as $month => $count) {
                $monthName = \Carbon\Carbon::createFromFormat('Y-m', $month)->locale('th')->translatedFormat('F Y');
                $sheet->setCellValue("A{$currentRow}", $monthName);
                $sheet->setCellValue("B{$currentRow}", $count . ' รายการ');

                // สีสลับ
                if ($currentRow % 2 == 0) {
                    $sheet->getStyle("A{$currentRow}:B{$currentRow}")->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                        ->getStartColor()->setARGB('FFF2F2F2');
                }
                $currentRow++;
            }
            $currentRow++;
        }

        // === ตารางข้อมูลหลัก ===
        $sheet->mergeCells("A{$currentRow}:G{$currentRow}");
        $sheet->setCellValue("A{$currentRow}", 'รายละเอียดคำขอทั้งหมด');
        $sheet->getStyle("A{$currentRow}")->getFont()->setSize(14)->setBold(true);
        $sheet->getStyle("A{$currentRow}")->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()->setARGB('FF5B9BD5'); // สีน้ำเงินเข้ม
        $sheet->getStyle("A{$currentRow}")->getFont()->getColor()->setARGB('FFFFFFFF');

        $currentRow++;

        // หัวตาราง
        $headers = ['ชื่อผู้แจ้งซ่อม', 'สิ่งที่ต้องซ่อม', 'รายละเอียด', 'สถานที่', 'วันกำหนดส่ง', 'วันที่แจ้ง', 'สถานะ'];
        $sheet->fromArray([$headers], null, "A{$currentRow}");

        // สไตล์หัวตาราง
        $headerRange = "A{$currentRow}:G{$currentRow}";
        $sheet->getStyle($headerRange)->getFont()->setBold(true)->setSize(11);
        $sheet->getStyle($headerRange)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()->setARGB('FF366092'); // สีน้ำเงินเข้ม
        $sheet->getStyle($headerRange)->getFont()->getColor()->setARGB('FFFFFFFF');
        $sheet->getStyle($headerRange)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        $currentRow++;

        // ข้อมูลในตาราง
        $dataStartRow = $currentRow;
        foreach ($data as $item) {
            $sheet->setCellValue("A{$currentRow}", $item->name);
            $sheet->setCellValue("B{$currentRow}", $item->itemrepair);
            $sheet->setCellValue("C{$currentRow}", $item->detailrepair);
            $sheet->setCellValue("D{$currentRow}", $item->location);
            $sheet->setCellValue("E{$currentRow}", $item->date);
            $sheet->setCellValue("F{$currentRow}", $item->created_at->format('Y-m-d H:i:s'));
            $sheet->setCellValue("G{$currentRow}", $item->status ? 'เสร็จแล้ว' : 'รอดำเนินการ');

            // สีสลับแถว
            if ($currentRow % 2 == 0) {
                $sheet->getStyle("A{$currentRow}:G{$currentRow}")->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()->setARGB('FFF8F9FA');
            }

            // สีสถานะ
            if ($item->status) {
                $sheet->getStyle("G{$currentRow}")->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()->setARGB('FFD5EDDA'); // เขียวอ่อน
                $sheet->getStyle("G{$currentRow}")->getFont()->getColor()->setARGB('FF0F5132');
            } else {
                $sheet->getStyle("G{$currentRow}")->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()->setARGB('FFF8D7DA'); // แดงอ่อน
                $sheet->getStyle("G{$currentRow}")->getFont()->getColor()->setARGB('FF721C24');
            }

            $currentRow++;
        }

        // === จัดรูปแบบทั้งหมด ===

        // กำหนดขนาดคอลัมน์อัตโนมัติ
        foreach (range('A', 'G') as $column) {
            $sheet->getColumnDimension($column)->setAutoSize(true);
        }

        // ขอบตาราง
        if ($data->count() > 0) {
            $tableRange = "A{$dataStartRow}:G" . ($currentRow-1);
            $sheet->getStyle($tableRange)->getBorders()->getAllBorders()
                ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN)
                ->setColor(new \PhpOffice\PhpSpreadsheet\Style\Color('FF000000'));
        }

        // ความสูงแถว
        $sheet->getDefaultRowDimension()->setRowHeight(20);
        $sheet->getRowDimension(1)->setRowHeight(30); // หัวหลัก

        // จัดกึ่งกลางข้อมูลในตาราง
        if ($data->count() > 0) {
            $sheet->getStyle("A{$dataStartRow}:G" . ($currentRow-1))->getAlignment()
                ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER)
                ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
        }

        $writer = new Xlsx($spreadsheet);

        $filename = 'ServiceReport_' . $request->start_date . '_to_' . $request->end_date . '_' . date('Ymd_His') . '.xlsx';

        return response()->streamDownload(function() use ($writer) {
            $writer->save('php://output');
        }, $filename, [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        ]);
    }
}
