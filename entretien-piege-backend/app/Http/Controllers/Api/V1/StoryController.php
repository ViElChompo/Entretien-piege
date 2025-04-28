<?php
namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Story;
use Illuminate\Http\Request;

class StoryController extends Controller
{
    public function index()
    {
        return response()->json(Story::all());
    }
    
    public function show(Story $story)
    {
        $story->load('chapters.choices');
        return response()->json($story);
    }
}