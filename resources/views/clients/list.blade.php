@extends('admin.layout.main')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Apoderados</h1>
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
                        <div class="card-header">Lista de apoderados
                            @role('admin')
                            <a href="{{route('client-new')}}" class="btn btn-sm btn-primary shadow-sm float-right"><i class="fas fa-plus fa-sm text-white-50"></i> Agregar</a>
                            @endrole
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered dataTable">
                                <thead>
                                    <tr>
                                        <th>id</th>
                                        <th>Nombre</th>
                                        <th>run</th>
                                        <th>Teléfono</th>
                                        <th>Celular</th>
                                        <th>Email</th>
                                        <th>Comuna</th>
                                        <th width="280px" class="nosort">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach ($data as $key => $client)
                                    <tr>
                                        <td>{{ $client->id }}</td>
                                        <td>{{ $client->full_name }}</td>
                                        <td>{{ $client->run }}</td>
                                        <td>{{ $client->phone }}</td>
                                        <td>{{ $client->mobile }}</td>
                                        <td>{{ $client->email }}</td>
                                        <td>{{ $client->commune->name }}</td>
                                        <td>
                                            <a class="btn btn-primary btn-sm" href="{{ route('client-edit',$client->id) }}"><i class="fa fa-edit"></i> Editar</a>
                                            <form action="{{route('client-delete',$client->id)}}" method="POST" style="display: inline">
                                                @method('delete')
                                                @csrf
                                                <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Eliminar</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
