<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use App\Traits\ResponseValidationErrorsInFormatJsonTrait;

class UserStoreRequest extends FormRequest
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
            'name'      => 'required|string|max:255',
            'email'     => 'required|string|email|max:255|unique:users',
            'password'  => 'required|string|min:6|confirmed',
        ];
    }

    public function messages()
    {
        return [
            'name.required'         => 'El campo name es requerido',
            'name.string'           => 'El campo name tiene que ser de tipo string',
            'name.max'              => 'El campo name tien que ser máximo 255 carácteres',
            'email.required'        => 'El campo correo es requerido',
            'email.string'          => 'El campo correo tiene que ser de tipo string',
            'email.email'           => 'El campo correo no coincide con el formato format@mimail.com',
            'email.max:255'         => 'El campo correo tiene que ser máximo 255 carácteres',
            'email.unique:users'    => 'El campo correo Ya existe en el sistema',
            'password.required'     => 'El campo password es requerido',
            'password.string'       => 'El campo password tiene que ser de tipo string',
            'password.min'          => 'El campo password tiene que ser minimo de 6 caracteres',
            'passsword.confirmed'   => 'El campo password no coincide con la confirmación'
        ];
    }
}
