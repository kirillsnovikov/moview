<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Services\Kinoparser\Person;

use App\Person;
use App\Services\Kinoparser\Data\Layouts\CurlKinopoiskDefault;
use App\Services\Kinoparser\Parser\XpathParser;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

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

    public function putImageInFile($person)
    {
        $filename = ceil($person->kp_id / 10000) . '/' . $person->kp_id . '.html';
        $data = Storage::disk('person')->get($filename);
        $src = $this->parser->parse($data, './/img[@itemprop=\'image\']/@src');
        (!empty($src)) ? $img_url = $src[0] : $img_url = null;

        $sizes = [
            'sm' => 100,
            'md' => 150,
            'lg' => 200,
        ];
//        dd(($img_url && !preg_match('/PHOTO_NONE/i', $img_url)));

        if ($img_url && !preg_match('/photo_none/i', $img_url)) {
            $image = file_get_contents($img_url);
            usleep(1000000);
            foreach ($sizes as $size => $size_value) {
                $temp_file = Storage::disk('public')->path('tempfile_' . $size . '.jpg');
                $imagename = mb_strtolower(Str::slug($person->slug . '_' . $size, '_'));
                $new_file = 'person/' . ceil($person->id / 1000) . '/' . $imagename . '.jpg';

                $temp_image = Image::make($image)->widen($size_value, function ($constraint) {
                    $constraint->upsize();
                });
                $temp_image->save($temp_file, 90, 'jpg');
                Storage::disk('public')->put($new_file, $temp_image);
                $temp_image->destroy();
            }
            $person->update(['image' => $new_file]);
        }
    }

}