@extends('layouts.default')
@section('title', 'Juego Mastermind')
@section('content')
<br><br><br>
<h1>Bienvnida/o al Mastermind</h1>
<h2>Jugador: {{$nombre}}</h2>

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
<form action="jugar" method="post">
  @csrf
  @for ($i=0; $i < $lonEle; $i++)
  <select name="numJug{{$i}}">
    @for ($j=0; $j < $numEle; $j++)
    <option value="{{$j}}" {{$i==$j ? 'selected' : ''}}>{{($j+1)}}</option>
    @endfor
  </select>

  @endfor
  <br><br>
  @if (isset($mensaje))
  <h2>{{$mensaje}}</h2>
  <input type="submit" name="jugar" value="Volver a jugar">
  @else
  <input type="submit" name="jugar" value="Comprobar">
  @endif

</form>
<br>
<p>Numero de intentos: {{$intentos}}</p>

@stop
@section('historial')
@if(isset($turnos))
@foreach ($turnos as $turno)
@for ($i = 0; $i < count($turno['numJugador']);$i++)
<img width='32px' height='32px' src="img/{{$turno['numJugador'][$i]}}.png">
@endfor
<p>Aciertos: {{$turno['aciertos']}} Candidatos : {{$turno['candidatos']}}</p>
@endforeach
@endif
@stop
