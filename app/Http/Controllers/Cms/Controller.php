<?php

namespace App\Http\Controllers\Cms;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Validator;
use Session;
use App\Models\Rolemenu;
use App\Models\Menu;
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
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

    // public function getusermenu(){        

    //     $compId = Session::get('compId');
    //     $role = Session::get('role');

    //     $menu=new Menu();
    //     $level1=$menu
    //               ->leftjoin('role_menu','role_menu.rmMenuId','=','menu.menuId')
    //               // ->where('menu.compId','=',$compId)
    //               ->where('menu.menuParent','=',null)
    //               ->where('role_menu.rmRoleId','=',$role)
    //               ->orderby('menu.menuOrder','asc')
    //               ->get();
    //     $result=array();
    //     $index =0;
    //     foreach($level1 as $key=>$val){
    //         $res1=array(
    //                     'menuNama'=>$val->menuNama,
    //                     'menuRoute'=>$val->menuRoute,
    //                     'menuIcon'=>$val->menuIcon,
    //                     'menuLevel'=>1,
    //                     'menuChild'=>'',
    //                   );
    //         $result[]=$res1;

    //         $level2=$menu
    //                   ->leftjoin('role_menu','role_menu.rmMenuId','=','menu.menuId')
    //                   // ->where('menu.compId','=',$compId)
    //                   ->where('menu.menuParent','=',$val->menuId)
    //                   ->where('role_menu.rmRoleId','=',$role)
    //                   ->orderby('menu.menuOrder','asc')
    //                   ->get();
    //         $res2=array();
    //         $index2=0;
    //         foreach($level2 as $key2=>$val2){
    //             $res2[]=array(
    //                         'menuNama'=>$val2->menuNama,
    //                         'menuRoute'=>$val2->menuRoute,
    //                         'menuIcon'=>$val2->menuIcon,
    //                         'menuLevel'=>2,
    //                         'menuChild'=>'',
    //                       );
    //             $level3=$menu
    //                       ->leftjoin('role_menu','role_menu.rmMenuId','=','menu.menuId')
    //                       // ->where('menu.compId','=',$compId)
    //                       ->where('menu.menuParent','=',$val2->menuId)
    //                       ->where('role_menu.rmRoleId','=',$role)
    //                       ->orderby('menu.menuOrder','asc')
    //                       ->get();
    //             $res3=array();
    //             foreach($level3 as $key3=>$val3){
    //                 $res3[]=array(
    //                             'menuNama'=>$val3->menuNama,
    //                             'menuRoute'=>$val3->menuRoute,
    //                             'menuIcon'=>$val3->menuIcon,
    //                             'menuLevel'=>3,
    //                             'menuChild'=>'',
    //                           );
    //             }
    //             $res2[$index2]['menuChild']=$res3;
    //             $index2 ++;
    //         }
    //         $result[$index]['menuChild']=$res2;
    //         $index ++;
    //     }
    //     return $result;
    // }    
}
