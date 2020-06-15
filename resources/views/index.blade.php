<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">


    <!--Mis estilos-->
    <link rel="stylesheet" href="{{url('assets/css/styles.css')}}" type="text/css" />
    <title>AJAX</title>
  </head>
  <body>
    
    
    <nav class="navbar navbar-dark bg-dark text-white justify-content-center">
      <h1>App AJAX</h1>
    </nav>

    <div class="container mt-5">
      
      <div class="d-flex justify-content-between">
        
        <div class="d-flex w-100 align-items-center">
          <div class="alert w-50 m-0 p-0 pl-2 " id="mensaje" role="alert"></div>
        </div>
        
        <div class="row justify-content-end mr-0">
            <button type="button" style="width: 122px;" id="crearCoche" class="btn btn-outline-primary" data-toggle="modal" data-target="#ModalNew">Añadir Coche</button>
        </div>
        
      </div>
      
      <table class="table mt-4 mb-5" style="border:1px solid #454d55;">
        <thead class="thead-dark">
          
            <tr>
              <th scope="col">ID</th>
              <th scope="col">Marca</th>
              <th scope="col">Modelo</th>
              <th scope="col">Motor</th>
              <th scope="col">Potencia</th>
              <th scope="col">Acciones</th>
            </tr>
          
        </thead>
        
        <tbody id="tBody">
          
          
        </tbody>
        
      </table>
      
      
      <div id="ajaxLink" class="container d-flex justify-content-center" style="color: #149ddd">
        
      </div>
      
    </div>
    
    

<!-- Modal Añadir -->
<div class="modal fade" id="ModalNew" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Registro de vehículo</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
      <div class="modal-footer" style="justify-content: center">
        
        <form >
          
          <div style="display:flex; flex-direction: column;  width:300px;">
              <div style="display: flex"> <span>Marca:    </span> <input type="text"    id="marcar"  style="height: 21px; margin-left: 7px; width: 100%;" required/> </div> <br>
              <div style="display: flex"> <span>Modelo:   </span> <input type="text"    id="modcar"  style="height: 21px; margin-left: 7px; width: 100%;" required/> </div> <br>
              <div style="display: flex"> <span>Motor:    </span> <input type="text"    id="motcar"  style="height: 21px; margin-left: 7px; width: 100%;" required/> </div> <br>
              <div style="display: flex"> <span>Potencia: </span> <input type="number"  id="potcar"  style="height: 21px; margin-left: 7px; width: 50px;" required min="40" max="600"/> </div> <br>
              
              <br>
              
            
          </div>
        </form>
        
          <div style="display:flex; justify-content:space-between; width:100%">
            <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cerrar</button>
            <button class="btn btn-outline-info" id="botonCrear" type="submit">Crear</button>
          </div>
      </div>
    </div>
  </div>
</div>

      

<!-- Modal de Eliminación -->
<div class="modal fade" id="modalDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Panel de eliminación</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="ajaxaquivamifrase">¿Estás seguro de querer eliminar este coche?</div>
      <div class="modal-footer">
        
        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cerrar</button>
        <button class="btn btn-outline-danger" data-id="" id="ajaxDelete" type="submit">Eliminar</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal de Edicion -->
<div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edición de vehículo</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-footer">
        
        <form style="display:flex; flex-direction:column; width:100%; align-items:center;">
          
              <div style="display:flex; flex-direction: column;  width:300px;">
              <div style="display: flex"> <span>Marca:    </span> <input type="text"    id="marcare"  style="height: 21px; margin-left: 7px; width: 100%;" required/> </div> <br>
              <div style="display: flex"> <span>Modelo:   </span> <input type="text"    id="modcare"  style="height: 21px; margin-left: 7px; width: 100%;" required/> </div> <br>
              <div style="display: flex"> <span>Motor:    </span> <input type="text"    id="motcare"  style="height: 21px; margin-left: 7px; width: 100%;" required/> </div> <br>
              <div style="display: flex"> <span>Potencia: </span> <input type="number"  id="potcare"  style="height: 21px; margin-left: 7px; width: 50px;" required min="40" max="600"/> </div> <br>
              
              <br>
              
          </div>
        </form>
        
          <div style="display:flex; justify-content:space-between; width:100%">
            <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cerrar</button>
            <button class="btn btn-outline-info" data-id="" id="ajaxUpdate" type="submit">Editar</button>
          </div>
        
      </div>
    </div>
  </div>
</div>

  



    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <!--<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>-->
    <!--<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>-->
    
    <script type="text/javascript" src="{{url('assets/js/jQuery-v3.5.1.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <script type="text/javascript" src="{{url('assets/js/script.js')}}"></script>
    <script type="text/javascript" src="{{url('assets/js/ajaxPeticion.js')}}"></script>
    <script type="text/javascript" src="{{url('assets/js/mensaje.js')}}"></script>
  </body>
</html>