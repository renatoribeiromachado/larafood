@include('admin.includes.alerts')
<div class="form-group">
<label>Nome:</label>
<input type="text" name="name" value="{{ $permission->name ?? old('name') }}" class="form-control" placeholder="Digite a permissão">
</div>
<div class="form-group">
<label>Descrição:</label>
<input type="text" name="description" value="{{ $permission->description ?? old('description') }}" class="form-control" placeholder="Digite a descrição">
</div>

