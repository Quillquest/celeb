<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps(['id' => null, 'maxWidth' => 100]) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps(['id' => null, 'maxWidth' => 100]); ?>
<?php foreach (array_filter((['id' => null, 'maxWidth' => 100]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>

<?php if (isset($component)) { $__componentOriginal8ee410a9365a005f0b16a7ba1d79ec3a = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal8ee410a9365a005f0b16a7ba1d79ec3a = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'jetstream::components.modal','data' => ['id' => $id,'maxWidth' => $maxWidth,'attributes' => $attributes]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('jet-modal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($id),'maxWidth' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($maxWidth),'attributes' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($attributes)]); ?>
    <div class="" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content ">
                <div class="modal-header">
                    <h5 class="modal-title"><?php echo e($title); ?></h5>
                </div>
                <div class="modal-body">
                    <?php echo e($content); ?>

                </div>
                <div class="modal-footer">
                    <?php echo e($footer); ?>

                </div>
            </div>
        </div>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal8ee410a9365a005f0b16a7ba1d79ec3a)): ?>
<?php $attributes = $__attributesOriginal8ee410a9365a005f0b16a7ba1d79ec3a; ?>
<?php unset($__attributesOriginal8ee410a9365a005f0b16a7ba1d79ec3a); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal8ee410a9365a005f0b16a7ba1d79ec3a)): ?>
<?php $component = $__componentOriginal8ee410a9365a005f0b16a7ba1d79ec3a; ?>
<?php unset($__componentOriginal8ee410a9365a005f0b16a7ba1d79ec3a); ?>
<?php endif; ?>
<?php /**PATH /Users/user/Desktop/Websites/Broker/Celebrity/Celebrity/resources/views/vendor/jetstream/components/dialog-modal.blade.php ENDPATH**/ ?>