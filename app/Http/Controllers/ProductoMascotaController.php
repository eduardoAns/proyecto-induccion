<?php

namespace App\Http\Controllers;

use App\Models\ProductoMascota;
use App\Models\Categoria;
use App\Models\Especie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class ProductoMascotaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        //recibir la tabla de empleados, maximo 5
        $datos['producto_mascotas'] = ProductoMascota::paginate(1);
        //le pasamos al index los datos
        return view('producto.index', $datos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $producto = new ProductoMascota();
        $categorias = Categoria::pluck('nombre','id');
        $especies = Especie::pluck('nombre','id');
        return view('producto.create', compact('producto','categorias','especies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        //validaciones de formulario
        $campos=[
            'nombre'=>'required|string|max:100',
            'idcategoria'=>'required|numeric',
            'idespecie'=>'required|numeric',
            'stock'=>'required|numeric',
            'precio'=>'required|numeric',
            'descripcion'=>'required|string|max:100',
            'foto'=>'required|max:10000|mimes:jpeg,png,jpg',
        ];

        $mensaje =[
            'required'=>'El :attribute es requerido',
            'foto.required'=>'La foto es requerida'
        ];

        $this->validate($request, $campos, $mensaje);

        //recibe todo los datos menos el token
        $datosProducto = $request->except('_token');
        //parseo a int para bd
        $datosProducto['stock'] = (int) $request->get('stock');
        $datosProducto['precio'] = (int) $request->get('precio');
        $datosProducto['idcategoria'] = (int) $request->get('idcategoria');
        $datosProducto['idespecie']= (int) $request->get('idespecie');

        if($request->hasFile('foto')){
            $datosProducto['foto'] = $request->file('foto')->store('uploads','public');
        }
        ProductoMascota::insert($datosProducto);
        //retorna los datos en json
        //return response()->json($datosProducto);

        return redirect('producto')->with('mensaje','Empleado agregado con exito');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProductoMascota  $productoMascota
     * @return \Illuminate\Http\Response
     */
    public function show(ProductoMascota $productoMascota)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProductoMascota  $productoMascota
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $producto = ProductoMascota::findOrFail($id);
        $categorias = Categoria::pluck('nombre','id');
        $especies = Especie::pluck('nombre','id');

        return view('producto.edit',compact('producto','categorias','especies'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProductoMascota  $productoMascota
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $campos=[
            'nombre'=>'required|string|max:100',
            'idcategoria'=>'required|numeric',
            'idespecie'=>'required|numeric',
            'stock'=>'required|numeric',
            'precio'=>'required|numeric',
            'descripcion'=>'required|string|max:100',
        ];
        $mensaje =[
            'required'=>'El :attribute es requerido',
        ];
        if($request->hasFile('foto')){
            $campos=['foto'=>'required|max:10000|mimes:jpeg,png,jpg'];
            $mensaje=['foto.required'=>'La foto es requerida'];
         }
        $this->validate($request, $campos, $mensaje);

        //extraer campos
        $datosProducto = $request->except(['_token', '_method']);

        //filtra si la foto existe
        if($request->hasFile('foto')){
            $producto = ProductoMascota::findOrFail($id);
            Storage::delete('public/'.$producto->foto);
            //actualizar foto
            $datosProducto['foto'] = $request->file('foto')->store('uploads','public');
        }

        //se realiza la actualizacion
        ProductoMascota::where('id','=',$id)->update($datosProducto);

        $producto = ProductoMascota::findOrFail($id);
        //return view('empleado.edit',compact('empleado'));
        return redirect('producto')->with('mensaje','Empleado Modificado con exito');;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductoMascota  $productoMascota
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $producto = ProductoMascota::findOrFail($id);
        //si la imagen es borrada de la carpeta, entonces eliminar empleado
        if(Storage::delete('public/'.$producto->foto)){
            ProductoMascota::destroy($id);
        }

        return redirect('producto')->with('mensaje','Empleado eliminado con exito');
    }
}
