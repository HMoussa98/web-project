<?php

namespace app\mappers;

use app\models\SubscriptionType;
use app\repositories\SubscriptionTypeRepository;

class SubscriptionTypeDataMapper
{
    private $subscriptionTypeRepository;

    public function __construct(SubscriptionTypeRepository $subscriptionTypeRepository)
    {
        $this->subscriptionTypeRepository = $subscriptionTypeRepository;
    }

    public function findById($id)
    {
        return $this->subscriptionTypeRepository->findById($id);
    }

    public function create(SubscriptionType $subscriptionType)
    {
        $this->subscriptionTypeRepository->create($subscriptionType);
    }

    public function delete(SubscriptionType $subscriptionType)
    {
        $this->subscriptionTypeRepository->delete($subscriptionType);
    }

    public function addSubscriptionToUser($userId, $subscriptionTypeId)
    {
        $this->subscriptionTypeRepository->addSubscriptionToUser($userId, $subscriptionTypeId);
    }

    public function removeSubscriptionFromUser($userId, $subscriptionTypeId)
    {
        $this->subscriptionTypeRepository->removeSubscriptionFromUser($userId, $subscriptionTypeId);
    }

    // Add other mapping methods if needed
}
