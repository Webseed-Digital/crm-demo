<form method="POST" action="/employees">
    @csrf
    <div class="box box-success box-solid">
        <div class="box-header with-border">
            <h3 class="box-title">Add Employee</h3>
            <!-- /.box-tools -->
        </div>

        <!-- /.box-header -->
        <div class="box-body">

            <div class="form-group @error('first_name') has-error @enderror">
                <label>First Name:</label>
                <input type="text" class="form-control" name="first_name" maxlength="255" value="{{ old('first_name') }}">
                @error('first_name')
                <div class="help-block">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group @error('surname') has-error @enderror">
                <label>Surname:</label>
                <input type="text" class="form-control" name="surname" maxlength="255" value="{{ old('surname') }}">
                @error('surname')
                <div class="help-block">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group @error('email_address') has-error @enderror">
                <label>Contact email address:</label>
                <input type="email" class="form-control" name="email_address" maxlength="255"  value="{{ old('email_address') }}">
                @error('email_address')
                <div class="help-block">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group @error('phone') has-error @enderror">
                <label>Phone number:</label>
                <input type="text" class="form-control" name="phone"  value="{{ old('phone') }}">
                @error('phone')
                <div class="help-block">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group @error('company_id') has-error @enderror">
                <label>Company:</label>
                <select name="company_id" class="form-control">
                    @foreach($companiesList as $company)
                        <option value="{{ $company->id }}"
                                @if( $company->id == old('company_id') )
                                selected
                            @endif
                        > {{ $company->name }} </option>
                    @endforeach
                </select>
                @error('company_id')
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
