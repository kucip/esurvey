<?php

namespace App\Http\Controllers\Cms;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Validator;
use Session;
use Illuminate\Support\Facades\Redirect;
use App\Models\Rolemenu;
use App\Models\Menu;
use App\Models\Syslog;
use Illuminate\Support\Facades\Route;
use Image;
use File;

class Controllermaster extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function recaptcha($recaptcha_response)
    {
        $secret = config('services.recaptcha.secret');
        $remoteip = $_SERVER['REMOTE_ADDR'];
        $url = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$recaptcha_response&remoteip=$remoteip");
        $result = json_decode($url, TRUE);

        return $result;
    }

    public function index()
    {
        $data = $this->model->latest()->get();
        return response()->json([$this->resources->collection($data)]);
    }
    public function show($id)
    {
        $showdata = $this->model->find($id);
        if (is_null($showdata)) {
            return response()->json('data not found', 404);
        }
        return response()->json([new $this->resources($showdata)]);
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), $this->mandatory); // $this->mainroute

        if ($validator->fails()) {
            $messages = [
                'data' => $validator->errors(),
                'status' => 401,
            ];
            return response()->json($messages);
        }

        if ($request['_recaptcha']) {
            $check_recaptcha = $this->recaptcha($request['_recaptcha']);

            if ($check_recaptcha['success'] == false) {
                $messages = [
                    'data' => str_replace("-", " ", $check_recaptcha['error-codes'][0]),
                    'status' => 501,
                ];
                return response()->json($messages);
            }
        }

        if (method_exists($this, 'beforeStore')) {
            $this->beforeStore($request);
        }

        $resultdata =  $this->model->create($request->all());
        // $this->addSysLog($this->model->getTable(), 'create', json_encode($resultdata));
        return $resultdata;
        // return response()->json([new  $this->resources($resultdata)]);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), $this->mandatory);
        if ($validator->fails()) {
            $messages = [
                'data' => $validator->errors(),
                'status' => 401,
            ];
            return response()->json($messages);
        }

        if ($request['_recaptcha']) {
            $check_recaptcha = $this->recaptcha($request['_recaptcha']);

            if ($check_recaptcha['success'] == false) {
                $messages = [
                    'data' => str_replace("-", " ", $check_recaptcha['error-codes'][0]),
                    'status' => 501,
                ];
                return response()->json($messages);
            }
        }

        if (method_exists($this, 'beforeUpdate')) {
            $this->beforeUpdate($request, $id);
        }

        $data = $request->all();

        $this->model->find($id)->update($data);

        $this->addSysLog($this->model->getTable(), 'update', json_encode($data));

        return $data;
        // return response()->json([new $this->resources($data)]);
    }

    public function destroy(Request $request, $id)
    {
        $data = $this->model->find($id);
        $this->model->find($id)->delete();

        $this->addSysLog($this->model->getTable(), 'delete', json_encode($data));
        return response()->json('data deleted successfully');
    }

    public function getusermenu()
    {

        $compId = Session::get('compId');
        $role = Session::get('role');

        $menu = new Menu();
        $level1 = $menu
            ->leftjoin('role_menu', 'role_menu.rmMenuId', '=', 'menu.menuId')
            // ->where('menu.compId','=',$compId)
            ->where('menu.menuParent', '=', null)
            ->where('role_menu.rmRoleId', '=', $role)
            ->orderby('menu.menuOrder', 'asc')
            ->get();
        $result = array();
        $index = 0;
        foreach ($level1 as $key => $val) {
            $res1 = array(
                'menuNama' => $val->menuNama,
                'menuRoute' => $val->menuRoute,
                'menuIcon' => $val->menuIcon,
                'menuLevel' => 1,
                // 'menuActive' => $val->menuActive,
                'menuChild' => '',
            );
            $result[] = $res1;

            $level2 = $menu
                ->leftjoin('role_menu', 'role_menu.rmMenuId', '=', 'menu.menuId')
                // ->where('menu.compId','=',$compId)
                ->where('menu.menuParent', '=', $val->menuId)
                ->where('role_menu.rmRoleId', '=', $role)
                ->orderby('menu.menuOrder', 'asc')
                ->get();
            $res2 = array();
            $index2 = 0;
            foreach ($level2 as $key2 => $val2) {
                $res2[] = array(
                    'menuNama' => $val2->menuNama,
                    'menuRoute' => $val2->menuRoute,
                    'menuIcon' => $val2->menuIcon,
                    'menuLevel' => 2,
                    // 'menuActive' => $val->menuActive,
                    'menuChild' => '',
                );
                $level3 = $menu
                    ->leftjoin('role_menu', 'role_menu.rmMenuId', '=', 'menu.menuId')
                    // ->where('menu.compId','=',$compId)
                    ->where('menu.menuParent', '=', $val2->menuId)
                    ->where('role_menu.rmRoleId', '=', $role)
                    ->orderby('menu.menuOrder', 'asc')
                    ->get();
                $res3 = array();
                $index3 = 0;
                foreach ($level3 as $key3 => $val3) {
                    $res3[] = array(
                        'menuNama' => $val3->menuNama,
                        'menuRoute' => $val3->menuRoute,
                        'menuIcon' => $val3->menuIcon,
                        'menuLevel' => 3,
                        // 'menuId' => $val3->menuId,
                        'menuChild' => '',
                    );
                    $level4 = $menu
                        ->leftjoin('role_menu', 'role_menu.rmMenuId', '=', 'menu.menuId')
                        // ->where('menu.compId','=',$compId)
                        ->where('menu.menuParent', '=', $val3->menuId)
                        ->where('role_menu.rmRoleId', '=', $role)
                        ->orderby('menu.menuOrder', 'asc')
                        ->get();
                    $res4 = array();
                    $index4 = 0;
                    foreach ($level4 as $key4 => $val4) {
                        $res4[] = array(
                            'menuNama' => $val4->menuNama,
                            'menuRoute' => $val4->menuRoute,
                            'menuIcon' => $val4->menuIcon,
                            'menuLevel' => 4,
                            // 'menuActive' => $val->menuActive,
                            'menuChild' => '',
                        );

                        $level5 = $menu
                            ->leftjoin('role_menu', 'role_menu.rmMenuId', '=', 'menu.menuId')
                            // ->where('menu.compId','=',$compId)
                            ->where('menu.menuParent', '=', $val4->menuId)
                            ->where('role_menu.rmRoleId', '=', $role)
                            ->orderby('menu.menuOrder', 'asc')
                            ->get();

                        $res5 = array();
                        foreach ($level5 as $key5 => $val5) {
                            $res5[] = array(
                                'menuNama' => $val5->menuNama,
                                'menuRoute' => $val5->menuRoute,
                                'menuIcon' => $val5->menuIcon,
                                'menuLevel' => 5,
                                // 'menuActive' => $val->menuActive,
                                'menuChild' => '',
                            );
                        }

                        $res4[$index4]['menuChild'] = $res5;
                        $index4++;
                    }
                    $res3[$index3]['menuChild'] = $res4;
                    $index3++;
                }
                $res2[$index2]['menuChild'] = $res3;
                $index2++;
            }
            $result[$index]['menuChild'] = $res2;
            $index++;
        }
        return $result;
    }

    public function checkRouteAuth()
    {

        $routename = Route::currentRouteName();
        $routename = str_replace(".index", "", $routename);

        $role = Session::get('role');
        $menu = new Menu();
        $result = $menu
            ->leftjoin('role_menu', 'role_menu.rmMenuId', '=', 'menu.menuId')
            ->where('menu.menuRoute', '=', $routename)
            ->where('role_menu.rmRoleId', '=', $role)
            ->get();

        //   return count($result);
        if (count($result) > 0) {
            return 1;
        } else {
            return 2;
        }
    }

    public function addSysLog($table, $query, $detail)
    {
        $compId = Session::get('compId');
        $nama = Session::get('name');
        $data = array(
            'compId' => $compId,
            'user' => $nama,
            'tabel' => $table,
            'query' => $query,
            'detail' => $detail
        );
        $syslog = new Syslog;
        $syslog->create($data);
    }
    public function AutoCodeBasic($prefix = 'OMS', $kode = '0000', $length = 4)
    {
        if (!empty($kode)) {
            $getKd = intval(substr($kode, strlen($prefix), $length));
            $getKd = strval($getKd + 1);
            $j = strlen($getKd);
            if ($j < $length) {
                for ($i = $j; $i < $length; $i++) {
                    $getKd = 0 . $getKd;
                }
            }

            $kd = $prefix . $getKd;
        } else {
            $defKd = strval(1);
            $k = strlen($defKd);
            if ($k < $length) {
                for ($i = $k; $i < $length; $i++) {
                    $defKd = 0 . $defKd;
                }
            }
            $kd = $prefix . $defKd;
        }


        return $kd;
    }

    // Pengkodean Dengan Prefix Tertentu
    public function AutoCodeAdvance($kode = '0000', $length = 4, $prefix = '/OMS/', $month = 1)
    {
        if (!empty($kode)) {
            $getKd = intval(substr($kode, 0, $length));
            $getKd = strval($getKd + 1);
            $j = strlen($getKd);
            if ($j < $length) {
                for ($i = $j; $i < $length; $i++) {
                    $getKd = 0 . $getKd;
                }
            }

            $kd = $getKd . $prefix . $this->ConverToRoman($month) . '/' . date('Y');
        } else {
            $defKd = strval(1);
            $k = strlen($defKd);
            if ($k < $length) {
                for ($i = $k; $i < $length; $i++) {
                    $defKd = 0 . $defKd;
                }
            }

            $kd = $defKd . $prefix . $this->ConverToRoman($month) . '/' . date('Y');
        }


        return $kd;
    }

    // Convert Number to Romawi
    function ConverToRoman($num)
    {
        $n = intval($num);
        $res = '';

        //array of roman numbers
        $romanNumber_Array = array(
            'M'  => 1000,
            'CM' => 900,
            'D'  => 500,
            'CD' => 400,
            'C'  => 100,
            'XC' => 90,
            'L'  => 50,
            'XL' => 40,
            'X'  => 10,
            'IX' => 9,
            'V'  => 5,
            'IV' => 4,
            'I'  => 1
        );

        foreach ($romanNumber_Array as $roman => $number) {
            //divide to get  matches
            $matches = intval($n / $number);

            //assign the roman char * $matches
            $res .= str_repeat($roman, $matches);

            //substract from the number
            $n = $n % $number;
        }

        // return the result
        return $res;
    }

    public function convertAutoNumber($val)
    {
        $res = str_replace(",", "", $val);
        return $res;
    }

    public function resizeCropImage($image, $cropSizeX, $cropSizeY)
    {
        $sourceImage = Image::make($image->getRealPath());
        $sourceImage->stream();
        $sourceProp = getimagesizefromstring($sourceImage);
        $sourceWidth = $sourceProp[0];
        $sourceHeight = $sourceProp[1];

        if ($sourceWidth > $sourceHeight) {
            $resizeX = null;
            $resizeY = $cropSizeY;
        } else {
            $resizeX = $cropSizeX;
            $resizeY = null;
        }

        $newimg = Image::make($image->getRealPath());
        $newimg->resize($resizeX, $resizeY, function ($constraint) {
            $constraint->aspectRatio();
        });
        $cropimg = $newimg;
        $newimg->stream();
        $newimgProp = getimagesizefromstring($newimg);
        $newimgWidth = $newimgProp[0];
        $newimgHeight = $newimgProp[1];


        if ($sourceWidth > $sourceHeight) {
            $posX = ceil(($newimgWidth - $cropSizeX) / 2);
            $posY = 0;
        } else {
            $posX = 0;
            $posY = ceil(($newimgHeight - $cropSizeY) / 2);
        }

        $cropimg->crop($cropSizeX, $cropSizeY, $posX, $posY)->encode('jpg');
        $cropimg->stream();

        $img64 = base64_encode($cropimg);
        return 'data:image/png;base64, ' . $img64 . '';
    }
}
