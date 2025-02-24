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
      <div id="carrusel" class="carousel slide" data-bs-ride="carousel">
        <center>
          <div class="carousel-inner">
            <div class="carousel-item active">
            <img src="{{ asset('assets/L1.jpg') }}" class="d-block w-50 h-50" alt="img1">
            </div>
            <div class="carousel-item ">
              <br>
              <br>
            <img src="{{ asset('assets/L2.avif') }}" class="d-block w-50 h-50" alt="img2">
            </div>
            <div class="carousel-item ">
              <br>
              <br>
              <br>
            <img src="{{ asset('assets/L3.jfif') }}" class="d-block w-50 h-50" alt="img3">
            <br>
            <br>
            </div>
        </div>
    </center>
        <button class="carousel-control-prev" type="button" data-bs-target="#carrusel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Anterior</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carrusel" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Siguiente</span>
    </button>
    </div> 
    <section class="info">
        <div class="info-content container">
          <h2>Lorem Ipsum</h2>
          <p class="txt-parrafo">Lorem ipsum dolor sit amet consectetur adipisicing elit. Ut aliquam, fugit odio inventore dignissimos cum 
            numquam at unde, quod quasi ab. Incidunt necessitatibus repellendus consectetur nam voluptates pariatur beatae commodi.</p>
        </div>
        <div class="info-group">
          <div class="info-1">
            <img src="{{ asset('assets/libros-libros.jpg') }}" class="p1" alt="">
            <h3>Lorem Ipsum</h3>
            <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Molestiae consectetur quam similique sequi ut expedita corporis iure. 
                Optio tempore, molestiae, repudiandae similique quam in voluptates blanditiis amet totam ex dolorum!</p>
          </div>
          <div class="info-1">
            <img src="{{ asset('assets/L1.jpg') }}" class="p1" alt="">
            <h3>Lorem Ipsum</h3>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto, itaque. Saepe officia voluptas a, delectus at maxime 
                corporis laboriosam id voluptates ratione totam doloremque corrupti necessitatibus eum esse optio quaerat?</p>
          </div>
          <div class="info-1">
            <img src="{{ asset('assets/L2.avif') }}" class="p1" alt="">
            <h3>Lorem Ipsum</h3>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Eligendi ullam ex quo, voluptatum laborum minima repudiandae 
                ea assumenda blanditiis molestiae optio omnis quae, officia, mollitia recusandae ipsam architecto dolorem natus.</p>
          </div>
        </div>
      </section>
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
<script>
    document.addEventListener('DOMContentLoaded', function () {
      var myCarousel = new bootstrap.Carousel(document.getElementById('carrusel'), {
interval: 3000,
wrap: true
  });
});
</script>