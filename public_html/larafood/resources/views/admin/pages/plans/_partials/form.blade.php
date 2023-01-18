@include('admin.includes.alerts')
<div class="form-group">
<label>Nome:</label>
<input type="text" name="name" value="{{ $plan->name ?? old('name') }}" class="form-control" placeholder="Digite o Plano">
</div>
<div class="form-group">
<label>Preço:</label>
<input type="text" name="price" value="{{ $plan->price ?? old('price') }}" class="form-control" placeholder="Digite o valor">
</div>
<div class="form-group">
<label>Descrição:</label>
<input type="text" name="description" value="{{ $plan->description ?? old('description') }}" class="form-control" placeholder="Digite a descrição">
</div>

