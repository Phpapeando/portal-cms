<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Site;
use Illuminate\Http\Request;
use App\Http\Resources\SiteContentResource;

class SiteContentController extends Controller
{
    public function index(Site $site)
    {
        $site->load('fields.contents');
        return new SiteContentResource($site);
    }
}
