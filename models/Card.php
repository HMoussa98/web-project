<?php

namespace app\models;

class Card
{
    private $id;
    private $name;
    private $setId;
    private $rarity;
    private $marketPrice;
    private $imagePath;

    /**
     * @return mixed
     */

    public function __construct($id, $name, $setId, $rarity, $marketPrice, $imagePath)
    {
        $this->id = $id;
        $this->name = $name;
        $this->setId = $setId;
        $this->rarity = $rarity;
        $this->marketPrice = $marketPrice;
        $this->imagePath = $imagePath;
    }
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getSetId()
    {
        return $this->setId;
    }

    /**
     * @param mixed $setId
     */
    public function setSetId($setId): void
    {
        $this->setId = $setId;
    }

    /**
     * @return mixed
     */
    public function getRarity()
    {
        return $this->rarity;
    }

    /**
     * @param mixed $rarity
     */
    public function setRarity($rarity): void
    {
        $this->rarity = $rarity;
    }

    /**
     * @return mixed
     */
    public function getMarketPrice()
    {
        return $this->marketPrice;
    }

    /**
     * @param mixed $marketPrice
     */
    public function setMarketPrice($marketPrice): void
    {
        $this->marketPrice = $marketPrice;
    }

    /**
     * @return mixed
     */
    public function getImagePath()
    {
        return $this->imagePath;
    }

    /**
     * @param mixed $imagePath
     */
    public function setImagePath($imagePath): void
    {
        $this->imagePath = $imagePath;
    }
}