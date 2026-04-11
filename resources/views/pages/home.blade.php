{{-- resources/views/pages/home.blade.php --}}

@extends('layouts.app')

@section('title', 'Startseite')

@push('styles')
<style>

.about-section{
    background: #ffffff;
    padding: 5rem 1.5rem;
}

.about-inner{
    max-width: 1100px;
    margin: 0 auto;
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 3rem;
    align-items: center;
}

.about-tag{
    display: inline-block;
    background: #fff0f3;
    color: #e94560;
    padding: 6px 16px;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 700;
    margin-bottom: 1rem;
}

.about-inner h2{
    font-family: 'Sora', sans-serif;
    font-size: 1.8rem;
    margin-bottom: 1rem;
}

.about-inner p{
    color: #6c757d;
    line-height: 1.8;
    margin-bottom: 1rem;
}

.about-box{
    background: #1a1a2e;
    color: #fff;
    padding: 2rem;
    border-radius: 16px;
}

.about-box h3{
    font-size: 1.1rem;
    margin-bottom: 1rem;
}

.about-box ul{
    list-style: none;
    padding: 0;
}

.about-box li{
    margin-bottom: 10px;
    font-size: 0.9rem;
    color: rgba(255,255,255,0.8);
}

.about-box li::before{
    content: "✔";
    color: #e94560;
    margin-right: 8px;
}

@media(max-width:768px){
    .about-inner{
        grid-template-columns:1fr;
    }
}


    /* ══ HERO ══ */
    .hero { background: #1a1a2e; padding: 5rem 1.5rem; text-align: center; }
    .hero-badge {
        display: inline-block; background: rgba(233,69,96,0.15);
        color: #e94560; border: 1px solid rgba(233,69,96,0.3);
        border-radius: 20px; padding: 6px 18px;
        font-size: 0.8rem; font-weight: 600; margin-bottom: 1.5rem;
    }
    .hero h1 {
        font-family: 'Sora', sans-serif;
        font-size: clamp(2rem, 5vw, 3rem);
        font-weight: 700; color: #fff;
        line-height: 1.2; margin-bottom: 1.2rem;
    }
    .hero h1 span { color: #e94560; }
    .hero p { color: rgba(255,255,255,0.65); font-size: 1.05rem; max-width: 600px; margin: 0 auto 2rem; }
    .hero-btns { display: flex; gap: 12px; justify-content: center; flex-wrap: wrap; }
    .btn-hero-primary {
        background: #e94560; color: #fff; padding: 14px 32px;
        border-radius: 10px; font-weight: 600; text-decoration: none; transition: background 0.2s;
    }
    .btn-hero-primary:hover { background: #c73652; }
    .btn-hero-secondary {
        background: rgba(255,255,255,0.1); color: #fff;
        border: 1.5px solid rgba(255,255,255,0.2);
        padding: 13px 32px; border-radius: 10px; font-weight: 600; text-decoration: none;
    }
    .stats-bar {
        display: flex; justify-content: center; gap: 3rem;
        flex-wrap: wrap; margin-top: 3rem;
        padding-top: 2.5rem; border-top: 1px solid rgba(255,255,255,0.1);
    }
    .stat-num { font-size: 2rem; font-weight: 700; color: #fff; }
    .stat-lbl { font-size: 0.8rem; color: rgba(255,255,255,0.5); margin-top: 4px; }

    /* ══ FEATURES ══ */
    .features { padding: 5rem 1.5rem; max-width: 1100px; margin: 0 auto; }
    .section-title {
        text-align: center; font-family: 'Sora', sans-serif;
        font-size: 1.8rem; font-weight: 700; margin-bottom: 0.5rem;
    }
    .section-sub { text-align: center; color: #6c757d; margin-bottom: 3rem; }
    .features-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 1.5rem; }
    .feature-card {
        background: #fff; border-radius: 16px;
        padding: 2rem; border: 1px solid #e9ecef; transition: transform 0.2s;
    }
    .feature-card:hover { transform: translateY(-4px); }
    .feature-icon {
        width: 52px; height: 52px; border-radius: 12px;
        display: flex; align-items: center; justify-content: center;
        font-size: 1.5rem; margin-bottom: 1.2rem;
    }
    .feature-card h3 { font-size: 1.1rem; font-weight: 600; margin-bottom: 0.6rem; }
    .feature-card p { color: #6c757d; font-size: 0.9rem; line-height: 1.7; }
    .feature-card a {
        display: inline-block; margin-top: 1rem;
        color: #e94560; font-size: 0.875rem; font-weight: 600; text-decoration: none;
    }

    /* ══ AUSBILDUNG BLOCK ══ */
    .ausbildung-section { background: #fff; padding: 5rem 1.5rem; }
    .aus-inner {
        max-width: 1100px; margin: 0 auto;
        display: grid; grid-template-columns: 1fr 1fr; gap: 4rem; align-items: center;
    }
    .aus-tag {
        display: inline-block; background: #fff0f3; color: #e94560;
        border-radius: 20px; padding: 5px 16px; font-size: 0.8rem;
        font-weight: 600; margin-bottom: 1rem;
    }
    .aus-inner h2 { font-family: 'Sora', sans-serif; font-size: 1.8rem; font-weight: 700; margin-bottom: 1rem; }
    .aus-inner > div > p { color: #6c757d; line-height: 1.8; margin-bottom: 1.5rem; }
    .aus-list { list-style: none; display: flex; flex-direction: column; gap: 10px; }
    .aus-list li { display: flex; align-items: center; gap: 10px; font-size: 0.9rem; }
    .aus-list li::before { content: ''; width: 8px; height: 8px; border-radius: 50%; background: #e94560; flex-shrink: 0; }
    .aus-cards-col {
        background: #1a1a2e; border-radius: 16px;
        padding: 1.5rem; display: flex; flex-direction: column; gap: 12px;
    }
    .aus-job-card {
        background: rgba(255,255,255,0.07); border: 1px solid rgba(255,255,255,0.1);
        border-radius: 10px; padding: 1rem;
    }
    .aus-job-title { color: #fff; font-size: 0.9rem; font-weight: 600; }
    .aus-job-sub { color: rgba(255,255,255,0.5); font-size: 0.8rem; margin-top: 3px; }
    .aus-job-badge {
        display: inline-block; margin-top: 8px;
        background: rgba(233,69,96,0.2); color: #e94560;
        border-radius: 6px; padding: 2px 10px; font-size: 0.75rem; font-weight: 600;
    }
    @media(max-width:768px){ .aus-inner{ grid-template-columns:1fr; gap:2rem; } }

    /* ══════════════════════════════════════
       QUIZ SECTION
    ══════════════════════════════════════ */
    .quiz-section { background: #f5f5f7; padding: 5rem 1.5rem; }
    .quiz-header { text-align: center; margin-bottom: 3rem; }
    .quiz-badge {
        display: inline-block; background: rgba(233,69,96,0.12);
        color: #e94560; border: 1px solid rgba(233,69,96,0.25);
        border-radius: 20px; padding: 6px 18px;
        font-size: 0.8rem; font-weight: 700; margin-bottom: 1rem;
    }
    .quiz-header h2 {
        font-family: 'Sora', sans-serif;
        font-size: 1.8rem; font-weight: 700; margin-bottom: 0.6rem;
    }
    .quiz-header p { color: #6c757d; font-size: 0.95rem; max-width: 520px; margin: 0 auto; }

    /* Quiz Box */
    .quiz-box {
        max-width: 680px; margin: 0 auto;
        background: #fff; border-radius: 20px;
        border: 1px solid #e9ecef; overflow: hidden;
    }
    .progress-bar-wrap { height: 5px; background: #f0f0f0; }
    .progress-bar { height: 5px; background: #e94560; transition: width 0.4s ease; }
    .quiz-top { padding: 1.5rem 2rem 0; }
    .q-meta { display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem; }
    .q-num { font-size: 0.8rem; font-weight: 700; color: #e94560; }
    .q-count { font-size: 0.8rem; color: #aaa; }
    .q-icon { font-size: 2.5rem; text-align: center; margin-bottom: 0.8rem; }
    .q-text {
        font-family: 'Sora', sans-serif;
        font-size: 1.1rem; font-weight: 700;
        color: #1a1a2e; line-height: 1.5; margin-bottom: 1.5rem;
    }
    .options { display: grid; grid-template-columns: 1fr 1fr; gap: 10px; padding: 0 2rem 1.5rem; }
    .opt {
        padding: 14px 16px; border-radius: 12px;
        border: 2px solid #e9ecef; background: #fff;
        cursor: pointer; font-size: 0.875rem; font-weight: 500;
        color: #1a1a2e; text-align: left;
        transition: all 0.15s; font-family: inherit;
        line-height: 1.4;
    }
    .opt:hover { border-color: #e94560; background: #fff8f9; color: #e94560; }
    .opt.selected { border-color: #e94560; background: #e94560; color: #fff; }

    /* Next Button */
    .next-btn {
        display: block; width: calc(100% - 4rem);
        margin: 0 2rem 2rem; padding: 14px;
        background: #e94560; color: #fff; border: none;
        border-radius: 12px; font-size: 0.95rem; font-weight: 700;
        cursor: pointer; font-family: inherit; transition: background 0.15s;
    }
    .next-btn:hover { background: #c73652; }
    .next-btn:disabled { background: #e9ecef; color: #aaa; cursor: not-allowed; }

    /* Result */
    .result-box { padding: 2.5rem 2rem; text-align: center; }
    .result-icon { font-size: 3.5rem; margin-bottom: 1rem; }
    .result-box h3 { font-family: 'Sora', sans-serif; font-size: 1.5rem; font-weight: 700; margin-bottom: 0.4rem; }
    .result-score { font-size: 2.5rem; font-weight: 800; color: #e94560; margin: 0.5rem 0; }
    .result-score span { font-size: 1rem; color: #aaa; font-weight: 400; }
    .result-sub { color: #6c757d; font-size: 0.9rem; margin-bottom: 2rem; }
    .result-cards { display: flex; flex-direction: column; gap: 14px; text-align: left; margin-bottom: 2rem; }
    .r-card {
        border-radius: 14px; padding: 1.2rem 1.4rem;
        border: 2px solid #e9ecef; display: flex;
        align-items: flex-start; gap: 14px;
    }
    .r-card.top { border-color: #e94560; background: #fff8f9; }
    .r-card-icon {
        width: 48px; height: 48px; border-radius: 12px;
        display: flex; align-items: center; justify-content: center;
        font-size: 1.4rem; flex-shrink: 0;
    }
    .r-card-body h4 { font-size: 0.95rem; font-weight: 700; margin-bottom: 4px; }
    .r-card-body p { font-size: 0.825rem; color: #6c757d; line-height: 1.5; }
    .r-meta { font-size: 0.75rem; color: #aaa; margin-top: 4px; }
    .r-badge {
        display: inline-block; font-size: 0.75rem; font-weight: 700;
        border-radius: 6px; padding: 2px 10px; margin-top: 6px;
    }
    .r-badge.match { background: #fff0f3; color: #c73652; }
    .r-badge.good  { background: #e8fdf3; color: #0a6b3e; }
    .r-badge.ok    { background: #e8f4fd; color: #0a3d6b; }
    .match-bar { display: flex; align-items: center; gap: 8px; margin-top: 6px; }
    .match-pct { font-size: 0.75rem; font-weight: 700; color: #e94560; min-width: 30px; }
    .bar-track { flex: 1; height: 4px; background: #f0f0f0; border-radius: 2px; }
    .bar-fill   { height: 4px; border-radius: 2px; background: #e94560; transition: width 0.6s ease; }

    .retry-btn {
        width: 100%; padding: 14px;
        background: #1a1a2e; color: #fff; border: none;
        border-radius: 12px; font-size: 0.95rem; font-weight: 700;
        cursor: pointer; font-family: inherit; transition: background 0.15s;
    }
    .retry-btn:hover { background: #2d2d4e; }

    @media(max-width:500px){ .options{ grid-template-columns: 1fr; } }

    /* ══ CTA ══ */
    .cta-section { background: #e94560; padding: 5rem 1.5rem; text-align: center; }
    .cta-section h2 { font-family: 'Sora', sans-serif; font-size: 2rem; color: #fff; font-weight: 700; margin-bottom: 0.8rem; }
    .cta-section p { color: rgba(255,255,255,0.85); margin-bottom: 2rem; }
    .btn-cta {
        background: #fff; color: #e94560;
        padding: 14px 36px; border-radius: 10px;
        font-weight: 700; font-size: 1rem; text-decoration: none;
    }
</style>
@endpush

@section('content')

{{-- ════ HERO ════ --}}
<section class="hero">
    <div class="hero-badge">🇩🇪 Deine Karriereplattform für Deutschland</div>
    <h1>Erstelle deinen<br><span>perfekten Lebenslauf</span><br>in wenigen Minuten</h1>
    <p>Professionelle Bewerbungsunterlagen erstellen, Ausbildungsberufe entdecken und mit unserem KI-Chatbot persönliche Karrieretipps erhalten.</p>
    <div class="hero-btns">
        @auth
            <a href="{{ route('cv.create') }}" class="btn-hero-primary">Lebenslauf erstellen</a>
            <a href="{{ route('dashboard') }}" class="btn-hero-secondary">Mein Dashboard</a>
        @else
            <a href="{{ route('register') }}" class="btn-hero-primary">Kostenlos starten</a>
            <a href="{{ route('ausbildung.index') }}" class="btn-hero-secondary">Ausbildungen entdecken</a>
        @endauth
    </div>
    <div class="stats-bar">
        <div><div class="stat-num">2.400+</div><div class="stat-lbl">erstellte Lebensläufe</div></div>
        <div><div class="stat-num">180+</div><div class="stat-lbl">Ausbildungsberufe</div></div>
        <div><div class="stat-num">98%</div><div class="stat-lbl">Zufriedenheitsrate</div></div>
    </div>
</section>

{{-- ════ FEATURES ════ --}}
<section class="features">
    <h2 class="section-title">Alles, was du brauchst</h2>
    <p class="section-sub">Leistungsstarke Tools für deine Bewerbung in Deutschland</p>
    <div class="features-grid">
        <div class="feature-card">
            <div class="feature-icon" style="background:#fff0f3;">📄</div>
            <h3>Lebenslauf-Generator</h3>
            <p>Erstelle und lade deinen Lebenslauf als PDF herunter – mit professionellen Vorlagen nach deutschem Standard.</p>
            @auth <a href="{{ route('cv.create') }}">Jetzt erstellen →</a>
            @else <a href="{{ route('register') }}">Loslegen →</a> @endauth
        </div>
        <div class="feature-card">
            <div class="feature-icon" style="background:#e8f4fd;">🤖</div>
            <h3>KI-Chatbot</h3>
            <p>Stelle Fragen zur Bewerbung, zum Arbeitsmarkt oder zur Ausbildung und erhalte sofortige Antworten auf Deutsch.</p>
            @auth <a href="{{ route('chatbot.logs') }}">Chatbot öffnen →</a>
            @else <a href="{{ route('register') }}">Jetzt ausprobieren →</a> @endauth
        </div>
        <div class="feature-card">
            <div class="feature-icon" style="background:#e8fdf3;">🎓</div>
            <h3>Ausbildung Info</h3>
            <p>Entdecke alle anerkannten Ausbildungsberufe in Deutschland und erfahre alles über Dauer, Vergütung und Berufsaussichten.</p>
            <a href="{{ route('ausbildung.index') }}">Alle Berufe ansehen →</a>
        </div>
    </div>
</section>

{{-- ════ AUSBILDUNG INFO ════ --}}
<section class="ausbildung-section">
    <div class="aus-inner">
        <div>
            <div class="aus-tag">🎓 Ausbildung in Deutschland</div>
            <h2>Das duale Ausbildungssystem verstehen</h2>
            <p>Die duale Ausbildung kombiniert praktische Arbeit im Betrieb mit theoretischem Unterricht in der Berufsschule.</p>
            <ul class="aus-list">
                <li>Ausbildungsdauer: 2 bis 3,5 Jahre</li>
                <li>Monatliche Vergütung während der Ausbildung</li>
                <li>Anerkannter Berufsabschluss (IHK / HWK / Kammer)</li>
                <li>Übernahme nach erfolgreichem Abschluss möglich</li>
                <li>Kombination aus Praxis und Berufsschule</li>
            </ul>
        </div>
        <div class="aus-cards-col">
            <div class="aus-job-card">
                <div class="aus-job-title">Fachinformatiker/in</div>
                <div class="aus-job-sub">Anwendungsentwicklung · 3 Jahre</div>
                <div class="aus-job-badge">Sehr gefragt</div>
            </div>
            <div class="aus-job-card">
                <div class="aus-job-title">Kaufmann/frau im Einzelhandel</div>
                <div class="aus-job-sub">Handel &amp; Verkauf · 3 Jahre</div>
                <div class="aus-job-badge">Viele freie Stellen</div>
            </div>
            <div class="aus-job-card">
                <div class="aus-job-title">Elektroniker/in</div>
                <div class="aus-job-sub">Energie &amp; Gebäudetechnik · 3,5 Jahre</div>
                <div class="aus-job-badge">Top Gehalt</div>
            </div>
            <div class="aus-job-card">
                <div class="aus-job-title">Pflegefachmann/-frau</div>
                <div class="aus-job-sub">Gesundheit &amp; Pflege · 3 Jahre</div>
                <div class="aus-job-badge">Dringend gesucht</div>
            </div>
        </div>
    </div>
</section>

{{-- ════ QUIZ ════ --}}
<section class="quiz-section" id="quiz">
    <div class="quiz-header">
        <div class="quiz-badge">🎯 Ausbildungs-Finder</div>
        <h2 class="section-title">Welche Ausbildung passt zu dir?</h2>
        <p>Beantworte 8 kurze Fragen und entdecke die Ausbildungsberufe, die am besten zu deinen Interessen und Stärken passen.</p>
    </div>

    <div class="quiz-box" id="quizBox">
        <div class="progress-bar-wrap">
            <div class="progress-bar" id="progressBar" style="width:12.5%"></div>
        </div>
        <div class="quiz-top">
            <div class="q-meta">
                <span class="q-num" id="qNum">Frage 1 von 8</span>
                <span class="q-count" id="qCount">🎯 0 beantwortet</span>
            </div>
            <div class="q-icon" id="qIcon"></div>
            <div class="q-text" id="qText"></div>
        </div>
        <div class="options" id="optionsGrid"></div>
        <button class="next-btn" id="nextBtn" disabled onclick="nextQ()">Weiter →</button>
    </div>
</section>

{{-- ════ CTA — nur für Gäste ════ --}}
@guest
<section class="cta-section">
    <h2>Bereit, deine Karriere zu starten?</h2>
    <p>Tausende Nutzer haben bereits ihren professionellen Lebenslauf erstellt und ihren Wunschberuf in Deutschland gefunden.</p>
    <a href="{{ route('register') }}" class="btn-cta">Kostenlos registrieren</a>
</section>
@endguest  
{{-- ════ ABOUT US ════ --}}
<section class="about-section">
    <div class="about-inner">

        <div>
            <div class="about-tag">Über uns</div>

            <h2>Was ist Karriere Nabe?</h2>

            <p>
                Karriere Nabe ist eine moderne Plattform, die Studenten, Absolventen und Arbeitssuchenden hilft,
                die richtige Ausbildung in Deutschland zu finden und professionelle Bewerbungsunterlagen zu erstellen.
            </p>

            <p>
                Wir unterstützen dich von A bis Z: Lebenslauf erstellen, Ausbildungsplätze entdecken und die passende
                Karriere finden.
            </p>
        </div>

        <div class="about-box">
            <h3>Unsere Plattform bietet:</h3>

            <ul>
                <li>Ausbildungsangebote in Deutschland</li>
                <li>KI-Karriereberatung</li>
                <li>Lebenslauf-Generator (CV Builder)</li>
                <li>Bewerbungstipps & Interviewhilfe</li>
                <li>Berufsorientierung für Studenten</li>
            </ul>
        </div>

    </div>
</section>
@endsection

@push('scripts')
<script>
const questions = [
    {
        icon: '💻', text: 'Wie verbringst du am liebsten deine Zeit?',
        opts: ['Am Computer arbeiten', 'Mit Menschen reden', 'Draußen / handwerklich tätig sein', 'Zahlen & Daten analysieren'],
        tags: [['it','digital'], ['sozial','handel'], ['handwerk','technik'], ['buero','finanzen']]
    },
    {
        icon: '🎓', text: 'Welches Schulfach hat dir am meisten Spaß gemacht?',
        opts: ['Informatik / Mathematik', 'Deutsch / Sprachen', 'Physik / Technik', 'Biologie / Chemie'],
        tags: [['it','finanzen'], ['sozial','handel'], ['technik','handwerk'], ['gesundheit','labor']]
    },
    {
        icon: '🏢', text: 'In welcher Arbeitsumgebung fühlst du dich wohl?',
        opts: ['Im Büro am Schreibtisch', 'Mit Kunden & vielen Menschen', 'In einer Werkstatt oder draußen', 'In einem Krankenhaus / Praxis'],
        tags: [['buero','it'], ['handel','sozial'], ['handwerk','technik'], ['gesundheit']]
    },
    {
        icon: '🤝', text: 'Wie wichtig ist dir der Kontakt zu anderen Menschen?',
        opts: ['Sehr wichtig – ich liebe Teamarbeit', 'Wichtig, aber Einzelarbeit auch okay', 'Nicht so wichtig – ich arbeite lieber allein', 'Mir ist beides recht'],
        tags: [['sozial','handel'], ['buero','it'], ['it','handwerk'], ['technik','finanzen']]
    },
    {
        icon: '🔧', text: 'Was macht dir am meisten Freude?',
        opts: ['Probleme lösen & Dinge programmieren', 'Kunden beraten & verkaufen', 'Etwas mit den Händen bauen & reparieren', 'Menschen helfen & pflegen'],
        tags: [['it'], ['handel'], ['handwerk','technik'], ['gesundheit','sozial']]
    },
    {
        icon: '💰', text: 'Was ist dir bei deiner beruflichen Zukunft am wichtigsten?',
        opts: ['Hohe Gehaltsperspektiven', 'Einen sicheren Arbeitsplatz', 'Kreativität & Abwechslung', 'Anderen Menschen helfen können'],
        tags: [['it','finanzen'], ['handwerk','gesundheit'], ['digital','sozial'], ['gesundheit','sozial']]
    },
    {
        icon: '📍', text: 'Wo möchtest du hauptsächlich arbeiten?',
        opts: ['In einem großen Unternehmen', 'In einem kleinen Familienbetrieb', 'Flexibel & überall (mobil)', 'In einer sozialen Einrichtung'],
        tags: [['it','buero','finanzen'], ['handwerk','handel'], ['digital','technik'], ['sozial','gesundheit']]
    },
    {
        icon: '🚀', text: 'Welches Ziel beschreibt dich am besten?',
        opts: ['Ich will Technologien der Zukunft mitgestalten', 'Ich will ein eigenes Unternehmen aufbauen', 'Ich will mit meinen Händen Bleibendes schaffen', 'Ich will das Leben anderer Menschen verbessern'],
        tags: [['it','digital'], ['handel','finanzen'], ['handwerk','technik'], ['gesundheit','sozial']]
    }
];

const ausbildungen = [
    { title: 'Fachinformatiker/in – Anwendungsentwicklung', icon: '💻', tags: ['it','digital'], dauer: '3 Jahre', gehalt: '800–1.100 €/Monat', desc: 'Entwickle Softwareanwendungen und digitale Lösungen. Perfekt für technikbegeisterte Menschen mit Leidenschaft fürs Programmieren.' },
    { title: 'Kaufmann/-frau für Büromanagement', icon: '📋', tags: ['buero','handel'], dauer: '3 Jahre', gehalt: '600–900 €/Monat', desc: 'Organisiere Büroabläufe, kommuniziere mit Kunden und koordiniere Geschäftsprozesse in Unternehmen.' },
    { title: 'Elektroniker/in für Energie & Gebäudetechnik', icon: '⚡', tags: ['technik','handwerk'], dauer: '3,5 Jahre', gehalt: '700–1.000 €/Monat', desc: 'Installiere und warte elektrische Anlagen in Gebäuden, Industrie und erneuerbaren Energieanlagen.' },
    { title: 'Pflegefachmann/-frau', icon: '🏥', tags: ['gesundheit','sozial'], dauer: '3 Jahre', gehalt: '1.000–1.200 €/Monat', desc: 'Betreue und pflege Menschen in Krankenhäusern, Pflegeheimen oder ambulant zu Hause.' },
    { title: 'Kaufmann/-frau im Einzelhandel', icon: '🛍️', tags: ['handel','sozial'], dauer: '3 Jahre', gehalt: '600–900 €/Monat', desc: 'Berate Kunden kompetent, manage Warenbestand und gestalte attraktive Verkaufsflächen.' },
    { title: 'Mechatroniker/in', icon: '🔩', tags: ['technik','handwerk'], dauer: '3,5 Jahre', gehalt: '750–1.050 €/Monat', desc: 'Verbinde Mechanik, Elektronik und Informatik zur Wartung und Reparatur moderner Maschinen.' },
    { title: 'Bankkaufmann/-frau', icon: '🏦', tags: ['finanzen','buero'], dauer: '3 Jahre', gehalt: '700–950 €/Monat', desc: 'Berate Kunden in Finanzfragen, manage Konten und bearbeite Kreditanträge bei Banken.' },
    { title: 'Erzieher/in', icon: '👶', tags: ['sozial','gesundheit'], dauer: '3 Jahre', gehalt: '1.000–1.300 €/Monat', desc: 'Begleite und fördere Kinder in Kitas, Schulen und sozialen Einrichtungen.' },
    { title: 'Mediengestalter/in Digital & Print', icon: '🎨', tags: ['digital','it'], dauer: '3 Jahre', gehalt: '600–850 €/Monat', desc: 'Erstelle digitale und gedruckte Medienprodukte, Webseiten und kreative Grafiken.' },
    { title: 'Anlagenmechaniker/in SHK', icon: '🔧', tags: ['handwerk','technik'], dauer: '3,5 Jahre', gehalt: '700–950 €/Monat', desc: 'Installiere Heizungs-, Sanitär- und Klimaanlagen in Wohngebäuden und Gewerbebauten.' }
];

let current = 0, answers = [], scores = {};

function initScores() {
    scores = {};
    ['it','digital','buero','handel','technik','handwerk','sozial','gesundheit','finanzen','labor'].forEach(t => scores[t] = 0);
}

function renderQ() {
    const q = questions[current];
    document.getElementById('qNum').textContent       = `Frage ${current + 1} von ${questions.length}`;
    document.getElementById('qCount').textContent     = `🎯 ${current} beantwortet`;
    document.getElementById('qIcon').textContent      = q.icon;
    document.getElementById('qText').textContent      = q.text;
    document.getElementById('progressBar').style.width = `${((current + 1) / questions.length) * 100}%`;

    const grid = document.getElementById('optionsGrid');
    grid.innerHTML = '';
    q.opts.forEach((o, i) => {
        const b = document.createElement('button');
        b.className   = 'opt';
        b.textContent = o;
        b.onclick     = () => selectOpt(i, b);
        grid.appendChild(b);
    });

    const btn = document.getElementById('nextBtn');
    btn.disabled    = true;
    btn.textContent = current === questions.length - 1 ? 'Ergebnis anzeigen 🎉' : 'Weiter →';
}

function selectOpt(i, btn) {
    document.querySelectorAll('.opt').forEach(b => b.classList.remove('selected'));
    btn.classList.add('selected');
    answers[current] = i;
    document.getElementById('nextBtn').disabled = false;
}

function nextQ() {
    const ai = answers[current];
    if (ai === undefined) return;
    questions[current].tags[ai].forEach(t => { if (scores[t] !== undefined) scores[t] += 2; });
    current++;
    if (current >= questions.length) { showResult(); return; }
    renderQ();
}

function showResult() {
    const sorted = ausbildungen.map(a => {
        let sc = 0;
        a.tags.forEach(t => sc += scores[t] || 0);
        return { ...a, sc };
    }).sort((a, b) => b.sc - a.sc);

    const top3  = sorted.slice(0, 3);
    const maxSc = top3[0].sc || 1;

    const cards = top3.map((a, i) => {
        const pct   = Math.round((a.sc / maxSc) * 100);
        const cls   = i === 0 ? 'top' : '';
        const bg    = i === 0 ? '#fff0f3' : i === 1 ? '#e8fdf3' : '#e8f4fd';
        const badge = i === 0
            ? '<span class="r-badge match">🏆 Beste Übereinstimmung</span>'
            : i === 1
            ? '<span class="r-badge good">✅ Sehr gut geeignet</span>'
            : '<span class="r-badge ok">👍 Gut geeignet</span>';
        return `
        <div class="r-card ${cls}">
            <div class="r-card-icon" style="background:${bg}">${a.icon}</div>
            <div class="r-card-body">
                <h4>${a.title}</h4>
                <p>${a.desc}</p>
                <p class="r-meta">⏱ ${a.dauer} &nbsp;|&nbsp; 💶 ${a.gehalt}</p>
                ${badge}
                <div class="match-bar">
                    <span class="match-pct">${pct}%</span>
                    <div class="bar-track"><div class="bar-fill" style="width:${pct}%"></div></div>
                </div>
            </div>
        </div>`;
    }).join('');

    const matchPct = Math.round((top3[0].sc / 16) * 100);

    document.getElementById('quizBox').innerHTML = `
        <div class="result-box">
            <div class="result-icon">🎉</div>
            <h3>Dein Ergebnis ist da!</h3>
            <div class="result-score">${matchPct}% <span>Übereinstimmung</span></div>
            <p class="result-sub">Basierend auf deinen Antworten empfehlen wir dir diese Ausbildungsberufe:</p>
            <div class="result-cards">${cards}</div>
            <button class="retry-btn" onclick="restartQuiz()">🔄 Quiz neu starten</button>
        </div>`;
}

function restartQuiz() {
    current = 0; answers = [];
    initScores();
    document.getElementById('quizBox').innerHTML = `
        <div class="progress-bar-wrap"><div class="progress-bar" id="progressBar" style="width:12.5%"></div></div>
        <div class="quiz-top">
            <div class="q-meta">
                <span class="q-num" id="qNum"></span>
                <span class="q-count" id="qCount"></span>
            </div>
            <div class="q-icon" id="qIcon"></div>
            <div class="q-text" id="qText"></div>
        </div>
        <div class="options" id="optionsGrid"></div>
        <button class="next-btn" id="nextBtn" disabled onclick="nextQ()">Weiter →</button>`;
    renderQ();
}

initScores();
renderQ();
</script>
@endpush