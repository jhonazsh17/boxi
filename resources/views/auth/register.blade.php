@extends('../base-public')

@section('contenedor')
<div class="container" style="margin-top: 80px;">
    <div class="row">
        <div class="col-md-4 ">
            
            <div class="panel panel-default register-panel-default">
                <div class="panel-heading register-panel-heading">
                    <div class="register-panel-titulo">
                        Registrar
                    </div>
                </div>
                <div class="panel-body" style="background-color: #f9f9f9">
                    <a href="{{ url('login/facebook') }}" class="btn btn-customize-fb"><img src="{{ asset('img') }}/facebook-logo-png-white.png" alt="" width="20px" style="right: 70px; position: relative; top:-2px">Ingresa con Facebook</a>
                        <hr >
                        <form role="form" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name">Nombres y Apellidos</label>

                            <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus placeholder="Nombres y Apellidos">

                            @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                           
                        </div>
                        <br>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email">Correo Electrónico</label>

                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required placeholder="Correo Electrónico">

                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        
                        </div>
                        <br>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password">Contraseña</label>

                            <input id="password" type="password" class="form-control" name="password" required placeholder="Contraseña">

                            @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                         
                        </div>
                        <br>

                        <div class="form-group">
                            <label for="password-confirm">Confirmar Contraseña</label>

                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required placeholder="Confirmar Contraseña">
                          
                        </div>
                        <br>

                        <div class="form-group">
                             
                                <button type="submit" class="btn btn-default btn-block btn-md">
                                    Registrar
                                </button>
                            
                        </div>
                    </form>
                        
                    
                   
                </div>
            </div>
        </div>
        <div class="col-md-8" style="padding-left: 0px">
            <img src="{{ asset('img') }}/img-with-login.jpg" alt="" width="100%" height="500px">
        </div>
    </div>
    @include('footer')
</div>
@endsection

@section('scripts')

@endsection
