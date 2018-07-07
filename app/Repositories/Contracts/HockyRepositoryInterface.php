<?php
// app/Repositories/Contracts/ProductRepositoryInterface.php

namespace App\Repositories\Contracts;

interface HockyRepositoryInterface
{
    public function all();
    public function find($id);
    public function add(array $data);
    public function edit(array $data, $id);
    public function remove($id);
    public function tuanhoc($hocky_id);
}