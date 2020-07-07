@extends('admin.layout.main')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Asignar cuidados</h1>
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
                                                <span class="valid-feedback"></span>
                                                @error('nursing_id')
                                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label for="start">Inicio</label>
                                                <input type="time" name="start" id="start" class="form-control" required>
                                                <span class="invalid-feedback"></span>
                                                @error('start')
                                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label for="stop">Termino</label>
                                                <input type="time" name="stop" id="stop" class="form-control" required>
                                                <span class="invalid-feedback"></span>
                                                @error('stop')
                                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
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
        $('#stop').focusout(function () {
            var start = $('#start').val();
            var stop = $(this).val();

            if(start !== "" && stop !== ""){
                //convert both time into timestamp
                var stt = new Date("November 13, 2013 " + start);
                stt = stt.getTime();
                var endt = new Date("November 13, 2013 " + stop);
                endt = endt.getTime();
                var _this = $(this);
                if(stt >= endt){
                    _this.addClass('is-invalid');
                    _this.parent().find('.invalid-feedback').text('La hora de termino no puede ser menor o igual a la de inicio.');
                    $('#btn-submit').prop('disabled', true);
                }else{
                    $('#start').removeClass('is-invalid');
                    $(this).removeClass('is-invalid');
                    $('#btn-submit').prop('disabled', false);
                }
            }
        });
        $('#start').focusout(function () {
            var start = $(this).val();
            var stop = $('#stop').val();

            if(start !== "" && stop !== ""){
                //convert both time into timestamp
                var stt = new Date("November 13, 2013 " + start);
                stt = stt.getTime();
                var endt = new Date("November 13, 2013 " + stop);
                endt = endt.getTime();
                var _this = $(this);
                if(stt >= endt){
                    _this.addClass('is-invalid');
                    _this.parent().find('.invalid-feedback').text('La hora de inicio no puede ser mayor o igual a la de termino.');
                    $('#btn-submit').prop('disabled', true);
                }else{
                    $('#stop').removeClass('is-invalid');
                    $(this).removeClass('is-invalid');
                    $('#btn-submit').prop('disabled', false);
                }
            }
        });

@endsection
