@extends('layouts.app2')

@section('content')

    @if($from==1)
    <div class="row justify-content-center pt-2">
        <div class="col-lg-6 ">
            <div class="small-box bg-secondary">
                <div class="small-box-footer">
                    <strong>Tournoi {{$tournois->first()->name}}</strong>
                </div>
                <div class="inner fixed-inner ">
                    <div class="row">
                        <div class="col-10"><strong>Date denut</strong></div>
                        <div class="col-2"><span class="float-right"
                                                 id="creation_total">{{$tournois->first()->date_debut}}</span></div>
                    </div>
                    <div class="row">
                        <div class="col-10"><strong>Date fin</strong></div>
                        <div class="col-2"><span class="float-right"
                                                 id="creation_worked">{{$tournois->first()->date_fin}}</span></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @foreach($tournois->first()->list_matches() as $key=>$matche)
        <div class="container-fluid">
            <div class="row justify-content-center">
                <strong>Matche n° {{$key+1}} le {{$matche->date}}</strong>
            </div>

            <div class="row pt-2">
                <div class=" col bg-success">{{$matche->equipe_1()->name}}</div>
                <div class=" col bg-warning">Antraineur : @if($matche->equipe_1()->entraineur()) {{$matche->equipe_1()->entraineur()->full_name()}} @endif</div>
                VS
                <div class=" col bg-success">{{$matche->equipe_2()->name}}</div>
                <div class="col bg-warning">Antraineur :@if($matche->equipe_2()->entraineur()) {{$matche->equipe_2()->entraineur()->full_name()}} @endif</div>
            </div>
        </div>
    @endforeach
    @elseif($from==2)
        <div class="row justify-content-center pt-2">
            <div class="col-lg-6 ">
                <div class="small-box bg-secondary">
                    <div class="small-box-footer">
                        <strong>Tournoi {{$tournois->name}}</strong>
                    </div>
                    <div class="inner fixed-inner ">
                        <div class="row">
                            <div class="col-10"><strong>Date denut</strong></div>
                            <div class="col-2"><span class="float-right"
                                                     id="creation_total">{{$tournois->date_debut}}</span></div>
                        </div>
                        <div class="row">
                            <div class="col-10"><strong>Date fin</strong></div>
                            <div class="col-2"><span class="float-right"
                                                     id="creation_worked">{{$tournois->date_fin}}</span></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @foreach($tournois->list_matches() as $key=>$matche)
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <strong>Matche n° {{$key+1}} le {{$matche->date}}</strong>
                </div>

                <div class="row pt-2">
                    <div class=" col bg-success">{{$matche->equipe_1()->name}}</div>
                    <div class=" col bg-warning">Antraineur : @if($matche->equipe_1()->entraineur()) {{$matche->equipe_1()->entraineur()->full_name()}} @endif</div>
                    VS
                    <div class=" col bg-success">{{$matche->equipe_2()->name}}</div>
                    <div class="col bg-warning">Antraineur : @if($matche->equipe_2()->entraineur()) {{$matche->equipe_2()->entraineur()->full_name()}} @endif</div>
                </div>
            </div>
        @endforeach
    @endif
@endsection
