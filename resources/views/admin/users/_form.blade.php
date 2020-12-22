<div class="form-group col-md-12">
    <br/>
    <label>Foydalanuvchi nomi</label>
    {{Form::text('firstname', $user->firstname??null, ['class' => 'form-control'])}}
    <label>Foydalanuvchi familiyasi</label>
    {{Form::text('lastname', $user->s_name??null, ['class' => 'form-control'])}}
    <label>Foydalanuvchi otasining ismi</label>
    {{Form::text('surname', $user->l_name??null, ['class' => 'form-control'])}}
    <label>Foydalanuvchi emaili</label>
    {{Form::email('email', $user->email??null, ['class' => 'form-control'])}}
    @if(!isset($user))
        <div class="form-group">
            <label>Foydalanuvchi paroli</label>
            {{Form::password('password', ['class' => 'form-control'])}}
        </div>
    @endif
    <label>Rol:</label>
    {{Form::select('role_id', [''=>'','1' => 'Admin', '2' => 'Dasturchi', '4' => 'Client'], $user->role_id??null,['class' => 'form-control'])}}
    <label>Foydalanuvchi logini</label>
    {{Form::text('login', $user->login??null, ['class' => 'form-control'])}}
    <label>Foydalanuvchi tel.raqami</label>
    {{Form::text('phone', $user->phone??null, ['class' => 'form-control'])}}
</div>
