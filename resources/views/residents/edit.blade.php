@extends('admin.layout.main')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Editar residente</h1>
    </div>
    <section id="main-content">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12 text-center">

                </div>
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{route('resident-update', $resident->id)}}" method="POST">
                                {{ csrf_field() }}
                                {{ method_field('PUT') }}
                                <div class="row">
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="name">Nombre</label>
                                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{  $resident->name}}" required autofocus>
                                            @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="last_name">Apellido</label>
                                            <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{  $resident->last_name }}"
                                                   required >
                                            @error('last_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="run">Run</label>
                                            <input id="run" type="text" class="form-control @error('run') is-invalid @enderror" name="run" value="{{  $resident->run }}"
                                                   required >
                                            @error('run')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="gender">Genero</label>
                                            <select name="gender" id="gender" class="form-control" required>
                                                <option value="Masculino" {{  $resident->gender == 'Masculino' ? 'selected' : '' }}>Masculino</option>
                                                <option value="Femenino" {{  $resident->gender == 'Femenino' ? 'selected' : '' }}>Femenino</option>
                                                <option value="Otro" {{  $resident->gender == 'Otro' ? 'selected' : '' }}>Otro</option>
                                            </select>
                                            @error('gender')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="birth_of_date">Fecha de nacimiento</label>
                                            <input id="birth_of_date" type="date" class="form-control @error('birth_of_date') is-invalid @enderror" name="birth_of_date" value="{{  $resident->birth_of_date }}"
                                                   autocomplete="birth_of_date">
                                            @error('birth_of_date')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="studies">Estudios</label>
                                            <input id="studies" type="text" class="form-control @error('studies') is-invalid @enderror" name="studies" value="{{  $resident->studies }}"
                                                   autocomplete="studies">
                                            @error('studies')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="profession">Profesión</label>
                                            <input id="profession" type="text" class="form-control @error('profession') is-invalid @enderror" name="profession" value="{{  $resident->profession }}"
                                                   autocomplete="profession">
                                            @error('profession')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="client_id">Apoderado</label>
                                            <select name="client_id" id="client_id" class="form-control" required>
                                                @foreach($clients as $client)
                                                    <option value="{{$client->id}}" {{ $resident->client_id == $client->id ? 'selected' : ''}}>{{$client->name}}</option>
                                                @endforeach
                                            </select>
                                            @error('client_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="civil_id">Estado civil</label>
                                            <select name="civil_id" id="civil_id" class="form-control" required>
                                                @foreach($civils as $civil)
                                                    <option value="{{$civil->id}}" {{ $resident->civil_id == $civil->id ? 'selected' : ''}}>{{$civil->name}}</option>
                                                @endforeach
                                            </select>
                                            @error('civil_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="room_id">Dormitorio</label>
                                            <select name="room_id" id="room_id" class="form-control" required>
                                                @foreach($rooms as $room)
                                                    <option value="{{$room->id}}" {{ $resident->room_id == $room->id ? 'selected' : ''}}>{{$room->name}}</option>
                                                @endforeach
                                            </select>
                                            @error('room_id')
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
