<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//Frontend
Route::get('/','App\Http\Controllers\HomeController@index');
Route::get('chitiet-sach/{id_sach}','App\Http\Controllers\HomeController@chitiet');
Route::get('theloai-sach/{id_sach}','App\Http\Controllers\HomeController@TL_sach');
Route::get('tacgia-sach/{id_sach}','App\Http\Controllers\HomeController@TG_sach');
Route::get('loc-sach','App\Http\Controllers\HomeController@TL1_sach');

Route::post('add-cart','App\Http\Controllers\CartController@add_cart');
Route::get('delete-cart/{id}','App\Http\Controllers\CartController@delete_cart');
Route::get('delete-list-cart/{id}','App\Http\Controllers\CartController@delete_list_cart');
Route::get('save-list-cart/{id}/{qty}','App\Http\Controllers\CartController@save_list_cart');
Route::get('gio-hang','App\Http\Controllers\CartController@Cart');

Route::post('dat-hang','App\Http\Controllers\DatHangController@dathang');
Route::get('dat-hang','App\Http\Controllers\DatHangController@dat_hang');
Route::post('thanh-toan','App\Http\Controllers\DatHangController@thanhtoan');
Route::get('thanhtoan-vnpay','App\Http\Controllers\DatHangController@thanhtoan_vnpay');

Route::get('/dangnhap-kh','App\Http\Controllers\KhachHangController@Dangnhap');
Route::get('/dangki-kh','App\Http\Controllers\KhachHangController@Dangki');
Route::post('/dang-ki','App\Http\Controllers\KhachHangController@dangki_kh');
Route::post('/dangnhap-kh','App\Http\Controllers\KhachHangController@dangnhap_kh');
Route::get('/dang-xuat','App\Http\Controllers\KhachHangController@dangxuat_kh');

Route::get('don-hang','App\Http\Controllers\CartController@donhang');
Route::get('chitietdh/{id_dh}','App\Http\Controllers\CartController@ctdonhang');
Route::get('xoadh/{id_dh}','App\Http\Controllers\CartController@xoadonhang');

Route::get('/all-donhang','App\Http\Controllers\DatHangController@donhang');
Route::post('/duyet-dh/{id_dh}','App\Http\Controllers\DatHangController@duyet_dh');
Route::get('/ct-donhang/{id_dh}','App\Http\Controllers\DatHangController@ctdonhang');

Route::post('danh-gia','App\Http\Controllers\KhachHangController@danh_gia');

//Backend
Route::get('/dashboard','App\Http\Controllers\AdminController@index');
Route::get('addmin','App\Http\Controllers\AdminController@admin');
Route::post('/admin-dashboard','App\Http\Controllers\AdminController@Login');
Route::get('/logout','App\Http\Controllers\AdminController@Logout');

Route::get('list-sach','App\Http\Controllers\DauSachController@List_sach');
Route::get('delete-sach/{id_sach}','App\Http\Controllers\DauSachController@Delete_sach');
Route::get('add-sach','App\Http\Controllers\DauSachController@Add_sach');
Route::get('edit-sach/{id_sach}','App\Http\Controllers\DausachController@Edit_sach');
Route::post('save-sach','App\Http\Controllers\DauSachController@Save_sach');
Route::post('update-sach/{id_sach}','App\Http\Controllers\DauSachController@Update_sach');


Route::get('list-nxb','App\Http\Controllers\NXBController@List_nxb');
Route::get('delete-nxb/{id_nxb}','App\Http\Controllers\NXBController@Delete_nxb');
Route::get('edit-nxb/{id_nxb}','App\Http\Controllers\NXBController@Edit_nxb');
Route::post('add-nxb','App\Http\Controllers\NXBController@add_nxb');
Route::post('update-nxb/{id_nxb}','App\Http\Controllers\NXBController@Update_nxb');

Route::get('list-tacgia','App\Http\Controllers\TacGiaController@List_tacgia');
Route::get('delete-tacgia/{id_tacgia}','App\Http\Controllers\TacGiaController@Delete_tacgia');
Route::get('edit-tacgia/{id_tacgia}','App\Http\Controllers\TacgiaController@Edit_tacgia');
Route::post('add-tacgia','App\Http\Controllers\TacGiaController@add_tacgia');
Route::post('update-tacgia/{id_tacgia}','App\Http\Controllers\TacGiaController@Update_tacgia');

Route::get('list-theloai','App\Http\Controllers\TheLoaiController@List_theloai');
Route::get('delete-theloai/{id_theloai}','App\Http\Controllers\TheLoaiController@Delete_theloai');
Route::get('edit-theloai/{id_theloai}','App\Http\Controllers\TheLoaiController@Edit_theloai');
Route::post('add-theloai','App\Http\Controllers\TheLoaiController@add_theloai');
Route::post('update-theloai/{id_theloai}','App\Http\Controllers\TheLoaiController@Update_theloai');

Route::get('list-ncc','App\Http\Controllers\NhaCungCapController@List_ncc');
Route::get('delete-ncc/{id_ncc}','App\Http\Controllers\NhaCungCapController@Delete_ncc');
Route::get('edit-ncc/{id_ncc}','App\Http\Controllers\NhaCungCapController@Edit_ncc');
Route::post('add-ncc','App\Http\Controllers\NhaCungCapController@add_ncc');
Route::post('update-ncc/{id_ncc}','App\Http\Controllers\NhaCungCapController@Update_ncc');

Route::get('khuyen-mai','App\Http\Controllers\HomeController@khuyen_mai');
Route::post('tl-km','App\Http\Controllers\HomeController@tl_km');
Route::post('add-km','App\Http\Controllers\HomeController@add_km');

Route::get('list-danhgia','App\Http\Controllers\KhachHangController@list_danhgia');


Route::get('/thongke','App\Http\Controllers\HomeController@thongke');

Route::get('payment', 'App\Http\Controllers\PaypalController@payment')->name('payment');

Route::get('cancel', 'PayPalController@cancel')->name('payment.cancel');

Route::get('payment/success', 'PayPalController@success')->name('payment.success');

Route::get('khach-hang','App\Http\Controllers\KhachHangController@list_kh');
Route::get('delete-khachhang/{id_kh}','App\Http\Controllers\KhachHangController@Delete_khachhang');

Route::get('phi-vc','App\Http\Controllers\PhivanchuyenController@index');
Route::post('select-dc','App\Http\Controllers\PhivanchuyenController@select_dc');
Route::post('them-phivc','App\Http\Controllers\PhivanchuyenController@them_phivc');
Route::post('update-phivc','App\Http\Controllers\PhivanchuyenController@update_phivc');

Route::get('in-dh/{id_dh}','App\Http\Controllers\DatHangController@in_dh');
Route::post('loc-don-hang','App\Http\Controllers\DatHangController@loc_dh');

Route::get('top-10','App\Http\Controllers\AdminController@top_10');
Route::get('dt-thang','App\Http\Controllers\AdminController@dt_thang');

Route::get('export-sach','App\Http\Controllers\ExportController@export');
Route::post('import-sach','App\Http\Controllers\ImportController@import');

Route::post('reset-mk','App\Http\Controllers\MailController@html_email');
Route::get('dat-lai-mk','App\Http\Controllers\MailController@datlai_mk');
Route::post('datlai-mk','App\Http\Controllers\MailController@dat_lai_mk');

