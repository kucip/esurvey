<x-cms_templete_top :data="$data" />

<div class="row">
  <div class="col-md-12">
    <!-- Basic layout-->
    <div class="card">
      <div class="card-header header-elements-inline">
        <h5 class="card-title">{{$data['page_tittle']??''}}</h5>
        <div class="header-elements">
          <div class="list-icons">
              <div class="form-group row">
                <div class="input-group">
                  <span class="input-group-append">
                    <button class="input-group-text" id="btnExport" onclick="exportReportToExcel(this)" ><i class="icon-file-excel"></i>&nbsp; Export ke Excel</button>
                    <!-- <button id="btnExport" onclick="exportReportToExcel(this)">EXPORT REPORT</button> -->
                  </span>
                </div>
              </div>
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
                <th width="{{$datagrid['width']}}" rowspan="{{$datagrid['rowspan'] ?? ''}}" colspan="{{$datagrid['colspan'] ?? ''}}">{{$datagrid['label']}}</th>
                @endforeach
              </tr>
            </thead>
            <tbody>
              @if(count($listdata)>0)
              @php
              $rowIndex=-1;
              @endphp

              @foreach($listdata as $key => $data)
              <tr>
                @php
                $rowIndex ++;
                @endphp

                @foreach($grid as $datagrid)
                  @php
                    $field=$datagrid['field'];
                    $value=!empty($data[$field])?$data[$field]:'0';
                  @endphp
                  
                  @if($value!='')
                    @if($value=='&nbsp;')
                      <td width="{{$datagrid['width'] ?? ''}}" class="{{$datagrid['class'] ?? ''}}">&nbsp;</td>
                    @elseif($value=='&nbsp;0')
                      <td width="{{$datagrid['width'] ?? ''}}" class="{{$datagrid['class'] ?? ''}}">0</td>
                    @else
                      <td width="{{$datagrid['width'] ?? ''}}" class="{{$datagrid['class'] ?? ''}}">{{$value}} </td>
                    @endif
                  @endif
                @endforeach
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
      </div>

        <!-- /info modal -->
    </div>

    <!-- /basic layout -->
  </div>
</div>


<script type="text/javascript">

function exportReportToExcel() {
  let table = document.getElementsByTagName("table"); // you can use document.getElementById('tableId') as well by providing id to the table tag
  TableToExcel.convert(table[0], { // html code may contain multiple tables so here we are refering to 1st table tag
    name: 'jumlah-responden-skm.xlsx', // fileName you could use any name
    sheet: {
      name: 'Sheet 1' // sheetName
    }
  });
}

</script>



<x-cms_templete_bottom />