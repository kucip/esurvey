<x-cms_templete_top :data="$data" />

<script src="{{url('/')}}/assetscms/js/plugins/visualization/echarts/echarts.js"></script>
<script src="{{url('/')}}/assetscms/js/plugins/visualization/echarts/theme/limitless.js"></script>
<script src="{{url('/')}}/assetscms/js/plugins/visualization/echarts/chart/bar.js"></script>
<script src="{{url('/')}}/assetscms/js/plugins/visualization/echarts/chart/line.js"></script>

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

</script>


<x-cms_templete_bottom />