<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Services\Kinoparser\Person;

use App\Services\Kinoparser\Data\Layouts\CurlKinopoiskDefault;
use App\Services\Kinoparser\Parser\XpathParser;
use Illuminate\Support\Facades\Storage;

/**
 * Description of PersonImageGetter
 *
 * @author KNovikov
 */
class PersonImageGetter
{

    /**
     * @var XpathParser
     */
    private $parser;

    /**
     * @var CurlKinopoiskDefault
     */
    private $data;

    public function __construct(CurlKinopoiskDefault $data, XpathParser $parser)
    {

        $this->data = $data;
        $this->parser = $parser;
    }

    public function putImageInFile($filename, $imagename)
    {
        $data = Storage::disk('person')->get($filename);
        $disk = Storage::disk('public');
        $temp_path = Storage::disk('public')->path('asdf');
        dd($temp_path);
        $src = $this->parser->parse($data, './/img[@itemprop=\'image\']/@src');
        (!empty($src)) ? $img_url = $src[0] : $img_url = null;

        if ($img_url && strcasecmp($img_url, 'photo_none') != 0) {
            $data = file_get_contents($img_url);
            $temp_image = Image::make($data)->resize(100);
            $path = $disk->put('test.jpg', $data);
            dd($path);
//            dd($data);
        }
//        dd($src);
    }

}
