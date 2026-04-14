<?php
// app/Http/Controllers/CVController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\CV;
use Barryvdh\DomPDF\Facade\Pdf;

class CVController extends Controller
{
    /* ════════════════════════════════
       PAGE PRINCIPALE — choisir modèle
    ════════════════════════════════ */
    public function index()
    {
        $userCVs = CV::where('user_id', Auth::id())->latest()->get();

        $modeles = [
            'modern'    => [
                'name'  => 'Modern — Professional',
                'desc'  => 'Zweispaltig, dunkel — ideal für IT & Technik',
                'badge' => '⭐ Beliebt',
                'color' => '#e94560',
                'img'   => 'modern',
            ],
            'klassisch' => [
                'name'  => 'Klassisch — Tabellarisch',
                'desc'  => 'Deutsches Standardformat — für alle Branchen',
                'badge' => '🇩🇪 Standard',
                'color' => '#0f6e56',
                'img'   => 'klassisch',
            ],
            'kreativ'   => [
                'name'  => 'Kreativ — Modern',
                'desc'  => 'Mit Akzentfarbe — für Design & Marketing',
                'badge' => '✨ Kreativ',
                'color' => '#533AB7',
                'img'   => 'kreativ',
            ],
        ];

        return view('pages.cv', compact('userCVs', 'modeles'));
    }

    /* ════════════════════════════════
       FORMULAIRE CREATION
    ════════════════════════════════ */
    public function create(Request $request)
    {
        $modele = $request->get('modele', 'modern');
        $allowedModeles = ['modern', 'klassisch', 'kreativ'];
        if (!in_array($modele, $allowedModeles)) $modele = 'modern';
        return view('pages.cv_create', compact('modele'));
    }

    /* ════════════════════════════════
       SAUVEGARDER
    ════════════════════════════════ */
    public function store(Request $request)
    {
        $request->validate([
            'vorname'    => 'required|string|max:100',
            'nachname'   => 'required|string|max:100',
            'email'      => 'required|email',
            'modele'     => 'required|in:modern,klassisch,kreativ',
        ], [
            'vorname.required'  => 'Vorname ist erforderlich.',
            'nachname.required' => 'Nachname ist erforderlich.',
            'email.required'    => 'E-Mail ist erforderlich.',
        ]);

        // Traitement expériences
        $berufserfahrung = [];
        if ($request->has('job_titel')) {
            foreach ($request->job_titel as $i => $titel) {
                if ($titel) {
                    $berufserfahrung[] = [
                        'titel'       => $titel,
                        'unternehmen' => $request->job_unternehmen[$i] ?? '',
                        'zeitraum'    => $request->job_zeitraum[$i] ?? '',
                        'beschreibung'=> $request->job_beschreibung[$i] ?? '',
                    ];
                }
            }
        }

        // Traitement formations
        $ausbildung = [];
        if ($request->has('aus_titel')) {
            foreach ($request->aus_titel as $i => $titel) {
                if ($titel) {
                    $ausbildung[] = [
                        'titel'   => $titel,
                        'schule'  => $request->aus_schule[$i] ?? '',
                        'zeitraum'=> $request->aus_zeitraum[$i] ?? '',
                        'note'    => $request->aus_note[$i] ?? '',
                    ];
                }
            }
        }

        // Compétences
        $kenntnisse = array_filter(array_map('trim', explode(',', $request->kenntnisse ?? '')));
        $sprachen   = [];
        if ($request->has('spr_name')) {
            foreach ($request->spr_name as $i => $name) {
                if ($name) {
                    $sprachen[] = [
                        'name'   => $name,
                        'niveau' => $request->spr_niveau[$i] ?? 'A1',
                    ];
                }
            }
        }

        $cv = CV::create([
            'user_id'         => Auth::id(),
            'modele'          => $request->modele,
            'vorname'         => $request->vorname,
            'nachname'        => $request->nachname,
            'email'           => $request->email,
            'telefon'         => $request->telefon,
            'adresse'         => $request->adresse,
            'stadt'           => $request->stadt,
            'beruf_titel'     => $request->beruf_titel,
            'profil_text'     => $request->profil_text,
            'berufserfahrung' => $berufserfahrung,
            'ausbildung'      => $ausbildung,
            'kenntnisse'      => array_values($kenntnisse),
            'sprachen'        => $sprachen,
            'hobbys'          => $request->hobbys,
        ]);

        // Calcul ATS score
        $cv->ats_score = $cv->calculateAtsScore();
        $cv->save();

        return redirect()->route('cv.show', $cv->id)
                         ->with('success', 'Dein Lebenslauf wurde erfolgreich erstellt! 🎉');
    }

    /* ════════════════════════════════
       APERCU
    ════════════════════════════════ */
    public function show($id)
    {
        $cv = CV::where('user_id', Auth::id())->findOrFail($id);
        return view('pages.cv_show', compact('cv'));
    }

    /* ════════════════════════════════
       EDITER
    ════════════════════════════════ */
    public function edit($id)
    {
        $cv = CV::where('user_id', Auth::id())->findOrFail($id);
        return view('pages.cv_create', compact('cv'));
    }

    /* ════════════════════════════════
       METTRE A JOUR
    ════════════════════════════════ */
    public function update(Request $request, $id)
    {
        $cv = CV::where('user_id', Auth::id())->findOrFail($id);

        $berufserfahrung = [];
        if ($request->has('job_titel')) {
            foreach ($request->job_titel as $i => $titel) {
                if ($titel) {
                    $berufserfahrung[] = [
                        'titel'        => $titel,
                        'unternehmen'  => $request->job_unternehmen[$i] ?? '',
                        'zeitraum'     => $request->job_zeitraum[$i] ?? '',
                        'beschreibung' => $request->job_beschreibung[$i] ?? '',
                    ];
                }
            }
        }

        $ausbildung = [];
        if ($request->has('aus_titel')) {
            foreach ($request->aus_titel as $i => $titel) {
                if ($titel) {
                    $ausbildung[] = [
                        'titel'    => $titel,
                        'schule'   => $request->aus_schule[$i] ?? '',
                        'zeitraum' => $request->aus_zeitraum[$i] ?? '',
                        'note'     => $request->aus_note[$i] ?? '',
                    ];
                }
            }
        }

        $kenntnisse = array_filter(array_map('trim', explode(',', $request->kenntnisse ?? '')));
        $sprachen   = [];
        if ($request->has('spr_name')) {
            foreach ($request->spr_name as $i => $name) {
                if ($name) {
                    $sprachen[] = ['name' => $name, 'niveau' => $request->spr_niveau[$i] ?? 'A1'];
                }
            }
        }

        $cv->update([
            'vorname'         => $request->vorname,
            'nachname'        => $request->nachname,
            'email'           => $request->email,
            'telefon'         => $request->telefon,
            'adresse'         => $request->adresse,
            'stadt'           => $request->stadt,
            'beruf_titel'     => $request->beruf_titel,
            'profil_text'     => $request->profil_text,
            'berufserfahrung' => $berufserfahrung,
            'ausbildung'      => $ausbildung,
            'kenntnisse'      => array_values($kenntnisse),
            'sprachen'        => $sprachen,
            'hobbys'          => $request->hobbys,
        ]);

        $cv->ats_score = $cv->calculateAtsScore();
        $cv->save();

        return redirect()->route('cv.show', $cv->id)
                         ->with('success', 'Lebenslauf wurde aktualisiert! ✅');
    }

    /* ════════════════════════════════
       SUPPRIMER
    ════════════════════════════════ */
    public function destroy($id)
    {
        $cv = CV::where('user_id', Auth::id())->findOrFail($id);
        $cv->delete();
        return redirect()->route('cv.index')
                         ->with('success', 'Lebenslauf wurde gelöscht.');
    }

    /* ════════════════════════════════
       DOWNLOAD PDF
    ════════════════════════════════ */
    public function downloadPDF($id)
    {
        $cv = CV::where('user_id', Auth::id())->findOrFail($id);
        $pdf = Pdf::loadView('pdf.cv_' . $cv->modele, compact('cv'))
                  ->setPaper('a4', 'portrait');
        $filename = 'Lebenslauf_' . $cv->vorname . '_' . $cv->nachname . '.pdf';
        return $pdf->download($filename);
    }

    /* ════════════════════════════════
       ATS CHECK (AJAX)
    ════════════════════════════════ */
    public function atsCheck(Request $request)
    {
        $cv = CV::where('user_id', Auth::id())->findOrFail($request->cv_id);
        $score = $cv->calculateAtsScore();

        $details = [
            'format'   => $cv->modele ? 90 : 0,
            'keywords' => !empty($cv->kenntnisse) ? min(count($cv->kenntnisse) * 10, 80) : 0,
            'struktur' => ($cv->beruf_titel && $cv->profil_text) ? 95 : 50,
            'sprache'  => !empty($cv->sprachen) ? 85 : 40,
        ];

        return response()->json([
            'score'   => $score,
            'details' => $details,
        ]);
    }
}