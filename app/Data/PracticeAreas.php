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
                'icon' => 'users',
                'description' => 'Ly hôn, quyền nuôi con, tranh chấp thừa kế.',
                'scenarios' => [
                    'Bạn đang ly hôn và cần tư vấn quyền nuôi con.',
                    'Bạn đang giải quyết tranh chấp thừa kế giữa các thành viên gia đình.',
                    'Bạn muốn lập thỏa thuận tiền hôn nhân trước khi kết hôn.',
                ],
            ],
            [
                'slug' => 'business-law',
                'name' => 'Luật Doanh nghiệp',
                'icon' => 'briefcase',
                'description' => 'Thành lập công ty, hợp đồng, tuân thủ pháp lý.',
                'scenarios' => [
                    'Bạn đang thành lập công ty và cần hỗ trợ thủ tục pháp lý.',
                    'Bạn cần rà soát hợp đồng nhà cung cấp trước khi ký.',
                    'Bạn đang xử lý tranh chấp cổ đông, góp vốn hoặc mua bán doanh nghiệp.',
                ],
            ],
            [
                'slug' => 'real-estate',
                'name' => 'Bất động sản',
                'icon' => 'home',
                'description' => 'Giao dịch nhà đất, pháp lý sổ, hợp đồng thuê.',
                'scenarios' => [
                    'Bạn cần kiểm tra pháp lý trước khi mua hoặc bán nhà đất.',
                    'Bạn chuẩn bị ký hợp đồng thuê thương mại và cần rà soát điều khoản.',
                    'Bạn đang tranh chấp ranh giới hoặc quyền sử dụng đất.',
                ],
            ],
            [
                'slug' => 'criminal-defense',
                'name' => 'Bào chữa hình sự',
                'icon' => 'shield',
                'description' => 'Bảo vệ quyền lợi và bào chữa trong vụ án hình sự.',
                'scenarios' => [
                    'Bạn hoặc người thân đang bị truy cứu trách nhiệm hình sự.',
                    'Bạn đang bị điều tra và cần hiểu rõ quyền của mình.',
                    'Bạn cần tư vấn thủ tục kháng cáo bản án hình sự.',
                ],
            ],
            [
                'slug' => 'labor-law',
                'name' => 'Luật Lao động',
                'icon' => 'hard-hat',
                'description' => 'Hợp đồng lao động, tranh chấp việc làm, bảo hiểm.',
                'scenarios' => [
                    'Bạn bị chấm dứt hợp đồng và nghi ngờ trái luật.',
                    'Hợp đồng lao động có điều khoản bất lợi hoặc không đúng quy định.',
                    'Bạn gặp vấn đề về lương, trợ cấp hoặc bảo hiểm xã hội.',
                ],
            ],
            [
                'slug' => 'civil-litigation',
                'name' => 'Tố tụng dân sự',
                'icon' => 'scale',
                'description' => 'Khởi kiện, tranh chấp dân sự và bồi thường thiệt hại.',
                'scenarios' => [
                    'Tranh chấp hợp đồng cần khởi kiện hoặc phản tố.',
                    'Bạn đang yêu cầu bồi thường thiệt hại về tài sản.',
                    'Bạn đang xử lý tranh chấp công nợ hoặc nghĩa vụ thanh toán.',
                ],
            ],
        ];
    }
}
