@include('admin.includes.alerts')
<div class="form-group">
<label>Nome:</label>
<input type="text" name="name" value="{{ $category->name ?? old('name') }}" class="form-control" placeholder="Digite a categoria">
</div>
<div class="form-group">
<label>Descrição:</label>
<input type="text" name="description" value="{{ $category->description ?? old('description') }}" class="form-control" placeholder="Digite a descrição">
</div>

