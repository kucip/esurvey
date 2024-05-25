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
                              <!-- <p class="font-sm text-brand-2">Register </p> -->
                              <h2 class="mt-10 mb-5 text-brand-1">Register</h2>
                              <p class="font-sm text-muted mb-30">Access to all features. No credit card required.</p>
                              <button class="btn social-login hover-up mb-20"><img src="{{url('/')}}/assetsweb/imgs/template/icons/icon-google.svg" alt="jobbox"><strong>Sign up with Google</strong></button>
                              <div class="divider-text-center"><span>Or continue with</span></div>
                            </div>
                            <form class="login-register text-start mt-20" id="form" action="{{url('api/register')}}" method="POST">
                              @csrf
                              @if($message!='')
                                <div class="text-center" style="color:red;margin-bottom: 20px;">{{$message}}</div>
                              @endif
                              <div class="form-group">
                                <label class="form-label" for="input-1">Full Name *</label>
                                <input class="form-control" id="name" type="text" required="" name="name" placeholder="Tony Stark">
                              </div>
                              <div class="form-group">
                                <label class="form-label" for="input-2">Email *</label>
                                <input class="form-control" id="email" type="email" required="" name="email" placeholder="tonystark@gmail.com">
                              </div>
                              <div class="form-group">
                                <label class="form-label" for="input-3">Username *</label>
                                <input class="form-control" id="username" type="text" required="" name="username" placeholder="tonystark">
                              </div>
                              <div class="form-group">
                                <label class="form-label" for="input-4">Password *</label>
                                <input class="form-control" id="password" type="password" required="" name="password" placeholder="******">
                              </div>
                              <div class="form-group">
                                <label class="form-label" for="input-5">Re-Password *</label>
                                <input class="form-control" id="password2" type="password" required="" name="password2" placeholder="******">
                              </div>
                              <div class="login_footer form-group d-flex justify-content-between">
                                <label class="cb-container">
                                  <input type="checkbox"><span class="text-small">Agree our terms and policy</span><span class="checkmark"></span>
                                </label><a class="text-muted" href="#">Lean more</a>
                              </div>
                              <div class="form-group">
                                <button id="button-recaptcha" name="login" class="btn btn-brand-1 hover-up w-100 g-recaptcha" data-sitekey="{{config('services.recaptcha.key')}}" data-callback='onSubmit' data-action='submit'>Submit &amp; Register</button>
                                <!-- <button class="btn btn-brand-1 hover-up w-100" type="submit" name="login">Submit &amp; Register</button> -->
                              </div>
                              <div class="text-muted text-center">Already have an account? <a href="{{url('/')}}/login">Sign in</a></div>
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
