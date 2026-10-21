<?php
declare(strict_types=1);
date_default_timezone_set('Asia/Ho_Chi_Minh');

/*
 * FRONT CONTROLLER: mọi yêu cầu của Nhiệm vụ 2 đi qua tệp này.
 * index.php?trang=<tên tuyến>  ->  bảng định tuyến  ->  hàm xử lý  ->  template
 */
require __DIR__ . '/inc/ham.php';
require __DIR__ . '/src/TourRepository.php';
require __DIR__ . '/src/TourService.php';

$dichVu = new TourService(new TourRepository(__DIR__ . '/data/tours.json'));

/** Tầng trình bày: nạp template với các biến trong $duLieu. */
function hienThi(string $mau, array $duLieu, int $maTrangThai = 200): void
{
    http_response_code($maTrangThai);
    extract($duLieu, EXTR_SKIP);
    require __DIR__ . '/inc/header.php';
    require __DIR__ . '/templates/' . $mau . '.php';
    require __DIR__ . '/inc/footer.php';
}

// Bảng định tuyến: tên tuyến => hàm xử lý (controller)
$bangDinhTuyen = [
    'trang-chu' => function () use ($dichVu): void {
        hienThi('trang-chu', [
            'tieuDe'  => 'Tổng quan',
            'thongKe' => $dichVu->thongKeTheoVung(),
        ]);
    },

    // TODO 2.4: bổ sung tuyến 'tours' (đọc $_GET['vung'], $_GET['sap'];
    //           gọi $dichVu->danhSach(); template 'danh-sach' cần các biến
    //           tieuDe, tours, vung, sap, boLoc)
    // [BỔ SUNG - TODO 2.4]: Định tuyến tuyến 'tours'
    'tours' => function () use ($dichVu): void {
        $vung = (string) ($_GET['vung'] ?? '');
        $sap  = (string) ($_GET['sap'] ?? '');
        
        // Đọc danh sách tour đã lọc theo vùng và sắp xếp
        $tours = $dichVu->danhSach($vung, $sap === 'gia');
        
        // Mảng bộ lọc vùng dùng hiển thị nút bấm/menu lựa chọn
        $boLoc = array_merge(['' => 'Tất cả'], TourService::VUNG);
        
        // Tên vùng hiển thị trên tiêu đề trang
        $vungTen = TourService::VUNG[$vung] ?? null;
        $tieuDe  = $vungTen === null ? 'Danh sách tour' : 'Tour ' . $vungTen;

        hienThi('danh-sach', [
            'tieuDe' => $tieuDe,
            'tours'  => $tours,
            'vung'   => $vung,
            'sap'    => $sap,
            'boLoc'  => $boLoc,
        ]);
    },

    // TODO 2.5: bổ sung tuyến 'tour' (đọc $_GET['ma']; gọi $dichVu->chiTiet();
    //           null -> template '404' với mã 404; ngược lại template 'chi-tiet')
    // [BỔ SUNG - TODO 2.5]: Định tuyến tuyến 'tour' (xem chi tiết 1 tour)
    'tour' => function () use ($dichVu): void {
        $ma = (string) ($_GET['ma'] ?? '');
        $tour = $dichVu->chiTiet($ma);

        // Nếu không tìm thấy tour -> nạp template '404' với mã trạng thái HTTP 404
        if ($tour === null) {
            hienThi('404', ['tieuDe' => 'Không tìm thấy'], 404);
            return;
        }

        // Ngược lại nạp template 'chi-tiet'
        hienThi('chi-tiet', [
            'tieuDe' => $tour['ten'],
            'tour'   => $tour,
        ]);
    },
];

$trang = (string) ($_GET['trang'] ?? 'trang-chu');
$xuLy  = $bangDinhTuyen[$trang] ?? null;

// TODO 2.6: nếu $xuLy là null -> hienThi('404', ['tieuDe' => 'Không tìm thấy'], 404);
//           ngược lại gọi $xuLy();
// [ĐÃ SỬA - TODO 2.6]: Gọi hàm xử lý nếu tuyến tồn tại, ngược lại trả về trang 404
if ($xuLy !== null) {
    $xuLy();
} else {
    hienThi('404', ['tieuDe' => 'Không tìm thấy'], 404);
}