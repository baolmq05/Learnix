<?php
require_once "../../../Config/Global.php";

class ChatBotController
{
    public function getMessage($history)
    {
        $prompt = PROMPT_AI;

        $courseInfo = $this->getCourseInfo();

        if ($courseInfo != null) {
            $prompt .= "\n\nDỮ LIỆU KHÓA HỌC:\n" . $courseInfo;
        }

        $apiKey = GEMINI_API_KEY;

        $contents = [
            [
                'role' => 'user',
                'parts' => [
                    ['text' => $prompt]
                ]
            ]
        ];

        foreach ($history as $item) {
            $contents[] = [
                'role' => $item['role'],
                'parts' => [
                    ['text' => $item['text']]
                ]
            ];
        }

        $ch = curl_init(
            'https://generativelanguage.googleapis.com/v1beta/models/gemini-2.5-flash-lite:generateContent'
        );

        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_HTTPHEADER => [
                'Content-Type: application/json',
                'x-goog-api-key: ' . $apiKey
            ],
            CURLOPT_POSTFIELDS => json_encode([
                'contents' => $contents
            ]),
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => false
        ]);

        $response = curl_exec($ch);

        if ($response == false) {
            return 'Curl error: ' . curl_error($ch);
        }

        $result = json_decode($response, true);

        // return $result['candidates'][0]['content']['parts'][0]['text']
        //     ?? '<div class="bg-red-100 text-red-600 px-3 py-2 rounded-xl">Bot không thể trả lời lúc này.</div>';

        return $result['candidates'][0]['content']['parts'][0]['text'] ?? $result;
    }

    public function getCourseInfo()
    {
        if (isset($_SESSION["history_chat"])) return null;

        require_once "../../../Models/ChatBot.php";
        $chatbotModel = new ChatBot();
        $chatResult = $chatbotModel->getCourseInfo();

        $resultInfo = "";

        foreach ($chatResult as $course) {

            $courseName        = !empty($course['course_name']) ? $course['course_name'] : 'chưa cập nhật';
            $courseImage        = !empty($course['course_image']) ? $course['course_image'] : 'chưa cập nhật';
            $basePrice         = !empty($course['course_base_price']) ? number_format($course['course_base_price']) . ' VNĐ' : 'chưa cập nhật';
            $salePrice         = !empty($course['course_sale_price']) ? number_format($course['course_sale_price']) . ' VNĐ' : 'chưa cập nhật';
            $courseId          = !empty($course['course_id']) ? $course['course_id'] : 'chưa cập nhật';
            $description       = !empty($course['course_description']) ? $course['course_description'] : 'chưa cập nhật';
            $teacherName       = !empty($course['teacher_name']) ? $course['teacher_name'] : 'chưa cập nhật';
            $categoryName      = !empty($course['category_name']) ? $course['category_name'] : 'chưa cập nhật';

            $resultInfo .= "Tên khóa học: {$courseName}\n";
            $resultInfo .= "Tên hình ảnh khóa học: {./Uploads/Courses/$courseImage}\n";
            $resultInfo .= "Giảng viên: {$teacherName}\n";
            $resultInfo .= "Danh mục: {$categoryName}\n";
            $resultInfo .= "Giá gốc: {$basePrice}\n";
            $resultInfo .= "Giá ưu đãi: {$salePrice}\n";
            $resultInfo .= "Mã khóa học: {$courseId}\n";
            $resultInfo .= "Mô tả: {$description}\n";
            $resultInfo .= "-----------------------------\n";
        }

        $resultInfo .= ". Không được để lộ mã khóa học ra";

        return trim($resultInfo);
    }
}

// $control = new ChatBotController();
// $control->getCourseInfo();
