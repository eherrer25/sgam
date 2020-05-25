@extends('admin.layout.main')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Clientes</h1>
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
                        <div class="card-header">Lista de clientes <a href="{{route('client-new')}}" class="btn btn-sm btn-primary shadow-sm float-right"><i class="fas fa-plus fa-sm text-white-50"></i> Agregar</a></div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <tr>
                                    <th>id</th>
                                    <th>Nombre</th>
                                    <th>run</th>
                                    <th>Teléfono</th>
                                    <th>Celular</th>
                                    <th>Email</th>
                                    <th>Comuna</th>
                                    <th width="280px">Acciones</th>
                                </tr>
                                @foreach ($data as $key => $client)
                                    <tr>
                                        <td>{{ $client->id }}</td>
                                        <td>{{ $client->name.' '.$client->last_name }}</td>
                                        <td>{{ $client->run }}</td>
                                        <td>{{ $client->phone }}</td>
                                        <td>{{ $client->mobile }}</td>
                                        <td>{{ $client->email }}</td>
                                        <td>{{ $client->commune->name }}</td>
                                        <td>
                                            <a class="btn btn-primary" href="{{ route('client-edit',$client->id) }}">Edit</a>
                                            <form action="{{route('client-delete',$client->id)}}" method="POST" style="display: inline">
                                                @method('delete')
                                                @csrf
                                                <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></button>
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
