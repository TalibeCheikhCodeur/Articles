<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Categorie;
use App\Models\Fournisseur;
use App\Http\Resources\ArticleResource;
use App\Http\Requests\StoreArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use App\Http\Resources\CategorieResource;
use App\Http\Resources\FournisseurResource;
use App\Models\ArticleFournisseur;
use Symfony\Component\HttpFoundation\Response;

class ArticleController extends Controller
{

    public function response($status, $message, $data)
    {
        return [
            "statut" => $status,
            "message" => $message,
            "data" => $data
        ];
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tabData = [];
        $article = new Article();
        $categorie = new Categorie();
        $fournisseur = new Fournisseur();
        $articles = ArticleResource::collection($article->all());
        $categories = CategorieResource::collection($categorie->all());
        $fournisseurs = FournisseurResource::collection($fournisseur->all());
        $tabData = ["articles" => $articles, "fournisseurs" => $fournisseurs, "categories" => $categories];
        return $this->response(Response::HTTP_ACCEPTED, "Tous les donnees", $tabData);
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
    public function store(StoreArticleRequest $request)
    {
        $article = new Article();
        $categorie = new Categorie();
        $fournisseur = new Fournisseur();
        $libelle = $request->libelle;
        $categorieExist = $categorie->getCatByLib($request->categorie);
        $four = $fournisseur->getByName(explode(",", $request->fournisseur));
        if ($categorieExist && $four && count($four) != 0) {
            $cat = $article->getArtByCat($categorieExist->id);
            $newArticle = [
                "libelle" => $libelle,
                "prix" => $request->prix,
                "stock" => $request->stock,
                "categorie_id" => $categorieExist->id,
                "referentiel" => "REF" . "-" . strtoupper(substr($libelle, 0, 3)) . "-" . strtoupper($categorieExist->libelle) . "-" . count($cat) + 1,
                "photo" => $request->image
            ];
            $data = new ArticleResource(Article::create($newArticle));

            // foreach ($four as $idF) {
            //     $tabDonnees = [
            //         "article_id" => $data->id,
            //         "fournisseur_id" => $idF->id
            //     ];
            //     ArticleFournisseur::create($tabDonnees);
            // }

            return $this->response(Response::HTTP_ACCEPTED, "Insertion réussie", $data);
        } else {
            return $this->response(Response::HTTP_UNAUTHORIZED, "Insertion impossible", []);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article)
    {
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateArticleRequest $request, Article $article)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        //
    }
}
