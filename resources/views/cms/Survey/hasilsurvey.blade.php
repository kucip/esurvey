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
              @endphp

              @foreach($listdata as $key => $data)
              <tr>
                @php
                $rowIndex ++;
                @endphp

                @foreach($grid as $datagrid)
                  @php
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
                      @if($value2!='')
                          @if($value2=='&nbsp;')
                            <td width="{{$datagrid2['width'] ?? ''}}" class="{{$datagrid2['class'] ?? ''}}">&nbsp;</td>
                          @else
                            <td width="{{$datagrid2['width'] ?? ''}}" class="{{$datagrid2['class'] ?? ''}}">{{$value2}} </td>
                          @endif
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


<x-cms_templete_bottom />