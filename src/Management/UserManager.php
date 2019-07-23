<?php

/*
 * This file is part of itk-dev/aarhus-kommune-management-symfony-4.
 *
 * (c) 2019 ITK Development
 *
 * This source file is subject to the MIT license.
 */

namespace App\Management;

use ItkDev\AarhusKommuneManagementBundle\Management\AbstractUserManager;
use FOS\UserBundle\Doctrine\UserManager as FOSUserManager;

class UserManager extends AbstractUserManager
{
    /** @var FOSUserManager */
    private $userManager;

    public function __construct(FOSUserManager $userManager)
    {
        $this->userManager = $userManager;
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
        // TODO: Implement updateUser() method.
    }

    public function deleteUser(array $data)
    {
        // TODO: Implement deleteUser() method.
    }

    public function serializeUser($user)
    {
        return [
            'email' => $user->getEmail(),
        ];
    }
}
