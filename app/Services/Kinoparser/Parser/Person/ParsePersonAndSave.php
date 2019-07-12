<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Services\Kinoparser\Parser\Person;

use App\Person;
use App\Services\Kinoparser\Parser\XpathParser;
use Illuminate\Support\Facades\Storage;

/**
 * Description of ParsePersonAndSave
 *
 * @author KNovikov
 */
class ParsePersonAndSave
{

    /**
     * @var XpathParser
     */
    private $parser;

    public function __construct(XpathParser $parser)
    {

        $this->parser = $parser;
    }

    public function parseAndSave($file)
    {
        $data = Storage::disk('person')->get('1/7640.html');

//        $str = strstr('204546', ',', true);
//        dd($str);
//        dd($data);
        $error_page = $this->parser->parse($data, './/div[class=\'error-page\']');
        $actor = $this->parser->parse($data, './/table[@class=\'info\']//a[@href = \'#actor\']');
        $director = $this->parser->parse($data, './/table[@class=\'info\']//a[@href = \'#director\']');
        $count_films = (int) rtrim($this->parser->parse($data, './/table[@class=\'info\']//td[. = \'всего фильмов\']/following-sibling::td/text()[normalize-space()]')[0], ',');

//        dd($count_films);
        $result = [];
//        dd($error_page);
        if (($actor || $director) && !$error_page && $count_films >= 10) {
//            dd($actor, $director, $error_page, $count_films);
            $name = $this->parser->parse($data, './/h1[@itemprop=\'name\']');
            $name_en = $this->parser->parse($data, './/span[@itemprop=\'alternateName\']');
            $sex = $this->parser->parse($data, './/meta[@itemprop=\'gender\']/@content');
            $height = round(strstr($this->parser->parse($data, './/table[@class=\'info\']//td[. = \'рост\']/following-sibling::td')[0], ' ', true) * 100, 0);
//            dd($height);
            $birth_date = $this->parser->parse($data, './/meta[@itemprop=\'birthDate\']/@content');
            $death_date = $this->parser->parse($data, './/meta[@itemprop=\'deathDate\']/@content');
            $country_birth = $this->parser->parse($data, './/table[@class=\'info\']//td[. = \'место рождения\']/following-sibling::td/span/a[last()]');
//            dd($name_en);

            (!empty($name)) ? $result['name'] = $name[0] : $result['name'] = $name_en[0];
            (!empty($name_en)) ? $result['name_en'] = $name_en[0] : false;
            (!empty($sex) && strcasecmp($sex[0], 'male') == 0) ? $result['sex'] = Person::MALE : $result['sex'] = Person::FEMALE;
            (!empty($height)) ? $result['height'] = $height : false;
            (!empty($birth_date)) ? $result['birth_date'] = $birth_date[0] : false;
            (!empty($death_date)) ? $result['death_date'] = $death_date[0] : false;
            (!empty($country_birth)) ? $result['country_birth'] = $country_birth[0] : false;
//            dd($country_birth);
//            $country_death = $this->parser->parse($data, './/');
        }
        dd($result);
        dd('fff', (($actor || $director) && !$error_page && $count_films >= 10));
    }

}
