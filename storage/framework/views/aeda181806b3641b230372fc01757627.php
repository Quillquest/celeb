<?php $__env->startSection('title', 'Confirm your password'); ?>

<?php $__env->startSection('styles'); ?>
    <?php echo \Illuminate\View\Factory::parentPlaceholder('styles'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <section class=" auth">
        <div class="container">
            <div class="pb-3 row justify-content-center">

                <div class="col-12 col-md-6 col-lg-6 col-sm-10 col-xl-6">


                    <div class="bg-white shadow card login-page roundedd border-1 ">
                        <div class="card-body">
                            <p class="text-sm text-center text-primary"> This is a secure area. Please confirm your password
                                before continuing.</h4>
                            <form method="POST" action="<?php echo e(route('password.confirm')); ?>" class="mt-4 login-form">
                                <?php echo csrf_field(); ?>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Enter Password <span class="text-danger">*</span></label>
                                            <div class="position-relative">
                                                <i data-feather="key" class="fea icon-sm icons"></i>
                                                <input type="password" class="pl-5 form-control" name="password" required
                                                    autocomplete="current-password" autofocus>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <?php if($errors->any()): ?>
                                            <ul>
                                                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <li class="text-danger"><?php echo e($error); ?></li>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </ul>
                                        <?php endif; ?>
                                    </div>
                                    <!--end col-->

                                    <div class="mb-0 col-lg-12">
                                        <button class="btn btn-primary btn-block pad" type="submit">Confirm</button>
                                    </div>

                                </div>
                                <!--end row-->
                            </form>
                        </div>
                    </div>
                    <!---->
                </div>
                <!--end col-->
            </div>
            <!--end row-->
        </div>
        <!--end container-->
    </section>
    <!--end section-->



<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <?php echo \Illuminate\View\Factory::parentPlaceholder('scripts'); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.guest1', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/user/Desktop/Websites/Broker/Celebrity/Celebrity/resources/views/auth/confirm-password.blade.php ENDPATH**/ ?>