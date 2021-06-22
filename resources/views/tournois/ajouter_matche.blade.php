<form method="post" action="{{route('matche.store')}}" class="form-horizontal" id="form_store_matche">
    @csrf
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ajouter un matche au tournoi {{$tournoi->name}}</h5>
        <button type="button" class="close close_btn" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">

        <div class="form-group">
            <label for="equipe" class="col-sm-12  control-label col-form-label">Equipe 1</label>
            <select type="text" class="form-control" name="equipe_one"  required>
                <option value="">Sélèctionner</option>
                @foreach($equipes as $equipe)
                    <option value="{{$equipe->id}}" >{{$equipe->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="equipe" class="col-sm-12  control-label col-form-label">Equipe 2</label>
            <select type="text" class="form-control" name="equipe_two"  required>
                <option value="">Sélèctionner</option>
                @foreach($equipes as $equipe)
                    <option value="{{$equipe->id}}">{{$equipe->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="equipe" class="col-sm-12  control-label col-form-label">Date</label>
            <input type="date" min="{{$tournoi->date_debut}}" max="{{$tournoi->date_fin}}"  class="form-control" name="date"  required>
        </div>
        <input type="hidden" name="tournoi_id" value="{{$tournoi->id}}">
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Ajouter</button>
        <button type="button" class="btn btn-secondary close_btn" data-dismiss="modal">Annuler</button>
    </div>
</form>

