<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Input;
use App\Http\Controllers\Controller;
use Vendor\EasyRDF\EasyRDF\lib\EasyRDF;


class RDFBrowserController extends Controller
{
    public function getIndex()
    {
        $uri = Input::get('uri', 'http://halal.addi.is.its.ac.id/resources.ttl');
        if (isset($uri)) {
            $newUri = strstr($uri, '#', true);
            if(!$newUri){
                if(substr($uri, -4) == ".ttl") {
                    $newUri = $uri;
                }
                else{
                    $newUri = $uri.'.ttl';
                }
            }
            else{
                if(substr($newUri, -4) == ".ttl") {
                    $newUri = $newUri.strstr($uri, '#');
                }
                else{
                    $newUri = $newUri.'.ttl'.strstr($uri, '#');   
                }
            }
        }
        $graph = \EasyRdf_Graph::newAndLoad($newUri);

        return view('pages/browser', compact('graph'));
    }
    
    public function readTtl() {
    	$uri = Input::get('uri', 'http://halal.addi.is.its.ac.id/resources/foodproducts/2.ttl');
        if (isset($uri)) {
            $newUri = strstr($uri, '#', true);
            if(!$newUri){
                if(substr($uri, -4) == ".ttl") {
                    $newUri = $uri;
                }
                else{
                    $newUri = $uri.'.ttl';
                }
            }
            else{
                if(substr($newUri, -4) == ".ttl") {
                    $newUri = $newUri.strstr($uri, '#');
                }
                else{
                    $newUri = $newUri.'.ttl'.strstr($uri, '#');   
                }
            }
        }
    	$foaf =\EasyRdf_Graph::newAndLoad($newUri);
		json_decode(var_dump($foaf), true);
		//echo "My name is: ".$me->get('rdfs:label')."\n";
    }
}
