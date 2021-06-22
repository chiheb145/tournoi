<form method="post" action="{{route('antraineur.update')}}" class="form-horizontal" id="form_update_antraineur">
    @csrf
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modifier l'antraineur {{ $antraineur->name }}</h5>
        <button type="button" class="close close_btn" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <div class="form-group">
            <label for="antraineur" class="col-sm-12  control-label col-form-label">Nom</label>
            <input type="text" class="form-control" name="first_name" value="{{$antraineur->first_name}}" required>
        </div>

        <div class="form-group">
            <label for="antraineur" class="col-sm-12  control-label col-form-label">Prénom</label>
            <input type="text" class="form-control" name="last_name" value="{{$antraineur->last_name}}" required>
        </div>

        <input type="hidden" name="antraineur_id" value="{{$antraineur->id}}">
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-primary post_editer">Modifier</button>
        <button type="button" class="btn btn-secondary close_btn" data-dismiss="modal">Annuler</button>
    </div>
</form>
