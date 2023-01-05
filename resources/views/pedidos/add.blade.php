@extends('layout.layout2')
@section('title','Agregar Pedido')
@section('content')
 <style >
       textarea {
    font-size:19px;
}
</style>



<br>
<br>
<div class="card mb-4">
<div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                ingresa los datos
                            </div>
                            <div class="card-body">
                                <form method="POST" action="/pedidos">
                                    @csrf
                                    <div class="form-group">
                                      <p>
                                        
                                      
                                            <label>introduce tu nombre:</label>

                                            <input  type="text"  name="name" required>

                                            <label>cantidad de zapatos:</label>
                                            <input type="number" name="czapato" required>
                                            </p>

                                                                                    
                                        
                                    </div>

                                  
                                     
                                

                                    <div class="form-group">
                                      <p>
                                        <label>precio:</label>
                                        <input type="number" name="price" required>
                                        </p>
                                        <p>
                                        <label>abono:</label>
                                        <input type="number"  name="abono" required>
                                        </p>
                                    </div>

                                  
                                     <div class="form-group">
                                      <p>
                                            <label>fecha de entrega:</label>
                                            <input type="date" name="fechaE" required>
                                            <br><br>
                                             <label>hora de entrega:</label>
                                           <input type="time" name="time">
                                    </p>
                                 
                                           
                                          
                                    </div>

                                    
                                      <div class="form-group">
                                        <p>
                                            <label>numero de telefono:</label>
                                            <input type="tel"  name="tel" required>
                                            </p>
                                    </div>

                                     <div class="form-group">
                                            
                                        <input type="hidden"  name="status" required value="recibido">
                                    </div>
                                     <div class="form-group">
                                      <p>
                                            <label>nota:</label>
                                           </p>
                                            <textarea placeholder="Anota las reparaciones" name="description" cols="35" rows="15" style="resize: both;"></textarea>
                                  
                                    </div>

                                    <button type="submit" class="btn btn-primary">Agregar</button>
                                    <a href="/pedidos" class="btn btn-info">salir</a>

                                </form>
</div>
</div>
@endsection('content')