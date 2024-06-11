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
        @csrf
        <input type="hidden" id="compId" value="{{$compId}}">
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
                          <input class="form-control" id="nama" type="text" placeholder="Arjuna Mahesa">
                        </div>
                      </div>
                      <div class="col-lg-6 col-md-6">
                        <div class="form-group mb-30">
                          <label class="font-sm color-text-mutted mb-10" >JENIS KELAMIN</label>
                          <select class="form-control" id="jkelamin">
                              <option value="">-PILIH-</option>
                              <option value="1">Laki-Laki</option>
                              <option value="2">Perempuan</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-lg-6 col-md-6">
                        <div class="form-group mb-30">
                          <label class="font-sm color-text-mutted mb-10">NOMOR HP</label>
                          <input class="form-control" type="text" id="nohp" placeholder="081-1234-5678">
                        </div>
                      </div>
                      <div class="col-lg-6 col-md-6">
                        <div class="form-group mb-30">
                          <label class="font-sm color-text-mutted mb-10">ALAMAT</label>
                          <input class="form-control" type="text" id="alamat" placeholder="JL. Hati Mulia 7 No.11 Kota Kupang - NTT">
                        </div>
                      </div>
                      <div class="col-lg-6 col-md-6">
                        <div class="form-group mb-30">
                          <label class="font-sm color-text-mutted mb-10">UMUR</label>
                          <select class="form-control" id="umur">
                              <option value="">-PILIH-</option>
                              @foreach($umur as $val)
                                  <option value="{{$val->umurId}}">{{$val->umurNama}}</option>                                
                              @endforeach
                          </select>
                        </div>
                      </div>
                      <div class="col-lg-6 col-md-6">
                        <div class="form-group mb-30">
                          <label class="font-sm color-text-mutted mb-10">PENDIDIKAN</label>
                          <select class="form-control" id="pendidikan">
                              <option value="">-PILIH-</option>
                              @foreach($pendidikan as $val)
                                  <option value="{{$val->sekId}}">{{$val->sekLevel}}</option>                                
                              @endforeach
                          </select>
                        </div>
                      </div>
                      <div class="col-lg-6 col-md-6">
                        <div class="form-group mb-30">
                          <label class="font-sm color-text-mutted mb-10">LAYANAN</label>
                          <select class="form-control" id="layanan">
                              <option value="">-PILIH-</option>
                              @foreach($layanan as $val)
                                  <option value="{{$val->layId}}">{{$val->layNama}}</option>                                
                              @endforeach
                          </select>
                        </div>
                      </div>

                      <div class="col-lg-6 col-md-6">
                        <div class="form-group mb-30">
                          <label class="font-sm color-text-mutted mb-10">UNIT KERJA</label>
                          <select class="form-control" id="unitkerja">
                              <option value="">-PILIH-</option>
                              @foreach($unit as $val)
                                  <option value="{{$val->unitId}}">{{$val->unitNama}}</option>                                
                              @endforeach
                          </select>
                        </div>
                      </div>

                      <div class="col-lg-12" style="margin-top: 20px;padding-right: 20px;"> 
                        <div class="alert alert-danger" id="notif" role="alert" style="display: none;"></div>
                      </div>
                      
                      <div class="" id="movescreen"></div>
                      <div class="col-lg-12" style="margin-top: 20px;"> 
                        <div class="form-group">
                          <button class="btn btn-default center" onclick="lanjut()">Lanjut Survey</button>
                          <a href="#movescreen" id="btmovescreen">&nbsp;</a>
                        </div>
                      </div>

                    </div>
                  </div>
                </div>
              </div>
            </div>            
            <div class="section-box" id="boxpertanyaan" name="boxpertanyaan" style="display: none;">
              <div class="container"> 
                <div class="panel-white">
                  <div class="panel-head"> 
                    <h5 style="margin-left:-10px;">Pertanyaan Survey</h5>
                  </div>
                  <div class="row" style="margin-left: 10px;padding-top: 10px;">
                    @php
                      $i=1;
                    @endphp
                    @foreach($pertanyaan as $val)
                      <div class="form-group col-lg-6" style="padding-right: 10px;">
                        <div class="font-sq">{{$i}}</div>
                        <div class="font-sm">{{$val->surPertanyaan}}<input type="hidden" name="idtanya_{{$i}}" id="idtanya_{{$i}}" value="{{$val->surId}}"></div>                          
                        <div class="option"><input type="radio" id="option{{$i}}_1" name="q_{{$i}}" value="1"><label class="radio-label" for="option{{$i}}_1">{{$val->surOpt1}}</label><br></div>
                        <div class="option"><input type="radio" id="option{{$i}}_2" name="q_{{$i}}" value="2"><label class="radio-label" for="option{{$i}}_2">{{$val->surOpt2}}</label><br></div>
                        <div class="option"><input type="radio" id="option{{$i}}_3" name="q_{{$i}}" value="3"><label class="radio-label" for="option{{$i}}_3">{{$val->surOpt3}}</label><br></div>
                        <div class="option"><input type="radio" id="option{{$i}}_4" name="q_{{$i}}" value="4"><label class="radio-label" for="option{{$i}}_4">{{$val->surOpt4}}</label><br></div>
                        <div class="option"><input type="radio" id="option{{$i}}_5" name="q_{{$i}}" value="5"><label class="radio-label" for="option{{$i}}_5">{{$val->surOpt5}}</label><br></div>
                      </div>
                      @php
                        $i++;
                      @endphp
                    @endforeach

                    <div class="form-group col-lg-12" style="padding-right: 20px;">
                      <label class="font-sm">KRITIK DAN SARAN</label>
                      <textarea class="form-control" rows="4" placeholder="Isilah Kritik dan Saran" id="saran"></textarea>
                    </div>

                      <div class="col-lg-12 col-lg-12" style="margin-top: 20px;padding-right: 20px;"> 
                        <div class="alert alert-danger" id="warningjawaban" role="alert" style="display: none;"></div>
                      </div>

                      <div class="form-group col-lg-12" style="margin-top:30px;">
                        <button class="btn btn-default center" onclick="save()">Simpan Survey</button>
                      </div>
                      &nbsp;
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

<script type="text/javascript">

    function lanjut(){
        var nama=document.getElementById("nama").value;
        var jkelamin=document.getElementById("jkelamin").value;
        var nohp=document.getElementById("nohp").value;
        var alamat=document.getElementById("alamat").value;
        var umur=document.getElementById("umur").value;
        var pendidikan=document.getElementById("pendidikan").value;
        var layanan=document.getElementById("layanan").value;
        var unit=document.getElementById("unitkerja").value;

        var txt='';
        document.getElementById("notif").style="display:none";
        $('#notif').html(txt);
        var status=false;
        if(nama==''){
            txt +='- Isian < nama > masih kosong !!!<br>';
            status = true;
        }

        if(jkelamin==''){
            txt +='- Isian < jenis kelamin > masih kosong !!!<br>';
            status = true;
        }

        if(umur==''){
            txt +='- Isian < umur > masih kosong !!!<br>';
            status = true;
        }

        if(pendidikan==''){
            txt +='- Isian < pendidikan > masih kosong !!!<br>';
            status = true;
        }

        if(layanan==''){
            txt +='- Isian < layanan > masih kosong !!!<br>';
            status = true;
        }

        if(unit==''){
            txt +='- Isian < unit > masih kosong !!!<br>';
            status = true;
        }

        if(status){
           document.getElementById("notif").style="display:block";
           $('#notif').html(txt);
           return;
        }

        document.getElementById("btmovescreen").click();
        document.getElementById("boxpertanyaan").style="display:block";
    }

    function save(){

        var nama=document.getElementById("nama").value;
        var jkelamin=document.getElementById("jkelamin").value;
        var nohp=document.getElementById("nohp").value;
        var alamat=document.getElementById("alamat").value;
        var umur=document.getElementById("umur").value;
        var pendidikan=document.getElementById("pendidikan").value;
        var layanan=document.getElementById("layanan").value;
        var unit=document.getElementById("unitkerja").value;
        var saran=document.getElementById("saran").value;

        var postData={};
            postData.dataNama = nama;
            postData.dataKelamin = jkelamin;
            postData.dataHp = nohp;
            postData.dataAlamat = alamat;
            postData.dataUmur = umur;
            postData.dataPendidikan = pendidikan;
            postData.dataLayanan = layanan;
            postData.dataUnit = unit;
            postData.dataSaran = saran;
            postData._token = document.getElementsByName('_token')[0].defaultValue;
            postData.compId = document.getElementById('compId').value || 1;

        var textWarning='';
        document.getElementById("warningjawaban").style="display:none";
        $('#warningjawaban').html(textWarning);
        var status=false;
        for(var i=1;i<=10;i++){
            var text1='postData.dataTanya'+i+'='+document.getElementById('idtanya_'+i).value || '';
            eval(text1);
            var radioEL=document.getElementsByName('q_'+i);
            var radValue=0;
            for(j=0;j<5;j++){
               if(radioEL[j].checked){
                  radValue=j+1;
               }
            }
            if(radValue==0){
               textWarning +='- Pertanyaan nomor #'+i+' belum dijawab !!!<br>';
               status=true;
            }

            var text2='postData.dataJawab'+i+'='+radValue;
            eval(text2);
        }
        
        if(saran.trim()==""){
           textWarning +='- Kritik dan Saran belum diisi !!!<br>';
           status=true;          
        }

        if(status){
           document.getElementById("warningjawaban").style="display:block";
           $('#warningjawaban').html(textWarning);
           return;
        }
        $.ajax({
          type: "POST",
          url: "/savesurvey",
          data: (postData),
          dataType: "json",
          async: false,
          success: function(data) {
            var nama=data.dataNama;
            setTimeout(function() {
              window.open("/thanks?nama="+nama, "_self");
            }, 100);

          },
          error: function(dataerror) {
            console.log(dataerror);
          }
        });

    }

</script>
<x-web_templete_bottom />
