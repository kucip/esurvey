<x-cms_templete_top :data="$data" />


<div class="row">
  <div class="col-md-12">
    @csrf
    <input type="hidden" name="dataall" id="dataall" value="{{$listdata}}">

    <div class="card">
      <div class="card-header header-elements-inline">
        <h5 class="card-title">{{$data['page_tittle']??''}}</h5>
      </div>
    </div>

    <div id="listtanya"></div>

  </div>
</div>


<script type="text/javascript">
$(document).ready(function() {
    var data=JSON.parse(document.getElementById('dataall').value);
    listPertanyaan(data)
});

function listPertanyaan(data){
    var result='';
    for(var i=0;i<data.length;i++){
        result +='\
                  <div class="card">\
                    <div class="card-header header-elements-inline">\
                      <h5>'+data[i].surPertanyaan+'</h5>\
                    </div>\
                    <div class="card-body">\
                    </div>\
                  </div>\
              ';
    }
    $('#listtanya').html(result);
    console.log(data);

}

</script>


<x-cms_templete_bottom />