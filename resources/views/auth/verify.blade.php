@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Falta pouco agora, precisamos que valide o seu email !</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            Reenviamos o link de verificação para seu email, por gentileza verifique !
                        </div>
                    @endif

                    Antes de prosseguir, verifique o seu email para sabermos que é um email valido !.
                    Caso não tenha recebido o link de verificação,
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">Clique aqui para o reenvio !</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
