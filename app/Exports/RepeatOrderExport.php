<?php

namespace App\Exports;

use App\Models\RepeatOrder;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;

class RepeatOrderExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        $data = RepeatOrder::all();
        return view('repeat-order.export', [
            'data'  =>  $data
        ]);
    }
}
