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
			 		<span class="text">DEŇ:</span>
			        <select class="den" name="den" id="den">
			            <option value="vyber">--Vyber deň--</option>
			            <option value="1">Pondelok</option>
			            <option value="2">Utorok</option>
			            <option value="3">Streda</option>
			            <option value="4">Štvrtok</option>
			            <option value="5">Piatok</option>
			            <option value="6">Sobota</option>
			            <option value="7">Nedeľa</option>
			        </select>

			        <span class="text">ČAS:</span> 
			        <select class="od" name="od" id="od">
			            <option value="vyber">--od--</option>
			            <option value="1">11hod</option>
			        </select>
			        <select class="do" name="do" id="do">
			            <option value="vyber">--do--</option>
			            <option value="1">12hod</option>
			        </select>

    				<button class="button-filter" type="submit">FILTRUJ</button>
		    	</p>
	    	</form>
	</div></div>
	<div class="padding">
	    <!-- Mapa -->
		@include('layouts.includes.mapa')

		<!-- Nazvy miestnosti a skupiny -->
		
			<h1 class="h1-text">DEŇ OD | DO</h1>
			<table class="filtab">
				<thead>
			 		<tr>
					   	<th class="filter">miestnosť</th>
	   					<th class="filter">skupina</th>
			  		</tr>
			  	</thead>
		  		<tr>
		    		<td>54</td>
		    		<td><a href="/cas/udaje-o-skupine" class="btn-hover">SKUP 1</a></td>
		    		<?php
		    		//tiez iba naduzivatel a administrator
		    		//pridat moze iba ak je volna miestnost
		    		
		    		//<td><button class="two" type="submit">Pridať</button></td>
		    		?>
		  		</tr>
		 	</table>
	 	</div>
</section>

@endsection