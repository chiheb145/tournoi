@extends('layouts.app2')

@section('content')


    <div id="main-wrapper">


        <div class="page-wrapper">

            <div class="row justify-content-center pt-2">
                <div class=" col-3 bg-success">
                    <h4 class=" center-block" style="text-align: center">Gestion des tournois</h4>
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
                           data-toggle="modal" data-target="#addTournoi" href="">Ajouter tournoi</a>

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
                                        <th>Tournoi</th>
                                        <th>Début </th>
                                        <th>Fin </th>
                                        <th >Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($tournois as $tournoi)

                                        <tr id="tournoi_{{$tournoi->id}}">
                                            <td>{{$loop -> index+1 }}</td>
                                            <td id="name_{{$tournoi->id}}">{{$tournoi->name}}</td>
                                            <td id="date_debut_{{$tournoi->id}}">{{$tournoi->date_debut}}</td>
                                            <td id="date_fin_{{$tournoi->id}}">{{$tournoi->date_fin}}</td>
                                            <td >
                                                <button class="btn btn-danger delete-tournoi" value="{{$tournoi->id}}"><i class="fas fa-trash" aria-hidden="true"></i>
                                                </button>
                                                <a class="btn btn-secondary fas fa-eye" href="{{route('tournoi.show',$tournoi->id)}}"></a>
                                                <a class="btn btn-secondary m-2 editer_tournoi"
                                                   data_tournoi="{{$tournoi->id}}" href="#" title="Modifier"><i
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
        <div class="modal" id="modal_editer_tournoi" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content content_editer">

                </div>
            </div>
        </div>

        <div class="modal fade" id="addTournoi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Ajouter tournoi</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="post" action="{{route('tournoi.store')}}" class="form-horizontal"
                          enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <label class="control-label col-form-label">Nom</label>
                            <input type="text" class="form-control" name="name">

                            <label class="control-label col-form-label">Date Début</label>
                            <input type="date" class="form-control" name="date_debut" required>

                            <label class="control-label col-form-label">Date Fin</label>
                            <input type="date" class="form-control" name="date_fin">

                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Ajouter</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal fade" id="tournoiDeleteModal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="userDeleteModalLabel">Supprimer tournoi</h4>
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" id="modal_user_delete">
                        <form id="modalFormData2" name="modalFormData2" class="form-horizontal" novalidate="">
                            <div class="form-group">
                                <div class="col-sm-12">
                                    Veuillez-vous supprimer cette tournoi <span id="user_name2"></span>?
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" id="btn-delete" value="delete"><i
                                class="fas fa-trash" aria-hidden="true"></i> Supprimer
                        </button>
                        <button type="button" class="btn btn-basic" id="btn-cancel2" value="delete">Annuler</button>

                        <input type="hidden" id="tournoi_idd" name="tournoi_idd" value="0">
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
        $(document).on('click', '.delete-tournoi', function () {
            var tournoi_id = $(this).val();
            $('#tournoi_idd').val(tournoi_id);
            $('#tournoiDeleteModal').modal('show');
        });
        $('#btn-delete').on('click',function () {

            var tournoi_id = $('#tournoi_idd').val();

            var formData = {

                tournoi_id: tournoi_id,
            };

            $('#tournoiDeleteModal').modal('hide');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                url: '/tournois/tournoi_delete',
                data: formData,
                dataType: 'json',
                success: function (data) {console.log(data);
                    $( '#tournoi_'+tournoi_id).remove();
                    if (data.errors == null) {
                        $("#msg_success").html("Tournoi supprimé avec succès");
                        $("#msg_success").show().delay(5000).fadeOut();
                    }
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
        });
        $('#btn-cancel2').click(function () {
            $('#tournoiDeleteModal').modal('hide');
        });

        $(document).on('click', '.editer_tournoi', function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('#modal_editer_tournoi').hide();
            var formData = {
                tournoi_id: $(this).attr('data_tournoi'),
            };
            $.ajax({
                type: "POST",
                url: "{{route('tournoi.edit')}}",
                data: formData,
                dataType: 'json',
                success: function (response) {
                    $('.content_editer').html(response.html);
                    $('#modal_editer_tournoi').show();
                }
            });

        });
        $(document).on('click', '.close_btn', function () {
            $('#modal_editer_tournoi').hide();
        });
        $(document).on('click', '.post_editer', function (e) {
            e.preventDefault();
            //console.log($('#form_update_leave').serializeArray());
            $('#modal_editer_tournoi').hide();
            $.ajax({
                type: 'POST',
                url: $('#form_update_tournoi').attr('action'),
                data: $('#form_update_tournoi').serializeArray(),
                dataType: 'json',
                success: function (response) {
                    $('#name_' + response.id).html(response.name);
                    $('#date_debut_' + response.id).html(response.date_debut);
                    $('#date_fin_' + response.id).html(response.date_fin);
                },
            });
        });
    </script>
@endsection
