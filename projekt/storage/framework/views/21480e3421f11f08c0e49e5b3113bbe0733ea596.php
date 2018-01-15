<?php $__env->startSection('title','Čas'); ?>

<?php $__env->startSection('content'); ?>

<article></article>
<section>
	<?php 
    	$miestnost="/img/miestnost2.png";
    	$cas="/img/cas.png";
    	$skupina="/img/skupina2.png";
	?>
	<?php echo $__env->make('layouts.includes.filter', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	<div class="content">
		<div class="content-second">

				<form method="post" action="<?php echo e(action('FilterController@filterTime')); ?>">
						<?php echo e(csrf_field()); ?>

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

					<select class="od" name="od" id="od">
							<option value="0">--od--</option>
							<?php for($i = 1; $i < 25; $i++): ?>
							<option value="<?php echo e($i); ?>"><?php echo e($i); ?></option>
							   <?php endfor; ?>
						</select>
			 
						<select class="do" name="do" id="do">
							<option value="24">--do--</option>
							<?php for($i = 1; $i < 25; $i++): ?>
							<option value="<?php echo e($i); ?>"><?php echo e($i); ?></option>
							   <?php endfor; ?>
						</select>

    				<button class="button-filter" type="submit">FILTRUJ</button>
		    	</p>
	    	</form>
	</div></div>
	<div class="padding">
	    <!-- Mapa -->
		<?php echo $__env->make('layouts.includes.mapa', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

		<!-- Nazvy miestnosti a skupiny -->


		<?php if(!empty($times)): ?>
		<?php $__currentLoopData = $times; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $time): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

			<h1 class="h1-text"><?php echo e(isset($day) ? $day : 'Pondelok'); ?> <?php echo e(isset($from) ? $from : '00:00'); ?> | <?php echo e(isset($to) ? $to : '24:00'); ?></h1>
			<table class="filtab">
				<thead>
			 		<tr>
					   	<th class="filter">miestnosť</th>
	   					<th class="filter">skupina</th>
			  		</tr>
			  	</thead>
		  		<tr>
		    		<td><?php echo e($time->room); ?></td>
		    		<td><a href="/cas/udaje-o-skupine" class="btn-hover"><?php echo e($time->group); ?></a></td>
		    		<?php
		    		//tiez iba naduzivatel a administrator
		    		//pridat moze iba ak je volna miestnost
		    		
		    		//<td><button class="two" type="submit">Pridať</button></td>
		    		?>
		  		</tr>
			 </table>
			 
			 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		<?php endif; ?>	

	 	</div>
</section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>