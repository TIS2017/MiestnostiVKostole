@extends('layouts.app')
@section('title','Miestnosť')

@section('content')


<article>
	@include('layouts.includes.error')
</article>
<section>
	<div class="alert-messages text-center"></div>
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
							<option value="{{$item->name}}" {{(!empty($roomName) && $roomName == $item->name ? "selected":"")}}>  {{$item->name}}  </option>
						@endforeach
					</select>
			    	<button class="button-filter" type="submit">FILTRUJ</button>
		    	</p>
	    	</form>
	</div></div>
		<div class="padding">
	    <!-- Mapa -->
		@include('layouts.includes.map')

		<!-- Nazvy miestnosti -->
		@if(!empty($roomName) )
		
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
						<?php $gtime = null; ?>
							@if(!empty($rooms))
								@foreach ($rooms as $room)
								<tr>
									@if($day==$collect->get($room->day) && $t==$room->time)
										<?php $gtime = $t ?>
										<td class="filter"> {{ $t }} - {{ $key==23 ? "24:00" : $times->get($key+1) }} </td>
							    		<td class="filter"><a href="/udaje-o-skupine/{{ $room->group }}" class="btn-hover">{{ $room->group }}</a></td>
							  		@endif
							  	</tr>
							  	@endforeach

						
							@if($gtime == null  && ($roomName != 'Vrátnica' || $roomName != '47' || $roomName != '55'))
								<tr>	  
							 	<td class="filter"> {{ $t }} - {{ $key==23 ? "24:00" : $times->get($key+1) }} </td>
								<td class="filter"> - </td>

								@if( Auth::check() && Auth::user()->is_admin == true || $is_subadmin > 0)
									<td class="filter"><button  
										data-roomname="{{ $roomName }}" 
										data-userid="{{ Auth::user()->id }}"
										data-subadming="{{$groups}}"
										data-od = "{{$t}}"
										data-den = "{{$day}}"
										class="two" 
										data-toggle="modal" 
										data-target="#rezervacia" 
										type="button">Pridať </button>
									</td>
								@endif
							@endif
						
							@else
									<tr>
										<td class="filter"> {{ $t }} - {{ $key==23 ? "24:00" : $times->get($key+1) }} </td>
										<td class="filter"> - </td>
										@if( Auth::check() && Auth::user()->is_admin == true || $is_subadmin > 0)
											<td class="filter"><button  
												data-roomname="{{ $roomName }}" 
												data-userid="{{ Auth::user()->id }}"
												data-subadming="{{$groups}}"
												data-od = "{{$t}}"
												data-den = "{{$day}}"
												class="two" 
												data-toggle="modal" 
												data-target="#rezervacia" 
												type="button">Pridať </button>
											</td>
										@endif
							@endif
							</tr>
						  @endforeach
						  
			  		</table>
		  		</div>
		  	
		 	@endforeach
		 	</div>
		@endif
	 	</div>
	 	@include('rezervacia-miestnosti')
</section>

<script src="{{ asset('js/custom.js') }}"></script>
@if(session('Status'))
	<script type="text/javascript">
		showAlert("Rezervácia miestnosti prebehla úspešne.");
	</script>

@elseif(session('Error'))
	<script type="text/javascript">
		showAlert("Miestnosť je obsadená.");
	</script>
@endif

@endsection

