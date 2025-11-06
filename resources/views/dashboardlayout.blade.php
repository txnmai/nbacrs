<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Noto+Sans+Thai:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- AOS CSS -->
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.1/dist/aos.js"></script>
    
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: "Inter", "Noto Sans Thai", sans-serif;
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
        }
        
        .drawer-content {
            min-height: 100vh;
        }
        
        .drawer-side {
            z-index: 1000;
        }
        
        .drawer-overlay {
            background-color: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(4px);
        }
        
        .glass-effect {
            background: rgba(255, 255, 255, 0.25);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .sidebar-gradient {
            background: linear-gradient(135deg, #1e40af 0%, #3b82f6 50%, #60a5fa 100%);
        }
        
        .service-dropdown {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease-out, opacity 0.3s ease-out;
            opacity: 0;
        }
        
        .service-dropdown.active {
            max-height: 200px;
            opacity: 1;
        }
        
        .menu-item {
            transition: all 0.3s ease;
            position: relative;
        }
        
        .menu-item:hover {
            transform: translateX(8px);
            background: rgba(255, 255, 255, 0.1);
        }
        
        .menu-item::before {
            content: '';
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
            width: 4px;
            height: 0;
            background: #ffffff;
            transition: height 0.3s ease;
            border-radius: 0 4px 4px 0;
        }
        
        .menu-item:hover::before {
            height: 60%;
        }
        
        .floating-header {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(148, 163, 184, 0.1);
        }
        
        .icon-bounce {
            animation: bounce 2s infinite;
        }
        
        @keyframes bounce {
            0%, 20%, 53%, 80%, 100% {
                transform: translateY(0);
            }
            40%, 43% {
                transform: translateY(-8px);
            }
            70% {
                transform: translateY(-4px);
            }
        }
        
        .card-hover {
            transition: all 0.3s ease;
        }
        
        .card-hover:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
        
        .btn-modern {
            background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
            border: none;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        
        .btn-modern:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(59, 130, 246, 0.4);
        }
        
        .btn-modern::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }
        
        .btn-modern:hover::before {
            left: 100%;
        }
    </style>
</head>
<body class="min-h-screen">
    
    <div class="drawer lg:drawer-open">
        <input id="my-drawer-2" type="checkbox" class="drawer-toggle" />
        
        <!-- Main Content -->
        <div class="drawer-content flex flex-col">
            <!-- Modern Header -->
            <div class="floating-header sticky top-0 z-30 flex items-center justify-between px-6 py-4 lg:px-8">
                <div class="flex items-center space-x-4">
                    <label for="my-drawer-2" class="drawer-button lg:hidden btn btn-ghost btn-circle text-slate-600 hover:text-blue-600">
                        <i class="fas fa-bars text-xl"></i>
                    </label>
                    <div class="hidden lg:flex items-center space-x-3">
                        <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center">
                            <i class="fas fa-tools text-white text-lg"></i>
                        </div>
                        <div>
                            <h1 class="text-xl font-bold text-slate-800">IT Repair Dashboard</h1>
                            <p class="text-sm text-slate-500">ระบบแจ้งซ่อมคอมพิวเตอร์</p>
                        </div>
                    </div>
                </div>
                
                <div class="flex items-center space-x-4">
                    <div class="hidden md:flex items-center space-x-2 bg-white rounded-full px-4 py-2 shadow-sm">
                        <div class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></div>
                        <span class="text-sm text-slate-600">ระบบพร้อมใช้งาน</span>
                    </div>
                    <div class="w-8 h-8 bg-gradient-to-br from-slate-200 to-slate-300 rounded-full flex items-center justify-center">
                        <i class="fas fa-user text-slate-600 text-sm"></i>
                    </div>
                </div>
            </div>
            
            <!-- Page Content -->
            <main class="flex-1 p-6 lg:p-8">
                <div class="max-w-7xl mx-auto">
                    @yield('content')
                </div>
            </main>
        </div>
        
        <!-- Modern Sidebar -->
        <div class="drawer-side">
            <label for="my-drawer-2" aria-label="close sidebar" class="drawer-overlay"></label>
            <aside class="sidebar-gradient min-h-full w-80 shadow-2xl relative z-40">
                <!-- Sidebar Header -->
                <div class="p-6 border-b border-white/10">
                    <div class="flex items-center space-x-3">
                        <div class="w-12 h-12 bg-white/20 rounded-2xl flex items-center justify-center backdrop-blur-sm">
                            <i class="fas fa-screwdriver-wrench text-white text-xl icon-bounce"></i>
                        </div>
                        <div>
                            <h2 class="text-xl font-bold text-white">IT Repair</h2>
                            <p class="text-blue-100 text-sm">Management System</p>
                        </div>
                    </div>
                </div>
                
                <!-- Navigation Menu -->
                <nav class="p-4 space-y-2 pb-24">
                    <a href="/" target="_blank" class="menu-item flex items-center space-x-4 text-white hover:text-blue-100 p-4 rounded-xl transition-all duration-300">
                        <div class="w-10 h-10 bg-white/10 rounded-xl flex items-center justify-center">
                            <i class="fas fa-home text-lg"></i>
                        </div>
                        <span class="font-medium">Home</span>
                        <i class="fas fa-external-link-alt text-xs ml-auto opacity-60"></i>
                    </a>
                    
                    <!-- Service Dropdown -->
                    <div class="service-container">
                        <button onclick="toggleServiceDropdown()" class="menu-item flex items-center space-x-4 text-white hover:text-blue-100 p-4 rounded-xl transition-all duration-300 w-full text-left">
                            <div class="w-10 h-10 bg-white/10 rounded-xl flex items-center justify-center">
                                <i class="fas fa-cogs text-lg"></i>
                            </div>
                            <span class="font-medium flex-1">Service</span>
                            <i class="fas fa-chevron-down text-sm transition-transform duration-300" id="serviceChevron"></i>
                        </button>
                        
                        <div class="service-dropdown ml-14 mt-2 space-y-1" id="serviceDropdown">
                            <a href="/service-form" target="_blank" class="flex items-center space-x-3 text-blue-100 hover:text-white p-3 rounded-lg hover:bg-white/10 transition-all duration-300">
                                <i class="fas fa-plus-circle text-sm"></i>
                                <span>Service Form</span>
                                <i class="fas fa-external-link-alt text-xs ml-auto opacity-60"></i>
                            </a>
                            <a href="/service-view" target="_blank" class="flex items-center space-x-3 text-blue-100 hover:text-white p-3 rounded-lg hover:bg-white/10 transition-all duration-300">
                                <i class="fas fa-list-alt text-sm"></i>
                                <span>View Service</span>
                                <i class="fas fa-external-link-alt text-xs ml-auto opacity-60"></i>
                            </a>
                        </div>
                    </div>
                    
                    <a href="/about" target="_blank" class="menu-item flex items-center space-x-4 text-white hover:text-blue-100 p-4 rounded-xl transition-all duration-300">
                        <div class="w-10 h-10 bg-white/10 rounded-xl flex items-center justify-center">
                            <i class="fas fa-info-circle text-lg"></i>
                        </div>
                        <span class="font-medium">About Us</span>
                        <i class="fas fa-external-link-alt text-xs ml-auto opacity-60"></i>
                    </a>
                    <a href="/dashboard" target="_blank" class="menu-item flex items-center space-x-4 text-white hover:text-blue-100 p-4 rounded-xl transition-all duration-300">
                        <div class="w-10 h-10 bg-white/10 rounded-xl flex items-center justify-center">
                            <i class="fa-solid fa-table-list text-lg"></i>
                        </div>
                        <span class="font-medium">Dashboard</span>
                        <i class="fa-solid fa-folder-open text-xs ml-auto opacity-60"></i>
                    </a>
                    <a href="/graph" target="_blank" class="menu-item flex items-center space-x-4 text-white hover:text-blue-100 p-4 rounded-xl transition-all duration-300">
                        <div class="w-10 h-10 bg-white/10 rounded-xl flex items-center justify-center">
                            <i class="far fa-chart-bar text-lg"></i>
                        </div>
                        <span class="font-medium">Graph</span>
                        <i class="far fa-chart-bar text-xs ml-auto opacity-60 -rotate-90"></i>
                    </a>
                </nav>
                
                <!-- Logout Button -->
                <div class="absolute bottom-0 left-0 right-0 p-4 bg-gradient-to-t from-black/20 to-transparent">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn-modern w-full text-white font-medium py-3 px-4 rounded-xl flex items-center justify-center space-x-2 hover:shadow-lg transition-all duration-300">
                            <i class="fas fa-sign-out-alt"></i>
                            <span>ออกจากระบบ</span>
                        </button>
                    </form>
                </div>
            </aside>
        </div>
    </div>

    <!-- Modern Footer -->
    <footer class="bg-slate-800 text-slate-300 py-12">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Company Info -->
                <div class="space-y-4">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center">
                            <i class="fas fa-graduation-cap text-white"></i>
                        </div>
                        <div>
                            <h3 class="text-white font-semibold">NBAC</h3>
                            <p class="text-sm text-slate-400">IT Repair System</p>
                        </div>
                    </div>
                    <p class="text-slate-400 text-sm leading-relaxed">
                        ระบบแจ้งซ่อมคอมพิวเตอร์ สำหรับวิทยาลัยเทคโนโลยีบริหารธุรกิจนาคประสิทธิ์
                    </p>
                </div>
                
                <!-- Contact Info -->
                <div class="space-y-4">
                    <h4 class="text-white font-semibold">ติดต่อเรา</h4>
                    <div class="space-y-2 text-sm">
                        <p class="text-slate-400">โรงเรียนนาคประสิทธิ์ วัดบางช้างเหนือ</p>
                        <p class="text-slate-400">วิทยาลัยเทคโนโลยีบริหารธุรกิจนาคประสิทธิ์</p>
                    </div>
                </div>
                
                <!-- Developer Info -->
                <div class="space-y-4">
                    <h4 class="text-white font-semibold">ผู้พัฒนา</h4>
                    <div class="flex items-center space-x-3">
                        <div class="w-8 h-8 bg-gradient-to-br from-pink-500 to-rose-500 rounded-full flex items-center justify-center">
                            <i class="fab fa-instagram text-white text-sm"></i>
                        </div>
                        <a href="https://www.instagram.com/karasumi_zz/?__pwa=1" 
                           class="text-slate-300 hover:text-white transition-colors duration-300">
                            Thanapon Khawkumkrong
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="border-t border-slate-700 mt-8 pt-8 text-center">
                <p class="text-slate-500 text-sm">
                    © 2024 Nakprasith Business Administration Technological College. All rights reserved.
                </p>
            </div>
        </div>
    </footer>

    <script>
        // Initialize AOS
        AOS.init({
            duration: 800,
            easing: 'ease-in-out',
            once: true
        });

        // Service dropdown toggle
        function toggleServiceDropdown() {
            const dropdown = document.getElementById('serviceDropdown');
            const chevron = document.getElementById('serviceChevron');
            
            dropdown.classList.toggle('active');
            chevron.classList.toggle('rotate-180');
        }

        // Close dropdown when clicking outside
        document.addEventListener('click', function(event) {
            const serviceContainer = document.querySelector('.service-container');
            if (!serviceContainer.contains(event.target)) {
                const dropdown = document.getElementById('serviceDropdown');
                const chevron = document.getElementById('serviceChevron');
                dropdown.classList.remove('active');
                chevron.classList.remove('rotate-180');
            }
        });

        // Close mobile drawer when clicking menu items
        document.querySelectorAll('.drawer-side a').forEach(link => {
            link.addEventListener('click', function() {
                if (window.innerWidth < 1024) {
                    document.getElementById('my-drawer-2').checked = false;
                }
            });
        });
        document.addEventListener('DOMContentLoaded', function() {
            const links = document.querySelectorAll('a[href^="#"]');
            links.forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    const target = document.querySelector(this.getAttribute('href'));
                    if (target) {
                        target.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                });
            });
        });
    </script>

    @stack('scripts')
</body>
</html>