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
                @include('companies.partials.edit-form')
            </div>
        </div>
    </div>
@endsection
