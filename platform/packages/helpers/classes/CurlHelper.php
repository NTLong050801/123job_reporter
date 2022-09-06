<?php
/**
 * Created by PhpStorm.
 * User: Hungokata
 * Date: 8/28/18
 * Time: 9:52 AM
 */

class CurlHelper
{
    /**
     * Nhận toàn bộ thông tin html bằng một $url truyền vào
     * @param string $url : Đường dẫn url cần lấy
     * @param string $cookie :Có lưu cookie hay không
     * @return html
     */
    public static function getHtmlByUrl($url = '', $cookie = '')
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_AUTOREFERER, TRUE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.80 Safari/537.36');
        if ($cookie) {
            curl_setopt($ch, CURLOPT_COOKIE, $cookie);
        }
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_ENCODING, "gzip");
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
        $data = curl_exec($ch);
        if (curl_error($ch)) {
            echo 'error:' . curl_error($ch);
        }
        curl_close($ch);
        return $data;
    }

    /**
     * Created by : BillJanny
     * Date: 19:28 - 13/01/17
     * Nhận thông tin dữ liệu từ một url truyền vào
     * @param string $url : any path $url
     * @param boolaen $showHeader : có header không
     * @return array
     */
    public static function getDataByUrl($url, $showHeader = false)
    {
        $ch = curl_init();
        $timeout = 5;
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, true);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.80 Safari/537.36');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_ENCODING, "gzip");
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
        $data = curl_exec($ch);
        if ($showHeader) {
            $header = curl_getinfo($ch);
            echo_array($header);
        }
        curl_close($ch);

        return $data;
    }

    public static function postData($url, $data = [])
    {
        $ch = curl_init();                    // initiate curl
        curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_POST, true);  // tell curl you want to post something
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data); // define what you want to post
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // return the output in string format
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: multipart/form-data')
        );
        $output = curl_exec ($ch); // execute
        curl_close ($ch); // close curl handle
        return $output;
    }
}