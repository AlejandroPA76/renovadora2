@extends('layout.layout2')
@section('title','Agregar Pedido')
@section('content')

<br>
<br>
<div class="card mb-4">
<div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                ingresa los datos
                            </div>
                            <div class="card-body">
                              <form id=update method="POST" action="/pedidos/{{$editPedido->id}}">
                                 

                                    @csrf
                                    @method('PUT')

                                    <input type="hidden" name="menu" value="edit">
                                    
                                    <div class="form-group">
                                      <p>
                                      <label>id:</label>
                                            <input  type="number"  name="id" value="{{$editPedido->id}}" disabled>
                                          </p>  
                                      <p>

                                            <label>introduce tu nombre:</label>

                                            <input  type="text"  name="name" value="{{$editPedido->nombre}}">

                                            <label>cantidad de zapatos:</label>
                                            <input type="number" name="czapato" value="{{$editPedido->cant_zap}}">
                                            </p>

                                    </div>

                                    <div class="form-group">
                                      <p>
                                        <label>precio:</label>
                                        <input type="number" name="price" value="{{$editPedido->precio}}">
                                        </p>
                                        <p>
                                        <label>abono:</label>
                                        <input type="number"  name="abono" value="{{$editPedido->abono}}">
                                        </p>

                                        <p>
                                        <label>debe:</label>
                                        <input type="number"  name="debe" value="{{$editPedido->restante}}">
                                        </p>
                                    </div>

                                  
                                 <div class="form-group">
                                      <p>
                                        
                                            <label>fecha de entrega:</label>
                                            <input type="date" name="fechaE" required value="{{$fecha}}">
                                            <br><br>
                                            
                                             <label>hora de entrega:</label>
                                           <input type="time" name="time" value="{{$hora}}">
                                    </p>
                                 
                                           
                                          
                                    </div>

                                    
                                      <div class="form-group">
                                        <p>
                                            <label>numero de telefono:</label>
                                            <input type="tel"  name="tel" value="{{$editPedido->tel}}">
                                            </p>
                                    </div>

                                  
                                     <div class="form-group">
                                      <p>
                                            <label>nota:</label>
                                           </p>
                                            <textarea placeholder="Anota las reparaciones" name="description" cols="40" rows="5" style="resize: both;">{{$editPedido->descripcion}}</textarea>
                                  
                                    </div>

                                   <a href="javascript: document.getElementById('update').submit()" class="btn btn-danger btn-sm" onclick="return confirm('seguro que quieres actualizar los datos?')">Actualizar</a>

                                    <a href="/pedidos" class="btn btn-info">salir</a>
                                    </form>

                             
</div>
</div>
@endsection('content')