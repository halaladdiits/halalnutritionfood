<?php namespace App\Http\Controllers;

use App\Models\FoodProduct;
use App\Models\Ingredient;
use App\Models\Certificate;
use App\Models\HalalSource;

use DB, Input;

ini_set('memory_limit', '4000M');
ini_set('max_execution_time', '36000');



class RankingController extends Controller {
	
	protected $client;

    /**
     * Constructor
     **/
    public function __construct(\Solarium\Client $client)
    {
        $this->client = $client;
    }
	
	public function index()
    {
        if (Input::has('q') && Input::has('r')) {

		$q = Input::get('q');
		$r = Input::get('r');
		
		print_r("Nilai R = ".$r);

		$eksekusi = 'java -jar ./Halal.jar -query "'.$q.'" -repeat '.$r;
		
		$a = shell_exec($eksekusi);
		echo $a;
		

        } 
        
        if (Input::has('q')) {

		$q = Input::get('q');

		$eksekusi = 'java -jar ./Halal.jar -query "'.$q.'"';
		
		$a = shell_exec($eksekusi);
		echo $a;
		

        } 
        
        
        if(Input::has('s')) {
        	$select = array(
                'query'         => Input::get('q'),
                'handler'       => 'bm25f',
                'start'         => 0,
                'rows'          => 10,
            );
            $query = $this->client->createSelect($select);

            // Query based on input user
            $query->setQuery(Input::get('q'));

            // add debug settings
            $debug = $query->getDebug();
            $debug->setExplainOther('id:MA*');

             // Execute the query and return the result
            $resultset = $this->client->select($query);

            // Debug result
            $debugResult = $resultset->getDebug();

            // Get query time in seconds
            $ms = $debugResult->getTiming()->getTime();
            $s = $ms/1000;
            
            print_r($result_set);

            // Pass the resultset to the view and return.
            // return view('pages.v2.home', array(
            //     'q' => Input::get('q'),
            //     'resultset' => $resultset,
            //     'debugResult' => $debugResult,
            //     's' => $s,
            //     'handler' => 'bm25f',
            // ));
        }
    }	
    
    
    
    
    public function releated()
    {
        if (Input::has('id')) {

		$id = Input::get('id');
		
		/*
		$similarity = DB::select('SELECT id, fName, cosine, euclidean 
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
		*/
		
		$cosinesimilarity = DB::select('SELECT foodproducts.id, foodproducts.fName, similarity.cosine
								FROM foodproducts
								INNER JOIN similarity
								ON foodproducts.id = similarity.docId2
								WHERE similarity.docId = :id								
								ORDER BY similarity.cosine DESC
								LIMIT 5', ['id' => $id]);
								
		//return response()->json($similarity);
		return response()->json($cosinesimilarity);

        }
    }
    
    public function inglist()
    {
        if (Input::has('id')) {

		$id = Input::get('id');
		$foodProduct = FoodProduct::find($id);
		
		if (!empty($foodProduct)) {
			
			$ingredients = $foodProduct->ingredient->all();
			$inglist = array();
			
            foreach ($ingredients as $ing) {
                if($ing->iType==0){
                    $inglist[] = array('name' => $ing->iName, 'id' => $ing->id, 'type' => 'Ingredient');
                }
            }
        }
								
		return response()->json($inglist);

        }
    }
    
    public function addlist()
    {
         if (Input::has('id')) {

		$id = Input::get('id');
		$foodProduct = FoodProduct::find($id);
		
		if (!empty($foodProduct)) {
			
			$ingredients = $foodProduct->ingredient->all();
			$addlist = array();
			
            foreach ($ingredients as $ing) {
                if($ing->iType!=0){
                    $addlist[] = array('name' => $ing->iName, 'id' => $ing->id,  'type' => 'Additive');
                }
            }
        }
								
		return response()->json($addlist);

        }
    }
    
	public function certificate()
    {
         if (Input::has('id')) {

		$id = Input::get('id');
		$certificate = Certificate::find($id);
		
		return response()->json($certificate);

        }
    }
    
    public function random() {
    	$eksekusi = 'java -jar ./Halal.jar -random';
		
		$a = shell_exec($eksekusi);
		echo $a;
		
		
    }
    
    public function testingphp() {
    	$random = @file_get_contents('http://halal.addi.is.its.ac.id/random');
		$random = json_encode($random);
		echo json_decode($random);
    }

   public function makeIndependentRanking()
    {

		//DB::table('in_ingredient_ranking')->truncate();
		//DB::table('in_foodproduct_ranking')->truncate();
    	//$foodProducts = FoodProduct::whereBetween('id',[52001,53000])->where('fVerify', 1)->get()->toArray();
        $foodProducts = FoodProduct::whereBetween('id',[49201,50000])->get()->toArray();
        
       foreach ($foodProducts as $fp => $val) {
       		$getIngFK = DB::select('select * from foodproduct_ingredient where foodproduct_id = ?', [$foodProducts[$fp]['id']]);
       		$foodproduct_id = $foodProducts[$fp]['id'];
       		$ranking = 0;
			foreach ($getIngFK as $id => $val) {

				 $ingredient[$id] = Ingredient::findOrFail($getIngFK[$id]->ingredient_id);
				 $ing_id = $getIngFK[$id]->ingredient_id;
				
				 $DBpedia = @file_get_contents("https://dbpedia.org/sparql?default-graph-uri=http%3A%2F%2Fdbpedia.org&query=ask+%7B+%3Chttp%3A%2F%2Fdbpedia.org%2Fresource%2F".str_replace(" ","_",$ingredient[$id]->iName)."%3E+%3Fp+%3Fo+%7D&format=text%2Fhtml&CXML_redir_for_subjs=121&CXML_redir_for_hrefs=&timeout=30000&debug=on&run=+Run+Query+");
	                    if($DBpedia == "true") {
						
						$ranking = $ranking+1;
						
						DB::table('in_ingredient_ranking')->insert(
						    ['ingredient_id' => $ing_id, 'foodproduct_id' => $foodproduct_id]
						);
	                    }
	                    else{
	                    }
			}

        	DB::table('in_foodproduct_ranking')->insert(
						    ['foodproduct_id' => $foodproduct_id, 'ranking' => $ranking]
			);
       }
       
       echo 'berhasil';
    }
    
    //salah
//     public function getWriteAllTurtle()
//     {
//         //Resource Produk
//         $productfile = fopen("resources.ttl", "w");

//         $prefix = "@prefix rdf: <http://www.w3.org/1999/02/22-rdf-syntax-ns#> .
// @prefix rdfs: <http://www.w3.org/2000/01/rdf-schema#> .
// @prefix owl: <http://www.w3.org/2002/07/owl#> .
// @prefix xsd: <http://www.w3.org/2001/XMLSchema#> .
// @prefix foaf: <http://xmlns.com/foaf/0.1/> .
// @prefix halalv: <http://halal.addi.is.its.ac.id/halalv.ttl#> .
// @prefix halalf: <http://halal.addi.is.its.ac.id/resources/foodproducts/> .
// @prefix halali: <http://halal.addi.is.its.ac.id/resources/ingredients/> .
// @prefix halals: <http://halal.addi.is.its.ac.id/resources/halalsources/> .
// @prefix halalc: <http://halal.addi.is.its.ac.id/resources/certificates/> .
// @prefix halalm: <http://halal.addi.is.its.ac.id/resources/manufactures/> .\n";
        
//         $ingWritted = 0;
//         $foodProducts = FoodProduct::where('fVerify',1)->get()->toArray();

//         fwrite($productfile, $prefix);
        
//         //Menuliskan Resource foodproducts.ttl
// /*        foreach ($foodProducts as $fp => $val) {
//             $list[$fp]="\nhalalf:".$foodProducts[$fp]['id']." a halalv:FoodProduct.";
//             fwrite($productfile, $list[$fp]);
//         }
//         */
//         foreach ($foodProducts as $fp => $val) {
//             //=========================== FOOD PRODUCT ==================================
//             //Menuliskan ke turtle
//             $list[$fp]="halalf:".$foodProducts[$fp]['id']." a halalv:FoodProduct;
// \thalalv:foodCode \"".$foodProducts[$fp]['fCode']."\";
// \trdfs:label \"".$foodProducts[$fp]['fName']."\";
// \thalalv:manufacture \"".$foodProducts[$fp]['fManufacture']."\";
// \thalalv:netWeight ".$foodProducts[$fp]['weight'].";
// \thalalv:calories ".$foodProducts[$fp]['calories'].";
// \thalalv:fat ".$foodProducts[$fp]['totalFat'].";
// \thalalv:saturatedFat ".$foodProducts[$fp]['saturatedFat'].";
// \thalalv:sodium ".$foodProducts[$fp]['sodium'].";
// \thalalv:fiber ".$foodProducts[$fp]['dietaryFiber'].";
// \thalalv:sugar ".$foodProducts[$fp]['sugar'].";
// \thalalv:protein ".$foodProducts[$fp]['protein'].";
// \thalalv:vitaminA ".$foodProducts[$fp]['vitaminA'].";
// \thalalv:vitaminC ".$foodProducts[$fp]['vitaminC'].";
// \thalalv:calcium ".$foodProducts[$fp]['calcium'].";
// \thalalv:iron ".$foodProducts[$fp]['iron'].".\n";

//             //Menuliskan file resource foodproducts
//             $fileFoodProduct = "resources/halal.ttl";
//             	$resFoodProduct = fopen($fileFoodProduct, "w");
// 	            //fwrite($resFoodProduct, $prefix."\n");
// 	            fwrite($resFoodProduct, $list[$fp]);
	
// 	            $hasManufacture = "\nhalalf:".$foodProducts[$fp]['id']." halalv:manufacture halalm:".$foodProducts[$fp]['id'].".";
	            
// 	            //Menuliskan hubungan foodproduct dengan manufacture di file resource foodproducts
// 	            fwrite($resFoodProduct, $hasManufacture."\n");
	
// 	            $getCertFK = DB::select('select * from foodproduct_certificate where foodproduct_id = ?', [$foodProducts[$fp]['id']]);
// 	            $hasCertificate = "\nhalalf:".$foodProducts[$fp]['id']." halalv:certificate ";
// 	            foreach ($getCertFK as $id => $val) {
// 	                $hasCertificate = $hasCertificate."halalc:".$getCertFK[$id]->certificate_id.", ";
// 	            }
	
// 	            //Menuliskan hubungan foodproduct dengan certificate di file resource foodproducts
// 	            if(substr($hasCertificate, -2,1) !== "e"){
// 	                fwrite($resFoodProduct, rtrim($hasCertificate,", \"").".\n");    
// 	            }
	
// 	            $getIngFK = DB::select('select * from foodproduct_ingredient where foodproduct_id = ?', [$foodProducts[$fp]['id']]);
	
// 	            //Menuliskan kandungan komposisi
// 	            $containsIng = "\nhalalf:".$foodProducts[$fp]['id']." halalv:containsIngredient ";
// 	            foreach ($getIngFK as $id => $val) {
// 	                $containsIng = $containsIng."halali:".$getIngFK[$id]->ingredient_id.", ";
// 	            }
	            
// 	            //Menuliskan file resource certificates
// 	            fwrite($resFoodProduct, rtrim($containsIng,", \"").".\n");
	
// 	            //=========================== MANUFACTURE ==================================
// 	            //Get manufacture
// 	            $getManufacture = DB::select('select fManufacture from foodproducts where id = ?', [$foodProducts[$fp]['id']]);
// 	            $insertManufacture = "halalm:".$foodProducts[$fp]['id']." a halalv:Manufacture;
// 	\trdfs:label \"".$getManufacture[0]->fManufacture."\".\n";   
	            
// 	            //Menuliskan file resource manufacture
// 	            $fileManufacture = "resources/halal.ttl";
// 	            //$resManufacture = fopen($fileManufacture, "w");
// 	            //fwrite($resFoodProduct, $prefix."\n");
// 	            fwrite($resFoodProduct, $insertManufacture);
// 	            //fclose($resManufacture);
	
// 	            //=========================== CERTIFICATE ==================================    
// 	            //Get certificate
// 	            foreach ($getCertFK as $id => $val) {
// 	                $certificate[$id] = Certificate::findOrFail($getCertFK[$id]->certificate_id);
// 	                if($certificate[$id]->cStatus == 0){
// 	                    $cStatus = "Development";
// 	                }
// 	                elseif ($certificate[$id]->cStatus == 1) {
// 	                    $cStatus = "New";   
// 	                }
// 	                else{
// 	                    $cStatus = "Renew";
// 	                }
// 	                $insertCertificate = "\nhalalc:".$certificate[$id]->id." a halalv:HalalCertificate;
// 	\thalalv:halalCode \"".$certificate[$id]->cCode."\";
// 	\thalalv:halalExp \"".$certificate[$id]->cExpire->format('Y-m-d')."\"^^xsd:date;
// 	\thalalv:halalStatus \"".$cStatus."\";
// 	\tfoaf:organization \"".$certificate[$id]->cOrganization."\".";
	
// 	                //Menuliskan file resource certificates
// 	                $fileCertificate = "resources/halal.ttl";
// 	                //$resCertificate = fopen($fileCertificate, "w");
// 	                //fwrite($resFoodProduct, $prefix."\n");
// 	                fwrite($resFoodProduct, $insertCertificate);
// 	                //fclose($resCertificate);
// 	            }
	
// 	            //=========================== INGREDIENT ==================================
// 	            //Get Ingredient
// 	            foreach ($getIngFK as $id => $val) {
// 	                $ingredient[$id] = Ingredient::findOrFail($getIngFK[$id]->ingredient_id);
// 	                $halalIng = "\nhalali:".$ingredient[$id]['id']." halalv:halalSource ";
// 	                $halalId = $ingredient[$id]['id'];
// 	                if($ingredient[$id]->iType == 0){
// 	                    $insertIngredient = "\nhalali:".$ingredient[$id]->id." a halalv:Ingredient;
// 	\thalalv:rank ".$ingredient[$id]->id.";
// 	\trdfs:label \"".$ingredient[$id]->iName."\".";
// 	                }
// 	                else{
// 	                    $insertIngredient = "\nhalali:".$ingredient[$id]->id." a halalv:FoodAdditive;
// 	\thalalv:rank ".$ingredient[$id]->id.";
// 	\trdfs:label \"".$ingredient[$id]->iName."\";
// 	\trdfs:comment \"".$ingredient[$id]->eNumber."\";\n";
	                    
// 	                    $DBpedia = @file_get_contents("http://dbpedia.org/sparql?default-graph-uri=http%3A%2F%2Fdbpedia.org&query=select+distinct+%3Fresource+where+%0D%0A%7B+%3Fresource+rdfs%3Alabel+%22".str_replace(" ","+",$ingredient[$id]->iName)."%22%40en+%7D&format=application%2Fsparql-results%2Bjson&CXML_redir_for_subjs=121&CXML_redir_for_hrefs=&timeout=30000&debug=on");
// 	                    if($DBpedia) {
// 	                        $insertIngredient = $insertIngredient."\towl:sameAs <http://dbpedia.org/resource/".str_replace(' ', '_', $ingredient[$id]->iName).">.";
// 	                    }
// 	                    else{
// 	                        $insertIngredient = rtrim($insertIngredient,";\n").".";
// 	                    }
	
// 	                    //=========================== HALAL SOURCE ==================================
// 	                    //Get Halal Source
// 	                    $getHalalFK = DB::select('select * from ingredient_halal where ingredient_id = ?', [$ingredient[$id]->id]);
// 	                    foreach ($getHalalFK as $id => $val) {
// 	                        $halal[$id] = HalalSource::findOrFail($getHalalFK[$id]->halal_id);
// 	                        if($halal[$id]->hStatus == 0){
// 	                            $hStatus = "Halal";
// 	                        }
// 	                        elseif ($halal[$id]->hStatus == 1) {
// 	                            $hStatus = "Mushbooh";   
// 	                        }
// 	                        else{
// 	                            $hStatus = "Haraam";
// 	                        }
// 	                        $insertHalal = "\nhalals:".$halal[$id]->id." a halalv:Source;
// 	\trdfs:label \"".$hStatus."\";
// 	\trdfs:comment \"".$halal[$id]->hDescription."\";
// 	\tfoaf:organization \"".$halal[$id]->hOrganization."\";
// 	\trdfs:seeAlso <".$halal[$id]->hUrl.">.";
	                        
// 	                        //Menuliskan file resource halalsource
// 	                        $fileHalalSource = "resources/halal.ttl";
// 	                        //$resHalalSource = fopen($fileHalalSource, "w");
// 	                        //fwrite($resFoodProduct, $prefix);
// 	                        fwrite($resFoodProduct, $insertHalal);
// 	                        //fclose($resHalalSource);
	                        
// 	                        $halalIng = $halalIng."halals:".$getHalalFK[$id]->halal_id.", ";
// 	                    }
// 	                    $halalSource[$halalId] = rtrim($halalIng,", \"").".";
	                    
// 	                }
// 	                if($ingWritted != $ingredient[$id]->id){
// 	                    //Menuliskan file resource ingredients
// 	                    $fileIngredient = "resources/halal.ttl";
// 	                    //$resIngredient = fopen($fileIngredient, "w");
// 	                    //fwrite($resFoodProduct, $prefix);
// 	                    fwrite($resFoodProduct, $insertIngredient);
// 	                    if (isset($halalSource[$halalId])) {
// 	                        fwrite($resFoodProduct, $halalSource[$halalId]);
// 	                    }
// 	                    //fclose($resIngredient);
// 	                }
// 	                $ingWritted = $ingredient[$id]->id;
// 	            }
	            
// 	            //lanjut ke food product selanjutnya
// 	            fclose($resFoodProduct);
           
            
//         }
//         echo "berhasil";
//     }
}