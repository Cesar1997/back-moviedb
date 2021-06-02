<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentStoreRequest;
use App\Models\Comment;
use App\Services\MovieServices;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentsController extends Controller
{
    public function index()
    {
        return Comment::where("user_id",Auth::user()->id)->get();

    }

    public function show($id)
    {
        return Comment::find($id);
    }

    public function store(CommentStoreRequest $request)
    {
        \DB::beginTransaction();
        try {
            $existsMovie = MovieServices::verifyIfExistsMovie($request->movie_id);
            if(!$existsMovie)  throw new Exception("No existe el id de la pelicula en Api externa");

            $fields = $request->all();
            $fields['user_id'] = Auth::user()->id;
            $comment = Comment::create( $fields );

            \DB::commit();
            return $this->respondSuccess(
                'Comentario creado exitosamente',
                $comment
            );
        } catch(\Exception $e){
            \DB::rollback();
            return $this->respondWithError($e->getMessage());
        }
    }

    public function getCommentsFilteredByMovie($movieId)
    {
        $comments = Comment::where("movie_id",$movieId)
                            ->orderBy("updated_at","asc")
                            ->get();
        return $this->respondSuccess(
            'Comentarios consultados exitosamente',
            $comments
        );
    }
}
