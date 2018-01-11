<?php $__env->startSection('title','Prihlásenie'); ?>

<?php $__env->startSection('content'); ?>

<section>
	<div class="section">
	<?php echo $__env->make('layouts.includes.error', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		<h1 class="center h1-text2">
		 	<a class="h1-a" href="/registracia">REGISTER</a>
	    	<a  class="h1-a active" href="/prihlasenie">LOG IN</a>
	    </h1>
	    <form method="POST" action="<?php echo e(url('/prihlasenie')); ?>">
	    	<?php echo e(csrf_field()); ?>

	    	<p class="formular" align="center">
		    	<input type="text" placeholder="PRIHLASOVACIE MENO" name="username" value="<?php echo e(old('username')); ?>" required><br>
	    		<input type="password" placeholder="HESLO" name="password" required><br>
	    		<button type="submit" class="button-reg-login-udaje">LOG IN</button>
	    		<p class="padding-top" align="center">
	    			<a href="<?php echo e(route('password.request')); ?>" class="color-white">Zabudli ste heslo?</a>
	    		</p>
    		</p>
    	</form>
    </div>

    <?php 
    	$miestnost="/img/miestnost.png";
    	$cas="/img/cas.png";
    	$skupina="/img/skupina.png";
	?>
    <?php echo $__env->make('layouts.includes.filter', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

</section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>