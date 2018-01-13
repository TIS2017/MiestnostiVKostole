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
				 	<select name="day" id="day">
			            <option value="vyber">--Vyber skupinu--</option>
			            <option value="1">skup1</option>
			        </select>
    				<button class="button-filter" type="submit">FILTRUJ</button>
		    	</p>
	    	</form>
	</div></div>

	<div class="padding">
	    <!-- Mapa -->
		@include('layouts.includes.mapa')

		<!-- Nazvy miestnosti a skupiny -->
		
		<h1 class="h1-text">SKUP 1</h1>
		<table class="filtab">
			<thead>
			 	<tr>
					<th class="filter">deň od | do</th>
	   				<th class="filter">miestnosť</th>
	   			<?php	//<th class="filter"></th>  ?>
			  	</tr>
			  </thead>
		  	<tr>
		    	<td>PO 11:00 - 12:00</td>
		    	<td>45</td>
		    	<?php
		    	//zrusit skupinu moze len administrator a naduzivatel
		    	//<td><button class="two" type="submit">zrušiť</button></td>
		    	?>
		  	</tr>
		 </table>
	 </div>
</section>

@endsection