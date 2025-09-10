<?php
if (Auth::user()->dashboard_style == "light") {
		$bgmenu="blue";
    $bg="light";
    $text = "dark";
} else {
    $bgmenu="dark";
    $bg="dark";
    $text = "light";
}	
?>
<?php if (isset($component)) { $__componentOriginal5f7481395b96b9f830e0adcf51b24ba2 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5f7481395b96b9f830e0adcf51b24ba2 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'jetstream::components.action-section','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('jet-action-section'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
     <?php $__env->slot('content', null, []); ?> 
        <h2 class=""><?php echo e(__('Two Factor Authentication')); ?></h2>
        <h3 class="h6">
            <?php if($this->enabled): ?>
                <?php echo e(__('You have enabled two factor authentication.')); ?>

            <?php else: ?>
                <?php echo e(__('You have not enabled two factor authentication.')); ?>

            <?php endif; ?>
        </h3>

        <div class="mt-3 text-sm ">
           
            <h5> <?php echo e(__('Add additional security to your account using two factor authentication.')); ?></h5>
            <p>
                <?php echo e(__('When two factor authentication is enabled, you will be prompted for a secure, random token during authentication. You may retrieve this token from your phone\'s Google Authenticator application.')); ?>

            </p>
        </div>

        <?php if($this->enabled): ?>
            <?php if($showingQrCode): ?>
                <div class="max-w-xl mt-4 text-sm ">
                    <p class="">
                        <?php echo e(__('Two factor authentication is now enabled. Scan the following QR code using your phone\'s authenticator application.')); ?>

                    </p>
                </div>

                <div class="mt-4 dark:p-4 dark:w-56 dark:bg-white">
                    <?php echo $this->user->twoFactorQrCodeSvg(); ?>

                </div>
            <?php endif; ?>

            <?php if($showingRecoveryCodes): ?>
                <div class="max-w-xl mt-4 text-sm ">
                    <p class="font-semibold ">
                        <?php echo e(__('Store these recovery codes in a secure password manager. They can be used to recover access to your account if your two factor authentication device is lost.')); ?>

                    </p>
                </div>

                <div class="grid max-w-xl gap-1 px-4 py-4 mt-4 font-mono text-sm rounded-lg">
                    <?php $__currentLoopData = json_decode(decrypt($this->user->two_factor_recovery_codes), true); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $code): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div><?php echo e($code); ?></div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            <?php endif; ?>
        <?php endif; ?>

        <div class="mt-5">
            <?php if(! $this->enabled): ?>
                <?php if (isset($component)) { $__componentOriginal052ee74f8ec8839c047afdb2ffcd10a4 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal052ee74f8ec8839c047afdb2ffcd10a4 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'jetstream::components.confirms-password','data' => ['wire:then' => 'enableTwoFactorAuthentication']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('jet-confirms-password'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['wire:then' => 'enableTwoFactorAuthentication']); ?>
                    <?php if (isset($component)) { $__componentOriginal9132372e292e016fc877b416eeae2e71 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9132372e292e016fc877b416eeae2e71 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'jetstream::components.button','data' => ['type' => 'button','class' => 'btn btn-primary','wire:loading.attr' => 'disabled']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('jet-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'button','class' => 'btn btn-primary','wire:loading.attr' => 'disabled']); ?>
                        <?php echo e(__('Enable')); ?>

                     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9132372e292e016fc877b416eeae2e71)): ?>
<?php $attributes = $__attributesOriginal9132372e292e016fc877b416eeae2e71; ?>
<?php unset($__attributesOriginal9132372e292e016fc877b416eeae2e71); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9132372e292e016fc877b416eeae2e71)): ?>
<?php $component = $__componentOriginal9132372e292e016fc877b416eeae2e71; ?>
<?php unset($__componentOriginal9132372e292e016fc877b416eeae2e71); ?>
<?php endif; ?>
                 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal052ee74f8ec8839c047afdb2ffcd10a4)): ?>
<?php $attributes = $__attributesOriginal052ee74f8ec8839c047afdb2ffcd10a4; ?>
<?php unset($__attributesOriginal052ee74f8ec8839c047afdb2ffcd10a4); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal052ee74f8ec8839c047afdb2ffcd10a4)): ?>
<?php $component = $__componentOriginal052ee74f8ec8839c047afdb2ffcd10a4; ?>
<?php unset($__componentOriginal052ee74f8ec8839c047afdb2ffcd10a4); ?>
<?php endif; ?>
            <?php else: ?>
                <?php if($showingRecoveryCodes): ?>
                    <?php if (isset($component)) { $__componentOriginal052ee74f8ec8839c047afdb2ffcd10a4 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal052ee74f8ec8839c047afdb2ffcd10a4 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'jetstream::components.confirms-password','data' => ['wire:then' => 'regenerateRecoveryCodes']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('jet-confirms-password'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['wire:then' => 'regenerateRecoveryCodes']); ?>
                        <?php if (isset($component)) { $__componentOriginal6909d696c10e2553c022c9e24b4bbb5d = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal6909d696c10e2553c022c9e24b4bbb5d = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'jetstream::components.secondary-button','data' => ['class' => 'mr-3 btn btn-info']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('jet-secondary-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'mr-3 btn btn-info']); ?>
                            <?php echo e(__('Regenerate Recovery Codes')); ?>

                         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal6909d696c10e2553c022c9e24b4bbb5d)): ?>
<?php $attributes = $__attributesOriginal6909d696c10e2553c022c9e24b4bbb5d; ?>
<?php unset($__attributesOriginal6909d696c10e2553c022c9e24b4bbb5d); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal6909d696c10e2553c022c9e24b4bbb5d)): ?>
<?php $component = $__componentOriginal6909d696c10e2553c022c9e24b4bbb5d; ?>
<?php unset($__componentOriginal6909d696c10e2553c022c9e24b4bbb5d); ?>
<?php endif; ?>
                     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal052ee74f8ec8839c047afdb2ffcd10a4)): ?>
<?php $attributes = $__attributesOriginal052ee74f8ec8839c047afdb2ffcd10a4; ?>
<?php unset($__attributesOriginal052ee74f8ec8839c047afdb2ffcd10a4); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal052ee74f8ec8839c047afdb2ffcd10a4)): ?>
<?php $component = $__componentOriginal052ee74f8ec8839c047afdb2ffcd10a4; ?>
<?php unset($__componentOriginal052ee74f8ec8839c047afdb2ffcd10a4); ?>
<?php endif; ?>
                <?php else: ?>
                    <?php if (isset($component)) { $__componentOriginal052ee74f8ec8839c047afdb2ffcd10a4 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal052ee74f8ec8839c047afdb2ffcd10a4 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'jetstream::components.confirms-password','data' => ['wire:then' => 'showRecoveryCodes']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('jet-confirms-password'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['wire:then' => 'showRecoveryCodes']); ?>
                        <?php if (isset($component)) { $__componentOriginal6909d696c10e2553c022c9e24b4bbb5d = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal6909d696c10e2553c022c9e24b4bbb5d = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'jetstream::components.secondary-button','data' => ['class' => 'mr-3']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('jet-secondary-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'mr-3']); ?>
                            <?php echo e(__('Show Recovery Codes')); ?>

                         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal6909d696c10e2553c022c9e24b4bbb5d)): ?>
<?php $attributes = $__attributesOriginal6909d696c10e2553c022c9e24b4bbb5d; ?>
<?php unset($__attributesOriginal6909d696c10e2553c022c9e24b4bbb5d); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal6909d696c10e2553c022c9e24b4bbb5d)): ?>
<?php $component = $__componentOriginal6909d696c10e2553c022c9e24b4bbb5d; ?>
<?php unset($__componentOriginal6909d696c10e2553c022c9e24b4bbb5d); ?>
<?php endif; ?>
                     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal052ee74f8ec8839c047afdb2ffcd10a4)): ?>
<?php $attributes = $__attributesOriginal052ee74f8ec8839c047afdb2ffcd10a4; ?>
<?php unset($__attributesOriginal052ee74f8ec8839c047afdb2ffcd10a4); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal052ee74f8ec8839c047afdb2ffcd10a4)): ?>
<?php $component = $__componentOriginal052ee74f8ec8839c047afdb2ffcd10a4; ?>
<?php unset($__componentOriginal052ee74f8ec8839c047afdb2ffcd10a4); ?>
<?php endif; ?>
                <?php endif; ?>

                <?php if (isset($component)) { $__componentOriginal052ee74f8ec8839c047afdb2ffcd10a4 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal052ee74f8ec8839c047afdb2ffcd10a4 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'jetstream::components.confirms-password','data' => ['wire:then' => 'disableTwoFactorAuthentication']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('jet-confirms-password'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['wire:then' => 'disableTwoFactorAuthentication']); ?>
                    <?php if (isset($component)) { $__componentOriginal1fd7ca94a901b47234bfb80dc1c8e547 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal1fd7ca94a901b47234bfb80dc1c8e547 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'jetstream::components.danger-button','data' => ['wire:loading.attr' => 'disabled','class' => 'btn btn-danger']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('jet-danger-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['wire:loading.attr' => 'disabled','class' => 'btn btn-danger']); ?>
                        <?php echo e(__('Disable')); ?>

                     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal1fd7ca94a901b47234bfb80dc1c8e547)): ?>
<?php $attributes = $__attributesOriginal1fd7ca94a901b47234bfb80dc1c8e547; ?>
<?php unset($__attributesOriginal1fd7ca94a901b47234bfb80dc1c8e547); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal1fd7ca94a901b47234bfb80dc1c8e547)): ?>
<?php $component = $__componentOriginal1fd7ca94a901b47234bfb80dc1c8e547; ?>
<?php unset($__componentOriginal1fd7ca94a901b47234bfb80dc1c8e547); ?>
<?php endif; ?>
                 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal052ee74f8ec8839c047afdb2ffcd10a4)): ?>
<?php $attributes = $__attributesOriginal052ee74f8ec8839c047afdb2ffcd10a4; ?>
<?php unset($__attributesOriginal052ee74f8ec8839c047afdb2ffcd10a4); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal052ee74f8ec8839c047afdb2ffcd10a4)): ?>
<?php $component = $__componentOriginal052ee74f8ec8839c047afdb2ffcd10a4; ?>
<?php unset($__componentOriginal052ee74f8ec8839c047afdb2ffcd10a4); ?>
<?php endif; ?>
            <?php endif; ?>
        </div>
     <?php $__env->endSlot(); ?>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal5f7481395b96b9f830e0adcf51b24ba2)): ?>
<?php $attributes = $__attributesOriginal5f7481395b96b9f830e0adcf51b24ba2; ?>
<?php unset($__attributesOriginal5f7481395b96b9f830e0adcf51b24ba2); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal5f7481395b96b9f830e0adcf51b24ba2)): ?>
<?php $component = $__componentOriginal5f7481395b96b9f830e0adcf51b24ba2; ?>
<?php unset($__componentOriginal5f7481395b96b9f830e0adcf51b24ba2); ?>
<?php endif; ?><?php /**PATH /Users/user/Desktop/Websites/Broker/Celebrity/Celebrity/resources/views/profile/two-factor-authentication-form.blade.php ENDPATH**/ ?>