@include('admin.includes.alerts')
<div class="form-group">
<label>Detalhe:</label>
<input type="text" name="name" value="{{ $details->name ?? old('name') }}" class="form-control" placeholder="Digite o Detalhe">
</div>
<div class="form-group">
<input type="hidden" name="price" value="{{ $plan->id ?? old('id') }}" class="form-control" placeholder="Digite o valor">
</div>

