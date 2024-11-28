<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
  <!-- Modal  edite-->
  <div class="modal fade" id="edit{{$prestamo->id_prestamo}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Editar prestamo</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="{{route('prestamos.update',$prestamo->id_prestamo)}}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
        <div class="modal-body">
          <label for="">Código del libro</label>
          <input type="text" name="id_libro" id="" class="form-control" value="{{$prestamo->id_libro}}">
          <label for="">Código de usuario</label>
          <input type="text" name="id_ususario" id="" class="form-control" value="{{$prestamo->id_ususario}}">
          <label for="">Fecha de salida</label>
          <input type="text" name="fecha_salida" id="" class="form-control" value="{{$prestamo->fecha_salida}}">
          <label for="">Fecha de devolución</label>
          <input type="text" name="fecha_devolucion" id="" class="form-control" value="{{$prestamo->fecha_devolucion}}">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-primary">Guardar</button>
        </div>
      </div>
    </form>
    </div>
  </div>
  <!-- Modal  delete-->
  <div class="modal fade" id="delete{{$prestamo->id_prestamo}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Eliminar prestamo</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="{{route('prestamos.destroy',$prestamo->id_prestamo)}}" method="post" enctype="multipart/form-data">
            @csrf
            @method('DELETE')
        <div class="modal-body">
          estas seguro de borrar el registro <strong>{{$prestamo->id_prestamo}}</strong>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-primary">confirmar</button>
        </div>
      </div>
    </form>
    </div>
  </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" 
crossorigin="anonymous"></script>
</html>