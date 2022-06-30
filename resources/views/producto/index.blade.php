
@extends('layouts.app')
@section('content')
    <div class="container">

        @if(Session::has('mensaje'))
            <p class=" alert-success">{{Session::get('mensaje')}}</p>
        @endif

        <a href="{{url('producto/create')}}" class="btn btn-success">registrar nuevo empleado</a>
        <table class="table table-striped table-inverse table-responsive">

            <thead class="thead-inverse">
                <tr>
                    <th>#</th>
                    <th>Foto</th>
                    <th>Nombre</th>
                    <th>Descripcion</th>
                    <th>categoria</th>
                    <th>especie</th>
                    <th>stock</th>
                    <th>Precio</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody>

                @foreach ( $producto_mascotas as $producto )
                <tr>
                    <td scope="row">{{$producto->id}}</td>
                    <td scope="row">
                        <img  src="{{asset('storage').'/'.$producto->foto}}" width="200" alt="" >
                    </td>
                    <td scope="row">{{$producto->nombre}}</td>
                    <td scope="row">{{$producto->descripcion}}</td>
                    <td scope="row">{{$producto->categoria->nombre}}</td>
                    <td scope="row">{{$producto->especie->nombre}}</td>
                    <td scope="row">{{$producto->stock}}</td>
                    <td scope="row">{{$producto->precio}}</td>

                    <td scope="row">

                        <a href="{{url('/producto/'.$producto->id.'/edit')}}" class="btn btn-warning">
                            editar
                        </a>

                        <form action="{{url('/producto/'.$producto->id)}}" method="post" class="btn d-inline">
                            @csrf
                            {{method_field('DELETE')}}
                            <input type="submit" onclick="return confirm('quieres borrar?')" value="Borrar" class="btn btn-danger">
                        </form>

                    </td>
                </tr>
                @endforeach

            </tbody>

        </table>

        {!! $producto_mascotas->links() !!}
    </div>
@endsection
