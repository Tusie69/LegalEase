<?php

namespace App\Data;

class PracticeAreas
{
    public static function all(): array
    {
        return [
            [
                'slug' => 'family-law',
                'name' => 'Luật Hôn nhân & Gia đình',
                'image_url' => 'https://images.pexels.com/photos/3933084/pexels-photo-3933084.jpeg',
                'description' => 'Ly hôn, quyền nuôi con, tranh chấp thừa kế.',
                'scenarios' => [
                    ['icon' => 'users',     'text' => 'Bạn đang ly hôn và cần tư vấn quyền nuôi con.'],
                    ['icon' => 'scale',     'text' => 'Bạn đang giải quyết tranh chấp thừa kế giữa các thành viên gia đình.'],
                    ['icon' => 'file-text', 'text' => 'Bạn muốn lập thỏa thuận tiền hôn nhân trước khi kết hôn.'],
                ],
            ],
            [
                'slug' => 'business-law',
                'name' => 'Luật Doanh nghiệp',
                'image_url' => 'https://images.pexels.com/photos/7433853/pexels-photo-7433853.jpeg',
                'description' => 'Thành lập công ty, hợp đồng, tuân thủ pháp lý.',
                'scenarios' => [
                    ['icon' => 'briefcase', 'text' => 'Bạn đang thành lập công ty và cần hỗ trợ thủ tục pháp lý.'],
                    ['icon' => 'file-text', 'text' => 'Bạn cần rà soát hợp đồng nhà cung cấp trước khi ký.'],
                    ['icon' => 'scale',     'text' => 'Bạn đang xử lý tranh chấp cổ đông, góp vốn hoặc mua bán doanh nghiệp.'],
                ],
            ],
            [
                'slug' => 'real-estate',
                'name' => 'Bất động sản',
                'image_url' => 'https://images.unsplash.com/photo-1758957530781-4ff54e09bee2?q=80',
                'description' => 'Giao dịch nhà đất, pháp lý sổ, hợp đồng thuê.',
                'scenarios' => [
                    ['icon' => 'home',      'text' => 'Bạn cần kiểm tra pháp lý trước khi mua hoặc bán nhà đất.'],
                    ['icon' => 'file-text', 'text' => 'Bạn chuẩn bị ký hợp đồng thuê thương mại và cần rà soát điều khoản.'],
                    ['icon' => 'map-pin',   'text' => 'Bạn đang tranh chấp ranh giới hoặc quyền sử dụng đất.'],
                ],
            ],
            [
                'slug' => 'criminal-defense',
                'name' => 'Bào chữa hình sự',
                'image_url' => 'https://images.pexels.com/photos/7785069/pexels-photo-7785069.jpeg',
                'description' => 'Bảo vệ quyền lợi và bào chữa trong vụ án hình sự.',
                'scenarios' => [
                    ['icon' => 'shield', 'text' => 'Bạn hoặc người thân đang bị truy cứu trách nhiệm hình sự.'],
                    ['icon' => 'search', 'text' => 'Bạn đang bị điều tra và cần hiểu rõ quyền của mình.'],
                    ['icon' => 'scale',  'text' => 'Bạn cần tư vấn thủ tục kháng cáo bản án hình sự.'],
                ],
            ],
            [
                'slug' => 'labor-law',
                'name' => 'Luật Lao động',
                'image_url' => 'https://images.pexels.com/photos/5583261/pexels-photo-5583261.jpeg',
                'description' => 'Hợp đồng lao động, tranh chấp việc làm, bảo hiểm.',
                'scenarios' => [
                    ['icon' => 'hard-hat',  'text' => 'Bạn bị chấm dứt hợp đồng và nghi ngờ trái luật.'],
                    ['icon' => 'file-text', 'text' => 'Hợp đồng lao động có điều khoản bất lợi hoặc không đúng quy định.'],
                    ['icon' => 'briefcase', 'text' => 'Bạn gặp vấn đề về lương, trợ cấp hoặc bảo hiểm xã hội.'],
                ],
            ],
            [
                'slug' => 'civil-litigation',
                'name' => 'Tố tụng dân sự',
                'image_url' => 'https://images.pexels.com/photos/6077053/pexels-photo-6077053.jpeg',
                'description' => 'Khởi kiện, tranh chấp dân sự và bồi thường thiệt hại.',
                'scenarios' => [
                    ['icon' => 'scale',     'text' => 'Tranh chấp hợp đồng cần khởi kiện hoặc phản tố.'],
                    ['icon' => 'home',      'text' => 'Bạn đang yêu cầu bồi thường thiệt hại về tài sản.'],
                    ['icon' => 'briefcase', 'text' => 'Bạn đang xử lý tranh chấp công nợ hoặc nghĩa vụ thanh toán.'],
                ],
            ],
        ];
    }
}
