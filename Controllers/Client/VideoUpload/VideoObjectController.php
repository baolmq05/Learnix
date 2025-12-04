<?php
require_once(__DIR__ . "../../../../Config/Global.php");

class VideoObjectController {
    private $_library_id = BUNNY_LIBRARY_ID;
    private $_api_key = BUNNY_API_KEY;
    private $_ch;
    private $_skip_ssl_verify = true;

    public function __construct()
    {
        $this->_ch = curl_init();
    }

    public function createObjectVideo($videoTitle)
    {
        $create_url = "https://video.bunnycdn.com/library/{$this->_library_id}/videos";
        $data_json = json_encode(['title' => $videoTitle]);

        curl_setopt_array($this->_ch, [
            CURLOPT_URL => $create_url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST  => 'POST',
            CURLOPT_POSTFIELDS     => $data_json,
            CURLOPT_HTTPHEADER     => [
                "AccessKey: {$this->_api_key}",
                'Content-Type: application/json',
            ],
            CURLOPT_TIMEOUT        => 30,

            CURLOPT_SSL_VERIFYPEER => !$this->_skip_ssl_verify,
            CURLOPT_SSL_VERIFYHOST => !$this->_skip_ssl_verify ? 2 : 0,
        ]);

        $response = curl_exec($this->_ch);

        $http_code = curl_getinfo($this->_ch, CURLINFO_HTTP_CODE);

        if ($http_code != 200 || !$response) {
            echo "Lỗi khi tạo Video Object. Mã HTTP: {$http_code}\n";
            echo "Lỗi cURL: " . curl_error($this->_ch) . "\n";
            exit;
        }

        return json_decode($response, true)["guid"];
    }

    public function getEncodeProgress($videoId)
    {
        $create_url = "https://video.bunnycdn.com/library/{$this->_library_id}/videos/{$videoId}";

        curl_setopt_array($this->_ch, [
            CURLOPT_URL => $create_url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST  => 'GET',
            CURLOPT_HTTPHEADER     => [
                "AccessKey: {$this->_api_key}",
                'Content-Type: application/json',
            ],
            CURLOPT_TIMEOUT        => 30,

            CURLOPT_SSL_VERIFYPEER => !$this->_skip_ssl_verify,
            CURLOPT_SSL_VERIFYHOST => !$this->_skip_ssl_verify ? 2 : 0,
        ]);

        $response = curl_exec($this->_ch);

        $http_code = curl_getinfo($this->_ch, CURLINFO_HTTP_CODE);

        if ($http_code != 200 || !$response) {
            echo "Lỗi khi lấy Video Object. Mã HTTP: {$http_code}\n";
            echo "Lỗi cURL: " . curl_error($this->_ch) . "\n";
            exit;
        }

        echo $response;
    }

    public function deleteVideo($videoId) {
        $delete_url = "https://video.bunnycdn.com/library/{$this->_library_id}/videos/{$videoId}";

        curl_setopt_array($this->_ch, [
            CURLOPT_URL => $delete_url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST  => 'DELETE',
            CURLOPT_HTTPHEADER     => [
                "AccessKey: {$this->_api_key}",
                'Content-Type: application/json',
            ],
            CURLOPT_TIMEOUT        => 30,

            CURLOPT_SSL_VERIFYPEER => !$this->_skip_ssl_verify,
            CURLOPT_SSL_VERIFYHOST => !$this->_skip_ssl_verify ? 2 : 0,
        ]);

        $response = curl_exec($this->_ch);

        $http_code = curl_getinfo($this->_ch, CURLINFO_HTTP_CODE);

        if ($http_code != 200 || !$response) {
            echo "Lỗi khi tạo Video Object Xóa thất bại. Mã HTTP: {$http_code}\n";
            echo "Lỗi cURL: " . curl_error($this->_ch) . "\n";
            exit;
        }

        return json_decode($response, true)["statusCode"];
    }
}