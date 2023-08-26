<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreArticleVenteRequest;
use App\Http\Requests\UpdateArticleVenteRequest;
use App\Http\Resources\ArticleVenteResource;
use App\Models\Article;
use App\Models\ArticleVente;
use App\Models\Categorie;

class ArticleVenteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $catVentes = new Categorie();
        $artVente = new ArticleVente();
        $catVentes = ArticleVenteResource::collection($catVentes->where("typeCategorie", "vente"));
        return ArticleVenteResource::collection($artVente->all());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreArticleVenteRequest $request)
    {
        //    return $this->hasThreeCat($request->catConf);
        return $request->all();
    }

    public function hasThreeCat($tabCatConf)
    {
        return $tabCatConf;
    }

    /**
     * Display the specified resource.
     */
    public function show(ArticleVente $articleVente)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ArticleVente $articleVente)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateArticleVenteRequest $request, ArticleVente $articleVente)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ArticleVente $articleVente)
    {
        //
    }
}
