<?php
class Container {
    private $bindings = [];
    public function set($name, $resolver) { $this->bindings[$name] = $resolver; }
    public function get($name) { return $this->bindings[$name](); }
}
$container = new Container();
$container->set('time', function(){ return date('H:i:s'); });
echo $container->get('time');
