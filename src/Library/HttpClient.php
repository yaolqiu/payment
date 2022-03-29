<?php

namespace wcyx\Library;
use GuzzleHttp\Client;
use wcyx\Exception\GatewayException;

class HttpClient
{
    public static $instance = null;

    public static function post($url,$data,$type='form')
    {
        self::getInstance();
        if($type=='form') {
            $payload = [
                'form_params'=> $data
            ];
        } else if ($type=='multipart') {
            $multipart = [];
            foreach ($data as $field => $val) {
                $multipart[] = [
                    'name'     => $field,
                    'contents' => $val,
                ];
            }
            $payload = [
                'multipart'=> $multipart
            ];

        } else {
            $payload = $data;
        }

        $response = self::$instance->request('POST',$url,$payload);
        $code = $response->getStatusCode(); // 200
        if($code!=200) {
            $reason = $response->getReasonPhrase();
            throw new GatewayException(sprintf("request error[%s] and the message:[%s]",$reason));
        }
        $body = $response->getBody();
        $content = $body->getContents();
        print_R([
            'step'=> 'start',
            'url'=> $url,
            'data'=> $data
        ]);
        print_R([
            'step'=> 'end',
            'response'=> $body->getContents()
        ]);
        return $content;
    }

    public static function get($url,$data)
    {

    }



    public static function getInstance()
    {
        if(empty(self::$instance)) {
            self::$instance = new Client();
        }
    }

    private static function http_post_data($url, $post_data) {
        $postdata = http_build_query($post_data);
        $options = array(
            'http' => array(
                'method' => 'POST',
                'header' => 'Content-type:application/x-www-form-urlencoded',
                'content' => $postdata,
                'timeout' => 15 * 60
            )
        );
        $context = stream_context_create($options);
        $result = file_get_contents($url, false, $context);
        return $result;
    }
}
