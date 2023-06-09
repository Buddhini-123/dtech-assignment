<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     *
     */
    public function index()
    {
        $companies = Company::paginate(10);

        return view('company.list', ['companies' => $companies]);
    }

    /**
     * Show the form for creating a new resource.
     *
     *
     */
    public function create()
    {
        return view('company.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required',
            'email' => 'required|email',
            'website' => 'nullable',
        ],[
            'name.required' => ' The name field is required.',
            'email.min' => ' Enter a proper email address',
        ]);

        try {
            $company = new Company();
            $company->name = $request->name;
            $company->email = $request->email;
            $company->website = $request->website;

            $query = $company->save();

            return back()
                ->with('success','You have successfully added the company.');

        } catch (\Throwable $exception) {
            Log::error('Company Details create error | ' . $exception->getMessage());
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
     *
     */
    public function edit($id)
    {
        $company = Company::where('id', $id)->first();

        return view('company.edit', ['company' => $company]);
    }

    /**
     * Update the specified resource in storage.
     *
     *
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'name' => 'required',
            'email' => 'required|email',
            'website' => 'nullable',
        ],[
            'name.required' => ' The name field is required.',
            'email.min' => ' Enter a proper email address',
        ]);

        try {

            $company = Company::find($id);
            $company->name = $request->name;
            $company->email = $request->email;
            $company->website = $request->website;

            $query = $company->save();

            return back()
                ->with('success','You have successfully updated the company.');

        } catch (\Throwable $exception) {
            Log::error('Company Details update error | ' . $exception->getMessage());
            return back()->with('error','Please check again');
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
            Company::find($id)->delete();

            return back()
                ->with('success','Company deleted successfully.');

        } catch (\Throwable $exception) {
            Log::error('Company Details delete error | ' . $exception->getMessage());
            return back()->with('error','Please check again');
        }
    }
}
