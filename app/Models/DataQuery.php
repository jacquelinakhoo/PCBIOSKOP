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

    
    public function getSchedules()
    {
        return DB::table('schedules')
                 ->join('movies', 'schedules.MovieID', '=', 'movies.MovieID')
                 ->join('studios', 'schedules.StudioID', '=', 'studios.StudioID')
                 ->select('schedules.*', 'movies.Title', 'studios.StudioName')
                 ->get();
    }

    public function insertGetID($tableName, $data)
    {
        return DB::table($tableName)->insertGetId($data);
    }

    public function getAllWhere($tableName, $conditions)
    {
        return DB::table($tableName)->where($conditions)->get();
    }

    public function getSchedulesByMovie($movieId)
    {
        return DB::table('schedules')
                 ->join('studios', 'schedules.StudioID', '=', 'studios.StudioID')
                 ->where('schedules.MovieID', $movieId)
                 ->select('schedules.*', 'studios.StudioName')
                 ->get();
    }

    public function getMovieDate($movieId)
    {
        return DB::table('schedules')
                 ->where('MovieID', $movieId)
                 ->select('ShowDate')
                 ->distinct()
                 ->orderBy('ShowDate', 'asc')
                 ->get();
    }

    public function getSchedulesByDate($movieId, $date)
    {
        return DB::table('schedules')
                 ->join('studios', 'schedules.StudioID', '=', 'studios.StudioID')
                 ->where('schedules.MovieID', $movieId)
                 ->where('schedules.ShowDate', $date)
                 ->select('schedules.*', 'studios.StudioName')
                 ->get();
    }

        public function getUserOrders($userId)
    {
        return DB::table('orders')
                 ->join('schedules', 'orders.ScheduleID', '=', 'schedules.ScheduleID')
                 ->join('movies', 'schedules.MovieID', '=', 'movies.MovieID')
                 ->where('orders.UserID', $userId)
                 ->select('orders.*', 'movies.Title', 'movies.Poster', 'schedules.ShowDate', 'schedules.ShowTime')
                 ->orderBy('orders.OrderID', 'desc') // Show newest orders first
                 ->get();
    }
}