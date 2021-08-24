<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TinhThanhPho;
use App\QuanHuyen;
use App\XaPhuongThiTran;
use App\PhiVanChuyen;
class PhiVanChuyenController extends Controller
{
    
    public function getThem(){
        $city = TinhThanhPho::all();
        $phivanchuyen = PhiVanChuyen::paginate(5);
        return view('admin.phivanchuyen.them',compact('city','phivanchuyen'));
    }
    public function postThem(Request $request)
    {
        $data = $request->all();
        $fee_ship = new PhiVanChuyen();
        $fee_ship->matp = $data['TinhThanhPho'];
        $fee_ship->maqh = $data['QuanHuyen'];
        $fee_ship->xaid = $data['XaPhuong'];
        $fee_ship->fee_feeship = $data['PhiVanChuyen'];
        $fee_ship->save();


        

        
    }
    public function postSelect(Request $request)
    {
        $data = $request->all();
        if($data['action'])
        {
            $output = '';
            if($data['action']=="TinhThanhPho"){
                $select_quan= QuanHuyen::where('matp',$data['matp'])->orderby('maqh','ASC')->get();
                $output.='<option value="0">--Chọn quận huyện--</option>';
                foreach($select_quan as $slq){
                $output.='<option value="'.$slq->maqh.'">'.$slq->name_quanhuyen.'</option>'; 
            }
                
            }else{
                $select_xa= XaPhuongThiTran::where('maqh',$data['matp'])->orderby('xaid','ASC')->get();
                $output.='<option value="0">--Chọn xã phường--</option>';
                foreach($select_xa as $slx){
                $output.='<option value="'.$slx->xaid.'">'.$slx->name_xaphuong.'</option>'; 

                }
            } 
            echo $output;  
        }
    }
    public function postSua(Request $request)
    {
       
        $data = $request->all();
        $fee_ship = PhiVanChuyen::find($data['feeship_id']);
        $feeship_value = rtrim($data['feeship_value'],',');
        $fee_ship->fee_feeship =  $feeship_value;
        $fee_ship->save();
    }
    public function getXoa($id){
        $phivanchuyen = PhiVanChuyen::find($id);
        $phivanchuyen->delete();
        return redirect('admin/phivanchuyen/them')->with('thongbao','Xóa phí vận chuyển thành công!!!');
    }
    
    
}
