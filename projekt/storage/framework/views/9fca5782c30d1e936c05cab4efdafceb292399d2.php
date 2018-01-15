<?php $__env->startSection('title','Údaje o skupine'); ?>


<?php $__env->startSection('content'); ?>

<section>
    <div class="section padding-bottom">
        <a href="<?php echo e(redirect()->back()->getTargetUrl()); ?>" class="btn-back">naspäť</a>
        <h1 class="h1-name">NÁZOV SKUPINY</h1>
         <table class="color-white-profil">
            <tr>
                <th class="width-200">VEDÚCI SKUPINY:</th>
                <td class="width-200">MENO PRIEZVISKO</td>
                <?php if(Auth::check ()): ?>
                    <td rowspan="3" class="width-200">
                <?php else: ?>
                <td class="width-200" >
                <?php endif; ?>
                    <img src="/img/profil.jpg" alt="fotka" width="193" height="209">
                </td>
            </tr>
            <?php if(Auth::check ()): ?>
                <tr>
                    <th class="width-200">EMAIL:</th>
                    <td class="width-200">niekto@niečo.com</td>
                </tr>
                <tr>
                    <th class="width-200">TELEFÓNNE Č.:</th>
                    <td class="width-200">0900 000 000</td>
                </tr>
            <?php endif; ?>
         </table>
    </div>

    <?php if(Auth::check ()): ?>
    <div>
      <h1 class="h1-text">ČLENOVIA</h1>
        <table class="filtab">
             <tr>
             <th class="mena">MENO PRIEZVISKO</th>
             </tr>          
        </table>
        <p class="vstupdoskup" align="center">
           <button type="submit" class="button-reg-login-udaje btn-profil">VSTÚPIŤ DO SKUPINY</button>
        </p>
    </div> 
    <?php endif; ?>

</section>   

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>