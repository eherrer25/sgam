@extends('admin.layout.main')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Cuidados</h1>
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
                        <div class="card-header">Lista de cuidados <a href="{{route('nursing-new')}}" class="btn btn-sm btn-primary shadow-sm float-right"><i class="fas fa-plus fa-sm text-white-50"></i> Agregar</a></div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <tr>
                                    <th>id</th>
                                    <th>Nombre</th>
                                    <th>Frecuencia</th>
                                    <th width="280px">Acciones</th>
                                </tr>
                                @foreach ($data as $key => $nursing)
                                    <tr>
                                        <td>{{  $nursing->id }}</td>
                                        <td>{{  $nursing->name }}</td>
                                        <td>{{  $nursing->frequency }}</td>
                                        <td>
                                            <a class="btn btn-primary btn-sm" href="{{ route('nursing-edit', $nursing->id) }}"><i class="fa fa-edit"></i></a>
                                            <form action="{{route('nursing-delete', $nursing->id)}}" method="POST" style="display: inline">
                                                @method('delete')
                                                @csrf
                                                <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
