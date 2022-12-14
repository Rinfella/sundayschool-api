<x-auth-layout>
    <div class="card">
        <div class="card-body login-card-body">
          <p class="login-box-msg">Sign in to start your session</p>

          <form action="/auth/login" method="post">
            @csrf
            <div class="input-group mb-3">
                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                        placeholder="Enter Email" value="{{ old('email') }}">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-envelope"></span>
                </div>
              </div>
              <div class="invalid-feedback">
                {{$errors->first('email')}}
            </div>
            </div>
            <div class="input-group mb-3">
                <input type="password" class="form-control @error('password') is-invalid @enderror" name="password"
                        placeholder="Enter Password" value="{{ old('password') }}">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-lock"></span>
                </div>
              </div>
              <div class="invalid-feedback">
                {{$errors->first('password')}}
            </div>
            </div>
            <div class="row">
              <div class="col-8">
                <div class="icheck-primary">
                  <input type="checkbox" id="remember">
                  <label for="remember">
                    Remember Me
                  </label>
                </div>
              </div>
              <!-- /.col -->
              <div class="col-4">
                <button type="submit" class="btn btn-primary btn-block">Sign In</button>
              </div>
              <!-- /.col -->
            </div>
          </form>

          <p class="text-center">- OR -</p>


          <div class="social-auth-links text-center mb-3">
            <a href="/auth/google-sign-in" class="btn btn-block btn-success">
              <i class="fab fa-google mr-2"></i> Sign in using Google
            </a>
          </div>

          <div class="social-auth-links text-center mb-3">
            <a href="/auth/google-sign-in" class="btn btn-block btn-danger">
              <i class="fab fa-brands fa-gitlab mr-2"></i> Sign in using Gitlab
              <i class="fa-brands fa-gitlab"></i>
            </a>
          </div>
          <!-- /.social-auth-links -->

          <p class="mb-1">
            <a href="/auth/forgot-password">I forgot my password</a>
          </p>
          <p class="mb-0">
            <a href="/auth/register" class="text-center">Register a new membership</a>
          </p>
        </div>
</x-auth-layout>
