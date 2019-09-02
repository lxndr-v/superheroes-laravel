<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Superhero;
use App\Heropicture;

class SuperheroesController extends Controller
{
  /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
       
        // $superheroes = Superhero::all();
        $superheroes = Superhero::orderBy('nickname', 'asc')->paginate(5);//get();
        return view('superheroes.index')->with('superheroes', $superheroes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('superheroes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'nickname' => 'required',
            'real_name' => 'required',
            'catch_phrase' => 'required',
            'superpowers' => 'required',
            'origin_description' => 'required',
            'hero_pictures.*' => 'image|nullable'
        ]);

        $superhero = new Superhero;
        $superhero->nickname = $request->input('nickname');
        $superhero->real_name = $request->input('real_name');
        $superhero->catch_phrase = $request->input('catch_phrase');
        $superhero->superpowers = $request->input('superpowers');
        $superhero->origin_description = $request->input('origin_description');
        $superhero->user_id = auth()->user()->id;
        
        $superhero->save();

        if($request->hasFile('hero_pictures')){
            foreach($request->hero_pictures as $rfile){
                //get filename with extension
                $filenameWithExt = $rfile->getClientOriginalName();
                //get just filename
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                //get just extension
                $extension = $rfile->getClientOriginalExtension();
                //filename to store
                $filenameToStore = $filename . '_' . time() . '.' . $extension;
                //upload image
                $path = $rfile->storeAs('public/hero_pictures', $filenameToStore);
                //save in db
                $heroPicture = new Heropicture;
                $heroPicture->superhero_id = $superhero->id;
                $heroPicture->hero_picture = $filenameToStore;
                $heroPicture->save();
               
            }
        } else {
            $filenameToStore = 'noimage.jpg';
        }
              
        return redirect('/')->with('success', 'Superhero Created' . $superhero->id);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $superhero = Superhero::find($id);
        if ($superhero === null)  return redirect('/');
        return view('superheroes.show')->with('superhero', $superhero)->with('hero_pictures', $superhero->heropictures);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $superhero = Superhero::find($id);
        if ($superhero === null)  return redirect('/');
        
        //Check for coorect user
        if (auth()->user()->id !== $superhero->user_id){
            return redirect('/')->with('error', 'Unauthorized page');
        }
        return view('superheroes.edit')->with('superhero', $superhero)->with('hero_pictures', $superhero->heropictures);
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
        
        $this->validate($request, [
            'nickname' => 'required',
            'real_name' => 'required',
            'catch_phrase' => 'required',
            'origin_description' => 'required',
        ]);

        $superhero = Superhero::find($id);
        $superhero->nickname = $request->input('nickname');
        $superhero->real_name = $request->input('real_name');
        $superhero->catch_phrase = $request->input('catch_phrase');
        $superhero->superpowers = $request->input('superpowers');
        $superhero->origin_description = $request->input('origin_description');

        $superhero->save();
        if($request->hasFile('hero_pictures')){
            foreach($request->hero_pictures as $rfile){
                //get filename with extension
                $filenameWithExt = $rfile->getClientOriginalName();
                //get just filename
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                //get just extension
                $extension = $rfile->getClientOriginalExtension();
                //filename to store
                $filenameToStore = $filename . '_' . time() . '.' . $extension;
                //upload image
                $path = $rfile->storeAs('public/hero_pictures', $filenameToStore);
                //save in db
                $heroPicture = new Heropicture;
                $heroPicture->superhero_id = $superhero->id;
                $heroPicture->hero_picture = $filenameToStore;
                
                $heroPicture->save();
            }
        }

        return redirect('/')->with('success', 'Superhero Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $superhero = Superhero::find($id);
         //Check for coorect user
         if (auth()->user()->id !== $superhero->user_id){
            return redirect('/')->with('error', 'Unauthorized page');
        }
        // return $superhero->heropictures;
        //Delete pictures
        if(count($superhero->heropictures)>0){
            foreach($superhero->heropictures as $picture){
                Storage::delete('public/hero_pictures/' . $picture->hero_picture);
                DB::table('heropictures')->where('hero_picture', ''.$picture->hero_picture)->delete();
            }
        }
        $superhero->delete();
        return redirect('/')->with('success', 'Superhero Removed');
    }
          
    
}
