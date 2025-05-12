<?php

namespace App\Http\Controllers\Api\V1;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function adminOnly()
    {
        return response()->json([
            'message' => 'Bienvenue, administrateur ! Vous avez accès à cette ressource protégée.',
        ]);
    }
}