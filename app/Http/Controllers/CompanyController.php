<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Company;
use App\Employee;
use Illuminate\Support\Facades\Auth;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::check())
        {
            $company = Company::paginate(5);
            return view('companies.index',compact('company'));
        }
        else {
            return redirect()->route('login');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::check())
        {
            return view('companies.add');
        }
        else {
            return redirect()->route('login');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
        $this->validate($request, [
            'name' => 'required|max:128',
            'email'=> 'required',
            'logo' => 'required|mimes:png|max:2048',
            
        ]);
        $logoName = $request->logo->getClientOriginalName() . '-' . time() . '.' . $request->logo->extension();
        $request->logo->move(public_path('storage'), $logoName);
        Company::create([
            'name' => $request->name,
            'logo' => $logoName,
            'email' => $request->email,
            ]);
        
        return redirect()->route('company.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Auth::check())
        {
        $company = Company::findOrFail($id);
        return view('companies.edit', compact('company'));
        }

        else {
            return redirect()->route('login');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
       
        $this->validate($request, [
            'name' => 'required|max:128',
            'email'=> 'required',
           
            
        ]);
        
        $company=Company::findOrFail($id);

        $company->name = $request->name;
        $company->email = $request->email;
        $company->save();
       
        if (empty($request->logo)){
            $company->logo = $company->logo;
        }
        else{
            $logoName = $request->logo->getClientOriginalName() . '-' . time() . '.' . $request->logo->extension();
            $request->logo->move(public_path('storage'), $logoName);
        }
        $company->save();
        
        return redirect()->route('company.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $company=Company::findOrFail($id);
        if(Employee::where('id_company', $id)->exists())
        {
            $employee=Employee::select('*')->where('id_company',$id)->get();

            foreach($employee as $pgw){
                $pgw->delete();
            }
        }

        $company->delete();
        return redirect()->route('company.index');
    }
}
