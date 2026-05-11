<?php

namespace App\Interfaces;

interface AdminInterface
{
    public function createAdmin(array $adminDetails);
    public function findById($id);
    public function getAdminProfile($id);
}
