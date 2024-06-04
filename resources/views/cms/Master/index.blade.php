<x-cms_templete_top :data="$data" />

<div class="row">
  <div class="col-md-7">

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

      <div class="card-body">
        <div class="table-responsive">
          <table id="tData" class="table table-striped table-bordered table-hover" style="width:100%">
            <thead>
              <tr>
                @php $cols = count($grid)+1; @endphp
                @foreach($grid as $datagrid)
                <th width="{{$datagrid['width']}}">{{$datagrid['label']}}</th>
                @endforeach
                <th width="8%">ACTION</th>
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
                    <input type="hidden" id="gridPmKey{{$rowIndex}}" name="gridPmKey{{$rowIndex}}" value="{{$pmKey}}">
                    <a onclick="grid_edit({{$pmKey}},{{$primaryKey}})" style=" color: green; padding:4px;max-width: 30px;max-height: 30px;"><i class="icon-pencil" aria-hidden="true"></i></a>
                    <a onclick="grid_delete({{$pmKey}},{{$primaryKey}})" style="color: red; padding:4px;max-width: 30px;max-height: 30px;"><i class="icon-trash" aria-hidden="true"></i></a>
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


    </div>

    <!-- /basic layout -->
  </div>
  <div class="col-md-5">

    <!-- Basic layout-->
    <div class="card">
      <div class="card-header header-elements-inline">
        <h5 class="card-title">Form Input</h5>
        <div class="header-elements">
          <div class="list-icons">
            <a class="list-icons-item" data-action="collapse"></a>
            <!-- <a class="list-icons-item" data-action="reload"></a>
				                		<a class="list-icons-item" data-action="remove"></a> -->
          </div>
        </div>
      </div>

      <div class="card-body">
        <!-- <form action="#"> -->
        <input type="hidden" id="alldata" name="alldata" value="{{json_encode($listdata)}}">
        <input type="hidden" id="formAllField" name="formAllField" value="{{json_encode($form)}}">
        <input type="hidden" id="{{$primaryKey}}" name="{{$primaryKey}}" value="">
        <input type="hidden" id="compId" name="compId" value="{{$compId}}">

        <div class="row">
          @csrf
          @foreach($form as $dataform)
          @if($dataform['type']=='text')
          <div class="col-sm-{{$dataform['col'] ?? 12}}">
            <div class="form-group">
              <label class="form-label"><b>{{$dataform['label']}}</b></label>
              <input type="text" class="form-control" id="{{$dataform['field']}}" name="{{$dataform['field']}}" placeholder="{{$dataform['placeholder']}}">
              <small class="form-text text-muted">{{$dataform['keterangan']}}</small>
            </div>
          </div>
          @elseif($dataform['type']=='hidden')
          <div class="form-group">
            <input type="hidden" class="form-control" id="{{$dataform['field']}}" name="{{$dataform['field']}}" placeholder="{{$dataform['placeholder']}}">
          </div>
          @elseif($dataform['type']=='number')
          <div class="col-sm-{{$dataform['col'] ?? 12}}">
            <div class="form-group">
              <label class="form-label"><b>{{$dataform['label']}}</b></label>
              <input type="number" class="form-control" id="{{$dataform['field']}}" name="{{$dataform['field']}}" placeholder="{{$dataform['placeholder']}}">
              <small class="form-text text-muted">{{$dataform['keterangan']}}</small>
            </div>
          </div>
          @elseif($dataform['type']=='date')
          <div class="col-sm-{{$dataform['col'] ?? 12}}">
            <div class="form-group">
              <label class="form-label"><b>{{$dataform['label']}}</b></label>
              <input type="date" class="form-control" id="{{$dataform['field']}}" name="{{$dataform['field']}}">
              <small class="form-text text-muted">{{$dataform['keterangan']}}</small>
            </div>
          </div>
          @elseif($dataform['type']=='datetime')
          <div class="col-sm-{{$dataform['col'] ?? 12}}">
            <div class="form-group">
              <label class="form-label"><b>{{$dataform['label']}}</b></label>
              <input type="datetime-local" class="form-control" id="{{$dataform['field']}}" name="{{$dataform['field']}}">
              <small class="form-text text-muted">{{$dataform['keterangan']}}</small>
            </div>
          </div>
          @elseif($dataform['type']=='time')
          <div class="col-sm-{{$dataform['col'] ?? 12}}">
            <div class="form-group">
              <label class="form-label"><b>{{$dataform['label']}}</b></label>
              <input type="time" class="form-control" id="{{$dataform['field']}}" name="{{$dataform['field']}}">
              <small class="form-text text-muted">{{$dataform['keterangan']}}</small>
            </div>
          </div>
          @elseif($dataform['type']=='color')
          <div class="col-sm-{{$dataform['col'] ?? 12}}">
            <div class="form-group">
              <label class="form-label"><b>{{$dataform['label']}}</b></label>
              <input type="color" class="form-control" id="{{$dataform['field']}}" name="{{$dataform['field']}}">
              <small class="form-text text-muted">{{$dataform['keterangan']}}</small>
            </div>
          </div>
          @elseif($dataform['type']=='file')
          <div class="col-sm-{{$dataform['col'] ?? 12}}">
            <div class="form-group">
              <label class="form-label"><b>{{$dataform['label']}}</b></label>
              <input type="file" class="form-control-uniform" id="{{$dataform['field']}}" name="{{$dataform['field']}}">
              <small class="form-text text-muted">{{$dataform['keterangan']}}</small>
            </div>
          </div>
          @elseif($dataform['type']=='angka')
          <div class="col-sm-{{$dataform['col'] ?? 12}}">
            <div class="form-group">
              <label class="form-label"><b>{{$dataform['label']}}</b></label>
              <input type="text" class="AutoNumeric angka form-control" id="{{$dataform['field']}}" name="{{$dataform['field']}}" placeholder="{{$dataform['placeholder']}}">
              <small class="form-text text-muted">{{$dataform['keterangan']}}</small>
            </div>
          </div>
          @elseif($dataform['type']=='textarea')
          <div class="col-sm-{{$dataform['col'] ?? 12}}">
            <div class="form-group">
              <label class="form-label"><b>{{$dataform['label']}}</b></label>
              <textarea class="form-control" id="{{$dataform['field']}}" name="{{$dataform['field']}}" cols="20" rows="4" placeholder="{{$dataform['placeholder']}}"></textarea>
              <small class="form-text text-muted">{{$dataform['keterangan']}}</small>
            </div>
          </div>
          @elseif($dataform['type']=='password')
          <div class="col-sm-{{$dataform['col'] ?? 12}}">
            <div class="form-group">
              <label class="form-label"><b>{{$dataform['label']}}</b></label>
              <input type="password" class="form-control" id="{{$dataform['field']}}" name="{{$dataform['field']}}" placeholder="{{$dataform['placeholder']}}" requ>
              <small class="form-text text-muted">{{$dataform['keterangan']}}</small>
            </div>
          </div>
          @elseif($dataform['type']=='combo')
          <div class="col-sm-{{$dataform['col'] ?? 12}}">
            <label class="form-label"><b>{{$dataform['label']}}</b></label>
            <div class="form-group">
              <select name="{{$dataform['field']}}" id="{{$dataform['field']}}" class="form-control {{$dataform['field']}}">
                <option value="">{{$dataform['default']}}</option>
                @foreach($dataform['combodata'] as $key => $val)
                <option value="{{$val['comboValue']}}">{{$val['comboLabel']}}</option>
                @endforeach
              </select>
              <small class="form-text text-muted">{{$dataform['keterangan']}}</small>

              <script>
                $(".{{$dataform['field']}}").select2({
                  placeholder: "{{$dataform['default']}}",
                  minimumResultsForSearch: Infinity
                });
              </script>
            </div>
          </div>
          @elseif($dataform['type']=='autocomplete')
          <div class="col-sm-{{$dataform['col'] ?? 12}}">
            <div class="form-group">
              <label class="form-label"><b>{{$dataform['label']}}</b></label>
              <input type="hidden" id="id{{$dataform['field']}}" name="id{{$dataform['field']}}">
              <input type="hidden" id="kd{{$dataform['field']}}" name="kd{{$dataform['field']}}">
              <input type="hidden" id="nm{{$dataform['field']}}" name="nm{{$dataform['field']}}">
              <select name="{{$dataform['field']}}" id="{{$dataform['field']}}" class="{{$dataform['field']}} form-control" style="width: 100%;">
                <option value="">{{$dataform['default']}}</option>
              </select>
              <small class="form-text text-muted">{{$dataform['keterangan']}}</small>
              <script type="text/javascript">
                $(".{{$dataform['field']}}").on("select2:select", function(e) {
                  $("#id{{$dataform['field']}}").val(e.params.data.id);
                  $("#kd{{$dataform['field']}}").val(e.params.data.kode);
                  $("#nm{{$dataform['field']}}").val(e.params.data.nama);
                }).select2({
                  placeholder: "{{$dataform['default']}}",
                  ajax: {
                    url: "{{$dataform['url']}}?text={{$dataform['text']}}",
                    dataType: 'json',
                    delay: 250,
                    data: function(data) {
                      return {
                        search: data.term,
                      };
                    },
                    processResults: function(response) {
                      return {
                        results: response
                      };
                    },
                    cache: true
                  }
                });
              </script>
            </div>
          </div>
          @elseif($dataform['type']=='multiple')
          <div class="col-sm-{{$dataform['col'] ?? 12}}">
            <div class="form-group">
              <label class="form-label"><b>{{$dataform['label']}}</b></label>
              <select name="{{$dataform['field']}}" id="{{$dataform['field']}}" class="{{$dataform['field']}} form-control" multiple="multiple" style="width: 100%;">
                <option value="">{{$dataform['default']}}</option>
              </select>
              <small class="form-text text-muted">{{$dataform['keterangan']}}</small>
              <script type="text/javascript">
                $(".{{$dataform['field']}}").on("select2:select", function(e) {

                }).select2({
                  placeholder: "{{$dataform['default']}}",
                  ajax: {
                    url: "{{$dataform['url']}}",
                    dataType: 'json',
                    delay: 250,
                    data: function(data) {
                      return {
                        search: data.term,
                      };
                    },
                    processResults: function(response) {
                      return {
                        results: response
                      };
                    },
                    cache: true
                  }
                });
              </script>
            </div>
          </div>
          @endif
          @endforeach
        </div>
        <div class="text-right">
          <button type="submit" class="btn btn-sm btn-primary" onclick="save()"><i class="icon-floppy-disk"> </i> Save</button>
        </div>
        <!-- </form> -->
      </div>
    </div>
    <!-- /basic layout -->

  </div>
</div>



<script type="text/javascript">
  function save() {
    var jenis = document.getElementById('{{$primaryKey}}').value;
    if (jenis == '') {
      saveNew('{{$primaryKey}}');
    } else {
      saveEdit('{{$primaryKey}}');
    }
  }

  function saveNew(primaryKey) {
    var field = document.getElementById('formAllField').value;
    var fieldobj = JSON.parse(field);
    var postdata = {};
    postdata._token = document.getElementsByName('_token')[0].defaultValue;
    postdata.compId = document.getElementById('compId').value;
    for (var j = 0; j < fieldobj.length; j++) {
      var data = document.getElementById(fieldobj[j].field).value;
      var evalText = 'postdata.' + fieldobj[j].field + "='" + data + "'";
      eval(evalText);
    }
    $.ajax({
      type: "POST",
      url: "/{{$mainroute}}",
      data: (postdata),
      dataType: "json",
      async: false,
      success: function(data) {
        if (data.status == 401) {
          alertify.error('Form Wajib Harus diisi');
          return;
        } else {
          alertify.success('Berhasil Disimpan');
          setTimeout(function() {
            window.open("{{$mainroute}}", "_self");
          }, 500);
        }
      },
      error: function(dataerror) {
        console.log(dataerror);
      }
    });

  }

  function saveEdit(primaryKey) {
    console.log('saveEdit');
    var field = document.getElementById('formAllField').value;
    var fieldobj = JSON.parse(field);
    var pkValue = document.getElementById(primaryKey).value;
    var postdata = {};
    postdata._token = document.getElementsByName('_token')[0].defaultValue;
    postdata.compId = document.getElementById('compId').value;

    for (var j = 0; j < fieldobj.length; j++) {
      var data = document.getElementById(fieldobj[j].field).value;
      var evalText = 'postdata.' + fieldobj[j].field + "='" + data + "'";
      eval(evalText);
    }

    $.ajax({
      type: "PUT",
      url: "/{{$mainroute}}/" + pkValue,
      data: (postdata),
      dataType: "json",
      async: false,
      success: function(data) {
        // console.log(data);
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
      error: function(dataerror) {
        console.log(dataerror);
      }
    });

  }

  function grid_edit(id, primaryKey) {
    var data = document.getElementById('alldata').value;
    var dataobj = JSON.parse(data).data;
    for (var i = 0; i < dataobj.length; i++) {
      var a = 'dataobj[i].' + primaryKey.id;
      // console.log(a);
      if (eval(a) == id) {
        var field = document.getElementById('formAllField').value;
        var fieldobj = JSON.parse(field);
        //masukkan PK dulu
        document.getElementById(primaryKey.id).value = id;
        //masukkan field yang lain
        for (var j = 0; j < fieldobj.length; j++) {
          var b = 'dataobj[i].' + fieldobj[j].field;
          // console.log(fieldobj[j].type);
          if (fieldobj[j].type != 'password') {
            if (fieldobj[j].type == 'combo') {
              $("#" + fieldobj[j].field).val(eval(b)).find(':selected').trigger('change');
            } else if (fieldobj[j].type == 'autocomplete') {
              setAutocompleteVal(fieldobj[j].url, eval(b), fieldobj[j].text, fieldobj[j].field);
            } else {
              document.getElementById(fieldobj[j].field).value = eval(b);
            }
          }
        }
      }
    }
  }

  function setAutocompleteVal(api,idx,tx,field) {
    $.ajax({
      type: "GET",
      url: api,
      data: ({
        text: eval(tx),
        search: idx
      }),
      dataType: "json",
      success: function(data) {
        if (data[0].id) {
          // Set selected   
          var $newOption = $("<option selected='selected'></option>").val(data[0].id).text(data[0].text);
          $("#" + field).append($newOption).trigger('change');
        } else {
          $('#' + field).val(null).trigger('change');
        }

      }
    });
  }

  function grid_delete(id, pmkey) {
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
</script>


<x-cms_templete_bottom />