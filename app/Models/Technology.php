<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Technology extends Model
{
    use HasFactory;

    protected $fillable = ['label', 'color'];


    public function projects()
    {
        return $this->belongsToMany(Project::class);

    }

    public function getBadge()
    {
        return "<span class='badge' style='background-color: {$this->color}'>{$this->label}</span>";

    }
}
