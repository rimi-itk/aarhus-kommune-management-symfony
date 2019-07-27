<?php

/*
 * This file is part of itk-dev/aarhus-kommune-management-symfony.
 *
 * (c) 2019 ITK Development
 *
 * This source file is subject to the MIT license.
 */

namespace App\Management;

use App\Entity\User;
use FOS\UserBundle\Model\UserManagerInterface;
use ItkDev\AarhusKommuneManagementBundle\Management\AbstractUserManager;
use Symfony\Component\PropertyAccess\PropertyAccessorInterface;

class UserManager extends AbstractUserManager
{
    /**
     * Key => user property.
     *
     * @var array
     */
    private static $properties = [
        'email' => 'email',
    ];

    /** @var UserManagerInterface */
    private $userManager;

    /** @var PropertyAccessorInterface */
    private $propertyAccessor;

    public function __construct(UserManagerInterface $userManager, PropertyAccessorInterface $propertyAccessor)
    {
        $this->userManager = $userManager;
        $this->propertyAccessor = $propertyAccessor;
    }

    public function getUsers()
    {
        $users = $this->userManager->findUsers();

        return $users;
    }

    public function createUser(array $data)
    {
        // TODO: Implement createUser() method.
    }

    public function updateUser(array $data)
    {
        $uuid = $data['uuid'] ?? '';
        $user = $this->getUser($uuid);
        if (null === $user) {
            return [$uuid => 'No such user'];
        }

        foreach (self::$properties as $key => $property) {
            if (isset($data[$key]) && $this->propertyAccessor->isWritable($user, $property)) {
                $this->propertyAccessor->setValue($user, $property, $data[$key]);
            }
        }

        try {
            $this->userManager->updateUser($user);

            return [$uuid => 'User updated'];
        } catch (\Exception $exception) {
            return [$uuid => $exception->getMessage()];
        }
    }

    public function deleteUser(array $data)
    {
        // TODO: Implement deleteUser() method.
    }

    public function serializeUser($user)
    {
        $data = [
            'uuid' => $this->getUuid($user),
        ];

        foreach (self::$properties as $key => $property) {
            $data[$key] = $this->propertyAccessor->getValue($user, $property);
        }

        return $data;
    }

    private function getUuid(User $user)
    {
        return 'user:'.$user->getId();
    }

    private function getUser($uuid)
    {
        if (preg_match('/user:(?<id>.+)/', $uuid, $matches)) {
            return $this->userManager->findUserBy(['id' => $matches['id']]);
        }

        return null;
    }
}
