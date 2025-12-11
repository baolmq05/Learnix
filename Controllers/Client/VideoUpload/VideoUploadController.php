<?php
set_time_limit(0);
require_once(__DIR__ . "../../../../Config/Global.php");


class VideoUploadController
{
    private $libraryId = BUNNY_LIBRARY_ID;
    private $videoId = '';
    private $apiKey = BUNNY_API_KEY;
    private $filePath = '';
    private $_skip_ssl_verify = true;
    private $ch;

    public function execUpload($file, $videoId)
    {
        // $this->videoId = $videoId;
        $fileName = $file["tmp_name"];
        $this->filePath = $fileName;

        $currentVideoId = $this->uploadVideoIntoBunny($videoId);
        return $currentVideoId;
    }

    public function openBinaryFile()
    {
        $fp = fopen($this->filePath, 'rb');      
        if ($fp === false) {
            die("Không thể mở file: $this->filePath\n"); 
        }

        return $fp;
    }

    public function getSize($fp)
    {
        $size = filesize($this->filePath);            
        if ($size === false) {
            fclose($fp);
            die("Không thể lấy filesize cho: $this->filePath\n");
        }

        return $size;
    }

    public function configCurl($fp, $size)
    {
        curl_setopt($this->ch, CURLOPT_PUT, true);        
        curl_setopt($this->ch, CURLOPT_INFILE, $fp);      
        curl_setopt($this->ch, CURLOPT_INFILESIZE, $size); 
        curl_setopt($this->ch, CURLOPT_SSL_VERIFYPEER, !$this->_skip_ssl_verify);
        curl_setopt($this->ch, CURLOPT_SSL_VERIFYHOST, !$this->_skip_ssl_verify ? 2 : 0);

        curl_setopt($this->ch, CURLOPT_HTTPHEADER, [
            "AccessKey: {$this->apiKey}",                 
            "Content-Type: application/octet-stream"
        ]);

        curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, true);

        curl_setopt($this->ch, CURLOPT_TIMEOUT, 0);      
        curl_setopt($this->ch, CURLOPT_CONNECTTIMEOUT, 10); 
    }

    public function configUpdateCurl($fp, $size) {
        curl_setopt($this->ch, CURLOPT_POST, true);        
        curl_setopt($this->ch, CURLOPT_INFILE, $fp);      
        curl_setopt($this->ch, CURLOPT_INFILESIZE, $size); 
        curl_setopt($this->ch, CURLOPT_SSL_VERIFYPEER, !$this->_skip_ssl_verify);
        curl_setopt($this->ch, CURLOPT_SSL_VERIFYHOST, !$this->_skip_ssl_verify ? 2 : 0);

        curl_setopt($this->ch, CURLOPT_HTTPHEADER, [
            "AccessKey: {$this->apiKey}",                 
            "Content-Type: application/octet-stream"
        ]);

        curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, true);

        curl_setopt($this->ch, CURLOPT_TIMEOUT, 0);      
        curl_setopt($this->ch, CURLOPT_CONNECTTIMEOUT, 10); 
    }

    public function uploadVideoIntoBunny($videoId)
    {
        $fp = $this->openBinaryFile();
        if ($fp == false) {
            echo "Không thể mở file bằng nhị phân";
            return;
        }

        $size = $this->getSize($fp);
        if ($size == false) {
            echo "Không thể lấy filesize";
            return;
        }

        // CURL
        $url = "https://video.bunnycdn.com/library/{$this->libraryId}/videos/{$videoId}";
        $this->ch = curl_init($url);
        $this->configCurl($fp, $size);

        $response = curl_exec($this->ch);              
        $err = curl_error($this->ch);                     
        $http = curl_getinfo($this->ch, CURLINFO_HTTP_CODE); 

        fclose($fp);

        if ($response === false) {
            echo "Lỗi cURL: $err\n";
        } else {
            return $videoId;
        }
    }

     public function updateVideoIntoBunny($file, $videoId)
    {
        $fileName = $file["tmp_name"];
        $this->filePath = $fileName;

        $fp = $this->openBinaryFile();
        if ($fp == false) {
            echo "Không thể mở file bằng nhị phân";
            return;
        }

        $size = $this->getSize($fp);
        if ($size == false) {
            echo "Không thể lấy filesize";
            return;
        }

        // CURL
        $url = "https://video.bunnycdn.com/library/{$this->libraryId}/videos/{$videoId}";
        $this->ch = curl_init($url);
        $this->configUpdateCurl($fp, $size);

        $response = curl_exec($this->ch);              
        $err = curl_error($this->ch);                     
        $http = curl_getinfo($this->ch, CURLINFO_HTTP_CODE); 

        fclose($fp);

        if ($response === false) {
            echo "Lỗi cURL: $err\n";
        } else {
            echo "Thành công nè";
        }
    }
}
