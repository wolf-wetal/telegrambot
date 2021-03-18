<?php

include_once ('Request.php');

class ApiLeads
{
    private $token   = '';
    private $website = '';

    public function __construct($website, $token) {
        $this->website = $website;
        $this->token = $token;

    }

    function sort ($array, $index, $order)
    {
        if(is_array($array) && count($array)>0)
        {
            foreach(array_keys($array) as $key) {
                $temp[$key] = $array[$key][$index];
                if ($order == 'asc') {
                    asort($temp);
                } else {
                    arsort($temp);
                }
                foreach (array_keys($temp) as $keyN) {
                    if (is_numeric($keyN)) {
                        $sorted[] = $array[$keyN];
                    } else {
                        $sorted[$keyN] = $array[$keyN];
                    }
                }

            }
        }

        return $sorted;
    }

    public function getCountries($limit, $offset, $sort, $sort_limit){

        $request = new Request($this->website, $this->token, '');
        $param = '/geo/getCountries?';
        $params = [
            'token'=> $this->token,
            'offset'   => $offset,
              'limit'   => $limit,
        ];

        $result = $request->request($params, '', $param);

        $result = json_decode($result, true);
        if($sort) {
            arsort($result['data']);
        }
        if ($sort_limit) {
            return array_slice($result['data'], 0, $sort_limit);
        }

        return $result['data'];

    }

}