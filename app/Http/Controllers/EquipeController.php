<?php

namespace App\Http\Controllers;

use App\Entraineurs;
use App\Equipes;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class EquipeController extends Controller
{
  public function index()
  {
      $equipes=Equipes::all();
      $antraineurs=Entraineurs::where('is_affected',0)->get();
      return view('equipes.index',compact('equipes','antraineurs'));
  }
  public function store(Request $request){
      $equipe=new Equipes();
      $equipe->name=$request->name;
      $equipe->antraineur_id=$request->antraineur_id;
      $equipe->save();
      if($request->antraineur_id){
          $antraineur=Entraineurs::find($request->antraineur_id);
          $antraineur->is_affected=1;
          $antraineur->save();
      }
      return redirect()-> back();
  }
  public function delete_equipe(Request $request){
      $equipe = Equipes::find($request->equipe_id);
      $equipe->delete();
      return response()->json($equipe);
  }
    public function edit(Request $request)
    {

        $equipe = Equipes::find($request->equipe_id);
        if($equipe->antraineur_id){
            $coachs=Entraineurs::where('is_affected',0)->orWhere('id',$equipe->antraineur_id)->get();
        }else{
            $coachs=Entraineurs::where('is_affected',0)->get();
        }
        $html = view('equipes.edit', compact('equipe','coachs'))->render();

        return response()->json(['html' => $html]);
    }

    public function update(Request $request){

      $equipe=Equipes::find($request->equipe_id);
      if($equipe->antraineur_id){
          $old_coach=Entraineurs::find($equipe->antraineur_id);
          $old_coach->is_affected=0;
          $old_coach->save();
      }

      if($request->antraineur_id != null){
          $new_coach=Entraineurs::find($request->antraineur_id);
          $new_coach->is_affected=1;
          $new_coach->save();
      }
      $equipe->name=$request->name;

      $equipe->antraineur_id=$request->antraineur_id;

      if($equipe->antraineur_id){
          $name_coach=$equipe->entraineur()->full_name();
      }else{
          $name_coach='';
      }

        $equipe->save();

        return Response()->json($equipe);
    }
}
