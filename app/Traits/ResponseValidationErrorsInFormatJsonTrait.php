<?php
namespace App\Traits;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\ValidationException;

trait ResponseValidationErrorsInFormatJsonTrait {
    private $errors;
    protected function failedValidation(Validator $validator)
    {
        $this->errors = (new ValidationException($validator))->errors();

        throw new HttpResponseException(
            response()->json([
                'result' => false,
                'message' => "Ocurrieron errores",
                'errors' => $this->errors

            ], 200)
        );
    }

    private function parseErrors(){
        $responseError = "";
        foreach($this->errors as $error){
            $responseError .= $error[0]." \n";
        };
        return $responseError;
    }
}
