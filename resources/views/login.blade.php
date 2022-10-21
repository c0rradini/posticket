<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Posticket</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Baloo+2:500&amp;display=swap">
    <link rel="stylesheet" href="{{ url('css/styles.css'); }}">
    <link href="{{ url('/img/icon.png') }}" rel="icon">

</head>

<body class="d-flex justify-content-center align-items-center" style="background: rgb(196,222,243);font-family: 'Baloo 2', serif;">
    <section class="d-flex d-sm-flex d-md-flex d-lg-flex d-xl-flex d-xxl-flex justify-content-center align-items-center justify-content-sm-center align-items-sm-center justify-content-md-center align-items-md-center justify-content-lg-center align-items-lg-center justify-content-xl-center align-items-xl-center justify-content-xxl-center align-items-xxl-center position-relative py-4 py-xl-5" style="width: 100vH;height: 100vH;">
        <div class="card mb-5" style="margin: 0px;">
            <div class="card-body"><img src="{{ url('/img/azul-nome.png') }}" width="250px" style="margin: 15px;margin-bottom: 15px;">
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                @if(session('danger'))
                <div class="alert alert-danger">
                    {{ session('danger') }}
                </div>
                @endif

                <form class="text-center" method="POST" action="{{ route('login.auth') }}">
                    @csrf
                    @method('POST')
                    <div class="mb-3"><input class="form-control" type="email" name="email" placeholder="Email"></div>
                    <div class="mb-3"><input class="form-control" type="password" name="password" placeholder="Senha"></div>
                    <div class="mb-3"><button class="btn btn-primary d-block w-100" type="submit" style="background: #097ec1;border-style: none;">Login</button></div>
                    <span class="text-muted">Esqueceu sua senha?</span>
                </form>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
    
</body>

</html>