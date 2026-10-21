<?php /* Biến: $tour (đã có gia_hien_hanh, giam_pt, con_ban) */ ?>
<h1><?= e($tour['ten']) ?></h1>
<section class="chi-tiet">
  <p><?= e($tour['mo_ta']) ?></p>
  <dl>
    <dt>Mã tour</dt><dd><?= e($tour['ma_tour']) ?></dd>
    <dt>Vùng / điểm đến</dt><dd><?= e($tour['vung']) ?> / <?= e($tour['diem_den']) ?></dd>
    <dt>Thời lượng</dt><dd><?= e($tour['so_ngay']) ?> ngày <?= e($tour['so_dem']) ?> đêm</dd>
    <dt>Khởi hành</dt><dd><?= e(date('d/m/Y', strtotime($tour['khoi_hanh']))) ?></dd>
    <dt>Giá gốc</dt><dd><?= e(dinhDangGia($tour['gia_goc'])) ?></dd>
    <dt>Giá hiện hành</dt><dd><strong><?= e(dinhDangGia($tour['gia_hien_hanh'])) ?></strong>
      (<?= e(hangGia($tour['gia_hien_hanh'])) ?>; giảm <?= e($tour['giam_pt']) ?>%)</dd>
    <dt>Tình trạng</dt><dd><?= $tour['con_ban']
      ? 'Còn ' . e($tour['con_cho']) . '/' . e($tour['so_cho']) . ' chỗ' : 'Hết chỗ' ?></dd>
  </dl>
</section>
<p><a href="index.php?trang=tours">← Quay lại danh sách</a></p>
