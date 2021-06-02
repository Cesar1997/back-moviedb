<?php

namespace App\Http\Controllers;

use App\Services\MovieServices;
use Exception;
use Illuminate\Http\Request;

class MoviesController extends Controller
{
    public function index() {
        try {
           return $this->respondSuccess(
                'Peliculas consultadas exitosamente',
                MovieServices::getMoviesPopulars(),
            );
        } catch(\Exception $e) {
           return  $this->respondWithError($e->getMessage());
        }
    }

    public function show($id = 0) {
        try {
            if($id == 0) throw new Exception("Error de parametros");

            return $this->respondSuccess(
                'Pelicula consultada',
                MovieServices::getMovie($id),
            );
        } catch(\Exception $e) {
            return  $this->respondWithError($e->getMessage());
        }
    }
}
