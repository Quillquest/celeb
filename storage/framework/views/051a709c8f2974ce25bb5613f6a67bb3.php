<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['title' => __('Confirm Password'), 'content' => __('For your security, please confirm your password to continue.'), 'button' => __('Confirm')]));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter((['title' => __('Confirm Password'), 'content' => __('For your security, please confirm your password to continue.'), 'button' => __('Confirm')]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars); ?>

<?php
    $confirmableId = md5($attributes->wire('then'));
?>

<span
    <?php echo e($attributes->wire('then')); ?>

    x-data
    x-ref="span"
    x-on:click="$wire.startConfirmingPassword('<?php echo e($confirmableId); ?>')"
    x-on:password-confirmed.window="setTimeout(() => $event.detail.id === '<?php echo e($confirmableId); ?>' && $refs.span.dispatchEvent(new CustomEvent('then', { bubbles: false })), 250);"
>
    <?php echo e($slot); ?>

</span>

<?php if (! $__env->hasRenderedOnce('00daab9c-6123-451f-a552-8b56cffbe5d2')): $__env->markAsRenderedOnce('00daab9c-6123-451f-a552-8b56cffbe5d2'); ?>
<?php if (isset($component)) { $__componentOriginalb7c3d02ad0a9b1daf558a84e1ecad045 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalb7c3d02ad0a9b1daf558a84e1ecad045 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'vendor.jetstream.components.dialog-modal','data' => ['wire:model' => 'confirmingPassword']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('jet-dialog-modal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['wire:model' => 'confirmingPassword']); ?>
     <?php $__env->slot('title', null, []); ?> 
       <h4 class=""><?php echo e($title); ?></h4> 
     <?php $__env->endSlot(); ?>

     <?php $__env->slot('content', null, []); ?> 
        <p class=""> <?php echo e($content); ?></p>
       
        <div class="mt-4 border-none" x-data="{}" x-on:confirming-password.window="setTimeout(() => $refs.confirmable_password.focus(), 250)">
            <?php if (isset($component)) { $__componentOriginal9145aada0d147d1c029b2cfba77fb9a0 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9145aada0d147d1c029b2cfba77fb9a0 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'vendor.jetstream.components.input','data' => ['type' => 'password','class' => 'form-control ','placeholder' => ''.e(__('Password')).'','xRef' => 'confirmable_password','wire:model.defer' => 'confirmablePassword','wire:keydown.enter' => 'confirmPassword']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('jet-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'password','class' => 'form-control ','placeholder' => ''.e(__('Password')).'','x-ref' => 'confirmable_password','wire:model.defer' => 'confirmablePassword','wire:keydown.enter' => 'confirmPassword']); ?>
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'vendor.jetstream.components.input-error','data' => ['for' => 'confirmable_password','class' => 'mt-2']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('jet-input-error'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['for' => 'confirmable_password','class' => 'mt-2']); ?>
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'vendor.jetstream.components.secondary-button','data' => ['wire:click' => 'stopConfirmingPassword','wire:loading.attr' => 'disabled']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('jet-secondary-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['wire:click' => 'stopConfirmingPassword','wire:loading.attr' => 'disabled']); ?>
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

        <?php if (isset($component)) { $__componentOriginal9132372e292e016fc877b416eeae2e71 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9132372e292e016fc877b416eeae2e71 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'vendor.jetstream.components.button','data' => ['class' => 'ml-2','dusk' => 'confirm-password-button','wire:click' => 'confirmPassword','wire:loading.attr' => 'disabled']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('jet-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'ml-2','dusk' => 'confirm-password-button','wire:click' => 'confirmPassword','wire:loading.attr' => 'disabled']); ?>
            <?php echo e($button); ?>

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
<?php endif; ?>
<?php /**PATH /Users/user/Desktop/Websites/Broker/Celebrity/Celebrity/resources/views/vendor/jetstream/components/confirms-password.blade.php ENDPATH**/ ?>