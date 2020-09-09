@extends('adminlte::page')

@section('htmlheader_title')
    Companies
@endsection

@section('contentheader_title')
    Companies
@endsection


@section('main-content')
    <div class="container-fluid spark-screen">
        <div class="row">
            <div class="col-md-9 col-md-offset-1">

                @if (Session::has('message'))
                    <div class="alert alert-info mb-3">{{ Session::get('message') }}</div>
                @endif

                @include('companies.partials.index-box')

            </div>
        </div>
    </div>
@endsection
