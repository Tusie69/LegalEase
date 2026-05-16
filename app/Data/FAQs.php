<?php

namespace App\Data;

class FAQs
{
    public static function categories(): array
    {
        return [
            'Đặt chỗ và thanh toán',
            'Hủy và hoàn tiền',
            'Dành cho luật sư',
            'Sự tin cậy và an toàn',
        ];
    }

    public static function all(): array
    {
        return [
            // Đặt chỗ và thanh toán
            [
                'category' => 'Đặt chỗ và thanh toán',
                'q' => 'Làm thế nào để đặt lịch tư vấn?',
                'a' => 'Duyệt danh sách luật sư theo chuyên môn, địa điểm và mức phí. Chọn một luật sư, chọn khung giờ trong hồ sơ của họ, rồi xác nhận thông tin của bạn. Chúng tôi sẽ giữ khoản đặt cọc bằng 20% phí tư vấn khi bạn đặt lịch.',
            ],
            [
                'category' => 'Đặt chỗ và thanh toán',
                'q' => 'Khoản đặt cọc là gì?',
                'a' => 'Khi bạn xác nhận đặt chỗ, chúng tôi giữ 20% phí tư vấn làm khoản đặt cọc. 80% còn lại được thanh toán trực tiếp cho luật sư tại buổi tư vấn.',
            ],
            [
                'category' => 'Đặt chỗ và thanh toán',
                'q' => 'Khi nào tôi thanh toán phần còn lại?',
                'a' => 'Tại cuộc hẹn. Nền tảng chỉ giữ khoản đặt cọc; số dư được giải quyết trực tiếp giữa bạn và luật sư.',
            ],
            [
                'category' => 'Đặt chỗ và thanh toán',
                'q' => 'Các bạn chấp nhận những phương thức thanh toán nào?',
                'a' => 'Các loại thẻ tín dụng và thẻ ghi nợ phổ biến, cùng các phương thức thanh toán địa phương như chuyển khoản ngân hàng và ví điện tử.',
            ],

            // Hủy và hoàn tiền
            [
                'category' => 'Hủy và hoàn tiền',
                'q' => 'Làm cách nào để hủy đặt chỗ?',
                'a' => 'Từ bảng điều khiển của bạn, mở thông tin đặt chỗ và nhấn hủy. Chúng tôi sẽ xử lý theo chính sách hoàn tiền.',
            ],
            [
                'category' => 'Hủy và hoàn tiền',
                'q' => 'Tôi có lấy lại được tiền đặt cọc không?',
                'a' => 'Hủy hơn 24 giờ trước cuộc hẹn và bạn sẽ được hoàn lại toàn bộ số tiền. Hủy trong vòng 24 giờ và tiền đặt cọc sẽ bị mất (với một số trường hợp ngoại lệ).',
            ],
            [
                'category' => 'Hủy và hoàn tiền',
                'q' => 'Nếu luật sư của tôi hủy thì sao?',
                'a' => 'Bạn sẽ được hoàn lại toàn bộ khoản đặt cọc, và chúng tôi sẽ giúp bạn tìm một luật sư khác nếu bạn muốn.',
            ],
            [
                'category' => 'Hủy và hoàn tiền',
                'q' => 'Nếu tôi không tới buổi hẹn thì sao?',
                'a' => 'Khoản đặt cọc bị mất. Nền tảng giữ lại 75% và luật sư nhận 25% như khoản bồi thường cho thời gian đã dành.',
            ],

            // Dành cho luật sư
            [
                'category' => 'Dành cho luật sư',
                'q' => 'Làm cách nào để đăng ký tham gia?',
                'a' => 'Truy cập trang Dành cho luật sư và gửi hồ sơ ứng tuyển. Chúng tôi sẽ xem xét chứng chỉ thành viên đoàn luật sư của bạn và phản hồi trong vài ngày làm việc.',
            ],
            [
                'category' => 'Dành cho luật sư',
                'q' => 'Quá trình xác minh mất bao lâu?',
                'a' => 'Thông thường 2 đến 3 ngày làm việc. Các trường hợp phức tạp có thể lâu hơn; chúng tôi sẽ thông báo nếu cần thêm thời gian.',
            ],
            [
                'category' => 'Dành cho luật sư',
                'q' => 'Khi nào tôi được trả tiền?',
                'a' => 'Bạn nhận 100% phí tư vấn. Khách hàng có thể thanh toán trực tiếp tại buổi hẹn, hoặc thanh toán trước qua nền tảng và chúng tôi chuyển vào tài khoản của bạn.',
            ],
            [
                'category' => 'Dành cho luật sư',
                'q' => 'Tôi có thể tự đặt mức phí của mình không?',
                'a' => 'Có. Bạn tự đặt mức phí theo giờ khi đăng ký và có thể cập nhật bất kỳ lúc nào, các thay đổi không ảnh hưởng đến những lượt đặt chỗ đã có.',
            ],

            // Sự tin cậy và an toàn
            [
                'category' => 'Sự tin cậy và an toàn',
                'q' => 'Luật sư được xác minh như thế nào?',
                'a' => 'Mọi luật sư trên nền tảng đều được đội ngũ của chúng tôi kiểm tra tư cách thành viên đoàn luật sư và chứng chỉ trước khi được đăng. Chúng tôi xác minh lại theo định kỳ.',
            ],
            [
                'category' => 'Sự tin cậy và an toàn',
                'q' => 'Việc tư vấn của tôi có được bảo mật không?',
                'a' => 'Có. Việc tư vấn là giữa bạn và luật sư của bạn, được bảo vệ bởi đặc quyền của luật sư-khách hàng theo luật pháp Việt Nam.',
            ],
            [
                'category' => 'Sự tin cậy và an toàn',
                'q' => 'Đánh giá hoạt động như thế nào?',
                'a' => 'Sau khi tư vấn xong, khách hàng có thể để lại đánh giá bằng văn bản và xếp hạng từ 1 đến 5 sao. Đánh giá phải trung thực và dựa trên kinh nghiệm trực tiếp. Luật sư có thể gắn cờ các đánh giá không phù hợp để nhóm của chúng tôi xem xét.',
            ],
        ];
    }
}
