<x-web_templete_top :data="$data" />
<style type="text/css">
    .option{
      margin-top: 5px;
      margin-left: 20px;
    }
    .radio-label{
      margin-left: 10px;
    }
    .font-sq{
      float: inline-start;
      margin-right: 10px;
      margin-left: 0px;
      text-align: left;
    }

    .center {
      margin: 0;
      position: absolute;
      top: 50%;
      left: 50%;
      -ms-transform: translate(-50%, -50%);
      transform: translate(-50%, -50%);
    }

</style>
        
        <div class="row"> 
          <div class="col-xxl-12">
            <div class="section-box">
              <div class="container"> 
                <div class="panel-white">
                  <div class="panel-head"> 
                    <h5>Biodata Responden</h5>
                  </div>
                  <div class="panel-body">

                    <div class="row"> 
                      <div class="col-lg-6 col-md-6">
                        <div class="form-group mb-30"> 
                          <label class="font-sm color-text-mutted mb-10">NAMA LENGKAP</label>
                          <input class="form-control" type="text" placeholder="Arjuna Mahesa">
                        </div>
                      </div>
                      <div class="col-lg-6 col-md-6">
                        <div class="form-group mb-30">
                          <label class="font-sm color-text-mutted mb-10">JENIS KELAMIN</label>
                          <select class="form-control">
                              <option value="">-PILIH-</option>
                              <option value="1">Laki-Laki</option>
                              <option value="2">Perempuan</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-lg-6 col-md-6">
                        <div class="form-group mb-30">
                          <label class="font-sm color-text-mutted mb-10">NOMOR HP</label>
                          <input class="form-control" type="text" placeholder="081-1234-5678">
                        </div>
                      </div>
                      <div class="col-lg-6 col-md-6">
                        <div class="form-group mb-30">
                          <label class="font-sm color-text-mutted mb-10">ALAMAT</label>
                          <input class="form-control" type="text" placeholder="JL. Hati Mulia 7 No.11 Kota Kupang - NTT">
                        </div>
                      </div>

                      <div class="col-lg-12" style="margin-top: 20px;"> 
                        <div class="form-group">
                          <button class="btn btn-default center">Lanjut Survey</button>
                        </div>
                      </div>

                    </div>

                  </div>
                </div>
              </div>
            </div>            
            <div class="section-box">
              <div class="container"> 
                <div class="panel-white">
                  <div class="panel-head"> 
                    <h5 style="margin-left:-10px;">Pertanyaan Survey</h5>
                  </div>
                  <div class="row" style="margin-left: 10px;padding-top: 10px;">
                      <div class="form-group col-lg-6">
                        <div class="font-sq">1.</div>
                        <div class="font-sm">ini adalah pertanyaan survey pertama jbjsd jasbdj ashbdjhasbdjhasbjd ashbd bsdjbsabd jasb dhj?????</div>                          

                        <div class="option"><input type="radio" id="option11" name="q1" value="1"><label class="radio-label" for="option11">ini adalah option 1</label><br></div>
                        <div class="option"><input type="radio" id="option12" name="q1" value="2"><label class="radio-label" for="option12">ini adalah option 2</label><br></div>
                        <div class="option"><input type="radio" id="option13" name="q1" value="3"><label class="radio-label" for="option13">ini adalah option 3</label><br></div>
                        <div class="option"><input type="radio" id="option14" name="q1" value="4"><label class="radio-label" for="option14">ini adalah option 4</label><br></div>
                        <div class="option"><input type="radio" id="option15" name="q1" value="5"><label class="radio-label" for="option15">ini adalah option 5</label><br></div>
                      </div>
                      <div class="form-group col-lg-6">
                        <div class="font-sq">2.</div>
                        <div class="font-sm">ini adalah pertanyaan survey kedua?????</div>
                        <div class="option"><input type="radio" id="option21" name="q2" value="1"><label class="radio-label" for="option21">ini adalah option 1</label><br></div>
                        <div class="option"><input type="radio" id="option22" name="q2" value="2"><label class="radio-label" for="option22">ini adalah option 2</label><br></div>
                        <div class="option"><input type="radio" id="option23" name="q2" value="3"><label class="radio-label" for="option23">ini adalah option 3</label><br></div>
                        <div class="option"><input type="radio" id="option24" name="q2" value="4"><label class="radio-label" for="option24">ini adalah option 4</label><br></div>
                        <div class="option"><input type="radio" id="option25" name="q2" value="5"><label class="radio-label" for="option25">ini adalah option 5</label><br></div>
                      </div>

                      <div class="form-group col-lg-12" style="margin-top:30px;">
                        <button class="btn btn-default center">Simpan Survey</button>
                      </div>
                      &nbsp;
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

<x-web_templete_bottom />
