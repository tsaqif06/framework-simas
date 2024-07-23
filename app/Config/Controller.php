<?php

namespace FrameworkSimas\Config;

use eftec\bladeone\BladeOne;

class Controller
{
    protected $blade;
    public function __construct()
    {
        $this->initialize();
    }

    protected function initialize()
    {
        $views = __DIR__ . '/../../resources/views';
        $cache = __DIR__ . '/../Cache';

        $this->blade = new BladeOne($views, $cache, BladeOne::MODE_AUTO);
        // Custom directives for auth and guest
        $this->blade->directive('auth', function ($expression) {
            return "<?php if(auth($expression)): ?>";
        });

        $this->blade->directive('endauth', function () {
            return "<?php endif; ?>";
        });

        $this->blade->directive('guest', function ($expression) {
            return "<?php if(guest($expression)): ?>";
        });

        $this->blade->directive('endguest', function () {
            return "<?php endif; ?>";
        });

        $this->blade->directive('csrf', function () {
            return csrf();
        });
    }

    public function view(string $view, $data = [])
    {
        echo $this->blade->run($view, $data);
    }
}
