<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
<style>
body {
  margin: 0;
  padding: 0;
  background-color: #17a2b8;
  height: 100vh;
}
#login .container #login-row #login-column #login-box {
  margin-top: 120px;
  max-width: 600px;
  height: 320px;
  border: 1px solid #9C9C9C;
  background-color: #EAEAEA;
}
#login .container #login-row #login-column #login-box #login-form {
  padding: 20px;
}
#login .container #login-row #login-column #login-box #login-form #register-link {
  margin-top: -85px;
}
</style>
  <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <!------ Include the above in your HEAD tag ---------->
  
  <body>
      <div id="login">
          <h3 class="text-center text-white pt-5">Login form</h3>
          <div class="container">
              <div id="login-row" class="row justify-content-center align-items-center">
                  <div id="login-column" class="col-md-6">
                      <div id="login-box" class="col-md-12">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                              <h3 class="text-center text-info">Entrar no Sistema </h3>
                              <div class="form-group">
                                  <label for="username" class="text-info">Email:</label><br>
                                  <input type="email" name="email" id="username" class="form-control" required autofocus />
                                 
                              </div>
                              <div class="form-group">
                                  <label for="password" class="text-info">Senha:</label><br>
                               
                                  <x-input id="password" class="form-control"
                                  type="password"
                                  name="password"
                                  required autocomplete="current-password" />
                              </div>
                              <div class="form-group">
                                <label for="remember_me" class="inline-flex items-center">
                                    <input id="remember_me" type="checkbox" class="text-info" name="remember">
                                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                                </label>
                                  <br>
                                  <input type="submit" name="submit" class="btn btn-info btn-md" value="logar">
                              </div>
                             
                          </form>
                          <div class="flex items-center justify-end mt-4">
                            @if (Route::has('password.request'))
                                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                                    {{ __('Forgot your password?') }}
                                </a>
                            @endif
            
                          
                        </div>
                          <x-auth-validation-errors class="mb-4" :errors="$errors" />
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </body>
  
