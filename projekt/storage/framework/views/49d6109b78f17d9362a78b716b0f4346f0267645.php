<?php $__env->startSection('title','Skupina'); ?>

<?php $__env->startSection('content'); ?>

<article></article>
<section>
	<?php 
    	$miestnost="/img/miestnost2.png";
    	$cas="/img/cas2.png";
    	$skupina="/img/skupina.png";
	?>
	<?php echo $__env->make('layouts.includes.filter', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	
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

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>