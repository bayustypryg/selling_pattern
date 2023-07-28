<?php

namespace App\Http\Controllers;

use App\Imports\TransactionImport;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class TransactionController extends Controller
{
    public function index(Request $request) {
        
        $user = Auth::user();
        $data = Transaction::where('user_id', $user->id)->latest();
        
        if ($request->search) {
            $data->where('cif', 'like', '%' . $request->search . '%')
                ->orWhere('trx_type', 'like', '%' . $request->search . '%')
                ->orWhere('product_nm', 'like', '%' . $request->search . '%')
                ->orWhere('product_type', 'like', '%' . $request->search . '%')
                ->orWhere('app_source', 'like', '%' . $request->search . '%')
                ->orWhere('curr_cd', 'like', '%' . $request->search . '%');
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

        return view('transaction.index', [
            'title' =>  'Data Transaksi',
            'data'  =>  $data,
            'lengthOptions' => $lengthOptions,
            'length'        => $length,
        ]);
    }

    public function import() {
        return view('transaction.import', [
            'title' =>  'Import Data Transaksi'
        ]);
    }

    public function storeImport(Request $request) {
        $request->validate([
            'file' =>   'required|file|mimes:xlsx, xls, csv'
        ]);

        Excel::import(new TransactionImport, $request->file('file'));

        return response()->json(['message' => 'Data has been imported!']);
    }

    public function deleteAll() {
        Transaction::where('user_id', Auth::user()->id)->delete();
        return redirect()->back();
    }

    public function delete($id) {
        Transaction::find($id)->delete();
        return redirect()->back()->with('success', 'Data has been deleted!');
    }
}
