<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class HomeController extends Controller
{
    public function json()
    {
        $array = ['name' => 'ten', 'honame' => 'ten'];
        $array = ['name1' => 'ten', 'honame' => 'ten'];
        return response()->json($array);
    }
    public function index()
    {
        //Danh mục sách
        $list_theloai = DB::table('theloai')->orderby('id_tl', 'desc')->get();
        $list_nxb = DB::table('nxb')->orderby('id_nxb', 'desc')->get();
        $list_tacgia = DB::table('tacgia')->orderby('id_tg', 'desc')->get();
        $list_ncc = DB::table('nhacungcap')->orderby('id_ncc', 'desc')->get();

        // hiện thị sách bán chạy với đánh giá, khuyến mãi
        $list =  DB::table('donhang')
            ->selectRaw('sum(ctgiohang.so_luong) as soluong, MONTH(ngay_dat) as thang, YEAR(ngay_dat) as nam, ctgiohang.id_sach, dausach.ten_sach, dausach.hinh_anh, dausach.gia_sach')
            ->join('ctgiohang', 'donhang.id_dh', '=', 'ctgiohang.id_dh')
            ->join('dausach', 'dausach.id_sach', '=', 'ctgiohang.id_sach')
            ->groupBy('id_sach')
            ->orderBy('soluong', 'desc')
            ->get();
        $array_sach = [];
        foreach ($list as $key => $sach) {
            $km =  DB::table('khuyenmai')
                ->join('ctkhuyenmai', 'ctkhuyenmai.id_km', '=', 'khuyenmai.id_km')
                ->join('dausach', 'dausach.id_sach', '=', 'ctkhuyenmai.id_sach')
                ->where('dausach.id_sach', $sach->id_sach)
                ->where('ngay_ket_thuc','>=',now())
                ->groupBy('dausach.id_sach')
                ->first();
            $dg =  DB::table('danhgia')
                ->selectRaw('round(avg(danhgia.diem_dg)) as diemtb,count(danhgia.id_sach) as soluong, dausach.id_sach as idsach, dausach.ten_sach as tensach, dausach.hinh_anh as hinhanh, dausach.gia_sach as giasach')
                ->join('dausach', 'dausach.id_sach', '=', 'danhgia.id_sach')
                ->where('dausach.id_sach', $sach->id_sach)
                ->groupBy('dausach.id_sach')
                ->first();
            if ($dg && $km) {
                $array_sach[$key] = [
                    "id_sach" => $dg->idsach,
                    "ten_sach" => $dg->tensach,
                    "hinh_anh" => $dg->hinhanh,
                    "gia_sach" => $dg->giasach,
                    "diemtb" => $dg->diemtb,
                    "soluong" => $dg->soluong,
                    "khuyenmai" => $km->phantram_km,
                ];
            } elseif ($dg) {
                $array_sach[$key] = [
                    "id_sach" => $dg->idsach,
                    "ten_sach" => $dg->tensach,
                    "hinh_anh" => $dg->hinhanh,
                    "gia_sach" => $dg->giasach,
                    "diemtb" => $dg->diemtb,
                    "soluong" => $dg->soluong,
                    "khuyenmai" => 0,
                ];
            } elseif ($km) {
                $array_sach[$key] = [
                    "id_sach" => $sach->id_sach,
                    "ten_sach" => $sach->ten_sach,
                    "hinh_anh" => $sach->hinh_anh,
                    "gia_sach" => $sach->gia_sach,
                    "diemtb" => 0,
                    "soluong" => 0,
                    "khuyenmai" =>  $km->phantram_km,
                ];
            } else {
                $array_sach[$key] = [
                    "id_sach" => $sach->id_sach,
                    "ten_sach" => $sach->ten_sach,
                    "hinh_anh" => $sach->hinh_anh,
                    "gia_sach" => $sach->gia_sach,
                    "diemtb" => 0,
                    "soluong" => 0,
                    "khuyenmai" => 0,
                ];
            }
        }
        

        return view('home.content')
            ->with('list_theloai', $list_theloai)
            ->with('list_nxb', $list_nxb)
            ->with('list_tacgia', $list_tacgia)
            ->with('list_ncc', $list_ncc)
            ->with('dausach', $array_sach);
        // ->with('sachmoi',$array_sachmoi);
    }
    public function chitiet($sach_id)
    {
        //chi tiết sách với khuyến mãi 
        $tl_sach = DB::table('dausach')
            ->join('ctkhuyenmai', 'dausach.id_sach', '=', 'ctkhuyenmai.id_sach')
            ->join('khuyenmai', 'ctkhuyenmai.id_km', '=', 'khuyenmai.id_km')
            ->join('theloai', 'dausach.id_tl', '=', 'theloai.id_tl')
            ->join('tacgia', 'dausach.id_tg', '=', 'tacgia.id_tg')
            ->join('nxb', 'dausach.id_nxb', '=', 'nxb.id_nxb')
            ->join('nhacungcap', 'dausach.id_ncc', '=', 'nhacungcap.id_ncc')
            ->where('dausach.id_sach', $sach_id)
            ->groupBy('dausach.id_sach')->first();
        if ($tl_sach == null) {
            $tl_sach = DB::table('dausach')
            ->join('theloai', 'dausach.id_tl', '=', 'theloai.id_tl')
            ->join('tacgia', 'dausach.id_tg', '=', 'tacgia.id_tg')
            ->join('nxb', 'dausach.id_nxb', '=', 'nxb.id_nxb')
            ->join('nhacungcap', 'dausach.id_ncc', '=', 'nhacungcap.id_ncc')
            ->where('dausach.id_sach', $sach_id)
            ->groupBy('dausach.id_sach')->first();
        }
        //sách tương tự và đánh giá sao chỉnh lại
        $list_tt = DB::table('dausach')
            ->join('theloai', 'dausach.id_tl', '=', 'theloai.id_tl')
            ->where('theloai.id_tl', $tl_sach->id_tl)
            ->groupBy('dausach.id_sach')
            ->get();
        $array_sachtt = [];
        foreach ($list_tt as $key => $sach) {
            $km =  DB::table('khuyenmai')
                ->join('ctkhuyenmai', 'ctkhuyenmai.id_km', '=', 'khuyenmai.id_km')
                ->join('dausach', 'dausach.id_sach', '=', 'ctkhuyenmai.id_sach')
                ->where('dausach.id_sach', $sach->id_sach)
                ->groupBy('dausach.id_sach')
                ->first();
            $dg =  DB::table('danhgia')
                ->selectRaw('round(avg(danhgia.diem_dg)) as diemtb,count(danhgia.id_sach) as soluong, dausach.id_sach as idsach, dausach.ten_sach as tensach, dausach.hinh_anh as hinhanh, dausach.gia_sach as giasach')
                ->join('dausach', 'dausach.id_sach', '=', 'danhgia.id_sach')
                ->where('dausach.id_sach', $sach->id_sach)
                ->groupBy('dausach.id_sach')
                ->first();
            if ($dg && $km) {
                $array_sachtt[$key] = [
                    "id_sach" => $dg->idsach,
                    "ten_sach" => $dg->tensach,
                    "hinh_anh" => $dg->hinhanh,
                    "gia_sach" => $dg->giasach,
                    "diemtb" => $dg->diemtb,
                    "soluong" => $dg->soluong,
                    "khuyenmai" => $km->phantram_km,
                ];
            } elseif ($dg) {
                $array_sachtt[$key] = [
                    "id_sach" => $dg->idsach,
                    "ten_sach" => $dg->tensach,
                    "hinh_anh" => $dg->hinhanh,
                    "gia_sach" => $dg->giasach,
                    "diemtb" => $dg->diemtb,
                    "soluong" => $dg->soluong,
                    "khuyenmai" => 0,
                ];
            } elseif ($km) {
                $array_sachtt[$key] = [
                    "id_sach" => $sach->id_sach,
                    "ten_sach" => $sach->ten_sach,
                    "hinh_anh" => $sach->hinh_anh,
                    "gia_sach" => $sach->gia_sach,
                    "diemtb" => 0,
                    "soluong" => 0,
                    "khuyenmai" =>  $km->phantram_km,
                ];
            } else {
                $array_sachtt[$key] = [
                    "id_sach" => $sach->id_sach,
                    "ten_sach" => $sach->ten_sach,
                    "hinh_anh" => $sach->hinh_anh,
                    "gia_sach" => $sach->gia_sach,
                    "diemtb" => 0,
                    "soluong" => 0,
                    "khuyenmai" => 0,
                ];
            }
        }

        //tổng số đánh giá và điểm trung bình đánh giá
        $tong_dg = DB::table('danhgia')->where('id_sach', $sach_id)->get()->count();
        $diem = DB::table('danhgia')->where('id_sach', $sach_id)->avg('diem_dg');
        $rating = round($diem, 1);

        //hiển thị 5 đánh giá
        $kh_dg = DB::table('danhgia')->join('khachhang', 'danhgia.id_kh', '=', 'khachhang.id_kh')->where('id_sach', $sach_id)->paginate(5);

        //điếm số đánh giá theo từng điểm(1->5)
        $danh_gia = DB::table('danhgia')
            ->selectRaw('diem_dg, count(diem_dg) as sodiem')
            ->where('id_sach', $sach_id)
            ->groupBy('diem_dg')->get()->toArray();
        $array = [];
        if (!empty($danh_gia)) {
            for ($i = 1; $i <= 5; $i++) {
                $array[$i] = [
                    "diem_dg" => 0,
                    "sodiem" => 0
                ];
                foreach ($danh_gia as $item) {
                    if ($item->diem_dg == $i) {
                        $array[$i] = [
                            "diem_dg" => $item->diem_dg,
                            "sodiem" => $item->sodiem
                        ];
                        continue;
                    }
                }
            }
        } else {
            for ($i = 1; $i <= 5; $i++) {
                $array[$i] = [
                    "diem_dg" => 0,
                    "sodiem" => 0
                ];
            }
        }
        return view('home.page.chitiet')->with('danh_gia', $array)->with('tong_dg', $tong_dg)->with('kh_dg', $kh_dg)->with('danhgia', $rating)->with('sach', $tl_sach)->with('sach_tuongtu', $array_sachtt);
    }

    public function TL1_sach(Request $request)
    {
        $list_tacgia = DB::table('tacgia')->orderby('id_tg', 'desc')->get();
        $list_theloai = DB::table('theloai')->orderby('id_tl', 'desc')->get();
        if ($request->get('tacgia')) {
            $list_sach = DB::table('dausach')
            ->join('tacgia', 'dausach.id_tg', '=', 'tacgia.id_tg')
            ->where('dausach.id_tg', $request->get('tacgia'))->paginate(12);
           
        } elseif ($request->get('theloai')) {
            $list_sach = DB::table('dausach')
            ->join('theloai', 'dausach.id_tl', '=', 'theloai.id_tl')
            ->where('dausach.id_tl', $request->get('theloai'))->paginate(12);
            
        } elseif ($request->get('danhgia')) {
            $list_sach = DB::table('dausach')
                ->selectRaw('round(avg(danhgia.diem_dg)) as diemtb, dausach.id_sach, dausach.hinh_anh, dausach.ten_sach, dausach.gia_sach')
                ->join('danhgia', 'dausach.id_sach', '=', 'danhgia.id_sach')
                ->groupBy('dausach.id_sach')
                ->having('diemtb', '>=', $request->get('danhgia'))
                ->paginate(12);
        } elseif ($request->get('sach')) {
            if ($request->get('sach') == 1) {
                $list_sach = DB::table('dausach')->join('theloai', 'dausach.id_tl', '=', 'theloai.id_tl')->where('dausach.id_tl', $request->get('theloai'))->paginate(12);
                
            } else {
                $list_sach = DB::table('dausach')->join('theloai', 'dausach.id_tl', '=', 'theloai.id_tl')->where('dausach.id_tl', $request->get('theloai'))->paginate(12);
                
            }
        } elseif ($request->get('giatu') && $request->get('giaden')) {
            if ($request->giatu > $request->giaden) {
                $tu = $request->giaden;
                $den = $request->giatu;
            } else {
                $tu = $request->giatu;
                $den = $request->giaden;
            }
            $list_sach = DB::table('dausach')->whereBetween('gia_sach', [$tu, $den])->paginate(12);
          
        } elseif ($request->get('search')) {
            $list_sach = DB::table('dausach')
                ->where('ten_sach', 'like', '%' . $request->get('search') . '%')
                ->orWhere('mo_ta', 'like', '%' . $request->get('search') . '%')
                ->paginate(12);
        } else {
            $list_sach = DB::table('dausach')->paginate(12);
            
        }
        $array_sach = [];
        foreach ($list_sach as $key => $sach) {
            $km =  DB::table('khuyenmai')
                ->join('ctkhuyenmai', 'ctkhuyenmai.id_km', '=', 'khuyenmai.id_km')
                ->join('dausach', 'dausach.id_sach', '=', 'ctkhuyenmai.id_sach')
                ->where('dausach.id_sach', $sach->id_sach)
                ->where('ngay_ket_thuc','>=',now())
                ->groupBy('dausach.id_sach')
                ->first();
            $dg =  DB::table('danhgia')
                ->selectRaw('round(avg(danhgia.diem_dg)) as diemtb,count(danhgia.id_sach) as soluong, dausach.id_sach as idsach, dausach.ten_sach as tensach, dausach.hinh_anh as hinhanh, dausach.gia_sach as giasach')
                ->join('dausach', 'dausach.id_sach', '=', 'danhgia.id_sach')
                ->where('dausach.id_sach', $sach->id_sach)
                ->groupBy('dausach.id_sach')
                ->first();
            if ($dg && $km) {
                $array_sach[$key] = [
                    "id_sach" => $dg->idsach,
                    "ten_sach" => $dg->tensach,
                    "hinh_anh" => $dg->hinhanh,
                    "gia_sach" => $dg->giasach,
                    "diemtb" => $dg->diemtb,
                    "soluong" => $dg->soluong,
                    "khuyenmai" => $km->phantram_km,
                ];
            } elseif ($dg) {
                $array_sach[$key] = [
                    "id_sach" => $dg->idsach,
                    "ten_sach" => $dg->tensach,
                    "hinh_anh" => $dg->hinhanh,
                    "gia_sach" => $dg->giasach,
                    "diemtb" => $dg->diemtb,
                    "soluong" => $dg->soluong,
                    "khuyenmai" => 0,
                ];
            } elseif ($km) {
                $array_sach[$key] = [
                    "id_sach" => $sach->id_sach,
                    "ten_sach" => $sach->ten_sach,
                    "hinh_anh" => $sach->hinh_anh,
                    "gia_sach" => $sach->gia_sach,
                    "diemtb" => 0,
                    "soluong" => 0,
                    "khuyenmai" =>  $km->phantram_km,
                ];
            } else {
                $array_sach[$key] = [
                    "id_sach" => $sach->id_sach,
                    "ten_sach" => $sach->ten_sach,
                    "hinh_anh" => $sach->hinh_anh,
                    "gia_sach" => $sach->gia_sach,
                    "diemtb" => 0,
                    "soluong" => 0,
                    "khuyenmai" => 0,
                ];
            }
        }
        return view('home.page.loc_sach')
                ->with('list_tacgia', $list_tacgia)
                ->with('list_theloai', $list_theloai)
                ->with('dausach', $array_sach)
                ->with('dausach1', $list_sach);
    }

    public function Thongke()
    {
        //sach bán chạy
        $thongke =  DB::table('donhang')
            ->selectRaw('sum(ctgiohang.so_luong) as soluong, MONTH(ngay_dat) as thang, YEAR(ngay_dat) as nam, ctgiohang.id_sach')
            ->join('ctgiohang', 'donhang.id_dh', '=', 'ctgiohang.id_dh')
            //->where('donhang.trang_thai',4)
            ->groupBy('id_sach', 'thang')
            ->havingRaw('thang = 11')
            ->orderBy('soluong', 'desc')
            ->get();
        //tổng doanh thu theo tháng
        $thongke1 =  DB::table('donhang')
            ->selectRaw('sum(tong_tien) as tongtien, MONTH(ngay_dat) as thang, YEAR(ngay_dat) as nam')
            ->groupBy('thang')
            ->havingRaw('thang = 11')
            ->get();
        return dd($thongke);
    }


    public function khuyen_mai()
    {
        $list_theloai = DB::table('dausach')
            ->join('theloai', 'dausach.id_tl', '=', 'theloai.id_tl')
            ->orderby('theloai.id_tl', 'desc')
            ->get();
        $tl = DB::table('theloai')->get();
        return view('admin.quanly.Khuyenmai.add')->with('tl', $tl)->with('list_theloai', $list_theloai);
    }
    public function tl_km(Request $request)
    {
        if ($request->id_tl) {
            $list_theloai = DB::table('dausach')
                ->join('theloai', 'dausach.id_tl', '=', 'theloai.id_tl')
                ->where('theloai.id_tl', $request->id_tl)->orderby('theloai.id_tl', 'desc')->get();
        } else {
            $list_theloai = DB::table('dausach')
                ->join('theloai', 'dausach.id_tl', '=', 'theloai.id_tl')
                ->where('dausach.ten_sach', 'like', '%' . $request->timkiem . '%')
                ->orWhere('dausach.mo_ta', 'like', '%' . $request->timkiem . '%')
                ->orderby('theloai.id_tl', 'desc')->get();
        }
        return view('admin.quanly.Khuyenmai.theloaikm')->with('list_theloai', $list_theloai);
    }

    public function add_km(Request $request)
    {
        $data = array();
        $data['ten_km'] = $request->ten_km;
        $data['phantram_km'] = $request->phamtram_km;
        $data['ngay_bat_dau'] = $request->ngay_bat_dau;
        $data['ngay_ket_thuc'] = $request->ngay_ket_thuc;
        $idkm = DB::table('khuyenmai')->insertGetId($data);
        $ctdata = array();
        foreach ($request->id_sach as $id_sach) {
            $ctdata['id_km'] = $idkm;
            $ctdata['id_sach'] = $id_sach;
            DB::table('ctkhuyenmai')->insert($ctdata);
        }
        return Redirect::to('/khuyen-mai');
    }
}
