<?php
declare(strict_types=1);
date_default_timezone_set('Asia/Ho_Chi_Minh');

require __DIR__ . '/inc/ham.php';

// 1. Dữ liệu: đọc toàn bộ tour từ tệp JSON
$tours = docTours(__DIR__ . '/data/tours.json');

// 2. Đầu vào: tham số vung trên URL (không tin cậy dữ liệu từ trình duyệt)
// TODO 1.5: đọc $_GET['vung'] (mặc định chuỗi rỗng, ép kiểu string);
//           $vungTen = null nếu rỗng, ngược lại = tenVung($vungSlug);
//           $hopLe = true khi tham số rỗng hoặc $vungTen khác null

// THAY THẾ CHO: $vungSlug = ''; $vungTen = null; $hopLe = true;
// Tác dụng: Đọc tham số 'vung' từ URL an toàn, kiểm tra tính hợp lệ của slug và chuyển đổi thành tên vùng hiển thị.
$vungSlug = (string) ($_GET['vung'] ?? '');
$vungTen  = $vungSlug === '' ? null : tenVung($vungSlug);
$hopLe    = ($vungSlug === '' || $vungTen !== null);

// 3. Xử lý: lọc theo vùng
// TODO 1.6: nếu tham số không hợp lệ -> $tours = [];
//           nếu có $vungTen -> lọc bằng array_filter() + array_values()

// THAY THẾ HOẶC BỔ SUNG CHO PHẦN XỬ LÝ LỌC:
// Tác dụng: Nếu tham số trên URL không hợp lệ thì gán mảng tours rỗng; nếu hợp lệ và có chọn vùng thì lọc mảng $tours theo đúng khu vực đó, sau đó dùng array_values để làm mới lại chỉ số (index) của mảng.
if (!$hopLe) {
    $tours = [];
} elseif ($vungTen !== null) {
    $tours = array_values(array_filter($tours, fn($t) => ($t['vung'] ?? '') === $vungTen));
}

$boLoc  = ['' => 'Tất cả', 'mien-bac' => 'Miền Bắc', 'mien-trung' => 'Miền Trung',
           'mien-nam' => 'Miền Nam', 'quoc-te' => 'Quốc tế'];
$tieuDe = $vungTen === null ? 'Danh sách tour' : 'Tour ' . $vungTen;

// 4. Trình bày
// TODO 1.7: nạp phần đầu trang bằng require __DIR__ . '/inc/header.php';
// THÊM MỚI / THAY THẾ: Nạp giao diện phần đầu trang.
require __DIR__ . '/inc/header.php';
?>
<h1><?= e($tieuDe) ?></h1>
<p class="tom-tat">Tìm thấy <strong id="so-tour"><?= count($tours) ?></strong> tour.</p>

<ul class="bo-loc">
<?php foreach ($boLoc as $slug => $nhan): ?>
  <li><a href="tours.php<?= $slug === '' ? '' : '?vung=' . e($slug) ?>"
         <?= $slug === $vungSlug ? 'aria-current="page"' : '' ?>><?= e($nhan) ?></a></li>
<?php endforeach; ?>
</ul>

<?php if (!$hopLe): ?>
  <p class="thong-bao">Giá trị tham số <code>vung</code> không hợp lệ:
    <code><?= e($vungSlug) ?></code>.</p>
<?php endif; ?>

<ul class="luoi-tour">
<?php foreach ($tours as $t): ?>
  <?php $gia = $t['gia_km'] ?? $t['gia_goc']; ?>
  <li class="the-tour">
    <div class="the-tour__mau" style="background: <?= e($t['mau']) ?>"></div>
    <div class="the-tour__than">
      <h2><?= e($t['ten']) ?></h2>
      <p class="phu"><?= e($t['ma_tour']) ?> · <?= e($t['diem_den']) ?> ·
        <?= e($t['so_ngay']) ?>N<?= e($t['so_dem']) ?>Đ</p>
      <p>
        <span class="nhan"><?= e(hangGia($gia)) ?></span>
        <?php if ($t['gia_km'] !== null): ?>
          <span class="nhan nhan--km">Khuyến mãi</span>
        <?php endif; ?>
        <?php if ($t['con_cho'] === 0): ?>
          <span class="nhan nhan--het">Hết chỗ</span>
        <?php endif; ?>
      </p>
      <p class="gia"><?= e(dinhDangGia($gia)) ?>
        <?php // TODO 1.8: nếu có gia_km thì in thêm giá gốc trong thẻ <s>...</s> ?>
        <?php 
        // THÊM MỚI: Kiểm tra nếu có giá khuyến mãi thì hiển thị giá gốc gạch ngang bên cạnh.
        // Tác dụng: Cung cấp thông tin trực quan về mức giá cũ trước khi giảm cho khách hàng.
        if ($t['gia_km'] !== null): 
        ?>
          <s><?= e(dinhDangGia($t['gia_goc'])) ?></s>
        <?php endif; ?>
      </p>
    </div>
  </li>
<?php endforeach; ?>
</ul>
<?php 
// TODO 1.7: nạp phần chân trang bằng require __DIR__ . '/inc/footer.php'; 
// THÊM MỚI: Nạp giao diện phần chân trang.
require __DIR__ . '/inc/footer.php'; 
?>