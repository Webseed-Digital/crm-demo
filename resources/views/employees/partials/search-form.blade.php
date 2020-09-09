@if(isset($companiesList))
    <div style="margin-bottom:2rem">
        <form method="post" action="{{route('employees.search')}}">
            @csrf
            <div style="display:flex; justify-content:flex-end">
                <label for="company_id" style="margin-right:1rem">Filter by company:</label>
                <div class="input-group">
                    <select name="company_id" class="form-control">
                        @foreach($companiesList as $company)
                            <option value="{{ $company->id }}"
                                    @if( isset($currentCompany) && $company->id == $currentCompany->id)
                                    selected
                                @endif
                            > {{ $company->name }} </option>
                        @endforeach
                    </select>
                    <div class="input-group-btn">
                        <button type="submit" class="btn btn-primary">Go</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endif

