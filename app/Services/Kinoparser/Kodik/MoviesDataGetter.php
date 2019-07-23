<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Services\Kinoparser\Kodik;

use App\Services\Kinoparser\Data\Layouts\CurlDefault;

/**
 * Description of MoviesDataGetter
 *
 * @author Кирилл
 */
class MoviesDataGetter
{

    const API_TOKEN = '239a34d54964169d8beb68932ddf450a';
    const API_LIST_URL = 'https://kodikapi.com/list';
    const API_SEARCH_URL = 'https://kodikapi.com/search';

    /**
     * @var CurlDefault
     */
    private $data;

    public function __construct(CurlDefault $data)
    {

        $this->data = $data;
    }

    /**
     * 
     * @param type $types
     * @return array
     */
    public function getMoviesList($types, $url = null, $translation, $camrip): array
    {
//        dd($types, $translation, $camrip);
        $query = $this->buildQuery($types, $translation, $camrip);
//        dd($query);
        if (empty($url)) {
            $url = self::API_LIST_URL . '?' . $query;
//            dd($url);
        }
        $results = [];
        $data = json_decode($this->data->getData($url), true);
//        dd($data);

        return $data;
    }

    /**
     * 
     * @return string
     */
    protected function buildQuery($types, $translation, $camrip): string
    {
        $params = [];
        $params['token'] = self::API_TOKEN;
        $params['limit'] = 100;
        ($camrip) ? $params['camrip'] = 'true' : $params['camrip'] = 'false';
        ($translation) ? $params['translation_id'] = $translation : null;

        if (!empty($types)) {
            trim($types);
            $types = preg_replace('/\s+/', '', $types);
            $params['types'] = $types;
        }

        return http_build_query($params);
    }

}
