<?php
declare(strict_types=1);
/*
 * Công cụ kiểm chứng lời giải (dành cho giảng viên và sinh viên tự kiểm tra).
 * Chạy: php tools/kiem-tra.php   (tại thư mục chứa index.php)
 */
$goc = dirname(__DIR__);
require $goc . '/inc/ham.php';
require $goc . '/src/TourRepository.php';
require $goc . '/src/TourService.php';

$dv = new TourService(new TourRepository($goc . '/data/tours.json'));
$dat = 0; $tong = 0;
function kt(string $ten, mixed $thucTe, mixed $mongDoi): void
{
    global $dat, $tong;
    $tong++;
    $ok = $thucTe === $mongDoi;
    $dat += $ok ? 1 : 0;
    $dem = str_repeat(' ', max(1, 44 - mb_strlen($ten)));
    echo '[', $ok ? 'ĐẠT' : 'SAI', '] ', $ten, $dem, json_encode($thucTe, JSON_UNESCAPED_UNICODE), "\n";
}

echo "== Hàm dùng chung (inc/ham.php) ==\n";
kt('dinhDangGia(3500000)', dinhDangGia(3500000), '3.500.000 ₫');
kt('hangGia(2990000)', hangGia(2990000), 'Tiết kiệm');
kt('hangGia(3000000)', hangGia(3000000), 'Tiêu chuẩn');
kt('hangGia(10000000)', hangGia(10000000), 'Cao cấp');
kt('tenVung("quoc-te")', tenVung('quoc-te'), 'Quốc tế');
kt('tenVung("abc")', tenVung('abc'), null);
kt('e("<b>")', e('<b>'), '&lt;b&gt;');

echo "== Tầng nghiệp vụ (src/TourService.php) ==\n";
kt('danhSach() - số tour', count($dv->danhSach()), 24);
foreach (TourService::VUNG as $slug => $ten) {
    kt("danhSach(\"$slug\") - số tour", count($dv->danhSach($slug)), 6);
}
kt('danhSach("abc") - số tour', count($dv->danhSach('abc')), 0);
$t1 = $dv->chiTiet('T001');
kt('chiTiet(T001).gia_hien_hanh', $t1['gia_hien_hanh'], 3500000);
kt('chiTiet(T001).giam_pt', $t1['giam_pt'], 10.0);
kt('chiTiet(T001).con_ban', $t1['con_ban'], false);
kt('chiTiet(T999)', $dv->chiTiet('T999'), null);
$re = $dv->danhSach(null, true);
kt('Rẻ nhất (sắp theo giá)', $re[0]['ma_tour'] . ' ' . $re[0]['gia_hien_hanh'], 'T018 890000');
kt('Đắt nhất (sắp theo giá)', $re[23]['ma_tour'] . ' ' . $re[23]['gia_hien_hanh'], 'T023 61740000');
echo "== Thống kê theo vùng ==\n";
foreach ($dv->thongKeTheoVung() as $d) {
    echo '      ', $d['vung'], str_repeat(' ', 12 - mb_strlen($d['vung'])),
        "so_tour={$d['so_tour']}  con_ban={$d['con_ban']}  gia_min=", dinhDangGia($d['gia_min']), "\n";
}
printf("KẾT QUẢ: %d/%d phép kiểm tra đạt\n", $dat, $tong);
exit($dat === $tong ? 0 : 1);
