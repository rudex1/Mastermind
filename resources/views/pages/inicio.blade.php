    
@extends('layouts.default')
@section('title', 'Bienvnido al Mastermind')
@section('content')
<h1>Bienvnida/o al Mastermind</h1>
@if(isset($mensaje))
  <h2>{{$mensaje}}</h2>
@endif


<div class="img">
  <img width='32px' height='32px' src='img/0.png'>
  <img width='32px' height='32px' src='img/1.png'>
  <img width='32px' height='32px' src='img/2.png'>
  <img width='32px' height='32px' src='img/3.png'>
  <img width='32px' height='32px' src='img/4.png'>
  <img width='32px' height='32px' src='img/5.png'>
  <img width='32px' height='32px' src='img/6.png'>
  <img width='32px' height='32px' src='img/7.png'>
</div>
<br>

<form action="confMastermind" method="post">
  @csrf
  <div>
    <label for="nombre">Jugador/a: </label>
    <input type="text" name="Nombre" placeholder="&#128100; Nombre" required autofocus>
  </div>
  

  <div>
    <label for="lonEle">Longitud de la clave</label>
    <br>
    <input type="radio" name="lonEle" value="4" checked>4
    <input type="radio" name="lonEle" value="5">5
  </div>

<div>
  <label for="numEle">Número de elementos a adivinar: </label>
  <br>
  <input type="radio" name="numEle" value="4" checked>4
  <input type="radio" name="numEle" value="5">5
  <input type="radio" name="numEle" value="6">6
  <input type="radio" name="numEle" value="7">7
  <input type="radio" name="numEle" value="8">8
</div>

<div>
  <label for="repeat">Permitir repetidos: </label>
  <br>
  <input type="radio" name="repeat" value="1">Sí
  <input type="radio" name="repeat" value="0" checked>No
</div>

<div>
  <label for="numInt">Número de intentos: </label>
  <br>
  <select name="numInt">
    <option value="4">4</option>
    <option value="6">6</option>
    <option value="8">8</option>
    <option value="10">10</option>
  </select>
</div>


  <input type="submit" value="Enviar" name="enviar">
</form> 
@stop
@section('historial')

@stop
