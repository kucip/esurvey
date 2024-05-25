<x-cms_templete_top :data="$data"/>

<div class="col-md-12">

    <!-- Basic layout-->
    <div class="card">
      <div class="card-header header-elements-inline">
        <h5 class="card-title">{{$data['page_tittle'] ?? ''??''}}</h5>
        <div class="header-elements">
          <div class="list-icons">
            <a class="list-icons-item" data-action="collapse"></a>
            <!-- <a class="list-icons-item" data-action="reload"></a>
				                		<a class="list-icons-item" data-action="remove"></a> -->
          </div>
        </div>
      </div>

      <div class="card-body">
        <!-- Content area -->
        <div class="content d-flex justify-content-center align-items-center">

        <!-- Password recovery form -->
        <div class="login-form">
          <div class="card mb-0">
            <div class="card-body">
              <div class="text-center mb-3">
                <i class="icon-spinner11 icon-2x text-warning border-warning border-3 rounded-round p-3 mb-3 mt-1"></i>
                <h5 class="mb-0">Pemulihan Password</h5>
                <span class="d-block text-muted">Isikan password baru dibawah ini</span>
              </div>

              <input type="hidden" id="alldata" name="alldata" value="{{json_encode($listdata)}}">
              <input type="hidden" id="formAllField" name="formAllField" value="{{json_encode($form)}}">
              <input type="hidden" id="{{$primaryKey}}" name="{{$primaryKey}}" value="{{$primaryKeyData}}">
              @csrf
              @foreach($form as $dataform)
               @if($dataform['type']=='text')
               <!-- <label class="form-label"><b>{{$dataform['label']}}</b></label> -->
                <div class="form-group form-group-feedback form-group-feedback-right">
                  <input type="text" class="form-control" id="{{$dataform['field']}}" name="{{$dataform['field']}}" {{$dataform['readonly']}} placeholder="{{$dataform['placeholder']}}" required value="{{$dataform['data']}}">
                  <div class="form-control-feedback">
                    <i class="icon-user text-muted"></i>
                  </div>
                  <small class="form-text text-muted">{{$dataform['keterangan']}}</small>
                </div>
                @elseif($dataform['type']=='password')
                <div class="form-group form-group-feedback form-group-feedback-right">
                  <input type="password" class="form-control" id="{{$dataform['field']}}" name="{{$dataform['field']}}" {{$dataform['readonly']}} placeholder="{{$dataform['placeholder']}}">
                  <div class="form-control-feedback">
                    <i class="icon-lock text-muted"></i>
                  </div>
                  <small class="form-text text-muted">{{$dataform['keterangan']}}</small>
                </div>
                @endif
              @endforeach
              <button onclick="save()" class="btn bg-blue btn-block"><i class="icon-spinner11 mr-2"></i> Reset password</button>
            </div>
          </div>
        </div>
        <!-- /password recovery form -->

        </div>
        <!-- /content area -->
      </div>
    </div>
    <!-- /basic layout -->

  </div>

<script type="text/javascript">

function save(){
    var pass=document.getElementById('password').value;
    if(pass.length<4){
        alertify.error('Panjang password minimal 4 karakter !!!');
        return;
    }else{
        saveEdit('{{$primaryKey}}');
    }
}

function saveEdit(primaryKey){
    var field=document.getElementById('formAllField').value;
    var fieldobj = JSON.parse(field);
    var pkValue=document.getElementById(primaryKey).value;
    var postdata = {};
        postdata._token = document.getElementsByName('_token')[0].defaultValue;

    for(var j=0;j<fieldobj.length;j++){
        var data=document.getElementById(fieldobj[j].field).value;
        var evalText='postdata.'+fieldobj[j].field+"='"+data+"'";     
        eval(evalText);
    }

    $.ajax({
        type: "PUT",
        url: "/{{$mainroute}}/"+pkValue,
        data:(postdata),
        dataType:"json",
        async: false,
        success:function(data){
          window.open("{{$mainroute}}","_self");
          if (data.status == 401) {
          alertify.error('Form Wajib Harus diisi');
          return;
        } else {
          alertify.success('Berhasil Diupdate');
          setTimeout(function() {
            window.open("{{$mainroute}}", "_self");
          }, 500);
        }
        },
        error:function(dataerror){
          console.log(dataerror);
        }
    });      

}
    
</script>


<x-cms_templete_bottom />
