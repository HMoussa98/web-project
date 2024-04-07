<?php

namespace app\Container;



class SimpleContainer implements ContainerInterface
{
    private $entries = [];

    public function get($id)
    {
        return $this->entries[$id];
    }

    public function has($id)
    {
        return isset($this->entries[$id]);
    }

    public function set($id, $value)
    {
        $this->entries[$id] = $value;
    }
}

?>
