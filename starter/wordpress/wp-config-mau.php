<?php
/**
 * TỆP MẪU wp-config.php — Dự án E-Tourism CSE703072 (môi trường XAMPP cục bộ).
 * Cách dùng: sao chép các giá trị dưới đây vào tệp wp-config.php được tạo từ
 * wp-config-sample.php trong C:\xampp\htdocs\etourism\ (xem Nhiệm vụ 3).
 * Tệp phải lưu ở bảng mã UTF-8 không BOM; không có ký tự nào trước thẻ <?php.
 */

// ** Mục 5.4 — Tham số kết nối cơ sở dữ liệu ** //
define( 'DB_NAME', 'db_tourism_project' ); // TODO 3.1: tên CSDL của dự án
define( 'DB_USER', 'root' );               // TODO 3.1: tài khoản MySQL của XAMPP
define( 'DB_PASSWORD', '' );               // Mật khẩu MySQL (mặc định XAMPP để rỗng)
define( 'DB_HOST', 'localhost' );          // TODO 3.1: máy chủ CSDL
define( 'DB_CHARSET', 'utf8mb4' );         // TODO 3.1: bảng mã
define( 'DB_COLLATE', 'utf8mb4_unicode_ci' );

/*
 * ** Khoá xác thực và chuỗi salt (8 hằng) **
 * KHÔNG dùng lại khoá của người khác và không đưa khoá lên kho mã công khai.
 * Mỗi nhóm tự sinh bộ khoá riêng: mở địa chỉ
 *     https://api.wordpress.org/secret-key/1.1/salt/
 * sao chép đủ 8 dòng define(...) mà trang trả về và dán thay cho 8 dòng
 * tương ứng trong wp-config.php. Tên 8 hằng:
 *     AUTH_KEY, SECURE_AUTH_KEY, LOGGED_IN_KEY, NONCE_KEY,
 *     AUTH_SALT, SECURE_AUTH_SALT, LOGGED_IN_SALT, NONCE_SALT
 */
define('AUTH_KEY',         'x%gT9#mK...vN2$a');
define('SECURE_AUTH_KEY',  'p$1Lq!8z...xY9#m');
define('LOGGED_IN_KEY',    'm#0Pz@3x...aK1!q');
define('NONCE_KEY',        'b&7Yx!2m...pL8$z');
define('AUTH_SALT',        'c$4M#9zK...vN5!a');
define('SECURE_AUTH_SALT', 'e!8Pz@1x...mK3#q');
define('LOGGED_IN_SALT',   'z#3Lq!9m...xY7$a');
define('NONCE_SALT',       'k%2M#8zX...vN4!p');

// Tiền tố tên bảng: chỉ gồm chữ cái, chữ số, dấu gạch dưới; đặt trước khi cài.
$table_prefix = 'wp_';

// Chế độ gỡ lỗi: true khi phát triển trên máy cá nhân, false khi triển khai.
define( 'WP_DEBUG', false );

// ** Mục 5.5 — Vô hiệu hoá trình chỉnh sửa tệp trong khu vực quản trị ** //
define( 'DISALLOW_FILE_EDIT', true ); // TODO 3.2: khai báo hằng DISALLOW_FILE_EDIT với giá trị true

/* That's all, stop editing! Happy publishing. */

/** Đường dẫn tuyệt đối tới thư mục WordPress. */
if ( ! defined( 'ABSPATH' ) ) {
    define( 'ABSPATH', __DIR__ . '/' );
}

/** Nạp các biến và tệp của WordPress. */
require_once ABSPATH . 'wp-settings.php';