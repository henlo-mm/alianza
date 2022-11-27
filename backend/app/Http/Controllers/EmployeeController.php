<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\State;
use App\Models\City;
use Validator;
use DB;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = Employee::with(['city', 'state'])->get();

        return response()->json($employees);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            \Log::info($request);
          /*   $validator = Validator::make($request->all(),[
                'name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'dni' => 'required|integer',
            ]);
    
            if($validator->fails()){
                return response()->json($validator->errors());       
            } */
    
            $employee = Employee::create(
                [
                    'name' => $request->name,
                    'last_name' => $request->lastName,
                    'document' => $request->document,
                    'address' => $request->address,
                    'phone' => $request->phone,
                    'states_id' => $request->department,
                    'city_id' => $request->city
                ]
            );

            \Log::info($employee);
    
            return response()->json(['employeee agregado', $employee]);

        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['Ha ocurrido un error', $th]);
           
        } 
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
    public function update(Request $request)
    {

        $employee = Employee::where('id', $request->id)
                ->update([
                    'name' => $request->name,
                    'last_name' => $request->lastName,
                    'document' => $request->document,
                    'address' => $request->address,
                    'phone' => $request->phone,
                    'states_id' => $request->department,
                    'city_id' => $request->city
                ]);

        return response()->json(['employeee actualizado', $employee]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $employee = Employee::find($id);
        $employee->delete();

        return response()->json(['employeee eliminado', $employee]);
    }

    public function getStates() 
    {
        $states = State::all();

        return response()->json($states);

    }

    public function getCities(Request $request)
    {
    
        $cities = City::where('states_id', $request->state_id)->get();

        return response()->json($cities);

    }
}
