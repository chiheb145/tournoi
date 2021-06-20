<form method="post" action="{{route('equipe.update')}}" class="form-horizontal" id="form_update_equipe">
    @csrf
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modifier l'équipe {{ $equipe->name }}</h5>
        <button type="button" class="close close_btn" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <div class="form-group">
            <label for="equipe" class="col-sm-12  control-label col-form-label">Nom de l'équipe </label>
            <input type="text" class="form-control" name="name" value="{{$equipe->name}}" required>
        </div>


        <div class="form-group">
            <label for="equipe" class="col-sm-12  control-label col-form-label">Antraineur</label>
            <select  name="antraineur_id" class="form-control" >
                <option value="">Sélèctionner</option>
            @foreach($coachs as $coach)
                    <option value="{{$coach->id}}" @if($coach->id==$equipe->antraineur_id) selected @endif>{{$coach->full_name()}}</option>
                @endforeach
            </select>
        </div>

        <input type="hidden" name="equipe_id" value="{{$equipe->id}}">
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-primary post_editer">Modifier</button>
        <button type="button" class="btn btn-secondary close_btn" data-dismiss="modal">Annuler</button>
    </div>
</form>
