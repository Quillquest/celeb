<?php $__env->startSection('title', 'Forgot your password'); ?>
<?php $__env->startSection('content'); ?>
    <div class="row align-items-center justify-content-center vh-100">
        <div class="col-11 col-sm-8 col-md-6 col-lg-5 col-xl-4 col-xxl-3 py-6">
            <?php if(Session::has('message')): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?php echo e(Session::get('message')); ?>

                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <?php if(session('status')): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?php echo e(session('status')); ?>

                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>
            <!-- Title -->
            <h1 class="mb-2 text-center">
                Forgot password?
            </h1>

            <!-- Subtitle -->
            <p class="text-secondary text-center">
                Enter your email address and we'll send you an email with instructions to reset your password
            </p>

            <!-- Form -->
            <form method="POST" action="<?php echo e(route('password.email')); ?>">
                <?php echo csrf_field(); ?>
                <div class="row">
                    <div class="col-12">
                        <div class="mb-4">

                            <!-- Label -->
                            <label class="form-label">
                                Email Address
                            </label>

                            <!-- Input -->
                            <input type="email" class="form-control" name="email"
                                placeholder="Enter your email address">
                        </div>
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
                </div> <!-- / .row -->

                <div class="row align-items-center text-center">
                    <div class="col-12">
                        <!-- Button -->
                        <button type="submit" class="btn w-100 btn-primary mt-3 mb-2">Reset password</button>
                    </div>
                    <div class="col-12">
                        <!-- Link -->
                        <small class="mb-0 text-muted">Back to <a href="<?php echo e(route('login')); ?>" class="fw-semibold">Sign
                                in</a></small>
                    </div>
                </div> <!-- / .row -->
            </form>
        </div>
    </div> <!-- / .row -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.guest1', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/user/Desktop/Websites/Broker/Celebrity/Celebrity/resources/views/auth/forgot-password.blade.php ENDPATH**/ ?>