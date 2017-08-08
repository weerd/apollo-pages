<!DOCTYPE html>

<html lang="en">

    <head>
        <meta charset="UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <title>@yield('title', 'Admin') | {{ config('app.name') }}</title>
    </head>

    <body>
        @yield('content')
    </body>

</html>
