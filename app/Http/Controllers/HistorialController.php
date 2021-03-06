<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use App\Historial;
use App\Jugador;
use App\Partido;
use App\Club;
use App\Asociacion;
use App\Ciudad;
use App\Estadio;
use App\Pais;
use App\Torneo;
use App\Arbitro;

use App\TrayectoriaJugador;

use DB;

class HistorialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $historiales = Historial::all();
        $jugadores=Jugador::all();
        $partidos=Partido::all();
        
        return view('historial.index',  ['historiales' => $historiales,'partidos' => $partidos, 'jugadores' => $jugadores]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $partidos = Partido::findOrFail($id);
       
        $asociaciones=Asociacion::all();
        $clubes=Club::all();
        $ciudades=Ciudad::all();
        $estadios=Estadio::all();
        $paises=Pais::all();
        $torneos=Torneo::all();
        $arbitros=Arbitro::all();


        $jugadores = Jugador::all();
        $trayectoriasjugadores = TrayectoriaJugador::all();
        $historiales = DB::table('Historiales')->get();

       // dd($partidos);
        //$jugadorHistorial = $historiales['idJugador'];




       
        $jugador_partido =DB::table('Jugadores')
                        ->join('TrayectoriasJugadores', 'TrayectoriasJugadores.idJugador', '=','Jugadores.idJugador')


                        ->get();





                     #   dd($jugador_partido);

        $jugadorclub = DB::table('Clubes')
                        ->join('Jugadores','Clubes.idClub','=','Jugadores.idClub')
                        ->get();
       // dd($jugadorclub);



        return view('historial.create',['partidos' => $partidos, 'clubes' => $clubes, 'torneos' => $torneos, 'id' => $id, 'estadios' => $estadios, 'jugadores' => $jugadores, 'trayectoriasjugadores' => $trayectoriasjugadores, 'historiales' => $historiales, 'jugador_partido' => $jugador_partido, 'jugadorclub' => $jugadorclub]);
        /*---------PRUEBA 2----------------
        $jugadores=Jugador::all();
        $clubes=Club::all();
        $partidos=Partido::all();
        $jugadorclublocal = DB::table('Clubes')
                        ->join('Jugadores','Clubes.idClub','=','Jugadores.idClub')
                        ->join('Partidos','Clubes.idClub', '=','Partidos.clubLocalPartido')                    
                        ->get();
       //dd($jugadorclublocal);

        $jugadorclubvisita = DB::table('Clubes')
                        ->join('Jugadores','Clubes.idClub','=','Jugadores.idClub')
                        ->join('Partidos','Clubes.idClub', '=','Partidos.clubVisitaPartido')                    
                        ->get();
        //dd($jugadorclubvisita);
        

        $jugador_partido =DB::table('Jugadores')
                        ->join('TrayectoriasJugadores', 'TrayectoriasJugadores.idJugador', '=','Jugadores.idJugador')


                        ->get();
      //dd($jugador_partido);

        $listalocal = DB::table('Historiales')
                    ->join('Partidos','Historiales.idPartido','=','Partidos.idPartido')
                    ->get();
      // dd($listalocal);

       $partidoclublocal = DB::table('Partidos')//Muestra el club que hizo de local ese partido
                    ->join('Clubes','Clubes.idClub', '=','Partidos.clubLocalPartido')
                    ->get();
     // dd($partidoclublocal);

         $partidoclubvisita = DB::table('Partidos')//Muestra el club que hizo de visita ese partido
                    ->join('Clubes','Clubes.idClub', '=','Partidos.clubVisitaPartido')
                    ->get();
       // dd($partidoclubvisita);


        return view('historial.create', ['partidos' => $partidos, 'jugadores' => $jugadores, 'partidoclublocal' => $partidoclublocal, 'partidoclubvisita' => $partidoclubvisita, 'clubes' => $clubes, 'jugadorclublocal' => $jugadorclublocal,'jugadorclubvisita' => $jugadorclubvisita, 'listalocal' => $listalocal]);*/
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $historial = new Historial();
        $historial->idPartido = $request->input('idPartido');
        $historial->idJugador = $request->input('idJugador');
        $historial->golJugador = $request->input('golJugador');   
        $historial->amarillaJugador = $request->input('amarillaJugador');     
        $historial->rojaJugador = $request->input('rojaJugador');
        $historial->minutosJugador = $request->input('minutosJugador');

        
        $historial->save();

        return Redirect::to('historial');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
