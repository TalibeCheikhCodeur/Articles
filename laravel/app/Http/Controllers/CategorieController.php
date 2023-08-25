<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Categorie;
use Illuminate\Http\Request;

class CategorieController extends Controller
{
    public function index()
    {
        //$categories = Categorie::all();
        $categories = Categorie::paginate(3);
        return $categories;
    }

    public function store(Request $request)
    {
        $request->validate([
            'libelle' => 'required'
        ]);
        $test = Categorie::where('libelle', $request->libelle)->first();
        if (!$test) {
            $cat = Categorie::create([
                'libelle' => $request->libelle
            ]);
            return response()->json(['message' => 'Catégorie créé avec succès', 'data' => $cat]);
        } else {
            return response()->json(['message' => "Ce catégorie existe déjà"]);
        }
    }

    public function getidCatBylib($lib)
    {
        $idCat = Categorie::where('libelle', $lib)->first()->id;
        $ids = [];
        $ids = Article::where('categorie_id', $idCat)->get();
        return response()->json(['message' => 'le nombre article de meme cat', 'data' => count($ids) + 1]);
    }


    public function supCat(Request $request)
    {
        $request->validate([
            'categories' => 'required|array',
            'categories.*' => 'exists:categories,id'
        ]);

        $categoryIds = $request->input('categories');

        Categorie::destroy($categoryIds);

        return response()->json(['message' => 'Catégories supprimées avec succès']);
    }

    public function show($libelle)
    {
        if (strlen($libelle) < 3) {
            return response()->json(['message' => 'Le libellé doit avoir au moins 3 caractères'], 400);
        }

        $categorie = Categorie::where('libelle', $libelle)->first();

        if (!$categorie) {
            return response()->json(['message' => 'Catégorie non trouvée'], 404);
        }

        return response()->json(['data' => $categorie]);
    }
}
