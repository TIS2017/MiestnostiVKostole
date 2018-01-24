@extends('layouts.app')
@section('title','Miestnosť')

@section('content')


<article>
	@include('layouts.includes.error')
</article>
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
			 	<p class="filtre" align="center">
			 		<select  class="vyber" name="room" id="room">
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
		@if(!empty($rooms) && !empty($roomName) )
		
			<h1 class="h1-text">{{ $roomName }}</h1>
			<ul class="nav nav-pills nav-justified">
			@foreach ($collect as $day)
				<li class=""><a data-toggle="tab" href="#{{ $day }}">{{ $day }}</a></li>
			@endforeach
		 	</ul>
		 	
			 <div class="tab-content">
			@foreach ($collect as $day)
				<div id="{{ $day }}" class="tab-pane">
					<table class="filtab">
						<thead>
					 		<tr>
							   	<th class="filter"> od | do </th>
							   	<th class="filter">skupina</th>  
					  		</tr>
					 	</thead>
						@foreach ($times as $key=>$t)
							@foreach ($rooms as $room)
								<tr>
								@if($day==$collect->get($room->day) && $t==$room->time)
							    	<td> {{ $room->time }} - {{ \Illuminate\Support\Str::limit($room->end_time, $limit = 5, $end = '') }} </td>
							    	<td><a href="/udaje-o-skupine/{{ $room->group }}" class="btn-hover">{{ $room->group }}</a></td>
							  	@else
							    		<td> {{ $t }} - {{ $key==20 ? "21:00" : $times->get($key+1) }} </td>
							    		<td> - </td>

							    		@if( Auth::check() && Auth::user()->is_admin == true || $is_subadmin > 0) 
							    			<td><button class="two" type="submit">Pridať</button></td>
							    		@endif
							  	@break;
							  	@endif
							  	</tr>
				  			@endforeach
				  		@endforeach
			  		</table>
		  		</div>
		  	
		 	@endforeach
		 	</div>
		@endif
	 	</div>
</section>

@endsection

