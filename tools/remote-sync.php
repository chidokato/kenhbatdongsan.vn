<?php
/**
 * Remote WordPress REST API Client for kenhbatdongsan.vn
 * Công cụ gửi bài viết chuẩn SEO, đồng bộ nội dung từ xa qua Application Password
 */

class KBDS_Remote_Sync {

	// Cấu hình kết nối từ xa
	private static $api_url  = 'https://kenhbatdongsan.vn/wp-json/wp/v2';
	private static $username = ''; // Điền User Admin
	private static $app_pass = ''; // Điền Application Password (16 ký tự)

	public static function set_credentials( $username, $app_pass ) {
		self::$username = trim( $username );
		self::$app_pass = trim( $app_pass );
	}

	private static function get_auth_header() {
		return 'Basic ' . base64_encode( self::$username . ':' . self::$app_pass );
	}

	/**
	 * Tạo hoặc cập nhật bài viết trên Hosting qua REST API
	 */
	public static function publish_remote_post( $post_data ) {
		$url = self::$api_url . '/posts';

		$payload = array(
			'title'   => $post_data['title'],
			'content' => $post_data['content'],
			'status'  => $post_data['status'] ?? 'publish',
		);

		if ( ! empty( $post_data['excerpt'] ) ) {
			$payload['excerpt'] = $post_data['excerpt'];
		}
		if ( ! empty( $post_data['categories'] ) ) {
			$payload['categories'] = (array) $post_data['categories'];
		}
		if ( ! empty( $post_data['featured_media'] ) ) {
			$payload['featured_media'] = (int) $post_data['featured_media'];
		}

		return self::send_request( $url, 'POST', $payload );
	}

	/**
	 * Tải hình ảnh lên Media Library trên Hosting qua REST API
	 */
	public static function upload_remote_image( $file_path, $alt_text = '', $title = '' ) {
		$url = self::$api_url . '/media';

		if ( ! file_exists( $file_path ) ) {
			return array( 'status' => 'error', 'message' => 'File không tồn tại: ' . $file_path );
		}

		$filename = basename( $file_path );
		$filedata = file_get_contents( $file_path );
		$filetype = mime_content_type( $file_path );

		$headers = array(
			'Authorization: ' . self::get_auth_header(),
			'Content-Disposition: attachment; filename="' . $filename . '"',
			'Content-Type: ' . $filetype,
		);

		$ch = curl_init();
		curl_setopt( $ch, CURLOPT_URL, $url );
		curl_setopt( $ch, CURLOPT_POST, true );
		curl_setopt( $ch, CURLOPT_POSTFIELDS, $filedata );
		curl_setopt( $ch, CURLOPT_HTTPHEADER, $headers );
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
		curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false );
		curl_setopt( $ch, CURLOPT_TIMEOUT, 60 );

		$response = curl_exec( $ch );
		$http_code = curl_getinfo( $ch, CURLINFO_HTTP_CODE );
		curl_close( $ch );

		$data = json_decode( $response, true );
		if ( $http_code >= 200 && $http_code < 300 && ! empty( $data['id'] ) ) {
			// Cập nhật Alt Text & Caption nếu có
			if ( $alt_text || $title ) {
				self::update_media_meta( $data['id'], $alt_text, $title );
			}
			return array( 'status' => 'success', 'id' => $data['id'], 'url' => $data['source_url'] );
		}

		return array( 'status' => 'error', 'http_code' => $http_code, 'response' => $data );
	}

	private static function update_media_meta( $media_id, $alt_text, $title ) {
		$url = self::$api_url . '/media/' . $media_id;
		$payload = array();
		if ( $alt_text ) {
			$payload['alt_text'] = $alt_text;
		}
		if ( $title ) {
			$payload['title'] = $title;
		}
		self::send_request( $url, 'POST', $payload );
	}

	private static function send_request( $url, $method = 'POST', $payload = array() ) {
		$headers = array(
			'Authorization: ' . self::get_auth_header(),
			'Content-Type: application/json',
		);

		$ch = curl_init();
		curl_setopt( $ch, CURLOPT_URL, $url );
		curl_setopt( $ch, CURLOPT_CUSTOMREQUEST, $method );
		if ( ! empty( $payload ) ) {
			curl_setopt( $ch, CURLOPT_POSTFIELDS, json_encode( $payload ) );
		}
		curl_setopt( $ch, CURLOPT_HTTPHEADER, $headers );
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
		curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false );
		curl_setopt( $ch, CURLOPT_TIMEOUT, 30 );

		$response = curl_exec( $ch );
		$http_code = curl_getinfo( $ch, CURLINFO_HTTP_CODE );
		curl_close( $ch );

		$data = json_decode( $response, true );
		if ( $http_code >= 200 && $http_code < 300 ) {
			return array( 'status' => 'success', 'data' => $data );
		}

		return array( 'status' => 'error', 'http_code' => $http_code, 'response' => $data );
	}
}
