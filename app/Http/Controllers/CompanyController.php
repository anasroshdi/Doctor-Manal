<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;        
use DataTable;


class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $company = Company::all();
        return view('company.index',['company'=>$company]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $company = Company::all();
        return view('company.create',['company'=>$company]);
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
            'address' => 'required',
            'logo' => 'required',

        ]);
        $company = new Company();
        $company->name = $request->name;
        $company->address = $request->address;
        $company->logo = $request->logo;
        $company->save();
        
        $request->file('logo')->store('public/img');

        return redirect('company/create')->with('success','data has been added');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        if ($request->ajax()) {
            $data = Company::latest()->get();
            return datatables()->of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionBtn = '<a href="company/$company->id/edit" class="edit btn btn-warning btn-sm">Edit</a>
                    <a href="company/create" class="create btn btn-success btn-sm"</i>Create</a>
                    // we have to do a seprate delete function and route.
                    <a href="company/$company->id" class="delete btn btn-danger btn-sm">Delete</a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $company = Company::find($id);
        return view('company.edit',['company'=>$company]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $company = Company::find($id);
        $company->name = $request->name;
        $company->address = $request->address;
        $company->logo = $request->logo;
        $company->save();
        $request->file('logo')->store('public/img');
        return redirect('company/' . $id . '/edit')->with('success', 'data has been updated');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Company::where('id',$id)->delete();
        return redirect('company');
    }     
}
