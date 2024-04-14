<?php

namespace app\models;

class Set
{
    private $id;
    private $name;
    private $releaseDate;

    public function __construct($id = null, $name = null, $releaseDate = null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->releaseDate = $releaseDate;
    }
    /**
     * @return mixed|null
     */


    public function getName(): mixed
    {
        return $this->name;
    }

    /**
     * @param mixed|null $id
     */
    public function setId(mixed $id): void
    {
        $this->id = $id;
    }

    /**
     * @param mixed|null $name
     */
    public function setName(mixed $name): void
    {
        $this->name = $name;
    }

    /**
     * @return mixed|null
     */
    public function getReleaseDate(): mixed
    {
        return $this->releaseDate;
    }

    /**
     * @return mixed|null
     */
    public function getId(): mixed
    {
        return $this->id;
    }

    /**
     * @param mixed|null $releaseDate
     */
    public function setReleaseDate(mixed $releaseDate): void
    {
        $this->releaseDate = $releaseDate;
    }



}