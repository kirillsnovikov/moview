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
//                dd(Movie::where('kp_id', $movie['kinopoisk_id'])->first());
                if (array_key_exists('kinopoisk_id', $movie) && !Movie::where('kp_id', $movie['kinopoisk_id'])->first()) {

                    $this->saveMovie($movie, $update);
                }
            }
            $next_page = $data['next_page'];
            (!empty($next_page)) ? $try = true : $try = false;
        }
    }

    protected function saveMovie($movie, $update = null)
    {
        $data = [];
        $data['title'] = $movie['title'];
        $data['original_title'] = (array_key_exists('title_orig', $movie)) ? $movie['title_orig'] : null;
        $data['other_title'] = (array_key_exists('other_title', $movie)) ? $movie['other_title'] : null;
        $data['kodik_link'] = $movie['link'];
        $data['kp_id'] = (array_key_exists('kinopoisk_id', $movie)) ? $movie['kinopoisk_id'] : null;
        $data['imdb_id'] = (array_key_exists('imdb_id', $movie)) ? $movie['imdb_id'] : null;
        $data['kodik_id'] = $movie['id'];
        $data['quality'] = $movie['quality'];
        $data['translation'] = $movie['translation']['title'];
        $data['slug'] = null;
        $data['published'] = 1;
        $data['created_by'] = 1;

        if (mb_stripos($movie['type'], 'movie') >= 0) {
//            $type = Type::where('slug', 'films')->first();
            $type = Type::firstOrCreate([
                        'title' => 'Фильмы',
                        'slug' => 'films',
            ]);
            $data['type_id'] = $type->id;
        }

//        dd($update);
        if (!$update) {
//            dd('create');
            $movie = Movie::firstOrCreate(['imdb_id' => $movie['id']], $data);
            $movie->update(['slug' => null]);
        } else {
//            dd('update');
            if (strcasecmp($update, 'all') == 0) {
                $movie = Movie::where('imdb_id', $movie['id'])->first();
                if ($movie) {
//                dd($movie);
                    $movie->update($data);
                }
            }
        }
    }

}
