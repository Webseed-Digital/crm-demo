<div class="box box-success box-solid">
    <div class="box-header with-border">
        <h3 class="box-title">Companies</h3>
        <!-- /.box-tools -->
    </div>

    <!-- /.box-header -->
    <div class="box-body">
        @include('companies.partials.table')
    </div>

    <div class="box-footer">
        <div class="pull-right">
            <a href="{{ route('companies.create') }}" class="btn btn-primary"><span class="fa fa-plus-circle"></span> &nbsp; Add</a>
        </div>
    </div>
    <!-- /.box-body -->
</div>
