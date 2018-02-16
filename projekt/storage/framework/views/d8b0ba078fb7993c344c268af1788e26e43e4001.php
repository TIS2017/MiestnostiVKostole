<?php $__env->startSection('title','U kapucínov'); ?>


<?php $__env->startSection('content'); ?>

<section>
    <div class="alert-messages text-center"></div>

    <!-- Mapa -->
    <div class="section-mapa">
        <?php echo $__env->make('layouts.includes.mapa', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    </div>

    <?php 
    	$miestnost="/img/miestnost.png";
    	$cas="/img/cas.png";
    	$skupina="/img/skupina.png";
	?>
	
    <?php echo $__env->make('layouts.includes.filter', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
</section> 

    <script type="text/javascript">
        function showAlert(message) {
            var htmlAlert = '<div class="alert alert-success">' + message + '</div>';
            $(".alert-messages").prepend(htmlAlert);
            $(".alert-messages .alert").first().hide().fadeIn(200).delay(2000).fadeOut(1000, function () { $(this).remove(); });
        }
    </script>
    <?php if(session('Status')): ?>
        <script type="text/javascript">
            showAlert("Registrácia prebehla úspešne.");
        </script>
    <?php endif; ?>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>