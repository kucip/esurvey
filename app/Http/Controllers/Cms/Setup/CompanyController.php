<?php

namespace App\Http\Controllers\Cms\Setup;

use App\Http\Controllers\Cms\Controllermaster;
use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\Menu;
use App\Models\Role;
use App\Models\Rolemenu;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Session;
use Validator;
use DB;
use Image;
use Input;

class CompanyController extends Controllermaster
{
    public function __construct()
    {

        $this->model = new Company;
        $this->menu = new Menu;
        $this->role = new Role;
        $this->rolemenu = new Rolemenu;
        $this->user = new User;

        $this->compStatus = Session::get('compStatus');
        $this->primaryKey = 'compId';
        $this->mainroute = 'company';
        $this->mandatory = array(
            'compLogo' => 'max:1000',
            'compNama' => 'required',
            'compPemilik' => 'required',
            'compStatus' => 'required',
        );
        $this->status = [
            array(
                "comboValue" => 1,
                "comboLabel" => "Administrator Utama",
            ),
            array(
                "comboValue" => 2,
                "comboLabel" => "Administrator Umum"
            ),
        ];

        $this->grid = array(
            array(
                'label' => 'LOGO',
                'field' => 'compLogo',
                'type' => 'image',
                'width' => '20%',
                'class' => 'center'
            ),
            array(
                'label' => 'NAMA',
                'field' => 'compNama',
                'type' => 'text',
                'width' => '30%'
            ),
            array(
                'label' => 'PEMILIK',
                'field' => 'compPemilik',
                'type' => 'text',
                'width' => ''
            ),
            array(
                'label' => 'DETAIL',
                'field' => 'compDetail',
                'type' => 'text',
                'width' => ''
            ),
            array(
                'label' => 'STATUS',
                'field' => 'status',
                'type' => 'text',
                'width' => ''
            ),
        );
        $this->form = array(
            array(
                'label' => 'NAMA',
                'field' => 'compNama',
                'type' => 'text',
                'placeholder' => 'Masukan Nama',
                'keterangan' => '* Wajib Diisi'
            ),
            array(
                'label' => 'PEMILIK',
                'field' => 'compPemilik',
                'type' => 'text',
                'placeholder' => 'Masukan Pemilik',
                'keterangan' => '* Wajib Diisi'
            ),
            array(
                'label' => 'DETAIL',
                'field' => 'compDetail',
                'type' => 'text',
                'placeholder' => 'Masukan Detail',
                'keterangan' => '* Wajib Diisi'
            ),
            array(
                'label' => 'STATUS',
                'field' => 'compStatus',
                'type' => 'combo',
                'combodata' => $this->status,
                'default' => 'Pilih Status',
                'keterangan' => '* Wajib Diisi'
            ),
            array(
                'label' => 'LOGO',
                'field' => 'compLogo',
                'type' => 'image',
                // 'col'=>6,
                'placeholder' => '',
                'keterangan' => 'Max 1 Mb'
            ),
        );
    }

    public function index()
    {
        if (trim(Session::get('email')) == '' or $this->checkRouteAuth() == 2) {
            $wallidx = rand(1, 7);
            $data = array(
                'wallidx' => $wallidx,
                'message' => 'Anda telah logout dari system.',
            );
            return view('login', $data);
        } else {

            if ($this->compStatus == 1) {
                $search = !empty($_GET['search']) ? $_GET['search'] : '';
                if ($search == '') {
                    $listdata = $this->model->select(
                        '*',
                        DB::raw('if(compStatus = 1,"Administrator Utama",
                                if(compStatus = 2,"Administrator Umum",
                                "")) as status')
                    )
                        ->latest()
                        ->paginate(15);
                } else {
                    $listdata = $this->model->select(
                        '*',
                        DB::raw('if(compStatus = 1,"Administrator Utama",
                            if(compStatus = 2,"Administrator Umum",
                            "")) as status')
                    )
                        ->where('compNama', 'like', '%' . $search . '%')
                        ->latest()
                        ->paginate(15);
                }
            } else {

                $search = !empty($_GET['search']) ? $_GET['search'] : '';
                if ($search == '') {
                    $listdata = $this->model->select(
                        '*',
                        DB::raw('if(compStatus = 1,"Administrator Utama",
                                if(compStatus = 2,"Administrator Umum",
                                "")) as status')
                    )
                        ->where('compId', '=', Session::get('compId'))
                        ->latest()
                        ->paginate(15);
                } else {
                    $listdata = $this->model->select(
                        '*',
                        DB::raw('if(compStatus = 1,"Administrator Utama",
                            if(compStatus = 2,"Administrator Umum",
                            "")) as status')
                    )
                        ->where('compNama', 'like', '%' . $search . '%')
                        ->where('compId', '=', Session::get('compId'))
                        ->latest()
                        ->paginate(15);
                }
            }

            $data = array(
                'authmenu' => $this->getusermenu(),
                'company' => Session::get('compNama'),
                'logo' => Session::get('companyLogo'),
                'detail' => Session::get('companyDetail'),
                'name' => Session::get('name'),
                'namelong' => Session::get('email'),
                'logo' => Session::get('compLogo'),
                'detail' => Session::get('compDetail'),
                'compstatus' => Session::get('compStatus'),
                'compstatusmng' => Session::get('compStatusMng'),
                'page_tittle' => 'Master Company',
                'page_active' => 'Master Company',
                'grid' => $this->grid,
                'form' => $this->form,
                'listdata' => $listdata,
                'primaryKey' => $this->primaryKey,
                'mainroute' => $this->mainroute,
                'code' => 0,
            );
            return view('cms.Setup.company', $data)->with('data', $data);
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), $this->mandatory, [
            'compLogo.max' => 402
        ]); // $this->mainroute

        if ($validator->fails()) {
            $err = $validator->messages();

            if ($err->first('compLogo') == '402') {
                $messages = [
                    'data' => $validator->errors(),
                    'status' => 402,
                ];
            } else {
                $messages = [
                    'data' => $validator->errors(),
                    'status' => 401,
                ];
            }
            return response()->json($messages);
        }

        if (method_exists($this, 'beforeStore')) {
            $this->beforeStore($request);
        }
        $img = $this->resizeCropImage($request->file('compLogo'), 129, 142);
        // $img = base64_encode(file_get_contents($request->file('compLogo')));
        $resultdata =  $this->model->create([
            'compNama' => $request->compNama,
            'compPemilik' => $request->compPemilik,
            // 'compKategori' => $request->compKategori,
            'compStatus' => $request->compStatus,
            'compDetail' => $request->compDetail,
            'compLokasi' => $request->compLokasi,
            'compBpjsId' => $request->compBpjsId,
            // 'compLogo' => 'data:image/png;base64, '.$img.''
            'compLogo' => $img
        ]);

        $this->addSysLog($this->model->getTable(), 'create', json_encode($resultdata));
        return $resultdata;
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), $this->mandatory, [
            'compLogo.max' => 402
        ]);
        if ($validator->fails()) {
            $err = $validator->messages();
            if ($err->first('compLogo') == '402') {
                $messages = [
                    'data' => $validator->errors(),
                    'status' => 402,
                ];
            } else {
                $messages = [
                    'data' => $validator->errors(),
                    'status' => 401,
                ];
            }
            return response()->json($messages);
        }

        if ($request->hasFile('compLogo') == true) {

            // $img =  $request->file('compLogo');
            // $filenames =  $img->getClientOriginalName();
            // $img_resize = Image::make($img->getRealPath())->encode('data-url');
            $img = $this->resizeCropImage($request->file('compLogo'), 129, 142);

            $data = array(
                'compNama' => $request->compNama,
                'compPemilik' => $request->compPemilik,
                'compStatus' => $request->compStatus,
                'compDetail' => $request->compDetail,
                'compLokasi' => $request->compLokasi,
                'compBpjsId' => $request->compBpjsId,
                // 'compLogo' => $img_resize->encoded
                'compLogo' => $img
            );
        } else {
            $data = array(
                'compNama' => $request->compNama,
                'compPemilik' => $request->compPemilik,
                'compStatus' => $request->compStatus,
                'compDetail' => $request->compDetail,
                'compLokasi' => $request->compLokasi,
                'compBpjsId' => $request->compBpjsId
            );
        }

        $this->model->find($id)->update($data);

        $this->addSysLog($this->model->getTable(), 'update', json_encode($data));

        return $data;
    }

    public function getCompany($id)
    {
        return response()->json($this->model->find($id));
    }

    public function setCompany(Request $request)
    {
        $data = array(
            'compKategori' => $request->compKategori,
            'compStatusMng' => 1,
        );
        $this->model->find($request->compId)->update($data);

        $menu_setup = $this->menu->select('menuId')->orderBy('menuId', 'desc')->first(); // get last menuId + x
        if ($request->compKategori == 1) {

            $menu = [
                ['compId' => $request->compId, 'menuNama' => 'Dashboard', 'menuRoute' => '#', 'menuIcon' => 'icon-display4', 'menuParent' => Null, 'menuOrder' => 0],
                ['compId' => $request->compId, 'menuNama' => 'Setup', 'menuRoute' => '', 'menuIcon' => 'icon-cog3', 'menuParent' => Null, 'menuOrder' => 1], //+2
                ['compId' => $request->compId, 'menuNama' => 'Company', 'menuRoute' => 'company', 'menuIcon' => '', 'menuParent' => $menu_setup->menuId+2, 'menuOrder' => 1],
                ['compId' => $request->compId, 'menuNama' => 'Menu', 'menuRoute' => 'menu', 'menuIcon' => '', 'menuParent' => $menu_setup->menuId+2, 'menuOrder' => 2],
                ['compId' => $request->compId, 'menuNama' => 'Role', 'menuRoute' => 'role', 'menuIcon' => '', 'menuParent' => $menu_setup->menuId+2, 'menuOrder' => 3],
                ['compId' => $request->compId, 'menuNama' => 'Role Menu', 'menuRoute' => 'rolemenu', 'menuIcon' => '', 'menuParent' => $menu_setup->menuId+2, 'menuOrder' => 4],
                ['compId' => $request->compId, 'menuNama' => 'User Company', 'menuRoute' => 'user-omd-company', 'menuIcon' => '', 'menuParent' => $menu_setup->menuId+2, 'menuOrder' => 5],
                ['compId' => $request->compId, 'menuNama' => 'Ganti Password', 'menuRoute' => 'gantipass', 'menuIcon' => '', 'menuParent' => $menu_setup->menuId+2, 'menuOrder' => 6],
                ['compId' => $request->compId, 'menuNama' => 'Master', 'menuRoute' => '', 'menuIcon' => 'icon-database2', 'menuParent' => Null, 'menuOrder' => 2],
                ['compId' => $request->compId, 'menuNama' => 'Pendaftaran', 'menuRoute' => '', 'menuIcon' => 'icon-file-plus', 'menuParent' => Null, 'menuOrder' => 3], //+10
                ['compId' => $request->compId, 'menuNama' => 'Pendaftaran Pasien', 'menuRoute' => 'daftar-pasien', 'menuIcon' => '', 'menuParent' => $menu_setup->menuId+10, 'menuOrder' => 1],
                ['compId' => $request->compId, 'menuNama' => 'Antrian', 'menuRoute' => '#', 'menuIcon' => '', 'menuParent' => $menu_setup->menuId+10, 'menuOrder' => 2],
                ['compId' => $request->compId, 'menuNama' => 'Pendaftaran Medical Check Up', 'menuRoute' => '#', 'menuIcon' => '', 'menuParent' => $menu_setup->menuId+10, 'menuOrder' => 3],
                ['compId' => $request->compId, 'menuNama' => 'Cetak Label & Gelang (IGD)', 'menuRoute' => '#', 'menuIcon' => '', 'menuParent' => $menu_setup->menuId+10, 'menuOrder' => 4],
                ['compId' => $request->compId, 'menuNama' => 'Cetak Pasien Rujuk (IGD)', 'menuRoute' => '#', 'menuIcon' => '', 'menuParent' => $menu_setup->menuId+10, 'menuOrder' => 5],
                ['compId' => $request->compId, 'menuNama' => 'Surat Kelahiran', 'menuRoute' => '#', 'menuIcon' => '', 'menuParent' => $menu_setup->menuId+10, 'menuOrder' => 6],
                ['compId' => $request->compId, 'menuNama' => 'Surat Kematian', 'menuRoute' => '#', 'menuIcon' => '', 'menuParent' => $menu_setup->menuId+10, 'menuOrder' => 7],
            ];
        }
        
        if ($request->compKategori == 2) {
            $menu = [
                ['compId' => $request->compId, 'menuNama' => 'Dashboard', 'menuRoute' => '#', 'menuIcon' => 'icon-display4', 'menuParent' => Null, 'menuOrder' => 0],
                ['compId' => $request->compId, 'menuNama' => 'Setup', 'menuRoute' => '', 'menuIcon' => 'icon-cog3', 'menuParent' => Null, 'menuOrder' => 1], //+2
                ['compId' => $request->compId, 'menuNama' => 'Company', 'menuRoute' => 'company', 'menuIcon' => '', 'menuParent' => $menu_setup->menuId+2, 'menuOrder' => 1],
                ['compId' => $request->compId, 'menuNama' => 'Menu', 'menuRoute' => 'menu', 'menuIcon' => '', 'menuParent' => $menu_setup->menuId+2, 'menuOrder' => 2],
                ['compId' => $request->compId, 'menuNama' => 'Role', 'menuRoute' => 'role', 'menuIcon' => '', 'menuParent' => $menu_setup->menuId+2, 'menuOrder' => 3],
                ['compId' => $request->compId, 'menuNama' => 'Role Menu', 'menuRoute' => 'rolemenu', 'menuIcon' => '', 'menuParent' => $menu_setup->menuId+2, 'menuOrder' => 4],
                ['compId' => $request->compId, 'menuNama' => 'User Company', 'menuRoute' => 'user-kln-company', 'menuIcon' => '', 'menuParent' => $menu_setup->menuId+2, 'menuOrder' => 6],
                ['compId' => $request->compId, 'menuNama' => 'Ganti Password', 'menuRoute' => 'gantipass', 'menuIcon' => '', 'menuParent' => $menu_setup->menuId+2, 'menuOrder' => 7],
                ['compId' => $request->compId, 'menuNama' => 'Master', 'menuRoute' => '', 'menuIcon' => 'icon-database2', 'menuParent' => Null, 'menuOrder' => 3], //268
                ['compId' => $request->compId, 'menuNama' => 'Pendaftaran', 'menuRoute' => '', 'menuIcon' => 'icon-user-plus', 'menuParent' => Null, 'menuOrder' => 4], //278
                ['compId' => $request->compId, 'menuNama' => 'Pendaftaran Pasien', 'menuRoute' => 'kln-daftar-pasien', 'menuIcon' => '', 'menuParent' => $menu_setup->menuId+10, 'menuOrder' => 1],
                ['compId' => $request->compId, 'menuNama' => 'Laporan Pendaftaran', 'menuRoute' => '#', 'menuIcon' => '', 'menuParent' => $menu_setup->menuId+10, 'menuOrder' => 3],
            ];
        }
        
        if ($request->compKategori == 3) {
            $menu = [
                ['compId' => $request->compId, 'menuNama' => 'Dashboard', 'menuRoute' => '#', 'menuIcon' => 'icon-display4', 'menuParent' => Null, 'menuOrder' => 0],
                ['compId' => $request->compId, 'menuNama' => 'Setup', 'menuRoute' => '', 'menuIcon' => 'icon-cog3', 'menuParent' => Null, 'menuOrder' => 1], //+2
                ['compId' => $request->compId, 'menuNama' => 'Menu', 'menuRoute' => 'menu', 'menuIcon' => 'menu', 'menuParent' => $menu_setup->menuId+2, 'menuOrder' => 2],
                ['compId' => $request->compId, 'menuNama' => 'Role', 'menuRoute' => 'role', 'menuIcon' => 'role', 'menuParent' => $menu_setup->menuId+2, 'menuOrder' => 3],
                ['compId' => $request->compId, 'menuNama' => 'Role Menu', 'menuRoute' => 'rolemenu', 'menuIcon' => '', 'menuParent' => $menu_setup->menuId+2, 'menuOrder' => 4],
                ['compId' => $request->compId, 'menuNama' => 'User Company', 'menuRoute' => 'usercomp', 'menuIcon' => '', 'menuParent' => $menu_setup->menuId+2, 'menuOrder' => 6],
                ['compId' => $request->compId, 'menuNama' => 'Ganti Password', 'menuRoute' => 'gantipass', 'menuIcon' => '', 'menuParent' => $menu_setup->menuId+2, 'menuOrder' => 7],
            ];
        }

        $this->menu->insert($menu);
        $this->role->insert([
            'compId' => $request->compId,
            'roleNama' => 'Administrator ' . $request->compNama,
        ]);
        
        $i_val = $this->menu->select('menuId')->orderBy('menuId', 'desc')->first(); //set id menu awal
        $role = $this->role->select('roleId')->orderBy('roleId', 'desc')->first(); //set id menu awal

        for ($i = ($i_val->menuId)-(count($menu)-1); $i <= $i_val->menuId; $i++) {
            $this->rolemenu->insert([
                'compId' => $request->compId,
                'rmRoleId' => $role->roleId,
                'rmMenuId' => $i,
            ]);
        }

         $this->user->insert([
            // DB::table('users')->insert([
            // User::insert([
            'name' => $request->compNama,
            'username' => strtolower(str_replace(" ", "", $request->compNama)),
            'email' => strtolower(str_replace(" ", "", $request->compNama)) . '@siapsehat.id',
            'email_verified_at' => now(),
            'compId' => $request->compId,
            'role' => $role->roleId,
            'password' => Hash::make("1234")
        ]);

        return response()->json($request->All());
    }
}
