<?php
declare(strict_types=1);
/*
 * Gửi yêu cầu HTTP tới máy chủ đang chạy và đếm số thẻ tour trong HTML trả về.
 * Chạy: php tools/kiem-tra-http.php [địa chỉ gốc]
 *   php -S:  php tools/kiem-tra-http.php http://127.0.0.1:8011
 *   XAMPP :  php tools/kiem-tra-http.php http://localhost/etourism/lab11/bailam
 */
$goc = rtrim($argv[1] ?? 'http://127.0.0.1:8011', '/');
$ds = [
    'tours.php', 'tours.php?vung=mien-bac', 'tours.php?vung=mien-trung',
    'tours.php?vung=mien-nam', 'tours.php?vung=quoc-te', 'tours.php?vung=abc',
    'tours.php?vung=%3Cscript%3Ealert(1)%3C/script%3E',
    'index.php', 'index.php?trang=tours', 'index.php?trang=tours&vung=quoc-te',
    'index.php?trang=tours&vung=abc', 'index.php?trang=tour&ma=T009',
    'index.php?trang=tour&ma=T999', 'index.php?trang=khong-co',
];
$nguCanh = stream_context_create(['http' => ['ignore_errors' => true]]);
printf("%-50s %-4s %-8s %s\n", 'URL', 'Mã', 'Thẻ tour', 'Thoát <script>');
foreach ($ds as $u) {
    $html = (string) @file_get_contents($goc . '/' . $u, false, $nguCanh);
    $ma   = isset($http_response_header[0]) ? explode(' ', $http_response_header[0])[1] : '---';
    $thoat = str_contains($u, 'script')
        ? (str_contains($html, '<script>alert') ? 'KHÔNG' : (str_contains($html, '&lt;script&gt;') ? 'có' : '?'))
        : '';
    printf("%-50s %-4s %-8d %s\n", $u, $ma, substr_count($html, 'class="the-tour"'), $thoat);
}
