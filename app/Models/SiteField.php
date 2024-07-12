<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteField extends Model
{
    use HasFactory;

    protected $fillable = [
        'site_id',
        'field_name',
        'field_type',
    ];

    public function site()
    {
        return $this->belongsTo(Site::class);
    }

    public function contents()
    {
        return $this->hasMany(SiteContent::class, 'field_id');
    }
}
