{{-- resources/views/pages/home.blade.php --}}

@extends('layouts.app')

@section('title', 'Startseite')

@push('styles')
<style>
    /* ── HERO ── */
    .hero {
        background: #1a1a2e;
        padding: 5rem 1.5rem;
        text-align: center;
    }
    .hero-badge {
        display: inline-block;
        background: rgba(233,69,96,0.15);
        color: #e94560;
        border: 1px solid rgba(233,69,96,0.3);
        border-radius: 20px;
        padding: 6px 18px;
        font-size: 0.8rem;
        font-weight: 600;
        margin-bottom: 1.5rem;
    }
    .hero h1 {
        font-family: 'Sora', sans-serif;
        font-size: clamp(2rem, 5vw, 3rem);
        font-weight: 700;
        color: #fff;
        line-height: 1.2;
        margin-bottom: 1.2rem;
    }
    .hero h1 span { color: #e94560; }
    .hero p {
        color: rgba(255,255,255,0.65);
        font-size: 1.05rem;
        max-width: 600px;
        margin: 0 auto 2rem;
    }
    .hero-btns { display: flex; gap: 12px; justify-content: center; flex-wrap: wrap; }
    .btn-hero-primary {
        background: #e94560; color: #fff;
        padding: 14px 32px; border-radius: 10px;
        font-weight: 600; text-decoration: none; transition: background 0.2s;
    }
    .btn-hero-primary:hover { background: #c73652; }
    .btn-hero-secondary {
        background: rgba(255,255,255,0.1); color: #fff;
        border: 1.5px solid rgba(255,255,255,0.2);
        padding: 13px 32px; border-radius: 10px;
        font-weight: 600; text-decoration: none;
    }
    .stats-bar {
        display: flex; justify-content: center; gap: 3rem;
        flex-wrap: wrap; margin-top: 3rem;
        padding-top: 2.5rem;
        border-top: 1px solid rgba(255,255,255,0.1);
    }
    .stat-num { font-size: 2rem; font-weight: 700; color: #fff; }
    .stat-lbl { font-size: 0.8rem; color: rgba(255,255,255,0.5); margin-top: 4px; }

    /* ── FEATURES ── */
    .features { padding: 5rem 1.5rem; max-width: 1100px; margin: 0 auto; }
    .section-title {
        text-align: center; font-family: 'Sora', sans-serif;
        font-size: 1.8rem; font-weight: 700; margin-bottom: 0.5rem;
    }
    .section-sub { text-align: center; color: #6c757d; margin-bottom: 3rem; }
    .features-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 1.5rem;
    }
    .feature-card {
        background: #fff; border-radius: 16px;
        padding: 2rem; border: 1px solid #e9ecef;
        transition: transform 0.2s;
    }
    .feature-card:hover { transform: translateY(-4px); }
    .feature-icon {
        width: 52px; height: 52px; border-radius: 12px;
        display: flex; align-items: center;
        justify-content: center; font-size: 1.5rem; margin-bottom: 1.2rem;
    }
    .feature-card h3 { font-size: 1.1rem; font-weight: 600; margin-bottom: 0.6rem; }
    .feature-card p { color: #6c757d; font-size: 0.9rem; line-height: 1.7; }
    .feature-card a {
        display: inline-block; margin-top: 1rem;
        color: #e94560; font-size: 0.875rem;
        font-weight: 600; text-decoration: none;
    }

    /* ── AUSBILDUNG SECTION ── */
    .ausbildung-section { background: #fff; padding: 5rem 1.5rem; }
    .aus-inner {
        max-width: 1100px; margin: 0 auto;
        display: grid; grid-template-columns: 1fr 1fr;
        gap: 4rem; align-items: center;
    }
    .aus-tag {
        display: inline-block; background: #fff0f3;
        color: #e94560; border-radius: 20px;
        padding: 5px 16px; font-size: 0.8rem;
        font-weight: 600; margin-bottom: 1rem;
    }
    .aus-inner h2 {
        font-family: 'Sora', sans-serif;
        font-size: 1.8rem; font-weight: 700; margin-bottom: 1rem;
    }
    .aus-inner > div > p { color: #6c757d; line-height: 1.8; margin-bottom: 1.5rem; }
    .aus-list { list-style: none; display: flex; flex-direction: column; gap: 10px; }
    .aus-list li { display: flex; align-items: center; gap: 10px; font-size: 0.9rem; }
    .aus-list li::before {
        content: ''; width: 8px; height: 8px;
        border-radius: 50%; background: #e94560; flex-shrink: 0;
    }
    .aus-cards-col {
        background: #1a1a2e; border-radius: 16px;
        padding: 1.5rem; display: flex; flex-direction: column; gap: 12px;
    }
    .aus-job-card {
        background: rgba(255,255,255,0.07);
        border: 1px solid rgba(255,255,255,0.1);
        border-radius: 10px; padding: 1rem;
    }
    .aus-job-title { color: #fff; font-size: 0.9rem; font-weight: 600; }
    .aus-job-sub { color: rgba(255,255,255,0.5); font-size: 0.8rem; margin-top: 3px; }
    .aus-job-badge {
        display: inline-block; margin-top: 8px;
        background: rgba(233,69,96,0.2); color: #e94560;
        border-radius: 6px; padding: 2px 10px; font-size: 0.75rem; font-weight: 600;
    }
    @media(max-width:768px) {
        .aus-inner { grid-template-columns: 1fr; gap: 2rem; }
    }

    /* ── CTA ── */
    .cta-section { background: #e94560; padding: 5rem 1.5rem; text-align: center; }
    .cta-section h2 {
        font-family: 'Sora', sans-serif; font-size: 2rem;
        color: #fff; font-weight: 700; margin-bottom: 0.8rem;
    }
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

    <h1>
        Erstelle deinen<br>
        <span>perfekten Lebenslauf</span><br>
        in wenigen Minuten
    </h1>

    <p>
        Professionelle Bewerbungsunterlagen erstellen, Ausbildungsberufe entdecken
        und mit unserem KI-Chatbot persönliche Karrieretipps erhalten.
    </p>

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
        <div>
            <div class="stat-num">2.400+</div>
            <div class="stat-lbl">erstellte Lebensläufe</div>
        </div>
        <div>
            <div class="stat-num">180+</div>
            <div class="stat-lbl">Ausbildungsberufe</div>
        </div>
        <div>
            <div class="stat-num">98%</div>
            <div class="stat-lbl">Zufriedenheitsrate</div>
        </div>
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
            <p>
                Erstelle und lade deinen Lebenslauf als PDF herunter –
                mit professionellen Vorlagen nach deutschem Standard (tabellarischer Lebenslauf).
            </p>
            @auth
                <a href="{{ route('cv.create') }}">Jetzt erstellen →</a>
            @else
                <a href="{{ route('register') }}">Loslegen →</a>
            @endauth
        </div>

        <div class="feature-card">
            <div class="feature-icon" style="background:#e8f4fd;">🤖</div>
            <h3>KI-Chatbot</h3>
            <p>
                Stelle Fragen zur Bewerbung, zum Arbeitsmarkt oder zur Ausbildung
                und erhalte sofortige, persönliche Antworten auf Deutsch.
            </p>
            @auth
                <a href="{{ route('chatbot.logs') }}">Chatbot öffnen →</a>
            @else
                <a href="{{ route('register') }}">Jetzt ausprobieren →</a>
            @endauth
        </div>

        <div class="feature-card">
            <div class="feature-icon" style="background:#e8fdf3;">🎓</div>
            <h3>Ausbildung Info</h3>
            <p>
                Entdecke alle anerkannten Ausbildungsberufe in Deutschland
                und erfahre alles über Dauer, Vergütung und Berufsaussichten.
            </p>
            <a href="{{ route('ausbildung.index') }}">Alle Berufe ansehen →</a>
        </div>

    </div>
</section>

{{-- ════ AUSBILDUNG INFO BLOCK ════ --}}
<section class="ausbildung-section">
    <div class="aus-inner">
        <div>
            <div class="aus-tag">🎓 Ausbildung in Deutschland</div>
            <h2>Das duale Ausbildungssystem verstehen</h2>
            <p>
                Die duale Ausbildung kombiniert praktische Arbeit im Betrieb
                mit theoretischem Unterricht in der Berufsschule.
                Ein bewährtes System für einen erfolgreichen Berufseinstieg.
            </p>
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

{{-- ════ CTA — nur für Gäste ════ --}}
@guest
<section class="cta-section">
    <h2>Bereit, deine Karriere zu starten?</h2>
    <p>
        Tausende Nutzer haben bereits ihren professionellen Lebenslauf erstellt
        und ihren Wunschberuf in Deutschland gefunden.
    </p>
    <a href="{{ route('register') }}" class="btn-cta">Kostenlos registrieren</a>
</section>
@endguest

@endsection