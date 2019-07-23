<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Services\Kinoparser\Kodik;

use App\Movie;
use App\Type;

/**
 * Description of MoviesDataSaver
 *
 * @author KNovikov
 */
class MoviesDataSaver
{

    /**
     * @var MoviesDataGetter
     */
    private $data;

    public function __construct(MoviesDataGetter $data)
    {

        $this->data = $data;
    }

    public function saveAllMoves($types, $update, $translation, $camrip)
    {
//        dd($update);
        $try = true;
        /* @var $next_url type */
        $next_page = null;
        while ($try) {

            $data = $this->data->getMoviesList($types, $next_page, $translation, $camrip);
//            dd($data);

            foreach ($data['results'] as $movie) {
                $save_data = $this->getSaveData($movie);
                (array_key_exists('kinopoisk_id', $movie)) ? $kp_id = $movie['kinopoisk_id'] : $kp_id = null;
                if ($kp_id) {
                    $this->saveMovie($kp_id, $save_data, $update);
                }
            }
            $next_page = $data['next_page'];
            (!empty($next_page)) ? $try = true : $try = false;
        }
    }

    protected function saveMovie($kp_id, $save_data, $update = null)
    {
        if (!$update) {
//            dd('create');
            $movie = Movie::firstOrCreate(['kp_id' => $kp_id], $save_data);
            $movie->update(['slug' => null]);
        } else {
//            dd(strcasecmp($update, 'all'));
            $movie = Movie::where('kp_id', $kp_id)->first();
            if (strcasecmp($update, 'all') == 0 && $movie) {
                $movie->update($save_data);
            }
        }
    }

    /**
     * 
     * @param type $movie
     * @return array
     */
    protected function getSaveData($movie): array
    {
        $data = [];
        $data['title'] = $movie['title'];
        $data['original_title'] = (array_key_exists('title_orig', $movie)) ? $movie['title_orig'] : null;
        $data['other_title'] = (array_key_exists('other_title', $movie)) ? $movie['other_title'] : null;
        $data['kodik_link'] = (array_key_exists('link', $movie)) ? $movie['link'] : null;
        $data['kp_id'] = (array_key_exists('kinopoisk_id', $movie)) ? $movie['kinopoisk_id'] : null;
//        $data['imdb_id'] = (array_key_exists('imdb_id', $movie)) ? $movie['imdb_id'] : null;
        $data['imdb_id'] = null;
        $data['kodik_id'] = $movie['id'];
        $data['quality'] = $movie['quality'];
        $data['translation'] = $movie['translation']['title'];
        $data['slug'] = null;
        $data['published'] = 1;
        $data['created_by'] = 1;

        if (mb_stripos($movie['type'], 'movie') >= 0) {
            $type = Type::firstOrCreate([
                'title' => 'Фильмы',
                'slug' => 'films',
            ]);
            $data['type_id'] = $type->id;
        }

        return $data;
    }

}
