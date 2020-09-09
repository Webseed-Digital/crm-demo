<?php

namespace App\Http\Controllers;

use App\Company;
use App\Employee;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        // These are used for the partials included in the dashboard, based off of their own controllers.
        $companies = Company::paginate(10);
        $employees = Employee::paginate(10);
        $companiesList = Company::all();

        return view('admin/home', compact('companies', 'employees', 'companiesList'));
    }
}
