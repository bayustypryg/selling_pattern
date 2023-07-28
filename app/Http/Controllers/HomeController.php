<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index() {

        // $transaction = Transaction::where('trx_type', 'Redemption')->groupBy('app_source')
        // ->select('app_source', DB::raw('COUNT(*) as total_transactions'))
        // ->get();
        // dd($transaction->toArray());

        return view('home.index', [
            'title' =>  'Dashboard',
        ]);
    }
}
