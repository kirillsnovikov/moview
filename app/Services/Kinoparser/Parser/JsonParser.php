<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Services\Kinoparser\Parser;

use App\Contracts\Kinoparser\ParserInterface;

/**
 * Description of JsonParser
 *
 * @author Кирилл
 */
class JsonParser implements ParserInterface
{

    /**
     * 
     * @param type $data
     * @param type $path
     */
    public function parse($data, $path): array
    {
        $elements = $this->jsonDecode($data);
        $keys = explode('->', $path);
        $result = [];

        foreach ($keys as $key) {
            $elements = $this->recursive($elements, $key);
        }

        foreach ($elements as $element) {
            $result[] = $element;
        }

        return $result;
    }

    /**
     * 
     * @param type $data
     * @return array
     */
    protected function jsonDecode($data): array
    {
        return json_decode($data, true);
    }

    /**
     * 
     * @param array $array
     * @param string $key
     */
    protected function recursive(array $array, string $key): array
    {
        $result = [];

        if (array_key_exists($key, $array)) {
            $result[] = $array[$key];
            return $result;
        }

        if (count($array) == 1) {
            $array = array_shift($array);
        }

        foreach ($array as $k => $value) {
            if (!empty($value[$key])) {
                $result[] = $value[$key];
            }
        }

        return $result;
    }

}
