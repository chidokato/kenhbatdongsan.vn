<?php
/**
 * Tool Tạo Phiếu Chỉ Căn BĐS - Kênh Bất Động Sản
 * Tích hợp chuẩn giao diện Header & Footer của Website kenhbatdongsan.vn
 */

// Nạp môi trường WordPress
require_once __DIR__ . '/../../wp-load.php';

// Nạp Header chuẩn của Website (Bao gồm Menu Kênh BĐS, Logo, Hotline, Zalo)
get_header();
?>

<!-- Scoped CSS for Chi Can Tool -->
<style>
.chi-can-tool-root {
    background-color: #f1f5f9;
    padding: 30px 15px 50px;
    font-family: 'Montserrat', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
    color: #1e293b;
}
.chi-can-tool-container {
    max-width: 1320px;
    margin: 0 auto;
}
.chi-can-badge-pulse {
    display: inline-block;
    width: 8px;
    height: 8px;
    border-radius: 50%;
    background-color: #10b981;
    box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.7);
    animation: chiCanPulse 1.8s infinite;
}
@keyframes chiCanPulse {
    0% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.7); }
    70% { transform: scale(1); box-shadow: 0 0 0 8px rgba(16, 185, 129, 0); }
    100% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(16, 185, 129, 0); }
}
.chi-can-card {
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 16px;
    padding: 22px;
    box-shadow: 0 4px 14px rgba(0, 0, 0, 0.04);
    margin-bottom: 24px;
}
.chi-can-card-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding-bottom: 14px;
    border-bottom: 1px solid #f1f5f9;
    margin-bottom: 18px;
}
.chi-can-title {
    font-size: 15px;
    font-weight: 700;
    color: #0b2b5e;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    display: flex;
    align-items: center;
    gap: 8px;
}
.chi-can-num {
    width: 26px;
    height: 26px;
    border-radius: 8px;
    background: #0b2b5e;
    color: #ffffff;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 13px;
    font-weight: 800;
}
.chi-can-frame-card {
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    border-radius: 12px;
    padding: 14px;
    margin-bottom: 14px;
    transition: all 0.2s ease;
}
.chi-can-frame-card:hover {
    border-color: #3b82f6;
    background: #f0f7ff;
}
.chi-can-btn-primary {
    background: #0b2b5e;
    color: #ffffff !important;
    padding: 10px 18px;
    font-weight: 700;
    font-size: 13px;
    border-radius: 10px;
    border: none;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    transition: all 0.2s;
    text-decoration: none;
}
.chi-can-btn-primary:hover {
    background: #1956a6;
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(11, 43, 94, 0.25);
}
.chi-can-btn-success {
    background: #059669;
    color: #ffffff !important;
    padding: 10px 18px;
    font-weight: 700;
    font-size: 13px;
    border-radius: 10px;
    border: none;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    transition: all 0.2s;
    text-decoration: none;
}
.chi-can-btn-success:hover {
    background: #047857;
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(5, 150, 105, 0.25);
}
.chi-can-btn-sm {
    padding: 4px 10px;
    font-size: 11px;
    font-weight: 600;
    border-radius: 6px;
    border: 1px solid #cbd5e1;
    background: #ffffff;
    cursor: pointer;
    transition: all 0.15s;
}
.chi-can-btn-sm.active {
    background: #0b2b5e;
    color: #ffffff;
    border-color: #0b2b5e;
}
.chi-can-btn-sm:hover:not(.active) {
    background: #e2e8f0;
}
.chi-can-canvas-wrap {
    background: #e2e8f0;
    background-image: radial-gradient(#cbd5e1 1.5px, transparent 1.5px);
    background-size: 16px 16px;
    padding: 24px;
    border-radius: 16px;
    display: flex;
    justify-content: center;
    align-items: center;
    border: 1px solid #cbd5e1;
    max-height: 840px;
    overflow: auto;
}
#posterCanvas {
    max-width: 100%;
    height: auto;
    border-radius: 8px;
    box-shadow: 0 12px 36px rgba(0,0,0,0.18);
    background: #fff;
}
.chi-can-input {
    width: 100%;
    padding: 8px 12px;
    font-size: 13px;
    font-weight: 600;
    border: 1px solid #cbd5e1;
    border-radius: 8px;
    outline: none;
    transition: border-color 0.2s;
    box-sizing: border-box;
    background: #fff;
}
.chi-can-input:focus {
    border-color: #2563eb;
    box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
}
.chi-can-grid {
    display: grid;
    grid-template-columns: 1fr;
    gap: 28px;
}
@media (min-width: 1024px) {
    .chi-can-grid {
        grid-template-columns: 5fr 7fr;
    }
}
</style>

<div class="chi-can-tool-root">
    <div class="chi-can-tool-container">
        
        <!-- Breadcrumbs & Quick Project Switcher -->
        <div style="display: flex; flex-wrap: wrap; align-items: center; justify-content: space-between; margin-bottom: 20px; gap: 12px;">
            <div style="font-size: 13px; color: #64748b; font-weight: 500;">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" style="color: #64748b; text-decoration: none;">Trang chủ</a>
                <span style="margin: 0 6px;">/</span>
                <span style="color: #0b2b5e; font-weight: 700;">Chỉ Căn BĐS</span>
                <span style="margin: 0 6px;">/</span>
                <span style="color: #2563eb; font-weight: 700;">Imperia Sky Park</span>
            </div>

            <!-- Action buttons -->
            <div style="display: flex; align-items: center; gap: 10px;">
                <button type="button" onclick="resetAllDefaults()" class="chi-can-btn-sm" style="padding: 8px 14px; font-weight: 600;">
                    🔄 Làm Mới
                </button>
                <button type="button" onclick="copyImageToClipboard()" class="chi-can-btn-success">
                    📋 Sao Chép (Gửi Zalo)
                </button>
                <button type="button" onclick="downloadImage('png')" class="chi-can-btn-primary">
                    📥 Tải Ảnh PNG Nét Cao
                </button>
            </div>
        </div>

        <div class="chi-can-grid">
            
            <!-- LEFT COLUMN: CONTROLS & INPUTS -->
            <div>

                <!-- 1. THÔNG SỐ CĂN HỘ (KHU VỰC KHOANH ĐỎ) -->
                <div class="chi-can-card">
                    <div class="chi-can-card-header">
                        <div class="chi-can-title">
                            <span class="chi-can-num">1</span>
                            <span>Số Liệu Căn Hộ (Khu Vực Đỏ)</span>
                        </div>
                        <span style="font-size: 11px; font-weight: 700; color: #059669; background: #ecfdf5; padding: 4px 10px; border-radius: 20px; border: 1px solid #a7f3d0; display: flex; align-items: center; gap: 6px;">
                            <span class="chi-can-badge-pulse"></span> Tự Động Cập Nhật
                        </span>
                    </div>

                    <div style="display: flex; flex-direction: column; gap: 14px;">
                        
                        <!-- Mã Căn (Tiêu đề bảng) -->
                        <div style="background: #eff6ff; border: 1px solid #bfdbfe; border-radius: 12px; padding: 14px;">
                            <label style="display: flex; justify-content: space-between; font-size: 12px; font-weight: 800; color: #0b2b5e; margin-bottom: 6px;">
                                <span>MÃ CĂN (TIÊU ĐỀ BẢNG)</span>
                                <span style="font-size: 11px; color: #2563eb; font-weight: 600;">Chữ in đậm, căn giữa</span>
                            </label>
                            <input type="text" id="input_ma_can" value="ST.36.18" oninput="renderCanvas()" 
                                   class="chi-can-input" style="font-size: 16px; font-weight: 900; color: #0b2b5e; letter-spacing: 0.5px;" 
                                   placeholder="VD: ST.36.18, VKP-08.15...">
                        </div>

                        <!-- 4 Dòng thông số -->
                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 12px;">
                            <div>
                                <label style="display: block; font-size: 12px; font-weight: 700; color: #334155; margin-bottom: 4px;">Loại Căn</label>
                                <input type="text" id="input_loai_can" value="2PN + 1, 2WC" oninput="renderCanvas()" class="chi-can-input">
                            </div>
                            <div>
                                <label style="display: block; font-size: 12px; font-weight: 700; color: #334155; margin-bottom: 4px;">Diện Tích Thông Thủy</label>
                                <input type="text" id="input_dien_tich" value="72.8 m²" oninput="renderCanvas()" class="chi-can-input">
                            </div>
                            <div>
                                <label style="display: block; font-size: 12px; font-weight: 700; color: #334155; margin-bottom: 4px;">Hướng Ban Công (BC)</label>
                                <input type="text" id="input_huong_bc" value="Đông Nam" oninput="renderCanvas()" class="chi-can-input">
                            </div>
                            <div>
                                <label style="display: flex; justify-content: space-between; font-size: 12px; font-weight: 700; color: #b45309; margin-bottom: 4px;">
                                    <span>Giá Niêm Yết</span>
                                    <span style="font-size: 10px; font-weight: 800; color: #d97706;">Nổi bật vàng</span>
                                </label>
                                <input type="text" id="input_gia_niem_yet" value="4.250.000.000 đ" oninput="renderCanvas()" 
                                       class="chi-can-input" style="border-color: #fcd34d; background: #fffbeb; color: #b45309; font-weight: 800;">
                            </div>
                        </div>

                        <!-- Tùy chọn nâng cao (Đổi tên dự án nếu cần) -->
                        <div>
                            <button type="button" onclick="toggleAdvancedOptions()" style="background: none; border: none; font-size: 12px; color: #2563eb; font-weight: 700; cursor: pointer; padding: 0; display: inline-flex; align-items: center; gap: 4px;">
                                <span id="adv_icon">▼</span>
                                <span>Tùy chọn: Thay tên Dự Án khác (Mặc định: IMPERIA SKY PARK)</span>
                            </button>
                            <div id="adv_options" style="display: none; margin-top: 10px; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 10px; padding: 12px;">
                                <div style="margin-bottom: 8px;">
                                    <label style="display: block; font-size: 11px; font-weight: 700; color: #64748b; margin-bottom: 3px;">Tên Dự Án</label>
                                    <input type="text" id="input_ten_du_an" value="IMPERIA SKY PARK" oninput="renderCanvas()" class="chi-can-input">
                                </div>
                                <div>
                                    <label style="display: block; font-size: 11px; font-weight: 700; color: #64748b; margin-bottom: 3px;">Dòng Tiêu Đề Phụ</label>
                                    <input type="text" id="input_tieu_de_phu" value="THÔNG TIN CHI TIẾT CĂN" oninput="renderCanvas()" class="chi-can-input">
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- 2. BỐN KHUNG CHÈN ẢNH (LẤP ĐẦY KHÔNG KHOẢNG TRẮNG) -->
                <div class="chi-can-card">
                    <div class="chi-can-card-header">
                        <div class="chi-can-title">
                            <span class="chi-can-num">2</span>
                            <span>Thay 4 Khung Ảnh (Lấp Đầy 100% Khung)</span>
                        </div>
                        <span style="font-size: 11px; color: #2563eb; font-weight: 600;">Không còn khoảng trắng</span>
                    </div>

                    <div>
                        <!-- Khung 1: Ảnh Dự Án -->
                        <div class="chi-can-frame-card" id="card_frame_1">
                            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px;">
                                <span style="font-size: 12px; font-weight: 800; color: #0b2b5e;">1. Ảnh Phối Cảnh Dự Án (Khung trên trái)</span>
                                <div style="display: flex; align-items: center; gap: 4px;">
                                    <button type="button" onclick="setFitMode(1, 'cover')" id="fit_btn_1_cover" class="chi-can-btn-sm active">Lấp đầy</button>
                                    <button type="button" onclick="setFitMode(1, 'contain')" id="fit_btn_1_contain" class="chi-can-btn-sm">Vừa vặn</button>
                                    <button type="button" onclick="clearImage(1)" class="chi-can-btn-sm" style="color: #ef4444; border-color: #fca5a5;">Xóa</button>
                                </div>
                            </div>
                            <div style="display: flex; gap: 12px; align-items: center;">
                                <div id="preview_thumb_1" style="width: 64px; height: 52px; background: #e2e8f0; border-radius: 8px; overflow: hidden; display: flex; align-items: center; justify-content: center; flex-shrink: 0; font-size: 10px; color: #94a3b8; font-weight: 700;">Trống</div>
                                <div style="flex: 1;">
                                    <input type="file" id="file_frame_1" accept="image/*" onchange="handleFileSelect(event, 1)" style="display: none;">
                                    <div style="display: flex; gap: 8px;">
                                        <button type="button" onclick="document.getElementById('file_frame_1').click()" class="chi-can-btn-sm" style="flex: 1; padding: 7px 10px; font-weight: 700;">📁 Chọn Ảnh</button>
                                        <button type="button" onclick="pasteFromClipboard(1)" class="chi-can-btn-sm" style="padding: 7px 12px; font-weight: 700; color: #2563eb; background: #eff6ff; border-color: #bfdbfe;" title="Dán ảnh đã chụp (Ctrl+V)">📋 Dán</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Khung 2: Mặt Bằng Tầng -->
                        <div class="chi-can-frame-card" id="card_frame_2">
                            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px;">
                                <span style="font-size: 12px; font-weight: 800; color: #0b2b5e;">2. Mặt Bằng Tầng (Khung giữa rộng)</span>
                                <div style="display: flex; align-items: center; gap: 4px;">
                                    <button type="button" onclick="setFitMode(2, 'cover')" id="fit_btn_2_cover" class="chi-can-btn-sm active">Lấp đầy (Hết trắng)</button>
                                    <button type="button" onclick="setFitMode(2, 'contain')" id="fit_btn_2_contain" class="chi-can-btn-sm">Vừa vặn</button>
                                    <button type="button" onclick="clearImage(2)" class="chi-can-btn-sm" style="color: #ef4444; border-color: #fca5a5;">Xóa</button>
                                </div>
                            </div>
                            <div style="display: flex; gap: 12px; align-items: center;">
                                <div id="preview_thumb_2" style="width: 64px; height: 52px; background: #e2e8f0; border-radius: 8px; overflow: hidden; display: flex; align-items: center; justify-content: center; flex-shrink: 0; font-size: 10px; color: #94a3b8; font-weight: 700;">Trống</div>
                                <div style="flex: 1;">
                                    <input type="file" id="file_frame_2" accept="image/*" onchange="handleFileSelect(event, 2)" style="display: none;">
                                    <div style="display: flex; gap: 8px;">
                                        <button type="button" onclick="document.getElementById('file_frame_2').click()" class="chi-can-btn-sm" style="flex: 1; padding: 7px 10px; font-weight: 700;">📁 Chọn Ảnh</button>
                                        <button type="button" onclick="pasteFromClipboard(2)" class="chi-can-btn-sm" style="padding: 7px 12px; font-weight: 700; color: #2563eb; background: #eff6ff; border-color: #bfdbfe;" title="Dán ảnh đã chụp (Ctrl+V)">📋 Dán</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Khung 3: Layout Căn Hộ -->
                        <div class="chi-can-frame-card" id="card_frame_3">
                            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px;">
                                <span style="font-size: 12px; font-weight: 800; color: #0b2b5e;">3. Layout Căn Hộ (Khung dưới trái)</span>
                                <div style="display: flex; align-items: center; gap: 4px;">
                                    <button type="button" onclick="setFitMode(3, 'cover')" id="fit_btn_3_cover" class="chi-can-btn-sm active">Lấp đầy (Hết trắng)</button>
                                    <button type="button" onclick="setFitMode(3, 'contain')" id="fit_btn_3_contain" class="chi-can-btn-sm">Vừa vặn</button>
                                    <button type="button" onclick="clearImage(3)" class="chi-can-btn-sm" style="color: #ef4444; border-color: #fca5a5;">Xóa</button>
                                </div>
                            </div>
                            <div style="display: flex; gap: 12px; align-items: center;">
                                <div id="preview_thumb_3" style="width: 64px; height: 52px; background: #e2e8f0; border-radius: 8px; overflow: hidden; display: flex; align-items: center; justify-content: center; flex-shrink: 0; font-size: 10px; color: #94a3b8; font-weight: 700;">Trống</div>
                                <div style="flex: 1;">
                                    <input type="file" id="file_frame_3" accept="image/*" onchange="handleFileSelect(event, 3)" style="display: none;">
                                    <div style="display: flex; gap: 8px;">
                                        <button type="button" onclick="document.getElementById('file_frame_3').click()" class="chi-can-btn-sm" style="flex: 1; padding: 7px 10px; font-weight: 700;">📁 Chọn Ảnh</button>
                                        <button type="button" onclick="pasteFromClipboard(3)" class="chi-can-btn-sm" style="padding: 7px 12px; font-weight: 700; color: #2563eb; background: #eff6ff; border-color: #bfdbfe;" title="Dán ảnh đã chụp (Ctrl+V)">📋 Dán</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Khung 4: Ảnh Tiện Ích -->
                        <div class="chi-can-frame-card" id="card_frame_4">
                            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px;">
                                <span style="font-size: 12px; font-weight: 800; color: #0b2b5e;">4. Ảnh Tiện Ích (Khung dưới phải)</span>
                                <div style="display: flex; align-items: center; gap: 4px;">
                                    <button type="button" onclick="setFitMode(4, 'cover')" id="fit_btn_4_cover" class="chi-can-btn-sm active">Lấp đầy (Hết trắng)</button>
                                    <button type="button" onclick="setFitMode(4, 'contain')" id="fit_btn_4_contain" class="chi-can-btn-sm">Vừa vặn</button>
                                    <button type="button" onclick="clearImage(4)" class="chi-can-btn-sm" style="color: #ef4444; border-color: #fca5a5;">Xóa</button>
                                </div>
                            </div>
                            <div style="display: flex; gap: 12px; align-items: center;">
                                <div id="preview_thumb_4" style="width: 64px; height: 52px; background: #e2e8f0; border-radius: 8px; overflow: hidden; display: flex; align-items: center; justify-content: center; flex-shrink: 0; font-size: 10px; color: #94a3b8; font-weight: 700;">Trống</div>
                                <div style="flex: 1;">
                                    <input type="file" id="file_frame_4" accept="image/*" onchange="handleFileSelect(event, 4)" style="display: none;">
                                    <div style="display: flex; gap: 8px;">
                                        <button type="button" onclick="document.getElementById('file_frame_4').click()" class="chi-can-btn-sm" style="flex: 1; padding: 7px 10px; font-weight: 700;">📁 Chọn Ảnh</button>
                                        <button type="button" onclick="pasteFromClipboard(4)" class="chi-can-btn-sm" style="padding: 7px 12px; font-weight: 700; color: #2563eb; background: #eff6ff; border-color: #bfdbfe;" title="Dán ảnh đã chụp (Ctrl+V)">📋 Dán</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>

            <!-- RIGHT COLUMN: LIVE CANVAS PREVIEW -->
            <div style="position: sticky; top: 120px;">
                <div class="chi-can-card">
                    <div class="chi-can-card-header">
                        <div class="chi-can-title">
                            <span class="chi-can-badge-pulse"></span>
                            <span>Xem Trước Phiếu Chỉ Căn (819 × 1024 px)</span>
                        </div>
                        <div style="display: flex; gap: 8px;">
                            <button type="button" onclick="downloadImage('png')" class="chi-can-btn-sm" style="background: #eff6ff; color: #1d4ed8; font-weight: 700; border-color: #bfdbfe;">
                                📥 Tải PNG
                            </button>
                            <button type="button" onclick="downloadImage('jpg')" class="chi-can-btn-sm" style="font-weight: 600;">
                                📥 JPG
                            </button>
                        </div>
                    </div>

                    <!-- Canvas Container -->
                    <div class="chi-can-canvas-wrap">
                        <canvas id="posterCanvas" width="819" height="1024"></canvas>
                    </div>

                    <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 14px; padding-top: 12px; border-top: 1px solid #f1f5f9;">
                        <span style="font-size: 12px; color: #64748b;">
                            ⚡ Ảnh tự động khớp 100% khung không khoảng trắng
                        </span>
                        <button type="button" onclick="copyImageToClipboard()" class="chi-can-btn-success" style="padding: 8px 16px; font-size: 12px;">
                            📋 Sao Chép (Gửi Zalo Ngay)
                        </button>
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>

<!-- Toast Popup -->
<div id="chi_can_toast" style="position: fixed; bottom: 24px; right: 24px; z-index: 999999; transform: translateY(120px); opacity: 0; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); pointer-events: none;">
    <div style="background: #0f172a; color: #fff; padding: 12px 20px; border-radius: 12px; box-shadow: 0 10px 30px rgba(0,0,0,0.3); display: flex; align-items: center; gap: 12px; border: 1px solid #334155;">
        <span id="toast_icon" style="font-size: 20px; color: #34d399;">✓</span>
        <div>
            <div id="toast_title" style="font-size: 12px; font-weight: 800;">Thông báo</div>
            <div id="toast_msg" style="font-size: 11px; color: #cbd5e1;">Nội dung</div>
        </div>
    </div>
</div>

<script>
    // --- EXACT FRAME COORDINATES (CĂN CHUẨN TRÀN VIỀN 100% KHÔNG KHOẢNG TRẮNG) ---
    const CANVAS_WIDTH = 819;
    const CANVAS_HEIGHT = 1024;

    // Tọa độ chuẩn xác khớp khít tuyệt đối với mép phôi 819x1024 (radius 10px chống lẹm góc):
    const FRAMES = {
        1: { x: 35,  y: 213, w: 281, h: 230, radius: 10, name: 'Ảnh Dự Án' },
        2: { x: 34,  y: 451, w: 751, h: 270, radius: 12, name: 'Mặt Bằng Tầng' },
        3: { x: 34,  y: 730, w: 460, h: 270, radius: 12, name: 'Layout Căn Hộ' },
        4: { x: 503, y: 730, w: 282, h: 270, radius: 12, name: 'Ảnh Tiện Ích' }
    };

    const TABLE = {
        header: {
            cover_x: 420, cover_y: 215, cover_w: 355, cover_h: 46,
            color: '#0B2B5E',
            text_center_x: 595,
            text_center_y: 238
        },
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

    // MẶC ĐỊNH TẤT CẢ 4 KHUNG ĐỀU Ở CHẾ ĐỘ 'COVER' (LẤP ĐẦY TRÀN VIỀN - HẾT TRẮNG)
    const state = {
        images: { 1: null, 2: null, 3: null, 4: null },
        fitModes: { 1: 'cover', 2: 'cover', 3: 'cover', 4: 'cover' }
    };

    const canvas = document.getElementById('posterCanvas');
    const ctx = canvas.getContext('2d');
    const baseImage = new Image();
    baseImage.crossOrigin = 'anonymous';
    baseImage.src = '<?php echo esc_url( home_url( '/tools/chi-can/assets/template-chi-can.jpg' ) ); ?>';

    baseImage.onload = () => {
        renderCanvas();
    };

    // Tạo đường dẫn bo góc chính xác
    function createRoundedPath(ctx, x, y, width, height, radius) {
        ctx.beginPath();
        if (typeof ctx.roundRect === 'function') {
            ctx.roundRect(x, y, width, height, radius);
        } else {
            ctx.moveTo(x + radius, y);
            ctx.lineTo(x + width - radius, y);
            ctx.quadraticCurveTo(x + width, y, x + width, y + radius);
            ctx.lineTo(x + width, y + height - radius);
            ctx.quadraticCurveTo(x + width, y + height, x + width - radius, y + height);
            ctx.lineTo(x + radius, y + height);
            ctx.quadraticCurveTo(x, y + height, x, y + height - radius);
            ctx.lineTo(x, y + radius);
            ctx.quadraticCurveTo(x, y, x + radius, y);
        }
        ctx.closePath();
    }

    // Vẽ ảnh vào khung với cơ chế FULL BLEED (LẤP ĐẦY KHÔNG CÒN KHOẢNG TRẮNG)
    function drawFramedImage(frameId, img, mode) {
        const frame = FRAMES[frameId];
        if (!img || !frame) return;

        ctx.save();
        
        // Tạo mặt nạ cắt bo góc chuẩn
        createRoundedPath(ctx, frame.x, frame.y, frame.w, frame.h, frame.radius);
        ctx.clip();

        let drawW, drawH, drawX, drawY;

        if (mode === 'cover') {
            // LẤP ĐẦY 100% TOÀN BỘ KHUNG (Scale theo cạnh lớn hơn -> Đảm bảo ZERO khoảng trắng)
            const scale = Math.max(frame.w / img.width, frame.h / img.height);
            drawW = img.width * scale;
            drawH = img.height * scale;
            drawX = frame.x + (frame.w - drawW) / 2;
            drawY = frame.y + (frame.h - drawH) / 2;
        } else {
            // Vừa vặn (Contain - hiển thị trọn vẹn toàn bộ hình)
            ctx.fillStyle = '#FFFFFF';
            ctx.fillRect(frame.x, frame.y, frame.w, frame.h);

            const scale = Math.min(frame.w / img.width, frame.h / img.height);
            drawW = img.width * scale;
            drawH = img.height * scale;
            drawX = frame.x + (frame.w - drawW) / 2;
            drawY = frame.y + (frame.h - drawH) / 2;
        }

        ctx.drawImage(img, drawX, drawY, drawW, drawH);
        ctx.restore();
    }

    // HÀM RENDER CANVAS LIVE PREVIEW
    function renderCanvas() {
        if (!baseImage.complete) return;

        // 1. Vẽ phôi gốc
        ctx.drawImage(baseImage, 0, 0, CANVAS_WIDTH, CANVAS_HEIGHT);

        // 2. Vẽ 4 khung ảnh (Full-bleed không khoảng trắng)
        for (let id = 1; id <= 4; id++) {
            if (state.images[id]) {
                drawFramedImage(id, state.images[id], state.fitModes[id]);
            }
        }

        // 3. THAY THẾ SỐ LIỆU KHU VỰC KHOANH ĐỎ
        
        // 3A. Tiêu đề Mã Căn
        const maCanText = document.getElementById('input_ma_can').value.trim();
        ctx.fillStyle = TABLE.header.color;
        ctx.fillRect(TABLE.header.cover_x, TABLE.header.cover_y, TABLE.header.cover_w, TABLE.header.cover_h);

        if (maCanText) {
            ctx.save();
            ctx.fillStyle = '#FFFFFF';
            ctx.font = '900 24px Montserrat, sans-serif';
            ctx.textAlign = 'center';
            ctx.textBaseline = 'middle';
            ctx.shadowColor = 'rgba(0,0,0,0.35)';
            ctx.shadowBlur = 4;
            ctx.shadowOffsetY = 1;
            ctx.fillText(maCanText, TABLE.header.text_center_x, TABLE.header.text_center_y);
            ctx.restore();
        }

        // 3B. 4 Dòng Thông Số Trong Bảng
        const rowValues = {
            loai_can: document.getElementById('input_loai_can').value.trim(),
            dien_tich: document.getElementById('input_dien_tich').value.trim(),
            huong_bc: document.getElementById('input_huong_bc').value.trim(),
            gia_niem_yet: document.getElementById('input_gia_niem_yet').value.trim()
        };

        TABLE.rows.forEach(row => {
            ctx.fillStyle = row.color;
            ctx.fillRect(TABLE.val_col_x, row.y, TABLE.val_col_w, row.h);

            const text = rowValues[row.id];
            if (text) {
                ctx.save();
                if (row.is_gold) {
                    ctx.fillStyle = '#FFEAA7';
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

        // 3C. Tùy Chọn Tên Dự Án Khác
        const tenDuAn = document.getElementById('input_ten_du_an').value.trim();
        const tieuDePhu = document.getElementById('input_tieu_de_phu').value.trim();
        
        if (tenDuAn && tenDuAn !== 'IMPERIA SKY PARK') {
            ctx.save();
            const grad = ctx.createLinearGradient(150, 110, 150, 205);
            grad.addColorStop(0, '#042255');
            grad.addColorStop(1, '#083B80');
            ctx.fillStyle = grad;
            ctx.fillRect(150, 110, 520, 95);

            ctx.fillStyle = '#FFFFFF';
            ctx.font = '700 18px Montserrat, sans-serif';
            ctx.textAlign = 'center';
            ctx.textBaseline = 'middle';
            ctx.fillText(tieuDePhu || 'THÔNG TIN CHI TIẾT CĂN', 410, 138);

            ctx.fillStyle = '#FFFFFF';
            ctx.font = '900 36px Montserrat, sans-serif';
            ctx.shadowColor = 'rgba(0,0,0,0.5)';
            ctx.shadowBlur = 8;
            ctx.shadowOffsetY = 2;
            ctx.fillText(tenDuAn, 410, 180);
            ctx.restore();
        }
    }

    // --- UPLOAD & PASTE ---
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
                showToast('Đã chèn ảnh', `Khung ${frameId} (${FRAMES[frameId].name}) đã lấp đầy hoàn hảo!`, '✓');
            };
            img.src = event.target.result;
        };
        reader.readAsDataURL(file);
    }

    function updateThumbnail(frameId, src) {
        const thumb = document.getElementById(`preview_thumb_${frameId}`);
        if (thumb) {
            thumb.innerHTML = `<img src="${src}" style="width: 100%; height: 100%; object-fit: cover;">`;
        }
    }

    function clearImage(frameId) {
        state.images[frameId] = null;
        const thumb = document.getElementById(`preview_thumb_${frameId}`);
        if (thumb) {
            thumb.innerHTML = 'Trống';
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
            btnCover.classList.add('active');
            btnContain.classList.remove('active');
        } else {
            btnCover.classList.remove('active');
            btnContain.classList.add('active');
        }
        renderCanvas();
    }

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
            showToast('Chưa có ảnh', 'Không tìm thấy ảnh trong clipboard! Nhấn Win + Shift + S chụp ảnh trước.', '⚠️');
        } catch (err) {
            showToast('Quyền truy cập', 'Vui lòng nhấn Ctrl + V để dán ảnh trực tiếp!', 'ℹ️');
        }
    }

    // Ctrl + V listener
    window.addEventListener('paste', (e) => {
        const items = (e.clipboardData || e.originalEvent.clipboardData).items;
        for (const item of items) {
            if (item.type.indexOf('image') !== -1) {
                const blob = item.getAsFile();
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

    // Drag & Drop
    [1, 2, 3, 4].forEach(id => {
        const card = document.getElementById(`card_frame_${id}`);
        if (!card) return;

        card.addEventListener('dragover', (e) => {
            e.preventDefault();
            card.style.borderColor = '#2563eb';
            card.style.background = '#eff6ff';
        });
        card.addEventListener('dragleave', () => {
            card.style.borderColor = '#e2e8f0';
            card.style.background = '#f8fafc';
        });
        card.addEventListener('drop', (e) => {
            e.preventDefault();
            card.style.borderColor = '#e2e8f0';
            card.style.background = '#f8fafc';
            if (e.dataTransfer.files && e.dataTransfer.files[0]) {
                processImageFile(e.dataTransfer.files[0], id);
            }
        });
    });

    // --- XUẤT ẢNH ---
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
                    downloadImage('png');
                    showToast('Tự động tải về', 'Trình duyệt chưa cấp quyền dán, ảnh đã tự tải về máy!', '📥');
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
            setFitMode(i, 'cover');
        }
        renderCanvas();
        showToast('Đã đặt lại', 'Đã khôi phục thông số mặc định ban đầu.', '🔄');
    }

    function toggleAdvancedOptions() {
        const el = document.getElementById('adv_options');
        const icon = document.getElementById('adv_icon');
        if (el.style.display === 'none') {
            el.style.display = 'block';
            icon.textContent = '▲';
        } else {
            el.style.display = 'none';
            icon.textContent = '▼';
        }
    }

    let toastTimeout = null;
    function showToast(title, msg, icon = '✓') {
        const toast = document.getElementById('chi_can_toast');
        document.getElementById('toast_title').textContent = title;
        document.getElementById('toast_msg').textContent = msg;
        document.getElementById('toast_icon').textContent = icon;

        toast.style.transform = 'translateY(0)';
        toast.style.opacity = '1';

        if (toastTimeout) clearTimeout(toastTimeout);
        toastTimeout = setTimeout(() => {
            toast.style.transform = 'translateY(120px)';
            toast.style.opacity = '0';
        }, 3500);
    }
</script>

<?php
// Nạp Footer chuẩn của Website
get_footer();
?>
