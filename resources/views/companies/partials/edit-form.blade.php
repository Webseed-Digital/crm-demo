<form method="POST" action="{{ route('companies.update', $company->id) }}" enctype="multipart/form-data">
    @method('PUT')
    @csrf
    <div class="box box-success box-solid">
        <div class="box-header with-border">
            <h3 class="box-title">Edit Company</h3>
            <!-- /.box-tools -->
        </div>

        <!-- /.box-header -->
        <div class="box-body">

            <div class="form-group @error('name') has-error @enderror">
                <label>Company Name:</label>
                <input type="text" class="form-control" name="name" maxlength="255" value="{{ old('name', $company->name) }}">
                @error('name')
                <div class="help-block">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group @error('email_address') has-error @enderror">
                <label>Contact email address:</label>
                <input type="email" class="form-control" name="email_address" maxlength="255"  value="{{ old('email_address', $company->email_address) }}">
                @error('email_address')
                <div class="help-block">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group @error('website') has-error @enderror">
                <label>Website URL:</label>
                <input type="text" class="form-control" name="website" value="{{ old('website', $company->website) }}">
                @error('website')
                <div class="help-block">{{ $message }}</div>
                @enderror
            </div>

            <label>Logo:</label>

            <p><img src="{{asset('storage/' . $company->logo)}}" style="max-width:300px" class="img-responsive"></p>

            <div class="form-group @error('logo') has-error @enderror">
                <label>Change Logo:</label>
                <input type="file" class="form-control" name="logo">
                @error('logo')
                <div class="help-block">{{ $message }}</div>
                @enderror
            </div>

        </div>

        <div class="box-footer">
            <div class="pull-right">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
        <!-- /.box-body -->
    </div>

</form>
