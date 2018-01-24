@extends('layouts.app')
@section('title','Čas')

@section('content')

<article></article>
<section>
	<?php 
    	$miestnost="/img/miestnost2.png";
    	$cas="/img/cas.png";
    	$skupina="/img/skupina2.png";
	?>
	@include('layouts.includes.filter')

	<div class="content">
		<div class="content-second">
		 	<form method="post" action="{{action('FilterController@filterTime')}}">
			{{ csrf_field() }}
			 	<p align="center">
			 		<span class="text">DEŇ:</span>
			        <select class="den" name="den" id="den">
			            <option value="vyber">--Vyber deň--</option>
			            <option value="1">Pondelok</option>
			            <option value="2">Utorok</option>
			            <option value="3">Streda</option>
			            <option value="4">Štvrtok</option>
			            <option value="5">Piatok</option>
			            <option value="6">Sobota</option>
			            <option value="7">Nedeľa</option>
			        </select>

			        <span class="text">ČAS:</span> 
			        <select class="od" name="od" id="od">
						<option value="00:00">--od--</option>
						@for ($i = 1; $i < 25; $i++)
							@if ($i < 10)
								<option value="{{ "0".$i.":00" }}">0{{$i.":00"}}</option>
							@else
								<option value="{{ $i.":00" }}">{{$i.":00"}}</option>
							@endif

						@endfor
					</select>
			        <select class="do" name="do" id="do">
						<option value="24:00">--do--</option>
						@for ($i = 1; $i < 25; $i++)
							@if ($i < 10)
								<option value="{{ "0".$i.":00" }}">0{{$i.":00"}}</option>
							@else
								<option value="{{ $i.":00" }}">{{$i.":00"}}</option>
							@endif
						@endfor
					</select>

    				<button class="button-filter" type="submit">FILTRUJ</button>
		    	</p>
	    	</form>
	</div></div>
	<div class="padding">
	    <!-- Mapa -->
		@include('layouts.includes.mapa')

		<!-- Nazvy miestnosti a skupiny -->

		@if(!empty($times))
		
			<h1 class="h1-text">{{ $day or 'Pondelok' }} {{ $from or '00:00' }} - {{ $to or '24:00' }}</h1>
			<table class="filtab">
				<thead>
			 		<tr>
					   	<th class="filter">miestnosť</th>
	   					<th class="filter">skupina</th>
			  		</tr>
			  	</thead>

			  	@foreach ($times as $time)
		  		<tr>
		    		<td> {{ $time->room }}</td>
		    		<td><a href="/udaje-o-skupine/{{ $time->group }}" class="btn-hover">{{ $time->group }}</a></td>
		    		<?php
		    		//tiez iba naduzivatel a administrator
		    		//pridat moze iba ak je volna miestnost
		    		
		    		//<td><button class="two" type="submit">Pridať</button></td>
		    		?>
		  		</tr>
		 	@endforeach
		 	</table>
		@endif
	 	</div>
</section>

@endsection