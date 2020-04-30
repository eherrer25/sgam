@extends('admin.layout.main')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Usuarios</h1>
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generar reporte</a>
    </div>
    <section id="main-content">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">Lista de usuarios <a href="{{route('user-new')}}" class="btn btn-sm btn-primary shadow-sm float-right"><i class="fas fa-plus fa-sm text-white-50"></i> Agregar</a></div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <tr>
                                    <th>id</th>
                                    <th>Nombre</th>
                                    <th>Email</th>
                                    <th>Roles</th>
                                    <th width="280px">Acciones</th>
                                </tr>
                                @foreach ($data as $key => $user)
                                    <tr>
                                        <td>{{ $user->id }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            @if(!empty($user->getRoleNames()))
                                                @foreach($user->getRoleNames() as $v)
                                                    <label class="badge badge-success">{{ $v }}</label>
                                                @endforeach
                                            @endif
                                        </td>
                                        <td>
                                            <a class="btn btn-primary" href="{{ route('user-edit',$user->id) }}">Edit</a>
                                            <form action="{{route('user-delete',$user->id)}}" method="POST" style="display: inline">
                                                @method('delete')
                                                @csrf
                                                <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>

                            {!! $data->render() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
