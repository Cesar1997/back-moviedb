<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Traits\ResponseValidationErrorsInFormatJsonTrait;
class CommentStoreRequest extends FormRequest
{
    use ResponseValidationErrorsInFormatJsonTrait;
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'movie_id'  => 'required|integer',
            'comment'   => 'required|min:6|max:255'
        ];
    }

    public function messages()
    {
        return [
            'movie_id.required' => 'El campo movie_id es requerido',
            'movie_id.integer'  => 'El campo movie_id tiene que ser númerico',
            'comment.required'  =>  'El campo comment es requerido',
            'comment.min'       => 'El campo comment tiene que ser como minimo de 6 carácteres',
            'comment.max'       => 'El campo comment tien que ser como máximo de 255 carácteres'
        ];
    }
}
