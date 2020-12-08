<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\PhuongXa;
use App\Models\ThanhPho;
use App\Models\QuanHuyen;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class PhivanchuyenController extends Controller
{
    public function index(){
        $thanhpho = ThanhPho::orderby('matp','ASC')->get();
        $shipping =  DB::table('phivanchuyen')
            ->join('tbl_tinhthanhpho', 'tbl_tinhthanhpho.matp', '=', 'phivanchuyen.matp')
            ->join('tbl_quanhuyen', 'tbl_quanhuyen.maqh', '=', 'phivanchuyen.maqh')
            ->join('tbl_xaphuongthitran', 'tbl_xaphuongthitran.maxa', '=', 'phivanchuyen.maxa')
            ->get();
        return view('admin.quanly.phivanchuyen.list')->with('thanhpho',$thanhpho)->with('phivc',$shipping);
    }

    public function them_phivc(Request $request){
        $data = array();
        $data['matp']= $request->matp;
        $data['maqh']= $request->maqh;
        $data['maxa']= $request->maxa;
        $data['phi_vc']= $request->phi_vc;
        DB::table('phivanchuyen')->insert($data);
        return Redirect::to('/phi-vc');
    }
    public function update_phivc(Request $request){
        $data = array();
        $data['phi_vc']= $request->phi_vc;
        DB::table('phivanchuyen')->where('ma_phi',$request->ma_phi)->update($data);
    }
    
    public function select_dc(Request $request){
        if($request->action){
            $output='';
            if($request->action=="thanhpho"){
                $sel_qh= QuanHuyen::where('matp',$request->maid)->orderby('maqh','ASC')->get();
                $output.='<option >-----Quận huyện----</option>';
                foreach($sel_qh as $key => $qh){
                    $output.='<option value="'.$qh->maqh.'">'.$qh->tenqh.'</option>';
                }
            }else{
                $sel_xa= PhuongXa::where('maqh',$request->maid)->orderby('maxa','ASC')->get();
                $output.='<option >-----Phường xã----</option>';
                foreach($sel_xa as $key => $xa){
                    $output.='<option value="'.$xa->maxa.'">'.$xa->tenxa.'</option>';
                }
            }
        }
        echo $output;
    }
}
