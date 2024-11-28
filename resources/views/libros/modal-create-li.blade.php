<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" 
    crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
  <!-- Modal  create -->
  <div class="modal fade" id="create" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Nuevo Libro</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="{{route('libros.store')}}" method="post" enctype="multipart/form-data">
            @csrf
        <div class="modal-body">
            <label for="">codigo de la categoria</label>
            <input type="text" name="id_categoria" id="" class="form-control">
            <label for="">titulo</label>
            <input type="text" name="titulo" id="" class="form-control">
            <label for="">sub titulo</label>
            <input type="text" name="sub_titulo" id="" class="form-control">
            <label for="">pagina</label>
            <input type="text" name="pagina" id="" class="form-control">
            <label for="">ISBN</label>
            <input type="text" name="ISBN" id="" class="form-control">
            <label for="">editorial</label>
            <input type="text" name="editorial" id="" class="form-control">
            <label for="">autor</label>
            <input type="text" name="autor" id="" class="form-control">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-primary">Guardar</button>
        </div>
      </div>
    </form>
    </div>
  </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" 
crossorigin="anonymous"></script>
</html>