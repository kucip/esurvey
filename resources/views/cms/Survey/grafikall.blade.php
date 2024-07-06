<x-cms_templete_top :data="$data" />

<script src="{{url('/')}}/assetscms/js/plugins/visualization/echarts/echarts.js"></script>
<script src="{{url('/')}}/assetscms/js/plugins/visualization/echarts/theme/limitless.js"></script>
<script src="{{url('/')}}/assetscms/js/plugins/visualization/echarts/chart/bar.js"></script>
<script src="{{url('/')}}/assetscms/js/plugins/visualization/echarts/chart/line.js"></script>


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
        <label class="form-label" style="margin-top: 8px;margin-left: 20px;"><b>LAYANAN</b></label>
      </div>
      <div class="col-sm-6">
        <div class="form-group">
          <select name="filterLayanan" id="filterLayanan" class="form-control">
            <option value="">--PILIH LAYANAN--</option>
              @foreach($layanan as $key => $val)
                <option value="{{$val->layId}}" @if($selected['layanan']==$val->layId) {{'selected'}} @endif >{{$val->layNama}}</option>
              @endforeach
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
    <input type="hidden" name="dataall" id="dataall" value="{{$listdata}}">
    <div class="card">
      <div class="card-header header-elements-inline">
        <h5 class="card-title">{{$data['page_tittle']??''}}</h5>
      </div>
    </div>
  </div>
</div>


<div class="row">
  <div class="col-md-12" id="listtanya"></div>
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
                    <div class="chart has-fixed-height" id="graph'+i+'"></div>\
                  </div>\
              ';
    }
    $('#listtanya').html(result);

    setTimeout(function(){
        setGraphData(data);
    },1000);
}

function setGraphData(data){
   for(var i=0;i<data.length;i++){
        var chartDom = document.getElementById('graph'+i);
        var myChart = echarts.init(chartDom);
        var option;
        var dataJ=data[i];
        option = {
          xAxis: {
            type: 'category',
            data: [dataJ.surOpt1,dataJ.surOpt2,dataJ.surOpt3,dataJ.surOpt4,dataJ.surOpt5]
          },
          yAxis: {
            type: 'value'
          },
          series: [
            {
              data: [Number(dataJ.dataStat.jawab1), Number(dataJ.dataStat.jawab2), Number(dataJ.dataStat.jawab3), Number(dataJ.dataStat.jawab4), Number(dataJ.dataStat.jawab5)],
              type: 'bar'
            }
          ]
        };
        myChart.setOption(option);
   }
}

function refresh(){

    var bulan = document.getElementById('filterBulan').value;
    var tahun = document.getElementById('filterTahun').value;
    var layanan = document.getElementById('filterLayanan').value;
    var unit = document.getElementById('filterUnit').value;

    var url='{{$mainroute}}?'+'bulan='+bulan+'&tahun='+tahun+'&layanan='+layanan+'&unit='+unit;

    window.open(url,'_self');
}

</script>


<x-cms_templete_bottom />