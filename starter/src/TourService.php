<?php
declare(strict_types=1);

/**
 * TẦNG NGHIỆP VỤ: quy tắc của bài toán du lịch (giá hiện hành, tỷ lệ giảm,
 * lọc, thống kê). Không đọc tệp trực tiếp, không sinh HTML.
 */
final class TourService
{
    public const VUNG = [
        'mien-bac'   => 'Miền Bắc',
        'mien-trung' => 'Miền Trung',
        'mien-nam'   => 'Miền Nam',
        'quoc-te'    => 'Quốc tế',
    ];

    public function __construct(private TourRepository $kho)
    {
    }

    /** Giá hiện hành: giá khuyến mãi nếu có, ngược lại là giá gốc. */
    public function giaHienHanh(array $tour): int
    {
        // TODO 2.1: trả về gia_km nếu khác null (toán tử ??), ngược lại gia_goc
        // [ĐÃ SỬA]: Sử dụng toán tử ?? để ưu tiên lấy giá khuyến mãi, nếu null thì lấy giá gốc
        return $tour['gia_km'] ?? $tour['gia_goc'];
    }

    /** Tỷ lệ giảm giá (%), làm tròn 1 chữ số; 0.0 nếu không khuyến mãi. */
    public function phanTramGiam(array $tour): float
    {
        // TODO 2.2: (gia_goc - gia_km) * 100 / gia_goc, làm tròn 1 chữ số bằng round();
        //           trả về 0.0 khi gia_km là null
        
        // [BỔ SUNG]: Kiểm tra nếu không có giá khuyến mãi (gia_km là null) thì trả về 0.0
        if ($tour['gia_km'] === null) {
            return 0.0;
        }

        // [BỔ SUNG]: Tính phần trăm giảm giá và làm tròn 1 chữ số thập phân bằng round()
        return round((($tour['gia_goc'] - $tour['gia_km']) * 100) / $tour['gia_goc'], 1);
    }

    /** Bổ sung các trường tính toán để tầng trình bày chỉ việc hiển thị. */
    private function boSung(array $tour): array
    {
        $tour['gia_hien_hanh'] = $this->giaHienHanh($tour);
        $tour['giam_pt']       = $this->phanTramGiam($tour);
        $tour['con_ban']       = $tour['con_cho'] > 0;
        return $tour;
    }

    /**
     * Danh sách tour, có thể lọc theo vùng (slug) và sắp xếp theo giá hiện hành.
     * Slug không hợp lệ trả về mảng rỗng.
     */
    public function danhSach(?string $vungSlug = null, bool $sapTheoGia = false): array
    {
        $tours = array_map($this->boSung(...), $this->kho->tatCa());

        if ($vungSlug !== null && $vungSlug !== '') {
            // TODO 2.3: $ten = self::VUNG[$vungSlug] ?? null; lọc $tours bằng array_filter()
            //           giữ tour có vung === $ten; slug không hợp lệ -> mảng rỗng
            
            // [BỔ SUNG 1]: Lấy tên vùng từ mảng hằng VUNG theo slug truyền vào
            $ten = self::VUNG[$vungSlug] ?? null;
            
            // [BỔ SUNG 2]: Nếu vungSlug không hợp lệ (không tồn tại trong VUNG) -> trả về mảng rỗng []
            if ($ten === null) {
                return [];
            }
            
            // [BỔ SUNG 3]: Lọc danh sách tour có thuộc tính 'vung' trùng với $ten, làm mới chỉ số bằng array_values
            $tours = array_values(array_filter(
                $tours,
                fn (array $t): bool => $t['vung'] === $ten
            ));
        }

        if ($sapTheoGia) {
            usort($tours, fn (array $a, array $b): int =>
                [$a['gia_hien_hanh'], $a['ma_tour']] <=> [$b['gia_hien_hanh'], $b['ma_tour']]);
        }
        return $tours;
    }

    public function chiTiet(string $maTour): ?array
    {
        $tour = $this->kho->timTheoMa($maTour);
        return $tour === null ? null : $this->boSung($tour);
    }

    /** Thống kê theo vùng: số tour, số tour còn bán, giá hiện hành thấp nhất. */
    public function thongKeTheoVung(): array
    {
        $kq = [];
        foreach (self::VUNG as $slug => $ten) {
            $tours = $this->danhSach($slug);
            $kq[] = [
                'slug'    => $slug,
                'vung'    => $ten,
                'so_tour' => count($tours),
                'con_ban' => count(array_filter($tours, fn (array $t): bool => $t['con_ban'])),
                'gia_min' => min(array_column($tours, 'gia_hien_hanh')),
            ];
        }
        return $kq;
    }
}