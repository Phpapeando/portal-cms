<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'url', 'description'];

    public function profiles()
    {
        return $this->belongsToMany(Profile::class, 'profile_site');
    }

    public function fields()
    {
        return $this->hasMany(SiteField::class);
    }

    public function contents()
    {
        return $this->hasMany(SiteContent::class);
    }
}
