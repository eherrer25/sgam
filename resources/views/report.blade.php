@extends('admin.layout.main')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Reporte de residentes</h1>
    </div>
    <section id="main-content">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-md-6 mx-auto">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{route('view-report')}}" method="GET">
                                <div class="row">
{{--                                    <div class="col-12">--}}
{{--                                        <div class="form-group">--}}
{{--                                            <label for="month">Mes</label>--}}
{{--                                            <select name="month" id="month" class="form-control">--}}
{{--                                                <option value="" disabled selected>Seleccione un año</option>--}}
{{--                                                <option value="2019">2019</option>--}}
{{--                                                <option value="2020">2020</option>--}}
{{--                                            </select>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="month">Mes</label>
                                            <select name="month" id="month" class="form-control">
                                                <option value="" disabled selected>Seleccione un mes</option>
                                                <option value="01">-Enero</option>
                                                <option value="02">-Febrero</option>
                                                <option value="03">-Marzo</option>
                                                <option value="04">-Abril</option>
                                                <option value="05">-Mayo</option>
                                                <option value="06">-Junio</option>
                                                <option value="07">-Julio</option>
                                                <option value="08">-Agosto</option>
                                                <option value="09">-Septiembre</option>
                                                <option value="10">-Octubre</option>
                                                <option value="11">-Noviembre</option>
                                                <option value="12">-Diciembre</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-success float-right"><i class="fa fa-file-excel"></i> Descargar</button>
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
