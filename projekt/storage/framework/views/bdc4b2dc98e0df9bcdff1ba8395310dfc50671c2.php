<?php $__env->startSection('title','Vytvorenie člena'); ?>

<?php $__env->startSection('content'); ?>
<section>
	<div class="section">
    <a href="/profil" class="btn-back">naspäť</a>
		<h1 class="center h1-text2">
		 	<a class="h1-a active" hresf="/registracia">VYTVORENIE ČLENA</a>
	    </h1>
	    	<form class="formular">
          <p class="formular" align="center">
		    	<input type="text" placeholder="MENO" name="firstname" value="" required>
		    	<input type="text" placeholder="EMAIL" name="email" value=""><br>
		    	<input type="text" placeholder="PRIEZVISKO" name="lastname" value="" required>
		    	<input type="text" placeholder="PRIHLASOVACIE MENO" name="username" value="" required><br>
		    	<input type="text" placeholder="TELEFÓNNE ČÍSLO" name="telnum" value="">
	    		<input type="password" placeholder="HESLO" name="psw" value="" required><br>
          <input type="text" placeholder="VYBER SKUPINU" name="telnum" value=""><br>
	    		<button type="submit" class="button-reg-login-udaje">REGISTER</button>
          </p>
    		</form>
    </div>


</section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>