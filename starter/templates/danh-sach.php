<?php /* Biến: $tours, $vung, $sap, $boLoc */ ?>
<h1>Danh sách tour</h1>
<p class="tom-tat">Tìm thấy <strong id="so-tour"><?= count($tours) ?></strong> tour<?=
  $sap ? ', sắp xếp theo giá hiện hành tăng dần' : '' ?>.</p>
<ul class="bo-loc">
<?php foreach ($boLoc as $slug => $nhan): ?>
  <li><a href="index.php?trang=tours<?= $slug === '' ? '' : '&amp;vung=' . e($slug) ?>"
         <?= $slug === $vung ? 'aria-current="page"' : '' ?>><?= e($nhan) ?></a></li>
<?php endforeach; ?>
</ul>
<?php if ($tours === []): ?>
  <p class="thong-bao">Không có tour phù hợp với tham số <code>vung</code> =
    <code><?= e($vung) ?></code>.</p>
<?php endif; ?>
<ul class="luoi-tour">
<?php foreach ($tours as $t): ?>
  <li class="the-tour">
    <div class="the-tour__mau" style="background: <?= e($t['mau']) ?>"></div>
    <div class="the-tour__than">
      <h2><a href="index.php?trang=tour&amp;ma=<?= e($t['ma_tour']) ?>">
        <?= e($t['ten']) ?></a></h2>
      <p class="phu"><?= e($t['ma_tour']) ?> · <?= e($t['vung']) ?> ·
        <?= e($t['so_ngay']) ?>N<?= e($t['so_dem']) ?>Đ</p>
      <p>
        <span class="nhan"><?= e(hangGia($t['gia_hien_hanh'])) ?></span>
        <?php if ($t['giam_pt'] > 0): ?>
          <span class="nhan nhan--km">Giảm <?= e($t['giam_pt']) ?>%</span>
        <?php endif; ?>
        <span class="nhan <?= $t['con_ban'] ? 'nhan--con' : 'nhan--het' ?>">
          <?= $t['con_ban'] ? 'Còn ' . e($t['con_cho']) . ' chỗ' : 'Hết chỗ' ?></span>
      </p>
      <p class="gia"><?= e(dinhDangGia($t['gia_hien_hanh'])) ?></p>
    </div>
  </li>
<?php endforeach; ?>
</ul>
