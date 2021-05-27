@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin=""/>
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/esri-leaflet-geocoder/dist/esri-leaflet-geocoder.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/dropzone.min.css" integrity="sha512-jU/7UFiaW5UBGODEopEqnbIAHOI8fO6T99m7Tsmqs2gkdujByJfkCbbfPSN4Wlqlb9TGnsuC0YgUgWkRBK7B9A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

@section('content')
    <div class="container">
        <h1 class="text-center mt-4">Registrar Establecimiento</h1>
        <div class="mt-5 row justify-content-center">
            <form class="col-md-9 col-xs-12 card card-body" action="{{route('establecimiento.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <fieldset class="border p-4">
                    <legend class="text-primary">Nombre, Categoría e Imagen Principal</legend>
                    <div class="form-group">
                        <label for="nombre">Nombre Establecimiento</label>
                        <input id="nombre" name="nombre" type="text"
                               class="form-control @error('nombre') is-invalid @enderror"
                               placeholder="Nombre de establecimiento" value="{{old('nombre')}}">
                        @error('nombre')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="categoria">Categoria</label>
                        <select id="categoria" name="categoria_id" class="form-control @error('categoria_id') is-invalid @enderror">
                            <option value="" selected disabled>-- Seleccione --</option>
                            @foreach($categorias as $c)
                                <option value="{{$c->id}}" {{old('categoria_id') == $c->id ? 'selected' : ''}}>{{$c->nombre}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="imagen_principal">Imagen Principal</label>
                        <input id="imagen_principal" name="imagen_principal" type="file"
                               class="form-control @error('imagen_principal') is-invalid @enderror"
                               value="{{old('imagen_principal')}}">
                        @error('imagen_principal')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                </fieldset>
                <fieldset class="border p-4 mt-5">
                    <legend class="text-primary">Ubicación</legend>
                    <div class="form-group">
                        <label for="formbuscador">Coloca la dirección del Establecimiento</label>
                        <input id="formbuscador" type="text"
                               class="form-control"
                               placeholder="Calle del Negocio o establecimiento">
                        <p class="text-secondary mt-5 mb-3 text-center">
                            El asistente colocará una dirección estimada, mueve el Pin hacia el lugar correcto.
                        </p>
                    </div>
                    <div class="form-group">
                        <div id="mapa" style="height: 400px"></div>
                    </div>
                    <p class="informacion">Confirma que los siguientes campos son correctos</p>
                    <div class="form-group">
                        <label for="direccion">Direccion</label>
                        <input id="direccion" name="direccion" type="text" class="form-control @error('direccion') is-invalid @enderror" value="{{old('direccion')}}">
                        @error('direccion')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="colonia">Colonia</label>
                        <input id="colonia" name="colonia" type="text" class="form-control @error('colonia') is-invalid @enderror" value="{{old('colonia')}}">
                        @error('colonia')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                    <input type="hidden" id="lat" name="lat" value="{{old('lat')}}">
                    <input type="hidden" id="lng" name="lng" value="{{old('lng')}}">
                </fieldset>
                <fieldset class="border p-4 mt-5">
                    <legend  class="text-primary">Información Establecimiento: </legend>
                    <div class="form-group">
                        <label for="nombre">Teléfono</label>
                        <input
                            type="tel"
                            class="form-control @error('telefono')  is-invalid  @enderror"
                            id="telefono"
                            placeholder="Teléfono Establecimiento"
                            name="telefono"
                            value="{{ old('telefono') }}"
                        >

                        @error('telefono')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>



                    <div class="form-group">
                        <label for="nombre">Descripción</label>
                        <textarea
                            class="form-control  @error('descripcion')  is-invalid  @enderror"
                            name="descripcion"
                        >{{ old('descripcion') }}</textarea>

                        @error('descripcion')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="nombre">Hora Apertura:</label>
                        <input
                            type="time"
                            class="form-control @error('apertura')  is-invalid  @enderror"
                            id="apertura"
                            name="apertura"
                            value="{{ old('apertura') }}"
                        >
                        @error('apertura')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="nombre">Hora Cierre:</label>
                        <input
                            type="time"
                            class="form-control @error('cierre')  is-invalid  @enderror"
                            id="cierre"
                            name="cierre"
                            value="{{ old('cierre') }}"
                        >
                        @error('cierre')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                </fieldset>
                <fieldset class="border p-4 mt-5">
                    <legend  class="text-primary">Información Establecimiento: </legend>
                    <div class="form-group">
                        <label for="imagenes">Imágenes</label>
                        <div id="dropzone" class="dropzone form-control">

                        </div>
                    </div>
                </fieldset>
                <input type="hidden" id="uuid" name="uuid" value="{{Str::uuid()->toString()}}">
                <input type="submit" class="btn btn-primary mt-3 d-block" value="Registrar Establecimiento">
            </form>
        </div>
    </div>

@endsection

@section('scripts')
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
            integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
            crossorigin=""></script>
    <script src="https://unpkg.com/esri-leaflet" defer></script>
    <script src="https://unpkg.com/esri-leaflet-geocoder" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/min/dropzone.min.js" integrity="sha512-VQQXLthlZQO00P+uEu4mJ4G4OAgqTtKG1hri56kQY1DtdLeIqhKUp9W/lllDDu3uN3SnUNawpW7lBda8+dSi7w==" crossorigin="anonymous" referrerpolicy="no-referrer" defer></script>
@endsection
