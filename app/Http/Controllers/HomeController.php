<?php

namespace App\Http\Controllers;

use App\Equipes;
use App\Matches;
use App\Tournois;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
            $from=1;
            $tournois = Tournois::all();
            if(!$tournois->first()){
                $from=3;
            }
            return view('home', compact('tournois','from'));
    }
    public function show($id){
        $from=2;
        $tournois = Tournois::find($id);
        return view('home', compact('tournois','from'));
    }

    public function index_tournois()
    {
        $tournois = Tournois::all();
        return view('tournois.index', compact('tournois'));

    }

    public function store_tournoi(Request $request)
    {

        $tournoi = new Tournois();
        $tournoi->name = $request->name;
        $tournoi->date_debut = $request->date_debut;
        $tournoi->date_fin = $request->date_fin;
        $tournoi->save();
        return back();
    }

    public function delete_tournoi(Request $request)
    {
        $tournoi = Tournois::find($request->tournoi_id);
        $tournoi->delete();
        return response()->json($tournoi);
    }

    public function edit_tournoi(Request $request)
    {

        $tournoi = Tournois::find($request->tournoi_id);
        $html = view('tournois.edit', compact('tournoi'))->render();

        return response()->json(['html' => $html]);
    }

    public function update_tournoi(Request $request)
    {
        $tournoi = Tournois::find($request->tournoi_id);
        $tournoi->name = $request->name;
        $tournoi->date_debut = $request->date_debut;
        $tournoi->date_fin = $request->date_fin;
        $tournoi->save();
        return response()->json($tournoi);
    }
    public function ajouter_matche(Request $request){
         $tournoi=Tournois::find($request->tournoi_id);
         $equipes=Equipes::all();

        $html = view('tournois.ajouter_matche', compact('tournoi','equipes'))->render();

        return response()->json(['html' => $html]);

    }
    public function store_matche(Request $request){

         $equipe1=Equipes::find($request->equipe_one);
         $equipe2=Equipes::find($request->equipe_two);
        if($request->equipe_one==$request->equipe_two){
            return back()->with(['error' => 'Veuillez choisir des équipes différentes svp !!!']);
        }else{

            if($equipe1->has_matche($request->date) == true || $equipe2->has_matche($request->date) == true ){
                return back()->with(['error' => 'Veuillez choisir une autre date différente svp !!!']);
            }
            $matche=new Matches();
            $matche->tournoi_id=$request->tournoi_id;
            $matche->equipe_one=$request->equipe_one;
            $matche->equipe_two=$request->equipe_two;
            $matche->date=$request->date;
            $matche->save();
            return back()->with(['success' => 'Matche ajouté avec succès']);


        }
    }
}
