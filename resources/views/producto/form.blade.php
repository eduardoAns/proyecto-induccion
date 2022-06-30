

<h1>{{$modo}} Empleado</h1>

@if(count($errors)>0)

    <div class="alert alert-danger" role="alert">
        <ul>
            @foreach ($errors->all() as $error )
            <li>{{$error}}</li>
            @endforeach
        </ul>
    </div>

@endif


<div class="form-gruop">
    <label for="nombre"> Nombre </label>
    <input type="text" class="form-control" value="{{isset($producto->nombre)?$producto->nombre:old('nombre')}}" name="nombre" id="nombre">

    {{-- <label for="idcategoria" class=" pt-2"> Categoria </label>
    <input type="number" class="form-control" value="{{isset($producto->idcategoria)?$producto->idcategoria:old('idcategoria')}}" name="idcategoria" id="idcategoria"> --}}
    {{ Form::label('Categoria') }}
    {{ Form::select('idcategoria', $categorias ,$producto->idcategoria, ['class'=>'form-control'.($errors->has('idcategoria')?'is-invalid':'')]) }}

    {{-- <label for="idespecie" class=" pt-2"> Especie </label>
    <input type="number" class="form-control" value="{{isset($producto->idespecie)?$producto->idespecie:old('idespecie')}}" name="idespecie" id="idespecie"> --}}
    {{ Form::label('Especie') }}
    {{ Form::select('idespecie', $especies ,$producto->idespecie, ['class'=>'form-control'.($errors->has('idespecie')?'is-invalid':'')]) }}

    <label for="descripcion" class=" pt-2"> Descripcion </label>
    <input type="text" class="form-control" value="{{isset($producto->descripcion)?$producto->descripcion:old('descripcion')}}" name="descripcion"  id="descripcion">

    <label for="stock" class=" pt-2"> Stock </label>
    <input type="number" class="form-control" value="{{isset($producto->stock)?$producto->stock:old('stock')}}" name="stock" id="stock">

    <label for="precio" class=" pt-2"> Precio </label>
    <input type="number" class="form-control" value="{{isset($producto->precio)?$producto->precio:old('precio')}}" name="precio" id="precio">

    @if(isset($producto->foto))
        <img src="{{asset('storage').'/'.$producto->foto}}" class="img-thumbnail img-fluid"
        width="200" alt="" >
    @endif

    <input type="file" class="form-control" name="foto" value="" id="foto">
    <input type="submit" class="btn btn-success mt-2" value="{{$modo}} datos">
</div>

<a href="{{url('producto/')}}" class="btn btn-primary">regresar</a>

