@extends('admin.layout.main')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Ficha de cuidados</h1>
    </div>
    <section id="main-content">
        <div class="container">
            <div class="row">
                <div class="col-md-12 align-self-center text-center">
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success alert-dismissible text-center" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close" >
                                <span aria-hidden="true">&times;</span>
                            </button>
                            {{ $message }}
                        </div>
                    @endif
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">Ficha de <b>{{$resident->full_name}}</b>
                            @if(!$record)
                            <button class="btn btn-sm btn-primary shadow-sm float-right"
                               data-toggle="modal" data-target="#recordModal"><i class="fas fa-plus fa-sm text-white-50"></i> Agregar</button>
                            @else
                                <button class="btn btn-sm btn-primary shadow-sm float-right"
                                        data-toggle="modal" data-target="#editModal"><i class="fas fa-edit fa-sm text-white-50"></i> Editar</button>
                            @endif
                        </div>
                        <div class="card-body">
                            @if($record)
                            <div class="card mb-4 py-3 border-left-primary">
                                <div class="card-body">
                                    <label>{{$record->name}}</label>
                                    <pre>{!! $record->observations !!}</pre>
                                </div>
                                <div class="card-footer">
                                    <p class="float-right">Última actualización: {{Carbon\Carbon::parse($record->updated_at)->format('d/m/Y')}}</p>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="modal fade" id="recordModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Crear ficha</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('new-record')}}" method="POST">
                    <div class="modal-body">
                            @csrf
                        <input type="hidden" value="{{$resident->id}}" name="resident_id">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="name">Nombre</label>
                                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="observations">Observaciones</label>
                                        <textarea id="observations" class="form-control @error('observations') is-invalid @enderror" name="observations" value="{{ old('observations') }}" required></textarea>
                                        @error('observations')
                                        <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @if($record)
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Crear ficha</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('edit-record')}}" method="POST">
                    <div class="modal-body">
                        @csrf
                        <input type="hidden" value="{{$record->id}}" name="id">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="name">Nombre</label>
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $record->name }}" required autofocus>
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="observations">Observaciones</label>
                                    <textarea id="observations" class="form-control summernote @error('observations') is-invalid @enderror" name="observations" required>{!! $record->observations !!}</textarea>
                                    @error('observations')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Aceptar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endif
@endsection

@section('script')
    <script>
        $('#recordModal').on('shown.bs.modal', function () {
            $('#recordModal').trigger('focus')
        })
    </script>
@endsection
