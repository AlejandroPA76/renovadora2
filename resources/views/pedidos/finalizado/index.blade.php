@extends('layout.layout2')
@section('title','Pedidos terminados')
@section('content')

<br><br>
<div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Pedidos terminados
                            </div>
                            <div class="card-body">
                                <table class="table">

                                          <thead>
                                            <tr>
                                              <th scope="col">codigo</th>
                                              <th scope="col">nombre</th>
                                              <th scope="col">status</th>
                                              <th scope="col">entrega</th>
                                              <th scope="col">Accion</th>
                                            </tr>
                                          </thead>
                                          <tbody>
                                             @foreach($listFi as $lf)
                                            <tr>
                                              <td>{{$lf->id}}</td>
                                              <td>{{$lf->nombre}}</td>
                                              <td>{{$lf->status}}</td>
                                              <td>
                                                 {{--con esto convierto la fecha de Y-m-d to d-m-Y --}}
                                       {{strftime("%d/%m/%Y", strtotime($lf->entrega)). " " .strftime("%H:%M",strtotime($lf->entrega))}}
                                              </td>

                                              <td><a href="/pedidos/{{$lf->id}}" class="btn btn-primary">ver</a></td>
                                              
                                            </tr>
                                            
                                           @endforeach
                                            
                                          </tbody>
                                        </table>
                            </div>
                        </div>

@endsection('content')