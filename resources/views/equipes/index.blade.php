@extends('layouts.app2')

@section('content')


    <div id="main-wrapper">


        <div class="page-wrapper">

            <div class="row justify-content-center pt-2">
                <div class=" col-3 bg-success">
                    <h4 class=" center-block" style="text-align: center">Gestion des équipes</h4>
                </div>
            </div>

            <div class="row">
                <div id="msg_success" class="alert alert-success" style="display: none">
                </div>
            </div>
            @if(session()->has('success'))
                <div class="container-fluid">
                    <div class="row pt-2">

                        <div class="col-12 alert alert-success">
                            {{ session()->get('success') }}
                        </div>
                    </div>
                </div>

            @endif
            @if(session()->has('error'))
                <div class="container-fluid">
                    <div class="row pt-2">

                        <div class="col-12 alert alert-error">
                            {{ session()->get('error') }}
                        </div>
                    </div>
                </div>

            @endif
            <div class="container-fluid">

                <div class="row">
                    <div class="col-md-12 m-1">
                        <a class="btn btn-secondary float-right"
                           data-toggle="modal" data-target="#addEquipe" href="">Ajouter équipe</a>

                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="card ">
                            <div class="card-body">

                                <table id="zero_config" class="table table-bordered ">
                                    <thead>
                                    <tr >
                                        <th>#</th>
                                        <th>Equipe</th>
                                        <th>Antraineur </th>
                                        <th>Joueurs </th>
                                        <th >Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($equipes as $equipe)

                                        <tr id="equipe_{{$equipe->id}}">
                                            <td>{{$loop -> index+1 }}</td>
                                            <td id="name_{{$equipe->id}}">{{$equipe->name}}</td>
                                            <td id="antraineur_{{$equipe->id}}">@if($equipe->antraineur_id){{$equipe->entraineur()->full_name()}}@endif</td>
                                            <td >
                                                <ul>
                                                    @foreach($equipe->joueurs() as $joueur)
                                                        <li>{{$joueur->full_name()}}</li>
                                                    @endforeach

                                                </ul>

                                            </td>
                                            <td >
                                                <button class="btn btn-danger delete-equipe" value="{{$equipe->id}}"><i class="fas fa-trash" aria-hidden="true"></i>
                                                </button>
                                                <a class="btn btn-secondary m-2 editer_equipe"
                                                   data_equipe="{{$equipe->id}}" href="#" title="Modifier"><i
                                                        class="fas fa-edit" style="color: white;font-size: 13px; width: 15px;"></i></a>
                                            </td>

                                        </tr>
                                    @endforeach
                                    </tbody>

                                </table>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="modal" id="modal_editer_equipe" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content content_editer">

                </div>
            </div>
        </div>

        <div class="modal fade" id="addEquipe" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Ajouter équipe</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="post" action="{{route('equipe.store')}}" class="form-horizontal"
                          enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <label class="control-label col-form-label">Nom</label>
                            <input type="text" class="form-control" name="name">

                            <label class="control-label col-form-label">Antraineur</label>
                            <select type="text" class="form-control" name="antraineur_id" >
                                <option value="">Sélèctionner</option>
                            @foreach($antraineurs as $antraineur)
                                    <option value="{{$antraineur->id}}">{{$antraineur->full_name()}}</option>
                                @endforeach
                            </select>

                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Ajouter</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal fade" id="equipeDeleteModal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="userDeleteModalLabel">Supprimer équipe</h4>
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" id="modal_user_delete">
                        <form id="modalFormData2" name="modalFormData2" class="form-horizontal" novalidate="">
                            <div class="form-group">
                                <div class="col-sm-12">
                                    Veuillez-vous supprimer cet équipe <span id="user_name2"></span>?
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" id="btn-delete" value="delete"><i
                                class="fas fa-trash" aria-hidden="true"></i> Supprimer
                        </button>
                        <button type="button" class="btn btn-basic" id="btn-cancel2" value="delete">Annuler</button>

                        <input type="hidden" id="equipe_idd" name="equipe_idd" value="0">
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('javascript')

    <script>
        $('#zero_config').DataTable({
            "destroy": true,//use for reinitialize datatable
            "order": [0, "desc"],
            responsive: true,
            "language": {
                "sProcessing": "Traitement en cours...",
                "sSearch": "Rechercher&nbsp;:",
                "sLengthMenu": "Afficher _MENU_ &eacute;l&eacute;ments",
                "sInfo": "Affichage de l'&eacute;l&eacute;ment _START_ &agrave; _END_ sur _TOTAL_ &eacute;l&eacute;ments",
                "sInfoEmpty": "Affichage de l'&eacute;l&eacute;ment 0 &agrave; 0 sur 0 &eacute;l&eacute;ment",
                "sInfoFiltered": "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",
                "sInfoPostFix": "",
                "sLoadingRecords": "Chargement en cours...",
                "sZeroRecords": "Aucun &eacute;l&eacute;ment &agrave; afficher",
                "sEmptyTable": "Aucune donn&eacute;e disponible dans le tableau",
                "oPaginate": {
                    "sFirst": "Premier",
                    "sPrevious": "Pr&eacute;c&eacute;dent",
                    "sNext": "Suivant",
                    "sLast": "Dernier"
                },
                "oAria": {
                    "sSortAscending": ": activer pour trier la colonne par ordre croissant",
                    "sSortDescending": ": activer pour trier la colonne par ordre d&eacute;croissant"
                },
                "select": {
                    "rows": {
                        _: "%d lignes séléctionnées",
                        0: "Aucune ligne séléctionnée",
                        1: "1 ligne séléctionnée"
                    }
                }
            },
        });


    </script>
    <script>
        $(document).on('click', '.delete-equipe', function () {
            var equipe_id = $(this).val();
            $('#equipe_idd').val(equipe_id);
            $('#equipeDeleteModal').modal('show');
        });
        $('#btn-delete').on('click',function () {

            var equipe_id = $('#equipe_idd').val();

            var formData = {

                equipe_id: equipe_id,
            };

            $('#equipeDeleteModal').modal('hide');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                url: '/equipes/equipe_delete',
                data: formData,
                dataType: 'json',
                success: function (data) {console.log(data);
                    $( '#equipe_'+equipe_id).remove();
                    if (data.errors == null) {
                        $("#msg_success").html("équipe supprimé avec succès");
                        $("#msg_success").show().delay(5000).fadeOut();
                    }
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
        });
        $('#btn-cancel2').click(function () {
            $('#equipeDeleteModal').modal('hide');
        });

        $(document).on('click', '.editer_equipe', function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('#modal_editer_equipe').hide();
            var formData = {
                equipe_id: $(this).attr('data_equipe'),
            };
            $.ajax({
                type: "POST",
                url: "{{route('equipe.edit')}}",
                data: formData,
                dataType: 'json',
                success: function (response) {
                    $('.content_editer').html(response.html);
                    $('#modal_editer_equipe').show();
                }
            });

        });
        $(document).on('click', '.close_btn', function () {
            $('#modal_editer_equipe').hide();
        });
        $(document).on('click', '.post_editer', function (e) {
            e.preventDefault();
            //console.log($('#form_update_leave').serializeArray());
            $('#modal_editer_equipe').hide();
            $.ajax({
                type: 'POST',
                url: $('#form_update_equipe').attr('action'),
                data: $('#form_update_equipe').serializeArray(),
                dataType: 'json',
                success: function (response) {
                    $('#name_' + response.id).html(response.name);
                    if(response.antraineur_id !=null){
                        $('#antraineur_' + response.id).html(response.antraineur_id);
                    }
                },
            });
        });
    </script>
@endsection
