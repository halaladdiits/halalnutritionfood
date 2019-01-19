<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;

use JavaScript;
use App\Http\Requests;
use App\Models\Ingredient;
use App\Models\HalalSource;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;


class IngredientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $additive = Ingredient::where('iType', 1)->get();
        return view('additive/list', compact('additive'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('additive/create');
    }

    public static $rules = [
        'iName' => ['required','min:3'],
        'eNumber' => ['required'],
    ];
    public static $messages = [
        'iName.required' => 'Additive name is required.',
        'iName.min' => 'Additive name is to short',
        'eNumber.required' => 'E-Number is required.',
    ];

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = Input::all();
        $addRules = ['unique:ingredients'];
        $addMessages = [
            'iName.unique' => 'Additive is exists.',
            'eNumber.unique' => 'E-Number is exists.'
        ];
        $rules = [
            'iName' => array_merge(self::$rules['iName'], $addRules),
            'eNumber' => self::$rules['eNumber']
        ]; 
        $messages =  array_merge(self::$messages, $addMessages);
        $validator = Validator::make($input, $rules, $messages);
        if($validator->fails())
        {
            return redirect()->back()
                ->withErrors($validator);
        }
        //Store
        $additive = new Ingredient;
        $additive->iName = $request->input('iName');
        $additive->iType = 1;
        $additive->eNumber = $request->input('eNumber');
        $additive = $additive->toArray();
        foreach ($request->input('hOrganization') as $key => $h){
            if (!empty($request->input('hOrganization')[$key])) {
                $storeSource = $this->storeSource($request, $key);
                if(is_object($storeSource)){
                    return redirect()->back()
                    ->withErrors($storeSource);    
                }
                else{
                    $halalSource[$key] = $storeSource;
                }
            }
        }
        $additive = Ingredient::create($additive);
        if (isset($halalSource)) {
            foreach ($halalSource as $key => $hs){
                $halal = HalalSource::create($halalSource[$key]);
                $additive->halalSource()->attach($halal->id);
            }
        }
        flash()->success('Food Additive Has Successfully Added');
        return redirect()->route('additive.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ingredient = Ingredient::find($id);
        if(!empty($ingredient)){
            $halalSource = $ingredient->halalSource->all();
            return view('additive/show', compact('ingredient','halalSource'));
        }
        abort(404);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $additive = Ingredient::find($id);
        if(!empty($additive)){
            $halalSource = $additive->halalSource->all();
            JavaScript::put([
                'additive' => $additive,
            ]);
            return view('additive/edit',compact('additive','halalSource'));    
        }
        abort(404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
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
        //Update Addictive
        $update = array(
            'iName' => $request->input('iName'),
            'eNumber' => $request->input('eNumber')
        );
        //Get Exist Halal Source
        $uhCount = 0;
        $uhID = 0;
        if (!empty($request->input('uhID'))) {
            foreach ($request->input('uhID') as $key => $uh){
                $uhCount++;
            }
        }
        //Get Source Form
        foreach ($request->input('hOrganization') as $key => $h){
            if (!empty($request->input('hOrganization')[$key])) {
                $storeSource = $this->storeSource($request, $key);
                if(is_object($storeSource)){
                    return redirect()->back()
                    ->withErrors($storeSource);    
                }
                else{
                    $halalSource[$key] = $storeSource;
                }
            }
        }
        //Update Source
        Ingredient::findOrFail($id)->update($update);
        if (isset($halalSource)) {
            foreach ($halalSource as $key => $hs){
                if($uhCount>0){
                    HalalSource::findOrFail($request->input('uhID')[$uhID])->update($halalSource[$key]);
                    $uhCount--;
                    $uhID++;
                }
                else{
                    $halal = HalalSource::create($halalSource[$key]);
                    Ingredient::findOrFail($id)->halalSource()->attach($halal->id);    
                }
            }
        }
        flash()->success('Food Additive Has Successful Edited');
        return redirect()->route('additive.index');     
    }

    public function storeSource(Request $request, $key)
    {
        //Validation
        $input = $request->all();
        $rules = [
            'hOrganization.'.$key => ['required','min:3'],
            'hDescription.'.$key => ['required','max:255'],
            'hUrl.'.$key => ['required','active_url']
        ];
        $messages = [
            'hOrganization.'.$key.'.required' => 'Halal organization is required',
            'hOrganization.'.$key.'.min' => 'Halal organization too short',
            'hDescription.'.$key.'.required' => 'Halal description is required',
            'hDescription.'.$key.'.max' => 'Halal description too long',
            'hUrl.'.$key.'.required' => 'URL is required',
            'hUrl.'.$key.'.url' => 'URL is invalid',
        ];
        $validator = Validator::make($input, $rules, $messages);
        if($validator->fails())
        {
            return $validator;
        }
        else{
            //Store
            $halalSource = new HalalSource;
            $halalSource->hOrganization =  $request->input('hOrganization')[$key];
            $halalSource->hStatus =  $request->input('hStatus')[$key];
            $halalSource->hDescription = $request->input('hDescription')[$key];
            $halalSource->hUrl = $request->input('hUrl')[$key];
            return $halalSource->toArray();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Ingredient::findOrFail($id)->delete();
        flash()->success('Food Additive Has Successful Deleted');
        return redirect()->back();
    }

    public function halalSourceDestroy($id)
    {
        HalalSource::findOrFail($id)->delete();
        return redirect()->back();
    }
}
