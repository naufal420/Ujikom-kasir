<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('bootstrap-5/css/bootstrap.min.css') }}" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Login</title>
</head>

<body>

    <div class="container mt-4">
        <div class="row">
            <div class="col-12 col-sm-8 m-auto">
                <div class="card">
                    <div class="card-header">
                        <h1 class="text-center">Login</h1>
                    </div>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $item)
                                    <li>{{ $item }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="card-body pb-0">
                        <form action="" method="POST">
                            @csrf
                            <div class="mb-3">
                                <input type="text" class="form-control border-secondary w-100" placeholder="Email"
                                    value="{{ old('email') }}" name="email" aria-describedby="emailHelp" required>
                            </div>
                            <div class="mb-3">
                                <input type="password" class="form-control border-secondary w-100"
                                    placeholder="password" name="password" value="{{ old('password') }}"
                                    aria-describedby="passwordHelpBlock" required>
                            </div>
                            <div class="card-footer text-muted row pb-3">
                                <button class="btn btn-primary" type="submit" name="submit">
                                    Submit
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
