<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class DataQuery extends Model
{
    public function getWhere($tableName, $conditions)
    {
        return DB::table($tableName)->where($conditions)->first();
    }

    public function getAll($tableName)
    {
        return DB::table($tableName)->get();
    }

    public function insert($tableName, $data)
    {
        return DB::table($tableName)->insert($data);
    }

    public function updateRecord($tableName, $conditions, $data)
    {
        return DB::table($tableName)->where($conditions)->update($data);
    }

    public function deleteRecord($tableName, $columnName, $id)
    {
        return DB::table($tableName)->where($columnName, $id)->delete();
    }
}