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
                'name'        => 'Learn German with Anja',
                'description' => 'Videos clairs pour apprendre l’allemand facilement.',
                'url'         => 'https://www.youtube.com/@LearnGermanwithAnja',
                'thumbnail'   => 'https://yt3.googleusercontent.com/ytc/AIdro_n0LTLhSMNZ4x3rDT9RlWJxhBMgGNovP_dVGlMM=s176-c-k-c0x00ffffff-no-rj',
                'subscribers' => '2.8 Mio.',
                'niveau'      => 'A1 – B2',
                'badge'       => '⭐ Popular',
                'badge_color' => '#533AB7',
            ],
            [
                'name'        => 'Deutsch mit Mira',
                'description' => 'Apprentissage de l’allemand simple et progressif.',
                'url'         => 'https://www.youtube.com/@DeutschmitMira',
                'thumbnail'   => 'https://yt3.googleusercontent.com/ytc/default_avatar.png',
                'subscribers' => '—',
                'niveau'      => 'A1 – B1',
                'badge'       => '📘 Beginner',
                'badge_color' => '#0f6e56',
            ],
            [
                'name'        => 'Mohammad Shehata - Official',
                'description' => 'Explications en arabe pour apprendre l’allemand.',
                'url'         => 'https://www.youtube.com/@MohammadShehata-Official',
                'thumbnail'   => 'https://yt3.googleusercontent.com/ytc/default_avatar.png',
                'subscribers' => '—',
                'niveau'      => 'A1 – B2',
                'badge'       => '🌍 Arabic Support',
                'badge_color' => '#e94560',
            ],
            [
                'name'        => 'Deutsch mit Arabien',
                'description' => 'Apprentissage de l’allemand pour arabophones.',
                'url'         => 'https://www.youtube.com/@deutschmitarabien',
                'thumbnail'   => 'https://yt3.googleusercontent.com/ytc/default_avatar.png',
                'subscribers' => '—',
                'niveau'      => 'A1 – B1',
                'badge'       => '🌍 Arabic',
                'badge_color' => '#854F0B',
            ],
            [
                'name'        => 'Easy German',
                'description' => 'Street interviews and real German conversations.',
                'url'         => 'https://www.youtube.com/@EasyGerman',
                'thumbnail'   => 'https://yt3.googleusercontent.com/ytc/AIdro_nX1ZMuHoifRjgfm_cL3FhiKPlXGhXXbWGpQLLJ6iiNjA=s176-c-k-c0x00ffffff-no-rj',
                'subscribers' => '4.1 Mio.',
                'niveau'      => 'B1 – C1',
                'badge'       => '🎙️ Authentic',
                'badge_color' => '#185FA5',
            ],
            [
                'name'        => 'Talks German',
                'description' => 'Conversation practice and German learning tips.',
                'url'         => 'https://www.youtube.com/@TalksGerman',
                'thumbnail'   => 'https://yt3.googleusercontent.com/ytc/default_avatar.png',
                'subscribers' => '—',
                'niveau'      => 'A2 – B2',
                'badge'       => '🗣️ Practice',
                'badge_color' => '#0f6e56',
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