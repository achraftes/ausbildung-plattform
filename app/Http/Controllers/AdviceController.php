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
            'alle'         => ['label' => 'Alle',              'icon' => '📋'],
            'lebenslauf'   => ['label' => 'Lebenslauf',        'icon' => '📄'],
            'anschreiben'  => ['label' => 'Anschreiben',       'icon' => '✉️'],
            'interview'    => ['label' => 'Interview',         'icon' => '🎤'],
            'gehalt'       => ['label' => 'Gehalt',            'icon' => '💰'],
            'deutschland'  => ['label' => 'Deutschland 🇩🇪',   'icon' => '🇩🇪'],
        ];

        // Chaînes YouTube pour apprendre l'allemand
        $youtubeChannels = [
            [
                'name'        => 'DW Deutsch lernen',
                'description' => 'Offizieller Kanal der Deutschen Welle. Videos für alle Niveaus A1 bis C1.',
                'url'         => 'https://www.youtube.com/@DWDeutschlernen',
                'thumbnail'   => 'https://yt3.googleusercontent.com/ytc/AIdro_mF9mE6Z9IHq0P1rKIgZhvQGwEJfzVTy1n5_2VgwkHsBA=s176-c-k-c0x00ffffff-no-rj',
                'subscribers' => '3,2 Mio.',
                'niveau'      => 'A1 – C1',
                'badge'       => '🏆 Top Empfehlung',
                'badge_color' => '#e94560',
            ],
            [
                'name'        => 'Deutsch mit Yeşim',
                'description' => 'Perfekt für Anfänger! Einfache Erklärungen auf Arabisch und Türkisch.',
                'url'         => 'https://www.youtube.com/@DeutschmitYesim',
                'thumbnail'   => 'https://yt3.googleusercontent.com/sMpJbfnIQ0mPNVGbGMFIBJGlMjvQLr3gExUlhMhDTwUTFbPi0zv4LUDpqxJSRdz6MNiK8Y4=s176-c-k-c0x00ffffff-no-rj',
                'subscribers' => '850 Tsd.',
                'niveau'      => 'A1 – B1',
                'badge'       => '🌍 Mehrsprachig',
                'badge_color' => '#0f6e56',
            ],
            [
                'name'        => 'Easy German',
                'description' => 'Straßeninterviews mit echten Deutschen. Perfekt um Umgangssprache zu lernen.',
                'url'         => 'https://www.youtube.com/@EasyGerman',
                'thumbnail'   => 'https://yt3.googleusercontent.com/ytc/AIdro_nX1ZMuHoifRjgfm_cL3FhiKPlXGhXXbWGpQLLJ6iiNjA=s176-c-k-c0x00ffffff-no-rj',
                'subscribers' => '4,1 Mio.',
                'niveau'      => 'B1 – C1',
                'badge'       => '🎙️ Authentisch',
                'badge_color' => '#185FA5',
            ],
            [
                'name'        => 'Deutsch für Euch',
                'description' => 'Grammatik einfach erklärt. Ideal für alle die Deutsch lernen wollen.',
                'url'         => 'https://www.youtube.com/@DeutschfuerEuch',
                'thumbnail'   => 'https://yt3.googleusercontent.com/ytc/AIdro_nzLCrgOWiblmD4VpwH7NzNHFT2pAHGW8VBvCB_nQ=s176-c-k-c0x00ffffff-no-rj',
                'subscribers' => '1,2 Mio.',
                'niveau'      => 'A2 – B2',
                'badge'       => '📚 Grammatik',
                'badge_color' => '#854F0B',
            ],
            [
                'name'        => 'Learn German with Anja',
                'description' => 'Kurze, klare Videos zu Vokabeln, Grammatik und deutschen Alltagssituationen.',
                'url'         => 'https://www.youtube.com/@LearnGermanwithAnja',
                'thumbnail'   => 'https://yt3.googleusercontent.com/ytc/AIdro_n0LTLhSMNZ4x3rDT9RlWJxhBMgGNovP_dVGlMM=s176-c-k-c0x00ffffff-no-rj',
                'subscribers' => '2,8 Mio.',
                'niveau'      => 'A1 – B2',
                'badge'       => '⭐ Sehr beliebt',
                'badge_color' => '#533AB7',
            ],
            [
                'name'        => 'Nicos Weg – ARD',
                'description' => 'Kostenlose ARD-Serie zum Deutschlernen. Geschichte + Übungen für A1 bis B1.',
                'url'         => 'https://www.youtube.com/@nicosweg',
                'thumbnail'   => 'https://yt3.googleusercontent.com/ytc/AIdro_kXnBrO1cpC5mcG7l2UtHHwk5y2yyVOFiuNcx-X=s176-c-k-c0x00ffffff-no-rj',
                'subscribers' => '320 Tsd.',
                'niveau'      => 'A1 – B1',
                'badge'       => '📺 ARD Serie',
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