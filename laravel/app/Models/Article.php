<?php

namespace App\Models;

use GuzzleHttp\Promise\Create;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Article extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function getArtByCat($cat)
    {
        return Article::where("categorie_id", $cat)
            ->get();
    }

    public function categorie(): BelongsTo
    {
        return $this->belongsTo(Categorie::class);
    }

    public function fournisseur(): BelongsToMany
    {
        return $this->belongsToMany(Fournisseur::class, "article_fournisseurs");
    }

    protected static function boot()
    {
        parent::boot();
        static::created(function (Article $article) {
            $tabFour =  explode(",", request()->input('fournisseur'));
            $article->fournisseur()->attach($tabFour);
        });

    }
}
