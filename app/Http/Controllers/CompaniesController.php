<?php

namespace App\Http\Controllers;

use App\Company;
use App\Http\Requests\StoreCompany;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CompaniesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $companies = Company::paginate(10);
        return view('companies.index', compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        return view('companies.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(StoreCompany $request)
    {
        $validated = $request->validated();
        $company = new Company($validated);
        $company->logo = $validated['logo']->store('images', 'public');

        $company->save();

        Session::flash('message', 'Successfully added the company.');

        return redirect('companies');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     */
    public function edit($id)
    {
        $company = Company::findOrFail($id);
        return view('companies.edit', compact('company'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     */
    public function update(StoreCompany $request, $id)
    {
        $company = Company::findOrFail($id);
        $validated = $request->validated();
        $company->fill($validated);
        if (isset($validated['logo'])){
            // A new logo has been uploaded and validated
            $company->logo = $validated['logo']->store('images', 'public');
        }

        $company->save();
        Session::flash('message', 'Successfully updated the company.');
        return redirect('companies');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     */
    public function destroy($id)
    {
        $company = Company::findOrFail($id);

        // Need to remove all employees of this company as well.
        foreach($company->employees as $employee){
            $employee->delete();
        }
        $company->delete();

        Session::flash('message', 'Successfully deleted the company.');
        return redirect('companies');
    }
}
