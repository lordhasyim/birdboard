<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $guarded = [];
    // protected $fillable = [
    //     'title',
    //     'description'
    // ];

    public function path()
    {
        return "/projects/{$this->id}";
    }
}
