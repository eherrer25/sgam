@extends('admin.layout.main')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Asignar cuidados</h1>
{{--        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>--}}
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
                        <div class="card-header">Asignar cuidados a los residentes</div>
                        <div class="card-body">
                            <div class="col-12">
                                <form action="{{route('save-nursings')}}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label for="user_id">Usuario</label>
                                                <select name="user_id" id="user_id" class="form-control select2" required>
                                                    @foreach($users as $user)
                                                    <option value="{{$user->id}}">{{$user->name}}</option>
                                                    @endforeach
                                                </select>
                                                @error('user_id')
                                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label for="resident_id">Residente</label>
                                                <select name="resident_id" id="resident_id" class="form-control select2" required>
                                                    @foreach($residents as $resident)
                                                        <option value="{{$resident->id}}">{{$resident->name}}</option>
                                                    @endforeach
                                                </select>
                                                @error('resident_id')
                                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label for="nursing_id">Cuidado</label>
                                                <select name="nursing_id" id="nursing_id" class="form-control select2" required>
                                                    @foreach($nursings as $nursing)
                                                        <option value="{{$nursing->id}}">{{$nursing->name}}</option>
                                                    @endforeach
                                                </select>
                                                @error('nursing_id')
                                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label for="start">Inicio</label>
                                                <input type="time" name="start" id="start" class="form-control">
                                                @error('start')
                                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label for="stop">Termino</label>
                                                <input type="time" name="stop" id="stop" class="form-control">
                                                @error('stop')
                                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <button type="submit" class="btn btn-primary float-right">Agregar</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
