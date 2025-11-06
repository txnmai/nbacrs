<?php

namespace App\Http\Controllers;

use App\Models\ServiceUser;
use App\Models\User;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
{
    $user = Auth::user();
    

    $notifications1 = Notification::latest()->take(5)->get();
    $notifications2 = Notification::latest()->take(6)->get();
    $unreadCount = Notification::where('is_read', false)->count();
    
    $unsuccesstask = ServiceUser::where('status', '0')->count();
    $successtask = ServiceUser::where('status', '1')->count();

    $weekcount = ServiceUser::whereBetween('created_at', [
        Carbon::now()->startOfWeek(),  
        Carbon::now()->endOfWeek(),    
    ])->count();

    $monthcount = ServiceUser::whereBetween('created_at', [
        Carbon::now()->startOfMonth(),  
        Carbon::now()->endOfMonth(),    
    ])->count();

    $yearcount = ServiceUser::whereBetween('created_at', [
        Carbon::now()->startOfYear(),  
        Carbon::now()->endOfYear(),    
    ])->count();

    if (!$user) {
        $error_message = 'ヽ༼ ಥ_ಥ༽ﾉ Ahhhhhh...Not Authorized';
        return view('dashboard', compact('error_message', 'notifications', 'user', 'unreadCount', 'weekcount', 'monthcount', 'yearcount', 'unsuccesstask', 'successtask'));
    }
    return view('dashboard', compact('notifications1', 'notifications2', 'user', 'unreadCount', 'weekcount', 'monthcount', 'yearcount', 'unsuccesstask', 'successtask'));
}

    public function serviceView()
    {
        $user = Auth::user();  //เชื่อมต่อกับไฟล์ User.php ใน Models

        if (!$user) {
            // หากผู้ใช้ไม่ได้ล็อกอิน
            $error_message = 'ヽ༼ ಥ_ಥ༽ﾉ Ahhhhhh...Not Authorized';
            return view('dashboard', compact('error_message'));
        }
    }

    public function serviceEdit()
    {
        return view('service-edit');
    }

    public function markAsRead(Request $request)
    {
    $notification = Notification::find($request->id);
    
    if ($notification) {
        $notification->is_read = true;
        $notification->save();
        return redirect()->route('dashboard');
    }

    return redirect()->route('dashboard');
    }

    public function getEvents(){
    $repairs = \App\Models\ServiceUser::all();

    $events = [];

    foreach ($repairs as $repair) {
        $events[] = [
            'title' => $repair->name,
            'start' => $repair->date,
        ];
    }

    return response()->json($events);
    }

public function bookingData(){
     
    $startOfWeek = now()->startOfWeek();   
    $endOfWeek = now()->endOfWeek();      

    $weekly = ServiceUser::selectRaw('DAYOFWEEK(created_at) as day, count(*) as total')
        ->whereBetween('created_at', [$startOfWeek, $endOfWeek])   
        ->groupBy('day')
        ->orderBy('day')
        ->get();

    $monthly = ServiceUser::selectRaw('MONTH(created_at) as month, count(*) as total')
            ->groupBy('month')->orderBy('month')->get();

        return response()->json([
            'weekly' => $weekly,
            'monthly' => $monthly
        ]);
    }
}
