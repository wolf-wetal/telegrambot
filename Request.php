<?php


class Request
{
    private $website = '';
    private $token = '';
    private $chat_id = '';

    public function __construct($website, $token, $chat_id) {
        $this->website = $website;
        $this->token = $token;
        $this->chat_id = $chat_id;
    }

    public function request($params, $param_tel, $param_Lead)
    {
        $website = $this->website;
        $token   = $this->token;

        if (!$website || !$token) {
            echo 'URL и token пустые';
            exit;
        }

        if ($param_tel) {
            $url = $website . $token . $param_tel;
        }

        if ($param_Lead) {
            $url = $website . $param_Lead . http_build_query($params);
        }

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLINFO_HEADER_OUT, 1);
        if($param_tel) {
            curl_setopt($ch, CURLOPT_POSTFIELDS, ($params));
        }
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec($ch);
        curl_close($ch);
        return $response;


    }


}