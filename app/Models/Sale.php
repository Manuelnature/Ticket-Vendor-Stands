<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Sale extends Model
{
    protected $table = 'tbl_sales';
    public $timestamps = false;


    public static function my_events_from_sales($event_id){
        try{
            return  DB::table('tbl_sales')
            ->select('tbl_sales.*', 'tbl_events.*', 'tbl_sales.tickets AS sales_tickets', 'tbl_events.tickets AS events_tickets')
            ->join('tbl_events', 'tbl_events.id', '=', 'tbl_sales.event_id')
            ->where('tbl_events.id', '=', $event_id)
            ->get();
        }catch(exception $e){
            echo 'Caught exception';
        }
    }


    public static function my_event_sales_for_vending_point($event_id, $vending_point_id){
        try{
            return  DB::table('tbl_sales')
            ->select('tbl_sales.*')
            ->where('event_id', '=', $event_id)
            ->where('vending_point_id', '=', $vending_point_id)
            ->get();
        }catch(exception $e){
            echo 'Caught exception';
        }
    }


}
