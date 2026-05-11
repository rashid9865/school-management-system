<?php

namespace App\Repositeries;
use App\Interfaces\CommonInterface;
use App\Models\User;


class AdminRepositry implements  CommonInterface
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }
    public function getAll()
    {
        return User::all();
    }
    public function create(array $adminDetails)
    {
        return User::create($adminDetails);
    }
    public function show($id)
    {
        return User::findOrFail($id);
    }
    public function findById($id)
    {
       $user = User::findOrFail($id);
        return $user;
    }
    public function update($id, array $adminDetails)
    {
        $admin = User::findOrFail($id);
        $admin->update($adminDetails);
        return $admin;
    }
    public function delete($id)
    {        $admin = User::findOrFail($id);
        $admin->delete();
        return true;
    }   

    public function getAdminProfile($id)
    {
        return User::findOrFail($id);
    }
}
