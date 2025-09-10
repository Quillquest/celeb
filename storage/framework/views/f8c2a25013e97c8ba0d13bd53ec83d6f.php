<?php $__env->startSection('title', 'Reset your password'); ?>
<?php $__env->startSection('content'); ?>
    <div class="row align-items-center justify-content-center vh-100">
        <div class="col-11 col-sm-8 col-md-6 col-lg-5 col-xl-4 col-xxl-3 py-6 shadow-sm">
            <?php if(Session::has('status')): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?php echo e(session('status')); ?>

                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>
            <?php if(Session::has('message')): ?>
                <div class="alert alert-info alert-dismissible fade show" role="alert">
                    <?php echo e(Session::get('message')); ?>

                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>
            <div class="text-center">
                <a href="/">
                    <img src="<?php echo e(asset('storage/' . $settings->logo)); ?>" alt="Logo" class="w-50">
                </a>
            </div>
            <!-- Title -->
            <h1 class="mb-2 text-center">
                Reset Password
            </h1>

            <!-- Subtitle -->
            <p class="text-secondary text-center">
                Enter your email address and your new password to reset it.
            </p>

            <!-- Form -->
            <form method="POST" action="<?php echo e(route('password.update')); ?>">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="token" value="<?php echo e($request->route('token')); ?>">
                <div class="row">
                    <div class="col-12">
                        <div class="mb-4">
                            <!-- Label -->
                            <label class="form-label">
                                Email Address
                            </label>
                            <!-- Input -->
                            <input type="email" name="email" value="<?php echo e(old('email')); ?>" class="form-control"
                                placeholder="Your email address">
                            <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <small class="fs-6 text-danger"><?php echo e($message); ?></small>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="mb-4">
                            <!-- Label -->
                            <label class="form-label">
                                Password
                            </label>

                            <!-- Input -->
                            <div class="input-group input-group-merge">
                                <input type="password" class="form-control" autocomplete="off" data-toggle-password-input
                                    placeholder="Your password" name="password" required>

                                <button type="button" class="input-group-text px-4 text-secondary link-primary"
                                    data-toggle-password></button>
                            </div>
                        </div>
                        <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <small class="fs-6 text-danger"><?php echo e($message); ?></small>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div class="col-lg-12">
                        <div class="mb-4">
                            <!-- Label -->
                            <label class="form-label">
                                Confirm password
                            </label>
                            <!-- Input -->
                            <div class="input-group input-group-merge">
                                <input type="password" class="form-control" autocomplete="off" data-toggle-password-input
                                    placeholder="Your password again" name="password_confirmation" required>

                                <button type="button" class="input-group-text px-4 text-secondary link-primary"
                                    data-toggle-password></button>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="row align-items-center text-center">
                    <div class="col-12">
                        <!-- Button -->
                        <button type="submit" class="btn w-100 btn-primary mt-6 mb-2">Reset password</button>
                    </div>
                </div> <!-- / .row -->
            </form>
        </div>
    </div> <!-- / .row -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.guest1', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/user/Desktop/Websites/Broker/Celebrity/Celebrity/resources/views/auth/reset-password.blade.php ENDPATH**/ ?>