<?php $__env->startSection('title','Miestnosť'); ?>

<?php $__env->startSection('content'); ?>

<article></article>
<section>
	<?php 
    	$miestnost="/img/miestnost.png";
    	$cas="/img/cas2.png";
    	$skupina="/img/skupina2.png";
	?>
	<?php echo $__env->make('layouts.includes.filter', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	<div class="content">
		<div class="content-second">
		 	<form>
			 	<p align="center">
				 	<input type="text" placeholder="NÁZOV MIESTNOSTI" name="room_name" value="" required>
			    	<button class="button-filter" type="submit">FILTRUJ</button>
		    	</p>
	    	</form>
	</div></div>
		<div class="padding">
	    <!-- Mapka -->
		<img src="/img/mapa.png" alt="mapa" class="img-responsive section-image border"><br>

		<!-- Nazvy miestnosti -->
		
			<h1 class="h1-text">MIESTNOSŤ A</h1>
			<table>
				<thead>
			 		<tr>
					   	<th>deň od | do</th>
					   	<th>skupina</th> 
			  		</tr>
			  	</thead>
		  		<tr>
		    		<td>PO 11:00 - 12:00</td>
		    		<td><a href="/miestnost/udaje-o-skupine" class="btn-hover">SKUP 1</a></td>
		  		</tr>
		 	</table>
	 	</div>
	
</section>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>