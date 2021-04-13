<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoryRequest extends FormRequest
{
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
            'storyImage' => 'required|mimes: jpeg,png|max:2000'
        ];
    }

    /**
     * @return string[]
     */
    //for custom message validation
    public function messages()
    {
        return [
            'storyImage:required' => 'Plase insert image',
            'storyImage.mimes' => 'Only jpg,png type for image are support',
            'storyImage:max' => 'Max size for upload file is 2mb',
            'storyImage:required' => 'Image for story is required'
        ];
    }
}
