@extends('admin.layout.main')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="row">
                    <!-- Earnings (Monthly) Card Example -->
                    <div class="col-xl-4 col-md-6 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Residencia</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">Hogar 20, Jose María Caro</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-home fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Earnings (Monthly) Card Example -->
                    <div class="col-xl-4 col-md-6 mb-4">
                        <div class="card border-left-success shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Director(a) a cargo</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">Nombre director</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-user fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Earnings (Monthly) Card Example -->
                    <div class="col-xl-4 col-md-6 mb-4">
                        <div class="card border-left-info shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Cantidad Residentes</div>
                                        <div class="row no-gutters align-items-center">
                                            <div class="col-auto">
                                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{$residents}}</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-users fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Comparación tiempos de cuidados realizados al {{\Carbon\Carbon::now()->format('d-m-Y')}}</h6>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered">
                                    <tr>
                                        <th>Usuario</th>
                                        <th>Tiempo objetivo</th>
                                        <th>Total objetivo</th>
                                        <th>Tiempo real</th>
                                        <th>Total real</th>
                                        <th>Cumple</th>
                                    </tr>
                                    @foreach($nursings->where('status','realizado') as $nursing)
                                        <tr>
                                            <td>{{$nursing->user->full_name}}</td>
                                            <td>{{$nursing->start}} - {{$nursing->stop}}</td>
                                            <td>
                                                @php
                                                    $startTime = \Carbon\Carbon::parse($nursing->start);
                                                    $finTime = \Carbon\Carbon::parse($nursing->stop);
                                                    $totalTime = $finTime->diffInMinutes($startTime);
                                                @endphp
                                                {{$totalTime}} mins.
                                            </td>
                                            <td>{{$nursing->start_unreal}} - {{$nursing->stop_unreal}}</td>
                                            <td>
                                                @php
                                                    $startTime2 = \Carbon\Carbon::parse($nursing->start_unreal);
                                                    $finTime2 = \Carbon\Carbon::parse($nursing->stop_unreal);
                                                    $totalTime2 = $finTime2->diffInMinutes($startTime2);
                                                @endphp
                                                {{$totalTime2}} mins.
                                            </td>
                                            <td>
                                                @if($totalTime2 <= $totalTime)
                                                    <span class="badge badge-success">Sí</span>
                                                @else
                                                    <span class="badge badge-danger">No</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Estado de los cuidados asignados del día {{\Carbon\Carbon::now()->format('d-m-Y')}}</h6>
                            </div>
                            <div class="card-body">
                                @php
                                    $total = $nursings->count();
                                    $pendientes = $nursings->where('status','pendiente')->count();
                                    $proceso = $nursings->where('status','en proceso')->count();
                                    $realizados = $nursings->where('status','realizado')->count();
                                @endphp
                                @if($total > 0)
                                    <h4 class="small font-weight-bold">Pendientes <span class="float-right">{{ round(($pendientes * 100) / $total) }}%</span></h4>
                                    <div class="progress mb-4">
                                        <div class="progress-bar bg-secondary" role="progressbar" style="width: {{ round(($pendientes * 100) / $total) }}%" aria-valuenow="{{ round(($pendientes * 100) / $total) }}" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <h4 class="small font-weight-bold">En proceso <span class="float-right">{{ round(($proceso * 100) / $total) }}%</span></h4>
                                    <div class="progress mb-4">
                                        <div class="progress-bar bg-warning" role="progressbar" style="width: {{ round(($proceso * 100) / $total) }}%" aria-valuenow="{{ round(($proceso * 100) / $total) }}" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <h4 class="small font-weight-bold">Realizados <span class="float-right">{{ round(($realizados * 100) / $total) }}%</span></h4>
                                    <div class="progress">
                                        <div class="progress-bar bg-success" role="progressbar" style="width: {{ round(($realizados * 100) / $total) }}%" aria-valuenow="{{ round(($realizados * 100) / $total) }}" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
