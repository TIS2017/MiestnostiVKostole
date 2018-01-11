<header>
	<div class="container">
  		<div class="row" >
	    	<div class="col-sm-4"></div>
      		<div class="col-sm-4 center" style="margin:0; padding:0; ">
      			<a href="/">
        			<img src="/img/logo.png" alt="logo" style="margin-left: auto; margin-right: auto; padding-top: 10px; padding-bottom: 10px; ">
        		</a>
        	</div>
      		<div class="col-sm-4 header-text no-wrap" style=" margin:0; padding:0;">

          <!-- Authentication Links -->
          <?php if(auth()->guard()->guest()): ?>
        		<a href="/registracia">REGISTER /</a>
  				  <a href="/prihlasenie">LOG IN</a>

          <?php else: ?>
            <a href="/profil">MÔJ PROFIL /</a>
            <a href="<?php echo e(route('logout')); ?>" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">ODHLÁSIŤ
            </a>
            <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
            <?php echo e(csrf_field()); ?>

            </form>
         <!-- <button type="submit" class="button-logout"> ODHLÁSIŤ</button>-->
          <?php endif; ?>
      		</div> 
  		</div>
	</div>
</header>




