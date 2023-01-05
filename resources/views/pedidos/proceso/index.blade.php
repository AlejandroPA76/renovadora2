@extends('layout.layout2')
@section('title','Pedidos en proceso')
@section('content')

<br><br>
<div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Pedidos en proceso
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
                                             @foreach($listProc as $lproc)
                                            <tr
                                             bgcolor="<?php 
                                            date_default_timezone_set('America/Mexico_City');
                                            $fechaNow = new DateTime();
                                            $fechaE = new DateTime($lproc->entrega);

                                            $diff = $fechaNow->diff($fechaE);
                                            $totalD = ($diff->invert == 1) ? ' - ' . $diff->days .' days '  : $diff->days .' days ';

                                            if($totalD <=3)echo '#E59A90';
                                            else echo '' ?>" 

                                            >
                                                <td><?php  
                                            date_default_timezone_set('America/Mexico_City');
                                            $fechaNow = new DateTime();
                                            $fechaE = new DateTime($lproc->entrega);

                                            $diff = $fechaNow->diff($fechaE);
                                            $totalD = ($diff->invert == 1) ? ' - ' . $diff->days .' days '  : $diff->days .' days ';
                                            if ($totalD <=3) {
                                              echo "urgente";
                                            }
                                            ?></td>
                                              <td>{{$lproc->id}}</td>
                                              <td>{{$lproc->nombre}}</td>
                                              <td>{{$lproc->status}}</td>
                                              <td>
                                                 {{--con esto convierto la fecha de Y-m-d to d-m-Y --}}
                                       {{strftime("%d/%m/%Y", strtotime($lproc->entrega)). " " .strftime("%H:%M",strtotime($lproc->entrega))}}
                                              </td>
                                              <td><a href="/pedidos/{{$lproc->id}}" class="btn btn-primary">ver</a></td>
                                              
                                            </tr>
                                            
                                           @endforeach
                                            
                                          </tbody>
                                        </table>
                            </div>
                        </div>

@endsection('content')