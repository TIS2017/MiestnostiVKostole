@extends('layouts.app')
@section('title','Skupina')

@section('content')

<article></article>
<section>
	<?php 
    	$miestnost="/img/miestnost2.png";
    	$cas="/img/cas2.png";
    	$skupina="/img/skupina.png";
	?>
	@include('layouts.includes.filter')
	
	<div class="content">
		<div class="content-second">
		 	<form method="post" action="{{action('FilterController@filterGroup')}}" >
					{{ csrf_field() }}
			 	<p align="center">
						<select  name="group" id="group">
								<<option value="vyber">--Vyber skupinu--</option>
								@foreach ($grouplist as $item)
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

		<!-- Nazvy miestnosti a skupiny -->
		
		@if(!empty($groups))
				@foreach ($groups as $group)
					
						
		<h1 class="h1-text">{{ $group->group }}</h1>
		<table class="filtab">
			<thead>
			 	<tr>
					<th class="filter">deň od | do</th>
	   				<th class="filter">miestnosť</th>
	   			<?php	//<th class="filter"></th>  ?>
			  	</tr>
			  </thead>
		  	<tr>
		    	<td>  {{ $collect-> get($group->day)}} {{ $group->time }} - {{ $group->end_time }}</td>
		    	<td>{{ $group->room }}</td>
		    	<?php
		    	//zrusit skupinu moze len administrator a naduzivatel
		    	//<td><button class="two" type="submit">zrušiť</button></td>
		    	?>
		  	</tr>
		 </table>

		 @endforeach
				@endif

	 </div>
</section>

@endsection