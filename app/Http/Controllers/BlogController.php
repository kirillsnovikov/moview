<?php

namespace App\Http\Controllers;

use App\Country;
use App\Genre;
use App\Movie;
use App\Person;
use App\Type;

class BlogController extends Controller
{

    public function index()
    {
//        $movie = Movie::where('imdb_id', 'tt0070874')->get();
//        dd($movie);
        $type_films = Type::where('title', 'фильмы')->where('published', 1)->with('movies')->first();
        $type_serials = Type::where('title', 'сериалы')->where('published', 1)->with('movies')->first();
//        dd($type_films);
        $films = [];
        $serials = [];
        if ($type_films) {
            $films = $type_films
                    ->movies
                    ->where('published', 1)
//                    ->where('kp_raiting', '>', 70000)
                    ->sortBy('premiere')
                    ->take(18)
                    ->values()
                    ->all();
        }
        if ($type_serials) {
            $serials = $type_serials
                    ->movies
                    ->where('published', 1)
//                    ->where('imdb_raiting', '>', 70000)
                    ->sortBy('premiere')
                    ->take(18)
                    ->values()
                    ->all();
        }
        return view('frontend.index', compact(['films', 'serials']));
    }

    public function type($type_slug)
    {
        $type = Type::where('slug', $type_slug)->first();
        $genres = Genre::whereHas('movies', function ($query) use ($type) {
                    $query->where('type_id', $type->id);
                })
                ->where('published', 1)
                ->get();
        $movies = $type->movies()->where('published', 1)->orderBy('created_at', 'desc')->paginate(60);

        return view('frontend.type.type', compact(['type', 'movies', 'genres']));
    }

    public function genre($type_slug, $genre_slug)
    {
        $type = Type::whereSlug($type_slug)->first();
        $genre = Genre::whereSlug($genre_slug)->first();
        $genres = Genre::whereHas('movies', function ($query) use ($type) {
                    $query->where('type_id', $type->id);
                })
                ->where('published', 1)
                ->get();
        $movies = $genre->movies()
                ->where('type_id', $type->id)
                ->where('published', 1)
                ->orderBy('created_at', 'desc')
                ->paginate(60);

        return view('frontend.genre.genre', compact(['type', 'genre', 'genres', 'movies', 'genre_slug']));
    }

    public function video($video_slug)
    {

        $movie = Movie::where('slug', $video_slug)
                ->with('type')
                ->with('countries')
                ->with('actors')
                ->with('directors')
                ->with('genres')
                ->where('published', 1)
                ->firstOrFail();

        return view('frontend.movie.movie', compact('movie'));
    }

    public function person($person_slug)
    {
        $person = Person::where('slug', $person_slug)
                ->with('countryBirth')
                ->with('professions')
                ->with('actors')
                ->with('directors')
                ->where('published', 1)
                ->firstOrFail();

        $age = $this->getAge($person->birth_date, $person->death_date);
//        dd($age);
//        dd($person);
//        $fullname = $person->firstname . ' ' . $person->lastname;
//        $actor_movie = Movie::whereHas('actors', function ($query) use ($person_slug) {
//                    $query->where('slug', $person_slug);
//                })
//                ->where('published', 1)
//                ->orderBy('premiere', 'desc')
//                ->get();
//
//        $director_movie = Movie::whereHas('directors', function ($query) use ($person_slug) {
//                    $query->where('slug', $person_slug);
//                })
//                ->where('published', 1)
//                ->orderBy('premiere', 'desc')
//                ->get();
//        $director_genre = Genre::whereHas('movies', function ($query) use ($person_slug) {
//                    $query->whereHas('directors', function ($query) use ($person_slug) {
//                        $query->where('slug', $person_slug);
//                    });
//                })->get();
//
//        $actor_genre = Genre::whereHas('movies', function ($query) use ($person_slug) {
//                    $query->whereHas('actors', function ($query) use ($person_slug) {
//                        $query->where('slug', $person_slug);
//                    });
//                })->get();
//
//        $genres = $actor_genre->merge($director_genre)->unique();

        return view('frontend.person.person', compact(['person', 'age']));
    }

    public function country($country_slug)
    {
        $countries = Country::where('published', 1)->orderBy('title')->get();
        $country = Country::where('slug', $country_slug)
                ->where('published', 1)
                ->first();
        $movies = $country->movies()->where('published', 1)->orderBy('created_at', 'desc')->paginate(60);
        return view('frontend.country.country', compact(['countries', 'country', 'country_slug', 'movies']));
    }

    /**
     * 
     * @param type $birth_date
     * @param type $death_date
     * @return string
     */
    protected function getAge($birth_date, $death_date): string
    {
        if ($death_date) {
            $diff_date = $death_date;
        } else {
            $diff_date = 'now';
        }

        $age = (new \DateTime($birth_date))->diff(new \DateTime($diff_date))->y;
        $m = substr($age, -1, 1);
        $l = substr($age, -2, 2);
        if ($age) {
            return $age . ' ' . ((($m == 1) && ($l != 11)) ? 'год' : ((($m == 2) && ($l != 12) || ($m == 3) && ($l != 13) || ($m == 4) && ($l != 14)) ? 'года' : 'лет'));
        }

        return '';
    }

}
