<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Advice;

class AdviceSeeder extends Seeder
{
    public function run(): void
    {
        $advices = [
            // ── LEBENSLAUF
            [
                'titre'        => 'Der perfekte tabellarische Lebenslauf',
                'categorie'    => 'lebenslauf',
                'contenu'      => 'In Deutschland ist der tabellarische Lebenslauf Standard. Er beginnt mit deinen persönlichen Daten, gefolgt von Berufserfahrung (neuestes zuerst), Ausbildung, Kenntnissen und Hobbys. Maximal 2 Seiten, klares Layout, kein Schnörkel.',
                'image'        => 'https://images.unsplash.com/photo-1586281380349-632531db7ed4?w=600&q=80',
                'temps_lecture'=> '4 Min',
                'is_top'       => true,
            ],
            [
                'titre'        => 'Foto im Lebenslauf — ja oder nein?',
                'categorie'    => 'lebenslauf',
                'contenu'      => 'In Deutschland ist ein professionelles Bewerbungsfoto üblich, aber nicht mehr Pflicht. Wenn du ein Foto verwendest: professioneller Hintergrund, gepflegte Kleidung, freundliches Lächeln. Kein Selfie, kein Urlaubsfoto!',
                'image'        => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=600&q=80',
                'temps_lecture'=> '3 Min',
                'is_top'       => false,
            ],
            [
                'titre'        => 'Lücken im Lebenslauf richtig erklären',
                'categorie'    => 'lebenslauf',
                'contenu'      => 'Lücken im Lebenslauf sind kein Problem, wenn du sie ehrlich erklärst. Sprachkurs, Reise, Pflege von Angehörigen — alles kann positiv formuliert werden. Wichtig: nie lügen, immer was Positives daraus machen.',
                'image'        => 'https://images.unsplash.com/photo-1455849318743-b2233052fcff?w=600&q=80',
                'temps_lecture'=> '3 Min',
                'is_top'       => false,
            ],

            // ── ANSCHREIBEN
            [
                'titre'        => 'Aufbau eines deutschen Anschreibens',
                'categorie'    => 'anschreiben',
                'contenu'      => 'Das Anschreiben besteht aus: Absender, Datum, Empfänger, Betreff, Anrede, Einleitung (Warum bewerbe ich mich?), Hauptteil (Was kann ich?), Schluss (Einladung zum Gespräch), Grußformel + Unterschrift.',
                'image'        => 'https://images.unsplash.com/photo-1450101499163-c8848c66ca85?w=600&q=80',
                'temps_lecture'=> '5 Min',
                'is_top'       => false,
            ],
            [
                'titre'        => 'Häufige Fehler im Anschreiben vermeiden',
                'categorie'    => 'anschreiben',
                'contenu'      => 'Die größten Fehler: Copy-Paste ohne Anpassung, zu lange Texte, falsche Anrede, Rechtschreibfehler, keine konkreten Beispiele. Lies dein Anschreiben immer laut vor und lass es von jemandem gegenlesen.',
                'image'        => 'https://images.unsplash.com/photo-1543269664-56d93c1b41a6?w=600&q=80',
                'temps_lecture'=> '4 Min',
                'is_top'       => false,
            ],

            // ── INTERVIEW
            [
                'titre'        => 'Die 5 häufigsten Interviewfragen auf Deutsch',
                'categorie'    => 'interview',
                'contenu'      => '"Erzählen Sie etwas über sich." / "Warum bewerben Sie sich bei uns?" / "Was sind Ihre Stärken und Schwächen?" / "Wo sehen Sie sich in 5 Jahren?" / "Warum verlassen Sie Ihren aktuellen Job?" — Bereite Antworten auf alle vor!',
                'image'        => 'https://images.unsplash.com/photo-1565688534245-05d6b5be184a?w=600&q=80',
                'temps_lecture'=> '6 Min',
                'is_top'       => false,
            ],
            [
                'titre'        => 'Kleidung für das Vorstellungsgespräch',
                'categorie'    => 'interview',
                'contenu'      => 'Business-Casual ist in Deutschland der Standard. Männer: Hemd + Hose oder Anzug. Frauen: Bluse + Rock/Hose oder Kleid. Keine zu bunte Kleidung, saubere Schuhe, gepflegtes Äußeres. Lieber zu formell als zu locker.',
                'image'        => 'https://images.unsplash.com/photo-1490367532201-b9bc1dc483f6?w=600&q=80',
                'temps_lecture'=> '3 Min',
                'is_top'       => false,
            ],
            [
                'titre'        => 'Körpersprache im Vorstellungsgespräch',
                'categorie'    => 'interview',
                'contenu'      => 'Augenkontakt halten, aufrecht sitzen, fester Händedruck, nicht mit Händen spielen. Lächeln zeigt Selbstbewusstsein. Vermeide verschränkte Arme — das wirkt defensiv. Nicken zeigt, dass du zuhörst.',
                'image'        => 'https://images.unsplash.com/photo-1573497019940-1c28c88b4f3e?w=600&q=80',
                'temps_lecture'=> '4 Min',
                'is_top'       => false,
            ],

            // ── GEHALT
            [
                'titre'        => 'Gehalt verhandeln — so geht\'s richtig',
                'categorie'    => 'gehalt',
                'contenu'      => 'Recherchiere vorher den Marktgehalt für deine Position. Nenne immer eine Spanne, nicht einen fixen Betrag. Warte bis der Arbeitgeber das Thema anspricht. Argument: deine Erfahrung, deine Qualifikation, dein Mehrwert für das Unternehmen.',
                'image'        => 'https://images.unsplash.com/photo-1554224155-6726b3ff858f?w=600&q=80',
                'temps_lecture'=> '5 Min',
                'is_top'       => false,
            ],
            [
                'titre'        => 'Mindestlohn & Ausbildungsvergütung in Deutschland',
                'categorie'    => 'gehalt',
                'contenu'      => 'Der gesetzliche Mindestlohn in Deutschland beträgt 12,41 € pro Stunde (2024). Azubis erhalten eine Mindestvergütung von mind. 649 €/Monat im 1. Lehrjahr. Je nach Branche und Betrieb kann es deutlich mehr sein.',
                'image'        => 'https://images.unsplash.com/photo-1579621970795-87facc2f976d?w=600&q=80',
                'temps_lecture'=> '4 Min',
                'is_top'       => false,
            ],

            // ── DEUTSCHLAND
            [
                'titre'        => 'Als Ausländer in Deutschland bewerben',
                'categorie'    => 'deutschland',
                'contenu'      => 'Für eine Bewerbung in Deutschland brauchst du: Lebenslauf auf Deutsch, Anschreiben auf Deutsch, anerkannte Zeugnisse (ggf. beglaubigte Übersetzung), Sprachnachweis (mind. B1). Informiere dich über die Anerkennung deines ausländischen Abschlusses bei anabin.kultusministerkonferenz.de.',
                'image'        => 'https://images.unsplash.com/photo-1467269204594-9661b134dd2b?w=600&q=80',
                'temps_lecture'=> '6 Min',
                'is_top'       => false,
            ],
            [
                'titre'        => 'Deutschkenntnisse für die Ausbildung — welches Niveau?',
                'categorie'    => 'deutschland',
                'contenu'      => 'Die meisten Ausbildungsbetriebe verlangen mindestens B1 (Goethe-Institut oder telc). Für Pflegeberufe ist B2 Pflicht. Für IT-Berufe reicht oft B1. Lerne täglich mit Apps wie DW Deutsch, Duolingo oder schau deutsche YouTube-Kanäle.',
                'image'        => 'https://images.unsplash.com/photo-1546410531-bb4caa6b424d?w=600&q=80',
                'temps_lecture'=> '5 Min',
                'is_top'       => false,
            ],
            [
                'titre'        => 'Anerkennung ausländischer Abschlüsse in Deutschland',
                'categorie'    => 'deutschland',
                'contenu'      => 'Du kannst deinen ausländischen Schul- oder Berufsabschluss in Deutschland anerkennen lassen. Zuständig sind IHK, HWK oder das Kultusministerium. Die Webseite "Anerkennung in Deutschland" (anerkennungsberatung.de) hilft dir Schritt für Schritt.',
                'image'        => 'https://images.unsplash.com/photo-1434030216411-0b793f4b4173?w=600&q=80',
                'temps_lecture'=> '5 Min',
                'is_top'       => false,
            ],
        ];

        foreach ($advices as $advice) {
            Advice::create($advice);
        }
    }
}
