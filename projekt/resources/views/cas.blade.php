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
		 	<form>
			 	<p align="center">
				 	<input class="one" type="text" placeholder="DEŇ" name="den" required>
	 					<span class="text">ČAS:</span> 
	 				<input class="two" type="text" placeholder="OD | DO" name="cas" required>
    				<button class="button-filter" type="submit">FILTRUJ</button>
		    	</p>
	    	</form>
	</div></div>
	<div class="padding">
	    <!-- Mapa -->
		<img src="/img/mapa.png" alt="mapa" class="img-responsive section-image border"><br>

		<!-- Nazvy miestnosti a skupiny -->
		
			<h1 class="h1-text">DEŇ OD | DO</h1>
			<table>
				<thead>
			 		<tr>
					   	<th>miestnosť</th>
	   					<th>skupina</th>
			  		</tr>
			  	</thead>
		  		<tr>
		    		<td>54</td>
		    		<td><a href="" class="btn-hover">SKUP 1</a></td>
		  		</tr>
		 	</table>
	 	</div>
</section>

@endsection