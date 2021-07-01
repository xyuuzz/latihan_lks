<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MovieRequest extends FormRequest
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
        $validate = [
            "name" => "required|string|min:2|max:50",
            "image" => "required|file|mimes:png,jpg,jpeg",
            "duration" => "required|numeric"
        ];

        if($this->getMethod() === "PATCH")
        {
            $validate["image"] = "file|mimes:png,jpg,jpeg";
        }

        return $validate;
    }

    public function messages()
    {
        return [
            "name.required" => "Kolom Nama Wajib Diisi!",
            "name.string" => "Kolom Nama wajib menggunakan format string",
            "name.min" => "Minimal 2 huruf!",
            "name.max" => "Maximal 50 huruf!",
            "image.required" => "Wajib Mengunggah Banner Film",
            "image.mimes" => "Banner film wajib berekstensi png, jpg atau jpeg",
            // "image.size" => "Maximal size banner film adalah 1MB",
            "image.image" => "Banner film wajib berupa gambar, tidak yang lain",
            "duration.required" => "Durasi Film Wajib diisi!",
            "duration.numeric" => "Durasi film berisi angka, bukan huruf.."
        ];
    }
}
