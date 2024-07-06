<x-cms_templete_top :data="$data" />

<div class="row">
      <div class="col-sm-2">
        <label class="form-label" style="margin-top: 8px;margin-left: 20px;"><b>PERIODE</b></label>
      </div>
      <div class="col-sm-3">
        <div class="form-group">
          <select name="filterBulan" id="filterBulan" class="form-control">
            <option value="">--PILIH BULAN--</option>
            <option value="1" @if($selected['bulan']==1) {{'selected'}} @endif>JANUARI</option>
            <option value="2" @if($selected['bulan']==2) {{'selected'}} @endif >FEBRUARI</option>
            <option value="3" @if($selected['bulan']==3) {{'selected'}} @endif >MARET</option>
            <option value="4" @if($selected['bulan']==4) {{'selected'}} @endif >APRIL</option>
            <option value="5" @if($selected['bulan']==5) {{'selected'}} @endif >MEI</option>
            <option value="6" @if($selected['bulan']==6) {{'selected'}} @endif >JUNI</option>
            <option value="7" @if($selected['bulan']==7) {{'selected'}} @endif >JULI</option>
            <option value="8" @if($selected['bulan']==8) {{'selected'}} @endif >AGUSTUS</option>
            <option value="9" @if($selected['bulan']==9) {{'selected'}} @endif >SEPTEMBER</option>
            <option value="10" @if($selected['bulan']==10) {{'selected'}} @endif >OKTOBER</option>
            <option value="11" @if($selected['bulan']==11) {{'selected'}} @endif >NOVEMBER</option>
            <option value="12" @if($selected['bulan']==12) {{'selected'}} @endif >DESEMBER</option>
          </select>
        </div>
      </div>

      <div class="col-sm-3">      
        <div class="form-group">
          <select name="filterTahun" id="filterTahun" class="form-control">
            <option value="">--PILIH TAHUN--</option>
            <option value="2024" @if($selected['tahun']==2024) {{'selected'}} @endif >2024</option>
            <option value="2025" @if($selected['tahun']==2025) {{'selected'}} @endif >2025</option>
            <option value="2026" @if($selected['tahun']==2026) {{'selected'}} @endif >2026</option>
            <option value="2027" @if($selected['tahun']==2027) {{'selected'}} @endif >2027</option>
            <option value="2028" @if($selected['tahun']==2028) {{'selected'}} @endif >2028</option>
          </select>
        </div>
      </div>  
      <div class="col-sm-4">      
      </div>  

      <div class="col-sm-2">
        <label class="form-label" style="margin-top: 8px;margin-left: 20px;"><b>UNIT</b></label>
      </div>
      <div class="col-sm-6">
        <div class="form-group">
          <select name="filterUnit" id="filterUnit" class="form-control">
            <option value="">--PILIH UNIT--</option>
              @foreach($unit as $key => $val)
                <option value="{{$val->unitId}}" @if($selected['unit']==$val->unitId) {{'selected'}} @endif >{{$val->unitNama}}</option>
              @endforeach
          </select>
        </div>
      </div>
      <div class="col-sm-4">      
      </div>  

      <div class="col-sm-2">
        <label class="form-label" style="margin-top: 8px;margin-left: 20px;">&nbsp;</label>
      </div>
      <div class="col-sm-6">
        <div class="form-group">
          <button type="submit" class="btn btn-sm btn-primary" onclick="refresh()"><i class="icon-reload-alt"> </i> Tampilkan </button>
        </div>
      </div>
      <div class="col-sm-4">      
      </div>  

</div>
<p>&nbsp;<p>

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
              <tr>
                @foreach($grid2 as $datagrid2)
                <th width="{{$datagrid2['width']}}">{{$datagrid2['label']}}</th>
                @endforeach
              </tr>
            </thead>
            <tbody>
              @if(count($listdata)>0)
              @php
              $rowIndex=-1;
              $colIndex=-1;
              @endphp

              @foreach($listdata as $key => $data)
              <tr>
                @php
                $rowIndex ++;
                $colIndex=-1;
                @endphp

                @foreach($grid as $datagrid)
                  @php
                    $colIndex ++;
                    $field=$datagrid['field'];
                    $value=!empty($data[$field])?$data[$field]:'';
                    $col=isset($datagrid['colspan'])?$datagrid['colspan']:'';
                  @endphp
                  @if($col!='' and $col > 0)
                    @foreach($grid2 as $datagrid2)
                      @php
                        $field2=$datagrid2['field'];
                        $value2=!empty($data[$field2])?$data[$field2]:'';
                      @endphp

                          @if($data['colspanidx']==$colIndex) 
                            @php $colspan=$data['colspan']; @endphp                     
                          @else
                            @php $colspan=''; @endphp
                          @endif

                          @if($value2!='xxx')
                            <td width="{{$datagrid2['width'] ?? ''}}" class="{{$datagrid2['class'] ?? ''}}" colspan="{{$colspan ?? ''}}">{{$value2}} </td>
                          @endif

                    @endforeach
                  @endif
                  
                  @if($value!='')

                    @if($value=='&nbsp;')
                      <td width="{{$datagrid['width'] ?? ''}}" class="{{$datagrid['class'] ?? ''}}"></td>
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

<input type="hidden" id="datagraph" value="{{$datagraph}}">
<div class="row">
  <div class="col-md-12">

      <div class="card">
        <div class="card-header header-elements-inline">
          <h5 class="card-title">Grafik Nilai IKM</h5>
        </div>
        <div class="chart has-fixed-height" id="graph"></div>
      </div>
    

  </div>
</div>


<script type="text/javascript">

$(document).ready(function() {
    var data=JSON.parse(document.getElementById('datagraph').value);
    setGraphData(data)
});

function setGraphData(data){

    var chartDom = document.getElementById('graph');
    var myChart = echarts.init(chartDom);
    var option;
    option = {
      xAxis: {
        type: 'category',
        data: [data.dataUnsur1,data.dataUnsur2,data.dataUnsur3,data.dataUnsur4,data.dataUnsur5,data.dataUnsur6,data.dataUnsur7,data.dataUnsur8,data.dataUnsur9]
      },
      yAxis: {
        type: 'value'
      },
      series: [
        {
          data: [data.dataJawab1.toFixed(2),data.dataJawab2.toFixed(2),data.dataJawab3.toFixed(2),data.dataJawab4.toFixed(2),data.dataJawab5.toFixed(2),data.dataJawab6.toFixed(2),data.dataJawab7.toFixed(2),data.dataJawab8.toFixed(2),data.dataJawab9.toFixed(2)],
          type: 'bar',
          color: 'blue',
          showBackground: true,
          backgroundStyle: {
              color: 'rgba(200, 200, 200, 0.8)'
          },
        }
      ]
    };
    myChart.setOption(option);
}


function exportReportToExcel() {
  let table = document.getElementsByTagName("table"); // you can use document.getElementById('tableId') as well by providing id to the table tag
  TableToExcel.convert(table[0], { // html code may contain multiple tables so here we are refering to 1st table tag
    name: 'data-hasil-survey.xlsx', // fileName you could use any name
    sheet: {
      name: 'Sheet 1' // sheetName
    }
  });
}

function refresh(){

    var bulan = document.getElementById('filterBulan').value;
    var tahun = document.getElementById('filterTahun').value;
    var unit = document.getElementById('filterUnit').value;

    var url='{{$mainroute}}?'+'bulan='+bulan+'&tahun='+tahun+'&unit='+unit;

    window.open(url,'_self');
}

</script>



<x-cms_templete_bottom />