<?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount($name, $params)->html();
} elseif ($_instance->childHasBeenRendered('25Hm1vN')) {
    $componentId = $_instance->getRenderedChildComponentId('25Hm1vN');
    $componentTag = $_instance->getRenderedChildComponentTagName('25Hm1vN');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('25Hm1vN');
} else {
    $response = \Livewire\Livewire::mount($name, $params);
    $html = $response->html();
    $_instance->logRenderedChild('25Hm1vN', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
<?php /**PATH /Users/user/Desktop/Websites/Broker/Celebrity/Celebrity/vendor/livewire/livewire/src/Testing/../views/mount-component.blade.php ENDPATH**/ ?>