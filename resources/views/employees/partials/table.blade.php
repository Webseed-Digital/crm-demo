@if(isset($employees))

    <table class="table table-bordered">
        <thead>
        <tr>
            <td>First Name</td>
            <td>Surname</td>
            <td>Email</td>
            <td>Phone Number</td>
            <td>Company</td>
            <td></td>
        </tr>
        </thead>
        <tbody>
        @if($employees->count() == 0)
            <tr>
                <td colspan="6" align="center"><strong>No employees found.</strong></td>
            </tr>
        @endif
        @foreach($employees as $employee)
            <tr>
                <td>{{ $employee->first_name }}</td>
                <td>{{ $employee->surname }}</td>
                <td>{{ $employee->email_address }}</td>
                <td>{{ $employee->phone }}</td>
                <td>{{ $employee->company->name }}</td>
                <td>
                    <div class="controls" style="display:flex">
                        <a href="{{ route('employees.edit', $employee) }}" class="btn btn-primary btn-sm"> <span class="fa fa-pencil"></span> </a>
                        <form method="POST" action="employees/{{$employee->id}}">
                            @csrf
                            @method('DELETE')
                            <button type="button" data-toggle="modal" data-target="#deleteMessage_{{$employee->id}}" class="btn btn-sm btn-danger"><span class="fa fa-trash"></span></button>

                            <div class="modal fade in" tabindex="-1" role="dialog" id="deleteMessage_{{$employee->id}}">
                                <div class="modal-dialog " role="document">
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            <h2>Delete {{$employee->first_name}} {{$employee->surname}}?</h2>
                                            <p>Deleting this employee cannot be undone. Are you sure you wish to continue?</p>
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

    {{ $employees->links() }}


@endif
