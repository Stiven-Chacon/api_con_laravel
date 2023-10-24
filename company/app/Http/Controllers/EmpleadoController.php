<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EmpleadoController extends Controller
{
    public function index()
    {
        // Obtener información de los empleados con el nombre del departamento
        $empleados = Empleado::select('empleados.*', 'departments.nombre as department')
        ->join('departments', 'departments.id', '=', 'empleados.department_id')
        ->paginate(10);
        return response()->json($empleados);
    }

    public function store(Request $request)
    {
        $rules = [
            'nombre' => 'required|string|min:1|max:100',
            'correo' => 'required|email|max:80',
            'telefono' => 'required|max:15',
            'department_id' => 'required|numeric'
        ];

        $validator = Validator::make($request->input(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()->all()
            ], 400);
        }

        $empleado = new Empleado($request->input());
        $empleado->save();

        return response()->json([
            'status' => true,
            'message' => 'Empleado Creado Correctamente'
        ], 200);
    }

    public function show(Empleado $empleado)
    {
        return response()->json(['status' => true, 'data' => $empleado]);

    }


    public function update(Request $request, Empleado $empleado)
    {
        $rules = [
            'nombre' => 'required|string|min:1|max:100',
            'correo' => 'required|email|max:80',
            'telefono' => 'required|max:15',
            'department_id' => 'required|numeric'
        ];

        $validator = Validator::make($request->input(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()->all()
            ], 400);
        }

        $empleado->update($request->input());

        return response()->json([
            'status' => true,
            'message' => 'Empleado Actualizado Correctamente'
        ], 200);
    }


    public function destroy(Empleado $empleado)
    {
        $empleado->delete();

        return response()->json([
            'status' => true,
            'message' => 'Empleado Eliminado Correctamente'
        ], 200);
    }

    public function empleadoPorDepartamento()
    {
        $empleados = Empleado::select(
            DB::raw('count(empleados.id) as count,
            departments.nombre'))
            ->rightJoin('departments', 'departments.id', '=', 'empleados.department_id')
            ->groupBy('departments.nombre')
            ->get();

        return response()->json($empleados);
    }
    
    public function all()
    {
        // Obtener todos los empleados con el nombre de su departamento
        $empleados = Empleado::select('empleados.*', 'departments.nombre as department')
            ->join('departments', 'departments.id', '=', 'empleados.department_id')
            ->get();
        return response()->json($empleados);
    }
    
}
