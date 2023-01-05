<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;

class PedidoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)

    { 
        //variable del buscador
        $buscarpor = $request->get('buscador');
        //a la par del buscador se envia un input value show con name de menu
       

//buscar pedido por id
if (is_numeric($buscarpor)) {
   $listPedidos = DB::table("pedidos")
                        ->where("id","like","%".$buscarpor."%")
                        ->get();

   
     Session::put('pedidosglobal',"si");
            return view('pedidos.index', compact('listPedidos','buscarpor'));
}

//buscar todos los pedidos escribiendo la palabra todos
if ($buscarpor == "/todos/"){
     $listPedidos = DB::table("pedidos")            
                       ->orderBy('entrega','asc')
                        ->get();

            Session::put('pedidosglobal',"no");                                     

            return view('pedidos.index', compact('listPedidos','buscarpor'));
}

//buscar pedido por nombre
if (is_string($buscarpor)) {
    //variable de sesion con la que me doy cuenta si hubo una busqueda es que estan en el menu de pedidos y con esto cambio el estado de la variable de sesion a si para poder habilitar todos los botones al metodo show y si no hay busqueda bloquea los botones por que no se encuentran en el menu pedidos
    Session::put('pedidosglobal',"si");
     $listPedidos = DB::table("pedidos")
                        //Buscar por nombre 
                        ->where("nombre","like","%".$buscarpor."%")
                        //Buscar por status
                        ->orwhere("status","like","%".$buscarpor."%")
                        ->get();
    
    
            return view('pedidos.index', compact('listPedidos','buscarpor'));
}

//mostrar solo los pendientes
if (is_null($buscarpor)) {
     $listPedidos = DB::table("pedidos")            
                       ->where("status", "=", "recibido")
                       ->orderBy('entrega','asc')
                        ->get();
            Session::put('pedidosglobal',"no");                                     

            return view('pedidos.index', compact('listPedidos','buscarpor'));
}


           
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
        return view('pedidos.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $newPedido = new Pedido;
        $newPedido->nombre = $request->input('name');
        $newPedido->cant_zap = $request->input('czapato');
        $newPedido->precio = $request->input('price');
        $newPedido->abono = $request->input('abono');
        $newPedido->restante = $request->input('price') - $request->input('abono');
        $newPedido->entrega= $request->input('fechaE'). " ". $request->input('time').":00";

        $newPedido->tel = $request->input('tel');
        $newPedido->status = $request->input('status');
        $newPedido->descripcion = $request->input('description');
        $newPedido->save();

        return redirect("/pedidos");

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pedido  $pedido
     * @return \Illuminate\Http\Response
     */
    public function show(Pedido $pedido)
    {
        //la variable de sesion sirve para saber si estan el menu de pedidos
          Session::get('pedidosglobal');

        $sPedido = Pedido::find($pedido->id);
        //convertimos el timestand 
        //en fecha y hora por separado
        $fecha = strftime("%d/%m/%Y", strtotime($sPedido->entrega));
        $hora =  strftime("%H:%M:%S",strtotime($sPedido->entrega));
        //con el if comparamos si estan en el menu pedidos y si es asi mandamos el valor de pro como "si" a la vista pedidos.show
      if(Session()->get('pedidosglobal')== "si"){
            $pro = "si";
            //devolemos el valor de no a la variable de session en caso de entrar a otro menu distinto a pedidos 
            Session::put('pedidosglobal',"no");
            //se manda el valor de pro a la vista pedidos.show
             return view('pedidos.show',compact('sPedido','fecha','hora','pro'));
      }else{
        //colocamos la variable pro con el valor no y mandarlo a la vista
         $pro = "no";
        return view('pedidos.show',compact('sPedido','fecha','hora','pro'));
    }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pedido  $pedido
     * @return \Illuminate\Http\Response
     */
    public function edit(Pedido $pedido)
    {
        $editPedido = Pedido::find($pedido->id);
         //convertimos el timestand 
        //en fecha y hora por separado

        $fecha = strftime("%Y-%m-%d", strtotime($editPedido->entrega));
        $hora =  strftime("%H:%M:%S",strtotime($editPedido->entrega));

        return view('pedidos.edit',compact('editPedido','fecha','hora'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pedido  $pedido
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pedido $pedido)
    {
    //aqui al ver el pedido se modifica solo el estatus a "proceso" cuando se ve el pedido en el menu pedidos
    if($request->input('menu') == "show"){

        $upPedido =Pedido::find($pedido->id);
        $upPedido->status = $request->input('status');
        $upPedido->save();

        return redirect('/');
    }
    //aqui se modifica todas las caracteriticas del pedido en el menu pedidos
    elseif ($request->input('menu') == "edit") {

        $uptP =Pedido::find($pedido->id);
        $uptP->nombre = $request->input('name');
        $uptP->cant_zap = $request->input('czapato');
        $uptP->precio = $request->input('price');
        $uptP->abono = $request->input('abono');
        $uptP->restante = $request->input('price') - $request->input('abono');
        $uptP->entrega= $request->input('fechaE'). " ". $request->input('time');

        $uptP->tel = $request->input('tel');
        //$uptP->status = $request->input('status');
        $uptP->descripcion = $request->input('description');
        $uptP->save();
        //return $uptP;
        return redirect()->back();
    }
    //si ya se finalizo el pedido
    elseif ($request->input('menu') == "show2") {
        $upPe =Pedido::find($pedido->id);
        $upPe->status = $request->input('status');
        $upPe->save();

        return redirect()->back();
    }

     elseif ($request->input('menu') == "finalizar") {
        $upPe =Pedido::find($pedido->id);
        $upPe->status = $request->input('status');
        $upPe->save();

        return redirect()->back();
    }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pedido  $pedido
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pedido $pedido)
    {
        $delP = Pedido::find($pedido->id);
        $delP->delete();
        return redirect('');
    }

//listar pedidos en proceso
    public function listProceso(){
        $listProc = DB::table("pedidos")
            ->where("status", "=", "proceso")
            ->orderBy('entrega','asc')
            ->get();
        
         
       
        
       return view('pedidos.proceso.index', compact('listProc'));
    }

    public function listFinalizado(){
         $listFi = DB::table("pedidos")
            ->where("status", "=", "finalizado")
            ->orderBy('entrega','asc')
            ->get();
        
       return view('pedidos.finalizado.index', compact('listFi'));
    }
}
