<?php


/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Services\Kinoparser\Parser\Country;

use App\Country;
use Illuminate\Support\Str;

/**
 * Description of ParseCountryAndSave
 *
 * @author KNovikov
 */
class ParseCountryAndSave
{

    public function parseAndSave($file)
    {
        $xml = simplexml_load_file($file);
        $countries = $xml->country;
        $data = [];

        foreach ($countries as $country) {
            $slug = mb_strtolower(Str::slug($country->english, '_'));

            $data['title'] = $country->name;
            $data['slug'] = $slug;
            $data['code_alpha2'] = $country->alpha2;
            $data['code_alpha3'] = $country->alpha3;
            $data['iso'] = $country->iso;
            $data['meta_title'] = $country->name . ', фильмы смотреть онлайн в хорошем качестве';
            $data['meta_description'] = $country->name . ', фильмы и актеры, смотреть онлайн в хорошем качестве! Full HD, HD720, HD1080';
            $data['meta_keywords'] = $country->name . ', ' . $country->location . ', ' . $country->{'location-precise'} . ', фильмы, актеры';
            $data['published'] = 1;
            $data['created_by'] = 1;

            Country::firstOrCreate($data);
        }
    }

}
