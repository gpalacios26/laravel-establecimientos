@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="https://api.mapbox.com/mapbox-gl-js/v2.7.0/mapbox-gl.css">

    <link rel="stylesheet"
        href="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.7.2/mapbox-gl-geocoder.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.0/dropzone.min.css"
        integrity="sha256-NkyhTCRnLQ7iMv7F3TQWjVq25kLnjhbKEVPqGJBcCUg=" crossorigin="anonymous" />

    <style>
        .coordinates {
            background: rgba(0, 0, 0, 0.5);
            color: #fff;
            position: absolute;
            padding: 5px 10px;
            margin: 0;
            width: 200px;
            font-size: 11px;
            line-height: 18px;
            border-radius: 3px;
            z-index: 100;
            display: none;
        }
    </style>
@endsection

@section('content')
    <div class="container">
        <h1 class="text-center mt-4">Editar Establecimiento</h1>

        <div class="mt-5 row justify-content-center">
            <form class="col-md-9 col-xs-12 card card-body"
                action="{{ route('establecimiento.update', ['establecimiento' => $establecimiento->id]) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <fieldset class="border p-4">
                    <legend class="text-primary">Nombre, Categoría e Imagen Principal</legend>

                    <div class="form-group">
                        <label for="nombre">Nombre Establecimiento</label>
                        <input id="nombre" type="text" class="form-control @error('nombre') is-invalid @enderror"
                            placeholder="Nombre Establecimiento" name="nombre" value="{{ $establecimiento->nombre }}">

                        @error('nombre')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="categoria">Categoría</label>
                        <select class="form-control @error('categoria_id') is-invalid @enderror" name="categoria_id"
                            id="categoria">
                            <option value="" selected disabled>-- Seleccione --</option>

                            @foreach ($categorias as $categoria)
                                <option value="{{ $categoria->id }}"
                                    {{ $establecimiento->categoria_id == $categoria->id ? 'selected' : '' }}>
                                    {{ $categoria->nombre }}</option>
                            @endforeach
                        </select>

                        @error('categoria_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="imagen_principal">Imagen Principal</label>
                        <input id="imagen_principal" type="file"
                            class="form-control @error('imagen_principal') is-invalid @enderror " name="imagen_principal"
                            value="{{ old('imagen_principal') }}">

                        @error('imagen_principal')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                        <img style="width:200px; margin-top: 20px;"
                            src="/storage/{{ $establecimiento->imagen_principal }}">
                    </div>
                </fieldset>

                <fieldset class="border p-4 mt-5">
                    <legend class="text-primary">Ubicación:</legend>

                    <div class="form-group">
                        <label for="formbuscador">Coloca la dirección del Establecimiento</label>
                        <input id="formbuscador" type="text" placeholder="Calle del Negocio o Establecimiento"
                            class="form-control">
                        <p class="text-secondary mt-5 mb-3 text-center">El asistente colocará una dirección estimada o mueve
                            el Pin hacia el lugar correcto</p>
                    </div>

                    <div class="form-group">
                        <pre id="coordinates" class="coordinates"></pre>
                        <div id="mapa" style="height: 400px; width:100%;"></div>
                    </div>

                    <p class="informacion">Confirma que los siguientes campos son correctos</p>

                    <div class="form-group">
                        <label for="direccion">Dirección</label>

                        <input type="text" id="direccion" class="form-control @error('direccion') is-invalid @enderror"
                            placeholder="Dirección" value="{{ $establecimiento->direccion }}" name="direccion">
                        @error('direccion')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <input type="hidden" id="lat" name="lat" value="{{ $establecimiento->lat }}">
                    <input type="hidden" id="lng" name="lng" value="{{ $establecimiento->lng }}">
                </fieldset>

                <fieldset class="border p-4 mt-5">
                    <legend class="text-primary">Información Establecimiento: </legend>
                    <div class="form-group">
                        <label for="nombre">Teléfono</label>
                        <input type="tel" class="form-control @error('telefono') is-invalid @enderror" id="telefono"
                            placeholder="Teléfono Establecimiento" name="telefono"
                            value="{{ $establecimiento->telefono }}">

                        @error('telefono')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="nombre">Descripción</label>
                        <textarea class="form-control  @error('descripcion') is-invalid @enderror"
                            name="descripcion">{{ $establecimiento->descripcion }}</textarea>

                        @error('descripcion')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="nombre">Hora Apertura:</label>
                        <input type="time" class="form-control @error('apertura') is-invalid @enderror" id="apertura"
                            name="apertura" value="{{ $establecimiento->apertura }}">

                        @error('apertura')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="nombre">Hora Cierre:</label>
                        <input type="time" class="form-control @error('cierre') is-invalid @enderror" id="cierre"
                            name="cierre" value="{{ $establecimiento->cierre }}">

                        @error('cierre')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </fieldset>

                <fieldset class="border p-4 mt-5">
                    <legend class="text-primary">Imágenes Establecimiento: </legend>
                    <div class="form-group">
                        <label for="imagenes">Imagenes</label>
                        <div id="dropzone" class="dropzone form-control"></div>
                    </div>

                    @if (count($imagenes) > 0)
                        @foreach ($imagenes as $imagen)
                            <input class="galeria" type="hidden" value="{{ $imagen->ruta_imagen }}">
                        @endforeach
                    @endif
                </fieldset>

                <input type="hidden" id="uuid" name="uuid" value="{{ $establecimiento->uuid }}">
                <input type="submit" class="btn btn-primary mt-3 d-block" value="Guardar Cambios">
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://api.mapbox.com/mapbox-gl-js/v2.7.0/mapbox-gl.js" defer></script>

    <script src="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.7.2/mapbox-gl-geocoder.min.js" defer>
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.0/dropzone.min.js"
        integrity="sha256-OG/103wXh6XINV06JTPspzNgKNa/jnP1LjPP5Y3XQDY=" crossorigin="anonymous" defer></script>
@endsection
