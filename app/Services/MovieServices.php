<?php
namespace App\Services;
use Illuminate\Support\Facades\Http ;

class MovieServices
{
    public static function getMoviesPopulars()
    {
        $params = array(
            "api_key"  => env('MOVIEDB_API_KEY'),
            "language" => "es-ES"
        );

        $response = Http::get(
            env('MOVIEDB_URL')."/3/movie/popular",
            $params
        );
        return $response['results'];
    }

    public static function getMovie($id = 0)
    {
        $params = array(
            "api_key"  => env('MOVIEDB_API_KEY'),
            "language" => "es-ES"
        );

        $response = Http::get(
            env('MOVIEDB_URL')."/3/movie/".$id,
            $params
        )->json();


        return $response;
    }

    public static function verifyIfExistsMovie($id = 0) {
        $movie = self::getMovie($id);
        return !empty($movie['id']) ? true : false;
    }
}


