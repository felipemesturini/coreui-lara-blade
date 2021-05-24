@extends('dashboard.authBase')

@section('content')
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card-group">
                        <div class="card p-4">
                            <div class="card-body">
                                <h1>Login</h1>
                                <p class="text-muted">Sign In to your account</p>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text">
                                        <svg class="c-icon">
                                          <use xlink:href="assets/icons/coreui/free-symbol-defs.svg#cui-user"></use>
                                        </svg>
                                      </span>
                                    </div>
                                    <input class="form-control{{ $errors->has('email') ? ' is-invalid' : ''}}"
                                           type="text"
                                           placeholder="{{ __('E-Mail Address') }}"
                                           name="email" value="{{ old('email') }}" required autofocus>
                                    @if($errors->has('email'))
                                        <div class="invalid-feedback">{{ $errors->first('email') }}</div>
                                    @endif
                                </div>
                                <div class="input-group mb-4">
                                    <div class="input-group-prepend">
                                          <span class="input-group-text">
                                            <svg class="c-icon">
                                              <use
                                                  xlink:href="assets/icons/coreui/free-symbol-defs.svg#cui-lock-locked"></use>
                                            </svg>
                                          </span>
                                    </div>
                                    <input class="form-control{{ $errors->has('password') ? ' is-invalid' : ''}}"
                                           type="password" placeholder="{{ __('Password') }}"
                                           name="password" required>
                                    @if($errors->has('password'))
                                        <div class="invalid-feedback">{{ $errors->first('password') }}</div>
                                    @endif
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <button class="btn btn-primary px-4" type="submit">{{ __('Login') }}</button>
                                    </div>

                                    <div class="col-6 text-right">
                                        <a href="{{ route('password.request') }}"
                                           class="btn btn-link px-0">{{ __('Forgot Your Password?') }}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card text-white bg-primary py-5 d-md-down-none" style="width:44%">
                            <div class="card-body text-center">
                                <div>
                                    <h2>Login</h2>
                                    <p>
                                        Caso ja tenha se cadastrado em nosso sistema, informe os dados de login nos
                                        campos ao lado.
                                        Se ainda nao tiver aos dados clique na links abaixo para se registrar.
                                    </p>
                                    @if (Route::has('password.request'))
                                        <a href="{{ route('register') }}"
                                           class="btn btn-outline-primary active mt-3">{{ __('Register') }}</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

@endsection

@section('javascript')
    <script>
        $(document).ready(() => {
            console.log('JQuery is Ready');
        });
    </script>

@endsection
