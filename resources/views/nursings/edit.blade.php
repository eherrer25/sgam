@extends('admin.layout.main')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Editar cuidado</h1>
    </div>
    <section id="main-content">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12 text-center">

                </div>
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{route('nursing-update', $nursing->id)}}" method="POST">
                                {{ csrf_field() }}
                                {{ method_field('PUT') }}
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="name">Nombre</label>
                                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{  $nursing->name}}" required autofocus>
                                            @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="frequency">Frecuencia</label>
                                            <input id="frequency" type="text" class="form-control @error('frequency') is-invalid @enderror" name="frequency" value="{{ $nursing->frequency }}"
                                                   required autocomplete="frequency">
                                            @error('frequency')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="description">Descripción</label>
                                            <textarea id="description" type="text" class="form-control @error('description') is-invalid @enderror" name="description" required>{!! $nursing->description !!}</textarea>
                                            @error('description')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary float-right">Aceptar</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
