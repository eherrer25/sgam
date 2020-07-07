@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            Un nuevo link de verificación a sido enviado a tu email.
                        </div>
                    @endif
                    Antes de continuar, porfavor revisa tu email para el link de verificación.
                    Si no has recibido ningun email,
                    <form class="d-inline" method="GET" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">click aquí para obtener link</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
