<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaccion;
use App\Models\Comercio;
use Illuminate\View\View;

class TransaccionController extends Controller
{
    public function index() 
    { 
    return Transaccion::with('comercio')->get(); 
    }

    public function create(Comercio $comercio): View 
{ 
    return view('transacciones.create', compact('comercio')); 
} 

    public function store(Request $request) 
{ 
        $transaccion = Transaccion::create($request->only([ 
        'comercio_id', 'cliente_nombre', 'monto', 
    ])); 
  
        return redirect() 
        ->route('comercios.show', $transaccion->comercio_id) 
        ->with('mensaje', 'Transacción registrada con éxito.');
} 
public function show(Transaccion $transaccion) 
    { 
    return $transaccion->load('comercios'); 
    }
}
