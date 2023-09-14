<?php

namespace App\Http\Controllers;

use App\Models\HistoryVoucher;
use Illuminate\Http\Request;
use App\Http\Requests\HistoryVoucherRequest\HistoryVoucherGetRequest;
use App\Interfaces\HistoryVoucherInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class HistoryVoucherController extends BaseController
{
    private $historyVoucherInterface;
   
    public function __construct(HistoryVoucherInterface $historyVoucherInterface)
    {
        $this->historyVoucherInterface            = $historyVoucherInterface;
    }

    public function show(HistoryVoucherGetRequest $request) {

        $selectedColumn = array('*');
        $get = $this->historyVoucherInterface->show($request->all(),$selectedColumn,'show_all');

        if($get['queryStatus']) {
            
            return $this->handleResponse( $get['queryResponse'],'get history voucher success',$request->all(),str_replace('/','.',$request->path()),201);
        }

        $data  = array([
            'field' =>'show-history-voucher',
            'message'=> 'error when show history voucher'
        ]);

        return   $this->handleError( $data,$get['queryMessage'],$request->all(),str_replace('/','.',$request->path()),422);

    }
}
