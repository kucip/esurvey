<x-cms_templete_top :data="$data" />


<div class="row">
  <div class="col-md-12">
    <!-- Basic layout-->
    <div class="card">
      <div class="card-header header-elements-inline">
        <h5 class="card-title">{{$data['page_tittle']??''}}</h5>
        <div class="header-elements">
          <div class="list-icons">
            <form action="/{{$mainroute}}" method="GET">
              <div class="form-group row">
                <div class="input-group">
                  <input type="text" name="search" id="search" value="{{$search ?? ''}}" class="form-control" placeholder="Search Here">
                  <span class="input-group-append">
                    <span class="input-group-text"><i class="icon-search4"></i></span>
                    <span class="input-group-text">
                      <a class="list-icons-item" data-action="collapse"></a>
                    </span>
                  </span>
                </div>
              </div>
            </form>
            <!-- <a class="list-icons-item" data-action="collapse"></a>
            <a class="list-icons-item" data-action="reload"></a> -->
            <!-- <a class="list-icons-item" data-action="remove"></a> -->
          </div>
        </div>
      </div>

      @csrf
      <div class="card-body">
        <div class="table-responsive">
          <table id="tData" class="table table-striped table-bordered table-hover" style="width:100%">
            <thead>
              <tr>
                @php $cols = count($grid)+1; @endphp
                @foreach($grid as $datagrid)
                <th width="{{$datagrid['width']}}">{{$datagrid['label']}}</th>
                @endforeach
                <th width="6%">ACTION</th>
              </tr>
            </thead>
            <tbody>
              @if(!$listdata->isEmpty())
              @php
              $rowIndex=-1;
              @endphp

              @foreach($listdata as $key => $data)
              <tr>
                @php
                $pmKey=$data->$primaryKey;
                $detail=$data->dataDetail;
                $dataSaran=$data->dataSaran;
                $rowIndex ++;
                @endphp

                @foreach($grid as $datagrid)
                @php
                $field=$datagrid['field'];
                $value=$data->$field;
                @endphp
                <td width="{{$datagrid['width'] ?? ''}}" class="{{$datagrid['class'] ?? ''}}">{{$value}} </td>
                @endforeach
                <td>
                  <center>
                    <input type="hidden" id="kritikSaran{{$pmKey}}" name="kritikSaran{{$pmKey}}" value="{{$dataSaran}}">
                    <input type="hidden" id="gridDetail{{$pmKey}}" name="gridDetail{{$pmKey}}" value="{{$detail}}">
                    <input type="hidden" id="gridPmKey{{$rowIndex}}" name="gridPmKey{{$rowIndex}}" value="{{$pmKey}}">
                    <a onclick="grid_detail({{$pmKey}})" style="color: green; padding:4px;max-width: 30px;max-height: 30px;"><i class="icon-list-unordered" aria-hidden="true"></i></a>
                    <a onclick="grid_delete({{$pmKey}})" style="color: red; padding:4px;max-width: 30px;max-height: 30px;"><i class="icon-trash" aria-hidden="true"></i></a>
                  </center>
                </td>
              </tr>
              @endforeach
              @else
              <tr>
                <td colspan="{{$cols}}">
                  <center><i class="fa fa-info-circle"></i> Data Empty </center>
                </td>
              </tr>
              @endif
            </tbody>

          </table>
        </div>
        <br>
        <div class="text-right">
          {{ $listdata->appends(array('search' => $search ?? ''))->links('pagination::bootstrap-4') }}
        </div>
      </div>

        <!-- /info modal -->
    </div>

    <!-- /basic layout -->
  </div>
</div>

<div class="row">
  
  <div id="modal_theme_info" class="modal fade">
    <div class="modal-dialog modal-xl">
      <div class="modal-content" >
        <div class="modal-header bg-info">
          <h6 class="modal-title">Detail Survey</h6>
        </div>
        <div class="col-md-12 modal-body">
          <div class="row">
              <div class="col-md-1 text-semibold">&nbsp;</div>            
              <div class="col-md-7 text-semibold"><h6>Pertanyaan</h6></div>            
              <div class="col-md-4 text-semibold"><h6>Jawaban</h6></div>            
          </div>
          <div id="isiDetail"></div>
          <br>
          <div class="row">
              <div class="col-md-1 text-semibold">&nbsp;</div>            
              <div class="col-md-11 text-semibold"><h6>Kritik & Saran</h6></div>            
          </div>
          <div class="row">
              <div class="col-md-1 text-semibold">&nbsp;</div>            
              <div class="col-md-11 text-semibold" id="isiSaran"></div>            
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-info" data-dismiss="modal">Tutup</button>
        </div>
      </div>
    </div>
  </div>

</div>

<button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modal_theme_info" id="showmodal" style="display: none;">Launch</button>
<script type="text/javascript">
  function grid_delete(id) {
    var postdata = {};
    postdata._token = document.getElementsByName('_token')[0].defaultValue;

    alertify.confirm('Anda Akan Menghapus Data ?',
      function() {
        $.ajax({
        type: "DELETE",
        url: "/{{$mainroute}}/" + id,
        data: (postdata),
        dataType: "json",
        async: false,
        success: function(data) {
          alertify.success('Berhasil Dihapus');
          setTimeout(function() {
            window.open("{{$mainroute}}", "_self");
          }, 500);
        },
        error: function(dataerror) {
          console.log(dataerror);
        }
      });
      },
      function() {
        alertify.dismissAll();
      }).setHeader('<b> Hapus Data !</b> ');

  }

  function grid_detail(id){
    $('#isiDetail').html('');
    $('#isiSaran').html('');
    var detail=JSON.parse(document.getElementById('gridDetail'+id).value);
    var saran=document.getElementById('kritikSaran'+id).value;
    var isi='';
    for(var i=0;i<detail.length;i++){
        isi +='\
                <div class="row" style="margin-top:6px;">\
                    <div class="col-md-1 text-semibold" style="text-align:center">'+(i+1)+'</div>\
                    <div class="col-md-7 text-semibold">'+detail[i].tanya+'</div>\
                    <div class="col-md-4 text-semibold">'+detail[i].jawab+'</div>\
                </div>\
             ';
    }
    $('#isiDetail').html(isi);
    $('#isiSaran').html(saran);
    document.getElementById('showmodal').click();
  }
</script>


<x-cms_templete_bottom />