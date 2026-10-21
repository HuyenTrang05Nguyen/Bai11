<?php
declare(strict_types=1);

/**
 * TẦNG DỮ LIỆU: chỉ biết cách đọc dữ liệu tour từ nơi lưu trữ (tệp JSON).
 * Không định dạng, không tính toán, không sinh HTML.
 * Ở Bài 12, lớp này được thay bằng lớp đọc từ MySQL/MariaDB qua PDO;
 * hai tầng còn lại không phải sửa.
 */
final class TourRepository
{
    public function __construct(private string $duongDan)
    {
    }

    /** @return list<array<string, mixed>> */
    public function tatCa(): array
    {
        $noiDung = @file_get_contents($this->duongDan);
        if ($noiDung === false) {
            throw new RuntimeException('Không đọc được tệp dữ liệu.');
        }
        return json_decode($noiDung, true, 512, JSON_THROW_ON_ERROR);
    }

    /** @return array<string, mixed>|null */
    public function timTheoMa(string $maTour): ?array
    {
        foreach ($this->tatCa() as $tour) {
            if ($tour['ma_tour'] === $maTour) {
                return $tour;
            }
        }
        return null;
    }
}
