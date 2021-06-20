<?php

namespace App\Http\Controllers;

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
}
