@include('admin.includes.alerts')
<div class="form-group">
    <label>Nome:</label>
    <input type="text" name="name" value="{{ $user->name ?? old('name') }}" class="form-control" placeholder="Digite o nome">
</div>
<div class="form-group">
    <label>Email:</label>
    <input type="email" name="email" value="{{ $user->email ?? old('email') }}" class="form-control" placeholder="Digite um email">
</div>
<div class="form-group">
    <label>Senha:</label>
    <input type="password" name="password" class="form-control" placeholder="Senha:">
</div>

