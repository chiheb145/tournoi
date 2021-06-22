<?php

namespace App\Http\Controllers;

use App\Entraineurs;
use App\Equipes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class AntraineurController extends Controller
{
    public function index(){
        $antraineurs=Entraineurs::all();
        $equipes=Equipes::all();
        return view('antraineurs.index',compact('antraineurs','equipes'));
    }
    public function store(Request $request){
        $antraineur=new Entraineurs();
        $antraineur->first_name=$request->first_name;
        $antraineur->last_name=$request->last_name;
        $antraineur->save();

        return redirect()->back();
    }
    public function delete_antraineur(Request $request){

        $antraineur = Entraineurs::find($request->antraineur_id);
        $antraineur_equipe=Equipes::where('antraineur_id',$antraineur->id)->first();
        if($antraineur_equipe){
            $antraineur_equipe->antraineur_id=null;
            $antraineur_equipe->save();
        }
        $antraineur->delete();
        return response()->json($antraineur);
    }
    public function edit_antraineur(Request $request){

        $antraineur = Entraineurs::find($request->antraineur_id);
        $html = view('antraineurs.edit', compact('antraineur'))->render();

        return response()->json(['html' => $html]);
    }
    public function update_antraineur(Request $request){
        $antraineur=Entraineurs::find($request->antraineur_id);
        $antraineur->first_name=$request->first_name;
        $antraineur->last_name=$request->last_name;
        $antraineur->save();
        return response()->json($antraineur);
    }
    public function attacher_antraineur(Request $request){
        $antraineur = Entraineurs::find($request->antraineur_id);
        $equipes=Equipes::all();
        $html = view('antraineurs.attacher', compact('antraineur','equipes'))->render();

        return response()->json(['html' => $html]);
    }
    public function store_attachement(Request $request){

        $equipe_exist=Equipes::where('antraineur_id',$request->antraineur_id)->first();
        $antraineur=Entraineurs::find($request->antraineur_id);

        $new_equipe=Equipes::find($request->equipe_id);

        if ($equipe_exist) {
            if ($equipe_exist->id == $request->equipe_id){
                return back()->with(['error' => 'Antraineur existe déjà dans cet équipe']);
            }else{
                $equipe_exist->antraineur_id=null;
                $equipe_exist->save();
                if($new_equipe->antraineur_id != null){
                    $antraineur_new_equipe=Entraineurs::find($new_equipe->antraineur_id);
                    $antraineur_new_equipe->is_affected=0;
                    $antraineur_new_equipe->save();
                }
                $new_equipe->antraineur_id=$antraineur->id;
                $new_equipe->save();
                return back()->with(['success' => 'Affectation réussite']);

            }
        } else{
            if($new_equipe->antraineur_id != null){
                $antraineur_new_equipe=Entraineurs::find($new_equipe->antraineur_id);
                $antraineur_new_equipe->is_affected=0;
                $antraineur_new_equipe->save();
            }
            $new_equipe->antraineur_id=$antraineur->id;
            $new_equipe->save();
            $antraineur->is_affected=1;
            $antraineur->save();
            return back()->with(['success' => 'Affectation réussite']);
        }

    }

}
