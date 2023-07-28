<table class="table">
    <thead>
        <tr>
            <th>No.</th>
            <th>TRX_DT</th>
            <th>CIF</th>
            <th>NET_AMT</th>
            <th>PRODUCT_TYPE</th>
            <th>PRODUCT_NM</th>
            <th>TRX_TYPE</th>
            <th>FEE_AMT</th>
            <th>APP_SOURCE</th>
            <th>CURR_CD</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $key => $item)
        <tr>
            <td>{{$key + 1}}</td>
            <td>{{date('d-m-Y', strtotime($item->transaction->trx_dt))}}</td>
            <td>
                <a href="{{ route('repeat-order.detail-cif', ['cif'=>$item->transaction->cif]) }}">{{$item->transaction->cif}}</a>
            </td>
            <td>{{$item->transaction->net_amt}}</td>
            <td>{{$item->transaction->product_type}}</td>
            <td>{{$item->transaction->product_nm}}</td>
            <td>{{$item->transaction->trx_type}}</td>
            <td>{{$item->transaction->fee_amt}}</td>
            <td>{{$item->transaction->app_source}}</td>
            <td>{{$item->transaction->curr_cd}}</td>
        </tr>
        @endforeach
    </tbody>
</table>