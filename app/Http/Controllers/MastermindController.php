<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MastermindController extends Controller
{
	public function cargarJuego(Request $request)
	{	
		$arrayEle = array();
		$intentos = 0;
		session()->put('turnos', []);
		session(['nombre' => $request->input("nombre")]);
		session(['lonEle' => $request->input("lonEle")]);
		session(['numEle' => $request->input("numEle")]);
		session(['repeat' => $request->input("repeat")]);
		session(['numInt' => $request->input("numInt")]);
		if (session('lonEle') > session('numEle') && session('repeat') != 1) {
			return view("pages/inicio", ['mensaje' => "La longitud de elementos no pueden ser mayor que el numero de elementos mientras no se puedan repetir."]);
		}
		for ($i=0; $i < session('lonEle'); $i++) {
			array_push($arrayEle, random_int(0, $request->input("numEle")-1));
		}
		if (session('repeat') != 1) {
			$numbers = range(0, $request->input("numEle")-1);
			shuffle($numbers);
			$arrayEle = array_slice($numbers, 0, $request->input("lonEle"));
		}
		session(['arrayEle' => $arrayEle]);
		session(['intentos' => $intentos]);
		return view("pages/mastermind",['nombre' => session('nombre'),
			'lonEle' => session('lonEle'),
			'numEle' => session('numEle'),
			'repeat' => session('repeat'),
			'numInt' => session('numInt'),
			'arrayEle' => session('arrayEle'),
			'intentos' => session('intentos')]);
	}

	public function comprobarJuego(Request $request)
	{	
		if ($request->input("jugar") != "Comprobar") {
			return view("pages/inicio");
		}else{
			$numJugador = array();
			session(['aciertos' => 0]);
			session(['candidatos' => 0]);

			for ($i=0; $i < session('lonEle'); $i++) { 
				array_push($numJugador, $request->input("numJug".$i));
				if (array_search($numJugador[$i], session('arrayEle')) == $i) {
					session(['aciertos' => session('aciertos')+1]);
				}elseif (in_array($numJugador[$i], session('arrayEle'))) {
					session(['candidatos' => session('candidatos')+1]);
				}
			}

			session(['numJugador' => $numJugador]);
			session()->push('turnos', ['numJugador' => session('numJugador'),
				'aciertos' => session('aciertos'),
				'candidatos' => session('candidatos')]);
			session(['intentos' => session('intentos')+1]);
			if (session('intentos') == session('numInt') && session('aciertos') != session('lonEle')) {
				return view("pages/mastermind",['nombre' => session('nombre'),
					'lonEle' => session('lonEle'),
					'numEle' => session('numEle'),
					'repeat' => session('repeat'),
					'numInt' => session('numInt'),
					'arrayEle' => session('arrayEle'),
					'intentos' => session('intentos'),
					'turnos' => session('turnos'),
					'mensaje' => 'Has perdido']);
			}elseif (session('aciertos') == session('lonEle')) {
				return view("pages/mastermind",['nombre' => session('nombre'),
					'lonEle' => session('lonEle'),
					'numEle' => session('numEle'),
					'repeat' => session('repeat'),
					'numInt' => session('numInt'),
					'arrayEle' => session('arrayEle'),
					'intentos' => session('intentos'),
					'turnos' => session('turnos'),
					'mensaje' => 'Has ganado']);
			}else{
				return view("pages/mastermind",['nombre' => session('nombre'),
					'lonEle' => session('lonEle'),
					'numEle' => session('numEle'),
					'repeat' => session('repeat'),
					'numInt' => session('numInt'),
					'arrayEle' => session('arrayEle'),
					'intentos' => session('intentos'),
					'turnos' => session('turnos')]);
			}
		}
	}
}
