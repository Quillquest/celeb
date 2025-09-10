
<?php if (isset($component)) { $__componentOriginal5f7481395b96b9f830e0adcf51b24ba2 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5f7481395b96b9f830e0adcf51b24ba2 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'vendor.jetstream.components.action-section','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('jet-action-section'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
     <?php $__env->slot('content', null, []); ?> 
        <h2 class=""><?php echo e(__('Delete Account')); ?></h2>
        <h5 class=""> <?php echo e(__('Permanently delete your account.')); ?></h5>
        <div class="max-w-xl text-sm ">
            <?php echo e(__('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.')); ?>

        </div>

        <div class="mt-5">
            <?php if (isset($component)) { $__componentOriginal1fd7ca94a901b47234bfb80dc1c8e547 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal1fd7ca94a901b47234bfb80dc1c8e547 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'vendor.jetstream.components.danger-button','data' => ['wire:click' => 'confirmUserDeletion','wire:loading.attr' => 'disabled']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('jet-danger-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['wire:click' => 'confirmUserDeletion','wire:loading.attr' => 'disabled']); ?>
                <?php echo e(__('Delete Account')); ?>

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
        </div>

        <!-- Delete User Confirmation Modal -->
        <?php if (isset($component)) { $__componentOriginalb7c3d02ad0a9b1daf558a84e1ecad045 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalb7c3d02ad0a9b1daf558a84e1ecad045 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'vendor.jetstream.components.dialog-modal','data' => ['wire:model' => 'confirmingUserDeletion']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('jet-dialog-modal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['wire:model' => 'confirmingUserDeletion']); ?>
             <?php $__env->slot('title', null, []); ?> 
                <h3 class=""><?php echo e(__('Delete Account')); ?></h3>
             <?php $__env->endSlot(); ?>

             <?php $__env->slot('content', null, []); ?> 
                <p class=""><?php echo e(__('Are you sure you want to delete your account? Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.')); ?></p>
            
                <div class="mt-4" x-data="{}" x-on:confirming-delete-user.window="setTimeout(() => $refs.password.focus(), 250)">
                    <?php if (isset($component)) { $__componentOriginal9145aada0d147d1c029b2cfba77fb9a0 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9145aada0d147d1c029b2cfba77fb9a0 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'vendor.jetstream.components.input','data' => ['type' => 'password','class' => 'form-control','placeholder' => ''.e(__('Password')).'','xRef' => 'password','wire:model.defer' => 'password','wire:keydown.enter' => 'deleteUser']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('jet-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'password','class' => 'form-control','placeholder' => ''.e(__('Password')).'','x-ref' => 'password','wire:model.defer' => 'password','wire:keydown.enter' => 'deleteUser']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9145aada0d147d1c029b2cfba77fb9a0)): ?>
<?php $attributes = $__attributesOriginal9145aada0d147d1c029b2cfba77fb9a0; ?>
<?php unset($__attributesOriginal9145aada0d147d1c029b2cfba77fb9a0); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9145aada0d147d1c029b2cfba77fb9a0)): ?>
<?php $component = $__componentOriginal9145aada0d147d1c029b2cfba77fb9a0; ?>
<?php unset($__componentOriginal9145aada0d147d1c029b2cfba77fb9a0); ?>
<?php endif; ?>

                    <?php if (isset($component)) { $__componentOriginal718c6df7fe2936e053a80e743205e7b3 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal718c6df7fe2936e053a80e743205e7b3 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'vendor.jetstream.components.input-error','data' => ['for' => 'password','class' => 'mt-2']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('jet-input-error'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['for' => 'password','class' => 'mt-2']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal718c6df7fe2936e053a80e743205e7b3)): ?>
<?php $attributes = $__attributesOriginal718c6df7fe2936e053a80e743205e7b3; ?>
<?php unset($__attributesOriginal718c6df7fe2936e053a80e743205e7b3); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal718c6df7fe2936e053a80e743205e7b3)): ?>
<?php $component = $__componentOriginal718c6df7fe2936e053a80e743205e7b3; ?>
<?php unset($__componentOriginal718c6df7fe2936e053a80e743205e7b3); ?>
<?php endif; ?>
                </div>
             <?php $__env->endSlot(); ?>

             <?php $__env->slot('footer', null, []); ?> 
                <?php if (isset($component)) { $__componentOriginal6909d696c10e2553c022c9e24b4bbb5d = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal6909d696c10e2553c022c9e24b4bbb5d = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'vendor.jetstream.components.secondary-button','data' => ['wire:click' => '$toggle(\'confirmingUserDeletion\')','wire:loading.attr' => 'disabled']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('jet-secondary-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['wire:click' => '$toggle(\'confirmingUserDeletion\')','wire:loading.attr' => 'disabled']); ?>
                    <?php echo e(__('Cancel')); ?>

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

                <?php if (isset($component)) { $__componentOriginal1fd7ca94a901b47234bfb80dc1c8e547 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal1fd7ca94a901b47234bfb80dc1c8e547 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'vendor.jetstream.components.danger-button','data' => ['class' => 'ml-2','wire:click' => 'deleteUser','wire:loading.attr' => 'disabled']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('jet-danger-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'ml-2','wire:click' => 'deleteUser','wire:loading.attr' => 'disabled']); ?>
                    <?php echo e(__('Delete Account')); ?>

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
             <?php $__env->endSlot(); ?>
         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalb7c3d02ad0a9b1daf558a84e1ecad045)): ?>
<?php $attributes = $__attributesOriginalb7c3d02ad0a9b1daf558a84e1ecad045; ?>
<?php unset($__attributesOriginalb7c3d02ad0a9b1daf558a84e1ecad045); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalb7c3d02ad0a9b1daf558a84e1ecad045)): ?>
<?php $component = $__componentOriginalb7c3d02ad0a9b1daf558a84e1ecad045; ?>
<?php unset($__componentOriginalb7c3d02ad0a9b1daf558a84e1ecad045); ?>
<?php endif; ?>
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
<?php endif; ?>
<?php /**PATH /Users/user/Desktop/Websites/Broker/Celebrity/Celebrity/resources/views/profile/delete-user-form.blade.php ENDPATH**/ ?>