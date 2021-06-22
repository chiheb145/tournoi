<form method="post" action="{{route('joueur.update')}}" class="form-horizontal" id="form_update_joueur">
    @csrf
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modifier l'équipe {{ $joueur->name }}</h5>
        <button type="button" class="close close_btn" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <div class="form-group">
            <label for="equipe" class="col-sm-12  control-label col-form-label">Nom</label>
            <input type="text" class="form-control" name="first_name" value="{{$joueur->first_name}}" required>
        </div>

        <div class="form-group">
            <label for="equipe" class="col-sm-12  control-label col-form-label">Prénom</label>
            <input type="text" class="form-control" name="last_name" value="{{$joueur->last_name}}" required>
        </div>

        <input type="hidden" name="joueur_id" value="{{$joueur->id}}">
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-primary post_editer">Modifier</button>
        <button type="button" class="btn btn-secondary close_btn" data-dismiss="modal">Annuler</button>
    </div>
</form>
