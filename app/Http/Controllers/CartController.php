<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

use Gloudemans\Shoppingcart\Facades\Cart;
class CartController extends Controller
{
    public function CheckLoginKH(){
        $ad_id =Session::get('name');
        if($ad_id){
            return Redirect::to('/');
        }else{
            return Redirect::to('dangnhap-kh')->send();
        }
    }
    public function Cart(){
        $this->CheckLoginKH();
        return view('home.cart.giohang');
    }

    public function add_cart(Request $request){
        $sach=DB::table("dausach")->where("id_sach",$request->id_sach)->first();
        $data = array();
        $data['id']=$request->id_sach;
        $data['name']=$sach->ten_sach;
        $data['qty']=$request->soluong;
        $data['weight']=$request->phantram_km;
        $data['price']=(100- $request->phantram_km) * $sach->gia_sach/100;
        $data['options']['image']=$sach->hinh_anh;
        //Cart::destroy();
        Cart::add($data);
        return  view('home.cart.cart');
    }
    public function delete_cart($rowId){
        Cart::update($rowId,0);
        return  view('home.cart.cart');
    }
    public function delete_list_cart($rowId){
        Cart::update($rowId,0);
        return  view('home.cart.list-cart');
    }

    public function save_list_cart($rowId,$qty){
        Cart::update($rowId,$qty);
        return  view('home.cart.list-cart');
    }

    public function donhang(){
        $donhang1= DB::table('donhang')->where([
            ['trang_thai',1],
            ['donhang.id_kh', Session::get('id_kh')],
         ])->get();
        $donhang2= DB::table('donhang')->where([
            ['trang_thai',2],
            ['donhang.id_kh', Session::get('id_kh')],
         ])->get();
        $donhang3= DB::table('donhang')->where([
            ['trang_thai',3],
            ['donhang.id_kh', Session::get('id_kh')],
         ])->get();
        $donhang4= DB::table('donhang')->where([
            ['trang_thai',4],
            ['donhang.id_kh', Session::get('id_kh')],
         ])->get();
        $donhang5= DB::table('donhang')->where([
            ['trang_thai',5],
            ['donhang.id_kh', Session::get('id_kh')],
         ])->get();
        return  view('home.cart.donhang')->with('donhang1',$donhang1)->with('donhang2',$donhang2)->with('donhang3',$donhang3)->with('donhang4',$donhang4)->with('donhang5',$donhang5);
    }
    public function ctdonhang($id_dh){
        $edit_sach= DB::table('donhang')
        ->join('ctgiohang','ctgiohang.id_dh','=','donhang.id_dh')
        ->join('dausach','dausach.id_sach','=','ctgiohang.id_sach')
        ->where([
            ['donhang.id_dh',$id_dh],
            ['donhang.id_kh', Session::get('id_kh')],
         ])->get();
        return  view('home.cart.chitietdh')->with('ctdonhang',$edit_sach);
    }
    public function xoadonhang($id_dh){
        $data = array();
        $data['donhang.trang_thai']= 5;
        DB::table('donhang')
        ->join('ctgiohang','ctgiohang.id_dh','=','donhang.id_dh')
        ->join('dausach','dausach.id_sach','=','ctgiohang.id_sach')
        ->where('donhang.id_dh',$id_dh)->update($data);
        return  Redirect::to('/don-hang');
    }
    

}
