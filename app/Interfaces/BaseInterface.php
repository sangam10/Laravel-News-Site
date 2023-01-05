<?php

namespace App\Interfaces;

interface BaseInterface
{
    public function all();
    public function create($value);
    public function paginate($value);
    public function update($value, $id);
    public function delete($id);
    public function findById($id);
}
