<?php if(count($errors) > 0): ?>
    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $errors): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="alert alert-danger container-fluid" style="max-width: 300px; max-height: 50px; margin: 0 auto;">
            <?php echo e($errors); ?>

        </div>
        <?php break; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?>

<?php if(session('success')): ?>
    <div class="alert alert-success container-fluid" style="max-width: 300px; max-height: 50px; margin: 0 auto;">
        <?php echo e(session('success')); ?>

    </div>
<?php endif; ?>

<?php if(session('error')): ?>
    <div class="alert alert-danger container-fluid" style="max-width: 300px; max-height: 50px; margin: 0 auto;">
        <?php echo e(session('error')); ?>

    </div>
<?php endif; ?>

