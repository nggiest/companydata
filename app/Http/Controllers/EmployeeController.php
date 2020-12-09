<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Employee;
use App\Company;
use Auth;
use Illuminate\Support\Facades\DB;

class EmployeeController extends Controller
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
        $employee=DB::table('employees')
        ->join ('companies','companies.id','=','employees.id_company')
        ->select('employees.*','companies.name as perusahaans')
        ->get();
        $employee=Employee::paginate(5);
       
        return view('employees.index', compact('employee'));
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
            $company = Company::all();
            return view ('employees.add', compact('company'));
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
            'name_employee' => 'required',
            'id_company' => 'required',
            'email' => 'required',
        ]);
        
        $employee = Employee::create($request->all());
        
        return redirect()->route('employee.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (Auth::check())
        {
            $employee = Employee::findOrFail($id);
            return view('employees.edit', compact('employees'));
        }
        else {
            return redirect()->route('login');
        }
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
                $employee=Employee::findOrFail($id);
                $company=Company::all();
                return view('employees.edit', compact('employee','company'));
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
            'name_employee' => 'required',
            'id_company' => 'required',
            'email' => 'required',
        ]);

        $employee = Employee::findOrFail($id);
        $employee->update([
            'nama_employee' => $request['name_employee'],
            'id_company' => $request['id_company'],
            'email' => $request['email'],
        ]);

        return redirect()->route('employee.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $employee=Employee::findOrFail($id);
        $employee->delete();
        return redirect()->route('employee.index');
    }
}
