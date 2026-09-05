<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link href="/css/style.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        @if(isset($error))
            <div class="alert alert-danger">
                {{ $error }}
            </div>
        @elseif($response->isEmpty())
            <div class="alert alert-primary">
                Нет данных
            </div>
        @else
            <h1>Список врачей</h1>
            <div class="row">
                @foreach ($response as $doctor)
                    <div class="col doctors__item">
                        @include('doctorsItems', ['doctor' => $doctor])
                    </div>
                @endforeach
            </div>
            <div class="row">
                <div class="col">
                    {{ $response->links() }}
                </div>
            </div>
        @endif
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>
