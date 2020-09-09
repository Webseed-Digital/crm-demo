@extends('adminlte::layouts.app')

@section('htmlheader_title')
    CRM Dashboard
@endsection

@section('contentheader_title')
    CRM Dashboard
@endsection

@section('main-content')
    <div class="container-fluid spark-screen">

        <div class="row">
            <div class="col-md-6">
                @include('companies.partials.index-box')
            </div>

            <div class="col-md-6">
                @include('employees.partials.index-box')
            </div>
        </div>

    </div>
@endsection
