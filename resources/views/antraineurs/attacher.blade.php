<form method="post" action="{{route('antraineur.attacher')}}" class="form-horizontal" id="form_update_antraineur">
    @csrf
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Attacher l'antraineur {{ $antraineur->full_name() }} à un équipe</h5>
        <button type="button" class="close close_btn" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">

        <div class="form-group">
            <label for="equipe" class="col-sm-12  control-label col-form-label">Equipe</label>
            <select type="text" class="form-control" name="equipe_id"  required>
                <option value="">Sélèctionner</option>
                @foreach($equipes as $equipe)
                    <option value="{{$equipe->id}}" @if($antraineur->equipe() && $antraineur->equipe()->id==$equipe->id) selected @endif>{{$equipe->name}}</option>
                @endforeach
            </select>
        </div>

        <input type="hidden" name="antraineur_id" value="{{$antraineur->id}}">
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Modifier</button>
        <button type="button" class="btn btn-secondary close_btn" data-dismiss="modal">Annuler</button>
    </div>
</form>
