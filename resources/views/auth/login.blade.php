@extends('auth.contenido')

@section('login')
<section class="login-content">
    <div class="login-box">
        <div class="login-logo">
            <img src="img/logo-ordonez.png" class="img-responsive">
        </div>
        <div class="login-box-body">
            <p class="login-box-msg">Acceder al Sistema</p>
            <form class="was-validated" method="post" action="{{route('login')}}">
                {{csrf_field()}}
                    <div class="form-group">
                        <label class="control-label">USUARIO</label>
                        <div class="inner-addon right-addon {{$errors->has('usuario' ? 'is-invalid' : '')}}">
                            <i class="glyphicon glyphicon-user"></i>
                            <input type="text" value="{{old('usuario')}}" name="usuario" id="usuario" class="form-control" placeholder="Ingrese usuario" />
                            <!--Mostrar el error-->
                            {!!$errors->first('usuario','<span class="invalid-feedback">:message</span>')!!}
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">CONTRASEÑA</label>
                        <div class="inner-addon right-addon" {{$errors->has('password' ? 'is-invalid' : '')}}>
                            <i class="glyphicon glyphicon-lock"></i>
                            <input type="password" name="password" id="password" class="form-control" placeholder="Ingrese contraseña" />
                            <!--MOSTRAR EL ERROR-->
                            {!!$errors->first('password','<span class="invalid-feedback">:message</span>')!!}
                        </div>
                    </div>

                    <div class="form-group btn-container">
                        <button type="submit" id="ingresar" class="btn btn-primary btn-block"><i class="glyphicon glyphicon-share"></i> ENTRAR</button>
                    </div>
            </form>
        </div>
    </div>
</section>
<!--VALIDACIÓN Y MOSTRAR FOCUS AL INPUT CON JQUERY-->
<script type="text/javascript">
    $(document).ready(function(){
        $("input[name='usuario']").focus();
        @if($errors->first('usuario'))
            $("input[name='usuario']").focus();
        @elseif($errors->first('password'))
            $("input[name='password']").focus();
        @endif
    });
</script>

@endsection

