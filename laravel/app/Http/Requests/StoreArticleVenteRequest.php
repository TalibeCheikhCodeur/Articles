<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreArticleVenteRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            "catConf"=>"required | min:3",
            "libelle" => "required|unique",
            "categorie" => "required",
            "cout_fabrication" => "required",
            "marge" => "required",
            "prix_vente" => "required",
            "image" => "sometimes",
        ];
    }
}
