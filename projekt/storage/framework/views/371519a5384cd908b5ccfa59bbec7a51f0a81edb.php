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


			 <form method="post" action="<?php echo e(action('FilterController@filterRoom')); ?>">
				<?php echo e(csrf_field()); ?>

			 	<p align="center">


						<select  name="room" id="room">
								<option value="vyber"> --Vyber miestnosť-- </option>
								<?php $__currentLoopData = $roomlist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<option value=<?php echo e($item); ?>>  <?php echo e($item); ?>  </option>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</select>
					  

			    	<button class="button-filter" type="submit">FILTRUJ</button>
		    	</p>
			</form>
			

	</div></div>
		<div class="padding">
	    <!-- Mapa -->
		<?php echo $__env->make('layouts.includes.mapa', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>


		<!-- Nazvy miestnosti -->

		<?php if(!empty($rooms)): ?>
			<?php $__currentLoopData = $rooms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $room): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			
			<h1 class="h1-text"><?php echo e($room->room); ?></h1>
			<table class="filtab">
				<thead>
			 		<tr>
					   	<th class="filter">deň od | do</th>
					   	<th class="filter">skupina</th>  
			  		</tr>
			  	</thead>
		  		<tr>
		    		<td> <?php echo e($collect-> get($room->day)); ?> <?php echo e($room->time); ?> - <?php echo e($room->end_time); ?> </td>
		    		<td><a href="/miestnost/udaje-o-skupine" class="btn-hover"><?php echo e($room->group); ?></a></td>
		    		<?php
		    		/*
		    		pridat moze iba naduzivatel a administrator 
		    		<td><button class="two" type="submit">Pridať</button></td>  */
		    		?>
		  		</tr>
			 </table>
			 
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		<?php endif; ?>

	 	</div>
	
</section>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>