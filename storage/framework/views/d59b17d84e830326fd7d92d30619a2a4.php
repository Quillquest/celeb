<form method="POST" action="<?php echo e(route('profile.password.update')); ?>">
    <?php echo csrf_field(); ?>
    <?php if(session('status')): ?>
        <div class="alert alert-success" role="alert">
            <?php echo e(session('status')); ?>

        </div>
    <?php endif; ?>

    <form method="POST" action="<?php echo e(route('profile.password.update')); ?>">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>
        <div class="row">
            <div class="mb-3 col-md-6">
                <label for="current_password"><?php echo e(__('Old Password')); ?></label>
                <input id="current_password" type="password" name="current_password" class="form-control" required>
                <?php $__errorArgs = ['current_password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="text-danger small mt-1"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div class="mb-3 col-md-6">
                <label for="password"><?php echo e(__('New Password')); ?></label>
                <input id="password" type="password" name="password" class="form-control" required>
                <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="text-danger small mt-1"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div class="mb-3 col-md-6">
                <label for="password_confirmation"><?php echo e(__('Confirm New Password')); ?></label>
                <input id="password_confirmation" type="password" name="password_confirmation" class="form-control"
                    required>
                <?php $__errorArgs = ['password_confirmation'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="text-danger small mt-1"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
        </div>

        <button type="submit" class="btn btn-primary"><?php echo e(__('Update Password')); ?></button>
    </form>

    <div class="mt-4">
        <a href="<?php echo e(route('2fa')); ?>" class="text-decoration-none"><?php echo e(__('Advance Account Settings')); ?> <i
                class="fas fa-arrow-right"></i></a>
    </div>

    <div class="row">
        <div class="col-lg-6 offset-lg-3">
            <div class="alert alert-light mw-450px" role="alert">
                <h4 class="mb-3"><?php echo e(__('Password requirements:')); ?></h4>
                <ul class="p-3 mb-0">
                    <li><?php echo e(__('Minimum 8 characters long - the more, the better')); ?></li>
                    <li><?php echo e(__('At least one lowercase character')); ?></li>
                    <li><?php echo e(__('At least one uppercase character')); ?></li>
                    <li><?php echo e(__('At least one number, symbol.')); ?></li>
                </ul>
            </div>
        </div>
    </div> <!-- / .row -->
<?php /**PATH /Users/user/Desktop/Websites/Broker/Celebrity/Celebrity/resources/views/profile/update-password-form.blade.php ENDPATH**/ ?>