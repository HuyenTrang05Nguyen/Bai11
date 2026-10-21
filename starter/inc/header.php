<?php
// Phần đầu trang dùng chung. Biến cần có trước khi require: $tieuDe (string).
?>
<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= e($tieuDe) ?> · E-Tourism Lab 11</title>
  <link rel="icon" href="data:,">
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
<header class="dau-trang">
  <div class="khung dau-trang__trong">
    <a class="logo" href="index.php">E-Tourism Lab 11</a>
    <nav aria-label="Điều hướng chính">
      <a href="tours.php">tours.php (Nhiệm vụ 1)</a>
      <a href="index.php?trang=tours">index.php (Nhiệm vụ 2)</a>
    </nav>
  </div>
</header>
<main class="khung">
