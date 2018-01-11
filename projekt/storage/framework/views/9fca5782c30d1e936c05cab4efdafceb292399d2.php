<?php $__env->startSection('title','Údaje o skupine'); ?>


<?php $__env->startSection('content'); ?>

<section>
    <div class="section padding-bottom">
        <a href="/miestnost" class="btn-back">naspäť</a>
        <h1 class="h1-name">NÁZOV SKUPINY</h1>
         <table class="color-white-profil">
            <tr>
                <th class="width-200">VEDÚCI SKUPINY:</th>
                <td class="width-200">MENO PRIEZVISKO</td>

                <?php /*
                ak je prihlaseny 
                <td rowspan="3" class="width-200"> 
                */
                ?>

                <td class="width-200">
                    <img src="/img/profil.jpg" alt="fotka" width="193" height="209">
                </td>
            </tr>

            
            <?php /*
            ak je prihlaseny pouzivatel

            <tr>
                <th class="width-200">EMAIL:</th>
                <td class="width-200">niekto@niečo.com</td>
            </tr>
            <tr>
                <th class="width-200">TELEFÓNNE Č.:</th>
                <td class="width-200">0900 000 000</td>
            </tr>
            */ 
            ?>
         </table>
    </div>

    
</section>   

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>