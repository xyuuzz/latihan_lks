<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BlogRequest extends FormRequest
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
            "title" => "required|string|min:5|max:150",
            "body" => "required|string|min:20"
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            "title.required" => "Field ini wajib diisi!",
            "title.string" => "Field ini wajib berbentuk string",
            "title.min" => "Minimal ada 5 huruf dalam field ini",
            "title.max" => "Maximal ada 150 huruf dalam field ini",
            "body.required" => "Field ini wajib diisi!",
            "body.string" => "Field ini wajib berbentuk string",
            "body.min" => "Minimal ada 20 huruf dalam field ini",
        ];
    }
}
