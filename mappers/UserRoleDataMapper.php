<?php

namespace app\mappers;

use app\models\UserRole;
use app\repositories\UserRoleRepository;

class UserRoleDataMapper
{
    private $userRoleRepository;

    public function __construct(UserRoleRepository $userRoleRepository)
    {
        $this->userRoleRepository = $userRoleRepository;
    }

    public function addRoleToUser($userId, $roleId)
    {
        $this->userRoleRepository->addRoleToUser($userId, $roleId);
    }

    public function removeRoleFromUser($userId, $roleId)
    {
        $this->userRoleRepository->removeRoleFromUser($userId, $roleId);
    }

    // Other mapping methods as needed
}
