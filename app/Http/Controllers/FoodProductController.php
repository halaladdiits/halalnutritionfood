<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Validator, Requests;
use JavaScript;

use Carbon\Carbon;
use App\Models\FoodProduct;
use App\Models\Ingredient;
use App\Models\Certificate;
use App\Models\HalalSource;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use DB;

class FoodProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $foodProducts = FoodProduct::all();
        return view('foodproducts/list',compact('foodProducts'));
    }
    
    public function vocab()
    {
        return view('foodproducts/vocab2');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('foodproducts/create');
    }

    public static $rules = [
        'fCode' => ['required','min:8','max:13'],
        'fName' => ['required','min:5'],
        'fManufacture' => ['required','min:3'],
        'ingredient_list' => ['required'],
    ];

    public static $messages = [
        'fCode.required' => 'Food code is required',
        'fCode.min' => 'Food code too short',
        'fCode.max' => 'Food code too long',
        'fName.required' => 'Food name is required',
        'fName.min' => 'Food name too short',
        'fManufacture.required' => 'Food manufacture is required',
        'fManufacture.min' => 'Food manufacture too short',
        'ingredient_list.required' => 'Food ingredient is required',
    ];

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = Input::all();
        $addRules = ['unique:foodproducts'];
        $addMessages = [
            'fCode.unique' => 'Food code must unique',
        ];
        $rules = [
            'fCode' => array_merge(self::$rules['fCode'], $addRules),
            'fName' => self::$rules['fName'],
            'fManufacture' => self::$rules['fManufacture'],
            'ingredient_list' => self::$rules['ingredient_list']
        ]; 
        $messages =  array_merge(self::$messages, $addMessages);
        $validator = Validator::make($input, $rules, $messages);
        if($validator->fails())
        {
            return redirect()->back()
                ->withErrors($validator);
        }
        //Get Ingredient
        foreach($request->input('ingredient_list') as $ing => $i){
            $storeIngredient = $this->storeIngredient($request, $ing);
            if(is_object($storeIngredient)){
                // return redirect()->back()
                // ->withErrors($storeCertificate);    
            }
            else{
                $ingredient[$ing] = $storeIngredient;
            }
        }
        //Get Certificate
        foreach ($request->input('cCode') as $key => $c){
            if (!empty($request->input('cCode')[$key])) {
                $storeCertificate = $this->storeCertificate($request, $key);
                if(is_object($storeCertificate)){
                    return redirect()->back()
                    ->withErrors($storeCertificate);    
                }
                else{
                $certificate[$key] = $storeCertificate;
                }
            }
        }
        //Store
        $foodProduct = FoodProduct::create($request->all());
        if (isset($ingredient)) {
            foreach ($ingredient as $key => $ing){
                $foodProduct->ingredient()->attach($ingredient[$key]);
            }
        }
        if (isset($certificate)) {
            foreach ($certificate as $key => $c){
                $foodProduct->certificate()->attach($certificate[$key]);
            }
        }
        //Redirect
        flash()->success('Food Product Has Successful Added');
        return redirect()->route('foodproduct.index');
    }

    public function storeIngredient(Request $request, $ing)
    {
        $ingredient = Ingredient::where('id',$request->input('ingredient_list')[$ing])->lists('id');
        if(!$ingredient->isEmpty()){
            return $request->input('ingredient_list')[$ing];
        }
        else{
            $ingredient = Ingredient::where('iName',$request->input('ingredient_list')[$ing])->lists('id');
            if(!$ingredient->isEmpty()){
                return $ingredient[0];
            }
            else {
                $ingredient = new Ingredient;
                $ingredient->iName = ucwords($request->input('ingredient_list')[$ing]);
                $ingredient->save();                
                return $ingredient->id;
            }
        }
    }

    public function storeCertificate(Request $request, $key)
    {
        //Validation
        $input = $request->all();
        $rules = [
            'cCode.'.$key => ['required','numeric','min:3'],
            'cExpire.'.$key => ['required','date'],
            'cOrganization.'.$key => ['required']
        ];
        $messages = [
            'cCode.'.$key.'.required' => 'Certificate code is required',
            'cCode.'.$key.'.number' => 'Certificate code format is invalid',
            'cCode.'.$key.'.min' => 'Certificate code too short',
            'cExpire.'.$key.'.required' => 'Certificate expire is required',
            'cCode.'.$key.'.date' => 'Certificate code format is invalid',
            'cOrganization.'.$key.'.required' => 'Certificate organization is required'
        ];
        $validator = Validator::make($input, $rules, $messages);
        if($validator->fails())
        {
            return $validator;
        }
        else{
            //Store
            $certificate = Certificate::where('cCode', $request->input('cCode')[$key])->lists('id');
            if (!$certificate->isEmpty()) {
                return $certificate[0];
            }
            else {
                $certificate = new Certificate;
                $certificate->cCode = $request->input('cCode')[$key];
                $certificate->cExpire = Carbon::parse($request->input('cExpire')[$key]);
                $certificate->cStatus = $request->input('cStatus')[$key];
                $certificate->cOrganization = $request->input('cOrganization')[$key];
                $certificate->save();
                return $certificate->id;
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $foodProduct = FoodProduct::find($id);
        
        /*
								
		$cosinesimilarity = DB::select('SELECT foodproducts.id, foodproducts.fName, similarity.cosine
								FROM foodproducts
								INNER JOIN similarity
								ON foodproducts.id = similarity.docId 
								OR foodproducts.id = similarity.docId2
								WHERE (
									similarity.docId = :id1 
									OR similarity.docId2 = :id2
								)
								AND foodproducts.id != :id3
								ORDER BY similarity.cosine DESC
								LIMIT 5', ['id1' => $id,'id2' => $id,'id3' => $id]);
								
		$euclideansimilarity = DB::select('SELECT foodproducts.id, foodproducts.fName, similarity.euclidean
								FROM foodproducts
								INNER JOIN similarity
								ON foodproducts.id = similarity.docId 
								OR foodproducts.id = similarity.docId2
								WHERE (
									similarity.docId = :id1 
									OR similarity.docId2 = :id2
								)
								AND foodproducts.id != :id3
								ORDER BY similarity.euclidean DESC
								LIMIT 5', ['id1' => $id,'id2' => $id,'id3' => $id]);
		*/
								
								/* tidak pakai certificate
		$cosinesimilarity = DB::select('SELECT foodproducts.id, foodproducts.fName, similarity.cosine
								FROM foodproducts
								INNER JOIN similarity
								ON foodproducts.id = similarity.docId2
								WHERE similarity.docId = :id								
								ORDER BY similarity.cosine DESC
								LIMIT 5', ['id' => $id]);
								
		$euclideansimilarity = DB::select('SELECT foodproducts.id, foodproducts.fName, similarity.euclidean
								FROM foodproducts
								INNER JOIN similarity
								ON foodproducts.id = similarity.docId2
								WHERE similarity.docId = :id
								ORDER BY similarity.euclidean DESC
								LIMIT 5', ['id' => $id]);
								*/
								
		$cosinesimilarity = DB::select('SELECT f.id, f.fName, s.cosine, c.cExpire
								FROM foodproducts f
								INNER JOIN similarity s
								ON f.id = s.docId2
								LEFT JOIN foodproduct_certificate fc
								ON fc.foodproduct_id = f.id
								LEFT JOIN certificates c
								ON fc.certificate_id = c.id
								WHERE s.docId = :id								
								ORDER BY s.cosine DESC
								LIMIT 5', ['id' => $id]);
								
		$euclideansimilarity = DB::select('SELECT f.id, f.fName, s.euclidean, c.cExpire
								FROM foodproducts f
								INNER JOIN similarity s
								ON f.id = s.docId2
								LEFT JOIN foodproduct_certificate fc
								ON fc.foodproduct_id = f.id
								LEFT JOIN certificates c
								ON fc.certificate_id = c.id
								WHERE s.docId = :id
								ORDER BY s.euclidean DESC
								LIMIT 5', ['id' => $id]);						
        
        if (!empty($foodProduct)) {
            $foodWarning = $this->foodWarning($foodProduct);
            $fullness = $this->fullness($foodProduct);
            $view = array(
                'fView' => $foodProduct->fView+1,
            );
            $foodProduct->update($view);
            
            //$ingredients = $foodProduct->ingredient->all();
            
            $ingredients = DB::select('SELECT i.id, i.iType, i.iName, i.eNumber, h.hStatus, h.hOrganization
								FROM foodproduct_ingredient fi
								INNER JOIN ingredients i
								ON fi.ingredient_id = i.id
								LEFT JOIN ingredient_halal ih
								ON i.id = ih.ingredient_id
								LEFT JOIN halalsources h
								ON ih.halal_id = h.id
								WHERE fi.foodproduct_id = :id', ['id' => $id]);
            
            foreach ($ingredients as $ing) {
                if($ing->iType==0){
                    $inglist[] = $ing->iName;
                }
                else{
                    $addlist[] = [
                        'addName' => $ing->iName, 
                        'addId' => $ing->id,
                        'addENumber' => $ing->eNumber, 
                    ];
                    
                    if($ing->hStatus == 2)  { //haram additive
						$haramaddlist[] = [
							'addName' => $ing->iName, 
							'addENumber' => $ing->eNumber, 
							'addId' => $ing->id,
							'addStatus' => $ing->hStatus,
							'addStatusOrg' => $ing->hOrganization,
						];
					}
                }
            }
            if(!empty($addlist)) {
            	$addlist = array_unique($addlist, SORT_REGULAR); //remove duplicate possibilities by different hOrganization
            }

            $certificate = $foodProduct->certificate->all();
            return view('foodproducts/show',compact('foodProduct','inglist','addlist','certificate','foodWarning','fullness','cosinesimilarity','euclideansimilarity', 'haramaddlist'));    
        }
        abort(404);
    }

    public function foodWarning($foodProduct)
    {
        $nutrient = ['fat', 'saturated fat', 'trans fat', 'cholesterol', 'sodium', 'carbohydrates', 'fiber', 'sugar', 'protein', 'vitamin A', 'vitamin C',
     'calcium', 'iron'];
        //DVs based on a caloric intake of 2,000 calories, for adults and children four or more years of age.
        $check[0] = [
            round($foodProduct['totalFat']*100/65),
            round($foodProduct['saturatedFat']*100/20),
            0,
            round($foodProduct['cholesterol']*100/300),
            round($foodProduct['sodium']*100/2400),
            round($foodProduct['totalCarbohydrates']*100/300),
            round($foodProduct['dietaryFiber']*100/25),
            0,
            round($foodProduct['protein']*100/50),
            $foodProduct['vitaminA'],
            $foodProduct['vitaminC'],
            $foodProduct['calcium'],
            $foodProduct['iron'],
        ];
        $check[1] = [
            $check[0][0],
            $check[0][1],
            $check[0][2],
            $check[0][3],
            $check[0][4],
            $check[0][5],
            $check[0][6],
            $check[0][7],
            $check[0][8],
            round(($foodProduct['vitaminA']/100*5000)*100/1500),
            round(($foodProduct['vitaminC']/100*60)*100/35),
            round(($foodProduct['calcium']/100*1000)*100/600),
            round(($foodProduct['iron']/100*18)*100/15),
        ];
        $check[2] = [
            $check[0][0],
            $check[0][1],
            $check[0][2],
            $check[0][3],
            $check[0][4],
            $check[0][5],
            $check[0][6],
            $check[0][7],
            $check[0][8],
            round(($foodProduct['vitaminA']/100*5000)*100/2500),
            round(($foodProduct['vitaminC']/100*60)*100/40),
            round(($foodProduct['calcium']/100*1000)*100/800),
            round(($foodProduct['iron']/100*18)*100/10),
        ];
        $check[3] = [
            $check[0][0],
            $check[0][1],
            $check[0][2],
            $check[0][3],
            $check[0][4],
            $check[0][5],
            $check[0][6],
            $check[0][7],
            $check[0][8],
            round(($foodProduct['vitaminA']/100*5000)*100/8000),
            round(($foodProduct['vitaminC']/100*60)*100/60),
            round(($foodProduct['calcium']/100*1000)*100/1300),
            round(($foodProduct['iron']/100*18)*100/18),
        ];
        $count=0;
        for ($i=0; $i < 4 ; $i++) { 
            foreach ($check[$i] as $key => $val) {
                if ($check[$i][$key]>15) {
                    $warning[$i][$key] = 'This food contains high '.$nutrient[$key];
                }
                else{
                    $warning[$i][$key] = null;
                    $count++;
                }
            }
        }
        if($count==52){
            $warning=null;
        }        
        return $warning;
        
        
    }

    public function fullness($foodProduct)
    {
    	if($foodProduct['weight'] > 0) { //cek kalau weight = 0 ; aslinya tidak pakai if
    		$CAL=$foodProduct['calories']*100/$foodProduct['weight'];
        	if($CAL<30)$CAL=30;
        	$PR=$foodProduct['protein']*100/$foodProduct['weight'];
        	if($PR>30)$PR=30;
        	$DF=$foodProduct['dietaryFiber']*100/$foodProduct['weight'];
        	if($DF>12)$DF=12;
        	$TF=$foodProduct['totalFat']*100/$foodProduct['weight'];
        	if($TF>50)$TF=50;

	        $FF=max(0.5, min(5.0, 41.7/$CAL^0.7 + 0.05*$PR + 6.17E-4*$DF^3 - 7.25E-6*$TF^3 + 0.617));
        	// FF=MAX(0.5, MIN(5.0, 41.7/CAL^0.7 + 0.05*PR + 6.17E-4*DF^3 - 7.25E-6*TF^3 + 0.617))
        	return $FF;
    	}
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $foodProduct = FoodProduct::find($id);
        //echo $foodProduct;
        if (!empty($foodProduct)) {
            $certificate = $foodProduct->certificate->all();
            $ingredient = $foodProduct->ingredient->all();
            $a = $foodProduct->ingredient->lists('id')->toArray(); //hasilnya array string
            
            $selected = array();
            foreach($a as $v) {
            	$selected[] = (int) $v; //convert array string ke int
            }
            
            //var_dump($a);
            //var_dump($selected);
            //JavaScript::put([
            //    'foodProduct' => $foodProduct
            //]);
            //return view('foodproducts/edit',compact('foodProduct','certificate'));
            return view('foodproducts/edit',compact('foodProduct','certificate','selected'));
        }
        abort(404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $input = Input::all();
        //Validation
        $validator = Validator::make($input, self::$rules, self::$messages);
        if($validator->fails())
        {
            return redirect()->back()
                ->withErrors($validator);
        }
        $update = array(
            'fName' => $request->input('fName'),
            'fCode' => $request->input('fCode'),
            'fManufacture' => $request->input('fManufacture'),

            'weight' => $request->input('weight'),
            'calories' => $request->input('calories'),
            'totalFat' => $request->input('totalFat'),
            'saturatedFat' => $request->input('saturatedFat'),
            'transFat' => $request->input('transFat'),
            'cholesterol' => $request->input('cholesterol'),
            'sodium' => $request->input('sodium'),
            'totalCarbohydrates' => $request->input('totalCarbohydrates'),
            'dietaryFiber' => $request->input('dietaryFiber'),
            'sugar' => $request->input('sugar'),
            'protein' => $request->input('protein'),
            'vitaminA' => $request->input('vitaminA'),
            'vitaminC' => $request->input('vitaminC'),
            'calcium' => $request->input('calcium'),
            'iron' => $request->input('iron'),
        );
        //Get Ingredient
        foreach($request->input('ingredient_list') as $ing => $i){
            $storeIngredient = $this->storeIngredient($request, $ing);
            if(is_object($storeIngredient)){
                // return redirect()->back()
                // ->withErrors($storeCertificate);    
            }
            else{
                $ingredient[$ing] = $storeIngredient;
            }
        }
        //Edit Certificate
        $ucCount = 0;
        $ucID = 0;
        if (!empty($request->input('ucID'))) {
            foreach ($request->input('ucID') as $key => $uc){
                $ucCount++;
            }
        }
        //Get Certificate
        foreach ($request->input('cCode') as $key => $c){
            if (!empty($request->input('cCode')[$key])) {
                $storeCertificate = $this->storeCertificate($request, $key);
                if(is_object($storeCertificate)){
                    return redirect()->back()
                    ->withErrors($storeCertificate);    
                }
                else{
                $certificate[$key] = $storeCertificate;
                }
            }
        }
        //Update
        $foodProduct = FoodProduct::findOrFail($id);
        $foodProduct->update($update);
        $foodProduct->ingredient()->detach();
        if (isset($ingredient)) {
            foreach ($ingredient as $key => $ing){
                $foodProduct->ingredient()->attach($ingredient[$key]);
            }
        }
        if (isset($certificate)) {
            foreach ($certificate as $key => $c){
                if($ucCount>0){
                    $update = [
                        'cCode' => $request->input('cCode')[$key],
                        'cExpire' => Carbon::parse($request->input('cExpire')[$key]),
                        'cStatus' => $request->input('cStatus')[$key],
                    ];
                    Certificate::findOrFail($request->input('ucID')[$ucID])->update($update);
                    $ucCount--;
                    $ucID++;
                }
                else{
                    $foodProduct->certificate()->attach($certificate[$key]);   
                }
            }
        }
        flash()->success('Food Product Has Successful Edited');
        return redirect()->route('foodproduct.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        FoodProduct::findOrFail($id)->delete();
        flash()->success('Food Product Has Successful Deleted');
        return redirect()->back();
    }

    public function certificateDestroy($id)
    {
        Certificate::findOrFail($id)->delete();
        return redirect()->back();
    }

    public function verify($id)
    {
        $update = array(
            'fVerify' => 1,
        );
        FoodProduct::findOrFail($id)->update($update);
        flash()->success('Food Product Has Successful Verified');
        return redirect()->back();
    }
    
    public function generateTtl()
    {
		
		$default = ini_get('max_execution_time');
		set_time_limit(3000);

        //Resource Produk
        $productfile = fopen("resources.ttl", "w");

        $prefix = "@prefix rdf: <http://www.w3.org/1999/02/22-rdf-syntax-ns#> .
@prefix rdfs: <http://www.w3.org/2000/01/rdf-schema#> .
@prefix owl: <http://www.w3.org/2002/07/owl#> .
@prefix xsd: <http://www.w3.org/2001/XMLSchema#> .
@prefix foaf: <http://xmlns.com/foaf/0.1/> .
@prefix halalv: <http://halal.addi.is.its.ac.id/halalv.ttl#> .
@prefix halalf: <http://halal.addi.is.its.ac.id/resources/foodproducts/> .
@prefix halali: <http://halal.addi.is.its.ac.id/resources/ingredients/> .
@prefix halals: <http://halal.addi.is.its.ac.id/resources/halalsources/> .
@prefix halalc: <http://halal.addi.is.its.ac.id/resources/certificates/> .
@prefix halalm: <http://halal.addi.is.its.ac.id/resources/manufactures/> .\n";
        
        $ingWritted = 0;
        $foodProducts = FoodProduct::where('fVerify',1)->get()->toArray();		

        fwrite($productfile, $prefix);
        
        //Menuliskan Resource foodproducts.ttl
        foreach ($foodProducts as $fp => $val) {
            $list[$fp]="\nhalalf:".$foodProducts[$fp]['id']." a halalv:FoodProduct.";
            fwrite($productfile, $list[$fp]);
        }

        foreach ($foodProducts as $fp => $val) {
            //=========================== FOOD PRODUCT ==================================
            //Menuliskan ke turtle			
			$clean_label = preg_replace('/\W+/', ' ', $foodProducts[$fp]['fName']);
			$clean_fName = preg_replace('/\W+/', '_', $foodProducts[$fp]['fName']);
			
            $list[$fp]="halalf:".$clean_fName." a halalv:FoodProduct;
\thalalv:foodCode \"".$foodProducts[$fp]['fCode']."\";
\trdfs:label \"".$clean_label."\";
\thalalv:manufacture \"".$foodProducts[$fp]['fManufacture']."\";
\thalalv:netWeight ".$foodProducts[$fp]['weight'].";
\thalalv:calories ".$foodProducts[$fp]['calories'].";
\thalalv:fat ".$foodProducts[$fp]['totalFat'].";
\thalalv:saturatedFat ".$foodProducts[$fp]['saturatedFat'].";
\thalalv:sodium ".$foodProducts[$fp]['sodium'].";
\thalalv:fiber ".$foodProducts[$fp]['dietaryFiber'].";
\thalalv:sugar ".$foodProducts[$fp]['sugar'].";
\thalalv:protein ".$foodProducts[$fp]['protein'].";
\thalalv:vitaminA ".$foodProducts[$fp]['vitaminA'].";
\thalalv:vitaminC ".$foodProducts[$fp]['vitaminC'].";
\thalalv:calcium ".$foodProducts[$fp]['calcium'].";
\thalalv:iron ".$foodProducts[$fp]['iron'].";
\thalalv:foodproductId ".$foodProducts[$fp]['id'].".\n";

            //Menuliskan file resource foodproducts
            $fileFoodProduct = "resources3/foodproducts/".$clean_fName.".ttl";
            if(!file_exists($fileFoodProduct)) {
            	$resFoodProduct = fopen($fileFoodProduct, "w");
	            fwrite($resFoodProduct, $prefix."\n");
	            fwrite($resFoodProduct, $list[$fp]);
	
	            $hasManufacture = "\nhalalf:".$foodProducts[$fp]['id']." halalv:manufacture halalm:".$foodProducts[$fp]['id'].".";
	            
	            //Menuliskan hubungan foodproduct dengan manufacture di file resource foodproducts
	            fwrite($resFoodProduct, $hasManufacture."\n");
	
	            $getCertFK = DB::select('select * from foodproduct_certificate where foodproduct_id = ?', [$foodProducts[$fp]['id']]);
				if(count($getCertFK)) {
					$hasCertificate = "\nhalalf:".$foodProducts[$fp]['id']." halalv:certificate ";
					foreach ($getCertFK as $id => $val) {
						$hasCertificate = $hasCertificate."halalc:".$getCertFK[$id]->certificate_id.", ";
					}
				}
	            
	
	            //Menuliskan hubungan foodproduct dengan certificate di file resource foodproducts
	            if(substr($hasCertificate, -2,1) !== "e"){
	                fwrite($resFoodProduct, rtrim($hasCertificate,", \"").".\n");    
	            }
	
	            $getIngFK = DB::select('select * from foodproduct_ingredient inner join ingredients on ingredients.id = foodproduct_ingredient.ingredient_id where foodproduct_id = ?', [$foodProducts[$fp]['id']]);							
	
	            //Menuliskan kandungan komposisi
				if(count($getIngFK)) {
					$containsIng = "\nhalalf:".$foodProducts[$fp]['id']." halalv:containsIngredient ";
					foreach ($getIngFK as $id => $val) {
						
						$iName = $getIngFK[$id]->iName;
						$iName = preg_replace('/\W+/', '_', $iName);
						
						$containsIng = $containsIng."halali:".$iName.", ";
					}
				}
	            
	            
	            //Menuliskan file resource certificates
	            fwrite($resFoodProduct, rtrim($containsIng,", \"").".\n");
	
	            //=========================== MANUFACTURE ==================================
	            //Get manufacture
	            $getManufacture = DB::select('select fManufacture from foodproducts where id = ?', [$foodProducts[$fp]['id']]);
				
				if(count($getManufacture)) {
					$insertManufacture = "halalm:".$foodProducts[$fp]['id']." a halalv:Manufacture;
	\trdfs:label \"".$getManufacture[0]->fManufacture."\".\n";   
	            
					//Menuliskan file resource manufacture
					$fileManufacture = "resources3/manufactures/".$foodProducts[$fp]['fManufacture'].".ttl";
					$resManufacture = fopen($fileManufacture, "w");
					fwrite($resManufacture, $prefix."\n");
					fwrite($resManufacture, $insertManufacture);
					fclose($resManufacture);
				}
	            
	
	            //=========================== CERTIFICATE ==================================    
	            //Get certificate
				if(count($getCertFK)) {
					foreach ($getCertFK as $id => $val) {
						$certificate[$id] = Certificate::findOrFail($getCertFK[$id]->certificate_id);
						if($certificate[$id]->cStatus == 0){
							$cStatus = "Development";
						}
						elseif ($certificate[$id]->cStatus == 1) {
							$cStatus = "New";   
						}
						else{
							$cStatus = "Renew";
						}
						$insertCertificate = "\nhalalc:".$certificate[$id]->id." a halalv:HalalCertificate;
		\thalalv:halalCode \"".$certificate[$id]->cCode."\";
		\thalalv:halalExp \"".$certificate[$id]->cExpire->format('Y-m-d')."\"^^xsd:date;
		\thalalv:halalStatus \"".$cStatus."\";
		\tfoaf:organization \"".$certificate[$id]->cOrganization."\".";
		
						//Menuliskan file resource certificates
						$fileCertificate = "resources3/certificates/".$certificate[$id]->id.".ttl";
						$resCertificate = fopen($fileCertificate, "w");
						fwrite($resCertificate, $prefix."\n");
						fwrite($resCertificate, $insertCertificate);
						fclose($resCertificate);
					}
				}
	            
	
	            //=========================== INGREDIENT ==================================
	            //Get Ingredient
				if(count($getIngFK)) {
					foreach ($getIngFK as $id => $val) {
						$ingredient[$id] = Ingredient::findOrFail($getIngFK[$id]->ingredient_id);
						$halalIng = "\nhalali:".$ingredient[$id]['id']." halalv:halalSource ";
						$halalId = $ingredient[$id]['id'];
						
						$halalName = $ingredient[$id]['iName'];
						$halalName = preg_replace('/\W+/', '_', $halalName);
						//$halalName = str_replace('"',"",$halalName);
						//$halalName = str_replace(' ',"_",$halalName);
						
						if($ingredient[$id]->iType == 0){
							$insertIngredient = "\nhalali:".$ingredient[$id]->id." a halalv:Ingredient;
		\thalalv:rank ".$ingredient[$id]->id.";
		\trdfs:label \"".$ingredient[$id]->iName."\".";
						}
						else{
							$insertIngredient = "\nhalali:".$ingredient[$id]->id." a halalv:FoodAdditive;
		\thalalv:rank ".$ingredient[$id]->id.";
		\trdfs:label \"".$ingredient[$id]->iName."\";
		\trdfs:comment \"".$ingredient[$id]->eNumber."\";\n";
							
							//$DBpedia = @file_get_contents("http://dbpedia.org/sparql?default-graph-uri=http%3A%2F%2Fdbpedia.org&query=select+distinct+%3Fresource+where+%0D%0A%7B+%3Fresource+rdfs%3Alabel+%22".str_replace(" ","+",$ingredient[$id]->iName)."%22%40en+%7D&format=application%2Fsparql-results%2Bjson&CXML_redir_for_subjs=121&CXML_redir_for_hrefs=&timeout=30000&debug=on");
							$DBpedia = @file_get_contents("https://dbpedia.org/sparql?default-graph-uri=http%3A%2F%2Fdbpedia.org&query=ask+%7B+%3Chttp%3A%2F%2Fdbpedia.org%2Fresource%2F".str_replace(" ","_",$ingredient[$id]->iName)."%3E+%3Fp+%3Fo+%7D&format=text%2Fhtml&CXML_redir_for_subjs=121&CXML_redir_for_hrefs=&timeout=30000&debug=on&run=+Run+Query+");
							//if($DBpedia) {
							if($DBpedia == "true") {
								$insertIngredient = $insertIngredient."\towl:sameAs <http://dbpedia.org/resource/".str_replace(' ', '_', $ingredient[$id]->iName).">.";
							}
							else{
								$insertIngredient = rtrim($insertIngredient,";\n").".";
							}
		
							//=========================== HALAL SOURCE ==================================
							//Get Halal Source
							$getHalalFK = DB::select('select * from ingredient_halal where ingredient_id = ?', [$ingredient[$id]->id]);
							if(count($getHalalFK)) {
								foreach ($getHalalFK as $id => $val) {
									$halal[$id] = HalalSource::findOrFail($getHalalFK[$id]->halal_id);
									if($halal[$id]->hStatus == 0){
										$hStatus = "Halal";
									}
									elseif ($halal[$id]->hStatus == 1) {
										$hStatus = "Mushbooh";   
									}
									else{
										$hStatus = "Haraam";
									}
									$insertHalal = "\nhalals:".$halal[$id]->id." a halalv:Source;
			\trdfs:label \"".$hStatus."\";
			\trdfs:comment \"".$halal[$id]->hDescription."\";
			\tfoaf:organization \"".$halal[$id]->hOrganization."\";
			\trdfs:seeAlso <".$halal[$id]->hUrl.">.";
									
									//Menuliskan file resource halalsource
									$fileHalalSource = "resources3/halalsources/".$halal[$id]->id.".ttl";
									$resHalalSource = fopen($fileHalalSource, "w");
									fwrite($resHalalSource, $prefix);
									fwrite($resHalalSource, $insertHalal);
									fclose($resHalalSource);
									
									$halalIng = $halalIng."halals:".$getHalalFK[$id]->halal_id.", ";
								}
								$halalSource[$halalId] = rtrim($halalIng,", \"").".";
							}
							
						}
						if($ingWritted != $ingredient[$id]->id){
							//Menuliskan file resource ingredients
							$fileIngredient = "resources3/ingredients/".$halalName.".ttl";
							$resIngredient = fopen($fileIngredient, "w");
							fwrite($resIngredient, $prefix);
							fwrite($resIngredient, $insertIngredient);
							if (isset($halalSource[$halalId])) {
								fwrite($resIngredient, $halalSource[$halalId]);
							}
							fclose($resIngredient);
						}
						$ingWritted = $ingredient[$id]->id;
					}
				}

	            
	            //lanjut ke food product selanjutnya
	            fclose($resFoodProduct);
            }
            
        }
        echo "berhasil";
		set_time_limit($default);
    }
    
    public function generateTtl2()
    {
		
		$default = ini_get('max_execution_time');
		set_time_limit(3000);

        //Resource Produk
        $productfile = fopen("resources.ttl", "w");

        $prefix = "@prefix rdf: <http://www.w3.org/1999/02/22-rdf-syntax-ns#> .
@prefix rdfs: <http://www.w3.org/2000/01/rdf-schema#> .
@prefix owl: <http://www.w3.org/2002/07/owl#> .
@prefix xsd: <http://www.w3.org/2001/XMLSchema#> .
@prefix foaf: <http://xmlns.com/foaf/0.1/> .
@prefix halalv: <http://halal.addi.is.its.ac.id/halalv.ttl#> .
@prefix halalf: <http://halal.addi.is.its.ac.id/resources/foodproducts/> .
@prefix halali: <http://halal.addi.is.its.ac.id/resources/ingredients/> .
@prefix halals: <http://halal.addi.is.its.ac.id/resources/halalsources/> .
@prefix halalc: <http://halal.addi.is.its.ac.id/resources/certificates/> .
@prefix halalm: <http://halal.addi.is.its.ac.id/resources/manufactures/> .
@prefix food: <http://purl.org/foodontology#> .
@prefix foodlirmm: <http://data.lirmm.fr/ontologies/food#> .
@prefix gr: <http://purl.org/goodrelations/v1#>. \n";
        
        $ingWritted = 0;
        
        //================================  04/26/2018  =======================================
        
        /* mengganti query FoodProduct dengan menjoin ke tabel foodproduct_manufacture untuk mengambil id manufaktur*/
        
        //$foodProducts = FoodProduct::where('fVerify',1)->get()->toArray();
        $makanan = DB::select(
        	'select foodproducts.*, foodproduct_manufacture.manufacture_id 
        	from foodproducts 
        	inner join foodproduct_manufacture 
        	on foodproducts.id = foodproduct_manufacture.foodproduct_id 
        	where fVerify = 1'
        );
        
        // Hasil query raw berupa object, belum array, fungsi dibawah diambil dari https://stackoverflow.com/a/37518354
        // BELUM DICOBA !!!
        $foodProducts = json_decode(json_encode($makanan), true);
        //================================  **********  =======================================

        fwrite($productfile, $prefix);
        
        //Menuliskan Resource foodproducts.ttl
        $i = 0;
        foreach ($foodProducts as $fp => $val) {
        	$clean_fName = preg_replace('/\W+/', '_', $foodProducts[$fp]['fName']);
            //$list[$fp]="\nhalalf:".$foodProducts[$fp]['id']." a halalv:FoodProduct.";
            $list[$fp]="\nhalalf:".$clean_fName." a halalv:FoodProduct.";
            fwrite($productfile, $list[$fp]);
            
            $i++;
            if($i == 10) {
            	break;
            	echo "10 ttl berhasil";
            }
        }

        foreach ($foodProducts as $fp => $val) {
            //=========================== FOOD PRODUCT ==================================
            //Menuliskan ke turtle			
			$clean_label = preg_replace('/\W+/', ' ', $foodProducts[$fp]['fName']);
			$clean_fName = preg_replace('/\W+/', '_', $foodProducts[$fp]['fName']);
			$clean_fManufacture = preg_replace('/\W+/', '_', $foodProducts[$fp]['fManufacture']);
			$manufacture_id = $foodProducts[$fp]['manufacture_id'];
			
			
            $list[$fp]="halalf:".$clean_fName." a foodlirmm:FoodProduct;
\ta food:Food;
\tfoodlirmm:code \"".$foodProducts[$fp]['fCode']."\";
\trdfs:label \"".$clean_label."\";
\tgr:hasManufacturer halalm:". /*                                   ================================  04/26/2018  ======================================= $clean_fManufacture  //diganti dengan manufacture_id  */ $manufacture_id/*.";
\thalalv:netWeight ".$foodProducts[$fp]['weight'].";                =======================***** tidak ada di paper *****================================          
\thalalv:calories ".$foodProducts[$fp]['calories']*/.";
\tfoodlirmm:fatPer100g ".$foodProducts[$fp]['totalFat'].";
\tfoodlirmm:saturatedFatPer100g ".$foodProducts[$fp]['saturatedFat'].";
\tfoodlirmm:sodiumPer100g ".$foodProducts[$fp]['sodium'].";
\tfoodlirmm:fiberPer100g ".$foodProducts[$fp]['dietaryFiber'].";
\tfoodlirmm:sugarsPer100g ".$foodProducts[$fp]['sugar'].";
\tfoodlirmm:proteinsPer100g ".$foodProducts[$fp]['protein']/*.";    ================================  04/26/2018  =======================================
\thalalv:vitaminA ".$foodProducts[$fp]['vitaminA'].";
\thalalv:vitaminC ".$foodProducts[$fp]['vitaminC'].";               tidak ada di paper
\thalalv:calcium ".$foodProducts[$fp]['calcium'].";
\thalalv:iron ".$foodProducts[$fp]['iron'].";                       ================================  **********  =======================================
\thalalv:foodproductId ".$foodProducts[$fp]['id']*/.".\n";

            //Menuliskan file resource foodproducts
            $fileFoodProduct = "resources/foodproducts/".$clean_fName.".ttl";
            if(!file_exists($fileFoodProduct)) {
            	$resFoodProduct = fopen($fileFoodProduct, "w");
	            fwrite($resFoodProduct, $prefix."\n");
	            fwrite($resFoodProduct, $list[$fp]);
	
				//START REVISI SM BU IIN OLEH NAJIB LINE BAWAH INI DICOMMENT KARENA SUDAH TERGANTIKAN OLEH GR:HASMANUFATURE
	            //$hasManufacture = "\nhalalf:".$clean_fName." halalv:manufacture halalm:".$foodProducts[$fp]['id'].".";
	            
	            //Menuliskan hubungan foodproduct dengan manufacture di file resource foodproducts
	            //fwrite($resFoodProduct, $hasManufacture."\n");
	            
	            //END REVISI SM BU IIN OLEH NAJIB LINE BAWAH INI DICOMMENT KARENA SUDAH TERGANTIKAN OLEH GR:HASMANUFATURE
	
	            $getCertFK = DB::select('select * from foodproduct_certificate where foodproduct_id = ?', [$foodProducts[$fp]['id']]);
				if(count($getCertFK)) {
					$hasCertificate = "\nhalalf:".$clean_fName." foodlirmm:certificate ";
					foreach ($getCertFK as $id => $val) {
						$hasCertificate = $hasCertificate."halalc:".$getCertFK[$id]->certificate_id.", ";
					}
					
					 //Menuliskan hubungan foodproduct dengan certificate di file resource foodproducts
		            if(substr($hasCertificate, -2,1) !== "e"){
		                fwrite($resFoodProduct, rtrim($hasCertificate,", \"").".\n");    
		            }
		
				}
	            
	
	           
	            $getIngFK = DB::select('select * from foodproduct_ingredient inner join ingredients on ingredients.id = foodproduct_ingredient.ingredient_id where foodproduct_id = ?', [$foodProducts[$fp]['id']]);							
	
	            //Menuliskan kandungan komposisi
				if(count($getIngFK)) {
					$containsIng = "\nhalalf:".$clean_fName." food:containsIngredient ";
					foreach ($getIngFK as $id => $val) {
						
						$iName = $getIngFK[$id]->iName;
						$iName = preg_replace('/\W+/', '_', $iName);
						
						//================================  04/26/2018  =======================================
						// containsIngredient menggunakan Id makanan
						$ingredient_id = $getIngFK[$id]->ingredient_id;
						
						//$containsIng = $containsIng."halali:".$iName.", ";
						$containsIng = $containsIng."halali:".$ingredient_id.", ";
						//================================  **********  =======================================
						
					}
					
					//Menuliskan file resource certificates
	            	fwrite($resFoodProduct, rtrim($containsIng,", \"").".\n");
	
				}
	            
	            //================================  04/26/2018  =======================================
	            // tambahan ingredientsListAsText
	            if(count($getIngFK)) {
					$ingredientsListAsText = "\nhalalf:".$clean_fName." food:ingredientsListAsText ";
					foreach ($getIngFK as $id => $val) {
						
						$iName = $getIngFK[$id]->iName;
						$ingredientsListAsText = $ingredientsListAsText."\"".$iName."\", ";
						
					}
					
					//Menuliskan ingredientsListAsText
	            	fwrite($resFoodProduct, rtrim($ingredientsListAsText,", \"").".\n");
	
				}
	            //================================  **********  =======================================
	            
	            //=========================== MANUFACTURE ==================================
	            //Get manufacture
	            $getManufacture = DB::select('select fManufacture from foodproducts where id = ?', [$foodProducts[$fp]['id']]);
				
				if(count($getManufacture)) {
					$insertManufacture = "halalm:".$clean_fManufacture." a foaf:Organization;
	\trdfs:label \"".$getManufacture[0]->fManufacture."\".\n";   
	            
					//Menuliskan file resource manufacture
					$fileManufacture = "resources/manufactures/".$clean_fManufacture.".ttl";
					$resManufacture = fopen($fileManufacture, "w");
					fwrite($resManufacture, $prefix."\n");
					fwrite($resManufacture, $insertManufacture);
					fclose($resManufacture);
				}
	            
	
	            //=========================== CERTIFICATE ==================================    
	            //Get certificate
				if(count($getCertFK)) {
					foreach ($getCertFK as $id => $val) {
						$certificate[$id] = Certificate::findOrFail($getCertFK[$id]->certificate_id);
						if($certificate[$id]->cStatus == 0){
							$cStatus = "Development";
						}
						elseif ($certificate[$id]->cStatus == 1) {
							$cStatus = "New";   
						}
						else{
							$cStatus = "Renew";
						}
						
						$clean_org = preg_replace('/\W+/', '_', $certificate[$id]->cOrganization);						
						
						$insertCertificate = "\nhalalc:".$certificate[$id]->id." a halalv:HalalCertificate;
		\thalalv:halalCode \"".$certificate[$id]->cCode."\";
		\thalalv:halalExp \"".$certificate[$id]->cExpire->format('Y-m-d')."\"^^xsd:date;
		\thalalv:halalStatus \"".$cStatus."\";
		\thalalv:OrgCert halals:".$clean_org.".";
		
						//Menuliskan file resource certificates
						$fileCertificate = "resources/certificates/".$certificate[$id]->id.".ttl";
						$resCertificate = fopen($fileCertificate, "w");
						fwrite($resCertificate, $prefix."\n");
						fwrite($resCertificate, $insertCertificate);
						fclose($resCertificate);
					}
				}
	            
	
	            //=========================== INGREDIENT ==================================
	            //Get Ingredient
				if(count($getIngFK)) {
					foreach ($getIngFK as $id => $val) {
						$ingredient[$id] = Ingredient::findOrFail($getIngFK[$id]->ingredient_id);
						
						$halalName = $ingredient[$id]['iName'];
						$halalName = preg_replace('/\W+/', '_', $halalName);
						//$halalName = str_replace('"',"",$halalName);
						//$halalName = str_replace(' ',"_",$halalName);
						
						$halalIng = "\nhalali:".$halalName." halalv:halal ";
						$halalId = $ingredient[$id]['id'];											
												
						
						if($ingredient[$id]->iType == 0){
							$insertIngredient = "\nhalali:".$halalName." a foodlirmm:Ingredient;
		\tfoodlirmm:rank ".$ingredient[$id]->id.";
		\trdfs:label \"".$ingredient[$id]->iName."\".";
						}
						else{
							$insertIngredient = "\nhalali:".$halalName." a food:FoodAdditive,foodlirmm:Ingredient;
		\tfoodlirmm:rank ".$ingredient[$id]->id.";
		\trdfs:label \"".$ingredient[$id]->iName."\";
		\trdfs:comment \"".$ingredient[$id]->eNumber."\";\n";
							
							//$DBpedia = @file_get_contents("http://dbpedia.org/sparql?default-graph-uri=http%3A%2F%2Fdbpedia.org&query=select+distinct+%3Fresource+where+%0D%0A%7B+%3Fresource+rdfs%3Alabel+%22".str_replace(" ","+",$ingredient[$id]->iName)."%22%40en+%7D&format=application%2Fsparql-results%2Bjson&CXML_redir_for_subjs=121&CXML_redir_for_hrefs=&timeout=30000&debug=on");
							$DBpedia = @file_get_contents("https://dbpedia.org/sparql?default-graph-uri=http%3A%2F%2Fdbpedia.org&query=ask+%7B+%3Chttp%3A%2F%2Fdbpedia.org%2Fresource%2F".str_replace(" ","_",$ingredient[$id]->iName)."%3E+%3Fp+%3Fo+%7D&format=text%2Fhtml&CXML_redir_for_subjs=121&CXML_redir_for_hrefs=&timeout=30000&debug=on&run=+Run+Query+");
							//if($DBpedia) {
							if($DBpedia == "true") {
								$insertIngredient = $insertIngredient."\towl:sameAs <http://dbpedia.org/resource/".str_replace(' ', '_', $ingredient[$id]->iName).">.";
							}
							else{
								$insertIngredient = rtrim($insertIngredient,";\n").".";
							}
		
							//=========================== HALAL SOURCE ==================================
							//Get Halal Source
							$getHalalFK = DB::select('select * from ingredient_halal where ingredient_id = ?', [$ingredient[$id]->id]);
							if(count($getHalalFK)) {
								foreach ($getHalalFK as $id => $val) {
									$halal[$id] = HalalSource::findOrFail($getHalalFK[$id]->halal_id);
									if($halal[$id]->hStatus == 0){
										$hStatus = "Halal";
									}
									elseif ($halal[$id]->hStatus == 1) {
										$hStatus = "Mushbooh";   
									}
									else{
										$hStatus = "Haraam";
									}
									$insertHalal = "\nhalals:".$halal[$id]->id." a halalv:Source;
			\trdfs:label \"".$hStatus."\";
			\trdfs:comment \"".$halal[$id]->hDescription."\";
			\tfoaf:organization \"".$halal[$id]->hOrganization."\";
			\trdfs:seeAlso <".$halal[$id]->hUrl.">.";
									
									//Menuliskan file resource halalsource
									$fileHalalSource = "resources/halalsources/".$halal[$id]->id.".ttl";
									$resHalalSource = fopen($fileHalalSource, "w");
									fwrite($resHalalSource, $prefix);
									fwrite($resHalalSource, $insertHalal);
									fclose($resHalalSource);
									
									$halalIng = $halalIng."halals:".$getHalalFK[$id]->halal_id.", ";
								}
								$halalSource[$halalId] = rtrim($halalIng,", \"").".";
							}
							
						}
						if($ingWritted != $ingredient[$id]->id){
							//Menuliskan file resource ingredients
							$fileIngredient = "resources/ingredients/".$halalName.".ttl";
							$resIngredient = fopen($fileIngredient, "w");
							fwrite($resIngredient, $prefix);
							fwrite($resIngredient, $insertIngredient);
							if (isset($halalSource[$halalId])) {
								fwrite($resIngredient, $halalSource[$halalId]);
							}
							fclose($resIngredient);
						}
						$ingWritted = $ingredient[$id]->id;
					}
				}

	            
	            //lanjut ke food product selanjutnya
	            fclose($resFoodProduct);
	            unset($insertIngredient, $insertCertificate, $containsIng, $insertManufacture);
            }
            
        }
        echo "berhasil";
		set_time_limit($default);
    }
    
    public function generateTtl3()
    {
		
		$default = ini_get('max_execution_time');
		set_time_limit(3000);

        //Resource Produk
        $productfile = fopen("resources.ttl", "w");

        $prefix = "@prefix rdf: <http://www.w3.org/1999/02/22-rdf-syntax-ns#> .
@prefix rdfs: <http://www.w3.org/2000/01/rdf-schema#> .
@prefix owl: <http://www.w3.org/2002/07/owl#> .
@prefix xsd: <http://www.w3.org/2001/XMLSchema#> .
@prefix foaf: <http://xmlns.com/foaf/0.1/> .
@prefix halalv: <http://halal.addi.is.its.ac.id/halalv.ttl#> .
@prefix halalf: <http://halal.addi.is.its.ac.id/resources/foodproducts/> .
@prefix halali: <http://halal.addi.is.its.ac.id/resources/ingredients/> .
@prefix halals: <http://halal.addi.is.its.ac.id/resources/halalsources/> .
@prefix halalc: <http://halal.addi.is.its.ac.id/resources/certificates/> .
@prefix halalm: <http://halal.addi.is.its.ac.id/resources/manufactures/> .
@prefix food: <http://purl.org/foodontology#> .
@prefix foodlirmm: <http://data.lirmm.fr/ontologies/food#> .
@prefix gr: <http://purl.org/goodrelations/v1#>. \n";
        
        $ingWritted = 0;
        //$foodProducts = FoodProduct::where('fVerify',1)->get()->toArray();		
        $foodProducts = FoodProduct::where('fVerify',1)->get()->toArray();		

        fwrite($productfile, $prefix);
        
        //Menuliskan Resource foodproducts.ttl
        foreach ($foodProducts as $fp => $val) {
            $list[$fp]="\nhalalf:".$foodProducts[$fp]['id']." a halalv:FoodProduct.";
            fwrite($productfile, $list[$fp]);
        }

        foreach ($foodProducts as $fp => $val) {
            //=========================== FOOD PRODUCT ==================================
            //Menuliskan ke turtle			
			$clean_label = preg_replace('/\W+/', ' ', $foodProducts[$fp]['fName']);
			$clean_fName = preg_replace('/\W+/', '_', $foodProducts[$fp]['fName']);
			$clean_fManufacture = preg_replace('/\W+/', '_', $foodProducts[$fp]['fManufacture']);
			
            $list[$fp]="halalf:".$clean_fName." a foodlirmm:FoodProduct;
\ta food:Food;			
\tfoodlirmm:code \"".$foodProducts[$fp]['fCode']."\";
\trdfs:label \"".$clean_label."\";
\tgr:hasManufacturer halalm:".$clean_fManufacture.";
\thalalv:netWeight ".$foodProducts[$fp]['weight'].";
\thalalv:calories ".$foodProducts[$fp]['calories'].";
\tfoodlirmm:fatPer100g ".$foodProducts[$fp]['totalFat'].";
\tfoodlirmm:saturatedFatPer100g ".$foodProducts[$fp]['saturatedFat'].";
\tfoodlirmm:sodiumPer100g ".$foodProducts[$fp]['sodium'].";
\tfoodlirmm:fiberPer100g ".$foodProducts[$fp]['dietaryFiber'].";
\tfoodlirmm:sugarsPer100g ".$foodProducts[$fp]['sugar'].";
\tfoodlirmm:proteinsPer100g ".$foodProducts[$fp]['protein'].";
\thalalv:vitaminA ".$foodProducts[$fp]['vitaminA'].";
\thalalv:vitaminC ".$foodProducts[$fp]['vitaminC'].";
\thalalv:calcium ".$foodProducts[$fp]['calcium'].";
\thalalv:iron ".$foodProducts[$fp]['iron'].";
\thalalv:foodproductId ".$foodProducts[$fp]['id'].".\n";

            //Menuliskan file resource foodproducts
            $fileFoodProduct = "resources/foodproducts/".$clean_fName.".ttl";
            if(!file_exists($fileFoodProduct)) {
            	$resFoodProduct = fopen($fileFoodProduct, "w");
	            fwrite($resFoodProduct, $prefix."\n");
	            fwrite($resFoodProduct, $list[$fp]);
	
				//START REVISI SM BU IIN OLEH NAJIB LINE BAWAH INI DICOMMENT KARENA SUDAH TERGANTIKAN OLEH GR:HASMANUFATURE
	            //$hasManufacture = "\nhalalf:".$clean_fName." halalv:manufacture halalm:".$foodProducts[$fp]['id'].".";
	            
	            //Menuliskan hubungan foodproduct dengan manufacture di file resource foodproducts
	            //fwrite($resFoodProduct, $hasManufacture."\n");
	            
	            //END REVISI SM BU IIN OLEH NAJIB LINE BAWAH INI DICOMMENT KARENA SUDAH TERGANTIKAN OLEH GR:HASMANUFATURE
	
	            $getCertFK = DB::select('select * from foodproduct_certificate where foodproduct_id = ?', [$foodProducts[$fp]['id']]);
				if(count($getCertFK)) {
					$hasCertificate = "\nhalalf:".$clean_fName." foodlirmm:certificate ";
					foreach ($getCertFK as $id => $val) {
						$hasCertificate = $hasCertificate."halalc:".$getCertFK[$id]->certificate_id.", ";
					}
					
					 //Menuliskan hubungan foodproduct dengan certificate di file resource foodproducts
		            if(substr($hasCertificate, -2,1) !== "e"){
		                fwrite($resFoodProduct, rtrim($hasCertificate,", \"").".\n");    
		            }
		
				}
	            
	
	           
	            $getIngFK = DB::select('select * from foodproduct_ingredient inner join ingredients on ingredients.id = foodproduct_ingredient.ingredient_id where foodproduct_id = ?', [$foodProducts[$fp]['id']]);							
	
	            //Menuliskan kandungan komposisi
				if(count($getIngFK)) {
					$containsIng = "\nhalalf:".$clean_fName." food:containsIngredient ";
					foreach ($getIngFK as $id => $val) {
						
						$iName = $getIngFK[$id]->iName;
						$iName = preg_replace('/\W+/', '_', $iName);
						
						$containsIng = $containsIng."halali:".$iName.", ";
					}
					
					//Menuliskan file resource certificates
	            	fwrite($resFoodProduct, rtrim($containsIng,", \"").".\n");
				}
	            
	            
	            
	
	            //=========================== MANUFACTURE ==================================
	            //Get manufacture
	            $getManufacture = DB::select('select fManufacture from foodproducts where id = ?', [$foodProducts[$fp]['id']]);
				
				if(count($getManufacture)) {
					$insertManufacture = "halalm:".$clean_fManufacture." a foaf:Organization;
	\trdfs:label \"".$getManufacture[0]->fManufacture."\".\n";   
	            
					//Menuliskan file resource manufacture
					$fileManufacture = "resources/manufactures/".$clean_fManufacture.".ttl";
					$resManufacture = fopen($fileManufacture, "w");
					fwrite($resManufacture, $prefix."\n");
					fwrite($resManufacture, $insertManufacture);
					fclose($resManufacture);
				}
	            
	
	            //=========================== CERTIFICATE ==================================    
	            //Get certificate
				if(count($getCertFK)) {
					foreach ($getCertFK as $id => $val) {
						$certificate[$id] = Certificate::findOrFail($getCertFK[$id]->certificate_id);
						if($certificate[$id]->cStatus == 0){
							$cStatus = "Development";
						}
						elseif ($certificate[$id]->cStatus == 1) {
							$cStatus = "New";   
						}
						else{
							$cStatus = "Renew";
						}
						
						$clean_org = preg_replace('/\W+/', '_', $certificate[$id]->cOrganization);						
						
						$insertCertificate = "\nhalalc:".$certificate[$id]->id." a halalv:HalalCertificate;
		\thalalv:halalCode \"".$certificate[$id]->cCode."\";
		\thalalv:halalExp \"".$certificate[$id]->cExpire->format('Y-m-d')."\"^^xsd:date;
		\thalalv:halalStatus \"".$cStatus."\";
		\thalalv:OrgCert halals:".$clean_org.".";
		
						//Menuliskan file resource certificates
						$fileCertificate = "resources/certificates/".$certificate[$id]->id.".ttl";
						$resCertificate = fopen($fileCertificate, "w");
						fwrite($resCertificate, $prefix."\n");
						fwrite($resCertificate, $insertCertificate);
						fclose($resCertificate);
					}
				}
	            
	
	            //=========================== INGREDIENT ==================================
	 //           //Get Ingredient
		// 		if(count($getIngFK)) {
		// 			foreach ($getIngFK as $id => $val) {
		// 				$ingredient[$id] = Ingredient::findOrFail($getIngFK[$id]->ingredient_id);
						
		// 				$halalName = $ingredient[$id]['iName'];
		// 				$halalName = preg_replace('/\W+/', '_', $halalName);
		// 				//$halalName = str_replace('"',"",$halalName);
		// 				//$halalName = str_replace(' ',"_",$halalName);
						
		// 				$halalIng = "\nhalali:".$halalName." halalv:halal ";
		// 				$halalId = $ingredient[$id]['id'];											
												
						
		// 				if($ingredient[$id]->iType == 0){
		// 					$insertIngredient = "\nhalali:".$halalName." a foodlirmm:Ingredient;
		// \tfoodlirmm:rank ".$ingredient[$id]->id.";
		// \trdfs:label \"".$ingredient[$id]->iName."\".";
		// 				}
		// 				else{
		// 					$insertIngredient = "\nhalali:".$halalName." a food:FoodAdditive,foodlirmm:Ingredient;
		// \tfoodlirmm:rank ".$ingredient[$id]->id.";
		// \trdfs:label \"".$ingredient[$id]->iName."\";
		// \trdfs:comment \"".$ingredient[$id]->eNumber."\";\n";
							
		// 					//$DBpedia = @file_get_contents("http://dbpedia.org/sparql?default-graph-uri=http%3A%2F%2Fdbpedia.org&query=select+distinct+%3Fresource+where+%0D%0A%7B+%3Fresource+rdfs%3Alabel+%22".str_replace(" ","+",$ingredient[$id]->iName)."%22%40en+%7D&format=application%2Fsparql-results%2Bjson&CXML_redir_for_subjs=121&CXML_redir_for_hrefs=&timeout=30000&debug=on");
		// 					$DBpedia = @file_get_contents("https://dbpedia.org/sparql?default-graph-uri=http%3A%2F%2Fdbpedia.org&query=ask+%7B+%3Chttp%3A%2F%2Fdbpedia.org%2Fresource%2F".str_replace(" ","_",$ingredient[$id]->iName)."%3E+%3Fp+%3Fo+%7D&format=text%2Fhtml&CXML_redir_for_subjs=121&CXML_redir_for_hrefs=&timeout=30000&debug=on&run=+Run+Query+");
		// 					//if($DBpedia) {
		// 					if($DBpedia == "true") {
		// 						$insertIngredient = $insertIngredient."\towl:sameAs <http://dbpedia.org/resource/".str_replace(' ', '_', $ingredient[$id]->iName).">.";
		// 					}
		// 					else{
		// 						$insertIngredient = rtrim($insertIngredient,";\n").".";
		// 					}
		
		// 					//=========================== HALAL SOURCE ==================================
		// 					//Get Halal Source
		// 					$getHalalFK = DB::select('select * from ingredient_halal where ingredient_id = ?', [$ingredient[$id]->id]);
		// 					if(count($getHalalFK)) {
		// 						foreach ($getHalalFK as $id => $val) {
		// 							$halal[$id] = HalalSource::findOrFail($getHalalFK[$id]->halal_id);
		// 							if($halal[$id]->hStatus == 0){
		// 								$hStatus = "Halal";
		// 							}
		// 							elseif ($halal[$id]->hStatus == 1) {
		// 								$hStatus = "Mushbooh";   
		// 							}
		// 							else{
		// 								$hStatus = "Haraam";
		// 							}
		// 							$insertHalal = "\nhalals:".$halal[$id]->id." a halalv:Source;
		// 	\trdfs:label \"".$hStatus."\";
		// 	\trdfs:comment \"".$halal[$id]->hDescription."\";
		// 	\tfoaf:organization \"".$halal[$id]->hOrganization."\";
		// 	\trdfs:seeAlso <".$halal[$id]->hUrl.">.";
									
		// 							//Menuliskan file resource halalsource
		// 							$fileHalalSource = "resources/halalsources/".$halal[$id]->id.".ttl";
		// 							$resHalalSource = fopen($fileHalalSource, "w");
		// 							fwrite($resHalalSource, $prefix);
		// 							fwrite($resHalalSource, $insertHalal);
		// 							fclose($resHalalSource);
									
		// 							$halalIng = $halalIng."halals:".$getHalalFK[$id]->halal_id.", ";
		// 						}
		// 						$halalSource[$halalId] = rtrim($halalIng,", \"").".";
		// 					}
							
		// 				}
		// 				if($ingWritted != $ingredient[$id]->id){
		// 					//Menuliskan file resource ingredients
		// 					$fileIngredient = "resources/ingredients/".$halalName.".ttl";
		// 					$resIngredient = fopen($fileIngredient, "w");
		// 					fwrite($resIngredient, $prefix);
		// 					fwrite($resIngredient, $insertIngredient);
		// 					if (isset($halalSource[$halalId])) {
		// 						fwrite($resIngredient, $halalSource[$halalId]);
		// 					}
		// 					fclose($resIngredient);
		// 				}
		// 				$ingWritted = $ingredient[$id]->id;
		// 			}
		// 		}

	            
	            //lanjut ke food product selanjutnya
	            fclose($resFoodProduct);
            }
            
        }
        
        echo "berhasil";
		set_time_limit($default);
    }
    
    public function generateTtl4()
    {
		
		$default = ini_get('max_execution_time');
		set_time_limit(3000);

        //Resource Produk
        $productfile = fopen("resources.ttl", "w");

        $prefix = "@prefix rdf: <http://www.w3.org/1999/02/22-rdf-syntax-ns#> .
@prefix rdfs: <http://www.w3.org/2000/01/rdf-schema#> .
@prefix owl: <http://www.w3.org/2002/07/owl#> .
@prefix xsd: <http://www.w3.org/2001/XMLSchema#> .
@prefix foaf: <http://xmlns.com/foaf/0.1/> .
@prefix halalv: <http://halal.addi.is.its.ac.id/halalv.ttl#> .
@prefix halalf: <http://halal.addi.is.its.ac.id/resources/foodproducts/> .
@prefix halali: <http://halal.addi.is.its.ac.id/resources/ingredients/> .
@prefix halalc: <http://halal.addi.is.its.ac.id/resources/certificates/> .
@prefix halals: <http://halal.addi.is.its.ac.id/resources/halalsources/> .
@prefix halalm: <http://halal.addi.is.its.ac.id/resources/manufactures/> .
@prefix food: <http://purl.org/foodontology#> .
@prefix foodlirmm: <http://data.lirmm.fr/ontologies/food#> .
@prefix gr: <http://purl.org/goodrelations/v1#>. \n";
        
        $ingWritted = 0;
        
        //================================  04/26/2018  =======================================
        
        /* mengganti query FoodProduct dengan menjoin ke tabel foodproduct_manufacture untuk mengambil id manufaktur*/
        
        $foodProducts = FoodProduct::where('fVerify',1)->get()->toArray();
        /*$makanan = DB::select(
        	'select foodproducts.*, foodproduct_manufacture.manufacture_id 
        	from foodproducts 
        	inner join foodproduct_manufacture 
        	on foodproducts.id = foodproduct_manufacture.foodproduct_id 
        	where fVerify = 1'
        );*/
        
        // Hasil query raw berupa object, belum array, fungsi dibawah diambil dari https://stackoverflow.com/a/37518354
        // BELUM DICOBA !!!
        //$foodProducts = json_decode(json_encode($makanan), true);
        //================================  **********  =======================================

        fwrite($productfile, $prefix);
        
        //Menuliskan Resource foodproducts.ttl
        $i = 0;
        foreach ($foodProducts as $fp => $val) {
        	$clean_fName = preg_replace('/\W+/', '_', $foodProducts[$fp]['fName']);
            //$list[$fp]="\nhalalf:".$foodProducts[$fp]['id']." a halalv:FoodProduct.";
            $list[$fp]="\nhalalf:".$clean_fName." a halalv:FoodProduct.";
            fwrite($productfile, $list[$fp]);
            
            $i++;
            if($i == 10) {
            	break;
            	echo "10 ttl berhasil";
            }
        }

        foreach ($foodProducts as $fp => $val) {
            //=========================== FOOD PRODUCT ==================================
            //Menuliskan ke turtle			
			$clean_label = preg_replace('/\W+/', ' ', $foodProducts[$fp]['fName']);
			$clean_fName = preg_replace('/\W+/', '_', $foodProducts[$fp]['fName']);
			$clean_fManufacture = preg_replace('/\W+/', '_', $foodProducts[$fp]['fManufacture']);
			//$manufacture_id = $foodProducts[$fp]['manufacture_id'];
			
			
            $list[$fp]="halalf:".$clean_fName." a halalv:FoodProduct;
\tfoodlirmm:code \"".$foodProducts[$fp]['fCode']."\";
\trdfs:label \"".$clean_label."\";
\tgr:hasManufacturer halalm:".$clean_fManufacture /*                                   ================================  04/26/2018  =======================================  //diganti dengan manufacture_id (tidak jadi, ganti nama manufaktur lagi :/ $manufacture_id/*.";
\thalalv:netWeight ".$foodProducts[$fp]['weight'].";                =======================***** tidak ada di paper *****================================          
\thalalv:calories ".$foodProducts[$fp]['calories']*/.";
\thalalv:energyPer100g ".$foodProducts[$fp]['calories'].";
\tfoodlirmm:fatPer100g ".$foodProducts[$fp]['totalFat'].";
\tfoodlirmm:saturatedFatPer100g ".$foodProducts[$fp]['saturatedFat'].";
\tfoodlirmm:sodiumPer100g ".$foodProducts[$fp]['sodium'].";
\thalalv:carbohydratesPer100g ".$foodProducts[$fp]['calories'].";
\tfoodlirmm:fiberPer100g ".$foodProducts[$fp]['dietaryFiber'].";
\tfoodlirmm:sugarsPer100g ".$foodProducts[$fp]['sugar'].";
\tfoodlirmm:proteinsPer100g ".$foodProducts[$fp]['protein'].";"/*    ================================  04/26/2018  =======================================
\thalalv:vitaminA ".$foodProducts[$fp]['vitaminA'].";
\thalalv:vitaminC ".$foodProducts[$fp]['vitaminC'].";               tidak ada di paper
\thalalv:calcium ".$foodProducts[$fp]['calcium'].";
\thalalv:iron ".$foodProducts[$fp]['iron'].";                       ================================  **********  =======================================
*/
."\thalalv:foodproductId ".$foodProducts[$fp]['id'].".\n";

            //Menuliskan file resource foodproducts
            $fileFoodProduct = "resources/foodproducts/".$clean_fName.".ttl";
            if(!file_exists($fileFoodProduct)) {
            	$resFoodProduct = fopen($fileFoodProduct, "w");
	            fwrite($resFoodProduct, $prefix."\n");
	            fwrite($resFoodProduct, $list[$fp]);
	
				//START REVISI SM BU IIN OLEH NAJIB LINE BAWAH INI DICOMMENT KARENA SUDAH TERGANTIKAN OLEH GR:HASMANUFATURE
	            //$hasManufacture = "\nhalalf:".$clean_fName." halalv:manufacture halalm:".$foodProducts[$fp]['id'].".";
	            
	            //Menuliskan hubungan foodproduct dengan manufacture di file resource foodproducts
	            //fwrite($resFoodProduct, $hasManufacture."\n");
	            
	            //END REVISI SM BU IIN OLEH NAJIB LINE BAWAH INI DICOMMENT KARENA SUDAH TERGANTIKAN OLEH GR:HASMANUFATURE
	
	            $getCertFK = DB::select('select * from foodproduct_certificate where foodproduct_id = ?', [$foodProducts[$fp]['id']]);
				if(count($getCertFK)) {
					$hasCertificate = "\nhalalf:".$clean_fName." halalv:certificate ";
					foreach ($getCertFK as $id => $val) {
						$hasCertificate = $hasCertificate."halalc:".$getCertFK[$id]->certificate_id.", ";
					}
					
					 //Menuliskan hubungan foodproduct dengan certificate di file resource foodproducts
		            if(substr($hasCertificate, -2,1) !== "e"){
		                fwrite($resFoodProduct, rtrim($hasCertificate,", \"").".\n");    
		            }
		
				}
	            
	
	           
	            $getIngFK = DB::select('select * from foodproduct_ingredient inner join ingredients on ingredients.id = foodproduct_ingredient.ingredient_id where foodproduct_id = ?', [$foodProducts[$fp]['id']]);							
	
	            //Menuliskan kandungan komposisi
				if(count($getIngFK)) {
					$containsIng = "\nhalalf:".$clean_fName." food:containsIngredient ";
					foreach ($getIngFK as $id => $val) {
						
						$iName = $getIngFK[$id]->iName;
						$iName = preg_replace('/\W+/', '_', $iName);
						
						//================================  04/26/2018  =======================================
						// containsIngredient menggunakan Id makanan
						$ingredient_id = $getIngFK[$id]->ingredient_id;
						
						//$containsIng = $containsIng."halali:".$iName.", ";
						$containsIng = $containsIng."halali:".$ingredient_id.", ";
						//================================  **********  =======================================
						
					}
					
					//Menuliskan file resource certificates
	            	fwrite($resFoodProduct, rtrim($containsIng,", \"").".\n");
	
				}
	            
	            //================================  04/26/2018  =======================================
	            // tambahan ingredientsListAsText
	            if(count($getIngFK)) {
					$ingredientsListAsText = "\nhalalf:".$clean_fName." food:ingredientsListAsText ";
					foreach ($getIngFK as $id => $val) {
						
						$iName = $getIngFK[$id]->iName;
						$ingredientsListAsText = $ingredientsListAsText."\"".$iName."\", ";
						
					}
					
					
					
					//Menuliskan ingredientsListAsText
	            	fwrite($resFoodProduct, rtrim($ingredientsListAsText,", \"")."\" .\n");
	
				}
	            //================================  **********  =======================================
	            
	            //=========================== MANUFACTURE ==================================
	            //Get manufacture
	            $getManufacture = DB::select('select fManufacture from foodproducts where id = ?', [$foodProducts[$fp]['id']]);
				
				if(count($getManufacture)) {
					$insertManufacture = "halalm:".$clean_fManufacture." a foaf:Organization;
	\trdfs:label \"".$getManufacture[0]->fManufacture."\".\n";   
	            
					//Menuliskan file resource manufacture
					$fileManufacture = "resources/manufactures/".$clean_fManufacture.".ttl";
					$resManufacture = fopen($fileManufacture, "w");
					fwrite($resManufacture, $prefix."\n");
					fwrite($resManufacture, $insertManufacture);
					fclose($resManufacture);
				}
	            
	
	            //=========================== CERTIFICATE ==================================    
	            //Get certificate
				if(count($getCertFK)) {
					foreach ($getCertFK as $id => $val) {
						$certificate[$id] = Certificate::findOrFail($getCertFK[$id]->certificate_id);
						if($certificate[$id]->cStatus == 0){
							$cStatus = "Development";
						}
						elseif ($certificate[$id]->cStatus == 1) {
							$cStatus = "New";   
						}
						else{
							$cStatus = "Renew";
						}
						
						$clean_org = preg_replace('/\W+/', '_', $certificate[$id]->cOrganization);						
						
						$insertCertificate = "\nhalalc:".$certificate[$id]->id." a halalv:HalalCertificate;
		\thalalv:halalCode \"".$certificate[$id]->cCode."\";
		\thalalv:halalExp \"".$certificate[$id]->cExpire->format('Y-m-d')."\"^^xsd:date;
		\thalalv:halalStatus halalv:Halal;
		\thalalv:OrgCert halals:".$clean_org.".";
		
						//Menuliskan file resource certificates
						$fileCertificate = "resources/certificates/".$certificate[$id]->id.".ttl";
						$resCertificate = fopen($fileCertificate, "w");
						fwrite($resCertificate, $prefix."\n");
						fwrite($resCertificate, $insertCertificate);
						fclose($resCertificate);
					}
				}
	            
	
	            //=========================== INGREDIENT ==================================
	            //Get Ingredient
				if(count($getIngFK)) {
					foreach ($getIngFK as $id => $val) {
						$ingredient[$id] = Ingredient::findOrFail($getIngFK[$id]->ingredient_id);
						
						$halalName = $ingredient[$id]['iName'];
						$halalName = preg_replace('/\W+/', '_', $halalName);
						//$halalName = str_replace('"',"",$halalName);
						//$halalName = str_replace(' ',"_",$halalName);
						
						$halalIng = "\nhalali:".$halalName." halalv:halal ";
						$halalId = $ingredient[$id]['id'];											
												
						
						if($ingredient[$id]->iType == 0){
							$insertIngredient = "\nhalali:".$halalName." a foodlirmm:Ingredient;
		\tfoodlirmm:rank ".$ingredient[$id]->id.";
		\trdfs:label \"".$ingredient[$id]->iName."\".";
						}
						else{
							$insertIngredient = "\nhalali:".$halalName." a food:FoodAdditive;
		\tfoodlirmm:rank ".$ingredient[$id]->id.";
		\trdfs:label \"".$ingredient[$id]->iName."\";
		\trdfs:comment \"".$ingredient[$id]->eNumber."\";\n";
							
							//$DBpedia = @file_get_contents("http://dbpedia.org/sparql?default-graph-uri=http%3A%2F%2Fdbpedia.org&query=select+distinct+%3Fresource+where+%0D%0A%7B+%3Fresource+rdfs%3Alabel+%22".str_replace(" ","+",$ingredient[$id]->iName)."%22%40en+%7D&format=application%2Fsparql-results%2Bjson&CXML_redir_for_subjs=121&CXML_redir_for_hrefs=&timeout=30000&debug=on");
							$DBpedia = @file_get_contents("https://dbpedia.org/sparql?default-graph-uri=http%3A%2F%2Fdbpedia.org&query=ask+%7B+%3Chttp%3A%2F%2Fdbpedia.org%2Fresource%2F".str_replace(" ","_",$ingredient[$id]->iName)."%3E+%3Fp+%3Fo+%7D&format=text%2Fhtml&CXML_redir_for_subjs=121&CXML_redir_for_hrefs=&timeout=30000&debug=on&run=+Run+Query+");
							//if($DBpedia) {
							if($DBpedia == "true") {
								$insertIngredient = $insertIngredient."\towl:sameAs <http://dbpedia.org/resource/".str_replace(' ', '_', $ingredient[$id]->iName).">.";
							}
							else{
								$insertIngredient = rtrim($insertIngredient,";\n").".";
							}
		
							//=========================== HALAL SOURCE ==================================
							//Get Halal Source
							$getHalalFK = DB::select('select * from ingredient_halal where ingredient_id = ?', [$ingredient[$id]->id]);
							if(count($getHalalFK)) {
								foreach ($getHalalFK as $id => $val) {
									$halal[$id] = HalalSource::findOrFail($getHalalFK[$id]->halal_id);
									if($halal[$id]->hStatus == 0){
										$hStatus = "Halal";
									}
									elseif ($halal[$id]->hStatus == 1) {
										$hStatus = "Mushbooh";   
									}
									else{
										$hStatus = "Haram";
									}
									$cleanOrgEcode = preg_replace('/\W+/', '_', $halal[$id]->hOrganization);
									$insertHalal = "\nhalals:".$halal[$id]->id." a halalv:Source;
			\thalalv:Estatus halalv:".$hStatus.";
			\trdfs:comment \"".$halal[$id]->hDescription."\";
			\thalalv:OrgSource halals:".$cleanOrgEcode." .";
									
									//Menuliskan file resource halalsource
									$fileHalalSource = "resources/halalsources/".$halal[$id]->id.".ttl";
									$resHalalSource = fopen($fileHalalSource, "w");
									fwrite($resHalalSource, $prefix);
									fwrite($resHalalSource, $insertHalal);
									fclose($resHalalSource);
									
									$halalIng = $halalIng."halals:".$getHalalFK[$id]->halal_id.", ";
								}
								$halalSource[$halalId] = rtrim($halalIng,", \"").".";
							}
							
						}
						if($ingWritted != $ingredient[$id]->id){
							//Menuliskan file resource ingredients
							$fileIngredient = "resources/ingredients/".$halalName.".ttl";
							$resIngredient = fopen($fileIngredient, "w");
							fwrite($resIngredient, $prefix);
							fwrite($resIngredient, $insertIngredient);
							if (isset($halalSource[$halalId])) {
								fwrite($resIngredient, $halalSource[$halalId]);
							}
							fclose($resIngredient);
						}
						$ingWritted = $ingredient[$id]->id;
					}
				}

	            
	            //lanjut ke food product selanjutnya
	            fclose($resFoodProduct);
	            unset($insertIngredient, $insertCertificate, $containsIng, $insertManufacture);
            }
            
        }
        echo "berhasil";
		set_time_limit($default);
    }
    
    //buat berli yg bener
    public function generateTtl5()
    {
		
		$default = ini_get('max_execution_time');
		set_time_limit(3000);
		//ini_set('memory_limit', '2048M');

        //Resource Produk
        $productfile = fopen("resources.ttl", "w");

        $prefix = "@prefix rdf: <http://www.w3.org/1999/02/22-rdf-syntax-ns#> .
@prefix rdfs: <http://www.w3.org/2000/01/rdf-schema#> .
@prefix owl: <http://www.w3.org/2002/07/owl#> .
@prefix xsd: <http://www.w3.org/2001/XMLSchema#> .
@prefix foaf: <http://xmlns.com/foaf/0.1/> .
@prefix halalv: <http://halal.addi.is.its.ac.id/halalv.ttl#> .
@prefix halalf: <http://halal.addi.is.its.ac.id/resources/foodproducts/> .
@prefix halali: <http://halal.addi.is.its.ac.id/resources/ingredients/> .
@prefix halals: <http://halal.addi.is.its.ac.id/resources/halalsources/> .
@prefix halalc: <http://halal.addi.is.its.ac.id/resources/certificates/> .
@prefix halalm: <http://halal.addi.is.its.ac.id/resources/manufactures/> .
@prefix food: <http://purl.org/foodontology#> .
@prefix foodlirmm: <http://data.lirmm.fr/ontologies/food#> .
@prefix gr: <http://purl.org/goodrelations/v1#>. \n";
        
        $ingWritted = 0;
        
        //================================  04/26/2018  =======================================
        
        /* mengganti query FoodProduct dengan menjoin ke tabel foodproduct_manufacture untuk mengambil id manufaktur*/
        
        //$foodProducts = FoodProduct::where('fVerify',1)->get()->toArray();
        $foodProducts = FoodProduct::whereBetween('id',[60001,61000])->where('fVerify', 1)->get()->toArray();
        /*$makanan = DB::select(
        	'select foodproducts.*, foodproduct_manufacture.manufacture_id 
        	from foodproducts 
        	inner join foodproduct_manufacture 
        	on foodproducts.id = foodproduct_manufacture.foodproduct_id 
        	where fVerify = 1'
        );*/
        
        // Hasil query raw berupa object, belum array, fungsi dibawah diambil dari https://stackoverflow.com/a/37518354
        // BELUM DICOBA !!!
        //$foodProducts = json_decode(json_encode($makanan), true);
        //================================  **********  =======================================

        fwrite($productfile, $prefix);
        
        //Menuliskan Resource foodproducts.ttl
        $i = 0;
        foreach ($foodProducts as $fp => $val) {
        	$clean_fName = preg_replace('/\W+/', '_', $foodProducts[$fp]['fName']);
            //$list[$fp]="\nhalalf:".$foodProducts[$fp]['id']." a halalv:FoodProduct.";
            $list[$fp]="\nhalalf:".$clean_fName." a halalv:FoodProduct.";
            fwrite($productfile, $list[$fp]);
            
            $i++;
            if($i == 10) {
            	break;
            	echo "10 ttl berhasil";
            }
        }

        foreach ($foodProducts as $fp => $val) {
            //=========================== FOOD PRODUCT ==================================
            //Menuliskan ke turtle			
			$clean_label = preg_replace('/\W+/', ' ', $foodProducts[$fp]['fName']);
			$clean_fName = preg_replace('/\W+/', '_', $foodProducts[$fp]['fName']);
			$clean_fManufacture = preg_replace('/\W+/', '_', $foodProducts[$fp]['fManufacture']);
			//$manufacture_id = $foodProducts[$fp]['manufacture_id'];
			
			
            $list[$fp]="halalf:".$clean_fName." a foodlirmm:FoodProduct;
\ta food:Food;
\tfoodlirmm:code \"".$foodProducts[$fp]['fCode']."\";
\trdfs:label \"".$clean_label."\";
\tgr:hasManufacturer halalm:". /*                                   ================================  04/26/2018  ======================================= $clean_fManufacture  //diganti dengan manufacture_id  */ $clean_fManufacture/*.";
\thalalv:netWeight ".$foodProducts[$fp]['weight'].";                =======================***** tidak ada di paper *****================================          
\thalalv:calories ".$foodProducts[$fp]['calories']*/.";
\tfoodlirmm:fatPer100g ".$foodProducts[$fp]['totalFat'].";
\tfoodlirmm:saturatedFatPer100g ".$foodProducts[$fp]['saturatedFat'].";
\tfoodlirmm:sodiumPer100g ".$foodProducts[$fp]['sodium'].";
\tfoodlirmm:fiberPer100g ".$foodProducts[$fp]['dietaryFiber'].";
\tfoodlirmm:sugarsPer100g ".$foodProducts[$fp]['sugar'].";
\tfoodlirmm:proteinsPer100g ".$foodProducts[$fp]['protein'].";" /*    ================================  04/26/2018  =======================================
\thalalv:vitaminA ".$foodProducts[$fp]['vitaminA'].";
\thalalv:vitaminC ".$foodProducts[$fp]['vitaminC'].";               tidak ada di paper
\thalalv:calcium ".$foodProducts[$fp]['calcium'].";
\thalalv:iron ".$foodProducts[$fp]['iron'].";                       ================================  **********  =======================================*/
."\thalalv:foodproductId ".$foodProducts[$fp]['id'].".\n";

            //Menuliskan file resource foodproducts
            $fileFoodProduct = "resources/foodproducts/".$clean_fName.".ttl";
            if(!file_exists($fileFoodProduct)) {
            	$resFoodProduct = fopen($fileFoodProduct, "w");
	            fwrite($resFoodProduct, $prefix."\n");
	            fwrite($resFoodProduct, $list[$fp]);
	
				//START REVISI SM BU IIN OLEH NAJIB LINE BAWAH INI DICOMMENT KARENA SUDAH TERGANTIKAN OLEH GR:HASMANUFATURE
	            //$hasManufacture = "\nhalalf:".$clean_fName." halalv:manufacture halalm:".$foodProducts[$fp]['id'].".";
	            
	            //Menuliskan hubungan foodproduct dengan manufacture di file resource foodproducts
	            //fwrite($resFoodProduct, $hasManufacture."\n");
	            
	            //END REVISI SM BU IIN OLEH NAJIB LINE BAWAH INI DICOMMENT KARENA SUDAH TERGANTIKAN OLEH GR:HASMANUFATURE
	
	            $getCertFK = DB::select('select * from foodproduct_certificate where foodproduct_id = ?', [$foodProducts[$fp]['id']]);
				if(count($getCertFK)) {
					$hasCertificate = "\nhalalf:".$clean_fName." foodlirmm:certificate ";
					foreach ($getCertFK as $id => $val) {
						$hasCertificate = $hasCertificate."halalc:".$getCertFK[$id]->certificate_id.", ";
					}
					
					 //Menuliskan hubungan foodproduct dengan certificate di file resource foodproducts
		            if(substr($hasCertificate, -2,1) !== "e"){
		                fwrite($resFoodProduct, rtrim($hasCertificate,", \"").".\n");    
		            }
		
				}
	            
	
	           
	            $getIngFK = DB::select('select * from foodproduct_ingredient inner join ingredients on ingredients.id = foodproduct_ingredient.ingredient_id where foodproduct_id = ?', [$foodProducts[$fp]['id']]);							
	
	            //Menuliskan kandungan komposisi
				if(count($getIngFK)) {
					$containsIng = "\nhalalf:".$clean_fName." food:containsIngredient ";
					foreach ($getIngFK as $id => $val) {
						
						$iName = $getIngFK[$id]->iName;
						$iName = preg_replace('/\W+/', '_', $iName);
						
						//================================  04/26/2018  =======================================
						// containsIngredient menggunakan Id makanan
						$ingredient_id = $getIngFK[$id]->ingredient_id;
						
						//$containsIng = $containsIng."halali:".$iName.", ";
						$containsIng = $containsIng."halali:".$iName.", ";
						//================================  **********  =======================================
						
					}
					
					//Menuliskan file resource certificates
	            	fwrite($resFoodProduct, rtrim($containsIng,", \"").".\n");
	
				}
	            
	            //================================  04/26/2018  =======================================
	            // tambahan ingredientsListAsText
	            if(count($getIngFK)) {
					$ingredientsListAsText = "\nhalalf:".$clean_fName." food:ingredientsListAsText ";
					foreach ($getIngFK as $id => $val) {
						
						$iName = $getIngFK[$id]->iName;
						$ingredientsListAsText = $ingredientsListAsText."\"".$iName."\", ";
						
					}
					
					//Menuliskan ingredientsListAsText
	            	fwrite($resFoodProduct, rtrim($ingredientsListAsText,", \"")."\" .\n");
	
				}
	            //================================  **********  =======================================
	            
	            //=========================== MANUFACTURE ==================================
	            //Get manufacture
	            $getManufacture = DB::select('select fManufacture from foodproducts where id = ?', [$foodProducts[$fp]['id']]);
				
				if(count($getManufacture)) {
					$insertManufacture = "halalm:".$clean_fManufacture." a foaf:Organization;
	\trdfs:label \"".$getManufacture[0]->fManufacture."\".\n";   
	            
					//Menuliskan file resource manufacture
					$fileManufacture = "resources/manufactures/".$clean_fManufacture.".ttl";
					$resManufacture = fopen($fileManufacture, "w");
					fwrite($resManufacture, $prefix."\n");
					fwrite($resManufacture, $insertManufacture);
					fclose($resManufacture);
				}
	            
	
	            //=========================== CERTIFICATE ==================================    
	            //Get certificate
				if(count($getCertFK)) {
					foreach ($getCertFK as $id => $val) {
						$certificate[$id] = Certificate::findOrFail($getCertFK[$id]->certificate_id);
						if($certificate[$id]->cStatus == 0){
							$cStatus = "Development";
						}
						elseif ($certificate[$id]->cStatus == 1) {
							$cStatus = "New";   
						}
						else{
							$cStatus = "Renew";
						}
						
						$clean_org = preg_replace('/\W+/', '_', $certificate[$id]->cOrganization);						
						
						$insertCertificate = "\nhalalc:".$certificate[$id]->id." a halalv:HalalCertificate;
		\thalalv:halalCode \"".$certificate[$id]->cCode."\";
		\thalalv:halalExp \"".$certificate[$id]->cExpire->format('Y-m-d')."\"^^xsd:date;
		\thalalv:halalStatus \"".$cStatus."\";
		\thalalv:OrgCert halals:".$clean_org.".";
		
						//Menuliskan file resource certificates
						$fileCertificate = "resources/certificates/".$certificate[$id]->id.".ttl";
						$resCertificate = fopen($fileCertificate, "w");
						fwrite($resCertificate, $prefix."\n");
						fwrite($resCertificate, $insertCertificate);
						fclose($resCertificate);
					}
				}
	            
	
	            //=========================== INGREDIENT ==================================
	            //Get Ingredient
				if(count($getIngFK)) {
					foreach ($getIngFK as $id => $val) {
						$ingredient[$id] = Ingredient::findOrFail($getIngFK[$id]->ingredient_id);
						
						$halalName = $ingredient[$id]['iName'];
						$halalName = preg_replace('/\W+/', '_', $halalName);
						//$halalName = str_replace('"',"",$halalName);
						//$halalName = str_replace(' ',"_",$halalName);
						
						$halalIng = "\nhalali:".$halalName." halalv:halal ";
						$halalId = $ingredient[$id]['id'];											
												
						
						if($ingredient[$id]->iType == 0){
							$insertIngredient = "\nhalali:".$halalName." a foodlirmm:Ingredient;
		\tfoodlirmm:rank ".$ingredient[$id]->id.";
		\trdfs:label \"".$ingredient[$id]->iName."\".";
						}
						else{
							$insertIngredient = "\nhalali:".$halalName." a food:FoodAdditive,foodlirmm:Ingredient;
		\tfoodlirmm:rank ".$ingredient[$id]->id.";
		\trdfs:label \"".$ingredient[$id]->iName."\";
		\trdfs:comment \"".$ingredient[$id]->eNumber."\";\n";
							
							//$DBpedia = @file_get_contents("http://dbpedia.org/sparql?default-graph-uri=http%3A%2F%2Fdbpedia.org&query=select+distinct+%3Fresource+where+%0D%0A%7B+%3Fresource+rdfs%3Alabel+%22".str_replace(" ","+",$ingredient[$id]->iName)."%22%40en+%7D&format=application%2Fsparql-results%2Bjson&CXML_redir_for_subjs=121&CXML_redir_for_hrefs=&timeout=30000&debug=on");
							$DBpedia = @file_get_contents("https://dbpedia.org/sparql?default-graph-uri=http%3A%2F%2Fdbpedia.org&query=ask+%7B+%3Chttp%3A%2F%2Fdbpedia.org%2Fresource%2F".str_replace(" ","_",$ingredient[$id]->iName)."%3E+%3Fp+%3Fo+%7D&format=text%2Fhtml&CXML_redir_for_subjs=121&CXML_redir_for_hrefs=&timeout=30000&debug=on&run=+Run+Query+");
							//if($DBpedia) {
							if($DBpedia == "true") {
								$insertIngredient = $insertIngredient."\towl:sameAs <http://dbpedia.org/resource/".str_replace(' ', '_', $ingredient[$id]->iName).">.";
							}
							else{
								$insertIngredient = rtrim($insertIngredient,";\n").".";
							}
		
							//=========================== HALAL SOURCE ==================================
							//Get Halal Source
							$getHalalFK = DB::select('select * from ingredient_halal where ingredient_id = ?', [$ingredient[$id]->id]);
							if(count($getHalalFK)) {
								foreach ($getHalalFK as $id => $val) {
									$halal[$id] = HalalSource::findOrFail($getHalalFK[$id]->halal_id);
									if($halal[$id]->hStatus == 0){
										$hStatus = "Halal";
									}
									elseif ($halal[$id]->hStatus == 1) {
										$hStatus = "Mushbooh";   
									}
									else{
										$hStatus = "Haraam";
									}
									$insertHalal = "\nhalals:".$halal[$id]->id." a halalv:Source;
			\trdfs:label \"".$hStatus."\";
			\trdfs:comment \"".$halal[$id]->hDescription."\";
			\tfoaf:organization \"".$halal[$id]->hOrganization."\";
			\trdfs:seeAlso <".$halal[$id]->hUrl.">.";
									
									//Menuliskan file resource halalsource
									$fileHalalSource = "resources/halalsources/".$halal[$id]->id.".ttl";
									$resHalalSource = fopen($fileHalalSource, "w");
									fwrite($resHalalSource, $prefix);
									fwrite($resHalalSource, $insertHalal);
									fclose($resHalalSource);
									
									$halalIng = $halalIng."halals:".$getHalalFK[$id]->halal_id.", ";
								}
								$halalSource[$halalId] = rtrim($halalIng,", \"").".";
							}
							
						}
						if($ingWritted != $ingredient[$id]->id){
							//Menuliskan file resource ingredients
							$fileIngredient = "resources/ingredients/".$halalName.".ttl";
							$resIngredient = fopen($fileIngredient, "w");
							fwrite($resIngredient, $prefix);
							fwrite($resIngredient, $insertIngredient);
							if (isset($halalSource[$halalId])) {
								fwrite($resIngredient, $halalSource[$halalId]);
							}
							fclose($resIngredient);
						}
						$ingWritted = $ingredient[$id]->id;
					}
				}

	            
	            //lanjut ke food product selanjutnya
	            fclose($resFoodProduct);
	            unset($insertIngredient, $insertCertificate, $containsIng, $insertManufacture);
            }
            
        }
        echo "berhasil";
		set_time_limit($default);
    }
    
    //buatberli
    
    public function insertingredientfoodproduct() //insert bahan makanan dan produk yang mengandungnya
    {

		//DB::table('in_ingredient_ranking')->truncate();
		//DB::table('in_foodproduct_ranking')->truncate();
    	//$foodProducts = FoodProduct::whereBetween('id',[52001,53000])->where('fVerify', 1)->get()->toArray();
        //pilih id foodproduct
        $foodProducts = FoodProduct::whereBetween('id',[300001,400000])->get()->toArray();
        
       foreach ($foodProducts as $fp => $val) {
       		$getIngFK = DB::select('select * from foodproduct_ingredient where foodproduct_id = ?', [$foodProducts[$fp]['id']]);
       		$foodproduct_id = $foodProducts[$fp]['id'];
       		
			foreach ($getIngFK as $id => $val) {
				$ingredient[$id] = Ingredient::findOrFail($getIngFK[$id]->ingredient_id);
				$ing_id = $getIngFK[$id]->ingredient_id;
				DB::table('ingredient_foodproduct')->insert(
					['ingredient_id' => $ing_id, 'foodproduct_id' => $foodproduct_id]
				);
	                    
			}
       }
       echo 'berhasil';
    }
    
    public function generatefileinputmetisv1()
    {
		$default = ini_get('max_execution_time');
       	//pilih id foodproduct
       	$foodProducts = FoodProduct::whereIn('id',[2,3,4,5,13,14,15,17,36,101,106,107,108,153,154,155,156,158,159,160,162,163,167,168,170,172,173,174,175,176,177,178,179,180,181,182,183,184,185,186,187,188,189,190,191,202,210,211,218,232,324])->get()->toArray();
       	//$foodProducts = FoodProduct::whereBetween('id',[1,3])->get()->toArray();
		$fileFoodProduct = "graphpartitioning/filemasukan/certifiedfp_ing.csv";
        $resFoodProductIng = fopen($fileFoodProduct, "w");
        foreach ($foodProducts as $fp => $val) {
            $make_idFood = $foodProducts[$fp]['id'];
		        $getIngFK = DB::select('select distinct foodproduct_id,ingredient_id from foodproduct_ingredient inner join ingredients on ingredients.id = foodproduct_ingredient.ingredient_id where foodproduct_id = ?', [$foodProducts[$fp]['id']]);
	            $containsIng = $make_idFood;
				foreach ($getIngFK as $id => $val) {
					$ingredient_id = $getIngFK[$id]->ingredient_id;
					$containsIng = $containsIng.",".$ingredient_id;
				}
				fwrite($resFoodProductIng, $containsIng);
				fwrite($resFoodProductIng, "\n");
        }
        fclose($resFoodProductIng);
		unset($containsIng);
    	
    	$csv = array_map('str_getcsv', file($fileFoodProduct));
        $fileIngredient = "graphpartitioning/filemasukan2/ing_certifiedfp.csv";
	    $resIngredientFP = fopen($fileIngredient, "w");
	        
        for ($d=0; $d < count($csv); $d++) {
    		$sliceIng = array_slice($csv[$d], 1, sizeof($csv,1));
    	    $ingredients = Ingredient::whereIn('id',array_unique($sliceIng))->get()->toArray();
			foreach ($ingredients as $ing => $val) {
	            $make_idIng = $ingredients[$ing]['id'];
			        //atur queri
			        //$getFPFK = DB::select('select distinct ingredient_id,foodproduct_id from ingredient_foodproduct where foodproduct_id <= 3 and ingredient_id = ?', [$ingredients[$ing]['id']]);
		            $getFPFK = DB::select('select distinct ingredient_id,foodproduct_id from ingredient_foodproduct where foodproduct_id <= 324 and ingredient_id = ?', [$ingredients[$ing]['id']]);
		            $containsFP = $make_idIng;
					foreach ($getFPFK as $id => $val) {
							$foodproduct_id = $getFPFK[$id]->foodproduct_id;
							$containsFP = $containsFP.",".$foodproduct_id;
					}
					fwrite($resIngredientFP, $containsFP);
					fwrite($resIngredientFP, "\n");
	        }
        unset($containsFP);
        }
        fclose($resIngredientFP);
        
        echo "berhasil";
		set_time_limit($default);
    }
    
    public function generatefileinputmetis1() { //generate produk serta bahan yang dikandungnya
    	$default = ini_get('max_execution_time');
       	
       	$foodProducts = FoodProduct::whereIn('id',[2,3,4,5,13,14,15,17,36,101,106,107,108,153,154,155,156,158,159,160,162,163,167,168,170,172,173,174,175,176,177,178,179,180,181,182,183,184,185,186,187,188,189,190,191,202,210,211,218,232,324])->get()->toArray();
       	//$foodProducts = FoodProduct::whereBetween('id',[1,324])->get()->toArray();
		$fileFoodProduct = "graphpartitioning/filemasukan/certifiedfp_ing.csv";
        $resFoodProductIng = fopen($fileFoodProduct, "w");
        foreach ($foodProducts as $fp => $val) {
            $make_idFood = $foodProducts[$fp]['id'];
		        $getIngFK = DB::select('select distinct foodproduct_id,ingredient_id from foodproduct_ingredient inner join ingredients on ingredients.id = foodproduct_ingredient.ingredient_id where foodproduct_id = ?', [$foodProducts[$fp]['id']]);
	            $containsIng = $make_idFood;
				foreach ($getIngFK as $id => $val) {
					$ingredient_id = $getIngFK[$id]->ingredient_id;
					$containsIng = $containsIng."\t".$ingredient_id;
				}
				fwrite($resFoodProductIng, $containsIng);
				fwrite($resFoodProductIng, "\n");
        }
        fclose($resFoodProductIng);
		unset($containsIng);
		echo "berhasil";
		set_time_limit($default);
    }
    
    public function generatefileinputmetis2() { //generate bahan dan produk yang mengandungnya
    	$default = ini_get('max_execution_time');
    	//pilih id product
    	//$ingredients = Ingredient::whereBetween('id',[50466,100000])->get()->toArray();
        $ingredients = Ingredient::whereIn('id',[2,3,8,21,24,39,46,47,62,71,74,103,117,121,133,137,138,170,173,191,230,231,266,283,289,325,333,334,335,336,337,338,339,340,341,342,343,344,345,346,347,348,350,351,352,353,354,355,356,357,358,359,360,361,362,363,364,365,366,367,368,369,370,371,372,373,374,375,376,382,385,387,388,389,402,404,406,407,413,414,421,422,430,432,436,447,448,451,452,453,455,456,457,458,460,461,463,465,473,474,475,487,489,492,493,504,507,524,529,532,535,539,541,543,545,556,557,562,564,570,574,579,581,582,585,588,591,592,593,594,595,596,597,599,600,601,602,603,607,608,609,610,611,612,617,618,619,622,623,624,627,628,629,630,631,632,633,634,635,636,637,638,639,640,641,642,643,644,645,646,647,648,649,650,651,652,653,654,655,656,657,658,659,660,661,662,663,664,665,666,667,668,669,670,671,672,673,674,675,676,677,678,679,680,681,682,683,687,690,694,695,696,720,724,725,726])->get()->toArray();
        
		$fileIngredient = "graphpartitioning/filemasukan2/ing_certifiedfp.csv";
        $resIngredientFP = fopen($fileIngredient, "w");
        foreach ($ingredients as $ing => $val) {
            $make_idIng = $ingredients[$ing]['id'];
		        //$getFPFK = DB::select('select distinct ingredient_id,foodproduct_id from ingredient_foodproduct inner join foodproducts on foodproducts.id = ingredient_foodproduct.foodproduct_id where ingredient_id = ?', [$ingredients[$ing]['id']]);
	            //$getFPFK = DB::select('select distinct ingredient_id,foodproduct_id from ingredient_foodproduct where ingredient_id = ?', [$ingredients[$ing]['id']]);
	            $getFPFK = DB::select('select distinct ingredient_id,foodproduct_id from ingredient_foodproduct where foodproduct_id <= 324 and ingredient_id = ?', [$ingredients[$ing]['id']]);
	            $containsFP = $make_idIng;
				foreach ($getFPFK as $id => $val) {
						$foodproduct_id = $getFPFK[$id]->foodproduct_id;
						$containsFP = $containsFP."\t".$foodproduct_id;
				}
				fwrite($resIngredientFP, $containsFP);
				fwrite($resIngredientFP, "\n");
        }
        fclose($resIngredientFP);
		unset($containsFP);
		echo "berhasil";
		set_time_limit($default);
    }
    	
}
