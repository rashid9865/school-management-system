<?php

namespace App\Interfaces;

interface UserInterface
{
    
    public function createUser(array $userDetails);
    public function findById($id);
    public function deleteUser($id);
}
