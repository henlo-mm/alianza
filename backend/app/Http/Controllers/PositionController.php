<?php

namespace App\Http\Controllers;
use App\Models\PositionEmployee;
use App\Models\Rol;
use App\Models\Employee;
use App\Models\Position;
use Illuminate\Http\Request;

class PositionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $positions = PositionEmployee::with(['position', 'employee', 'chief', 'rol'])->get();

        return response()->json($positions);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            
          /*   $validator = Validator::make($request->all(),[
                'name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'dni' => 'required|integer',
            ]);
    
            if($validator->fails()){
                return response()->json($validator->errors());       
            } */


    
            $positions = PositionEmployee::create(
                [
                    'employee_id' => $request->name,
                    'document' => $request->document,
                    'area' => $request->area,
                    'position_id' => $request->position,
                    'rol_id' => $request->role,
                    'chief_id' => $request->chief,
                ]
            );

    
            return response()->json(['Cargo agregado', $positions]);

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
        $positions = PositionEmployee::find($id);

        if (is_null($positions)) {
            return response()->json('Cargo no encontrado', 404); 
        }
        return response()->json($positions);
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
       
        $positions = PositionEmployee::where('id', $request->id)
            ->update([
                'employee_id' => $request->name,
                'document' => $request->document,
                'area' => $request->area,
                'position_id' => $request->position,
                'rol_id' => $request->role,
                'chief_id' => $request->chief,
            ]);

        return response()->json(['Cargo actualizado', $positions]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $positions = PositionEmployee::find($id);
        $positions->delete();

        return response()->json(['Cargo eliminado', $positions]);
    }

    public function getRoles() 
    {
        $roles = Rol::all();

        return response()->json($roles);

    }

    public function getPositions(Request $request)
    {
    
        $positions = Position::all();

        return response()->json($positions);

    }
    public function getEmployees(Request $request)
    {
    
        $employees = Employee::with(['city', 'state'])->get();

        return response()->json($employees);

    }
}
