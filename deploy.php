<?php
/**
 * Auto-Deploy Script for GitHub Webhook
 * KenhBatDongSan.vn
 *
 * Hướng dẫn sử dụng:
 * 1. Trên GitHub: Vào Repository Settings -> Webhooks -> Add webhook
 * 2. Payload URL: https://kenhbatdongsan.vn/deploy.php
 * 3. Content type: application/json
 * 4. Secret: [TOKEN_BÍ_MẬT_BÊN_DƯỚI]
 * 5. Which events: Just the push event -> Active -> Add webhook
 */

// ĐẶT TOKEN BÍ MẬT TẠI ĐÂY (Khớp với Secret bạn nhập trên GitHub Webhook)
define( 'DEPLOY_SECRET_TOKEN', 'KBDS_Deploy_Secret_2026_Secure_Key_!@#' );

// ĐƯỜNG DẪN THƯ MỤC DỰ ÁN TRÊN HOSTING (Mặc định là thư mục chứa file deploy.php này)
define( 'DEPLOY_DIR', __DIR__ );

// Tên nhánh Git cần kéo về (mặc định master hoặc main)
define( 'DEPLOY_BRANCH', 'master' );

// 1. Kiểm tra phương thức yêu cầu (Chỉ nhận POST)
if ( 'POST' !== ( $_SERVER['REQUEST_METHOD'] ?? '' ) ) {
	http_response_code( 405 );
	die( 'Method Not Allowed' );
}

// 2. Lấy dữ liệu payload từ GitHub
$raw_payload = file_get_contents( 'php://input' );
$signature   = $_SERVER['HTTP_X_HUB_SIGNATURE_256'] ?? '';

// Hỗ trợ kiểm tra qua URL Token dự phòng (nếu gọi bằng GET/POST param: deploy.php?token=...)
$query_token = $_GET['token'] ?? '';

$is_authorized = false;

// Cách A: Xác thực qua chữ ký HMAC SHA256 của GitHub
if ( $signature && strpos( $signature, 'sha256=' ) === 0 ) {
	$expected_hash = hash_hmac( 'sha256', $raw_payload, DEPLOY_SECRET_TOKEN );
	$actual_hash   = substr( $signature, 7 );
	if ( hash_equals( $expected_hash, $actual_hash ) ) {
		$is_authorized = true;
	}
}

// Cách B: Xác thực qua Token bí mật trên URL
if ( ! $is_authorized && $query_token && hash_equals( DEPLOY_SECRET_TOKEN, $query_token ) ) {
	$is_authorized = true;
}

if ( ! $is_authorized ) {
	http_response_code( 403 );
	header( 'Content-Type: application/json' );
	echo json_encode( array( 'status' => 'error', 'message' => 'Invalid signature or secret token.' ) );
	exit;
}

// 3. Thực thi lệnh git pull
header( 'Content-Type: application/json; charset=utf-8' );

chdir( DEPLOY_DIR );

// Tự động nhận diện branch từ GitHub payload nếu có
$target_branch = DEPLOY_BRANCH;
$payload_data  = json_decode( $raw_payload, true );
if ( isset( $payload_data['ref'] ) && preg_match( '#refs/heads/(.+)#', $payload_data['ref'], $matches ) ) {
	$target_branch = trim( $matches[1] );
}

// Danh sách các lệnh thực thi an toàn
$commands = array(
	'git status',
	'git pull origin ' . escapeshellarg( $target_branch ),
);

$output_log = array();
foreach ( $commands as $cmd ) {
	$output = array();
	$return_var = 0;
	exec( $cmd . ' 2>&1', $output, $return_var );
	$output_log[] = array(
		'command' => $cmd,
		'exit_code' => $return_var,
		'output' => implode( "\n", $output ),
	);
	if ( 0 !== $return_var && false !== strpos( $cmd, 'pull' ) ) {
		break;
	}
}

// 4. Trả về kết quả JSON và ghi log
$response = array(
	'status'    => 'success',
	'timestamp' => date( 'Y-m-d H:i:s' ),
	'branch'    => DEPLOY_BRANCH,
	'log'       => $output_log,
);

$log_file = DEPLOY_DIR . '/wp-content/deploy.log';
@file_put_contents( $log_file, "[" . date( 'Y-m-d H:i:s' ) . "] " . json_encode( $response, JSON_UNESCAPED_UNICODE ) . "\n", FILE_APPEND );

echo json_encode( $response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE );
