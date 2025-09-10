<?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount($name, $params)->html();
} elseif ($_instance->childHasBeenRendered('FBE0h6n')) {
    $componentId = $_instance->getRenderedChildComponentId('FBE0h6n');
    $componentTag = $_instance->getRenderedChildComponentTagName('FBE0h6n');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('FBE0h6n');
} else {
    $response = \Livewire\Livewire::mount($name, $params);
    $html = $response->html();
    $_instance->logRenderedChild('FBE0h6n', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
<?php /**PATH /Users/user/Desktop/Websites/Broker/Celebrity/Celebrity/vendor/livewire/livewire/src/Testing/../views/mount-component.blade.php ENDPATH**/ ?>