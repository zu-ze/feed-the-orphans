<?php 

class Request 
{
    public function getData()
    {
        $data = $_REQUEST;
        return $data;
    }

    public function getMethod()
    {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }

    public function getPath()
    {
        return $_SERVER['PATH_INFO'] ?? '/';
    }

    public function post($url, $body)
    {
        // Initiate cURL
        $ch = curl_init($url);

        curl_setopt($ch, CURLOPT_URL, $url);

        // tell cURL that we want to send a POST request
        curl_setopt($ch, CURLOPT_POST, 1);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Set the content type to application/json
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

        // Attach our encoded JSON string to the POST fields
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($body));

        $result = curl_exec($ch);

        curl_close($ch);

        return json_decode($result);
    }

    public function get($url, $body)
    {
        $str = '';

        foreach($body as $key => $value) {
            $str .= $key .'='.$value.';'; 
        }
        
        $url = $url .'?'. $str;

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $result = curl_exec($ch);
        curl_close($ch);

        return json_decode($result);
    }
}