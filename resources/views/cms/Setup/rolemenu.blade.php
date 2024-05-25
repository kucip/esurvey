<x-cms_templete_top :data="$data" />
<style type="text/css">
    .checkbox.checkbox-switchery {
        margin-bottom: 8px;
        padding-left: 0;
    }
</style>

<div class="row">
    <div class="col-md-4">
        <!-- Basic layout-->
        <div class="card">
            <div class="card-header header-elements-inline">
                <h5 class="card-title">{{$data['page_tittle']??''}}</h5>
                <div class="header-elements">
                    <div class="list-icons">
                        <a class="list-icons-item" data-action="collapse"></a>
                        <!-- <a class="list-icons-item" data-action="reload"></a>
                                    <a class="list-icons-item" data-action="remove"></a> -->
                    </div>
                </div>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table id="tData" class="table table-striped table-bordered table-hover" style="width:100%">
                        <thead>
                            <tr>
                                <th>ROLE</th>
                                <th width="8%">EDIT</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(!$role->isEmpty())
                            @php
                            $rowIndex=-1;
                            @endphp

                            @foreach($role as $key => $data)
                            <tr>
                                @php
                                $pmKey=$data->roleId;
                                $rowIndex ++;
                                @endphp
                                <td>{{$data->roleNama}}</td>
                                <td>
                                    <center>
                                        <a onclick="edit_menu({{$pmKey}})" style=" color: green; padding:4px;max-width: 30px;max-height: 30px;"><i class="icon-pencil" aria-hidden="true"></i></a>
                                    </center>
                                </td>
                            </tr>
                            @endforeach
                            @else
                            <tr>
                                <td colspan="3">
                                    <center><i class="fa fa-info-circle"></i> Data Empty </center>
                                </td>
                            </tr>
                            @endif
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
        <!-- /basic layout -->

    </div>
    <div class="col-md-8">
        <!-- Basic layout-->
        <div class="card">
            <div class="card-header header-elements-inline">
                <h5 class="card-title">List Menu</h5>
                <div class="header-elements">
                    <div class="list-icons">
                        <a class="list-icons-item" data-action="collapse"></a>
                        <!-- <a class="list-icons-item" data-action="reload"></a>
                                    <a class="list-icons-item" data-action="remove"></a> -->
                    </div>
                </div>
            </div>

            <div class="card-body">
                <div class="mb-3">
                    <div class="row">
                        <input type="hidden" id="alldata" name="alldata" value="{{json_encode($rolemenu)}}">
                        <input type="hidden" id="menudata" name="alldata" value="{{json_encode($menu)}}">
                        <input type="hidden" id="roleActive" name="roleActive" value="">
                        <input type="hidden" id="compId" name="compId" value="{{$compId}}">
                        @csrf
                        @if(!$menu->isEmpty())
                        @foreach($menu as $key => $data)
                        <div class="col-md-4" style="padding: 3px;">
                            <div class="form-check form-check-switchery form-check-inline">
                                <label class="form-check-label">
                                    <input type="hidden" name="hidemenu{{$data->menuId}}" id="hidemenu{{$data->menuId}}" value="{{$data->menuId}}">
                                    <input type="checkbox" name="menu{{$data->menuId}}" id="menu{{$data->menuId}}" class="form-check-input-switchery" data-fouc>
                                    @if($data->menuParent==Null)
                                    <p class="text-uppercase font-size-sm font-weight-bold" style="color:black;margin:0%">{{$data->menuNama}}</p><br>
                                    @else
                                    {{$data->menuNama}}
                                    @endif
                                </label>
                            </div>
                        </div>
                        @endforeach
                        @endif

                    </div><br>
                    <div class="text-right">
                        <button type="submit" class="btn btn-sm btn-primary" onclick="save_menu()"><i class="icon-floppy-disk"> </i> Save</button>
                    </div>
                    
                </div>
            </div>
        </div>
        <!-- /basic layout -->

    </div>
</div>

<script type="text/javascript">
    function save_menu() {


        var roleId = document.getElementById('roleActive').value;
        if (roleId == '') {
            alertify.error('Role Belum Dipilih !!!', 'Warning');
            var datamenu = document.getElementById('menudata').value;
            var datamenuobj = JSON.parse(datamenu);
            for (var i = 0; i < datamenuobj.length; i++) {
                var val = document.getElementById('menu' + datamenuobj[i].menuId).checked;
                if (val == true) {
                    document.getElementById('menu' + datamenuobj[i].menuId).click();
                }
            }
            return;
        }

        var datamenu = document.getElementById('menudata').value;
        var datamenuobj = JSON.parse(datamenu);

        var resdata = [];
        for (var i = 0; i < datamenuobj.length; i++) {
            var val = document.getElementById('menu' + datamenuobj[i].menuId).checked;
            if (val == true) {
                var hidemenu = document.getElementById('hidemenu' + datamenuobj[i].menuId).value;
                resdata.push(hidemenu);
            }
        }

        var postdata = {};
        postdata._token = document.getElementsByName('_token')[0].defaultValue;
        postdata.data = resdata;
        postdata.roleId = roleId;

        $.ajax({
            type: "POST",
            url: "/{{$mainroute}}",
            data: (postdata),
            dataType: "json",
            async: false,
            success: function(data) {
                // console.log(data);
                alertify.success('Role Menu Tersimpan');
                setTimeout(function() {
                    window.open("{{$mainroute}}", "_self");
                }, 1000);
                
            },
            error: function(dataerror) {
                console.log(dataerror);
            }
        });

    }


    function edit_menu(roleId) {

        document.getElementById('roleActive').value = roleId;

        var datamenu = document.getElementById('menudata').value;
        var datamenuobj = JSON.parse(datamenu);
        // console.log('menu',datamenuobj);
        for (var i = 0; i < datamenuobj.length; i++) {
            var val = document.getElementById('menu' + datamenuobj[i].menuId).checked;
            // var val = $('#menu'+datamenuobj[i].menuId).is(":checked");
            if (val == true) {
                document.getElementById('menu' + datamenuobj[i].menuId).click();
            }
        }

        setTimeout(function() {
            var data = document.getElementById('alldata').value;
            var dataobj = JSON.parse(data);

            for (var i = 0; i < dataobj.length; i++) {
                if (roleId == dataobj[i].rmRoleId) {
                    document.getElementById('menu' + dataobj[i].rmMenuId).click();
                }
            }
        }, 200);

    }
</script>


<x-cms_templete_bottom />