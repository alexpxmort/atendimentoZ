<?php

namespace App\Interfaces;


interface DbRepositoryInterface{

    public function create($vals = null);
    public function update($vals = null,$obj = null);
    public function delete($obj = null);
    public function findAll($paginate = false,$order = 'ASC',$pageLimit = 10,$sort = null);
    public function findBy($attr,$column);

}