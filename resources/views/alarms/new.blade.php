@extends('admin.layout.main')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Generar nueva alarma</h1>
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
                        <div class="card-body">
                            <div class="col-12">
                                <form action="{{route('save-alarm')}}" method="POST">
                                    @csrf
                                    <div class="row">
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
                                                <label for="start">Nombre</label>
                                                <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" required value="{{ old('name') }}">
                                                @error('name')
                                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label for="start">Inicio</label>
                                                <input type="time" name="start" id="start" class="form-control @error('start') is-invalid @enderror" required value="{{ old('start') }}">
                                                <span class="invalid-feedback"></span>
                                                @error('start')
                                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="description">Descripción</label>
                                                <textarea id="description" class="form-control summernote @error('description') is-invalid @enderror" name="description" value="{{ old('description') }}" required></textarea>
                                                @error('description')
                                                <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <button type="submit" id="btn-submit" class="btn btn-primary float-right">Agregar</button>
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

@section('script')
        $('#start').focusout(function () {
            var start = $(this).val();
            var dt = new Date();
            var compare = dt.getHours() + ":" + (dt.getMinutes()<10?'0':'') + dt.getMinutes();
            var _this = $(this);

            if(start <= compare){
                _this.addClass('is-invalid');
                _this.parent().find('.invalid-feedback').text('La hora de inicio no puede ser mayor o igual a la actual.');
                $('#btn-submit').prop('disabled', true);
            }else{
                $(this).removeClass('is-invalid');
                $('#btn-submit').prop('disabled', false);
            }
        });

@endsection
