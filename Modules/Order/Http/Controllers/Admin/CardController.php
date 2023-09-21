<?php

namespace Modules\Order\Http\Controllers\Admin;

use Excel;
use Illuminate\Support\Facades\Log;
use Modules\Core\Http\Requests\Request;
use Modules\Order\Entities\Order;
use Illuminate\Routing\Controller;
use Modules\Admin\Traits\HasCrudActions;
use Modules\User\Entities\User;

class CardController extends Controller
{
    protected $label = 'card::cards.card';
    function index(){
        $data = [];
        $cards_user_data = User::whereNotNull('parent_id');
        $request = request()->all();
        if(!empty($request)){
            if($request['status'] == 'Available'){
                $cards_user_data = $cards_user_data->where('username','=','slack.user.admin.generate')->where('password','=','nopassword');
            }
            /*if($request['status'] == 'Purchased'){
                $cards_user_data = $cards_user_data->whereNotNull('order_id')->where('password','=','nopassword');
            }*/
            if($request['status'] == 'Used'){
                $cards_user_data = $cards_user_data->where('username','!=','slack.user.admin.generate');
            }
            if(isset($request['id_search']) && !empty($request['id_search'])){
                $id_search = _decode($request['id_search']);
                $cards_user_data = $cards_user_data->where('id','=',$id_search);
            }
            if(isset($request['batch_name']) && !empty($request['batch_name'])){
                $batch_name = $request['batch_name'];
                $cards_user_data = $cards_user_data->where('batch_name','=',$batch_name);
            }
            if(isset($request['id_start']) && !empty($request['id_start'])){
                $id_start = $request['id_start'];
                $cards_user_data = $cards_user_data->where('id','>=',$id_start);
            }
            if(isset($request['id_end']) && !empty($request['id_end'])){
                $id_end = $request['id_end'];
                $cards_user_data = $cards_user_data->where('id','<=',$id_end);
            }
            if(isset($request['date_start']) && !empty($request['date_start'])){
                $date_start = $request['date_start'].' 00:00:00';
                $cards_user_data = $cards_user_data->where('created_at','>=',$date_start);
            }
            if(isset($request['date_end']) && !empty($request['date_end'])){
                $date_end = $request['date_end'].' 23:59:59';
                $cards_user_data = $cards_user_data->where('created_at','<=',$date_start);
            }

        }
        $cards_user_data = $cards_user_data->paginate(30);
        $data['cards_user_data'] = $cards_user_data;
        return view('order::admin.cards.index',$data);
    }
    function generateCards(){
        $request = request();
        //_debug($request->all(),1);
        $quantity = $request->quantity;
        for ($i=1;$i<=$quantity;$i++){
            $temp_user_data = [];
            $temp_user_data['username'] = 'slack.user.admin.generate';
            $temp_user_data['first_name'] = 'NULL';
            $temp_user_data['last_name'] = 'NULL';
            $temp_user_data['email'] = 'NULL';
            $temp_user_data['password'] = 'nopassword';
            $temp_user_data['batch_name'] = $request->batch_name;
            $temp_user_data['parent_id'] = auth()->user()->id;

            $last_inserted_id = User::insertGetId($temp_user_data);

            /*$final_username = $temp_user_data['username'].'.'.$last_inserted_id;
            User::whereId($last_inserted_id)->update(['username'=>$final_username]);*/
        }
        return redirect()->back()->with('success','Cards Generated Successfully');
    }
    function exportCards(){
        $cards_user_data = User::whereNotNull('parent_id');
        /*$cards_user_data = $cards_user_data->where('password','=','nopassword');*/
        $cards_user_data = $cards_user_data->get()->toArray();
        $data_export = [];
        foreach ( $cards_user_data as $cards_user_row ) {
            $data_export_row = [];
            $data_export_row[ 'URL' ] = route('cardLogin',\_encode($cards_user_row['id']));
            $data_export_row[ 'Status' ] =($cards_user_row['email'] == 'NULL')?'Available':'Used';
            $data_export_row[ 'QR' ] = getBarCodeImage($cards_user_row['id'],'url');
            $data_export[] = $data_export_row;
        }
        return Excel::create( 'availables-' . date( 'Y-m-d' ), function ( $excel )use( $data_export ) {
            $excel->sheet( 'mySheet', function ( $sheet ) use( $data_export ) {
               /* $objDrawing = new \PHPExcel_Worksheet_Drawing;
                //$objDrawing->setPath();
                //$objDrawing->setCoordinates('A2');
                $objDrawing->setWorksheet($sheet);*/
                $sheet->fromArray( $data_export );
            });
        })->download( 'xls' );

    }


    public function urlAssigned() {
        return ['success' => true];
    }
}
