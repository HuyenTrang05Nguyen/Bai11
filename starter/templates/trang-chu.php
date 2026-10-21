<?php /* Biến: $thongKe (mảng thống kê theo vùng) */ ?>
<h1>Tổng quan tour theo vùng</h1>
<p class="tom-tat">Trang được sinh qua front controller <code>index.php</code>,
  tuyến <code>trang-chu</code>.</p>
<table class="bang">
  <thead>
    <tr><th>Vùng</th><th>Số tour</th><th>Còn bán</th><th>Giá hiện hành thấp nhất</th></tr>
  </thead>
  <tbody>
  <?php foreach ($thongKe as $dong): ?>
    <tr>
      <td><a href="index.php?trang=tours&amp;vung=<?= e($dong['slug']) ?>">
        <?= e($dong['vung']) ?></a></td>
      <td class="so"><?= e($dong['so_tour']) ?></td>
      <td class="so"><?= e($dong['con_ban']) ?></td>
      <td class="so"><?= e(dinhDangGia($dong['gia_min'])) ?></td>
    </tr>
  <?php endforeach; ?>
  </tbody>
</table>
