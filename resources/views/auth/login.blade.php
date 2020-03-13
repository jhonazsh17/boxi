@extends('../base-public')

@section('contenedor')
<div class="container" style="margin-top: 80px;">

    <div class="row">
        <div class="col-md-4 col-md-offset-4">

            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="text-center">
                        Ingresar
                    </div>
                </div>
                <div class="panel-body" style="background-color: #f9f9f9">
                        <a href="{{ url('login/facebook') }}" class="btn btn-customize-fb"><img src="{{ asset('img') }}/facebook-logo-png-white.png" alt="" width="20px" style="right: 70px; position: relative; top:-2px">Ingresa con Facebook</a>
                        <hr >
        

                       
                        <form  role="form" method="POST" action="{{ route('login') }}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email">Correo Electronico</label>
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus placeholder="Correo Electronico">

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                                
                            </div>
                            <br>

                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="password" >Contraseña</label>
                                <input id="password" type="password" class="form-control" name="password" required placeholder="Contraseña">

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                                
                            </div>

                            {{-- <div class="form-group">
                                <div class="col-md-8 col-md-offset-2">
                                    <div class="checkbox text-center">
                                        <label>
                                            <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Recordar mi Cuenta
                                        </label>
                                    </div>
                                </div>
                            </div> --}}
                            <br>

                            <div class="form-group">
                                
                                        <button type="submit" class="btn btn-block btn-default btn-md">
                                            Ingresar
                                        </button>
                                    
                                    
                                    
                                    
                            </div>
                        </form>
                        <hr>
                        <p style="color:#464646">¿No tienes una Cuenta en <b>BOXI</b>?, <a href="{{ url('/register') }}">¡Registrate aquí!</a></p>
                    </div>
                    
                
            </div>
        </div>

        
    </div>

    @include('footer')
</div>
@endsection

@section('scripts')

@endsection
