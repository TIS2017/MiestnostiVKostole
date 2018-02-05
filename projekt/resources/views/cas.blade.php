@extends('layouts.app')
@section('title','Čas')

@section('content')

<article></article>
<section>
	<div class="alert-messages text-center"></div>
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
			            <option value="1" {{ (!empty($id_day) && $id_day == 1 ? "selected":"")}}>Pondelok</option>
		              	<option value="2" {{ (!empty($id_day) && $id_day == 2 ? "selected":"")}}>Utorok</option>
		              	<option value="3" {{ (!empty($id_day) && $id_day == 3 ? "selected":"")}}>Streda</option>
		              	<option value="4" {{ (!empty($id_day) && $id_day == 4 ? "selected":"")}}>Štvrtok</option>
		              	<option value="5" {{ (!empty($id_day) && $id_day == 5 ? "selected":"")}}>Piatok</option>
		              	<option value="6" {{ (!empty($id_day) && $id_day == 6 ? "selected":"")}}>Sobota</option>
		              	<option value="7" {{ (!empty($id_day) && $id_day == 7 ? "selected":"")}}>Nedeľa</option>
			        </select>

			        <span class="text">ČAS:</span> 
			        <select class="od" name="od" id="od">
						<option value="08:00">--od--</option>
						@for ($i = 8; $i < 21; $i++)
							@if ($i < 10)
								<option value="{{ "0".$i.":00" }}" {{ (!empty($from) && $from == "0$i:00" ? "selected":"")}}>0{{$i.":00"}}</option>
							@else
								<option value="{{ $i.":00" }}" {{ (!empty($from) && $from == "$i:00" ? "selected":"")}}>{{$i.":00"}}</option>
							@endif

						@endfor
					</select>
			        <select class="do" name="do" id="do">
						<option value="21:00">--do--</option>
						@for ($i = 9; $i < 22; $i++)
							@if ($i < 10)
								<option value="{{ "0".$i.":00" }}" {{ (!empty($to) && $to == "0$i:00" ? "selected":"")}}>0{{$i.":00"}}</option>
							@else
								<option value="{{ $i.":00" }}" {{ (!empty($to) && $to == "$i:00" ? "selected":"")}}>{{$i.":00"}}</option>
							@endif
						@endfor
					</select>

    				<button class="button-filter" type="submit">FILTRUJ</button>
		    	</p>
	    	</form>
	</div></div>
	<div class="padding">
	    <!-- Mapa -->
		@include('layouts.includes.map')

		<!-- Nazvy miestnosti a skupiny -->

		@if(!empty($times))
		
			<h1 class="h1-text">{{ $day or 'Pondelok' }} {{ $from or '08:00' }} - {{ $to or '21:00' }}</h1>
			<table class="filtab">
				<thead>
			 		<tr>
			 			<th class="filter">čas</th>
					   	<th class="filter">miestnosť</th>
	   					<th class="filter">skupina</th>
			  		</tr>
			  	</thead>

			  	@foreach ($filtered_time as $key=>$t)
				  	<?php $gtime = null; ?>
					@if(!empty($times))

						@foreach($times as $time)
							<tr>
								@if($day==$collect->get($time->day) && $t==$time->time)
								<td> {{ $t }} - {{ $key== $filtered_time->last()  ? '21:00' : $filtered_time->get($key+1) }} </td>
		    					<td> {{ $time->room }}</td>
								<td><a href="/udaje-o-skupine/{{ $time->group }}" class="btn-hover">{{ $time->group }}</a></td>
							
								@endif
							</tr>
						@endforeach
						  
					  	@if( Auth::check() && Auth::user()->is_admin == true || $is_subadmin > 0)
						@if($gtime == null)
							<tr> 
								@if($t != $filtered_time->last())
									<td> {{ $t }} - {{ $key== $filtered_time->last()  ? null : $filtered_time->get($key+1) }} </td>
									<td> - </td>
									<td> - </td>
									<td><button  
										data-userid="{{ Auth::user()->id }}"
										data-subadming="{{$groups}}"
										data-od = "{{$t}}"
										data-from="{{$from}}"
										data-to = "{{$to}}"
										data-den = "{{$day}}"
										data-roomlist = {{$roomlist}}
										data-click = "true"
										class="two" 
										data-toggle="modal"
										data-target="#rezervacia" 
										type="button">Pridať </button>
									</td>
								@endif
							</tr>
						@endif
						@endif
					@endif
				@endforeach
		 	</table>
		@endif
	 	</div>

	 	@include('rezervacia-miestnosti')
</section>
<script src="{{ asset('js/custom.js') }}"></script>
</script>
@if(session('Status'))
	<script type="text/javascript">
		showAlert("Rezervácia miestnosti prebehla úspešne.");
	</script>
@endif

@endsection