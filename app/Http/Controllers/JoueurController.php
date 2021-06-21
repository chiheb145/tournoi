<?php

namespace App\Http\Controllers;

use App\Equipes;
use App\Equipes_joueurs;
use App\Joueurs;
use Illuminate\Http\Request;

class JoueurController extends Controller
{
    public function index(){
        $joueurs=Joueurs::all();
        $equipes=Equipes::all();
        return view('joueurs.index',compact('joueurs','equipes'));
    }
    public function store(Request $request){
        $joueur=new Joueurs();
        $joueur->first_name=$request->first_name;
        $joueur->last_name=$request->last_name;
        $joueur->save();
        if($request->equipe_id != null){
            $joueur_equipe=new Equipes_joueurs();
            $joueur_equipe->equipe_id=$request->equipe_id;
            $joueur_equipe->joueur_id=$joueur->id;
            $joueur_equipe->save();
        }
        return redirect()->back();
    }
    public function delete_joueur(Request $request){

        $joueur = Joueurs::find($request->joueur_id);
        $joueur_equipe=Equipes_joueurs::where('joueur_id',$joueur->id)->first();
        if($joueur_equipe){
            $joueur_equipe->delete();
        }
        $joueur->delete();
        return response()->json($joueur);
    }
    public function edit_joueur(Request $request){

        $joueur = Joueurs::find($request->joueur_id);
        $html = view('joueurs.edit', compact('joueur'))->render();

        return response()->json(['html' => $html]);
    }
    public function update_joueur(Request $request){
        $joueur=Joueurs::find($request->joueur_id);
        $joueur->first_name=$request->first_name;
        $joueur->last_name=$request->last_name;
        $joueur->save();
        return response()->json($joueur);
    }
    public function attacher_joueur(Request $request){
        $joueur = Joueurs::find($request->joueur_id);
        $equipes=Equipes::all();
        $html = view('joueurs.attacher', compact('joueur','equipes'))->render();

        return response()->json(['html' => $html]);
    }
    public function store_attachement(Request $request){
        $is_affected = Equipes_joueurs::where('joueur_id', $request->joueur_id)->where('is_active', 1)->first();
        $equipe = Equipes::find($request->equipe_id);
        if ($is_affected) {
            if ($is_affected->equipe_id == $equipe->id){
                return back()->with(['error' => 'Joueur existe déjà dans cet équipe']);
            }else{
                $is_affected->equipe_id=$request->equipe_id;
                $is_affected->save();
                return back()->with(['success' => 'Affectation de joueur réussite']);

            }
        } else {
            $equipe_joueur = new Equipes_joueurs();
            $equipe_joueur->joueur_id = $request->joueur_id;
            $equipe_joueur->equipe_id = $request->equipe_id;
            $equipe_joueur->save();

            return back()->with(['success' => 'Affectation de joueur réussite']);
        }


    }
}
