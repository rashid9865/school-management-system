<?php

namespace App\Services;
use App\Interfaces\CommonInterface;

class AdminService
{
    
    protected $adminRepository;
    public function __construct(CommonInterface $adminRepository)
    {       
         $this->adminRepository = $adminRepository;
    }   
    
    public function findById($id)
    {
        return $this->adminRepository->findById($id);   
    }
}
