<x-web_templete_top :data="$data" />

        
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
                          <label class="font-sm color-text-mutted mb-10">Nama Lengkap</label>
                          <input class="form-control" type="text" placeholder="Arjuna Mahesa">
                        </div>
                      </div>
                      <div class="col-lg-6 col-md-6">
                        <div class="form-group mb-30">
                          <label class="font-sm color-text-mutted mb-10">Email</label>
                          <input class="form-control" type="text" placeholder="arjuna.mahesa@gmail.com">
                        </div>
                      </div>
                      <div class="col-lg-6 col-md-6">
                        <div class="form-group mb-30">
                          <label class="font-sm color-text-mutted mb-10">Nomor HP</label>
                          <input class="form-control" type="text" placeholder="081-1234-5678">
                        </div>
                      </div>
                      <div class="col-lg-6 col-md-6">
                        <div class="form-group mb-30">
                          <label class="font-sm color-text-mutted mb-10">Alamat</label>
                          <input class="form-control" type="text" placeholder="JL. Hati Mulia No.11C Kota Kupang - NTT">
                        </div>
                      </div>

                      <div class="col-lg-12"> 
                        <div class="form-group mt-10">
                          <button class="btn btn-default btn-brand icon-tick">Lanjut Survey</button>
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
                    <h5>Pertanyaan Survey</h5>
                  </div>
                  <div class="row" style="padding-left: 20px;">
                    <div class="col-lg-12">
                      <ol type="1">
                        <li>
                            <div class="form-group">
                              <label class="font-sm">ini adalah pertanyaan survey pertama?????</label>
                              <div><input type="radio" id="option1" name="q1" value="1"><label for="option1">ini adalah option 1</label><br></div>
                              <div><input type="radio" id="option2" name="q1" value="2"><label for="option2">ini adalah option 2</label><br></div>
                              <div><input type="radio" id="option3" name="q1" value="3"><label for="option3">ini adalah option 3</label><br></div>
                              <div><input type="radio" id="option4" name="q1" value="4"><label for="option4">ini adalah option 4</label><br></div>
                              <div><input type="radio" id="option5" name="q1" value="5"><label for="option5">ini adalah option 5</label><br></div>
                            </div>
                        </li>
                        <li>
                            <div class="form-group">
                              <label class="font-sm">ini adalah pertanyaan survey kedua?????</label>
                              <div><input type="radio" id="option1" name="q2" value="1"><label for="option1">ini adalah option 1</label><br></div>
                              <div><input type="radio" id="option2" name="q2" value="2"><label for="option2">ini adalah option 2</label><br></div>
                              <div><input type="radio" id="option3" name="q2" value="3"><label for="option3">ini adalah option 3</label><br></div>
                              <div><input type="radio" id="option4" name="q2" value="4"><label for="option4">ini adalah option 4</label><br></div>
                              <div><input type="radio" id="option5" name="q2" value="5"><label for="option5">ini adalah option 5</label><br></div>
                            </div>
                        </li>
                      </ol>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

<x-web_templete_bottom />
