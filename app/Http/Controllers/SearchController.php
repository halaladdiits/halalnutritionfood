<?php

namespace App\Http\Controllers;

use App\Models\FoodProduct;
use App\Models\Ingredient;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class SearchController extends Controller
{
    public function executeSearch (Request $request)
    {
        $keywords = $request->input('keywords');

        $ingredients = Ingredient::all();

        $searchIngredients = new \Illuminate\Database\Eloquent\Collection();

        foreach($ingredients as $ing)
        {
            if(Str::contains(Str::lower($ing->iname),Str::lower($keywords)))
                $searchIngredients->add($ing);
        }

        return View::make('search.searchedIngredient')->with('searchIngredient',$searchIngredients);
    }
}
