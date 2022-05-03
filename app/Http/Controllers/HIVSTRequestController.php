<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\HIVSTRequest;

class HIVSTRequestController extends Controller
{
  public static function getUserLastestRequestedKitWithOutResults($user_id)
  {
    
   return  $request = \DB::table('h_i_v_s_t_requests')
    ->select(
        'h_i_v_s_t_requests.id',
        'requester',
        'access_location',
        'picked'
    )->where('requester',$user_id)
    ->whereNotExists( function ($query) {
        $query->select(DB::raw(1))
        ->from('h_i_v_s_t_requested_kits_results')
        ->whereRaw('h_i_v_s_t_requests.id = h_i_v_s_t_requested_kits_results.requested_kit');
    })
    ->get()->first();
  }
}
