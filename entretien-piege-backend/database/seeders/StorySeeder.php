<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Story;
use App\Models\Chapter;
use App\Models\Choice;

class StorySeeder extends Seeder
{
    public function run()
    {
        $story = Story::create([
            'title' => "Entretien d'embauche piégé",
            'description' => "Tu passes un entretien vidéo, mais les questions deviennent étranges..."
        ]);
        
        // Chapitres
        $chap1 = Chapter::create([
            'story_id' => $story->id,
            'title' => "Invitation à l'entretien",
            'content' => "Tu es invité à un entretien en visio pour un super job.",
            'is_ending' => false
        ]);
        
        $chap2 = Chapter::create([
            'story_id' => $story->id,
            'title' => "Début de l'entretien",
            'content' => "L'entretien commence. Comment te sens-tu ?",
            'is_ending' => false
        ]);
        
        $chap3 = Chapter::create([
            'story_id' => $story->id,
            'title' => "Question morale 1",
            'content' => "Seriez-vous prêt à mentir pour votre équipe ?",
            'is_ending' => false
        ]);
        
        $chap4 = Chapter::create([
            'story_id' => $story->id,
            'title' => "Question morale 2",
            'content' => "Un collègue triche. Vous... ?",
            'is_ending' => false
        ]);
        
        // Fins
        $finAccept = Chapter::create([
            'story_id' => $story->id,
            'title' => "Résultat : Accepté",
            'content' => "Félicitations, tu as été accepté !",
            'is_ending' => true,
            'ending_type' => 'accepted'
        ]);
        
        $finReject = Chapter::create([
            'story_id' => $story->id,
            'title' => "Résultat : Refusé",
            'content' => "Désolé, ta candidature a été refusée.",
            'is_ending' => true,
            'ending_type' => 'rejected'
        ]);
        
        $finBlack = Chapter::create([
            'story_id' => $story->id,
            'title' => "Résultat : Blacklisté",
            'content' => "Tu es blacklisté à vie de cette entreprise.",
            'is_ending' => true,
            'ending_type' => 'blacklisted'
        ]);
        
        // Choices Chapitre 1
        Choice::create([
            'chapter_id' => $chap1->id,
            'text' => "Se préparer sérieusement",
            'next_chapter_id' => $chap2->id
        ]);
        
        Choice::create([
            'chapter_id' => $chap1->id,
            'text' => "Y aller sans préparation",
            'next_chapter_id' => $chap2->id
        ]);
        
        // Choices Chapitre 2
        Choice::create([
            'chapter_id' => $chap2->id,
            'text' => "Rester confiant",
            'next_chapter_id' => $chap3->id
        ]);
        
        Choice::create([
            'chapter_id' => $chap2->id,
            'text' => "Stresser",
            'next_chapter_id' => $chap3->id
        ]);
        
        // Choices Chapitre 3
        Choice::create([
            'chapter_id' => $chap3->id,
            'text' => "Oui",
            'next_chapter_id' => $chap4->id
        ]);
        
        Choice::create([
            'chapter_id' => $chap3->id,
            'text' => "Non",
            'next_chapter_id' => $chap4->id
        ]);
        
        // Choices Chapitre 4
        Choice::create([
            'chapter_id' => $chap4->id,
            'text' => "Le dénoncer",
            'next_chapter_id' => $finAccept->id
        ]);
        
        Choice::create([
            'chapter_id' => $chap4->id,
            'text' => "L'ignorer",
            'next_chapter_id' => $finReject->id
        ]);
        
        Choice::create([
            'chapter_id' => $chap4->id,
            'text' => "L'aider",
            'next_chapter_id' => $finBlack->id
        ]);
    }
}