<?php

use eftec\bladeone\BladeOne;

$views = __DIR__ . '/../../resources/views';
$cache = __DIR__ . '/../Cache';

$blade = new BladeOne($views, $cache, BladeOne::MODE_AUTO);

// Custom directives for auth and guest
$blade->directive('auth', function ($expression) {
    return "<?php if(auth($expression)): ?>";
});

$blade->directive('endauth', function () {
    return "<?php endif; ?>";
});

$blade->directive('guest', function ($expression) {
    return "<?php if(guest($expression)): ?>";
});

$blade->directive('endguest', function () {
    return "<?php endif; ?>";
});

return $blade;
