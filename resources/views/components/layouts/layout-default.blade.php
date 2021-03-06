<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="{{asset('css/app.css')}}">
        <link type="text/css" rel="stylesheet" href="https://unpkg.com/vue-next-select/dist/index.min.css" />

        <title>{{config('app.title')}}</title>


    </head>
    <body class="antialiased">
        <div id="app">
            {{$slot}}
        </div>

     <script type="text/javascript" src="{{asset('js/app.js')}}"></script>


    </body>
</html>