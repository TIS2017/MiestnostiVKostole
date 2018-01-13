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
		 	<form>
			 	<p align="center">
			 		<select name="day" id="day">
		            	<option value="vyber"> --Vyber miestnosť-- </option>
		            	<option value="1">55</option>
          			</select>
			    	<button class="button-filter" type="submit">FILTRUJ</button>
		    	</p>
	    	</form>
	</div></div>
		<div class="padding">
	    <!-- Mapa -->
		@include('layouts.includes.mapa')

		<!-- Nazvy miestnosti -->
		
			<h1 class="h1-text">MIESTNOSŤ A</h1>
			<table class="filtab">
				<thead>
			 		<tr>
					   	<th class="filter">deň od | do</th>
					   	<th class="filter">skupina</th>  
			  		</tr>
			  	</thead>
		  		<tr>
		    		<td>PO 11:00 - 12:00</td>
		    		<td><a href="/miestnost/udaje-o-skupine" class="btn-hover">SKUP 1</a></td>
		    		<?php
		    		/*
		    		pridat moze iba naduzivatel a administrator 
		    		<td><button class="two" type="submit">Pridať</button></td>  */
		    		?>
		  		</tr>
		 	</table>
	 	</div>
	
</section>

@endsection

