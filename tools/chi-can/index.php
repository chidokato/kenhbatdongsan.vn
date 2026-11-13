<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tool Tạo Phiếu Chỉ Căn BĐS - Kênh Bất Động Sản</title>
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,400;1,700&display=swap" rel="stylesheet">
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Montserrat', 'sans-serif'],
                    },
                    colors: {
                        brand: {
                            50: '#eff6ff',
                            100: '#dbeafe',
                            500: '#3b82f6',
                            600: '#2563eb',
                            700: '#1d4ed8',
                            800: '#1e40af',
                            900: '#0b2b5e',
                            gold: '#d97706',
                            accent: '#f59e0b',
                        }
                    }
                }
            }
        }
    </script>
    <style>
        body {
            font-family: 'Montserrat', sans-serif;
            background-color: #f1f5f9;
        }
        .canvas-container {
            background-image: radial-gradient(#cbd5e1 1px, transparent 1px);
            background-size: 16px 16px;
        }
        .custom-scrollbar::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }
        .custom-scrollbar::-webkit-scrollbar-track {
            background: #f1f5f9;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 4px;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }
        .badge-pulse {
            animation: pulse-border 2s infinite;
        }
        @keyframes pulse-border {
            0%, 100% { box-shadow: 0 0 0 0 rgba(37, 99, 235, 0.4); }
            50% { box-shadow: 0 0 0 6px rgba(37, 99, 235, 0); }
        }
    </style>
</head>
<body class="min-h-screen text-slate-800 flex flex-col">

    <!-- Header Navigation -->
    <header class="bg-white border-b border-slate-200 sticky top-0 z-50 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-blue-900 to-blue-600 flex items-center justify-center text-white shadow-md font-bold text-lg">
                    KB
                </div>
                <div>
                    <h1 class="text-base sm:text-lg font-bold text-slate-900 leading-tight flex items-center gap-2">
                        Tool Tạo Phiếu Chỉ Căn BĐS
                        <span class="text-xs font-semibold px-2 py-0.5 rounded-full bg-blue-100 text-blue-700">v1.0 Pro</span>
                    </h1>
                    <p class="text-xs text-slate-500">Kênh Bất Động Sản • Thay ảnh 4 khung & cập nhật thông số căn hộ</p>
                </div>
            </div>

            <div class="flex items-center gap-2 sm:gap-3">
                <a href="/www/kenhbds/wp-admin/" target="_blank" class="hidden sm:inline-flex items-center gap-1.5 text-xs font-medium text-slate-600 hover:text-blue-600 px-3 py-2 rounded-lg hover:bg-slate-100 transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    Quản trị WP
                </a>
                <button onclick="resetAllDefaults()" class="inline-flex items-center gap-1.5 text-xs font-medium text-slate-700 hover:text-red-600 px-3 py-2 rounded-lg bg-slate-100 hover:bg-red-50 transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                    Làm mới
                </button>
                <button onclick="copyImageToClipboard()" class="inline-flex items-center gap-1.5 text-xs sm:text-sm font-semibold text-white px-3 sm:px-4 py-2 rounded-lg bg-emerald-600 hover:bg-emerald-700 shadow-sm transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3"></path></svg>
                    <span>Sao Chép (Gửi Zalo)</span>
                </button>
                <button onclick="downloadImage('png')" class="inline-flex items-center gap-1.5 text-xs sm:text-sm font-bold text-white px-3 sm:px-4 py-2 rounded-lg bg-blue-600 hover:bg-blue-700 shadow-md transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                    <span>Tải Ảnh PNG</span>
                </button>
            </div>
        </div>
    </header>

    <!-- Main Workspace -->
    <main class="flex-1 max-w-7xl mx-auto w-full px-4 sm:px-6 lg:px-8 py-6">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">
            
            <!-- LEFT COLUMN: CONTROLS & INPUTS (5 cols) -->
            <div class="lg:col-span-5 space-y-6">

                <!-- 1. THÔNG SỐ CĂN HỘ (KHU VỰC KHOANH ĐỎ) -->
                <div class="bg-white rounded-2xl p-5 shadow-sm border border-slate-200">
                    <div class="flex items-center justify-between pb-3 border-b border-slate-100 mb-4">
                        <div class="flex items-center gap-2">
                            <span class="w-7 h-7 rounded-lg bg-red-100 text-red-600 flex items-center justify-center font-bold text-sm">1</span>
                            <h2 class="text-sm font-bold text-slate-800 uppercase tracking-wide">Số Liệu Căn Hộ (Khu Vực Đỏ)</h2>
                        </div>
                        <span class="text-[11px] font-semibold text-emerald-600 bg-emerald-50 px-2 py-0.5 rounded-full border border-emerald-200 flex items-center gap-1">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-ping"></span> Live Preview
                        </span>
                    </div>

                    <div class="space-y-3.5">
                        <!-- Mã căn (Header) -->
                        <div class="p-3 bg-blue-50/70 border border-blue-200 rounded-xl">
                            <label class="block text-xs font-bold text-blue-900 mb-1 flex items-center justify-between">
                                <span>MÃ CĂN (TIÊU ĐỀ BẢNG)</span>
                                <span class="text-[10px] text-blue-600 font-normal">Chữ in đậm, căn giữa</span>
                            </label>
                            <input type="text" id="input_ma_can" value="ST.36.18" oninput="renderCanvas()" 
                                   class="w-full px-3 py-2 text-base font-extrabold text-blue-900 bg-white border border-blue-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none tracking-wide" 
                                   placeholder="VD: ST.36.18, VKP-08.15...">
                        </div>

                        <!-- 4 Dòng thông số -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                            <!-- Loại căn -->
                            <div>
                                <label class="block text-xs font-semibold text-slate-700 mb-1">Loại Căn</label>
                                <input type="text" id="input_loai_can" value="2PN + 1, 2WC" oninput="renderCanvas()" 
                                       class="w-full px-3 py-2 text-xs font-semibold text-slate-800 bg-slate-50 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:bg-white focus:outline-none" 
                                       placeholder="VD: 2PN + 1, 2WC">
                            </div>

                            <!-- Diện tích thông thủy -->
                            <div>
                                <label class="block text-xs font-semibold text-slate-700 mb-1">Diện Tích Thông Thủy</label>
                                <input type="text" id="input_dien_tich" value="72.8 m²" oninput="renderCanvas()" 
                                       class="w-full px-3 py-2 text-xs font-semibold text-slate-800 bg-slate-50 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:bg-white focus:outline-none" 
                                       placeholder="VD: 72.8 m²">
                            </div>

                            <!-- Hướng ban công -->
                            <div>
                                <label class="block text-xs font-semibold text-slate-700 mb-1">Hướng BC (Ban Công)</label>
                                <input type="text" id="input_huong_bc" value="Đông Nam" oninput="renderCanvas()" 
                                       class="w-full px-3 py-2 text-xs font-semibold text-slate-800 bg-slate-50 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:bg-white focus:outline-none" 
                                       placeholder="VD: Đông Nam">
                            </div>

                            <!-- Giá niêm yết -->
                            <div>
                                <label class="block text-xs font-semibold text-slate-700 mb-1 flex items-center justify-between">
                                    <span>Giá Niêm Yết</span>
                                    <span class="text-[10px] text-amber-600 font-bold">Nổi bật</span>
                                </label>
                                <input type="text" id="input_gia_niem_yet" value="4.250.000.000 đ" oninput="renderCanvas()" 
                                       class="w-full px-3 py-2 text-xs font-bold text-amber-700 bg-amber-50/50 border border-amber-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:bg-white focus:outline-none" 
                                       placeholder="VD: 4.250.000.000 đ hoặc 4.25 tỷ">
                            </div>
                        </div>

                        <!-- Tùy chọn nâng cao (Tên dự án) -->
                        <div class="pt-2">
                            <button type="button" onclick="toggleAdvancedOptions()" class="text-xs text-blue-600 hover:text-blue-800 font-medium flex items-center gap-1 focus:outline-none">
                                <svg id="adv_chevron" class="w-3.5 h-3.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                <span>Tùy chọn: Thay tên Dự án / Tiêu đề (Mặc định giữ nguyên)</span>
                            </button>
                            <div id="adv_options" class="hidden mt-3 space-y-2.5 p-3 bg-slate-50 rounded-xl border border-slate-200">
                                <div>
                                    <label class="block text-[11px] font-semibold text-slate-600 mb-0.5">Tên Dự Án</label>
                                    <input type="text" id="input_ten_du_an" value="IMPERIA SKY PARK" oninput="renderCanvas()" 
                                           class="w-full px-2.5 py-1.5 text-xs font-bold text-slate-800 bg-white border border-slate-300 rounded-md focus:ring-1 focus:ring-blue-500" 
                                           placeholder="Để trống để giữ nguyên hình gốc, hoặc nhập tên mới">
                                </div>
                                <div>
                                    <label class="block text-[11px] font-semibold text-slate-600 mb-0.5">Dòng Tiêu Đề Nhỏ Trên Tên Dự Án</label>
                                    <input type="text" id="input_tieu_de_phu" value="THÔNG TIN CHI TIẾT CĂN" oninput="renderCanvas()" 
                                           class="w-full px-2.5 py-1.5 text-xs text-slate-800 bg-white border border-slate-300 rounded-md focus:ring-1 focus:ring-blue-500">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 2. BỐN KHUNG CHÈN ẢNH -->
                <div class="bg-white rounded-2xl p-5 shadow-sm border border-slate-200">
                    <div class="flex items-center justify-between pb-3 border-b border-slate-100 mb-4">
                        <div class="flex items-center gap-2">
                            <span class="w-7 h-7 rounded-lg bg-blue-100 text-blue-600 flex items-center justify-center font-bold text-sm">2</span>
                            <h2 class="text-sm font-bold text-slate-800 uppercase tracking-wide">Thay 4 Khung Ảnh</h2>
                        </div>
                        <span class="text-[11px] text-slate-500">Kéo thả ảnh hoặc Ctrl+V</span>
                    </div>

                    <div class="space-y-4">
                        
                        <!-- Khung 1: Ảnh Dự Án -->
                        <div class="p-3 bg-slate-50 rounded-xl border border-slate-200" id="card_frame_1">
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-xs font-bold text-slate-800 flex items-center gap-1.5">
                                    <span class="w-2 h-2 rounded-full bg-blue-500"></span>
                                    1. Ảnh Dự Án (Khung trên trái)
                                </span>
                                <div class="flex items-center gap-1.5">
                                    <button type="button" onclick="setFitMode(1, 'cover')" id="fit_btn_1_cover" class="text-[10px] px-2 py-0.5 rounded font-semibold bg-blue-600 text-white">Lấp đầy</button>
                                    <button type="button" onclick="setFitMode(1, 'contain')" id="fit_btn_1_contain" class="text-[10px] px-2 py-0.5 rounded font-medium bg-slate-200 text-slate-700">Vừa vặn</button>
                                    <button type="button" onclick="clearImage(1)" class="text-[10px] text-red-500 hover:text-red-700 px-1 font-semibold ml-1">Xóa</button>
                                </div>
                            </div>
                            <div class="flex gap-3 items-center">
                                <div class="w-16 h-14 bg-slate-200 rounded-lg overflow-hidden border border-slate-300 flex items-center justify-center flex-shrink-0" id="preview_thumb_1">
                                    <span class="text-[10px] text-slate-400 font-semibold text-center">Trống</span>
                                </div>
                                <div class="flex-1">
                                    <input type="file" id="file_frame_1" accept="image/*" onchange="handleFileSelect(event, 1)" class="hidden">
                                    <div class="flex gap-2">
                                        <button type="button" onclick="document.getElementById('file_frame_1').click()" class="flex-1 py-1.5 px-3 text-xs font-semibold bg-white border border-slate-300 hover:bg-slate-100 rounded-lg text-slate-700 shadow-sm transition text-center">
                                            📁 Chọn File
                                        </button>
                                        <button type="button" onclick="pasteFromClipboard(1)" class="py-1.5 px-2.5 text-xs font-semibold bg-blue-50 border border-blue-200 hover:bg-blue-100 rounded-lg text-blue-700 shadow-sm transition" title="Dán ảnh vừa chụp (Ctrl+V)">
                                            📋 Dán
                                        </button>
                                    </div>
                                    <p class="text-[10px] text-slate-400 mt-1">Kích thước khung: 279 x 228 px</p>
                                </div>
                            </div>
                        </div>

                        <!-- Khung 2: Mặt Bằng Tầng -->
                        <div class="p-3 bg-slate-50 rounded-xl border border-slate-200" id="card_frame_2">
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-xs font-bold text-slate-800 flex items-center gap-1.5">
                                    <span class="w-2 h-2 rounded-full bg-indigo-500"></span>
                                    2. Mặt Bằng Tầng (Khung giữa)
                                </span>
                                <div class="flex items-center gap-1.5">
                                    <button type="button" onclick="setFitMode(2, 'cover')" id="fit_btn_2_cover" class="text-[10px] px-2 py-0.5 rounded font-medium bg-slate-200 text-slate-700">Lấp đầy</button>
                                    <button type="button" onclick="setFitMode(2, 'contain')" id="fit_btn_2_contain" class="text-[10px] px-2 py-0.5 rounded font-semibold bg-blue-600 text-white">Vừa vặn (Khuyên dùng)</button>
                                    <button type="button" onclick="clearImage(2)" class="text-[10px] text-red-500 hover:text-red-700 px-1 font-semibold ml-1">Xóa</button>
                                </div>
                            </div>
                            <div class="flex gap-3 items-center">
                                <div class="w-16 h-14 bg-slate-200 rounded-lg overflow-hidden border border-slate-300 flex items-center justify-center flex-shrink-0" id="preview_thumb_2">
                                    <span class="text-[10px] text-slate-400 font-semibold text-center">Trống</span>
                                </div>
                                <div class="flex-1">
                                    <input type="file" id="file_frame_2" accept="image/*" onchange="handleFileSelect(event, 2)" class="hidden">
                                    <div class="flex gap-2">
                                        <button type="button" onclick="document.getElementById('file_frame_2').click()" class="flex-1 py-1.5 px-3 text-xs font-semibold bg-white border border-slate-300 hover:bg-slate-100 rounded-lg text-slate-700 shadow-sm transition text-center">
                                            📁 Chọn File
                                        </button>
                                        <button type="button" onclick="pasteFromClipboard(2)" class="py-1.5 px-2.5 text-xs font-semibold bg-blue-50 border border-blue-200 hover:bg-blue-100 rounded-lg text-blue-700 shadow-sm transition" title="Dán ảnh vừa chụp (Ctrl+V)">
                                            📋 Dán
                                        </button>
                                    </div>
                                    <p class="text-[10px] text-slate-400 mt-1">Kích thước khung: 749 x 290 px</p>
                                </div>
                            </div>
                        </div>

                        <!-- Khung 3: Layout Căn Hộ -->
                        <div class="p-3 bg-slate-50 rounded-xl border border-slate-200" id="card_frame_3">
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-xs font-bold text-slate-800 flex items-center gap-1.5">
                                    <span class="w-2 h-2 rounded-full bg-violet-500"></span>
                                    3. Layout Căn Hộ (Khung dưới trái)
                                </span>
                                <div class="flex items-center gap-1.5">
                                    <button type="button" onclick="setFitMode(3, 'cover')" id="fit_btn_3_cover" class="text-[10px] px-2 py-0.5 rounded font-medium bg-slate-200 text-slate-700">Lấp đầy</button>
                                    <button type="button" onclick="setFitMode(3, 'contain')" id="fit_btn_3_contain" class="text-[10px] px-2 py-0.5 rounded font-semibold bg-blue-600 text-white">Vừa vặn (Khuyên dùng)</button>
                                    <button type="button" onclick="clearImage(3)" class="text-[10px] text-red-500 hover:text-red-700 px-1 font-semibold ml-1">Xóa</button>
                                </div>
                            </div>
                            <div class="flex gap-3 items-center">
                                <div class="w-16 h-14 bg-slate-200 rounded-lg overflow-hidden border border-slate-300 flex items-center justify-center flex-shrink-0" id="preview_thumb_3">
                                    <span class="text-[10px] text-slate-400 font-semibold text-center">Trống</span>
                                </div>
                                <div class="flex-1">
                                    <input type="file" id="file_frame_3" accept="image/*" onchange="handleFileSelect(event, 3)" class="hidden">
                                    <div class="flex gap-2">
                                        <button type="button" onclick="document.getElementById('file_frame_3').click()" class="flex-1 py-1.5 px-3 text-xs font-semibold bg-white border border-slate-300 hover:bg-slate-100 rounded-lg text-slate-700 shadow-sm transition text-center">
                                            📁 Chọn File
                                        </button>
                                        <button type="button" onclick="pasteFromClipboard(3)" class="py-1.5 px-2.5 text-xs font-semibold bg-blue-50 border border-blue-200 hover:bg-blue-100 rounded-lg text-blue-700 shadow-sm transition" title="Dán ảnh vừa chụp (Ctrl+V)">
                                            📋 Dán
                                        </button>
                                    </div>
                                    <p class="text-[10px] text-slate-400 mt-1">Kích thước khung: 475 x 295 px</p>
                                </div>
                            </div>
                        </div>

                        <!-- Khung 4: Ảnh Tiện Ích -->
                        <div class="p-3 bg-slate-50 rounded-xl border border-slate-200" id="card_frame_4">
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-xs font-bold text-slate-800 flex items-center gap-1.5">
                                    <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                                    4. Ảnh Tiện Ích (Khung dưới phải)
                                </span>
                                <div class="flex items-center gap-1.5">
                                    <button type="button" onclick="setFitMode(4, 'cover')" id="fit_btn_4_cover" class="text-[10px] px-2 py-0.5 rounded font-semibold bg-blue-600 text-white">Lấp đầy</button>
                                    <button type="button" onclick="setFitMode(4, 'contain')" id="fit_btn_4_contain" class="text-[10px] px-2 py-0.5 rounded font-medium bg-slate-200 text-slate-700">Vừa vặn</button>
                                    <button type="button" onclick="clearImage(4)" class="text-[10px] text-red-500 hover:text-red-700 px-1 font-semibold ml-1">Xóa</button>
                                </div>
                            </div>
                            <div class="flex gap-3 items-center">
                                <div class="w-16 h-14 bg-slate-200 rounded-lg overflow-hidden border border-slate-300 flex items-center justify-center flex-shrink-0" id="preview_thumb_4">
                                    <span class="text-[10px] text-slate-400 font-semibold text-center">Trống</span>
                                </div>
                                <div class="flex-1">
                                    <input type="file" id="file_frame_4" accept="image/*" onchange="handleFileSelect(event, 4)" class="hidden">
                                    <div class="flex gap-2">
                                        <button type="button" onclick="document.getElementById('file_frame_4').click()" class="flex-1 py-1.5 px-3 text-xs font-semibold bg-white border border-slate-300 hover:bg-slate-100 rounded-lg text-slate-700 shadow-sm transition text-center">
                                            📁 Chọn File
                                        </button>
                                        <button type="button" onclick="pasteFromClipboard(4)" class="py-1.5 px-2.5 text-xs font-semibold bg-blue-50 border border-blue-200 hover:bg-blue-100 rounded-lg text-blue-700 shadow-sm transition" title="Dán ảnh vừa chụp (Ctrl+V)">
                                            📋 Dán
                                        </button>
                                    </div>
                                    <p class="text-[10px] text-slate-400 mt-1">Kích thước khung: 284 x 295 px</p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- Hướng Dẫn Nhanh -->
                <div class="p-4 bg-amber-50/80 border border-amber-200 rounded-2xl text-xs text-amber-900 space-y-1.5">
                    <div class="font-bold flex items-center gap-1.5 text-amber-800">
                        <svg class="w-4 h-4 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
                        <span>Mẹo thao tác siêu nhanh cho Sales BĐS:</span>
                    </div>
                    <p class="text-amber-800/90 leading-relaxed">
                        • <strong>Chụp màn hình & Dán:</strong> Nhấn <code class="bg-amber-100 px-1 py-0.5 rounded font-mono font-bold">Win + Shift + S</code> để chụp mặt bằng trên file PDF, sau đó bấm nút <strong>📋 Dán</strong> tại khung tương ứng.
                    </p>
                    <p class="text-amber-800/90 leading-relaxed">
                        • <strong>Gửi Zalo nhanh:</strong> Sau khi xong, bấm nút <strong class="text-emerald-700">Sao Chép (Gửi Zalo)</strong> ở góc trên rồi chuyển sang cửa sổ chat Zalo bấm <code class="bg-amber-100 px-1 py-0.5 rounded font-mono font-bold">Ctrl + V</code> để gửi ngay cho khách hàng!
                    </p>
                </div>

            </div>

            <!-- RIGHT COLUMN: LIVE CANVAS PREVIEW (7 cols) -->
            <div class="lg:col-span-7 sticky top-20">
                <div class="bg-white rounded-2xl p-5 shadow-sm border border-slate-200">
                    <div class="flex items-center justify-between pb-3 border-b border-slate-100 mb-4">
                        <div class="flex items-center gap-2">
                            <span class="w-3 h-3 rounded-full bg-emerald-500"></span>
                            <h2 class="text-sm font-bold text-slate-800 uppercase tracking-wide">Xem Trước Phiếu Chỉ Căn (819 × 1024 px)</h2>
                        </div>
                        <div class="flex items-center gap-2">
                            <button onclick="downloadImage('png')" class="text-xs font-bold text-blue-600 hover:text-blue-800 bg-blue-50 px-2.5 py-1 rounded-md border border-blue-200">
                                📥 Tải PNG
                            </button>
                            <button onclick="downloadImage('jpg')" class="text-xs font-semibold text-slate-700 hover:text-slate-900 bg-slate-100 px-2.5 py-1 rounded-md border border-slate-200">
                                📥 JPG
                            </button>
                        </div>
                    </div>

                    <!-- Canvas Wrapper -->
                    <div class="canvas-container p-3 sm:p-5 rounded-xl border border-slate-200 flex items-center justify-center overflow-auto max-h-[750px] custom-scrollbar">
                        <canvas id="posterCanvas" width="819" height="1024" class="max-w-full h-auto rounded-lg shadow-xl bg-white border border-slate-300"></canvas>
                    </div>

                    <!-- Footer Action Bar -->
                    <div class="mt-4 pt-3 border-t border-slate-100 flex flex-wrap items-center justify-between gap-3">
                        <div class="text-xs text-slate-500">
                            Độ phân giải gốc chuẩn in ấn & gửi mạng xã hội không vỡ nét
                        </div>
                        <div class="flex items-center gap-2">
                            <button onclick="copyImageToClipboard()" class="px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs rounded-xl shadow-md transition flex items-center gap-1.5">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3"></path></svg>
                                Sao Chép Để Gửi Zalo Ngay
                            </button>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </main>

    <!-- Toast Notification Popup -->
    <div id="toast" class="fixed bottom-6 right-6 z-50 transform translate-y-24 opacity-0 transition-all duration-300 pointer-events-none">
        <div class="bg-slate-900 text-white px-5 py-3 rounded-xl shadow-2xl flex items-center gap-3 border border-slate-700">
            <span id="toast_icon" class="text-emerald-400 text-xl font-bold">✓</span>
            <div>
                <p id="toast_title" class="text-xs font-bold leading-tight">Thông báo</p>
                <p id="toast_msg" class="text-[11px] text-slate-300">Nội dung thông báo</p>
            </div>
        </div>
    </div>

    <!-- Application Script -->
    <script>
        // --- CONSTANTS & COORDINATES ---
        const CANVAS_WIDTH = 819;
        const CANVAS_HEIGHT = 1024;

        // Exact measured coordinates of the 4 frames
        const FRAMES = {
            1: { x: 36,  y: 214, w: 279, h: 228, radius: 12, name: 'Ảnh Dự Án' },
            2: { x: 35,  y: 430, w: 749, h: 290, radius: 14, name: 'Mặt Bằng Tầng' },
            3: { x: 35,  y: 700, w: 475, h: 295, radius: 14, name: 'Layout Căn Hộ' },
            4: { x: 500, y: 700, w: 284, h: 295, radius: 14, name: 'Ảnh Tiện Ích' }
        };

        // Table coordinates and color masks
        const TABLE = {
            // Header box
            header: {
                cover_x: 420, cover_y: 215, cover_w: 355, cover_h: 46,
                color: '#0B2B5E',
                text_center_x: 595,
                text_center_y: 238
            },
            // 4 rows value cells
            rows: [
                { id: 'loai_can',     y: 263, h: 43, color: '#1956A6', text_y: 285 },
                { id: 'dien_tich',    y: 308, h: 43, color: '#1B56A7', text_y: 330 },
                { id: 'huong_bc',     y: 353, h: 43, color: '#1E56A8', text_y: 375 },
                { id: 'gia_niem_yet', y: 398, h: 43, color: '#2057A9', text_y: 420, is_gold: true }
            ],
            val_col_x: 572,
            val_col_w: 211,
            val_center_x: 677.5
        };

        // State for images and fit modes
        const state = {
            images: {
                1: null,
                2: null,
                3: null,
                4: null
            },
            fitModes: {
                1: 'cover',
                2: 'contain',
                3: 'contain',
                4: 'cover'
            }
        };

        const canvas = document.getElementById('posterCanvas');
        const ctx = canvas.getContext('2d');
        const baseImage = new Image();
        baseImage.crossOrigin = 'anonymous';
        baseImage.src = 'assets/template-chi-can.jpg';

        baseImage.onload = () => {
            renderCanvas();
        };

        // Helper: Draw rounded rectangle path
        function roundRect(ctx, x, y, width, height, radius) {
            ctx.beginPath();
            ctx.moveTo(x + radius, y);
            ctx.lineTo(x + width - radius, y);
            ctx.quadraticCurveTo(x + width, y, x + width, y + radius);
            ctx.lineTo(x + width, y + height - radius);
            ctx.quadraticCurveTo(x + width, y + height, x + width - radius, y + height);
            ctx.lineTo(x + radius, y + height);
            ctx.quadraticCurveTo(x, y + height, x, y + height - radius);
            ctx.lineTo(x, y + radius);
            ctx.quadraticCurveTo(x, y, x + radius, y);
            ctx.closePath();
        }

        // Draw an image inside frame with cover or contain mode
        function drawFramedImage(frameId, img, mode) {
            const frame = FRAMES[frameId];
            if (!img || !frame) return;

            ctx.save();
            roundRect(ctx, frame.x, frame.y, frame.w, frame.h, frame.radius);
            ctx.clip();

            // Clear frame with pure white
            ctx.fillStyle = '#FFFFFF';
            ctx.fillRect(frame.x, frame.y, frame.w, frame.h);

            const imgRatio = img.width / img.height;
            const frameRatio = frame.w / frame.h;
            let drawW, drawH, drawX, drawY;

            if (mode === 'cover') {
                if (imgRatio > frameRatio) {
                    drawH = frame.h;
                    drawW = frame.h * imgRatio;
                    drawX = frame.x + (frame.w - drawW) / 2;
                    drawY = frame.y;
                } else {
                    drawW = frame.w;
                    drawH = frame.w / imgRatio;
                    drawX = frame.x;
                    drawY = frame.y + (frame.h - drawH) / 2;
                }
            } else {
                // contain
                if (imgRatio > frameRatio) {
                    drawW = frame.w;
                    drawH = frame.w / imgRatio;
                    drawX = frame.x;
                    drawY = frame.y + (frame.h - drawH) / 2;
                } else {
                    drawH = frame.h;
                    drawW = frame.h * imgRatio;
                    drawX = frame.x + (frame.w - drawW) / 2;
                    drawY = frame.y;
                }
            }

            ctx.drawImage(img, drawX, drawY, drawW, drawH);
            ctx.restore();
        }

        // MAIN RENDER FUNCTION
        function renderCanvas() {
            if (!baseImage.complete) return;

            // 1. Draw base template
            ctx.drawImage(baseImage, 0, 0, CANVAS_WIDTH, CANVAS_HEIGHT);

            // 2. Draw 4 uploaded images in their frames
            for (let id = 1; id <= 4; id++) {
                if (state.images[id]) {
                    drawFramedImage(id, state.images[id], state.fitModes[id]);
                }
            }

            // 3. COVER OLD TEXT & RENDER NEW APARTMENT VALUES (KHU VỰC KHOANH ĐỎ)
            
            // 3A. Header: MÃ CĂN
            const maCanText = document.getElementById('input_ma_can').value.trim();
            ctx.fillStyle = TABLE.header.color;
            ctx.fillRect(TABLE.header.cover_x, TABLE.header.cover_y, TABLE.header.cover_w, TABLE.header.cover_h);

            if (maCanText) {
                ctx.save();
                ctx.fillStyle = '#FFFFFF';
                ctx.font = '900 24px Montserrat, sans-serif';
                ctx.textAlign = 'center';
                ctx.textBaseline = 'middle';
                // Subtle text shadow for high crispness
                ctx.shadowColor = 'rgba(0,0,0,0.3)';
                ctx.shadowBlur = 4;
                ctx.shadowOffsetY = 1;
                ctx.fillText(maCanText, TABLE.header.text_center_x, TABLE.header.text_center_y);
                ctx.restore();
            }

            // 3B. 4 Table Rows
            const rowValues = {
                loai_can: document.getElementById('input_loai_can').value.trim(),
                dien_tich: document.getElementById('input_dien_tich').value.trim(),
                huong_bc: document.getElementById('input_huong_bc').value.trim(),
                gia_niem_yet: document.getElementById('input_gia_niem_yet').value.trim()
            };

            TABLE.rows.forEach(row => {
                // Cover old text cleanly
                ctx.fillStyle = row.color;
                ctx.fillRect(TABLE.val_col_x, row.y, TABLE.val_col_w, row.h);

                const text = rowValues[row.id];
                if (text) {
                    ctx.save();
                    if (row.is_gold) {
                        ctx.fillStyle = '#FFEAA7'; // Highlight gold for price
                        ctx.font = '800 17px Montserrat, sans-serif';
                    } else {
                        ctx.fillStyle = '#FFFFFF';
                        ctx.font = '700 16px Montserrat, sans-serif';
                    }
                    ctx.textAlign = 'center';
                    ctx.textBaseline = 'middle';
                    ctx.fillText(text, TABLE.val_center_x, row.text_y);
                    ctx.restore();
                }
            });

            // 3C. Custom Project Title (Optional)
            const tenDuAn = document.getElementById('input_ten_du_an').value.trim();
            const tieuDePhu = document.getElementById('input_tieu_de_phu').value.trim();
            
            // Only if user modified from original template
            if (tenDuAn && tenDuAn !== 'IMPERIA SKY PARK') {
                ctx.save();
                // Draw luxury dark blue gradient cover over title area
                const grad = ctx.createLinearGradient(150, 110, 150, 205);
                grad.addColorStop(0, '#042255');
                grad.addColorStop(1, '#083B80');
                ctx.fillStyle = grad;
                ctx.fillRect(150, 110, 520, 95);

                // Subtitle
                ctx.fillStyle = '#FFFFFF';
                ctx.font = '700 18px Montserrat, sans-serif';
                ctx.textAlign = 'center';
                ctx.textBaseline = 'middle';
                ctx.letterSpacing = '1px';
                ctx.fillText(tieuDePhu || 'THÔNG TIN CHI TIẾT CĂN', 410, 138);

                // Project Title
                ctx.fillStyle = '#FFFFFF';
                ctx.font = '900 36px Montserrat, sans-serif';
                ctx.shadowColor = 'rgba(0,0,0,0.5)';
                ctx.shadowBlur = 8;
                ctx.shadowOffsetY = 2;
                ctx.fillText(tenDuAn, 410, 180);
                ctx.restore();
            }
        }

        // --- IMAGE HANDLING & UPLOADS ---
        function handleFileSelect(e, frameId) {
            const file = e.target.files[0];
            if (!file) return;
            processImageFile(file, frameId);
        }

        function processImageFile(file, frameId) {
            if (!file.type.startsWith('image/')) {
                showToast('Lỗi file', 'Vui lòng chọn file hình ảnh hợp lệ (PNG, JPG, WebP)!', '❌');
                return;
            }

            const reader = new FileReader();
            reader.onload = (event) => {
                const img = new Image();
                img.onload = () => {
                    state.images[frameId] = img;
                    updateThumbnail(frameId, event.target.result);
                    renderCanvas();
                    showToast('Đã chèn ảnh', `Khung ${frameId} (${FRAMES[frameId].name}) đã được cập nhật!`, '✓');
                };
                img.src = event.target.result;
            };
            reader.readAsDataURL(file);
        }

        function updateThumbnail(frameId, src) {
            const thumb = document.getElementById(`preview_thumb_${frameId}`);
            if (thumb) {
                thumb.innerHTML = `<img src="${src}" class="w-full h-full object-cover">`;
            }
        }

        function clearImage(frameId) {
            state.images[frameId] = null;
            const thumb = document.getElementById(`preview_thumb_${frameId}`);
            if (thumb) {
                thumb.innerHTML = `<span class="text-[10px] text-slate-400 font-semibold text-center">Trống</span>`;
            }
            const fileInput = document.getElementById(`file_frame_${frameId}`);
            if (fileInput) fileInput.value = '';
            renderCanvas();
            showToast('Đã xóa', `Đã xóa ảnh ở Khung ${frameId}`, '🗑️');
        }

        function setFitMode(frameId, mode) {
            state.fitModes[frameId] = mode;
            const btnCover = document.getElementById(`fit_btn_${frameId}_cover`);
            const btnContain = document.getElementById(`fit_btn_${frameId}_contain`);
            
            if (mode === 'cover') {
                btnCover.className = 'text-[10px] px-2 py-0.5 rounded font-semibold bg-blue-600 text-white';
                btnContain.className = 'text-[10px] px-2 py-0.5 rounded font-medium bg-slate-200 text-slate-700';
            } else {
                btnCover.className = 'text-[10px] px-2 py-0.5 rounded font-medium bg-slate-200 text-slate-700';
                btnContain.className = 'text-[10px] px-2 py-0.5 rounded font-semibold bg-blue-600 text-white';
            }
            renderCanvas();
        }

        // Paste from clipboard (Win + Shift + S or Copy Image)
        async function pasteFromClipboard(frameId) {
            try {
                const clipboardItems = await navigator.clipboard.read();
                for (const item of clipboardItems) {
                    for (const type of item.types) {
                        if (type.startsWith('image/')) {
                            const blob = await item.getType(type);
                            processImageFile(blob, frameId);
                            return;
                        }
                    }
                }
                showToast('Chưa có ảnh', 'Không tìm thấy ảnh trong bộ nhớ tạm! Bạn hãy chụp màn hình hoặc Copy ảnh trước.', '⚠️');
            } catch (err) {
                showToast('Quyền truy cập', 'Vui lòng nhấn Ctrl + V khi đang nhấp vào khung để dán ảnh!', 'ℹ️');
            }
        }

        // Global Paste Listener (Ctrl + V)
        window.addEventListener('paste', (e) => {
            const items = (e.clipboardData || e.originalEvent.clipboardData).items;
            for (const item of items) {
                if (item.type.indexOf('image') !== -1) {
                    const blob = item.getAsFile();
                    // Auto-target the first empty frame or active hover card
                    let targetFrame = 1;
                    if (!state.images[1]) targetFrame = 1;
                    else if (!state.images[2]) targetFrame = 2;
                    else if (!state.images[3]) targetFrame = 3;
                    else if (!state.images[4]) targetFrame = 4;
                    
                    processImageFile(blob, targetFrame);
                    break;
                }
            }
        });

        // --- DRAG AND DROP ON CARDS ---
        [1, 2, 3, 4].forEach(id => {
            const card = document.getElementById(`card_frame_${id}`);
            if (!card) return;

            card.addEventListener('dragover', (e) => {
                e.preventDefault();
                card.classList.add('ring-2', 'ring-blue-500', 'bg-blue-50/50');
            });
            card.addEventListener('dragleave', () => {
                card.classList.remove('ring-2', 'ring-blue-500', 'bg-blue-50/50');
            });
            card.addEventListener('drop', (e) => {
                e.preventDefault();
                card.classList.remove('ring-2', 'ring-blue-500', 'bg-blue-50/50');
                if (e.dataTransfer.files && e.dataTransfer.files[0]) {
                    processImageFile(e.dataTransfer.files[0], id);
                }
            });
        });

        // --- EXPORT FUNCTIONS ---
        function downloadImage(format = 'png') {
            const maCan = document.getElementById('input_ma_can').value.trim() || 'chi-can';
            const cleanName = maCan.replace(/[^a-zA-Z0-9_-]/g, '_');
            const link = document.createElement('a');

            if (format === 'jpg' || format === 'jpeg') {
                link.download = `Phieu-Chi-Can-${cleanName}.jpg`;
                link.href = canvas.toDataURL('image/jpeg', 0.95);
            } else {
                link.download = `Phieu-Chi-Can-${cleanName}.png`;
                link.href = canvas.toDataURL('image/png');
            }
            link.click();
            showToast('Đã tải xuống', `Ảnh ${format.toUpperCase()} độ nét cao đã tải về máy!`, '📥');
        }

        async function copyImageToClipboard() {
            try {
                canvas.toBlob(async (blob) => {
                    if (!blob) {
                        showToast('Lỗi', 'Không thể tạo dữ liệu ảnh!', '❌');
                        return;
                    }
                    try {
                        await navigator.clipboard.write([
                            new ClipboardItem({ 'image/png': blob })
                        ]);
                        showToast('Đã sao chép ảnh!', 'Bạn chỉ cần mở Zalo và nhấn Ctrl + V để gửi cho khách ngay!', '📋');
                    } catch (err) {
                        // Fallback: download instead
                        downloadImage('png');
                        showToast('Tự động tải về', 'Trình duyệt chưa cấp quyền dán trực tiếp, ảnh đã được tải về máy!', '📥');
                    }
                }, 'image/png');
            } catch (err) {
                showToast('Thông báo', 'Vui lòng sử dụng nút Tải Ảnh PNG!', 'ℹ️');
            }
        }

        function resetAllDefaults() {
            if (!confirm('Bạn có chắc muốn đặt lại toàn bộ thông số và xóa các ảnh đã chèn?')) return;
            
            document.getElementById('input_ma_can').value = 'ST.36.18';
            document.getElementById('input_loai_can').value = '2PN + 1, 2WC';
            document.getElementById('input_dien_tich').value = '72.8 m²';
            document.getElementById('input_huong_bc').value = 'Đông Nam';
            document.getElementById('input_gia_niem_yet').value = '4.250.000.000 đ';
            document.getElementById('input_ten_du_an').value = 'IMPERIA SKY PARK';
            document.getElementById('input_tieu_de_phu').value = 'THÔNG TIN CHI TIẾT CĂN';

            for (let i = 1; i <= 4; i++) {
                clearImage(i);
            }
            renderCanvas();
            showToast('Đã đặt lại', 'Đã khôi phục thông số mặc định ban đầu.', '🔄');
        }

        function toggleAdvancedOptions() {
            const el = document.getElementById('adv_options');
            const icon = document.getElementById('adv_chevron');
            if (el.classList.contains('hidden')) {
                el.classList.remove('hidden');
                icon.classList.add('rotate-180');
            } else {
                el.classList.add('hidden');
                icon.classList.remove('rotate-180');
            }
        }

        // Toast feedback popup
        let toastTimeout = null;
        function showToast(title, msg, icon = '✓') {
            const toast = document.getElementById('toast');
            document.getElementById('toast_title').textContent = title;
            document.getElementById('toast_msg').textContent = msg;
            document.getElementById('toast_icon').textContent = icon;

            toast.classList.remove('translate-y-24', 'opacity-0');
            toast.classList.add('translate-y-0', 'opacity-100');

            if (toastTimeout) clearTimeout(toastTimeout);
            toastTimeout = setTimeout(() => {
                toast.classList.remove('translate-y-0', 'opacity-100');
                toast.classList.add('translate-y-24', 'opacity-0');
            }, 3500);
        }
    </script>
</body>
</html>
