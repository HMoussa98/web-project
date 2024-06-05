<?php

namespace app\mappers;

use app\models\Role;
use app\repositories\RoleRepository;

class RoleDataMapper
{
    private $roleRepository;

    public function __construct(RoleRepository $roleRepository)
    {
        $this->roleRepository = $roleRepository;
    }

    public function findById($id)
    {
        return $this->roleRepository->findById($id);
    }

    public function findAll()
    {
        return $this->roleRepository->findAll();
    }

    public function create(Role $role)
    {
        $this->roleRepository->create($role);
    }

    public function update(Role $role)
    {
        $this->roleRepository->update($role);
    }

    public function delete(Role $role)
    {
        $this->roleRepository->delete($role);
    }

    // Other mapping methods...
}
