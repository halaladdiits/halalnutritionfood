<?php

use App\Models\FoodProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

$s = 'public.';
Route::get('/',         ['as' => $s . 'home',   'uses' => 'HomeController@index2']); // version 3
Route::get('/v2',         ['as' => $s . 'home-v2',   'uses' => 'HomeController@index']); // version 2
Route::get('/v1',         ['as' => $s . 'home-v1',   'uses' => 'PagesController@getHome']); // version 1
Route::get('/about',         ['as' => $s . 'about',   'uses' => 'PagesController@getAbout']);

$a = 'auth.';
Route::get('/login',            ['as' => $a . 'login',          'uses' => 'Auth\AuthController@getLogin']);
Route::post('/login',           ['as' => $a . 'login-post',     'uses' => 'Auth\AuthController@postLogin']);
Route::get('/register',         ['as' => $a . 'register',       'uses' => 'Auth\AuthController@getRegister']);
Route::post('/register',        ['as' => $a . 'register-post',  'uses' => 'Auth\AuthController@postRegister']);
Route::get('/password',         ['as' => $a . 'password',       'uses' => 'Auth\PasswordResetController@getPasswordReset']);
Route::post('/password',        ['as' => $a . 'password-post',  'uses' => 'Auth\PasswordResetController@postPasswordReset']);
Route::get('/password/{token}', ['as' => $a . 'reset',          'uses' => 'Auth\PasswordResetController@getPasswordResetForm']);
Route::post('/password/{token}',['as' => $a . 'reset-post',     'uses' => 'Auth\PasswordResetController@postPasswordResetForm']);

$s = 'social.';
Route::get('/social/redirect/{provider}',   ['as' => $s . 'redirect',   'uses' => 'Auth\AuthController@getSocialRedirect']);
Route::get('/social/handle/{provider}',     ['as' => $s . 'handle',     'uses' => 'Auth\AuthController@getSocialHandle']);

Route::group(['middleware' => 'auth:administrator'], function()
{
//    $a = 'admin.';
    Route::resource('additive','IngredientController', ['except' => ['index', 'show']]);
    Route::post('foodproduct/verify/{id}',['as' => 'foodproduct.verify', 'uses' => 'FoodProductController@verify']);
    Route::delete('halalSource/{id}',['as' => 'halalSource.destroy', 'uses' => 'IngredientController@halalSourceDestroy']);
    
});

Route::group(['prefix' => 'user', 'middleware' => 'auth:user'], function()
{
//    $a = 'user.';
});

Route::group(['middleware' => 'auth:all'], function()
{
    $a = 'authenticated.';
    Route::get('/logout', ['as' => $a . 'logout', 'uses' => 'Auth\AuthController@getLogout']);
    Route::get('/profile', ['as' => $a . 'profile', 'uses' => 'Auth\AuthController@getProfile']);
    Route::resource('foodproduct','FoodProductController', ['except' => ['index', 'show']]);
    Route::delete('certificate/{id}',['as' => 'certificate.destroy', 'uses' => 'FoodProductController@certificateDestroy']);
});

Route::resource('foodproduct','FoodProductController', ['only' => ['index', 'show']]);
Route::resource('additive','IngredientController', ['only' => ['index', 'show']]);
Route::controller('api', 'ApiController',[
	'getFoodProductList' => 'api.foodproduct.list',
	'getAdditiveList' => 'api.additive.list',
	'getIngredientList' => 'api.ingredient.list',
	'getAdditiveData' => 'api.additive.data',
	'getFoodProductData' => 'api.foodproduct.data',
	'getFoodProductDataByUser' => 'api.foodproduct.datauser',
	'getManufactureList' => 'api.manufacture.list',
	'getHalalOrgList' => 'api.halalOrg.list',
	'getCertOrgList' => 'api.certOrg.list',
	'getWriteToTurtle' => 'api.writeTurtle',
	'getWriteAllTurtle' => 'api.writeAllTurtle',
	'getSparql' => 'api.sparql',
	'postSparql' => 'api.sparql',
]);

Route::controller('RDFBrowser', 'RDFBrowserController',[
	'getIndex' => 'rdf.browser'
]);

Route::get('/testingttl', 'RDFBrowserController@readTtl');

Route::get('/ping', 'HomeController@ping');
Route::get('/search', 'HomeController@search');
Route::get('/json', 'HomeController@json');

//TA Najib Azmi
Route::get('/inranking', 'RankingController@makeIndependentRanking');
Route::get('/vocab', 'FoodProductController@vocab')->name('vocab');
//Route::get('/write-all-ttl', 'RankingController@getWriteAllTurtle');
Route::get('/search','RankingController@index'); // version 2
Route::get('/index2', 'HomeController@index2');
Route::get('/related', 'RankingController@releated');
Route::get('/inglist', 'RankingController@inglist');
Route::get('/addlist', 'RankingController@addlist');
Route::get('/random', 'RankingController@random');
Route::get('/testingphp', 'RankingController@testingphp');
Route::get('/certificate', 'RankingController@certificate');
Route::get('/generate-ttl', 'FoodProductController@generateTtl');
Route::get('/generate-ttl2', 'FoodProductController@generateTtl2');
Route::get('/generate-ttl3', 'FoodProductController@generateTtl3');
Route::get('/generate-ttl4', 'FoodProductController@generateTtl4');
Route::get('/generate-ttl5', 'FoodProductController@generateTtl5');//yang paling bener dah
Route::get('/generatefileinputmetisv1', 'FoodProductController@generatefileinputmetisv1');
Route::get('/generatefileinputmetis1', 'FoodProductController@generatefileinputmetis1');
Route::get('/generatefileinputmetis2', 'FoodProductController@generatefileinputmetis2');
Route::get('/insertingredientfoodproduct', 'FoodProductController@insertingredientfoodproduct');

//project najib azmi
Route::get('/insertAPI', 'ApiController@insertFromAPI');
Route::get('/insertFromMalay', 'ApiController@insertFromMalaysia');
Route::get('/apiv2', 'ApiController@getApi');
Route::get('/apidocs', 'ApiController@apiDocumentation')->name('apidocs');
Route::get('/rdf-dump', 'ApiController@rdfDump')->name('rdf-dump');
Route::get('/visualization', 'PagesController@getVisualization')->name('visualization'); //visualisasi graf berli
Route::get('/graph1', 'PagesController@getVisualizationGraph1');
Route::get('/graph1d', 'PagesController@getVisualizationGraph1d');
Route::get('/graph1c', 'PagesController@getVisualizationGraph1c');
Route::get('/graph1b', 'PagesController@getVisualizationGraph1b');
Route::get('/graph1a', 'PagesController@getVisualizationGraph1a');
Route::get('/graph2', 'PagesController@getVisualizationGraph2');
Route::get('/graph3', 'PagesController@getVisualizationGraph3');
Route::get('/graph3d', 'PagesController@getVisualizationGraph3d');
Route::get('/graph3c', 'PagesController@getVisualizationGraph3c');
Route::get('/graph3b', 'PagesController@getVisualizationGraph3b');
Route::get('/graph3a', 'PagesController@getVisualizationGraph3a');
Route::get('/graph4', 'PagesController@getVisualizationGraph4');
Route::get('/graph4d', 'PagesController@getVisualizationGraph4d');
Route::get('/graph4c', 'PagesController@getVisualizationGraph4c');
Route::get('/graph4b', 'PagesController@getVisualizationGraph4b');
Route::get('/graph4a', 'PagesController@getVisualizationGraph4a');
Route::get('/graph5', 'PagesController@getVisualizationGraph5');


Route::get('/api2/search/{keyword?}', function (Request $request, $keyword = null) {
    //return 'najib';
    if ($keyword == null) {
    	echo 'It works';
    } else {
    	$id = $request->segment(4);
	    $datas = FoodProduct::where('fName', 'like', '%' . $keyword . '%')->get();
	    return response()->json($datas); 
	    //$request->json_encode($kontens);	
    }
    
})->middleware('cors');

//end of TA Najib Azmi
