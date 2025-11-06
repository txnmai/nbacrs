<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>


    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/64cb7c5dd2.js" crossorigin="anonymous"></script>
    <!-- Owl Carousel CSS -->
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Thai:wght@100..900&display=swap" rel="stylesheet">

    <!-- ปิดการใช้ -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.3/umd/popper.min.js"
        integrity="sha384-eSN5fwXlAgRA5aw9kZl2Rv8zbiLLbRC9Bj5nlyBLlh5rJlP+ql48f5+7N6N6jIeHz" crossorigin="anonymous">
    </script> -->

    <!-- AOS CSS -->
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <!-- AOS JS -->
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.1/dist/aos.js"></script>




    @vite(['resources/css/app.css', 'resources/js/app.js'])





    <title>@yield('title')</title>
    <style>
        
        body{
            font-family: "Noto Sans Thai", sans-serif;
        }
        .hover-lift {
            transition: all 0.3s ease;
        }
        .hover-lift:hover {
            transform: translateY(-2px);
        }
        .gradient-border {
            background: linear-gradient(90deg, #6b7280, #9ca3af, #6b7280);
            height: 1px;
        }
    </style>
</head>
<body class="overflow-x-hidden">
    
    
<div class="navbar bg-white/95 backdrop-blur-md shadow-lg border-b border-blue-100 px-4 lg:px-8 sticky top-0 z-50">
    <!-- Mobile Menu & Logo -->
    <div class="navbar-start">
        <!-- Mobile Drawer -->
        <div class="dropdown lg:hidden">
            <div tabindex="0" role="button" class="btn btn-ghost btn-circle text-blue-600 hover:bg-blue-50">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </div>
            <ul tabindex="0" class="menu menu-sm dropdown-content bg-white/95 backdrop-blur-md rounded-box z-50 mt-3 w-64 p-4 shadow-2xl border border-blue-100">
                <li><a href="/" class="text-slate-700 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-all duration-200 font-medium py-3">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                    </svg>
                    Home
                </a></li>
                <li><a href="/service-form" class="text-slate-700 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-all duration-200 font-medium py-3">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                    Services
                </a></li>
                <li><a href="/about" class="text-slate-700 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-all duration-200 font-medium py-3">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    About Us
                </a></li>
                @auth
                    <li><a href="/dashboard" class="text-slate-700 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-all duration-200 font-medium py-3">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                        Dashboard
                    </a></li>
                @endauth
            </ul>
        </div>
        
        <!-- Logo -->
        <a href="/" class="btn btn-ghost text-2xl lg:text-3xl xl:text-4xl font-black hover:bg-transparent">
            <span class="bg-gradient-to-r from-blue-600 to-cyan-500 bg-clip-text text-transparent">
                NBACREPAIR
            </span>
        </a>
    </div>

    <!-- Desktop Menu -->
    <div class="navbar-end hidden lg:flex">
        <ul class="menu menu-horizontal px-1 space-x-2">
            <li>
                <a href="/" class="btn btn-ghost text-slate-700 hover:text-blue-600 hover:bg-blue-50 font-semibold transition-all duration-200 rounded-lg">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                    </svg>
                    Home
                </a>
            </li>
            <li>
                <a href="/service-form" class="btn btn-ghost text-slate-700 hover:text-blue-600 hover:bg-blue-50 font-semibold transition-all duration-200 rounded-lg">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                    Services
                </a>
            </li>
            <li>
                <a href="/about" class="btn btn-ghost text-slate-700 hover:text-blue-600 hover:bg-blue-50 font-semibold transition-all duration-200 rounded-lg">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    About Us
                </a>
            </li>
            @auth
                <li>
                    <a href="/dashboard" class="btn btn-primary text-white font-semibold shadow-lg hover:shadow-blue-500/25 transform hover:scale-105 transition-all duration-200">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                        Dashboard
                    </a>
                </li>
            @endauth
        </ul>
    </div>
</div>



 {{-------------------------- --}}
    <div class="">
        @yield('content')
    </div>
    <footer class="bg-gray-800 text-gray-100">
        <div class="max-w-7xl mx-auto px-6 py-12">
            <div class="grid md:grid-cols-3 gap-8">
                
                <!-- Logo Section -->
                <div class="space-y-4">
                    <div class="flex items-center space-x-3">
                        <div class="bg-gray-700 p-3 rounded-lg">
                            <i class="fas fa-tools text-2xl text-blue-400"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold">ระบบแจ้งซ่อม</h3>
                            <p class="text-gray-400 text-sm">Repair Request System</p>
                        </div>
                    </div>
                </div>

                <!-- Organization Info -->
                <div class="space-y-4">
                    <h4 class="text-lg font-semibold text-white">สถาบันการศึกษา</h4>
                    <div class="text-sm text-gray-300 space-y-2">
                        <p class="flex items-center">
                            <i class="fas fa-graduation-cap mr-1 text-blue-400"></i>
                            โรงเรียนนาคประสิทธิ์ วัดบางช้างเหนือ
                        </p>
                        <p class="flex items-center">
                            <i class="fas fa-university mr-2 text-blue-400"></i>
                            วิทยาลัยเทคโนโลยีบริหารธุรกิจนาคประสิทธิ์
                        </p>
                    </div>
                </div>

                <!-- Contact & Developer -->
                <div class="space-y-4">
                    <h4 class="text-lg font-semibold text-white">ติดต่อเรา</h4>
                    <div class="text-sm text-gray-300 space-y-2">
                        <p class="flex items-center">
                            <i class="fas fa-envelope mr-2 text-blue-400"></i>
                            support@nbac.ac.th
                        </p>
                        <p class="flex items-center">
                            <i class="fas fa-phone mr-2 text-blue-400"></i>
                            02-xxx-xxxx
                        </p>
                    </div>
                    
                    <!-- Developer Credit -->
                    <div class="mt-6 pt-4 border-t border-gray-700">
                        <p class="text-xs text-gray-400 mb-1">Develop & Design By :</p>
                        <a href="https://www.instagram.com/karasumi_zz/?__pwa=1" 
                           class="inline-flex items-center space-x-2 text-sm text-gray-300 hover:text-white hover-lift group">
                            <i class="fab fa-instagram text-pink-400 group-hover:text-pink-300"></i>
                            <span>Thanapon Khawkumkrong</span>
                            <i class="fas fa-external-link-alt text-xs opacity-60 group-hover:opacity-100"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Bottom Section -->
            <div class="mt-8 pt-6 border-t border-gray-700">
                <div class="flex flex-col md:flex-row justify-center items-center text-sm text-gray-400">
                    <p>© 2024 Nakprasith School Wat Bangchangnua Foundation & NBAC</p>
                </div>
            </div>
        </div>
    </footer>
    <script>
        console.log("test form layout");
    </script>
</body>
</html>