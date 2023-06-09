<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Employee;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $employees = Employee::paginate(10);

        return view('employee.list', ['employees' => $employees]);
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        $companies = Company::all();
        return view('employee.form', ['companies' => $companies]);
    }

    /**
     * Store a newly created resource in storage.
     *
     *
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'company_id' => 'required|exists:companies,id|',
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'phone' => 'nullable',
        ],[
            'company_id.required' => ' The company field is required.',
            'first_name.min' => ' The first name field is required.',
            'last_name.required' => ' The last name field is required.',
            'email.min' => ' Enter a proper email address',
        ]);

        try {
            $employee = new Employee();
            $employee->company_id = $request->company_id;
            $employee->first_name = $request->first_name;
            $employee->last_name = $request->last_name;
            $employee->email = $request->email;
            $employee->phone = $request->phone;

            $query = $employee->save();

            return back()
                ->with('success','You have successfully added the employee.');

        } catch (\Throwable $exception) {
            Log::error('Employee Details create error | ' . $exception->getMessage());
            return back()->with('error','Please check again');
        }
    }

    /**
     * Display the specified resource.
     *
     *
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     */
    public function edit($id)
    {
        $employee = Employee::where('id', $id)->first();
        $companies = Company::all();

        return view('employee.edit', ['employee' => $employee, 'companies' => $companies]);
    }

    /**
     * Update the specified resource in storage.
     *
     *
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'company_id' => 'required|exists:companies,id|',
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'phone' => 'nullable',
        ],[
            'company_id.required' => ' The company field is required.',
            'first_name.min' => ' The first name field is required.',
            'last_name.required' => ' The last name field is required.',
            'email.min' => ' Enter a proper email address',
        ]);

        try {
            $employee = Employee::find($id);
            $employee->company_id = $request->company_id;
            $employee->first_name = $request->first_name;
            $employee->last_name = $request->last_name;
            $employee->email = $request->email;
            $employee->phone = $request->phone;

            $query = $employee->save();

            return back()
                ->with('success','You have successfully updated the employee.');

        } catch (\Throwable $exception) {
            Log::error('Employee Details update error | ' . $exception->getMessage());
            return back()
                ->with('error','Error in updating the employee.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     *
     */
    public function destroy($id)
    {
        try {
            Employee::find($id)->delete();

            return back()
                ->with('success','Employee deleted successfully.');

        } catch (\Throwable $exception) {
            Log::error('Employee Details delete error | ' . $exception->getMessage());
            return back()
                ->with('error','Please check again');
        }
    }
}
