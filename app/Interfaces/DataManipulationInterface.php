<?php

namespace App\Interfaces;

interface DataManipulationInterface
{
    public static function list_data($request);

    public static function insert($request);

    public static function update($request);

    public static function delete($rowId);
}
