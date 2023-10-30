<!DOCTYPE html>
<html lang="en">   
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <title>Laravel</title>
   
    {{-- <style>
        /* Define el fondo con la imagen */
        body {
            background-image: url("{{ asset('img/1.png') }}");
            background-repeat: no-repeat; /* Evita la repetición de la imagen */
            background-size: cover; /* Ajusta el tamaño de la imagen para cubrir todo el cuerpo */
            background-position: center top 30px;
          

            /* Otras propiedades de estilo según sea necesario */
        }
    </style> --}}
    
</head>
{{-- <body>
    <div id="app">
     
        <div class="collapse" id="navbarToggleExternalContent" data-bs-theme="dark">
            <div class="bg-warning p-4">
             <a href="">Inicio</a>
              <span class="text-body-secondary">Toggleable via the navbar brand.</span>
            </div>
          </div>
          <nav class="navbar navbar-dark bg-warning">
            <div class="container-fluid">
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
            </div>
          </nav>
        
    </div> --}}


  <div id="app">

    <Inicio/>
    
    @vite('resources/js/app.js')
    @vite('resources/css/app.css')
  </div>

   
</body>
@yield('content')



</html>


