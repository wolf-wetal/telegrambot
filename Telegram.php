<?php

include_once ('Request.php');

class Telegram
{
    private $website = '';
    private $token = '';
    private $chat_id = '';

    public function __construct($website, $token, $chat_id) {
        $this->website = $website;
        $this->token = $token;
        $this->chat_id = $chat_id;
    }

    public function setRequest ($data) {
        $request = new Request($this->website, $this->token, $this->chat_id);
        $param = '/sendMessage';
        $params = [
            'chat_id'=> $this->chat_id,
            'text'   => $data,
        ];

        $result = $request->request($params,$param, '');
        return $result;
    }


}