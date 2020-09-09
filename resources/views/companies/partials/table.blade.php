@if(isset($companies))

    <table class="table table-bordered">
        <thead>
        <tr>
            <td>Logo</td>
            <td>Name</td>
            <td>Email</td>
            <td>Website</td>
            <td>Total Employees</td>
            <td></td>
        </tr>
        </thead>
        <tbody>
        @if($companies->count() == 0)
            <tr>
                <td colspan="6" align="center"><strong>No companies found.</strong></td>
            </tr>
        @endif
        @foreach($companies as $company)
            <tr>
                <td>
                    <img src="{{asset('storage/' . $company->logo)}}" width="100" class="img-responsive">
                </td>
                <td>{{ $company->name }}</td>
                <td>{{ $company->email_address }}</td>
                <td>{{ $company->website }}</td>
                <td>{{ $company->employees()->count() }}</td>
                <td>
                    <div class="controls" style="display:flex">
                        <a href="{{ route('companies.edit', $company) }}" class="btn btn-primary btn-sm"> <span class="fa fa-pencil"></span> </a>
                        <form method="POST" action="companies/{{$company->id}}">
                            @csrf
                            @method('DELETE')
                            <button type="button" data-toggle="modal" data-target="#deleteMessage_{{$company->id}}" class="btn btn-sm btn-danger"><span class="fa fa-trash"></span></button>

                            <div class="modal fade in" tabindex="-1" role="dialog" id="deleteMessage_{{$company->id}}">
                                <div class="modal-dialog " role="document">
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            <h2>Delete {{$company->name}}?</h2>
                                            <p>Deleting this company will also delete any assigned employees and this cannot be undone. Are you sure you wish to continue?</p>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn btn-sm btn-danger"><span class="fa fa-trash"></span> Yes, Delete</button>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </form>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {{ $companies->links() }}


@endif
