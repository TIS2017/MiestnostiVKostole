<?php $__env->startSection('title','Vytvorenie skupiny'); ?>

<?php $__env->startSection('content'); ?>
<section>
	<div class="section">
    <a href="/profil" class="btn-back">naspäť</a>
		<h1 class="center h1-text2">
		 	<a class="h1-a active" hresf="/registracia">VYTVORENIE SKUPINY</a>
	    </h1>
	    	<form class="formular">
          <p class="formular" align="center">
		    	<input type="text" placeholder="NÁZOV SKUPINY" name="firstname" value="" required><br>
		    	<select name="meno" id="meno">
		            <option value="vyber">--VYBER VEDÚCEHO--</option>
		            <option value="1">meno1</option>
		        </select><br>
		    	<input type="text" placeholder="EMAIL VEDÚCEHO" name="lastname" value="" required><br>
		    	<input type="text" placeholder="TEL.Č. VEDÚCEHO" name="telnum" value="" required><br>
	    		<button type="submit" class="button-reg-login-udaje">REGISTER</button>
          </p>
    		</form>
    </div>


</section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>