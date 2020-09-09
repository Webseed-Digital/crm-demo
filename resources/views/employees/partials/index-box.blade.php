<div class="box box-success box-solid">
    <div class="box-header with-border">
        @if(isset($currentCompany))
            <h3 class="box-title">Employees of {{$currentCompany->name}}</h3>
        @else
            <h3 class="box-title">Employees</h3>
    @endif
    <!-- /.box-tools -->
    </div>


    <!-- /.box-header -->
    <div class="box-body">

        @include('employees.partials.search-form')


        @include('employees.partials.table')

    </div>

    <div class="box-footer">
        <div class="pull-right">
            <a href="{{ route('employees.create') }}" class="btn btn-primary"><span class="fa fa-plus-circle"></span> &nbsp; Add</a>
        </div>
    </div>
    <!-- /.box-body -->
</div>
