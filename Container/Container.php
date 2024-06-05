<?php
namespace app\Container;

use app\Container\ContainerInterface;

class Container implements ContainerInterface {
    private $bindings = [];
    private $instances = [];

    public function set($id, callable $resolver) {
        $this->bindings[$id] = $resolver;
    }

    public function get($id) {
        if (!isset($this->bindings[$id])) {
            throw new \Exception("No binding found for key: $id");
        }

        if (!isset($this->instances[$id])) {
            $this->instances[$id] = $this->bindings[$id]($this);
        }

        return $this->instances[$id];
    }

    public function has($id) {
        return isset($this->bindings[$id]);
    }
}
