<?php


namespace services;


class Db
{
    protected $db;

    public function __construct()
    {
        $this->db = @mysqli_connect('localhost:3306','geek','geek','gb_php') or Die('Ошибка соединения: ' . mysqli_connect_error());
    }

    public function getArray(string $query)
    {
        $queryObject = mysqli_query($this->db, $query);
        $queryArray = [];
        while ($row = mysqli_fetch_assoc($queryObject)) {
            $queryArray[] = $row;
        }
        return $queryArray;
    }

}