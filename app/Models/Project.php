<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'type_id', 'description', 'github_url', 'image_preview'];

    public function getAbstract($n_chars = 30)
    {
        return (strlen($this->description) > $n_chars) ? substr($this->description, 0, $n_chars) . '...' : $this->description;
    }
    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function technologies()
    {
        return $this->belongsToMany(Technology::class);

    }
}
