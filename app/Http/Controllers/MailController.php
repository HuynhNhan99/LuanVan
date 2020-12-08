<?php

namespace App\Http\Controllers;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class MailController extends Controller
{

    public function html_email(Request $request){
        $email = $request->email;
        $token = Str::random(40);
        $kh = DB::table('khachhang')->where('email_kh', $email)->first();
        if ($kh) {
            $data_kh = array();
            $data_kh['password_token']= $token;
            DB::table('khachhang')->where('id_kh', $kh->id_kh)->update($data_kh);

            $link=url('/dat-lai-mk?email='.$email.'&token='.$token);
            $data = array('name' => $link);
            Mail::send('home.Auth.mail_mk', $data, function ($message) use ($email) {
                $message->to($email)->subject('Đặt lại mật khẩu NHBook');
                $message->from('httnhan99@gmail.com', 'NHBook');
            });
            Session::put('thanhcong','Email đã được gửi, vui lòng kiểm tra hộp thư để cập nhật thông tin.!!!');
            return Redirect::to('/dangnhap-kh');
        } else 'alert(message successfully sent)';
    }
    public function datlai_mk(){
        $kh=DB::table('khachhang')->where('password_token',$_GET['token'])->first();
        return view('home.Auth.reset_mk')->with('kh',$kh);
    }
    public function dat_lai_mk(Request $request){
        $kh=DB::table('khachhang')->where('email_kh',$request->email)->where('password_token',$request->token)->first();
        if($kh){
            $data_kh = array();
            $data_kh['password_token']= NULL;
            $data_kh['password']= md5($request->password);
            DB::table('khachhang')->where('id_kh', $kh->id_kh)->update($data_kh);
            echo 'alert(message successfully sent)';
        }
    }
    
}
