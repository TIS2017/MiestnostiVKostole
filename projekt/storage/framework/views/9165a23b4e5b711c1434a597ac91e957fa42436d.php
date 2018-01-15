<?php $__env->startSection('title','Správa skupín'); ?>

<?php $__env->startSection('content'); ?>

<article>
    <div class="section">
        <a href="/profil" class="btn-back">naspäť</a>
        <h1 class="h1-name">NÁZOV SKUPINY</h1>
    </div>
</article>
<section>
  <div class="container-fluid section-filtracia">
      <form class="formular">
        <h1 class="h1-text">PRIRADIŤ MIESTNOSŤ</h1>
        <p class="formular" align="center">  
		    	<input type="text" placeholder="MENO" name="firstname" value="" required>
		    	<input type="text" placeholder="EMAIL" name="email" value="" required>
	    		<button type="submit" class="button-reg-login-udaje">PRIDAJ</i></button>
        </p>
    	</form>
      <form class="formular">
        <h1 class="h1-text">PRIDAŤ ČLENA</h1>
        <p class="formular" align="center">  
		    	<input type="text" placeholder="MENO" name="firstname" value="" required>
		    	<input type="text" placeholder="EMAIL" name="email" value="" required>
	    		<button type="submit" class="button-reg-login-udaje">PRIDAJ</i></button>
        </p>
    	</form>
    <h1 class="h1-text">ČLENOVIA</h1>
  	<table class="filtab" align="center">
  	 	<tr>
  		 <th class="width-200">MENO PRIEZVISKO</th>
       <th class="width-200">meno@nieco.com</th>
       <th class="width-200">0900 000 000</th>
  	  </tr>		
      <tr>
  		 <th class="width-200">MENO PRIEZVISKO</th>
       <th class="width-200">meno@nieco.com</th>
       <th class="width-200">0900 000 000</th>
  	  </tr> 	
 	 	</table>  
  </div>
  <div class="content">
    <div class="content-second">
    </div>
  </div>
	<div class="padding">		
		  <h1 class="h1-text">ŽIADOSTI</h1>
			<table class="filtab">
			 		<tr>
					   	<th class="width-200">MENO PRIEZVISKO</th>
	   					<th class="width-200">žiadosť o pridanie</th>
              <th class="filter"><button type="submit" class="btn-fix btn-back">schváliť</button></th>
              <th class="filter"><button type="submit" class="btn-fix btn-back">zamietnuť</button></th>
			  	</tr>
          <tr>
					   	<th class="width-200">MIESTNOSŤ</th>
	   					<th class="width-200">11:00</th>
              <th class="filter"><button type="submit" class="btn-fix btn-back">schváliť</button></th>
              <th class="filter"><button type="submit" class="btn-fix btn-back">zamietnuť</button></th>
			  	</tr>
		 	</table>
	 	</div>
</section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>