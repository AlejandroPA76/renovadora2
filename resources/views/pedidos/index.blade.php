@extends('layout.layout2')
@section('title','Pedidos')
@section('content')
<a href="/pedidos/create" class="btn btn-primary btn-lg">agregar pedido</a>
<br><br>
<div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Pedidos
    <form>
      <div class="d-flex content-end h-100">
        <div class="searchbar">
          <input class="search_input" type="text" name="buscador" placeholder="id/nombre/status" value="{{$buscarpor}}">

        
          <button type="submit">buscar</button>
        </div>
      </div></form>
    
                            </div>
                            <div class="card-body">
                              
                                <table class="table">

                                          <thead>
                                            <tr>
                                              <th scope="col"></th>
                                              <th scope="col">codigo</th>
                                              <th scope="col">nombre</th>
                                              <th scope="col">status</th>
                                              <th scope="col">fecha de entrega</th>
                                              <th scope="col">Accion</th>
                                            </tr>
                                          </thead>
                                          <tbody>
                                             @foreach($listPedidos as $lp)

                              
                                            <tr 
                                            bgcolor="<?php 
                                            date_default_timezone_set('America/Mexico_City');
                                            $fechaNow = new DateTime();
                                            $fechaE = new DateTime($lp->entrega);

                                            $diff = $fechaNow->diff($fechaE);
                                            $totalD = ($diff->invert == 1) ? ' - ' . $diff->days .' days '  : $diff->days .' days ';

                                            if($totalD <=3)echo '#E59A90';
                                            else echo '' ?>" 

                                              >
                                            <td> <?php  
                                            date_default_timezone_set('America/Mexico_City');
                                            $fechaNow = new DateTime();
                                            $fechaE = new DateTime($lp->entrega);

                                            $diff = $fechaNow->diff($fechaE);
                                            $totalD = ($diff->invert == 1) ? ' - ' . $diff->days .' days '  : $diff->days .' days ';
                                            if ($totalD <= 3) {
                                              echo "urgente";
                                            }
                                            ?>
                                              
                                            </td>
                                              <td>{{$lp->id}}</td>
                                              <td>{{$lp->nombre}}</td>
                                              <td>{{$lp->status}}</td>
                                              <td>
                                                {{--con esto convierto la fecha de Y-m-d to d-m-Y --}}
                                       {{strftime("%d/%m/%Y", strtotime($lp->entrega)). " " .strftime("%H:%M",strtotime($lp->entrega))}}
                                              </td>
                                              <td>
                                                <a href="pedidos/{{$lp->id}}" class="btn btn-primary">ver</a> 
                                               <a href="pedidos/{{$lp->id}}/edit" class="btn btn-secondary">editar</a> 

                                               <a href="javascript: document.getElementById('delete').submit()" class="btn btn-danger" onclick="return confirm('deseas borrar?')">Eliminar</a>

                                                  <form id=delete action="pedidos/{{$lp->id}}" method="POST">
                                                    @csrf
                                                    @method('delete')
                                                   
                                                  </form>
                                                  </td>
                                            </tr>
                                            
                                           @endforeach
                                            
                                          </tbody>
                                        </table>
                            </div>
                        </div>

@endsection('content')