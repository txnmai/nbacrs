@extends('layout')

@section('title')
    Welcome
@endsection
@vite('resources/css/app.css')
{{-- AOS Animation --}}
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/particles.js/2.0.0/particles.min.js"></script>

<style>
        
        .orbitron {
            font-family: 'Orbitron', monospace;
        }
        
        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        
        .glow {
            box-shadow: 0 0 20px rgba(102, 126, 234, 0.6);
        }
        
        .pulse-ring {
            position: absolute;
            border: 2px solid rgba(102, 126, 234, 0.3);
            border-radius: 50%;
            animation: pulse-ring 2s cubic-bezier(0.215, 0.61, 0.355, 1) infinite;
        }
        
        @keyframes pulse-ring {
            0% {
                transform: scale(0.33);
                opacity: 1;
            }
            80%, 100% {
                transform: scale(2.4);
                opacity: 0;
            }
        }
        
        .loader-circle {
            width: 120px;
            height: 120px;
            border: 4px solid rgba(102, 126, 234, 0.2);
            border-top: 4px solid #667eea;
            border-radius: 50%;
            position: relative;
        }
        
        .loader-inner {
            width: 80px;
            height: 80px;
            border: 3px solid rgba(118, 75, 162, 0.3);
            border-top: 3px solid #764ba2;
            border-radius: 50%;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }
        
        #particles-js {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
        }
    </style>

@section('content')
     <!-- Enhanced Preloader -->
    <div id="preloader" class="fixed inset-0 z-50 gradient-bg flex items-center justify-center overflow-hidden">
        <!-- Particles Background -->
        <div id="particles-js"></div>
        
        <!-- Main Content -->
        <div class="relative z-10 flex flex-col items-center gap-8">
            <!-- Animated Logo/Icon -->
            <div class="relative">
                <!-- Pulse Rings -->
                <div class="pulse-ring w-32 h-32"></div>
                <div class="pulse-ring w-32 h-32" style="animation-delay: 0.5s;"></div>
                <div class="pulse-ring w-32 h-32" style="animation-delay: 1s;"></div>
                
                <!-- Main Loader -->
                <div id="main-loader" class="loader-circle glow">
                    <div class="loader-inner"></div>
                    <!-- Center Icon -->
                    <div class="absolute inset-0 flex items-center justify-center">
                        <svg id="center-icon" class="w-12 h-12 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                </div>
            </div>
            
            <!-- Loading Text -->
            <div class="text-center">
                <h2 id="loading-title" class="text-4xl font-bold text-white orbitron mb-2 opacity-0">LOADING</h2>
                <div id="progress-bar" class="w-64 h-1 bg-white bg-opacity-20 rounded-full overflow-hidden">
                    <div id="progress-fill" class="h-full bg-white rounded-full transform -translate-x-full"></div>
                </div>
                <p id="loading-text" class="text-lg text-white text-opacity-80 mt-4 orbitron opacity-0">Initializing...</p>
            </div>
            
            <!-- Floating Elements -->
            <div id="floating-elements" class="absolute inset-0 pointer-events-none">
                <div class="floating-dot absolute w-2 h-2 bg-white rounded-full opacity-60" style="top: 20%; left: 10%;"></div>
                <div class="floating-dot absolute w-3 h-3 bg-white rounded-full opacity-40" style="top: 60%; right: 15%;"></div>
                <div class="floating-dot absolute w-1 h-1 bg-white rounded-full opacity-80" style="bottom: 30%; left: 20%;"></div>
                <div class="floating-dot absolute w-2 h-2 bg-white rounded-full opacity-50" style="top: 40%; right: 25%;"></div>
            </div>
        </div>
    </div>
    <!-- Hero Section -->
    <div class="hero min-h-screen bg-gradient-to-br from-slate-900 via-blue-900 to-slate-800 relative overflow-hidden overflow-x-hidden">
        <!-- Background Pattern with Better Overlay -->
        <div class="absolute inset-0 bg-[url(/public/picture/background/background.jpg)] bg-cover bg-center bg-no-repeat opacity-30"></div>
        <div class="absolute inset-0 bg-gradient-to-b from-slate-900/40 via-transparent to-slate-900/60"></div>
        <div class="absolute inset-0 bg-gradient-to-r from-blue-900/20 to-transparent"></div>
        
        <!-- Enhanced Floating Elements -->
        <div class="absolute top-20 left-10 w-32 h-32 bg-blue-400/10 rounded-full blur-3xl animate-pulse"></div>
        <div class="absolute top-40 right-20 w-24 h-24 bg-cyan-400/15 rounded-full blur-2xl animate-pulse delay-700"></div>
        <div class="absolute bottom-32 right-16 w-40 h-40 bg-slate-400/10 rounded-full blur-3xl animate-bounce slow"></div>
        <div class="absolute bottom-20 left-20 w-16 h-16 bg-white/5 rounded-full blur-xl animate-ping"></div>
        
        <!-- Grid Pattern Overlay -->
        <div class="absolute inset-0 opacity-5" style="background-image: radial-gradient(circle at 1px 1px, rgba(255,255,255,0.3) 1px, transparent 0); background-size: 40px 40px;"></div>
        
        <div class="hero-content text-center text-white relative z-10">
            <div class="max-w-5xl">
                <!-- Main Title with Better Gradient -->
                <h1 class="text-6xl md:text-8xl lg:text-9xl font-black mb-6 leading-none" 
                    data-aos="fade-up" data-aos-duration="1200">
                    <span class="bg-gradient-to-r from-blue-300 via-cyan-200 to-slate-200 bg-clip-text text-transparent drop-shadow-lg">
                        NBAC
                    </span>
                    <br>
                    <span class="bg-gradient-to-r from-cyan-300 via-blue-200 to-white bg-clip-text text-transparent drop-shadow-lg">
                        REPAIR
                    </span>
                </h1>
                
                <!-- Subtitle -->
                <h2 class="text-2xl md:text-4xl lg:text-5xl font-bold mb-8 text-blue-100/90 tracking-wide" 
                    data-aos="fade-up" data-aos-delay="300" data-aos-duration="1000">
                    SYSTEM
                </h2>
                
                <!-- Description -->
                <div class="max-w-3xl mx-auto mb-12" data-aos="fade-up" data-aos-delay="600" data-aos-duration="1000">
                    <p class="text-xl md:text-2xl lg:text-3xl text-slate-200/80 font-light leading-relaxed">
                        ระบบแจ้งซ่อมเครื่องคอมพิวเตอร์
                    </p>
                    <p class="text-base md:text-lg text-slate-300/70 mt-4 leading-relaxed">
                        บริหารจัดการงานซ่อมแซมอุปกรณ์อิเล็กทรอนิกส์อย่างมีประสิทธิภาพ
                    </p>
                </div>
                
                <!-- CTA Button -->
                <div class="flex flex-col sm:flex-row gap-4 justify-center items-center" 
                     data-aos="zoom-in" data-aos-delay="900" data-aos-duration="1000">
                    <a href="/service-form" 
                       class="group btn btn-primary btn-lg bg-gradient-to-r from-blue-600 to-cyan-600 hover:from-blue-700 hover:to-cyan-700 border-none text-white px-10 py-4 text-lg font-semibold shadow-2xl hover:shadow-blue-500/25 transform hover:scale-105 transition-all duration-500 rounded-full">
                        <svg class="w-6 h-6 mr-3 group-hover:rotate-12 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                        กรอกฟอร์มแจ้งซ่อมกดเลย!
                        <div class="absolute inset-0 bg-gradient-to-r from-blue-400/20 to-cyan-400/20 rounded-full scale-0 group-hover:scale-100 transition-transform duration-500 -z-10"></div>
                    </a>
                </div>
            </div>
        </div>
        
        <!-- Scroll Indicator -->
        <div class="absolute bottom-10 left-1/2 transform -translate-x-1/2 animate-bounce" data-aos="fade-up" data-aos-delay="1200">
            <svg class="w-6 h-6 text-white/70" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
            </svg>
        </div>
    </div>

    <!-- Main Content Section -->
    <div class="bg-gradient-to-b from-slate-50 via-white to-slate-100 relative">
        <!-- Top Wave Decoration -->
        <div class="absolute top-0 left-0 w-full h-20 bg-gradient-to-b from-slate-800 to-transparent opacity-20"></div>
        
        <div class="container mx-auto px-6 py-24 relative">
            <!-- Enhanced Title Section -->
            <div class="text-center mb-20">
                <div class="inline-block" data-aos="fade-down" data-aos-duration="1000">
                    <h2 class="text-5xl md:text-7xl lg:text-8xl font-black text-slate-800 mb-6 relative">
                        <span class="bg-gradient-to-r from-blue-700 via-cyan-600 to-slate-700 bg-clip-text text-transparent relative z-10">
                            NBAC REPAIR
                        </span>
                        <span class="text-slate-300 ml-4">SYSTEM</span>
                        <!-- Decorative Elements -->
                        <div class="absolute -top-4 -right-4 w-8 h-8 bg-blue-500/20 rounded-full blur-sm"></div>
                        <div class="absolute -bottom-2 -left-2 w-6 h-6 bg-cyan-400/30 rounded-full blur-sm"></div>
                    </h2>
                </div>
                <div class="flex items-center justify-center gap-4 mb-8" data-aos="fade-up" data-aos-delay="300">
                    <div class="h-px bg-gradient-to-r from-transparent via-blue-400 to-transparent w-24"></div>
                    <div class="w-3 h-3 bg-gradient-to-r from-blue-500 to-cyan-400 rounded-full"></div>
                    <div class="h-px bg-gradient-to-r from-transparent via-cyan-400 to-transparent w-24"></div>
                </div>
            </div>

            <!-- Enhanced Cards Grid -->
            <div class="space-y-16">
                
                <!-- What is NBAC Section -->
                <div class="group" data-aos="fade-right" data-aos-duration="1000">
                    <div class="relative">
                        <div class="absolute inset-0 bg-gradient-to-r from-blue-500 to-cyan-500 rounded-3xl blur-lg opacity-10 group-hover:opacity-20 transition-opacity duration-500"></div>
                        <div class="relative bg-white/80 backdrop-blur-sm rounded-3xl shadow-xl hover:shadow-2xl transition-all duration-500 border border-white/50 group-hover:transform group-hover:scale-[1.02] overflow-hidden">
                            <div class="absolute top-0 left-0 w-2 h-full bg-gradient-to-b from-blue-500 to-cyan-500"></div>
                            <div class="p-10 lg:p-12">
                                <div class="flex items-start gap-6 mb-8">
                                    <div class="flex-shrink-0">
                                        <div class="w-16 h-16 bg-gradient-to-r from-blue-500 to-cyan-500 rounded-2xl flex items-center justify-center shadow-lg">
                                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="flex-1">
                                        <h3 class="text-3xl md:text-4xl font-black text-slate-800 mb-2 leading-tight">
                                            Nbac repair system คืออะไร ?
                                        </h3>
                                        <div class="w-20 h-1 bg-gradient-to-r from-blue-500 to-cyan-500 rounded-full"></div>
                                    </div>
                                </div>
                                <div class="prose prose-xl max-w-none">
                                    <p class="text-lg md:text-xl text-slate-700 leading-relaxed font-light">
                                        <span class="font-semibold text-slate-800">NBAC Repair System</span> คือระบบที่ถูกพัฒนาขึ้นมาเพื่อใช้ในการแจ้งซ่อมเครื่องคอมพิวเตอร์เมื่อเกิดความเสียหาย หรือเมื่อต้องการตรวจสอบสภาพเครื่องคอมพิวเตอร์แต่ละเครื่องอย่างเป็นระบบ โดยเน้น<span class="text-blue-600 font-medium">ความสะดวก รวดเร็ว และมีประสิทธิภาพ</span>ในการจัดการปัญหาด้านอุปกรณ์คอมพิวเตอร์ภายในองค์กร
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- How it Started Section -->
                <div class="group" data-aos="fade-left" data-aos-duration="1000">
                    <div class="relative">
                        <div class="absolute inset-0 bg-gradient-to-r from-cyan-500 to-blue-500 rounded-3xl blur-lg opacity-10 group-hover:opacity-20 transition-opacity duration-500"></div>
                        <div class="relative bg-white/80 backdrop-blur-sm rounded-3xl shadow-xl hover:shadow-2xl transition-all duration-500 border border-white/50 group-hover:transform group-hover:scale-[1.02] overflow-hidden">
                            <div class="absolute top-0 left-0 w-2 h-full bg-gradient-to-b from-cyan-500 to-blue-500"></div>
                            <div class="p-10 lg:p-12">
                                <div class="flex items-start gap-6 mb-8">
                                    <div class="flex-shrink-0">
                                        <div class="w-16 h-16 bg-gradient-to-r from-cyan-500 to-blue-500 rounded-2xl flex items-center justify-center shadow-lg">
                                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="flex-1">
                                        <h3 class="text-3xl md:text-4xl font-black text-slate-800 mb-2 leading-tight">
                                            Nbac repair system เกิดขึ้นได้อย่างไร ?
                                        </h3>
                                        <div class="w-20 h-1 bg-gradient-to-r from-cyan-500 to-blue-500 rounded-full"></div>
                                    </div>
                                </div>
                                
                                <div class="space-y-8">
                                    <div class="prose prose-xl max-w-none">
                                        <p class="text-lg md:text-xl text-slate-700 leading-relaxed font-light mb-8">
                                            ก่อนที่จะมีการพัฒนาระบบ <span class="font-semibold text-slate-800">NBAC Repair System</span> ขึ้นมา องค์กรต้องเผชิญกับปัญหาหลายประการที่เกี่ยวข้องกับการซ่อมแซมและดูแลเครื่องคอมพิวเตอร์ ซึ่งส่งผลกระทบต่อประสิทธิภาพการทำงานโดยรวม และการบริหารจัดการอุปกรณ์ IT ภายในหน่วยงาน
                                        </p>
                                    </div>
                                    
                                    <!-- Problems Section with Modern Cards -->
                                    <div class="bg-gradient-to-br from-red-50 via-orange-50 to-yellow-50 rounded-2xl p-8 border border-red-100">
                                        <div class="flex items-center gap-3 mb-6">
                                            <div class="w-8 h-8 bg-red-500 rounded-lg flex items-center justify-center">
                                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.732-.833-2.5 0L4.232 15.5c-.77.833.192 2.5 1.732 2.5z"></path>
                                                </svg>
                                            </div>
                                            <h4 class="text-2xl font-bold text-red-700">ปัญหาที่พบก่อนมีระบบ</h4>
                                        </div>
                                        
                                        <div class="grid gap-6 md:gap-8">
                                            <!-- Problem 1 -->
                                            <div class="flex flex-col items-center md:flex-row gap-4 p-6 bg-white/70 rounded-xl border border-white/50">
                                                <div class="flex-shrink-0">
                                                    <div class="w-12 h-12 bg-gradient-to-r from-red-500 to-orange-500 rounded-full flex items-center justify-center text-white text-xl font-bold">
                                                        📝
                                                    </div>
                                                </div>
                                                <div>
                                                    <h5 class="font-bold text-slate-800 text-xl mb-3">1. ไม่มีข้อมูลย้อนหลังที่ชัดเจน</h5>
                                                    <p class="text-slate-600 leading-relaxed">เมื่อเกิดปัญหากับเครื่องคอมพิวเตอร์ มักไม่มีระบบที่จัดเก็บประวัติการซ่อมแซม ทำให้ไม่สามารถวิเคราะห์หรือคาดการณ์ปัญหาซ้ำ ๆ ได้ เช่น เครื่องเดิมเสียซ้ำบ่อยครั้ง แต่ไม่มีข้อมูลมาชี้ชัดว่านี่คือปัญหาเดิมที่ยังไม่ถูกแก้ไขถาวร</p>
                                                </div>
                                            </div>
                                            
                                            <!-- Problem 2 -->
                                            <div class="flex flex-col items-center md:flex-row gap-4 p-6 bg-white/70 rounded-xl border border-white/50">
                                                <div class="flex-shrink-0">
                                                    <div class="w-12 h-12 bg-gradient-to-r from-orange-500 to-yellow-500 rounded-full flex items-center justify-center text-white text-xl font-bold">
                                                        📞
                                                    </div>
                                                </div>
                                                <div>
                                                    <h5 class="font-bold text-slate-800 text-xl mb-3">2. การประสานงานที่ยุ่งยาก</h5>
                                                    <p class="text-slate-600 leading-relaxed">การแจ้งซ่อมส่วนใหญ่อาศัยการติดต่อผ่านวาจา โทรศัพท์ หรือแชท ซึ่งอาจทำให้ข้อมูลตกหล่น ไม่ครบถ้วน และเกิดความเข้าใจผิดระหว่างผู้แจ้งกับทีมซ่อม</p>
                                                </div>
                                            </div>
                                            
                                            <!-- Problem 3 -->
                                            <div class="flex flex-col items-center md:flex-row gap-4 p-6 bg-white/70 rounded-xl border border-white/50">
                                                <div class="flex-shrink-0">
                                                    <div class="w-12 h-12 bg-gradient-to-r from-yellow-500 to-red-500 rounded-full flex items-center justify-center text-white text-xl font-bold">
                                                        📋
                                                    </div>
                                                </div>
                                                <div>
                                                    <h5 class="font-bold text-slate-800 text-xl mb-3">3. ไม่มีระบบติดตามสถานะงานซ่อม</h5>
                                                    <p class="text-slate-600 leading-relaxed">ผู้แจ้งไม่สามารถรู้ได้ว่างานซ่อมของตนอยู่ในขั้นตอนไหน ทำให้เกิดความกังวล หรือเสียเวลาในการสอบถามซ้ำ ๆ</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Benefits Section -->
                <div class="group" data-aos="fade-right" data-aos-duration="1000">
                    <div class="relative">
                        <div class="absolute inset-0 bg-gradient-to-r from-green-500 to-blue-500 rounded-3xl blur-lg opacity-10 group-hover:opacity-20 transition-opacity duration-500"></div>
                        <div class="relative bg-white/80 backdrop-blur-sm rounded-3xl shadow-xl hover:shadow-2xl transition-all duration-500 border border-white/50 group-hover:transform group-hover:scale-[1.02] overflow-hidden">
                            <div class="absolute top-0 left-0 w-2 h-full bg-gradient-to-b from-green-500 to-blue-500"></div>
                            <div class="p-10 lg:p-12">
                                <div class="flex items-start gap-6 mb-8">
                                    <div class="flex-shrink-0">
                                        <div class="w-16 h-16 bg-gradient-to-r from-green-500 to-blue-500 rounded-2xl flex items-center justify-center shadow-lg">
                                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="flex-1">
                                        <h3 class="text-3xl md:text-4xl font-black text-slate-800 mb-2 leading-tight">
                                            Nbac repair system มีประโยชน์อย่างไร ?
                                        </h3>
                                        <div class="w-20 h-1 bg-gradient-to-r from-green-500 to-blue-500 rounded-full"></div>
                                    </div>
                                </div>
                                
                                <div class="space-y-8">
                                    <div class="prose prose-xl max-w-none">
                                        <p class="text-lg md:text-xl text-slate-700 leading-relaxed font-light mb-8">
                                            ระบบ <span class="font-semibold text-slate-800">NBAC Repair System</span> ไม่ได้เป็นเพียงแค่ระบบแจ้งซ่อมทั่วไป แต่ยังเป็นเครื่องมือสำคัญที่ช่วยยกระดับการจัดการงานซ่อมแซมอุปกรณ์คอมพิวเตอร์ภายในองค์กรให้มีประสิทธิภาพมากยิ่งขึ้น โดยมีประโยชน์หลัก ๆ ดังนี้:
                                        </p>
                                    </div>
                                    
                                    <!-- Benefits Grid -->
                                    <div class="grid gap-6">
                                        <!-- Benefit 1 -->
                                        <div class="flex flex-col items-center md:flex-row gap-5 p-6 bg-gradient-to-r from-green-50 to-blue-50 rounded-2xl border border-green-100/50 group-hover:shadow-md transition-all duration-300">
                                            <div class="flex-shrink-0">
                                                <div class="w-14 h-14 bg-gradient-to-r from-green-500 to-emerald-500 rounded-2xl flex items-center justify-center shadow-lg">
                                                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                    </svg>
                                                </div>
                                            </div>
                                            <div>
                                                <h5 class="font-bold text-slate-800 text-xl mb-3">1. ลดการประสานงานซ้ำซ้อนภายในองค์กร</h5>
                                                <p class="text-slate-600 leading-relaxed">จากเดิมที่ต้องติดต่อผ่านหลายช่องทาง เช่น โทรศัพท์ ไลน์ หรือเอกสาร เมื่อมีปัญหาเรื่องเครื่องคอมพิวเตอร์ ตอนนี้สามารถแจ้งผ่านระบบเดียว ทำให้ทีมไอทีรับเรื่องได้ทันที และดำเนินการได้อย่างรวดเร็ว</p>
                                            </div>
                                        </div>
                                        
                                        <!-- Benefit 2 -->
                                        <div class="flex flex-col items-center md:flex-row gap-5 p-6 bg-gradient-to-r from-blue-50 to-cyan-50 rounded-2xl border border-blue-100/50 group-hover:shadow-md transition-all duration-300">
                                            <div class="flex-shrink-0">
                                                <div class="w-14 h-14 bg-gradient-to-r from-blue-500 to-cyan-500 rounded-2xl flex items-center justify-center shadow-lg">
                                                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                                    </svg>
                                                </div>
                                            </div>
                                            <div>
                                                <h5 class="font-bold text-slate-800 text-xl mb-3">2. ติดตามสถานะงานซ่อมได้ตลอดเวลา</h5>
                                                <p class="text-slate-600 leading-relaxed">ผู้แจ้งสามารถตรวจสอบสถานะของการซ่อมแบบเรียลไทม์ได้ เช่น กำลังดำเนินการ ซ่อมเสร็จแล้ว หรือรออะไหล่ ช่วยให้ไม่ต้องสอบถามซ้ำ และลดภาระฝ่ายดูแลระบบ</p>
                                            </div>
                                        </div>
                                        
                                        <!-- Benefit 3 -->
                                        <div class="flex flex-col items-center md:flex-row gap-5 p-6 bg-gradient-to-r from-cyan-50 to-slate-50 rounded-2xl border border-cyan-100/50 group-hover:shadow-md transition-all duration-300">
                                            <div class="flex-shrink-0">
                                                <div class="w-14 h-14 bg-gradient-to-r from-cyan-500 to-slate-500 rounded-2xl flex items-center justify-center shadow-lg">
                                                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                                    </svg>
                                                </div>
                                            </div>
                                            <div>
                                                <h5 class="font-bold text-slate-800 text-xl mb-3">3. บริหารจัดการข้อมูลเครื่องคอมพิวเตอร์ได้ง่ายขึ้น</h5>
                                                <p class="text-slate-600 leading-relaxed">ระบบสามารถเก็บข้อมูลของเครื่องแต่ละเครื่อง เช่น รุ่น, วันที่เริ่มใช้งาน, ประวัติการซ่อม ฯลฯ ทำให้สามารถวางแผนการบำรุงรักษาหรือเปลี่ยนเครื่องได้อย่างเหมาะสม</p>
                                            </div>
                                        </div>
                                        
                                        <!-- Benefit 4 -->
                                        <div class="flex flex-col items-center md:flex-row gap-5 p-6 bg-gradient-to-r from-purple-50 to-blue-50 rounded-2xl border border-purple-100/50 group-hover:shadow-md transition-all duration-300">
                                            <div class="flex-shrink-0">
                                                <div class="w-14 h-14 bg-gradient-to-r from-purple-500 to-blue-500 rounded-2xl flex items-center justify-center shadow-lg">
                                                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                                    </svg>
                                                </div>
                                            </div>
                                            <div>
                                                <h5 class="font-bold text-slate-800 text-xl mb-3">4. มีข้อมูลย้อนหลังสำหรับการวิเคราะห์</h5>
                                                <p class="text-slate-600 leading-relaxed">ระบบจะบันทึกประวัติการแจ้งซ่อมทั้งหมด ทำให้สามารถวิเคราะห์ปัญหาที่พบบ่อย หรือเครื่องใดที่มีปัญหาซ้ำ ๆ เพื่อนำไปสู่การแก้ไขเชิงป้องกันได้</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Bottom Decorative Elements -->
        <div class="absolute bottom-0 left-0 w-full overflow-hidden">
            <svg class="w-full h-20 text-slate-200" fill="currentColor" viewBox="0 0 1200 120" preserveAspectRatio="none">
                <path d="M0,0V46.29c47.79,22.2,103.59,32.17,158,28,70.36-5.37,136.33-33.31,206.8-37.5C438.64,32.43,512.34,53.67,583,72.05c69.27,18,138.3,24.88,209.4,13.08,36.15-6,69.85-17.84,104.45-29.34C989.49,25,1113-14.29,1200,52.47V0Z" opacity=".25"></path>
                <path d="M0,0V15.81C13,36.92,27.64,56.86,47.69,72.05,99.41,111.27,165,111,224.58,91.58c31.15-10.15,60.09-26.07,89.67-39.8,40.92-19,84.73-46,130.83-49.67,36.26-2.85,70.9,9.42,98.6,31.56,31.77,25.39,62.32,62,103.63,73,40.44,10.79,81.35-6.69,119.13-24.28s75.16-39,116.92-43.05c59.73-5.85,113.28,22.88,168.9,38.84,30.2,8.66,59,6.17,87.09-7.5,22.43-10.89,48-26.93,60.65-49.24V0Z" opacity=".5"></path>
                <path d="M0,0V5.63C149.93,59,314.09,71.32,475.83,42.57c43-7.64,84.23-20.12,127.61-26.46,59-8.63,112.48,12.24,165.56,35.4C827.93,77.22,886,95.24,951.2,90c86.53-7,172.46-45.71,248.8-84.81V0Z"></path>
            </svg>
        </div>
    </div>

    <!-- Enhanced Footer Wave -->
    <div class="relative">
        <div class="absolute inset-0 bg-gradient-to-r from-blue-600 via-cyan-500 to-blue-600"></div>
        <div class="relative h-4 bg-gradient-to-r from-blue-600 via-cyan-400 to-blue-600 animate-pulse"></div>
    </div>

    <!-- Custom CSS for animations -->
    <style>
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }
        
        @keyframes glow {
            0%, 100% { box-shadow: 0 0 20px rgba(59, 130, 246, 0.3); }
            50% { box-shadow: 0 0 40px rgba(59, 130, 246, 0.6); }
        }
        
        .animate-float {
            animation: float 6s ease-in-out infinite;
        }
        
        .animate-glow {
            animation: glow 3s ease-in-out infinite;
        }
        
        .slow {
            animation-duration: 3s;
        }
        
        /* Glass morphism effect */
        .glass {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        /* Smooth scroll behavior */
        html {
            scroll-behavior: smooth;
        }
        
        /* Custom gradient text animation */
        @keyframes gradient-shift {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        
        .animate-gradient {
            background: linear-gradient(-45deg, #3b82f6, #06b6d4, #0ea5e9, #3b82f6);
            background-size: 400% 400%;
            animation: gradient-shift 8s ease infinite;
        }
    </style>

    <!-- Import AOS JS -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 1000,
            once: true,
            offset: 100,
            easing: 'ease-out-cubic'
        });
        
        // Add some interactive hover effects
        document.addEventListener('DOMContentLoaded', function() {
            // Smooth hover effects for cards
            const cards = document.querySelectorAll('.group');
            cards.forEach(card => {
                card.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-5px)';
                });
                card.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0)';
                });
            });
        });
        // Initialize Particles.js
         particlesJS('particles-js', {
            particles: {
                number: {
                    value: 80,
                    density: {
                        enable: true,
                        value_area: 800
                    }
                },
                color: {
                    value: "#ffffff"
                },
                shape: {
                    type: "circle",
                    stroke: {
                        width: 0,
                        color: "#000000"
                    }
                },
                opacity: {
                    value: 0.5,
                    random: false,
                    anim: {
                        enable: false,
                        speed: 1,
                        opacity_min: 0.1,
                        sync: false
                    }
                },
                size: {
                    value: 3,
                    random: true,
                    anim: {
                        enable: false,
                        speed: 40,
                        size_min: 0.1,
                        sync: false
                    }
                },
                line_linked: {
                    enable: true,
                    distance: 150,
                    color: "#ffffff",
                    opacity: 0.4,
                    width: 1
                },
                move: {
                    enable: true,
                    speed: 6,
                    direction: "none",
                    random: false,
                    straight: false,
                    out_mode: "out",
                    bounce: false,
                    attract: {
                        enable: false,
                        rotateX: 600,
                        rotateY: 1200
                    }
                }
            },
            interactivity: {
                detect_on: "canvas",
                events: {
                    onhover: {
                        enable: false,
                        mode: "repulse"
                    },
                    onclick: {
                        enable: false,
                        mode: "push"
                    },
                    resize: true
                }
            },
            retina_detect: true
        });

        // GSAP Animations
        const tl = gsap.timeline();

        // Initial setup
        gsap.set("#loading-title, #loading-text", { opacity: 0, y: 20 });
        gsap.set("#main-loader", { scale: 0, rotation: 0 });
        gsap.set("#center-icon", { scale: 0, rotation: 0 });
        gsap.set(".floating-dot", { scale: 0, y: 0 });

        // Main animation sequence
        tl.to("#main-loader", {
            scale: 1,
            duration: 0.8,
            ease: "back.out(1.7)"
        })
        .to("#center-icon", {
            scale: 1,
            rotation: 360,
            duration: 1,
            ease: "back.out(1.7)"
        }, "-=0.5")
        .to("#loading-title", {
            opacity: 1,
            y: 0,
            duration: 0.6,
            ease: "power2.out"
        }, "-=0.3")
        .to("#loading-text", {
            opacity: 1,
            y: 0,
            duration: 0.6,
            ease: "power2.out"
        }, "-=0.4")
        .to(".floating-dot", {
            scale: 1,
            y: -20,
            duration: 2,
            ease: "power1.inOut",
            repeat: -1,
            yoyo: true,
            stagger: 0.2
        }, "-=0.5");

        // Continuous animations
        gsap.to("#main-loader", {
            rotation: 360,
            duration: 2,
            ease: "none",
            repeat: -1
        });

        gsap.to(".loader-inner", {
            rotation: -360,
            duration: 1.5,
            ease: "none",
            repeat: -1
        });

        gsap.to("#center-icon", {
            rotation: "+=360",
            duration: 4,
            ease: "none",
            repeat: -1
        });

        // Progress bar animation
        gsap.to("#progress-fill", {
            x: "0%",
            duration: 3,
            ease: "power2.inOut"
        });

        // Loading text updates
        const loadingTexts = [
            "Initializing...",
            "Loading assets...",
            "Preparing interface...",
            "Almost ready...",
            "Welcome!"
        ];

        let textIndex = 0;
        const textInterval = setInterval(() => {
            if (textIndex < loadingTexts.length - 1) {
                textIndex++;
                gsap.to("#loading-text", {
                    opacity: 0,
                    duration: 0.3,
                    onComplete: () => {
                        document.getElementById("loading-text").textContent = loadingTexts[textIndex];
                        gsap.to("#loading-text", {
                            opacity: 1,
                            duration: 0.3
                        });
                    }
                });
            }
        }, 600);

        // Check if user has visited before
        const hasVisited = sessionStorage.getItem('hasVisited');
        
        if (hasVisited) {
            // Skip preloader for returning visitors
            document.getElementById('preloader').style.display = 'none';
            document.getElementById('main-content').classList.remove('hidden');
        } else {
            // Show preloader for first-time visitors
            // Hide preloader after loading
            window.addEventListener('load', () => {
                setTimeout(() => {
                    clearInterval(textInterval);
                    
                    // Mark as visited
                    sessionStorage.setItem('hasVisited', 'true');
                    
                    // Exit animation
                    const exitTl = gsap.timeline({
                        onComplete: () => {
                            document.getElementById('preloader').style.display = 'none';
                            document.getElementById('main-content').classList.remove('hidden');
                            
                            // Entrance animation for main content
                            gsap.fromTo("#main-content", 
                                { opacity: 0, y: 30 },
                                { opacity: 1, y: 0, duration: 1, ease: "power2.out" }
                            );
                        }
                    });

                    exitTl.to("#loading-text", {
                        opacity: 0,
                        y: -20,
                        duration: 0.5
                    })
                    .to("#loading-title", {
                        opacity: 0,
                        y: -20,
                        duration: 0.5
                    }, "-=0.3")
                    .to("#main-loader", {
                        scale: 0,
                        rotation: "+=180",
                        duration: 0.8,
                        ease: "back.in(1.7)"
                    }, "-=0.3")
                    .to("#preloader", {
                        opacity: 0,
                        duration: 0.8,
                        ease: "power2.inOut"
                    }, "-=0.5");

                }, 3500); // Show for 3.5 seconds
            });
        }
    </script>
@endsection