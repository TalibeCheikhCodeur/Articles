<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    use HasFactory;

    protected $fillable = [
        "libelle"
    ];

    public function getCatByLib($libelle)
    {
        return Categorie::where("libelle", $libelle)
            ->first();
    }
}
