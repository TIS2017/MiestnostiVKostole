@extends('layouts.app')
@section('title','Miestnosť')

@section('content')

<article></article>
<section>
	<?php 
    	$miestnost="/img/miestnost.png";
    	$cas="/img/cas2.png";
    	$skupina="/img/skupina2.png";
	?>
	@include('layouts.includes.filter')

	<div class="content">
		<div class="content-second">


			 <form method="post" action="{{action('FilterController@filterRoom')}}">
				{{ csrf_field() }}
			 	<p align="center">


						<select  name="room" id="room">
								<option value="vyber"> --Vyber miestnosť-- </option>
								@foreach ($roomlist as $item)
									<option value={{$item}}>  {{$item}}  </option>
								@endforeach
						</select>
					  

			    	<button class="button-filter" type="submit">FILTRUJ</button>
		    	</p>
			</form>
			

	</div></div>
		<div class="padding">
	    <!-- Mapa -->
		@include('layouts.includes.mapa')


		<!-- Nazvy miestnosti -->

		@if(!empty($rooms))
			@foreach ($rooms as $room)
			
			<h1 class="h1-text">{{ $room->room }}</h1>
			<table class="filtab">
				<thead>
			 		<tr>
					   	<th class="filter">deň od | do</th>
					   	<th class="filter">skupina</th>  
			  		</tr>
			  	</thead>
		  		<tr>
		    		<td> {{ $collect-> get($room->day)}} {{ $room->time }} - {{ $room->end_time }} </td>
		    		<td><a href="/miestnost/udaje-o-skupine" class="btn-hover">{{ $room->group }}</a></td>
		    		<?php
		    		/*
		    		pridat moze iba naduzivatel a administrator 
		    		<td><button class="two" type="submit">Pridať</button></td>  */
		    		?>
		  		</tr>
			 </table>
			 
			@endforeach
		@endif

	 	</div>
	
</section>

@endsection

