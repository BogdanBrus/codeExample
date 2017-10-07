<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Worker extends Model
{
    protected $fillable = ['last_name', 'first_name', 'surname', 'year_of_birth','position', 'salary_for_year'];
    public $timestamps = false;

}
