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
		 	<form>
			 	<p align="center">
				 	<input type="text" placeholder="NÁZOV SKUPINY" name="skupina" value="" required>
    				<button class="button-filter" type="submit">FILTRUJ</button>
		    	</p>
	    	</form>
	</div></div>

	<div class="padding">
	    <!-- Mapa -->
		<img src="/img/mapa.png" alt="mapa" class="img-responsive section-image border"><br>

		<!-- Nazvy miestnosti a skupiny -->
		
		<h1 class="h1-text">SKUP 1</h1>
		<table>
			<thead>
			 	<tr>
					<th>deň od | do</th>
	   				<th>miestnosť</th>
	   				<th></th> 
			  	</tr>
			  </thead>
		  	<tr>
		    	<td>PO 11:00 - 12:00</td>
		    	<td>45</td>
		    	<td><button class="two" type="submit">zrušiť</button></td>
		  	</tr>
		 </table>
	 </div>
</section>

@endsection