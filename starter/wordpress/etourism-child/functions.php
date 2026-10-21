<?php
/**
 * E-Tourism Child Theme — functions.php — CSE703072
 * Tệp này được nạp TRƯỚC functions.php của theme cha (Storefront).
 * Không có ký tự nào trước thẻ <?php; không dùng thẻ đóng ở cuối tệp.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Không cho phép truy cập trực tiếp tệp.
}

/**
 * Nạp CSS của theme cha, CSS của theme con và tệp JavaScript tuỳ biến.
 */
function etourism_child_enqueue_assets(): void {
	// TODO 4.2: wp_enqueue_style() cho CSS theme cha, handle 'storefront-parent-style',
	//           nguồn get_template_directory_uri() . '/style.css'
	// TODO 4.3: wp_enqueue_style() cho CSS theme con, handle 'etourism-child-style',
	//           nguồn get_stylesheet_uri(), phụ thuộc array( 'storefront-parent-style' )
	// TODO 4.4: wp_enqueue_script() cho custom.js, handle 'etourism-custom-js',
	//           nguồn get_stylesheet_directory_uri() . '/custom.js', array(), '1.0.0', true
}
// TODO 4.5: đăng ký hàm trên vào hook 'wp_enqueue_scripts' bằng add_action()
