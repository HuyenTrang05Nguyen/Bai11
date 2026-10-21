<?php
declare(strict_types=1);

/** Thoát ký tự đặc biệt trước khi đưa giá trị vào HTML (phòng chống XSS). */
function e(string|int|float|null $giaTri): string
{
    // TODO 1.1: trả về htmlspecialchars(...) với cờ ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'
    
    // THAY THẾ CHO: return (string) $giaTri;
    // Tác dụng: Chuyển đổi các ký tự đặc biệt thành thực thể HTML an toàn, ngăn chặn tấn công XSS; 
    // ép kiểu giá trị sang string và xử lý trường hợp null bằng toán tử ?? '' để tránh lỗi.
    return htmlspecialchars((string) ($giaTri ?? ''), ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

/** Định dạng số tiền theo quy ước Việt Nam: 3500000 -> "3.500.000 ₫". */
function dinhDangGia(int $vnd): string
{
    // TODO 1.2: dùng number_format() với dấu chấm phân tách hàng nghìn, thêm ' ₫'
    
    // THAY THẾ CHO: return (string) $vnd;
    // Tác dụng: Dùng hàm number_format để định dạng số nguyên thành chuỗi có dấu chấm phân cách hàng nghìn 
    // (0 chữ số thập phân, dùng dấu phẩy cho phần thập phân nếu có, dấu chấm cho phần nghìn), sau đó nối thêm ký hiệu ' ₫'.
    return number_format($vnd, 0, ',', '.') . ' ₫';
}

/** Xếp hạng giá bằng biểu thức match (PHP 8.0). */
function hangGia(int $vnd): string
{
    // TODO 1.3: dùng match (true): dưới 3.000.000 -> 'Tiết kiệm';
    //          dưới 10.000.000 -> 'Tiêu chuẩn'; còn lại -> 'Cao cấp'
    
    // THAY THẾ CHO: return 'Chưa xếp hạng';
    // Tác dụng: Dùng cấu trúc match(true) để kiểm tra các điều kiện khoảng giá tiền, 
    // trả về nhãn tương ứng ('Tiết kiệm', 'Tiêu chuẩn', hoặc 'Cao cấp') tùy theo mức giá.
    return match (true) {
        $vnd < 3000000 => 'Tiết kiệm',
        $vnd < 10000000 => 'Tiêu chuẩn',
        default => 'Cao cấp',
    };
}

/** Đổi giá trị tham số vung trên URL thành tên vùng; null nếu không hợp lệ. */
function tenVung(string $slug): ?string
{
    // TODO 1.4: dùng match ($slug): 'mien-bac' -> 'Miền Bắc', 'mien-trung' -> 'Miền Trung',
    //          'mien-nam' -> 'Miền Nam', 'quoc-te' -> 'Quốc tế', default -> null
    
    // THAY THẾ CHO: return null;
    // Tác dụng: Ánh xạ mã vùng trên URL ($slug) sang tên hiển thị tiếng Việt tương ứng 
    // qua biểu thức match. Trả về null nếu mã vùng không khớp với danh sách cho phép.
    return match ($slug) {
        'mien-bac' => 'Miền Bắc',
        'mien-trung' => 'Miền Trung',
        'mien-nam' => 'Miền Nam',
        'quoc-te' => 'Quốc tế',
        default => null,
    };
}

/** Đọc tệp JSON và trả về mảng các tour (mỗi tour là một mảng kết hợp). */
function docTours(string $duongDan): array
{
    $noiDung = file_get_contents($duongDan);
    if ($noiDung === false) {
        throw new RuntimeException('Không đọc được tệp dữ liệu: ' . $duongDan);
    }
    return json_decode($noiDung, true, 512, JSON_THROW_ON_ERROR);
}