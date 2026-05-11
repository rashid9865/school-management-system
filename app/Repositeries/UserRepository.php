<?php

namespace App\Repositeries;
use App\Interfaces\CommonInterface;
use App\Models\User;
class UserRepository implements CommonInterface
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }
    public function create(array $userDetails)
    {
        return User::create($userDetails);
    }
    public function findById($id)
    {
        return User::findOrFail($id);
    }

    public function delete($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return true;
    }
    public function getAll()
    {
        return User::all();
    }
    public function update($id, array $userDetails)
    {
        $user = User::findOrFail($id);
        $user->update($userDetails);
        return $user;
    }
    public function show($id)
    {
        return User::findOrFail($id);
    }

    // public function getByRole($role)
    // {
    //     return User::where('role', $role)->get();
    // }

    public function getRoleCounts()
    {
        return User::selectRaw('role, COUNT(*) as count')
            ->groupBy('role')
            ->pluck('count', 'role');
    }

    public function getAllWithRelations()
    {
        return User::all();
    }
    
} 
