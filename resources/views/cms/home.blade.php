<x-cms_templete_top :data="$data" />
<style>
h1 {
  color: #373a39;
  font-weight: 300;
  font-size: 100px;
  text-transform: uppercase;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
  pointer-events: none;
}

.center {
  margin: auto;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  width: 100%;
  height: 50%;
}
</style>

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

<input type="hidden" id="datalayanan" value="{{$layanan}}">
<input type="hidden" id="databar" value="{{$databar}}">

<div class="row">
	<div class="col-md-6">
        <div class="chart has-fixed-height" id="dashboardpie"></div>	
	</div>

	<div class="col-md-6">
        <div class="chart has-fixed-height" id="dashboardbar"></div>	
	</div>

</div>


<script type="text/javascript">

$(document).ready(function() {
    var data=JSON.parse(document.getElementById('datalayanan').value);

        var chartDom = document.getElementById('dashboardpie');
        var myChart = echarts.init(chartDom);
        var option;
				option = {
				    backgroundColor: '#ffffff',

				    title: {
				        text: 'Kategori Per Jenis Layanan',
				        left: 'center',
				        top: 20,
				        textStyle: {
				            color: '#101010'
				        }
				    },

				    tooltip: {
				        trigger: 'item',
				        formatter: '{a} <br/>{b} : {c} ({d}%)'
				    },

				    visualMap: {
				        show: false,
				        min: 80,
				        max: 600,
				        inRange: {
				            colorLightness: [0, 20]
				        }
				    },
				    series: [
				        {
				            name: 'Nilai per Layanan',
				            type: 'pie',
				            radius: '55%',
				            center: ['50%', '50%'],
				            data: [
				                {value: data[0].ikm, name: data[0].layanan},
				                {value: data[1].ikm, name: data[1].layanan},
				                {value: data[2].ikm, name: data[2].layanan},
				            ].sort(function (a, b) { return a.value - b.value; }),
				            roseType: 'radius',
				            label: {
				                color: 'rgba(10, 10, 10, 0.8)'
				            },
				            labelLine: {
				                lineStyle: {
				                    color: 'rgba(10, 10, 10, 0.8)'
				                },
				                smooth: 0.2,
				                length: 2,
				                length2: 20
				            },
				            itemStyle: {
				                color: '#ff1d17',
				                shadowBlur: 200,
				                shadowColor: 'rgba(0, 0, 0, 0.6)'
				            },

				            animationType: 'scale',
				            animationEasing: 'elasticOut',
				            animationDelay: function (idx) {
				                return Math.random() * 200;
				            }
				        }
				    ]
				};
        myChart.setOption(option);

		    var data=JSON.parse(document.getElementById('databar').value);
        var chartDom = document.getElementById('dashboardbar');
        var myChart = echarts.init(chartDom);
        var option;
        
		    option = {
				    title: {
				        text: 'Nilai IKM Per Unsur',
				        left: 'center',
				        top: 20,
				        textStyle: {
				            color: '#101010'
				        }
				    },

				    tooltip: {
				        trigger: 'item',
				        formatter: '{a} <br/>{b} : {c}'
				    },

			      xAxis: {
			        type: 'category',
			        data: [data.dataUnsur1,data.dataUnsur2,data.dataUnsur3,data.dataUnsur4,data.dataUnsur5,data.dataUnsur6,data.dataUnsur7,data.dataUnsur8,data.dataUnsur9]
			      },
			      yAxis: {
			        type: 'value'
			      },
			      series: [
			        {
		            name: 'Nilai IKM per Unsur',
			          data: [data.dataJawab1.toFixed(2),data.dataJawab2.toFixed(2),data.dataJawab3.toFixed(2),data.dataJawab4.toFixed(2),data.dataJawab5.toFixed(2),data.dataJawab6.toFixed(2),data.dataJawab7.toFixed(2),data.dataJawab8.toFixed(2),data.dataJawab9.toFixed(2)],
			          type: 'bar',
			          color: 'blue',
			          showBackground: true,
			          backgroundStyle: {
			              color: 'rgba(200, 200, 200, 0.8)'
			          },
		            itemStyle: {
		                color: '#ff1d17',
		                shadowBlur: 100,
		                shadowColor: 'rgba(200, 0, 0, 0.3)'
		            },

			        }
			      ]
			    };

        myChart.setOption(option);

});


function refresh(){
    var bulan = document.getElementById('filterBulan').value;
    var tahun = document.getElementById('filterTahun').value;
    var unit = document.getElementById('filterUnit').value;
    var url='{{$mainroute}}?'+'bulan='+bulan+'&tahun='+tahun+'&unit='+unit;
    window.open(url,'_self');
}	
</script>

<x-cms_templete_bottom />