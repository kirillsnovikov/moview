<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Services\Kinoparser\Data\Layouts;

use App\Contracts\Kinoparser\DataGetterInterface;
use App\Services\Kinoparser\Curl\BaseCurl;

/**
 * Description of CurlDefault
 *
 * @author Кирилл
 */
class CurlDefault implements DataGetterInterface
{

    /**
     * @var BaseCurl
     */
    private $curl;

    public function __construct(BaseCurl $curl)
    {

        $this->curl = $curl;
    }

    public function getData(string $url): string
    {
        $try = true;
        $fp = fopen(__DIR__ . '/../../config/errors.txt', 'ab');

        while ($try) {
            $ch = $this->curl->curlInit($url);

            $result = $this->curl->setDefaultCurlOptions($ch)
//                    ->setCookieFile($ch)
//                    ->setRandomRefererFromFile($ch)
//                    ->setRandomUserAgentFromFile($ch)
//                    ->setUserAgent($ch)
//                    ->setHeaders($ch)
                    ->getCurlExec($ch);

            if (empty($result['data'])) {
                $try = true;
                fwrite($fp, $url . ' || Result data is empty string' . PHP_EOL);
            } elseif ($result['response_code'] != 200) {
                if ($result['response_code'] == 404) {
                    fwrite($fp, $url . ' || Response code == 404' . PHP_EOL);
                    fclose($fp);
                    return $result['data'];
                }
                $try = true;
                fwrite($fp, $url . ' || Response code != 200' . PHP_EOL);
            } elseif ($result['strlen_data'] < 10) {
                $try = true;
                fwrite($fp, $url . ' || String length < 10' . PHP_EOL);
            } elseif ($result['err_num'] != 0) {
                $try = true;
                fwrite($fp, $url . ' || Error number is ' . $result['err_num'] . PHP_EOL);
            } elseif (!empty($result['err_msg'])) {
                $try = true;
                fwrite($fp, $url . ' || Error message is ' . $result['err_msg'] . PHP_EOL);
            } else {
                fclose($fp);
                return $result['data'];
//                fwrite($fp, $url . ' || success! ' . PHP_EOL);
            }
            usleep(mt_rand(1000000, 2000000));
        }
    }

}
