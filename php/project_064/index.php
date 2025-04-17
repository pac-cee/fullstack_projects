<?php
class EventDispatcher {
    private $listeners = [];
    public function on($event, $callback) {
        $this->listeners[$event][] = $callback;
    }
    public function dispatch($event, $data=null) {
        foreach ($this->listeners[$event] ?? [] as $cb) $cb($data);
    }
}
$ed = new EventDispatcher();
$ed->on('user.register', function($u){ echo "Welcome $u!<br>"; });
$ed->dispatch('user.register', 'Alice');
