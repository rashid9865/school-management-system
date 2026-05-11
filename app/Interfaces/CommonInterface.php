<?php

namespace App\Interfaces;

interface CommonInterface
{
    public function getAll();

    public function create(array $details);
    
    public function show($id);

    public function update($id, array $details);

    public function delete($id);  

    public function findById($id);
}
