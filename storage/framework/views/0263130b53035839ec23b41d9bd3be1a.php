<?php $__env->startSection('title', __('Server Error')); ?>
<?php $__env->startSection('code', '500'); ?>
<?php $__env->startSection('message', __('An unexpected error seems to have occured. Why not try refreshing your page? Or you can contact us if the problem persist ')); ?>

<?php echo $__env->make('errors::minimal', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/user/Desktop/Websites/Broker/Celebrity/Celebrity/resources/views/errors/500.blade.php ENDPATH**/ ?>