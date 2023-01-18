@include('admin.includes.alerts')
<div class="form-group">
<label>Nome:</label>
<input type="text" name="name" value="{{ $profile->name ?? old('name') }}" class="form-control" placeholder="Digite o perfil">
</div>
<div class="form-group">
<label>Descrição:</label>
<input type="text" name="description" value="{{ $profile->description ?? old('description') }}" class="form-control" placeholder="Digite a descrição">
</div>

