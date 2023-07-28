@extends('layouts.app')
@section('content')
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="card-title">{{$title}}</h4>
                <form action="{{ route('transaction') }}" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="search" placeholder="search" value="{{Request('search')}}">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-outline-success" type="button" id="button-addon2"><i class="fas fa-search"></i></button>
                        </div>
                        <div class="input-group-append">
                            <a href="{{ route('transaction') }}" class="btn btn-outline-danger"><i class="far fa-window-close"></i></a>
                        </div>
                    </div>
                </form>
                <div class="btn-group">
                    <a href="{{ route('transaction.import') }}" class="btn btn-sm btn-primary"><i class="fas fa-file-import mr-2"></i>Import Data</a>
                    <a href="{{ route('transaction.turncate') }}" class="btn btn-sm btn-danger" onclick="return confirm('Apa anda yakin?')"><i class="fas fa-trash mr-2"></i>Delete Data</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
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
                            <td>{{date('d-m-Y', strtotime($item->trx_dt))}}</td>
                            <td>{{$item->cif}}</td>
                            <td>{{$item->net_amt}}</td>
                            <td>{{$item->product_type}}</td>
                            <td>{{$item->product_nm}}</td>
                            <td>{{$item->trx_type}}</td>
                            <td>{{$item->fee_amt}}</td>
                            <td>{{$item->app_source}}</td>
                            <td>{{$item->curr_cd}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="d-flex">
                <div class="mx-auto">
                    {{$data->links()}}
                </div>
            </div>
        </div>
    </div>
@endsection