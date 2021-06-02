<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function respondSuccess($message = 'Success !',$data = array(),$statusCode = 200){
        return response()->json(
            array(
                'result'  => true,
                'message' => $message,
                'data'    => $data
            ),$statusCode);
   }

   protected function respondWithError($message = 'Server error !',$statusCode = 200) {
       return response()->json(
           array(
               'result' => false,
               'message' => !env('APP_DEBUG') ? 'Ocurrio un error interno. Comuniquese con administracion' : $message
           ),
           $statusCode
       );
   }

}
