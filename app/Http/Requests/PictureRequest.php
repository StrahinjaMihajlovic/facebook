<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PictureRequest extends FormRequest{
    /**
     * @return bool
     */
    public function authorize()
    {
        return !\Auth::guest();
    }

    /**
     * @return string[]
     */
    public function attributes()
    {
        return [
            'file' => 'picture',
        ];
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'picture' => 'sometimes|image'
        ];
    }
}
