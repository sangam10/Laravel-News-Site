<?php

namespace App\Repositories;

use App\Interfaces\BaseInterface;
use Illuminate\Database\Eloquent\Model;

class BaseRepository implements BaseInterface
{
    protected Model $model;

    public function __construct($model)
    {
        $this->model = $model;
    }

    public function all()
    {
        return $this->model->all()->sortByDesc('created_at');
    }
    public function paginate($value = 10)
    {
        return $this->model->orderby('created_at', 'DESC')->paginate($value);
    }
    public function create($value)
    {
        return $this->model->create($value);
    }
    public function update($value, $id)
    {
        return $this->model->find($id)->update($value);
    }
    public function  findById($id)
    {
        return $this->model->find($id);
    }
    public function delete($id)
    {
        return $this->findById($id)->delete();
    }
}
