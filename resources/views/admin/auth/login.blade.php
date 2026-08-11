<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login Admin Arrashine</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" type="image/png" href="{{ asset('assets/images/navbar/bulat.png') }}" sizes="512x512">

</head>

<body class="bg-light">

    <div class="container vh-100 d-flex justify-content-center align-items-center">
        <div class="card shadow" style="width:420px;">
            <div class="card-body p-4">

                <h3 class="text-center mb-4">
                    Login Admin Arrashine
                </h3>

                @if ($errors->any())
                    <div class="alert alert-danger shadow mb-4">
                        <h6 class="font-weight-bold">Gagal login:</h6>
                        <ul class="mb-0 nesting-list">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="/admin/login" method="POST">

                    @csrf
                    @method('POST')

                    <div class="mb-3">
                        <label>Email</label>

                        <input type="email" name="email" class="form-control">
                        
                    </div>

                    <div class="mb-3">
                        <label>Password</label>

                        <input type="password" name="password" class="form-control">
                    </div>

                    <button class="btn btn-dark w-100">
                        Login
                    </button>

                </form>

            </div>
        </div>
    </div>
</body>

</html>