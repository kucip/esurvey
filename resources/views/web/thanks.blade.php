<x-web_templete_top/>

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
                      <h2 class="mt-10 mb-5 text-brand-1">Data Survey Tersimpan</h2>
                      <img src="{{url('/')}}/images/savesuccess.png" style="max-width: 200px;">
                      <p class="font-sm text-muted mb-30">Terima kasih {{$nama}} telah berpartisipasi dalam survey ini.</p>
                      <button class="btn social-login hover-up mb-20" onclick="back()"><img src="{{url('/')}}/images/back.png" style="max-width: 30px;margin-right: 14px;"> <strong> Kembali ke Halaman Survey</strong></button>
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
</div>
<script type="text/javascript">
  function back(){
      window.open("/", "_self");    
  }
</script>
<x-web_templete_bottom />

