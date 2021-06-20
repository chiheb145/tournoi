<form method="post" action="{{route('tournoi.update')}}" class="form-horizontal" id="form_update_tournoi">
    @csrf
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modifier le tournoi {{ $tournoi->name }}</h5>
        <button type="button" class="close close_btn" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <div class="form-group">
            <label for="tournoi" class="col-sm-12  control-label col-form-label">Nom du tournoi </label>
            <input type="text" class="form-control" name="name" value="{{$tournoi->name}}" required>
        </div>


        <div class="form-group">
            <label for="tournoi" class="col-sm-12  control-label col-form-label">Date début</label>
            <input type="date" name="date_debut" class="form-control" id="date_debut" value="{{$tournoi->date_debut}}">
        </div>
        <div class="form-group">
            <label for="tournoi" class="col-sm-12  control-label col-form-label">Date fin</label>
            <input type="date" name="date_fin" class="form-control" id="date_fin" value="{{$tournoi->date_fin}}">
        </div>
        <input type="hidden" name="tournoi_id" value="{{$tournoi->id}}">
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-primary post_editer">Modifier</button>
        <button type="button" class="btn btn-secondary close_btn" data-dismiss="modal">Annuler</button>
    </div>
</form>
