<?php

namespace App\Data;

class News
{
    public static function categories(): array
    {
        return [
            'Hôn nhân & Gia đình',
            'Doanh nghiệp',
            'Bất động sản',
            'Hình sự',
            'Lao động',
            'Dân sự',
        ];
    }

    public static function all(): array
    {
        return [
            [
                'slug' => 'hop-dong-lao-dong-5-dieu-can-biet',
                'category' => 'Lao động',
                'title' => 'Hợp đồng lao động: 5 điều cần biết khi soạn thảo',
                'lead' => 'Những điều khoản quan trọng giúp bảo vệ quyền lợi của cả người lao động và doanh nghiệp khi ký kết hợp đồng.',
                'image_url' => 'https://images.pexels.com/photos/35136019/pexels-photo-35136019.jpeg',
                'date' => '2026-04-22',
                'author_name' => 'Olivia Bennett',
                'author_slug' => 'olivia-bennett',
                'read_time' => '6 phút đọc',
                'featured' => true,
                'body' => [],
            ],
            [
                'slug' => 'quyen-nuoi-con-sau-ly-hon',
                'category' => 'Hôn nhân & Gia đình',
                'title' => 'Quyền nuôi con sau ly hôn: Tòa án cân nhắc những yếu tố nào',
                'lead' => 'Tổng quan về các tiêu chí pháp lý mà tòa thường dựa vào để quyết định quyền nuôi con khi cha mẹ ly hôn.',
                'image_url' => 'https://images.pexels.com/photos/7642217/pexels-photo-7642217.jpeg',
                'date' => '2026-04-15',
                'author_name' => 'Sarah Mitchell',
                'author_slug' => 'sarah-mitchell',
                'read_time' => '5 phút đọc',
                'featured' => true,
                'body' => [],
            ],
            [
                'slug' => 'mua-ban-nha-dat-kiem-tra-giay-to',
                'category' => 'Bất động sản',
                'title' => 'Mua bán nhà đất: Kiểm tra giấy tờ trước khi ký hợp đồng',
                'lead' => 'Danh sách các giấy tờ pháp lý cần xác minh để tránh tranh chấp khi giao dịch bất động sản.',
                'image_url' => 'https://images.pexels.com/photos/33472306/pexels-photo-33472306.jpeg',
                'date' => '2026-04-08',
                'author_name' => 'Emily Carter',
                'author_slug' => 'emily-carter',
                'read_time' => '7 phút đọc',
                'featured' => true,
                'body' => [],
            ],
            [
                'slug' => 'khi-bi-trieu-tap-quyen-va-nghia-vu',
                'category' => 'Hình sự',
                'title' => 'Khi bị triệu tập: Quyền và nghĩa vụ của bạn',
                'lead' => 'Hiểu rõ quyền im lặng, quyền có luật sư và những việc nên làm khi nhận giấy triệu tập.',
                'image_url' => 'https://images.pexels.com/photos/8124194/pexels-photo-8124194.jpeg',
                'date' => '2026-03-28',
                'author_name' => 'David Reynolds',
                'author_slug' => 'david-reynolds',
                'read_time' => '5 phút đọc',
                'featured' => true,
                'body' => [],
            ],
            [
                'slug' => 'dang-ky-kinh-doanh-chon-loai-hinh',
                'category' => 'Doanh nghiệp',
                'title' => 'Đăng ký kinh doanh: Chọn loại hình doanh nghiệp phù hợp',
                'lead' => 'So sánh nhanh giữa hộ kinh doanh, công ty TNHH và công ty cổ phần để bạn ra quyết định.',
                'image_url' => 'https://images.pexels.com/photos/6326083/pexels-photo-6326083.jpeg',
                'date' => '2026-03-20',
                'author_name' => 'James Anderson',
                'author_slug' => 'james-anderson',
                'read_time' => '8 phút đọc',
                'body' => [],
            ],
            [
                'slug' => 'tranh-chap-thua-ke-phan-chia-tai-san',
                'category' => 'Dân sự',
                'title' => 'Tranh chấp thừa kế: Phân chia tài sản hợp pháp',
                'lead' => 'Quy trình giải quyết khi không có di chúc và những lưu ý để gia đình tránh ra tòa.',
                'image_url' => 'https://images.pexels.com/photos/7693114/pexels-photo-7693114.jpeg',
                'date' => '2026-03-12',
                'author_name' => 'Robert Sullivan',
                'author_slug' => 'robert-sullivan',
                'read_time' => '6 phút đọc',
                'body' => [],
            ],
            [
                'slug' => 'tranh-chap-tien-luong-cac-buoc-hoa-giai',
                'category' => 'Lao động',
                'title' => 'Tranh chấp tiền lương: Các bước hòa giải trước khi khởi kiện',
                'lead' => 'Người lao động có thể làm gì khi doanh nghiệp chậm hoặc không trả lương theo hợp đồng.',
                'image_url' => 'https://images.pexels.com/photos/8469986/pexels-photo-8469986.jpeg',
                'date' => '2026-03-05',
                'author_name' => 'Olivia Bennett',
                'author_slug' => 'olivia-bennett',
                'read_time' => '5 phút đọc',
                'body' => [],
            ],
            [
                'slug' => 'thoa-thuan-tai-san-truoc-hon-nhan',
                'category' => 'Hôn nhân & Gia đình',
                'title' => 'Thỏa thuận tài sản trước hôn nhân: Khi nào nên cân nhắc',
                'lead' => 'Lợi ích pháp lý của việc xác lập tài sản riêng trước khi kết hôn và các tình huống thường gặp.',
                'image_url' => 'https://images.pexels.com/photos/4623175/pexels-photo-4623175.jpeg',
                'date' => '2026-02-26',
                'author_name' => 'Hannah Walsh',
                'author_slug' => 'hannah-walsh',
                'read_time' => '4 phút đọc',
                'body' => [],
            ],
            [
                'slug' => 'hop-dong-thue-nha-dieu-khoan-can-luu-y',
                'category' => 'Bất động sản',
                'title' => 'Hợp đồng thuê nhà: Điều khoản cần lưu ý cho cả hai bên',
                'lead' => 'Tiền cọc, thời hạn, sửa chữa và chấm dứt sớm — những điểm thường gây tranh chấp giữa chủ nhà và người thuê.',
                'image_url' => 'https://images.pexels.com/photos/8901680/pexels-photo-8901680.jpeg',
                'date' => '2026-02-18',
                'author_name' => 'Emily Carter',
                'author_slug' => 'emily-carter',
                'read_time' => '6 phút đọc',
                'body' => [],
            ],
            [
                'slug' => 'boi-thuong-thiet-hai-quy-trinh-yeu-cau',
                'category' => 'Hình sự',
                'title' => 'Bồi thường thiệt hại: Quy trình yêu cầu trong vụ án hình sự',
                'lead' => 'Người bị hại có thể yêu cầu bồi thường ở giai đoạn nào và cần chuẩn bị những tài liệu gì.',
                'image_url' => 'https://images.pexels.com/photos/11154571/pexels-photo-11154571.jpeg',
                'date' => '2026-02-08',
                'author_name' => 'Daniel Foster',
                'author_slug' => 'daniel-foster',
                'read_time' => '5 phút đọc',
                'body' => [],
            ],
            [
                'slug' => 'so-sanh-loai-hinh-doanh-nghiep-viet-nam',
                'category' => 'Doanh nghiệp',
                'title' => 'So sánh các loại hình doanh nghiệp tại Việt Nam',
                'lead' => 'Trách nhiệm pháp lý, vốn tối thiểu và nghĩa vụ thuế của từng mô hình kinh doanh phổ biến.',
                'image_url' => 'https://images.pexels.com/photos/7952556/pexels-photo-7952556.jpeg',
                'date' => '2026-01-30',
                'author_name' => 'James Anderson',
                'author_slug' => 'james-anderson',
                'read_time' => '7 phút đọc',
                'body' => [],
            ],
            [
                'slug' => 'hop-dong-dich-vu-bao-ve-quyen-loi',
                'category' => 'Dân sự',
                'title' => 'Hợp đồng dịch vụ: Cách bảo vệ quyền lợi khi giao dịch',
                'lead' => 'Những điều khoản cần có để hạn chế rủi ro khi ký hợp đồng cung cấp hoặc sử dụng dịch vụ.',
                'image_url' => 'https://images.pexels.com/photos/8428056/pexels-photo-8428056.jpeg',
                'date' => '2026-01-22',
                'author_name' => 'Jessica Hayes',
                'author_slug' => 'jessica-hayes',
                'read_time' => '5 phút đọc',
                'body' => [],
            ],
            [
                'slug' => 'khi-nao-can-luat-su-hinh-su',
                'category' => 'Hình sự',
                'title' => 'Khi nào cần luật sư hình sự: Dấu hiệu cần lưu ý',
                'lead' => 'Những tình huống mà việc có luật sư đồng hành ngay từ đầu có thể thay đổi đáng kể kết quả vụ việc.',
                'image_url' => 'https://images.pexels.com/photos/5583261/pexels-photo-5583261.jpeg',
                'date' => '2026-01-12',
                'author_name' => 'Daniel Foster',
                'author_slug' => 'daniel-foster',
                'read_time' => '5 phút đọc',
                'body' => [],
            ],
            [
                'slug' => 'dang-ky-ket-hon-voi-nguoi-nuoc-ngoai',
                'category' => 'Hôn nhân & Gia đình',
                'title' => 'Đăng ký kết hôn với người nước ngoài: Thủ tục và giấy tờ',
                'lead' => 'Hồ sơ, giấy xác nhận tình trạng hôn nhân và các bước nộp tại cơ quan có thẩm quyền tại Việt Nam.',
                'image_url' => 'https://images.pexels.com/photos/3933084/pexels-photo-3933084.jpeg',
                'date' => '2025-12-28',
                'author_name' => 'Hannah Walsh',
                'author_slug' => 'hannah-walsh',
                'read_time' => '6 phút đọc',
                'body' => [],
            ],
            [
                'slug' => 'tranh-chap-ranh-gioi-dat',
                'category' => 'Bất động sản',
                'title' => 'Tranh chấp ranh giới đất: Cách giải quyết theo pháp luật',
                'lead' => 'Quy trình hòa giải tại địa phương trước khi đưa vụ việc ra tòa và các tài liệu cần chuẩn bị.',
                'image_url' => 'https://images.pexels.com/photos/7433853/pexels-photo-7433853.jpeg',
                'date' => '2025-12-15',
                'author_name' => 'Emily Carter',
                'author_slug' => 'emily-carter',
                'read_time' => '6 phút đọc',
                'body' => [],
            ],
            [
                'slug' => 'bao-hiem-xa-hoi-quyen-loi-nguoi-lao-dong',
                'category' => 'Lao động',
                'title' => 'Bảo hiểm xã hội: Quyền lợi cơ bản của người lao động',
                'lead' => 'Tổng quan các chế độ ốm đau, thai sản, hưu trí và trách nhiệm đóng bảo hiểm của doanh nghiệp.',
                'image_url' => 'https://images.pexels.com/photos/7785069/pexels-photo-7785069.jpeg',
                'date' => '2025-12-02',
                'author_name' => 'Olivia Bennett',
                'author_slug' => 'olivia-bennett',
                'read_time' => '7 phút đọc',
                'body' => [],
            ],
        ];
    }

    public static function featured(): array
    {
        return array_values(array_filter(self::all(), fn ($a) => !empty($a['featured'])));
    }

    public static function find(string $slug): ?array
    {
        foreach (self::all() as $article) {
            if ($article['slug'] === $slug) {
                return $article;
            }
        }
        return null;
    }

    public static function others(): array
    {
        return array_values(array_filter(self::all(), fn ($a) => empty($a['featured'])));
    }
}
