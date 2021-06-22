@extends('layouts.app2')

@section('content')


    <div id="main-wrapper">


        <div class="page-wrapper">

            <div class="row justify-content-center pt-2">
                <div class=" col-3 bg-success">
                    <h4 class=" center-block" style="text-align: center">Gestion des antraineurs</h4>
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
                           data-toggle="modal" data-target="#addAntraineur" href="">Ajouter antraineur</a>

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
                                        <th>Nom</th>
                                        <th>Prénom</th>
                                        <th>Equipe </th>
                                        <th >Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($antraineurs as $antraineur)

                                        <tr id="antraineur_{{$antraineur->id}}">
                                            <td>{{$loop -> index+1 }}</td>
                                            <td id="first_name_{{$antraineur->id}}">{{$antraineur->first_name}}</td>
                                            <td id="last_name_{{$antraineur->id}}">{{$antraineur->last_name}}</td>
                                            <td id="equipe_{{$antraineur->id}}">@if($antraineur->equipe() != null){{$antraineur->equipe()->name}}@endif</td>

                                            <td >
                                                <button class="btn btn-danger delete-antraineur" value="{{$antraineur->id}}"><i class="fas fa-trash" aria-hidden="true"></i>
                                                </button>
                                                <a class="btn btn-secondary m-2 editer_antraineur"
                                                   data_antraineur="{{$antraineur->id}}" href="#" title="Modifier"><i
                                                        class="fas fa-edit" style="color: white;font-size: 13px; width: 15px;"></i></a>

                                                <a class="btn btn-secondary m-2 attacher_antraineur"
                                                   data_antraineur="{{$antraineur->id}}" href="#" title="Attacher"><i
                                                        class="fas fa-plus" style="color: white;font-size: 13px; width: 15px;"></i>Attacher</a>
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
        <div class="modal" id="modal_editer_antraineur" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content content_editer">

                </div>
            </div>
        </div>
        <div class="modal" id="modal_attacher_antraineur" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content content_attacher">

                </div>
            </div>
        </div>

        <div class="modal fade" id="addAntraineur" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Ajouter antraineur</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="post" action="{{route('antraineurs.store')}}" class="form-horizontal"
                          enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <label class="control-label col-form-label">Nom</label>
                            <input type="text" class="form-control" name="first_name">

                            <label class="control-label col-form-label">prénom</label>
                            <input type="text" class="form-control" name="last_name">
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Ajouter</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal fade" id="antraineurDeleteModal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="userDeleteModalLabel">Supprimer antraineur</h4>
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" id="modal_user_delete">
                        <form id="modalFormData2" name="modalFormData2" class="form-horizontal" novalidate="">
                            <div class="form-group">
                                <div class="col-sm-12">
                                    Veuillez-vous supprimer cet antraineur <span id="user_name2"></span>?
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" id="btn-delete" value="delete"><i
                                class="fas fa-trash" aria-hidden="true"></i> Supprimer
                        </button>
                        <button type="button" class="btn btn-basic" id="btn-cancel2" value="delete">Annuler</button>

                        <input type="hidden" id="antraineur_idd" name="antraineur_idd" value="0">
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
        $(document).on('click', '.delete-antraineur', function () {
            var antraineur_id = $(this).val();
            $('#antraineur_idd').val(antraineur_id);
            $('#antraineurDeleteModal').modal('show');
        });
        $('#btn-delete').on('click',function () {

            var antraineur_id = $('#antraineur_idd').val();

            var formData = {

                antraineur_id: antraineur_id,
            };

            $('#antraineurDeleteModal').modal('hide');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                url: '/antraineurs/antraineur_delete',
                data: formData,
                dataType: 'json',
                success: function (data) {console.log(data);
                    $( '#antraineur_'+antraineur_id).remove();
                    if (data.errors == null) {
                        $("#msg_success").html("antraineur supprimé avec succès");
                        $("#msg_success").show().delay(5000).fadeOut();
                    }
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
        });
        $('#btn-cancel2').click(function () {
            $('#antraineurDeleteModal').modal('hide');
        });

        $(document).on('click', '.editer_antraineur', function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('#modal_editer_antraineur').hide();
            var formData = {
                antraineur_id: $(this).attr('data_antraineur'),
            };
            $.ajax({
                type: "POST",
                url: "{{route('antraineur.edit_antraineur')}}",
                data: formData,
                dataType: 'json',
                success: function (response) {
                    $('.content_editer').html(response.html);
                    $('#modal_editer_antraineur').show();
                }
            });

        });
        $(document).on('click', '.attacher_antraineur', function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('#modal_attacher_antraineur').hide();
            var formData = {
                antraineur_id: $(this).attr('data_antraineur'),
            };
            $.ajax({
                type: "POST",
                url: "{{route('antraineur.attacher_antraineur')}}",
                data: formData,
                dataType: 'json',
                success: function (response) {
                    $('.content_attacher').html(response.html);
                    $('#modal_attacher_antraineur').show();
                }
            });

        });
        $(document).on('click', '.close_btn', function () {
            $('#modal_editer_antraineur').hide();
            $('#modal_attacher_antraineur').hide();

        });
        $(document).on('click', '.post_editer', function (e) {
            e.preventDefault();
            //console.log($('#form_update_leave').serializeArray());
            $('#modal_editer_antraineur').hide();
            $.ajax({
                type: 'POST',
                url: $('#form_update_antraineur').attr('action'),
                data: $('#form_update_antraineur').serializeArray(),
                dataType: 'json',
                success: function (response) {
                    $('#first_name_' + response.id).html(response.first_name);
                    $('#last_name_' + response.id).html(response.last_name);


                },
            });
        });
    </script>
@endsection
