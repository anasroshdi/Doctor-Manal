<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employee = Employee::all();
        return view('employee.index', ['employee' => $employee]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $employee = Employee::all();
        return view('employee.create', ['employee' => $employee]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validation part before storing 
        $request->validate([

            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'image'=> 'required'

        ]);


        $employee = new Employee();
        $employee->name = $request->name;
        $employee->email = $request->email;
        $employee->password =sha1($request->password);
        $employee->company_id = $request->company_id;
        $employee->image = $request->image;
        $employee->save();

        $request->file('image')->store('public/employee');

        return redirect('employee/create')->with('success', 'data has been added');




    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        if ($request->ajax()) {
            $data = Employee::latest()->get();
            return datatables()->of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionBtn = '<a href="employee/$company->id/edit" class="edit btn btn-warning btn-sm">Edit</a>
                    <a href="employee/create" class="create btn btn-success btn-sm"</i>Create</a>
                    // we have to do a seprate delete function and route.
                    <a href="employee/$company->id" class="delete btn btn-danger btn-sm">Delete</a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $employee = Employee::find($id);
        return view('employee.edit', ['employee' => $employee]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $employee = Employee::find($id);
        $employee->name = $request->name;
        $employee->email = $request->email;
        $employee->company_id = $request->company_id;
        $employee->image = $request->image;
        $employee->save();
        $request->file('logo')->store('public/employee');
        return redirect('company/' . $id . '/edit')->with('success', 'data has been updated');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        //
    }
}
