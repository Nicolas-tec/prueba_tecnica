<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('assets/estilos2.css') }}">
    <title>Document</title>
</head>
<body>
  <nav class="navbar navbar-expand-lg bg-body-primary" data-bs-theme="primary" style="background-color: #2E2EFE;">
    <div class="container-fluid">
    <img src="{{ asset('assets/libros-libros.jpg') }}">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
          <ul></ul>
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="navbar-brand" aria-current="page" href="{{route('home')}}">Inicio</a>
          </li>
          <li class="nav-item">
            <a class="navbar-brand" aria-current="page" href="{{route('libros.index')}}">Ingresar Libro</a>
          </li>
          <li class="nav-item">
            <a class="navbar-brand" href="{{route('prestamos.index')}}">Rentar libro</a>
          </li>
          <li class="nav-item">
            <a class="navbar-brand" href="{{route('categoria.index')}}">Categorias</a>
          </li>
          <li class="nav-item">
            <a class="navbar-brand" href="{{route('User.index')}}">Usuarios</a>
          </li>
          <li class="nav-item">
            <a class="navbar-brand" href="{{route('login')}}">Cerrar Seccion</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <center><h1>Lista de libros</h1></center>
  <br>
  <div class="container mt-4">
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#create">
      Nuevo Libro
    </button>
    <table class="table table-bordered table-striped table-info">
        <thead>
          <tr>
            <th scope="col">codigo del libro</th>
            <th scope="col">codigo de la categoria</th>
            <th scope="col">titulo</th>
            <th scope="col">sub titulo</th>
            <th scope="col">pagina</th>
            <th scope="col">ISBN</th>
            <th scope="col">editorial</th>
            <th scope="col">autor</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
            @foreach ($libros  as $libro)
          <tr>
            <td>{{$libro->id_libro}}</td>
            <td>{{$libro->id_categoria}}</td>
            <td>{{$libro->titulo}}</td>
            <td>{{$libro->sub_titulo}}</td>
            <td>{{$libro->pagina}}</td>
            <td>{{$libro->ISBN}}</td>
            <td>{{$libro->editorial}}</td>
            <td>{{$libro->autor}}</td>
            <td>
              <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#edit{{$libro->id_libro}}">
                Editar
              </button>
              <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete{{$libro->id_libro}}">
                eliminar
              </button>
            </td>
          </tr>
          @include('libros.modal-info-li')
          @endforeach
        </tbody>
      </table>
    </div>
    @include('libros.modal-create-li')
    <br>
    <br>
    <footer>
      <div>
        <h3>Creador</h3>
        <p>Nombre:Nicolas Turcy Santos</p>
        <p>emal:nturcysa@outlook.com</p>
        <p>celular:3194015240</p>
      </div>
      <div>
        <h3>redes sociales</h3>
        <ul>
          <li><a href="https://m.facebook.com/people/Nicolas-Turcy-Santos/100009155986728/">facebook</a></li>
          <li><a href="https://www.linkedin.com/in/nicolas-turcy-santos-8094a32b0">linkedin</a></li>
          <li><a href="https://www.youtube.com/channel/UCzBBx0OyK6cky-dCzhav7dA">youtube</a></li>
          <li><a href="https://github.com/Nicolas-tec">github</a></li>
        </ul>
      </div>
    </footer>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" 
integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</html>