<?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount($name, $params)->html();
} elseif ($_instance->childHasBeenRendered('qhMkpNz')) {
    $componentId = $_instance->getRenderedChildComponentId('qhMkpNz');
    $componentTag = $_instance->getRenderedChildComponentTagName('qhMkpNz');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('qhMkpNz');
} else {
    $response = \Livewire\Livewire::mount($name, $params);
    $html = $response->html();
    $_instance->logRenderedChild('qhMkpNz', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
<?php /**PATH /Users/user/Desktop/Websites/Broker/Celebrity/Celebrity/vendor/livewire/livewire/src/Testing/../views/mount-component.blade.php ENDPATH**/ ?>