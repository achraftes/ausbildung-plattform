<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Advice;

class AdviceController extends Controller
{
    public function index(Request $request)
    {
        // Tip du top
        $topAdvice = Advice::where('is_top', true)->first();

        // Tous les tips sauf le top
        $query = Advice::where('is_top', false);

        // Filtre par catégorie
        if ($request->has('categorie') && $request->categorie !== 'alle') {
            $query->where('categorie', $request->categorie);
        }

        // Recherche par mot-clé
        if ($request->has('search') && $request->search !== '') {
            $query->where('titre', 'like', '%' . $request->search . '%');
        }

        $advices = $query->latest()->get();

        // Catégories pour les tabs
        $categories = [
            'alle'         => ['label' => 'Alle',            'icon' => '📋'],
            'lebenslauf'   => ['label' => 'Lebenslauf',      'icon' => '📄'],
            'anschreiben'  => ['label' => 'Anschreiben',     'icon' => '✉️'],
            'interview'    => ['label' => 'Interview',       'icon' => '🎤'],
            'gehalt'       => ['label' => 'Gehalt',          'icon' => '💰'],
            'deutschland'  => ['label' => 'Deutschland 🇩🇪', 'icon' => '🇩🇪'],
        ];

        // Chaînes YouTube pour apprendre l'allemand
$youtubeChannels = [
    [
        'name' => 'Video 1',
        'video_id' => '7UhHe6XAxSc',
        'url' => 'https://www.youtube.com/watch?v=7UhHe6XAxSc',
        'description' => 'Deutsch lernen Video 1',
        'badge' => '🎬 Video',
        'badge_color' => '#e94560',
        'niveau' => 'A1',
        'subscribers' => '—',
    ],
    [
        'name' => 'Video 2',
        'video_id' => 'I8D5iLDqM8k',
        'url' => 'https://www.youtube.com/watch?v=I8D5iLDqM8k',
        'description' => 'Deutsch lernen Video 2',
        'badge' => '🎬 Video',
        'badge_color' => '#0f6e56',
        'niveau' => 'A1',
        'subscribers' => '—',
    ],
    [
        'name' => 'Video 3',
        'video_id' => 'Oxii0wFbhSo',
        'url' => 'https://www.youtube.com/watch?v=Oxii0wFbhSo',
        'description' => 'Deutsch lernen Video 3',
        'badge' => '🎬 Video',
        'badge_color' => '#185FA5',
        'niveau' => 'A2',
        'subscribers' => '—',
    ],
    [
        'name' => 'Video 4',
        'video_id' => 'q8oRThQsgqM',
        'url' => 'https://www.youtube.com/watch?v=q8oRThQsgqM',
        'description' => 'Deutsch lernen Video 4',
        'badge' => '🎬 Video',
        'badge_color' => '#854F0B',
        'niveau' => 'A2',
        'subscribers' => '—',
    ],
    [
        'name' => 'Video 5',
        'video_id' => '9IzUOVBBI-g',
        'url' => 'https://www.youtube.com/watch?v=9IzUOVBBI-g',
        'description' => 'Deutsch lernen Video 5',
        'badge' => '🎬 Video',
        'badge_color' => '#533AB7',
        'niveau' => 'B1',
        'subscribers' => '—',
    ],
    [
        'name' => 'Video 6',
        'video_id' => 'zOLhIM_AO7Y',
        'url' => 'https://www.youtube.com/watch?v=zOLhIM_AO7Y',
        'description' => 'Deutsch lernen Video 6',
        'badge' => '🎬 Video',
        'badge_color' => '#e94560',
        'niveau' => 'B1',
        'subscribers' => '—',
    ],
];

        return view('pages.advices', compact(
            'advices',
            'topAdvice',
            'categories',
            'youtubeChannels'
        ));
    }
}