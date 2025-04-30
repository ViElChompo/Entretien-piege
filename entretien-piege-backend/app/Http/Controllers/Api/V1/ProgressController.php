<?php
namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Progress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProgressController extends Controller
{
    public function store(Request $request)
    
    {

        // Debugging authentication
    if (!Auth::check()) {
        return response()->json(['message' => 'User not authenticated'], 401);
    }
        $request->validate([
            'story_id' => 'required|exists:stories,id',
            'current_chapter_id' => 'required|exists:chapters,id',
            'choices_made' => 'nullable|array'
        ]);
        
        $progress = Progress::updateOrCreate(
            ['user_id' => Auth::id(), 'story_id' => $request->story_id],
            [
                'current_chapter_id' => $request->current_chapter_id,
                'choices_made' => $request->choices_made ?? []
            ]
        );
        
        return response()->json([
            'message' => 'Progression sauvegardée', 
            'progress' => $progress
        ]);
    }
    
    public function show($storyId)
    {
        $progress = Progress::where('user_id', Auth::id())
            ->where('story_id', $storyId)
            ->first();
            
        if (!$progress) {
            return response()->json(['message' => 'Aucune progression trouvée'], 404);
        }
        
        return response()->json($progress);
    }
}