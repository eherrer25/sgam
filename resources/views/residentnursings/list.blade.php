@extends('admin.layout.main')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Cuidados de los residentes</h1>
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
                        <div class="card-header">Lista de cuidados de residentes
                            <a href="{{route('new-nursings')}}" class="btn btn-sm btn-primary shadow-sm float-right"><i class="fas fa-plus fa-sm text-white-50"></i> Agregar</a>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered dataTable">
                                <thead>
                                <tr>
                                    <th>Usuario</th>
                                    <th>Residente</th>
                                    <th>Cuidado</th>
                                    <th>Horario Estim.</th>
                                    <th>Horario Real</th>
                                    <th>Estado</th>
                                    <th class="nosort">Acciones</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($nursings as $nursing)
                                    <tr>
                                        <td>{{  $nursing->user->full_name }}</td>
                                        <td>{{  $nursing->resident->full_name }} <a href="#" class="btn btn-primary btn-sm float-right" id="show-record" data-record="{{$nursing->resident->record}}" data-toggle="modal" data-target="#recordModal">Ficha</a></td>
                                        <td>{{  $nursing->nursing->name }}</td>

                                        <td>{{  $nursing->start  }} - {{  $nursing->stop }}</td>
                                        <td>{{  $nursing->start_unreal  }} - {{  $nursing->stop_unreal }}</td>
                                        <td><span class="badge
                                                @if($nursing->status == 'pendiente')
                                                badge-secondary
                                                @elseif($nursing->status == 'en proceso')
                                                badge-warning
                                                @else
                                                badge-success
                                                @endif
                                                ">{{  $nursing->status }}</span>
                                        </td>
                                        <td>

                                            @if($nursing->status != 'realizado')
                                            <form action="{{route('nursing-resident-change')}}" method="POST" style="display: inline">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $nursing->id }}">
                                                <input type="hidden" name="status" value="{{ $nursing->status }}">
                                                <button type="submit" class="btn
                                                    @if($nursing->status == 'pendiente')
                                                    btn-secondary
                                                    @elseif($nursing->status == 'en proceso')
                                                    btn-warning
                                                    @else
                                                    btn-success
                                                    @endif
                                                 btn-sm"><i class="fa fa-check-circle"></i></button>
                                            </form>
                                            @hasanyrole('admin|tens')
                                            <form action="{{route('nursing-resident-delete', $nursing->id)}}" method="POST" style="display: inline">
                                                @method('delete')
                                                @csrf
                                                <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                                            </form>
                                            @endhasanyrole
                                            @endif

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

    <div class="modal fade" id="recordModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ver ficha</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card mb-4 py-3 border-left-primary">
                        <div class="card-body">
                            <label id="record-name"></label>
                            <pre id="record-observations"></pre>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).on("click", "#show-record", function () {
            var record = $(this).data('record');
            $("#record-name").text( record.name );
            $("#record-observations").html( record.observations );
        });
    </script>
@endsection
