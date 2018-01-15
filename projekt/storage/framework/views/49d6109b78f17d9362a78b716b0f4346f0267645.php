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
		 	<form method="post" action="<?php echo e(action('FilterController@filterGroup')); ?>" >
					<?php echo e(csrf_field()); ?>

			 	<p align="center">
						<select  name="group" id="group">
								<<option value="vyber">--Vyber skupinu--</option>
								<?php $__currentLoopData = $grouplist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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

		<!-- Nazvy miestnosti a skupiny -->
		
		<?php if(!empty($groups)): ?>
				<?php $__currentLoopData = $groups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $group): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					
						
		<h1 class="h1-text"><?php echo e($group->group); ?></h1>
		<table class="filtab">
			<thead>
			 	<tr>
					<th class="filter">deň od | do</th>
	   				<th class="filter">miestnosť</th>
	   			<?php	//<th class="filter"></th>  ?>
			  	</tr>
			  </thead>
		  	<tr>
		    	<td>  <?php echo e($collect-> get($group->day)); ?> <?php echo e($group->time); ?> - <?php echo e($group->end_time); ?></td>
		    	<td><?php echo e($group->room); ?></td>
		    	<?php
		    	//zrusit skupinu moze len administrator a naduzivatel
		    	//<td><button class="two" type="submit">zrušiť</button></td>
		    	?>
		  	</tr>
		 </table>

		 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				<?php endif; ?>

	 </div>
</section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>