<x-auth-layout>
<div class="card">
    <div class="card-body register-card-body">
      <p class="login-box-msg">Register a new membership</p>
      <form action="/auth/register" method="post">
        @csrf
        <div class="input-group mb-3">
          <input
            type="text"
            class="form-control @error('name') is-invalid @enderror"
            name="name"
            placeholder="Full name"
            value="{{old('name')}}">

          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
          <div class="invalid-feedback">
            {{$errors->first('name')}}
          </div>
        </div>
        <div class="input-group mb-3">
          <input
            type="text"
            class="form-control @error('fathers_name') is-invalid @enderror"
            name="fathers_name"
            placeholder="Father's name"
            value="{{old('fathers_name')}}">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
          <div class="invalid-feedback">
            {{$errors->first('fathers_name')}}
          </div>
        </div>
        <div class="input-group mb-3">
          <input
            type="text"
            class="form-control @error('phone_number') is-invalid @enderror"
            name="phone_number"
            placeholder="Mobile number"
            value="{{old('phone_number')}}">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-phone"></span>
            </div>
          </div>
          <div class="invalid-feedback">
            {{$errors->first('phone_number')}}
          </div>
        </div>
        <div class="input-group mb-3">
          <input
            type="email"
            class="form-control @error('email') is-invalid @enderror"
            name="email"
            placeholder="Email"
            value="{{old('email')}}">
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
          <input
            type="password"
            class="form-control @error('password') is-invalid @enderror"
            name="password"
            placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
          <div class="invalid-feedback">
            {{$errors->first('password')}}
          </div>
        </div>
        <div class="input-group mb-3">
          <input
            type="password"
            class="form-control @error('password_confirmation') is-invalid @enderror"
            name="password_confirmation"
            placeholder="Retype password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
          <div class="invalid-feedback">
            {{$errors->first('password_confirmation')}}
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox"
              class="form-check-input @error('terms') is-invalid @enderror"
              name="terms"
              id="agreeTerms"
              value="yes">
              <label class="form-check-label" for="agreeTerms">
               I agree to the <a href="#">terms</a>
              </label>
              <div class="invalid-feedback">
                You have to agree before submitting!
              </div>
            </div>
          </div>

          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Register</button>
          </div>

        </div>
      </form>

      <div class="social-auth-links text-center">
        <p>- OR -</p>
        <a href="#" class="btn btn-block btn-danger">
          <i class="fab fa-google mr-2"></i>
          Sign up using Google
        </a>
      </div>

      <a href="/auth/login" class="text-center">I already have a membership</a>
    </div>
    <!-- /.form-box -->
</div><!-- /.card -->
</x-auth-layout>
