@extends('layouts.app')
@section('title','Skupina')

@section('content')

<article>
	@include('layouts.includes.error')
</article>
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
							<option value="vyber">--Vyber skupinu--</option>
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
		@if(!empty($groups) && !empty($groupName))

		<h1 class="h1-text">{{ $groupName }}</h1>
		@if($groups->count()==0)
			<p align=center>Skupina nemá žiadnu rezervovanú miestnosť.</p>
		@else
		<table class="filtab">
			<thead>
			 	<tr>
					<th class="filter">deň od | do</th>
	   				<th class="filter">miestnosť</th>
	   				@if( Auth::check() && Auth::user()->is_admin == true || $is_subadmin>0)
	   					<th class="filter"></th>
	   				@endif
			  	</tr>
			  </thead>
			@foreach ($groups as $group)
		  	<tr>
		    	<td>  {{ $collect-> get($group->day)}} {{ $group->time }} - {{ \Illuminate\Support\Str::limit($group->end_time, $limit = 5, $end = '') }}</td>
		    	<td>{{ $group->room }}</td>

		    	@if( Auth::check() && Auth::user()->is_admin == true || $is_subadmin>0)
		    		<td><button class="two" type="submit">zrušiť</button></td>
		    	@endif
		  	</tr>
		  	@endforeach
		 </table>
		 @endif
		 @endif
	 </div>
</section>

@endsection