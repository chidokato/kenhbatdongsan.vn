<?php
define('WP_USE_THEMES', false);
require_once __DIR__ . '/../wp-load.php';

$nonce = wp_create_nonce('kbds_submit_lead');

$html = '<!-- wp:html -->
<div class="kbds-sidebar-lead-card" style="background:#FFFFFF;border:1.5px solid #E5C158;border-radius:14px;padding:20px 16px;box-shadow:0 8px 24px rgba(11,44,77,0.09);margin-bottom:24px;box-sizing:border-box;">
    <div style="display:inline-block;background:#FDF8EC;color:#9A7312;border:1px solid #E5C158;padding:3px 10px;border-radius:99px;font-size:11px;font-weight:700;margin-bottom:8px;letter-spacing:0.3px;">
        ⚡ TẢI BẢNG GIÁ GỐC CĐT
    </div>
    <h3 style="color:#0B2C4D;font-size:18px;font-weight:800;margin:0 0 6px;line-height:1.35;">Đăng Ký Nhận Bảng Giá</h3>
    <p style="color:#64748B;font-size:12.5px;line-height:1.45;margin:0 0 14px;">Chuyên viên Kênh BĐS gửi trực tiếp trọn bộ tài liệu nét cao qua Zalo trong 3 phút:</p>

    <form method="post" style="margin:0;">
        <input type="hidden" name="kbds_lead_nonce" value="' . esc_attr($nonce) . '" />
        <input type="hidden" name="kbds_project" value="Tư vấn Kênh BĐS" />
        <input type="hidden" name="kbds_source_url" class="kbds-source-url-input" value="" />
        <input type="hidden" name="kbds_source_title" value="" />
        <input type="hidden" name="kbds_source_type" value="Sidebar" />

        <div style="margin-bottom:10px;">
            <input type="text" name="kbds_name" required placeholder="Họ và tên Quý khách *" style="width:100% !important;height:42px !important;margin:0 !important;padding:0 12px !important;border-radius:8px !important;border:1.5px solid #CBD5E1 !important;background:#F8FAFC !important;color:#0F172A !important;font-size:13.5px !important;box-sizing:border-box !important;display:block !important;" />
        </div>
        <div style="margin-bottom:10px;">
            <input type="tel" name="kbds_phone" required placeholder="Số điện thoại / Zalo *" style="width:100% !important;height:42px !important;margin:0 !important;padding:0 12px !important;border-radius:8px !important;border:1.5px solid #CBD5E1 !important;background:#F8FAFC !important;color:#0F172A !important;font-size:13.5px !important;box-sizing:border-box !important;display:block !important;" />
        </div>
        <div style="margin-bottom:12px;">
            <select name="kbds_demand" style="width:100% !important;height:42px !important;margin:0 !important;padding:0 10px !important;border-radius:8px !important;border:1.5px solid #CBD5E1 !important;background:#F8FAFC !important;color:#0F172A !important;font-size:13px !important;box-sizing:border-box !important;display:block !important;">
                <option value="Quan tâm Bảng giá & Mặt bằng gốc">📌 Chọn nhu cầu tư vấn...</option>
                <option value="Căn hộ chung cư">🏢 Căn hộ cao tầng (1PN – 3PN)</option>
                <option value="Biệt thự / Liền kề">🏡 Biệt thự & Liền kề</option>
                <option value="Nhà phố Shophouse">🏬 Nhà phố Shophouse</option>
                <option value="Tư vấn đầu tư & dòng tiền">💰 Tư vấn đầu tư & Lãi vay</option>
            </select>
        </div>
        <button type="submit" name="kbds_quick_lead_submit" value="1" style="width:100% !important;height:auto !important;min-height:44px !important;margin:0 !important;padding:11px 12px !important;background:linear-gradient(135deg,#C59B27 0%,#9E7812 100%) !important;color:#FFFFFF !important;font-weight:800 !important;border:none !important;border-radius:8px !important;cursor:pointer !important;font-size:13.5px !important;text-transform:uppercase !important;letter-spacing:0.3px !important;box-shadow:0 4px 12px rgba(197,155,39,0.3) !important;box-sizing:border-box !important;white-space:normal !important;line-height:1.35 !important;text-align:center !important;display:block !important;">
            NHẬN BẢNG GIÁ QUA ZALO
        </button>
        <div style="margin-top:10px;padding-top:8px;border-top:1px dashed #E2E8F0;text-align:center;font-size:11.5px;color:#64748B;">
            🔒 Bảo mật 100% &nbsp;•&nbsp; ⏱️ Phản hồi trong 3 phút
        </div>
    </form>
    <script>
    (function(){
        function syncSidebarContext() {
            var url = window.location.href;
            var title = document.title.replace(/\s*–\s*Kênh Bất Động Sản.*$/i, "").trim();
            document.querySelectorAll(".kbds-sidebar-lead-card .kbds-source-url-input").forEach(function(el){ el.value = url; });
            document.querySelectorAll(".kbds-sidebar-lead-card input[name=\'kbds_source_title\']").forEach(function(el){ el.value = title; });
            document.querySelectorAll(".kbds-sidebar-lead-card input[name=\'kbds_project\']").forEach(function(el){ el.value = title; });
        }
        if (document.readyState === "loading") { document.addEventListener("DOMContentLoaded", syncSidebarContext); } else { syncSidebarContext(); }
    })();
    </script>
</div>
<!-- /wp:html -->';

$widgets = get_option('widget_block');
$widgets[2]['content'] = $html;
update_option('widget_block', $widgets);

echo "[+] Đã cập nhật widget_block[2] giao diện Sidebar Lead Form hoàn hảo 100%!\n";
