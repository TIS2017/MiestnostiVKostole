<?php $__env->startSection('title','Registrácia'); ?>

<?php $__env->startSection('content'); ?>
<section>
	<div class="section">
		<?php echo $__env->make('layouts.includes.error', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		<h1 class="center h1-text2">
		 	<a class="h1-a active" href="/registracia">REGISTER</a>
	    	<a  class="h1-a" href="/prihlasenie">LOG IN</a>
	    </h1>
	    <form method="POST" action="<?php echo e(url('/registracia')); ?>">
	    <?php echo e(csrf_field()); ?>

	    	<p class="formular" align="center">
		    	<input type="text" placeholder="MENO" name="firstname" value="<?php echo e(old('firstname')); ?>" required>
		    	<input type="text" placeholder="EMAIL" name="email" value="<?php echo e(old('email')); ?>" required><br>
		    	<input type="text" placeholder="PRIEZVISKO" name="lastname" value="<?php echo e(old('lastname')); ?>" required>
		    	<input type="text" placeholder="PRIHLASOVACIE MENO" name="username" value="<?php echo e(old('username')); ?>" required><br>
		    	<input type="text" placeholder="TELEFÓNNE ČÍSLO" name="tel" value="<?php echo e(old('tel')); ?>" required>
	    		<input type="password" placeholder="HESLO" name="password" required><br>
	    		<button type="submit" class="button-reg-login-udaje">REGISTER</button>
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