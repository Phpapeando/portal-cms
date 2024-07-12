<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteContent extends Model
{
    use HasFactory;

    protected $fillable = [
        'site_id',
        'field_id',
        'content',
    ];

    public function site()
    {
        return $this->belongsTo(Site::class);
    }

    public function field()
    {
        return $this->belongsTo(SiteField::class, 'field_id');
    }

    
}
