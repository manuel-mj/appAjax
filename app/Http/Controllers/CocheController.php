<?php

namespace App\Http\Controllers;

use App\Coche;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CocheController extends Controller
{
    
    public function index()
    {
        $coches = [];
        return view('index')->with('coches',$coches);
    }
    
    
    public function ajaxPeticionCoches()
    {
        $coches = Coche::paginate(8);
        
        return response()->json($coches);
    }
    
    
    public function storeCoche(Request $request)
    {
        if($request->ajax()){
            
            $result = Coche::create($request->all());
            
            return response()->json([
                
                "response" => $result,
                "mensaje" => "Coche creado.",
                
            ]);
            
        }else{
            return 'no';
        }
    }


    public function editCoche($id)
    {
            
        $coche = Coche::findOrFail($id);
        
        // Datos del coche
        $marcaReal    = $coche->marca;
        $modeloReal   = $coche->modelo;
        $motorReal    = $coche->motor;
        $potenciaReal = $coche->potencia;
        
        return response()->json([
            
            // "response" => true,
            "marca" => $marcaReal,
            "modelo" => $modeloReal,
            "motor" => $motorReal,
            "potencia" => $potenciaReal,
            
        ]);
            
    }
    


    public function updateCoche(Request $request, $id)
    {
        if($request->ajax()){
            
            $coche = Coche::findOrFail($id);
            
            // Datos Editados
            $marcaEdit    = $request->marca;
            $modeloEdit   = $request->modelo;
            $motorEdit    = $request->motor;
            $potenciaEdit = $request->potencia;
            
            // Datos Reales
            $marcaReal    = $coche->marca;
            $modeloReal   = $coche->modelo;
            $motorReal    = $coche->motor;
            $potenciaReal = $coche->potencia;
            
            if($marcaReal == $marcaEdit && $marcaReal==$marcaEdit && $motorReal==$motorEdit && $potenciaReal==$potenciaEdit){
            
                return response()->json([
                    
                    "response" => true,
                    "mensaje" => "Has introducido los mismos datos que tenía el vehículo.",
                    "clasecss" => "alert-warning",
                    
                ]);
                
            }else{
            
                // Actualizacion de datos
                $coche->marca = $marcaEdit;    
                $coche->modelo = $modeloEdit;   
                $coche->motor = $motorEdit;    
                $coche->potencia = $potenciaEdit;
                
                $result = $coche->save();
            
                return response()->json([
                    
                    "response" => $result,
                    "mensaje" => "Coche actualizado.",
                    "clasecss" => "alert-success",
                    
                ]);
            }
            
        }else{
            return 'no';
        }
    }
    
    
    
    
    public function cocheDelete($id)
    {

            $coche = Coche::findOrFail($id);
    
            $result = $coche->delete();
            
            return response()->json([
                
                "response" => $result,
                "mensaje" => "Coche eliminado.",
                
            ]);
            
    }
    

}
