<?php

namespace App\Models;

class admin extends User
{
    public static function booted()
    {
        static::addGlobalScope('admin',function ($builder){

        });
    }
}
