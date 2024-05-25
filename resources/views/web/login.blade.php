<x-web_templete_top :data="$data" />

        <script>
          function onSubmit(token) {
            document.getElementById("form").submit();
          }
        </script>

        <div class="row"> 
          <div class="col-lg-12"> 
            <div class="section-box">
              <div class="container"> 
                <div class="panel-white mb-30">
                  <div class="box-padding">               
                    <div class="login-register"> 
                      <div class="row login-register-cover pb-250">
                        <div class="col-lg-5 col-md-5 col-sm-12 mx-auto">
                          <div class="form-login-cover">
                            <div class="text-center">
                              <h2 class="mt-10 mb-5 text-brand-1">Member Login</h2>
                              <p class="font-sm text-muted mb-30">Access to all features. No credit card required.</p>
                              <button class="btn social-login hover-up mb-20"><img src="{{url('/')}}/assetsweb/imgs/template/icons/icon-google.svg" alt="jobbox"><strong>Sign in with Google</strong></button>
                              <div class="divider-text-center"><span>Or continue with</span></div>
                            </div>
                            <form name="form" id="form" class="login-register text-start mt-20" action="{{url('/')}}/api/weblogin" method="POST">
                              @csrf
                              @if($message!='')
                                <div class="text-center" style="color:red;">{{$message}}</div>
                              @endif
                              <div class="form-group">
                                <label class="form-label" for="input-1">Email Address *</label>
                                <input class="form-control" id="email" type="text" required="" name="email" placeholder="tonystark@gmail.com">
                              </div>
                              <div class="form-group">
                                <label class="form-label" for="input-4">Password *</label>
                                <input class="form-control" id="password" type="password" required="" name="password" placeholder="************">
                              </div>
                              <div class="login_footer form-group d-flex justify-content-between">
                                <label class="cb-container">
                                  <input type="checkbox"><span class="text-small">Remenber me</span><span class="checkmark"></span>
                                </label><a class="text-muted" href="#">Forgot Password</a>
                              </div>
                              <div class="form-group">
                                <button id="button-recaptcha" name="login" class="btn btn-brand-1 hover-up w-100 g-recaptcha" data-sitekey="{{config('services.recaptcha.key')}}" data-callback='onSubmit' data-action='submit'>Login</button>
                              </div>
                              <div class="text-muted text-center">Don't have an Account? <a href="{{url('/')}}/register">Sign up</a></div>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
<x-web_templete_bottom />

