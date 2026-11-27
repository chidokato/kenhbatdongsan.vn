<?php
/**
 * Module Mặt Bằng Tương Tác & Phiếu Tính Giá Tạm Tính Căn Hộ Tự Động
 * Cung cấp shortcode [kbds_interactive_floorplan]
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class KBDS_Interactive_Floorplan {

	public static function init() {
		add_shortcode( 'kbds_interactive_floorplan', array( __CLASS__, 'render_shortcode' ) );
	}

	public static function render_shortcode( $atts ) {
		$atts = shortcode_atts( array(
			'project'    => 'CENTRAL PARK RESIDENCES',
			'tower'      => 'Tháp Brighton',
			'floor'      => 'Tầng 40',
			'image'      => 'https://kenhbatdongsan.vn/wp-content/uploads/2026/11/mat-bang-phan-can-central-park-tinh-gia.jpg',
			'unit_price' => 92,
		), $atts );

		$uid = 'kbds-ifp-' . wp_rand( 1000, 9999 );

		ob_start();
		?>
		<div class="kbds-interactive-floorplan-wrapper" id="<?php echo esc_attr( $uid ); ?>">
			<!-- THANH ĐIỀU HƯỚNG VÀ BỘ LỌC -->
			<div class="kbds-ifp-controls">
				<div class="kbds-ifp-filters">
					<span class="kbds-ifp-label">Lọc căn hộ:</span>
					<button type="button" class="kbds-ifp-btn active" data-filter="all">Tất Cả (30)</button>
					<button type="button" class="kbds-ifp-btn" data-filter="1BR">1 Phòng Ngủ</button>
					<button type="button" class="kbds-ifp-btn" data-filter="2BR">2 Phòng Ngủ</button>
					<button type="button" class="kbds-ifp-btn" data-filter="3BR">3 Phòng Ngủ</button>
					
					<select class="kbds-ifp-select" data-role="direction-filter">
						<option value="all">Mọi hướng ban công</option>
						<option value="Đông Nam">Hướng Đông Nam</option>
						<option value="Tây Bắc">Hướng Tây Bắc</option>
						<option value="Đông Bắc">Hướng Đông Bắc</option>
						<option value="Tây Nam">Hướng Tây Nam</option>
					</select>
				</div>

				<div class="kbds-ifp-zoom">
					<button type="button" class="kbds-ifp-zoom-btn" data-zoom="in" title="Phóng to">＋</button>
					<button type="button" class="kbds-ifp-zoom-btn" data-zoom="out" title="Thu nhỏ">－</button>
					<button type="button" class="kbds-ifp-zoom-btn" data-zoom="reset" title="Đặt lại góc nhìn">100%</button>
				</div>
			</div>

			<!-- KHUNG VIEWPORT MẶT BẰNG -->
			<div class="kbds-ifp-viewport">
				<div class="kbds-ifp-hint">
					<span>🖐️ Kéo chuột để di chuyển • Lăn chuột để Zoom • Nhấp vào căn hộ để xem phiếu tính giá</span>
				</div>

				<div class="kbds-ifp-canvas-wrapper">
					<img src="<?php echo esc_url( $atts['image'] ); ?>" alt="Mặt bằng phân căn <?php echo esc_attr( $atts['project'] ); ?>" class="kbds-ifp-base-img" width="1024" height="602" loading="lazy" />
					<div class="kbds-ifp-units-layer"></div>
				</div>
			</div>

			<!-- ============================================================== -->
			<!-- MODAL: PHIẾU TÍNH GIÁ TẠM TÍNH & TIẾN ĐỘ THANH TOÁN (ẢNH 2) -->
			<!-- ============================================================== -->
			<div class="kbds-ifp-modal" style="display:none;">
				<div class="kbds-ifp-modal-dialog">
					<!-- Thanh điều khiển trên cùng -->
					<div class="kbds-ifp-modal-header">
						<!-- Tabs 5 Tiến độ -->
						<div class="kbds-ifp-tabs">
							<button type="button" class="kbds-ifp-tab" data-mode="ls">Hỗ trợ lãi suất</button>
							<button type="button" class="kbds-ifp-tab" data-mode="thanhthoi">Thảnh thơi</button>
							<button type="button" class="kbds-ifp-tab active" data-mode="nhanh">Nhanh</button>
							<button type="button" class="kbds-ifp-tab" data-mode="dacbiet">Đặc biệt</button>
							<button type="button" class="kbds-ifp-tab" data-mode="chuan">Chuẩn</button>
						</div>

						<div class="kbds-ifp-subcontrols">
							<label class="kbds-ifp-check-label">
								<input type="checkbox" class="kbds-ifp-early-discount" checked />
								<span>Chiết khấu đặt chỗ sớm 1%</span>
							</label>
							<div class="kbds-ifp-date-wrap">
								<span>Ký HĐMB dự kiến:</span>
								<input type="date" class="kbds-ifp-hdmb-date" value="2027-01-01" />
							</div>
						</div>

						<div class="kbds-ifp-actions">
							<button type="button" class="kbds-ifp-act-btn kbds-btn-download">📥 Tải ảnh 9:16</button>
							<button type="button" class="kbds-ifp-act-btn kbds-btn-copy">📋 Sao chép ảnh</button>
							<button type="button" class="kbds-ifp-act-btn kbds-btn-close">✕ Đóng</button>
						</div>
					</div>

					<!-- Phiếu Tính Giá Xanh Lục Bảo Sang Trọng -->
					<div class="kbds-ifp-sheet">
						<div class="kbds-ifp-sheet-header">
							<div class="kbds-ifp-sheet-logo">⚜ <?php echo esc_html( $atts['project'] ); ?> ⚜</div>
							<h3 class="kbds-ifp-sheet-title">PHIẾU TÍNH GIÁ TẠM TÍNH</h3>
							<div class="kbds-ifp-sheet-subtitle">
								<span class="sheet-tower"><?php echo esc_html( $atts['tower'] ); ?></span> • 
								Căn <span class="sheet-unit-id">B1-01</span> • 
								<span class="sheet-floor"><?php echo esc_html( $atts['floor'] ); ?></span>
							</div>
							<div class="kbds-ifp-sheet-badge">CHƯA PHẢI GIÁ BÁN CHÍNH THỨC</div>
						</div>

						<!-- Bảng Thông số -->
						<div class="kbds-ifp-specs-box">
							<div class="kbds-ifp-spec-row">
								<span>Loại căn:</span>
								<strong class="spec-val-type">2BR-B</strong>
							</div>
							<div class="kbds-ifp-spec-row">
								<span>Diện tích thông thủy:</span>
								<strong class="spec-val-area">72,3 m²</strong>
							</div>
							<div class="kbds-ifp-spec-row">
								<span>Hướng ban công:</span>
								<strong class="spec-val-dir">Tây Bắc</strong>
							</div>
							<div class="kbds-ifp-spec-row">
								<span>Đơn giá dự kiến:</span>
								<strong class="spec-val-unit-price" style="color:#FDE68A;">92 triệu/m²</strong>
							</div>
							<div class="kbds-ifp-spec-row">
								<span>Tổng giá bán:</span>
								<strong class="spec-val-listed-price">6.651.600.000 VNĐ</strong>
							</div>
							<div class="kbds-ifp-spec-row row-discount">
								<span class="spec-label-discount">Chiết khấu đặt chỗ sớm (nếu áp dụng): 1%</span>
								<strong class="spec-val-discount" style="color:#F87171;">- 66.516.000 VNĐ</strong>
							</div>

							<div class="kbds-ifp-final-row">
								<span>Giá bán tạm tính sau chiết khấu:</span>
								<div class="kbds-ifp-final-box">
									<strong class="spec-val-final-price">6.585.084.000 VNĐ</strong>
									<span class="spec-val-billion">≈ 6,585 tỷ đồng</span>
								</div>
							</div>
						</div>

						<!-- Bảng Tiến Độ -->
						<div class="kbds-ifp-schedule-box">
							<div class="kbds-ifp-schedule-header">
								<span>Tiến độ thanh toán:</span>
								<strong class="schedule-mode-name">Nhanh</strong>
							</div>
							<table class="kbds-ifp-schedule-table">
								<thead>
									<tr>
										<th style="width:12%;text-align:center;">STT</th>
										<th style="width:33%;">Nội dung</th>
										<th style="width:23%;text-align:center;">Thời điểm</th>
										<th style="width:12%;text-align:center;">Tỷ lệ</th>
										<th style="width:20%;text-align:right;">Số tiền (VNĐ)</th>
									</tr>
								</thead>
								<tbody class="schedule-tbody"></tbody>
								<tfoot>
									<tr>
										<td colspan="3" style="text-align:right;font-weight:700;">Tổng cộng:</td>
										<td style="text-align:center;font-weight:700;">100%</td>
										<td class="schedule-tfoot-total" style="text-align:right;font-weight:900;color:#FDE68A;">6.585.084.000</td>
									</tr>
								</tfoot>
							</table>
						</div>

						<!-- Miễn trừ trách nhiệm -->
						<div class="kbds-ifp-disclaimer">
							<strong>MIỄN TRỪ TRÁCH NHIỆM</strong>
							Đây là phiếu tính giá TẠM TÍNH, lập dựa trên thông tin giá bán rumor (đơn giá dự kiến theo thông thủy), chưa phải giá bán chính thức. Giá bán và phiếu tính giá, tiến độ thanh toán chính thức sẽ do Chủ đầu tư cung cấp và công bố. Số liệu chỉ mang tính tham khảo, không có giá trị pháp lý và không thay thế thỏa thuận đặt chỗ hay hợp đồng mua bán.
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- STYLES CHO MODULE -->
		<style>
		.kbds-interactive-floorplan-wrapper {
			position: relative;
			background: #0B132B;
			border: 1px solid #1E293B;
			border-radius: 16px;
			overflow: hidden;
			font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
			box-shadow: 0 20px 40px rgba(0,0,0,0.4);
			margin: 30px 0;
			user-select: none;
		}
		.kbds-ifp-controls {
			display: flex;
			align-items: center;
			justify-content: space-between;
			flex-wrap: wrap;
			gap: 12px;
			padding: 14px 18px;
			background: #111C38;
			border-bottom: 1px solid #1E293B;
		}
		.kbds-ifp-filters {
			display: flex;
			align-items: center;
			flex-wrap: wrap;
			gap: 8px;
		}
		.kbds-ifp-label {
			color: #94A3B8;
			font-size: 13px;
			font-weight: 600;
		}
		.kbds-ifp-btn {
			background: #1E293B;
			color: #CBD5E1;
			border: 1px solid #334155;
			border-radius: 8px;
			padding: 6px 12px;
			font-size: 12px;
			font-weight: 600;
			cursor: pointer;
			transition: all 0.2s;
		}
		.kbds-ifp-btn:hover {
			background: #334155;
			color: #FFF;
		}
		.kbds-ifp-btn.active {
			background: #D4AF37;
			color: #071D36;
			border-color: #D4AF37;
			font-weight: 800;
		}
		.kbds-ifp-select {
			background: #1E293B;
			color: #E2E8F0;
			border: 1px solid #334155;
			border-radius: 8px;
			padding: 6px 10px;
			font-size: 12px;
			cursor: pointer;
		}
		.kbds-ifp-zoom {
			display: flex;
			align-items: center;
			gap: 6px;
			background: #0B132B;
			padding: 4px;
			border-radius: 8px;
			border: 1px solid #1E293B;
		}
		.kbds-ifp-zoom-btn {
			background: #1E293B;
			color: #FFF;
			border: none;
			border-radius: 6px;
			width: 32px;
			height: 32px;
			font-size: 14px;
			font-weight: 700;
			cursor: pointer;
			display: flex;
			align-items: center;
			justify-content: center;
			transition: background 0.2s;
		}
		.kbds-ifp-zoom-btn:hover {
			background: #334155;
		}
		.kbds-ifp-viewport {
			position: relative;
			height: 580px;
			background: #030712;
			overflow: hidden;
			cursor: grab;
			display: flex;
			align-items: center;
			justify-content: center;
		}
		.kbds-ifp-viewport.grabbing {
			cursor: grabbing;
		}
		.kbds-ifp-hint {
			position: absolute;
			bottom: 12px;
			left: 12px;
			z-index: 20;
			background: rgba(15, 23, 42, 0.85);
			backdrop-filter: blur(8px);
			color: #94A3B8;
			padding: 6px 14px;
			border-radius: 8px;
			font-size: 12px;
			pointer-events: none;
			border: 1px solid rgba(255,255,255,0.1);
		}
		.kbds-ifp-canvas-wrapper {
			position: relative;
			transform-origin: center center;
			transition: transform 0.08s ease-out;
			will-change: transform;
		}
		.kbds-ifp-base-img {
			display: block;
			max-width: none;
			border-radius: 12px;
			box-shadow: 0 10px 30px rgba(0,0,0,0.5);
			pointer-events: none;
		}
		.kbds-ifp-units-layer {
			position: absolute;
			inset: 0;
		}
		.kbds-ifp-unit-tag {
			position: absolute;
			transform: translate(-50%, -50%);
			cursor: pointer;
			transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
			z-index: 10;
		}
		.kbds-ifp-unit-tag:hover {
			transform: translate(-50%, -50%) scale(1.15);
			z-index: 30;
		}
		.kbds-ifp-unit-box {
			background: rgba(255, 255, 255, 0.96);
			border: 2px solid #047857;
			border-radius: 7px;
			padding: 4px 6px;
			min-width: 74px;
			text-align: center;
			box-shadow: 0 4px 10px rgba(0,0,0,0.3);
			transition: border-color 0.2s;
		}
		.kbds-ifp-unit-tag:hover .kbds-ifp-unit-box {
			border-color: #D4AF37;
			background: #FFF;
		}
		.kbds-ifp-unit-head {
			display: flex;
			justify-content: space-between;
			align-items: center;
			border-bottom: 1px solid #E2E8F0;
			padding-bottom: 2px;
			margin-bottom: 2px;
		}
		.kbds-ifp-unit-code {
			font-size: 11px;
			font-weight: 800;
			color: #064E3B;
		}
		.kbds-ifp-unit-area {
			font-size: 10px;
			color: #64748B;
			font-weight: 600;
		}
		.kbds-ifp-unit-dir {
			font-size: 9.5px;
			color: #475569;
			font-weight: 500;
			line-height: 1.2;
		}
		.kbds-ifp-unit-price {
			font-size: 10.5px;
			font-weight: 900;
			color: #DC2626;
			margin-top: 2px;
			line-height: 1.2;
		}

		/* MODAL */
		.kbds-ifp-modal {
			position: fixed;
			inset: 0;
			z-index: 99999;
			background: rgba(0, 0, 0, 0.85);
			backdrop-filter: blur(6px);
			display: flex;
			align-items: center;
			justify-content: center;
			padding: 15px;
			overflow-y: auto;
		}
		.kbds-ifp-modal-dialog {
			position: relative;
			background: #FFF;
			border-radius: 16px;
			max-width: 680px;
			width: 100%;
			overflow: hidden;
			box-shadow: 0 25px 50px rgba(0,0,0,0.5);
			border: 1px solid #334155;
			margin: auto;
		}
		.kbds-ifp-modal-header {
			background: #F8FAFC;
			padding: 14px 18px;
			border-bottom: 1px solid #E2E8F0;
		}
		.kbds-ifp-tabs {
			display: flex;
			gap: 6px;
			flex-wrap: wrap;
			margin-bottom: 10px;
		}
		.kbds-ifp-tab {
			background: #FFF;
			border: 1px solid #CBD5E1;
			color: #334155;
			border-radius: 8px;
			padding: 6px 12px;
			font-size: 12px;
			font-weight: 600;
			cursor: pointer;
			transition: all 0.2s;
		}
		.kbds-ifp-tab:hover {
			background: #F1F5F9;
		}
		.kbds-ifp-tab.active {
			background: #064E3B;
			color: #FFF;
			border-color: #064E3B;
			font-weight: 700;
		}
		.kbds-ifp-subcontrols {
			display: flex;
			align-items: center;
			justify-content: space-between;
			flex-wrap: wrap;
			gap: 10px;
			padding: 8px 0;
			font-size: 12.5px;
			color: #334155;
			border-top: 1px solid #E2E8F0;
		}
		.kbds-ifp-check-label {
			display: flex;
			align-items: center;
			gap: 6px;
			cursor: pointer;
			font-weight: 600;
		}
		.kbds-ifp-date-wrap {
			display: flex;
			align-items: center;
			gap: 6px;
		}
		.kbds-ifp-hdmb-date {
			border: 1px solid #CBD5E1;
			border-radius: 6px;
			padding: 4px 8px;
			font-size: 12px;
			font-weight: 600;
			color: #0F172A;
		}
		.kbds-ifp-actions {
			display: flex;
			align-items: center;
			gap: 8px;
			padding-top: 10px;
			border-top: 1px solid #E2E8F0;
			flex-wrap: wrap;
		}
		.kbds-ifp-act-btn {
			border-radius: 8px;
			padding: 7px 14px;
			font-size: 12px;
			font-weight: 700;
			cursor: pointer;
			transition: all 0.2s;
			border: none;
		}
		.kbds-btn-download {
			background: #064E3B;
			color: #FFF;
		}
		.kbds-btn-download:hover {
			background: #047857;
		}
		.kbds-btn-copy {
			background: #E2E8F0;
			color: #1E293B;
		}
		.kbds-btn-copy:hover {
			background: #CBD5E1;
		}
		.kbds-btn-close {
			background: #F1F5F9;
			color: #64748B;
			margin-left: auto;
		}
		.kbds-btn-close:hover {
			background: #E2E8F0;
			color: #0F172A;
		}

		/* SHEET DESIGN */
		.kbds-ifp-sheet {
			background: radial-gradient(circle at 50% 15%, #0A2E20 0%, #031710 65%, #020C08 100%);
			color: #ECFDF5;
			padding: 24px;
			max-height: 72vh;
			overflow-y: auto;
		}
		.kbds-ifp-sheet-header {
			text-align: center;
			margin-bottom: 20px;
		}
		.kbds-ifp-sheet-logo {
			color: #FDE68A;
			font-size: 16px;
			font-weight: 800;
			letter-spacing: 2px;
			margin-bottom: 4px;
		}
		.kbds-ifp-sheet-title {
			color: #FDE68A;
			font-size: 24px;
			font-weight: 900;
			letter-spacing: 1px;
			margin: 0 0 4px;
			font-family: Georgia, serif;
		}
		.kbds-ifp-sheet-subtitle {
			font-size: 13.5px;
			color: #CBD5E1;
			font-weight: 600;
		}
		.kbds-ifp-sheet-badge {
			display: inline-block;
			background: #DC2626;
			color: #FFF;
			font-size: 10px;
			font-weight: 800;
			letter-spacing: 1px;
			padding: 3px 12px;
			border-radius: 20px;
			margin-top: 8px;
			text-transform: uppercase;
		}
		.kbds-ifp-specs-box {
			background: rgba(0, 0, 0, 0.35);
			border: 1px solid rgba(16, 185, 129, 0.25);
			border-radius: 12px;
			padding: 16px;
			margin-bottom: 20px;
		}
		.kbds-ifp-spec-row {
			display: flex;
			justify-content: space-between;
			font-size: 13px;
			padding: 4px 0;
			color: #94A3B8;
		}
		.kbds-ifp-spec-row strong {
			color: #FFF;
		}
		.kbds-ifp-final-row {
			display: flex;
			justify-content: space-between;
			align-items: center;
			margin-top: 12px;
			padding-top: 10px;
			border-top: 1px solid rgba(16, 185, 129, 0.3);
			font-size: 13.5px;
			font-weight: 700;
			color: #FDE68A;
		}
		.kbds-ifp-final-box {
			text-align: right;
		}
		.spec-val-final-price {
			font-size: 20px;
			font-weight: 900;
			color: #FDE68A;
			display: block;
			font-family: Consolas, monospace;
		}
		.spec-val-billion {
			font-size: 11px;
			color: #94A3B8;
			font-weight: 600;
		}
		.kbds-ifp-schedule-box {
			background: rgba(0, 0, 0, 0.4);
			border: 1px solid rgba(16, 185, 129, 0.25);
			border-radius: 12px;
			overflow: hidden;
			margin-bottom: 18px;
		}
		.kbds-ifp-schedule-header {
			background: rgba(212, 175, 55, 0.12);
			padding: 8px 14px;
			text-align: center;
			font-size: 13px;
			font-weight: 700;
			color: #FDE68A;
			border-bottom: 1px solid rgba(16, 185, 129, 0.25);
		}
		.kbds-ifp-schedule-table {
			width: 100%;
			border-collapse: collapse;
			font-size: 12.5px;
		}
		.kbds-ifp-schedule-table th {
			background: rgba(0, 0, 0, 0.5);
			color: #94A3B8;
			padding: 8px 10px;
			font-weight: 600;
			border-bottom: 1px solid rgba(16, 185, 129, 0.25);
		}
		.kbds-ifp-schedule-table td {
			padding: 8px 10px;
			border-bottom: 1px solid rgba(16, 185, 129, 0.15);
			color: #E2E8F0;
		}
		.kbds-ifp-disclaimer {
			background: rgba(0, 0, 0, 0.3);
			border: 1px solid rgba(16, 185, 129, 0.2);
			border-radius: 8px;
			padding: 10px;
			text-align: center;
			font-size: 10.5px;
			line-height: 1.5;
			color: #94A3B8;
		}
		.kbds-ifp-disclaimer strong {
			display: block;
			color: #FDE68A;
			margin-bottom: 2px;
		}
		</style>

		<!-- JAVASCRIPT CHO MODULE -->
		<script>
		(function(){
			var wrapper = document.getElementById('<?php echo esc_js( $uid ); ?>');
			if (!wrapper) return;

			var units = [
				// Cánh B1
				{ id: 'B1-01', type: '2BR-B', area: 72.3, dir: 'Tây Bắc', priceBil: 6.65, unitPrice: <?php echo (int) $atts['unit_price']; ?>, x: 47.0, y: 25.5 },
				{ id: 'B1-02', type: '2BR-B', area: 72.5, dir: 'Tây Bắc', priceBil: 6.67, unitPrice: <?php echo (int) $atts['unit_price']; ?>, x: 49.0, y: 18.0 },
				{ id: 'B1-03', type: '2BR-B', area: 72.5, dir: 'Tây Bắc', priceBil: 6.67, unitPrice: <?php echo (int) $atts['unit_price']; ?>, x: 51.5, y: 11.5 },
				{ id: 'B1-04', type: '3BR-Corner', area: 99.1, dir: 'TB-ĐB', priceBil: 9.12, unitPrice: <?php echo (int) $atts['unit_price']; ?>, x: 53.5, y: 4.5 },
				{ id: 'B1-05', type: '3BR-Corner', area: 89.6, dir: 'ĐN-ĐB', priceBil: 8.24, unitPrice: <?php echo (int) $atts['unit_price']; ?>, x: 77.0, y: 11.5 },
				{ id: 'B1-06', type: '1BR', area: 39.3, dir: 'Đông Nam', priceBil: 3.62, unitPrice: <?php echo (int) $atts['unit_price']; ?>, x: 74.5, y: 19.0 },
				{ id: 'B1-07', type: '2BR', area: 61.6, dir: 'Đông Nam', priceBil: 5.67, unitPrice: <?php echo (int) $atts['unit_price']; ?>, x: 71.0, y: 29.5 },
				{ id: 'B1-08', type: '2BR', area: 61.6, dir: 'Đông Nam', priceBil: 5.67, unitPrice: <?php echo (int) $atts['unit_price']; ?>, x: 68.5, y: 36.5 },
				{ id: 'B1-09', type: '2BR', area: 62.5, dir: 'Đông Nam', priceBil: 5.75, unitPrice: <?php echo (int) $atts['unit_price']; ?>, x: 66.0, y: 44.5 },
				{ id: 'B1-10', type: '1BR', area: 42.9, dir: 'Tây Bắc', priceBil: 3.95, unitPrice: <?php echo (int) $atts['unit_price']; ?>, x: 45.0, y: 33.0 },

				// Cánh B2
				{ id: 'B2-01', type: '2BR', area: 62.5, dir: 'Đông Bắc', priceBil: 5.75, unitPrice: <?php echo (int) $atts['unit_price']; ?>, x: 66.5, y: 52.5 },
				{ id: 'B2-02', type: '2BR', area: 61.6, dir: 'Đông Bắc', priceBil: 5.67, unitPrice: <?php echo (int) $atts['unit_price']; ?>, x: 69.0, y: 59.5 },
				{ id: 'B2-03', type: '2BR', area: 64.1, dir: 'Đông Bắc', priceBil: 5.90, unitPrice: <?php echo (int) $atts['unit_price']; ?>, x: 71.5, y: 67.0 },
				{ id: 'B2-04', type: '1BR', area: 36.7, dir: 'Đông Bắc', priceBil: 3.38, unitPrice: <?php echo (int) $atts['unit_price']; ?>, x: 74.5, y: 76.5 },
				{ id: 'B2-05', type: '3BR-Corner', area: 89.6, dir: 'ĐB-ĐN', priceBil: 8.24, unitPrice: <?php echo (int) $atts['unit_price']; ?>, x: 77.0, y: 84.5 },
				{ id: 'B2-06', type: '3BR-Corner', area: 99.1, dir: 'TN-ĐN', priceBil: 9.12, unitPrice: <?php echo (int) $atts['unit_price']; ?>, x: 55.0, y: 97.5 },
				{ id: 'B2-07', type: '2BR', area: 61.6, dir: 'Tây Nam', priceBil: 5.67, unitPrice: <?php echo (int) $atts['unit_price']; ?>, x: 52.5, y: 92.5 },
				{ id: 'B2-08', type: '2BR', area: 61.6, dir: 'Tây Nam', priceBil: 5.67, unitPrice: <?php echo (int) $atts['unit_price']; ?>, x: 50.0, y: 85.0 },
				{ id: 'B2-09', type: '2BR', area: 61.9, dir: 'Tây Nam', priceBil: 5.70, unitPrice: <?php echo (int) $atts['unit_price']; ?>, x: 48.5, y: 77.5 },
				{ id: 'B2-10', type: '1BR', area: 42.9, dir: 'Tây Nam', priceBil: 3.95, unitPrice: <?php echo (int) $atts['unit_price']; ?>, x: 46.0, y: 70.0 },

				// Cánh B3
				{ id: 'B3-06', type: '3BR-Corner', area: 99.2, dir: 'TN-TB', priceBil: 9.13, unitPrice: <?php echo (int) $atts['unit_price']; ?>, x: 20.0, y: 30.5 },
				{ id: 'B3-07', type: '2BR-B', area: 72.5, dir: 'Tây Bắc', priceBil: 6.67, unitPrice: <?php echo (int) $atts['unit_price']; ?>, x: 26.0, y: 30.5 },
				{ id: 'B3-08', type: '2BR-B', area: 72.5, dir: 'Tây Bắc', priceBil: 6.67, unitPrice: <?php echo (int) $atts['unit_price']; ?>, x: 32.0, y: 30.5 },
				{ id: 'B3-09', type: '2BR-B', area: 73.1, dir: 'Tây Bắc', priceBil: 6.72, unitPrice: <?php echo (int) $atts['unit_price']; ?>, x: 38.0, y: 30.5 },
				{ id: 'B3-10', type: '1BR', area: 42.9, dir: 'Tây Bắc', priceBil: 3.95, unitPrice: <?php echo (int) $atts['unit_price']; ?>, x: 44.5, y: 33.0 },
				{ id: 'B3-05', type: '3BR-Corner', area: 90.8, dir: 'ĐN-TN', priceBil: 8.35, unitPrice: <?php echo (int) $atts['unit_price']; ?>, x: 20.0, y: 66.0 },
				{ id: 'B3-04', type: '2BR', area: 62.2, dir: 'Đông Nam', priceBil: 5.72, unitPrice: <?php echo (int) $atts['unit_price']; ?>, x: 26.0, y: 66.0 },
				{ id: 'B3-03', type: '2BR', area: 61.6, dir: 'Đông Nam', priceBil: 5.67, unitPrice: <?php echo (int) $atts['unit_price']; ?>, x: 32.0, y: 66.0 },
				{ id: 'B3-02', type: '2BR', area: 62.3, dir: 'Đông Nam', priceBil: 5.73, unitPrice: <?php echo (int) $atts['unit_price']; ?>, x: 38.0, y: 66.0 },
				{ id: 'B3-01', type: '1BR', area: 42.9, dir: 'Đông Nam', priceBil: 3.95, unitPrice: <?php echo (int) $atts['unit_price']; ?>, x: 44.5, y: 62.0 }
			];

			var currentUnit = units[0];
			var currentMode = 'nhanh';
			var earlyDiscount = true;
			var baseDate = '2027-01-01';

			var layer = wrapper.querySelector('.kbds-ifp-units-layer');
			var modal = wrapper.querySelector('.kbds-ifp-modal');

			function fmt(n) {
				return new Intl.NumberFormat('vi-VN').format(Math.round(n));
			}

			function renderUnitsList(typeFilter, dirFilter) {
				layer.innerHTML = '';
				var filtered = units.filter(function(u){
					var mType = true;
					if (typeFilter === '1BR') mType = u.type.indexOf('1BR') !== -1;
					else if (typeFilter === '2BR') mType = u.type.indexOf('2BR') !== -1;
					else if (typeFilter === '3BR') mType = u.type.indexOf('3BR') !== -1;

					var mDir = true;
					if (dirFilter && dirFilter !== 'all') {
						mDir = u.dir.toLowerCase().indexOf(dirFilter.toLowerCase()) !== -1;
					}
					return mType && mDir;
				});

				filtered.forEach(function(u){
					var el = document.createElement('div');
					el.className = 'kbds-ifp-unit-tag';
					el.style.left = u.x + '%';
					el.style.top = u.y + '%';
					el.innerHTML = '<div class="kbds-ifp-unit-box">' +
						'<div class="kbds-ifp-unit-head">' +
							'<span class="kbds-ifp-unit-code">' + u.id + '</span>' +
							'<span class="kbds-ifp-unit-area">' + u.area + 'm²</span>' +
						'</div>' +
						'<div class="kbds-ifp-unit-dir">' + u.dir + '</div>' +
						'<div class="kbds-ifp-unit-price">Chỉ từ ' + u.priceBil + ' tỷ</div>' +
					'</div>';

					el.addEventListener('click', function(e){
						e.stopPropagation();
						openModal(u);
					});

					layer.appendChild(el);
				});
			}

			function openModal(u) {
				currentUnit = u;
				recalc();
				modal.style.display = 'flex';
			}

			function closeModal() {
				modal.style.display = 'none';
			}

			function recalc() {
				var u = currentUnit;
				var listed = Math.round(u.area * u.unitPrice * 1000000);
				var disc = earlyDiscount ? Math.round(listed * 0.01) : 0;
				var finalPrice = listed - disc;

				modal.querySelector('.sheet-unit-id').innerText = u.id;
				modal.querySelector('.spec-val-type').innerText = u.type;
				modal.querySelector('.spec-val-area').innerText = u.area + ' m²';
				modal.querySelector('.spec-val-dir').innerText = u.dir;
				modal.querySelector('.spec-val-unit-price').innerText = u.unitPrice + ' triệu/m²';
				modal.querySelector('.spec-val-listed-price').innerText = fmt(listed) + ' VNĐ';

				var discLabel = modal.querySelector('.spec-label-discount');
				var discVal = modal.querySelector('.spec-val-discount');
				if (earlyDiscount) {
					discLabel.innerText = 'Chiết khấu đặt chỗ sớm (nếu áp dụng): 1%';
					discVal.innerText = '- ' + fmt(disc) + ' VNĐ';
					discVal.style.color = '#F87171';
				} else {
					discLabel.innerText = 'Chiết khấu đặt chỗ sớm:';
					discVal.innerText = '0 VNĐ';
					discVal.style.color = '#94A3B8';
				}

				modal.querySelector('.spec-val-final-price').innerText = fmt(finalPrice) + ' VNĐ';
				var bil = (finalPrice / 1000000000).toFixed(3).replace('.', ',');
				modal.querySelector('.spec-val-billion').innerText = '≈ ' + bil + ' tỷ đồng';

				// Schedule
				var d = new Date(baseDate);
				function formatDate(obj) {
					var dd = String(obj.getDate()).padStart(2, '0');
					var mm = String(obj.getMonth() + 1).padStart(2, '0');
					return dd + '/' + mm + '/' + obj.getFullYear();
				}
				function addM(obj, m) {
					var res = new Date(obj);
					res.setMonth(res.getMonth() + m);
					return res;
				}

				var sched = [];
				var title = 'Nhanh';
				if (currentMode === 'nhanh') {
					title = 'Nhanh (Thanh Toán Sớm)';
					sched = [
						{ stt: 1, name: 'Ký HĐMB', time: formatDate(d), rate: 30, amount: finalPrice * 0.30 },
						{ stt: 2, name: 'Đợt 1', time: formatDate(addM(d, 2)), rate: 20, amount: finalPrice * 0.20 },
						{ stt: 3, name: 'Bàn giao', time: 'Q4.2029 (dự kiến)', rate: 45, amount: finalPrice * 0.45 },
						{ stt: 4, name: 'Cấp sổ', time: 'Sau bàn giao', rate: 5, amount: finalPrice * 0.05 }
					];
				} else if (currentMode === 'chuan') {
					title = 'Chuẩn (12 Đợt)';
					sched = [
						{ stt: 1, name: 'Ký HĐMB', time: formatDate(d), rate: 20, amount: finalPrice * 0.20 },
						{ stt: 2, name: 'Đợt 1', time: formatDate(addM(d, 3)), rate: 5, amount: finalPrice * 0.05 },
						{ stt: 3, name: 'Đợt 2', time: formatDate(addM(d, 6)), rate: 5, amount: finalPrice * 0.05 },
						{ stt: 4, name: 'Đợt 3', time: formatDate(addM(d, 9)), rate: 5, amount: finalPrice * 0.05 },
						{ stt: 5, name: 'Đợt 4', time: formatDate(addM(d, 12)), rate: 5, amount: finalPrice * 0.05 },
						{ stt: 6, name: 'Bàn giao căn hộ', time: 'Quý 4/2029', rate: 55, amount: finalPrice * 0.55 },
						{ stt: 7, name: 'Cấp sổ hồng', time: 'Sau bàn giao', rate: 5, amount: finalPrice * 0.05 }
					];
				} else if (currentMode === 'ls') {
					title = 'Hỗ Trợ Lãi Suất 0% (Vay Ngân Hàng 70%)';
					sched = [
						{ stt: 1, name: 'Vốn tự có (Ký HĐMB)', time: formatDate(d), rate: 15, amount: finalPrice * 0.15 },
						{ stt: 2, name: 'Vốn tự có (Đợt 1)', time: formatDate(addM(d, 2)), rate: 15, amount: finalPrice * 0.15 },
						{ stt: 3, name: 'Ngân hàng giải ngân LS 0%', time: formatDate(addM(d, 3)), rate: 65, amount: finalPrice * 0.65 },
						{ stt: 4, name: 'Cấp sổ hồng', time: 'Sau bàn giao', rate: 5, amount: finalPrice * 0.05 }
					];
				} else if (currentMode === 'thanhthoi') {
					title = 'Thảnh Thơi (Thanh toán giãn dài)';
					sched = [
						{ stt: 1, name: 'Ký HĐMB', time: formatDate(d), rate: 15, amount: finalPrice * 0.15 },
						{ stt: 2, name: 'Giai đoạn 1 (1.5%/tháng)', time: 'Hàng tháng', rate: 22.5, amount: finalPrice * 0.225 },
						{ stt: 3, name: 'Giai đoạn 2 (1%/tháng)', time: 'Hàng tháng', rate: 15, amount: finalPrice * 0.15 },
						{ stt: 4, name: 'Bàn giao nhà', time: 'Quý 4/2029', rate: 42.5, amount: finalPrice * 0.425 },
						{ stt: 5, name: 'Cấp sổ', time: 'Sau bàn giao', rate: 5, amount: finalPrice * 0.05 }
					];
				} else if (currentMode === 'dacbiet') {
					title = 'Đặc Biệt (Chiết khấu trực tiếp 3.5%)';
					var spPrice = finalPrice * 0.965;
					sched = [
						{ stt: 1, name: 'Ký HĐMB (50%)', time: formatDate(d), rate: 50, amount: spPrice * 0.50 },
						{ stt: 2, name: 'Bàn giao căn hộ', time: 'Q4.2029', rate: 45, amount: spPrice * 0.45 },
						{ stt: 3, name: 'Cấp sổ hồng', time: 'Sau bàn giao', rate: 5, amount: spPrice * 0.05 }
					];
				}

				modal.querySelector('.schedule-mode-name').innerText = title;
				var tbody = modal.querySelector('.schedule-tbody');
				tbody.innerHTML = '';
				sched.forEach(function(row){
					var tr = document.createElement('tr');
					tr.innerHTML = '<td style="text-align:center;color:#94A3B8;">' + row.stt + '</td>' +
						'<td><strong>' + row.name + '</strong></td>' +
						'<td style="text-align:center;color:#CBD5E1;">' + row.time + '</td>' +
						'<td style="text-align:center;color:#FDE68A;font-weight:700;">' + row.rate + '%</td>' +
						'<td style="text-align:right;font-weight:700;">' + fmt(row.amount) + '</td>';
					tbody.appendChild(tr);
				});
				modal.querySelector('.schedule-tfoot-total').innerText = fmt(finalPrice);
			}

			// Tải ảnh Canvas 9:16
			function download916() {
				var u = currentUnit;
				var canvas = document.createElement('canvas');
				canvas.width = 1080;
				canvas.height = 1920;
				var ctx = canvas.getContext('2d');

				var grad = ctx.createLinearGradient(0, 0, 0, 1920);
				grad.addColorStop(0, '#0a2c1e');
				grad.addColorStop(0.35, '#061a12');
				grad.addColorStop(1, '#020b07');
				ctx.fillStyle = grad;
				ctx.fillRect(0, 0, 1080, 1920);

				ctx.strokeStyle = '#d4af37';
				ctx.lineWidth = 4;
				ctx.strokeRect(40, 40, 1000, 1840);

				ctx.textAlign = 'center';
				ctx.fillStyle = '#fde68a';
				ctx.font = 'bold 36px Georgia, serif';
				ctx.fillText('⚜ <?php echo esc_js( $atts['project'] ); ?> ⚜', 540, 140);

				ctx.fillStyle = '#fbbf24';
				ctx.font = '900 52px Georgia, serif';
				ctx.fillText('PHIẾU TÍNH GIÁ TẠM TÍNH', 540, 220);

				ctx.fillStyle = '#e2e8f0';
				ctx.font = '600 32px sans-serif';
				ctx.fillText('<?php echo esc_js( $atts['tower'] ); ?> • Căn ' + u.id + ' • <?php echo esc_js( $atts['floor'] ); ?>', 540, 280);

				ctx.fillStyle = '#dc2626';
				ctx.beginPath();
				ctx.roundRect(340, 320, 400, 48, [24]);
				ctx.fill();
				ctx.fillStyle = '#fff';
				ctx.font = 'bold 22px sans-serif';
				ctx.fillText('CHƯA PHẢI GIÁ BÁN CHÍNH THỨC', 540, 352);

				// Box thông số
				ctx.fillStyle = 'rgba(0,0,0,0.45)';
				ctx.beginPath();
				ctx.roundRect(80, 420, 920, 430, [16]);
				ctx.fill();

				var listed = Math.round(u.area * u.unitPrice * 1000000);
				var disc = earlyDiscount ? Math.round(listed * 0.01) : 0;
				var finalP = listed - disc;

				var specs = [
					['Loại căn:', u.type],
					['Diện tích thông thủy:', u.area + ' m²'],
					['Hướng ban công:', u.dir],
					['Đơn giá dự kiến:', u.unitPrice + ' triệu/m²'],
					['Tổng giá bán niêm yết:', fmt(listed) + ' VNĐ'],
					['Chiết khấu đặt chỗ sớm 1%:', '- ' + fmt(disc) + ' VNĐ']
				];

				var y = 480;
				specs.forEach(function(s, idx){
					ctx.textAlign = 'left';
					ctx.fillStyle = '#94a3b8';
					ctx.font = '500 28px sans-serif';
					ctx.fillText(s[0], 120, y);

					ctx.textAlign = 'right';
					ctx.fillStyle = (idx === 5) ? '#f87171' : (idx === 3) ? '#fde68a' : '#ffffff';
					ctx.font = 'bold 28px sans-serif';
					ctx.fillText(s[1], 960, y);
					y += 52;
				});

				ctx.strokeStyle = '#059669';
				ctx.beginPath();
				ctx.moveTo(110, 750);
				ctx.lineTo(970, 750);
				ctx.stroke();

				ctx.textAlign = 'left';
				ctx.fillStyle = '#fde68a';
				ctx.font = 'bold 30px sans-serif';
				ctx.fillText('Giá bán sau chiết khấu:', 120, 805);

				ctx.textAlign = 'right';
				ctx.fillStyle = '#fbbf24';
				ctx.font = '900 42px sans-serif';
				ctx.fillText(fmt(finalP) + ' VNĐ', 960, 808);

				// Table Box
				ctx.fillStyle = 'rgba(0,0,0,0.5)';
				ctx.beginPath();
				ctx.roundRect(80, 890, 920, 680, [16]);
				ctx.fill();

				ctx.fillStyle = 'rgba(212,175,55,0.15)';
				ctx.beginPath();
				ctx.roundRect(80, 890, 920, 70, [16,16,0,0]);
				ctx.fill();

				ctx.textAlign = 'center';
				ctx.fillStyle = '#fbbf24';
				ctx.font = 'bold 30px sans-serif';
				ctx.fillText('TIẾN ĐỘ: ' + modal.querySelector('.schedule-mode-name').innerText, 540, 938);

				ctx.font = 'bold 24px sans-serif';
				ctx.fillStyle = '#cbd5e1';
				ctx.textAlign = 'left'; ctx.fillText('Nội dung', 120, 1005);
				ctx.textAlign = 'center'; ctx.fillText('Thời điểm', 520, 1005);
				ctx.fillText('Tỷ lệ', 720, 1005);
				ctx.textAlign = 'right'; ctx.fillText('Số tiền (VNĐ)', 960, 1005);

				var rY = 1065;
				modal.querySelectorAll('.schedule-tbody tr').forEach(function(r){
					var tds = r.querySelectorAll('td');
					ctx.fillStyle = '#ffffff';
					ctx.font = '500 24px sans-serif';
					ctx.textAlign = 'left'; ctx.fillText(tds[1].innerText, 120, rY);
					ctx.textAlign = 'center'; ctx.fillText(tds[2].innerText, 520, rY);
					ctx.fillStyle = '#fbbf24'; ctx.fillText(tds[3].innerText, 720, rY);
					ctx.fillStyle = '#ffffff'; ctx.font = 'bold 24px sans-serif';
					ctx.textAlign = 'right'; ctx.fillText(tds[4].innerText, 960, rY);
					rY += 58;
				});

				ctx.textAlign = 'center';
				ctx.fillStyle = '#94a3b8';
				ctx.font = 'italic 20px sans-serif';
				ctx.fillText('Hotline hỗ trợ bảng giá: 0942.655.111', 540, 1780);
				ctx.fillStyle = '#fde68a';
				ctx.font = 'bold 24px sans-serif';
				ctx.fillText('KENHBATDONGSAN.VN', 540, 1820);

				var a = document.createElement('a');
				a.download = 'Phieu-Tinh-Gia-' + u.id + '.png';
				a.href = canvas.toDataURL('image/png');
				a.click();
			}

			// Events
			wrapper.querySelectorAll('.kbds-ifp-btn').forEach(function(btn){
				btn.addEventListener('click', function(){
					wrapper.querySelectorAll('.kbds-ifp-btn').forEach(function(b){ b.classList.remove('active'); });
					btn.classList.add('active');
					var filter = btn.dataset.filter;
					var dir = wrapper.querySelector('[data-role="direction-filter"]').value;
					renderUnitsList(filter, dir);
				});
			});

			wrapper.querySelector('[data-role="direction-filter"]').addEventListener('change', function(){
				var activeBtn = wrapper.querySelector('.kbds-ifp-btn.active');
				var filter = activeBtn ? activeBtn.dataset.filter : 'all';
				renderUnitsList(filter, this.value);
			});

			modal.querySelectorAll('.kbds-ifp-tab').forEach(function(tab){
				tab.addEventListener('click', function(){
					modal.querySelectorAll('.kbds-ifp-tab').forEach(function(t){ t.classList.remove('active'); });
					tab.classList.add('active');
					currentMode = tab.dataset.mode;
					recalc();
				});
			});

			modal.querySelector('.kbds-ifp-early-discount').addEventListener('change', function(){
				earlyDiscount = this.checked;
				recalc();
			});

			modal.querySelector('.kbds-ifp-hdmb-date').addEventListener('change', function(){
				baseDate = this.value || '2027-01-01';
				recalc();
			});

			modal.querySelector('.kbds-btn-close').addEventListener('click', closeModal);
			modal.addEventListener('click', function(e){
				if (e.target === modal) closeModal();
			});

			modal.querySelector('.kbds-btn-download').addEventListener('click', download916);
			modal.querySelector('.kbds-btn-copy').addEventListener('click', function(){
				download916();
				alert('Đã tạo và tải ảnh phiếu tính giá tỷ lệ 9:16 về máy!');
			});

			// Zoom & Pan
			var vp = wrapper.querySelector('.kbds-ifp-viewport');
			var cv = wrapper.querySelector('.kbds-ifp-canvas-wrapper');
			var sc = 1, px = 0, py = 0, drag = false, sx = 0, sy = 0;

			function upd() {
				cv.style.transform = 'translate(' + px + 'px, ' + py + 'px) scale(' + sc + ')';
			}

			wrapper.querySelectorAll('.kbds-ifp-zoom-btn').forEach(function(zb){
				zb.addEventListener('click', function(){
					var act = zb.dataset.zoom;
					if (act === 'in') sc = Math.min(2.5, sc * 1.15);
					else if (act === 'out') sc = Math.max(0.65, sc * 0.85);
					else if (act === 'reset') { sc = 1; px = 0; py = 0; }
					upd();
				});
			});

			vp.addEventListener('mousedown', function(e){
				drag = true;
				vp.classList.add('grabbing');
				sx = e.clientX - px;
				sy = e.clientY - py;
			});
			window.addEventListener('mousemove', function(e){
				if (!drag) return;
				px = e.clientX - sx;
				py = e.clientY - sy;
				upd();
			});
			window.addEventListener('mouseup', function(){
				drag = false;
				vp.classList.remove('grabbing');
			});
			vp.addEventListener('wheel', function(e){
				e.preventDefault();
				sc = (e.deltaY < 0) ? Math.min(2.5, sc * 1.08) : Math.max(0.65, sc * 0.92);
				upd();
			}, { passive: false });

			// Initial render
			renderUnitsList('all', 'all');
		})();
		</script>
		<?php
		return ob_get_clean();
	}
}
