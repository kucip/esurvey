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
<div class="row">
	<div class="col-md-12">

		<!-- Basic layout-->
		<div class="card">
			<div class="card-header header-elements-inline">
				<h5 class="card-title"></h5>
				<div class="header-elements">
					<div class="list-icons">
						<a class="list-icons-item" data-action="collapse"></a>
					</div>
				</div>
			</div>

			<div class="card-body">
				<div class="center">
					<h4>Selamat Datang, {{$name ?? ''}}</h4>
					<h1>{{$company ?? ''}}</h1>
				</div>
			</div>
		</div>
		<!-- /basic layout -->
	</div>
</div>
<x-cms_templete_bottom />