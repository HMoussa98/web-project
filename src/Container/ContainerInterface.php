<?php

namespace app\Container;

/**
 * Interface ContainerInterface
 * @package app\Container
 */
interface ContainerInterface
{
    /**
     * Retrieve an entry from the container by its identifier.
     *
     * @param string $id Identifier of the entry to look for.
     *
     * @throws NotFoundExceptionInterface  No entry was found for **this** identifier.
     * @throws ContainerExceptionInterface Error while retrieving the entry.
     *
     * @return mixed Entry.
     */
    public function get($id);

    /**
     * Check if the container can return an entry for the given identifier.
     * Returns true if an entry for the given identifier exists in the container.
     * Returns false otherwise.
     *
     * @param string $id Identifier of the entry to look for.
     *
     * @return bool
     */
    public function has($id);
}

?>
