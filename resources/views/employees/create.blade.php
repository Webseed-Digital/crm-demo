@extends('adminlte::page')

@section('htmlheader_title')
	Employees
@endsection

@section('contentheader_title')
	Employees
@endsection


@section('main-content')
	<div class="container-fluid spark-screen">
		<div class="row">
			<div class="col-md-9 col-md-offset-1">

                @include('employees.partials.create-form')

			</div>
		</div>
	</div>
@endsection
