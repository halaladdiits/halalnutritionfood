<?php namespace App\Http\Controllers;

use App\Models\FoodProduct;
use App\Models\Ingredient;

class PagesController extends Controller {

    public function getHome()
    {

        $foodproducts = FoodProduct::all();
        $addictives = Ingredient::where('itype',1)->get();
        return view('pages.v1.home',compact('foodproducts','addictives'));
    }
    public function getAbout()
    {
        return view('pages.about');   
    }
	public function getVisualization()
    {
        return view('pages.visualization');   
    }
    public function getVisualizationGraph1()
    {
        return view('pages.graph1');   
    }
    public function getVisualizationGraph1d()
    {
        return view('pages.graph1d');   
    }
    public function getVisualizationGraph1c()
    {
        return view('pages.graph1c');   
    }
    public function getVisualizationGraph1b()
    {
        return view('pages.graph1b');   
    }
    public function getVisualizationGraph1a()
    {
        return view('pages.graph1a');   
    }
    public function getVisualizationGraph2()
    {
        return view('pages.graph2');   
    }
    public function getVisualizationGraph3()
    {
        return view('pages.graph3');   
    }
    public function getVisualizationGraph3d()
    {
        return view('pages.graph3d');   
    }
    public function getVisualizationGraph3c()
    {
        return view('pages.graph3c');   
    }
    public function getVisualizationGraph3b()
    {
        return view('pages.graph3b');   
    }
    public function getVisualizationGraph3a()
    {
        return view('pages.graph3a');   
    }
    public function getVisualizationGraph4()
    {
        return view('pages.graph4');   
    }
    
    public function getVisualizationGraph4d()
    {
        return view('pages.graph4d');   
    }
    public function getVisualizationGraph4c()
    {
        return view('pages.graph4c');   
    }
    public function getVisualizationGraph4b()
    {
        return view('pages.graph4b');   
    }
    public function getVisualizationGraph4a()
    {
        return view('pages.graph4a');   
    }
    public function getVisualizationGraph5()
    {
        return view('pages.graph5');   
    }
    
    
    // public function submit()
    // {
    //     $ingredients = Ingredient::lists('iname','id');
    //     return view('pages.frontend.submit',compact('ingredients'));
    // }

    // public function foodlist()
    // {
    //     $foodproducts = FoodProduct::all();

    // }

    // public function addiclist()
    // {

    // }
}
