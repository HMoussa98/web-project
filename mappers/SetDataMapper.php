<?php

namespace app\mappers;

use app\models\Set;
use app\repositories\SetRepository;

class SetDataMapper
{
    private $setRepository;

    public function __construct(SetRepository $setRepository)
    {
        $this->setRepository = $setRepository;
    }

    public function findById($id)
    {
        return $this->setRepository->findById($id);
    }

    public function findAll()
    {
        return $this->setRepository->findAll();
    }

    public function create(Set $set)
    {
        $this->setRepository->create($set);
    }

    public function update(Set $set)
    {
        $this->setRepository->update($set);
    }

    public function delete(Set $set)
    {
        $this->setRepository->delete($set);
    }
}
