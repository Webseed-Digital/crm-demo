<?php

namespace App\Http\Controllers;

use App\Company;
use App\Employee;
use App\Http\Requests\StoreEmployee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class EmployeesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $employees = Employee::paginate(10);
        $companiesList = Company::all();
        return view('employees/index', compact('employees', 'companiesList'));
    }

    public function search(Request $request)
    {
        $currentCompany = Company::findOrFail($request->company_id);
        $employees = $currentCompany->employees()->paginate(10);
        $companiesList = Company::all();
        return view('employees/index', compact('employees', 'companiesList', 'currentCompany'));
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        $companiesList = Company::all();
        return view('employees.create', compact('companiesList'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(StoreEmployee $request)
    {
        $validated = $request->validated();
        $company = Company::find($validated['company_id']);

        $employee = $company->employees()->create($validated); // Create employee as a child of the company

        Session::flash('message', 'Successfully added the employee.');
        return redirect('employees');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     */
    public function edit($id)
    {
        $employee = Employee::findOrFail($id);
        $companiesList = Company::all();
        return view('employees.edit', compact('employee', 'companiesList'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     */
    public function update(StoreEmployee $request, $id)
    {
        $employee = Employee::findorFail($id);
        $validated = $request->validated();
        $employee->fill($validated);

        // If the company has changed, update the relationship.
        if($validated['company_id'] != $employee->company->id){
            $employee->company()->dissociate();
            $company = Company::find($validated['company_id']);
            $employee->company()->associate($company);
        }

        $employee->save();

        Session::flash('message', 'Successfully updated the employee.');
        return redirect('employees');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $employee = Employee::findOrFail($id);
        $employee->delete();

        Session::flash('message', 'Successfully deleted the employee.');
        return redirect('employees');

    }
}
