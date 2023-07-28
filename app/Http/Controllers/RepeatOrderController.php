<?php

namespace App\Http\Controllers;

use App\Exports\RepeatOrderExport;
use App\Models\RepeatOrder;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class RepeatOrderController extends Controller
{
    public function index(Request $request) {      

        $data = RepeatOrder::where('user_id', Auth::user()->id)->latest();

        if ($request->search) {
            $data->whereRelation('transaction', 'cif', 'like', '%' . $request->search . '%')
                ->orWhereRelation('transaction', 'trx_type', 'like', '%' . $request->search . '%')
                ->orWhereRelation('transaction', 'product_nm', 'like', '%' . $request->search . '%')
                ->orWhereRelation('transaction', 'product_type', 'like', '%' . $request->search . '%')
                ->orWhereRelation('transaction', 'app_source', 'like', '%' . $request->search . '%')
                ->orWhereRelation('transaction', 'curr_cd', 'like', '%' . $request->search . '%');
        }

        $length = $request->input('length', 10); // Mengambil nilai length dari request, default: 10

        // Pilihan jumlah entri per halaman yang tersedia
        $lengthOptions = [10, 50, 100, -1]; // -1 untuk menampilkan semua entri

        if (!in_array($length, $lengthOptions)) {
            $length = 10; // Menggunakan default jika nilai length tidak valid
        }
        
        if ($length == -1) {
            $data = $data->get();
        } else {
            $data = $data->paginate($length)->appends(['search' => $request->search]);
        }

        return view('repeat-order.index', [
            'title'     =>  'Repeat Order',
            'data'      =>  $data,
            'lengthOptions' => $lengthOptions,
            'length'        => $length,
        ]);
    }

    public function store() {
        set_time_limit(600);
        $result = DB::table('transactions')
                ->select('cif', 
                        DB::raw('COUNT(trx_type) as subscription_count'),
                        DB::raw('SUM(CASE WHEN trx_type = "Redemption" THEN 1 ELSE 0 END) as redemption_count'))
                ->whereIn('cif', function ($query) {
                    $query->select('cif')
                        ->from('transactions')
                        ->where('trx_type', 'Subscription')
                        ->groupBy('cif')
                        ->havingRaw('COUNT(trx_type) > 2');
                })
                ->whereNotIn('cif', function ($query) {
                    $query->select('cif')
                        ->from('transactions')
                        ->whereIn('trx_type', ['Subscription', 'Redemption'])
                        ->groupBy('cif')
                        ->havingRaw('COUNT(trx_type) = 1');
                })
                ->groupBy('cif')
                ->get();
            
        $cif = $result->pluck('cif')->toArray();

        // Menggunakan each untuk pemrosesan data tanpa batas (unlimited)
        Transaction::where('user_id', Auth::user()->id)
        ->whereIn('cif', $cif)
        ->each(function ($repeat) {
            RepeatOrder::firstOrCreate([
                'user_id' => Auth::user()->id,
                'transaction_id' => $repeat->id
            ]);
        });
        
        return redirect()->back()->with('success', 'Berhasil!');
    }

    public function detailCif(Request $request, $cif) {
        
        $data = RepeatOrder::whereRelation('transaction', 'cif', $cif)->latest();

        if ($request->search) {
            $data->whereRelation('transaction', 'cif', 'like', '%' . $request->search . '%')
                ->orWhereRelation('transaction', 'trx_type', 'like', '%' . $request->search . '%')
                ->orWhereRelation('transaction', 'product_nm', 'like', '%' . $request->search . '%')
                ->orWhereRelation('transaction', 'product_type', 'like', '%' . $request->search . '%')
                ->orWhereRelation('transaction', 'app_source', 'like', '%' . $request->search . '%')
                ->orWhereRelation('transaction', 'curr_cd', 'like', '%' . $request->search . '%');
        }

        $length = $request->input('length', 10); // Mengambil nilai length dari request, default: 10

        // Pilihan jumlah entri per halaman yang tersedia
        $lengthOptions = [10, 50, 100, -1]; // -1 untuk menampilkan semua entri

        if (!in_array($length, $lengthOptions)) {
            $length = 10; // Menggunakan default jika nilai length tidak valid
        }
        
        if ($length == -1) {
            $data = $data->get();
        } else {
            $data = $data->paginate($length)->appends(['search' => $request->search]);
        }

        return view('repeat-order.detail.cif', [
            'title'     =>  'Detail Repeat Order '. $cif,
            'data'      =>  $data,
            'lengthOptions' => $lengthOptions,
            'length'        => $length,
            'cif'           =>  $cif,
        ]);
    }

    public function export() {
        return Excel::download(new RepeatOrderExport, 'repeat-order.xlsx');
    }
}
