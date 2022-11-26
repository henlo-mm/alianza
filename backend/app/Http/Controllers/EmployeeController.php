<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try {
            $validator = Validator::make($request->all(),[
                'name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'document' => 'required|integer',
            ]);
    
            if($validator->fails()){
                return response()->json($validator->errors());       
            }
    
            $employee = Employee::create($request->all());
    
            return response()->json(['employeee agregado', $employee]);

        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['Ha ocurrido un error', $th]);
           
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $employee = Employee::find($id);

        if (is_null($employee)) {
            return response()->json('employeee no encontrado', 404); 
        }
        return response()->json($employee);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employee $employee)
    {
        $employee->update($request->all());

        return response()->json(['employeee actualizado', $employee]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        $employee->delete();

        return response()->json(['employeee eliminado', $employee]);
    }
}