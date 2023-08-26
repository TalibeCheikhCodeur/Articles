<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ArticleVenteResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "libelle" => $this->libelle,
            "categorie" => $this->categorie->libelle,
            "cout_fabrication" => $this->cout_fabrication,
            "marge" => $this->marge,
            "prix_vente" => $this->prix_vente,
            "stock" => $this->stock,
            "image" => $this->image,
            "ref" => $this->referentiel,
            "promo" => $this->promo
        ];
    }
}
