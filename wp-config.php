<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'kenhbds' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'NR8[BiybLuf4j%mS`p*`{O)b)?h!xUs>qqub2w{0+&dx kpynRt?[TH><q,^?2#V' );
define( 'SECURE_AUTH_KEY',  'vs]X><V/JW4 zJ[l#G7SQ/T,o7~>~uAWKn+1&[F`eA4Y=6 =MFwAAI@X)Wohl$>f' );
define( 'LOGGED_IN_KEY',    '+f%?%v5iJ~JKNb9:?0HZ~%fNmm%:or{wYmI21#(cnWCw%-8VE!+C:d43uoXyI$S,' );
define( 'NONCE_KEY',        'cU#j%I8$)I$H]*XF/Ey2J~wU[9.uIK!{;dNAYoA;Zf)X|,mzBlN>mg+d45}Nd[+3' );
define( 'AUTH_SALT',        '%c}vXK0eNM$6$pX/S2]?A?[H0#EV>ede?3?I:S)A}u:[I2O%^SxII39x)}a$LQa9' );
define( 'SECURE_AUTH_SALT', '$K@gkBxz]z_J3IjqA$umZw$l{lLz(kTJoi:CmQVVS9LgK/v)l]c,TzOI<z@%,f@U' );
define( 'LOGGED_IN_SALT',   '_zh$1_4tp*:jODFJC oLE-jT(&dgr~lW(1L_VlBn7Mp--&%yZ;#tnqMqjnsPF`/!' );
define( 'NONCE_SALT',       'T/4MbDf?Fs]kUhvR%6G^ydHH~oiCE].0I-B Y?.iuM[lZ@9tQN{bsE,bL_W`jU;W' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 *
 * At the installation time, database tables are created with the specified prefix.
 * Changing this value after WordPress is installed will make your site think
 * it has not been installed.
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/#table-prefix
 */
$table_prefix = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */
define( 'WP_MEMORY_LIMIT', '256M' );
define( 'WP_MAX_MEMORY_LIMIT', '512M' );
define( 'WP_POST_REVISIONS', 5 );       // Giới hạn 5 bản nháp/bài chống phình to Database
define( 'AUTOSAVE_INTERVAL', 120 );     // Tự động lưu mỗi 120 giây
define( 'EMPTY_TRASH_DAYS', 14 );       // Tự động dọn thùng rác sau 14 ngày
define( 'DISALLOW_FILE_EDIT', true );   // Khóa sửa code trực tiếp trong Admin để bảo mật

/**
 * NHẬN DIỆN MÔI TRƯỜNG ĐỘNG (DYNAMIC URL CONFIGURATION)
 * - Trong Database lưu 100% domain chính thức: https://kenhbatdongsan.vn
 * - Khi chạy ở Localhost (XAMPP): Tự động nhận diện và gán URL localhost mà không cần sửa Database
 * - Khi chạy ở Hosting thực tế: Tự động chạy với https://kenhbatdongsan.vn
 */
$http_host = isset( $_SERVER['HTTP_HOST'] ) ? $_SERVER['HTTP_HOST'] : '';
if ( 'localhost' === $http_host || '127.0.0.1' === $http_host || false !== strpos( $http_host, '192.168.' ) ) {
    define( 'WP_HOME', 'http://' . $http_host . '/www/kenhbds' );
    define( 'WP_SITEURL', 'http://' . $http_host . '/www/kenhbds' );
} else {
    define( 'WP_HOME', 'https://kenhbatdongsan.vn' );
    define( 'WP_SITEURL', 'https://kenhbatdongsan.vn' );
}



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
