@extends('layouts.app')
@section('title', 'Ausbildungsberufe')

@push('styles')
<style>
    /* ══ HERO ══ */
    .aus-hero { background: #1a1a2e; padding: 4rem 1.5rem; text-align: center; }
    .aus-badge {
        display: inline-block; background: rgba(233,69,96,0.15);
        color: #e94560; border: 1px solid rgba(233,69,96,0.3);
        border-radius: 20px; padding: 6px 18px;
        font-size: 0.8rem; font-weight: 700; margin-bottom: 1.2rem;
    }
    .aus-hero h1 {
        font-family: 'Sora', sans-serif;
        font-size: clamp(1.8rem, 4vw, 2.6rem);
        font-weight: 800; color: #fff; margin-bottom: 0.7rem;
    }
    .aus-hero h1 span { color: #e94560; }
    .aus-hero p { color: rgba(255,255,255,0.55); font-size: 1rem; max-width: 520px; margin: 0 auto 2rem; }
    .search-wrap { max-width: 500px; margin: 0 auto; position: relative; }
    .search-wrap input {
        width: 100%; padding: 14px 20px 14px 48px;
        border-radius: 12px; border: none;
        font-size: 0.95rem; font-family: inherit; outline: none;
        box-shadow: 0 4px 20px rgba(0,0,0,0.15);
    }
    .search-wrap .s-ico {
        position: absolute; left: 16px; top: 50%;
        transform: translateY(-50%); font-size: 1.1rem; pointer-events: none;
    }

    /* ══ MAIN ══ */
    .aus-main { max-width: 1100px; margin: 0 auto; padding: 2.5rem 1.5rem; }
    .top-bar {
        display: flex; justify-content: space-between;
        align-items: center; flex-wrap: wrap;
        gap: 1rem; margin-bottom: 2rem;
    }
    .stats-row { display: flex; gap: 2rem; }
    .stat-item { text-align: center; }
    .stat-num { font-family: 'Sora', sans-serif; font-size: 1.4rem; font-weight: 800; color: #e94560; }
    .stat-lbl { font-size: 0.75rem; color: #aaa; }

    /* ══ TABS ══ */
    .tabs-wrap { display: flex; gap: 6px; flex-wrap: wrap; }
    .tab-btn {
        padding: 7px 16px; border-radius: 20px;
        border: 1.5px solid #e9ecef; background: #fff;
        font-size: 0.825rem; font-weight: 600;
        cursor: pointer; color: #6c757d;
        font-family: inherit; transition: all 0.15s;
    }
    .tab-btn:hover { border-color: #e94560; color: #e94560; }
    .tab-btn.active { background: #e94560; color: #fff; border-color: #e94560; }

    /* ══ GRID ══ */
    .cards-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 20px;
    }
    .empty-msg {
        grid-column: 1 / -1; text-align: center;
        padding: 4rem; color: #aaa; font-size: 0.95rem;
    }

    /* ══ CARD ══ */
    .beruf-card {
        background: #fff; border-radius: 16px;
        border: 1px solid #e9ecef; overflow: hidden;
        transition: transform 0.2s;
    }
    .beruf-card:hover { transform: translateY(-4px); }
    .card-img-wrap { height: 170px; overflow: hidden; position: relative; }
    .card-img-wrap img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.3s; }
    .beruf-card:hover .card-img-wrap img { transform: scale(1.04); }
    .img-overlay { position: absolute; inset: 0; background: rgba(26,26,46,0.3); }
    .img-cat {
        position: absolute; top: 12px; left: 12px;
        background: #e94560; color: #fff;
        border-radius: 6px; padding: 3px 10px;
        font-size: 0.72rem; font-weight: 700;
    }
    .img-fav {
        position: absolute; top: 10px; right: 12px;
        background: rgba(255,255,255,0.9); border: none;
        border-radius: 8px; width: 32px; height: 32px;
        display: flex; align-items: center; justify-content: center;
        cursor: pointer; font-size: 0.9rem; transition: background 0.15s;
    }
    .img-fav:hover { background: #fff0f3; }
    .img-fav.saved { background: #fff0f3; }
    .card-body { padding: 1.2rem; }
    .card-title { font-size: 0.95rem; font-weight: 700; margin-bottom: 5px; line-height: 1.4; }
    .card-desc { font-size: 0.825rem; color: #6c757d; line-height: 1.6; margin-bottom: 12px; }
    .card-pills { display: flex; gap: 6px; flex-wrap: wrap; margin-bottom: 14px; }
    .pill {
        background: #f5f5f7; border-radius: 6px;
        padding: 4px 10px; font-size: 0.75rem; font-weight: 600; color: #1a1a2e;
    }
    .btn-mehr {
        width: 100%; padding: 11px; border-radius: 10px;
        border: 1.5px solid #e9ecef; background: #fff;
        font-size: 0.875rem; font-weight: 600;
        cursor: pointer; color: #1a1a2e;
        font-family: inherit; transition: all 0.15s;
    }
    .btn-mehr:hover { border-color: #e94560; color: #e94560; background: #fff8f9; }

    /* ══ MODAL ══ */
    .modal-overlay {
        display: none; position: fixed; inset: 0;
        background: rgba(0,0,0,0.55); z-index: 9999;
        align-items: center; justify-content: center; padding: 1rem;
    }
    .modal-overlay.open { display: flex; }
    .modal-box {
        background: #fff; border-radius: 20px;
        max-width: 620px; width: 100%;
        max-height: 90vh; overflow-y: auto;
    }
    .modal-hero-img { height: 210px; position: relative; overflow: hidden; }
    .modal-hero-img img { width: 100%; height: 100%; object-fit: cover; }
    .modal-hero-overlay { position: absolute; inset: 0; background: rgba(26,26,46,0.55); }
    .modal-hero-close {
        position: absolute; top: 12px; right: 14px;
        background: rgba(255,255,255,0.9); border: none;
        border-radius: 8px; width: 34px; height: 34px;
        display: flex; align-items: center; justify-content: center;
        cursor: pointer; font-size: 1rem; font-weight: 700;
    }
    .modal-hero-info { position: absolute; bottom: 16px; left: 20px; }
    .modal-hero-info h2 { color: #fff; font-size: 1.2rem; font-weight: 800; line-height: 1.3; }
    .modal-hero-info p { color: rgba(255,255,255,0.7); font-size: 0.8rem; margin-top: 3px; }
    .modal-inner { padding: 1.5rem; }
    .modal-meta-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 10px; margin-bottom: 1.5rem; }
    .modal-meta-item { background: #f5f5f7; border-radius: 10px; padding: 0.9rem; text-align: center; }
    .modal-meta-item .m-val { font-size: 0.95rem; font-weight: 800; color: #1a1a2e; }
    .modal-meta-item .m-lbl { font-size: 0.72rem; color: #aaa; margin-top: 3px; }
    .modal-section { margin-bottom: 1.2rem; }
    .modal-section h4 {
        font-size: 0.75rem; font-weight: 700; color: #e94560;
        text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 8px;
    }
    .modal-section p { font-size: 0.875rem; color: #6c757d; line-height: 1.7; }
    .modal-list { list-style: none; display: flex; flex-direction: column; gap: 7px; }
    .modal-list li { font-size: 0.85rem; color: #6c757d; display: flex; align-items: center; gap: 8px; }
    .modal-list li::before { content: ''; width: 6px; height: 6px; border-radius: 50%; background: #e94560; flex-shrink: 0; }
    .modal-cta { padding: 0 1.5rem 1.5rem; }
    .modal-btn-close {
        width: 100%; padding: 13px; background: #1a1a2e; color: #fff;
        border: none; border-radius: 12px; font-size: 0.9rem;
        font-weight: 600; cursor: pointer; font-family: inherit; transition: background 0.15s;
    }
    .modal-btn-close:hover { background: #2d2d4e; }

    /* ══ SITES SECTION EN BAS ══ */
    .sites-section {
        background: #0f0f1e;
        padding: 4rem 1.5rem;
        margin-top: 2rem;
    }
    .sites-inner { max-width: 1100px; margin: 0 auto; }
    .sites-header { text-align: center; margin-bottom: 2.5rem; }
    .sites-header h2 {
        font-family: 'Sora', sans-serif;
        font-size: 1.6rem; font-weight: 800; color: #fff; margin-bottom: 0.5rem;
    }
    .sites-header p { color: rgba(255,255,255,0.45); font-size: 0.9rem; }
    .sites-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        gap: 14px;
    }
    .site-card {
        background: rgba(255,255,255,0.06);
        border: 1px solid rgba(255,255,255,0.1);
        border-radius: 14px; padding: 1.3rem;
        text-decoration: none;
        display: flex; flex-direction: column;
        align-items: center; gap: 10px; text-align: center;
        transition: all 0.2s;
    }
    .site-card:hover {
        background: rgba(233,69,96,0.12);
        border-color: rgba(233,69,96,0.4);
        transform: translateY(-3px);
    }
    .site-logo {
        width: 54px; height: 54px; border-radius: 12px;
        background: #fff; display: flex; align-items: center;
        justify-content: center; overflow: hidden; padding: 6px;
    }
    .site-logo img { width: 100%; height: 100%; object-fit: contain; }
    .site-name { color: #fff; font-size: 0.875rem; font-weight: 700; }
    .site-desc { color: rgba(255,255,255,0.45); font-size: 0.75rem; line-height: 1.5; }
    .site-badge {
        background: rgba(233,69,96,0.2); color: #e94560;
        border-radius: 5px; padding: 2px 9px;
        font-size: 0.72rem; font-weight: 700;
    }
    .sites-note {
        text-align: center; margin-top: 2rem;
        color: rgba(255,255,255,0.25); font-size: 0.8rem;
    }

    @media(max-width:768px) {
        .top-bar { flex-direction: column; align-items: flex-start; }
        .sites-grid { grid-template-columns: repeat(2, 1fr); }
    }
</style>
@endpush

@section('content')

{{-- ════ HERO ════ --}}
<section class="aus-hero">
    <div class="aus-badge">🎓 Ausbildungsberufe in Deutschland</div>
    <h1>Finde deine <span>Traumausbildung</span></h1>
    <p>Entdecke über 200 anerkannte Ausbildungsberufe und finde den perfekten Start in deine Karriere.</p>
    <div class="search-wrap">
        <span class="s-ico">🔍</span>
        <input type="text" id="searchInput"
               placeholder="Beruf suchen... z.B. Fachinformatiker"
               oninput="filterCards()">
    </div>
</section>

{{-- ════ BERUFE CARDS ════ --}}
<div class="aus-main">
    <div class="top-bar">
        <div class="stats-row">
            <div class="stat-item">
                <div class="stat-num">200+</div>
                <div class="stat-lbl">Berufe</div>
            </div>
            <div class="stat-item">
                <div class="stat-num">12</div>
                <div class="stat-lbl">Kategorien</div>
            </div>
            <div class="stat-item">
                <div class="stat-num">95%</div>
                <div class="stat-lbl">Übernahmequote</div>
            </div>
        </div>
        <div class="tabs-wrap">
            <button class="tab-btn active" onclick="filterTab('alle', this)">Alle</button>
            <button class="tab-btn" onclick="filterTab('it', this)">💻 IT</button>
            <button class="tab-btn" onclick="filterTab('handel', this)">🛍️ Handel</button>
            <button class="tab-btn" onclick="filterTab('handwerk', this)">🔧 Handwerk</button>
            <button class="tab-btn" onclick="filterTab('gesundheit', this)">🏥 Gesundheit</button>
            <button class="tab-btn" onclick="filterTab('sozial', this)">🤝 Soziales</button>
            <button class="tab-btn" onclick="filterTab('buero', this)">📋 Büro</button>
            <button class="tab-btn" onclick="filterTab('transport', this)">🚛 Transport & Logistik</button>
        </div>
    </div>

    <div class="cards-grid" id="cardsGrid"></div>
</div>

{{-- ════ MODAL ════ --}}
<div class="modal-overlay" id="modalOverlay" onclick="closeBg(event)">
    <div class="modal-box" id="modalBox"></div>
</div>

{{-- ════ SITES OFFICIELS EN BAS ════ --}}
<section class="sites-section">
    <div class="sites-inner">
        <div class="sites-header">
            <h2>🔗 Jetzt direkt bewerben</h2>
            <p>Klicke auf ein offizielles Portal und finde sofort freie Ausbildungsplätze in ganz Deutschland</p>
        </div>
        <div class="sites-grid">

            <a class="site-card" href="https://www.ausbildung.de" target="_blank" rel="noopener">
                <div class="site-logo">
                    <img src="https://www.google.com/s2/favicons?domain=ausbildung.de&sz=64" alt="ausbildung.de">
                </div>
                <div class="site-name">ausbildung.de</div>
                <div class="site-desc">Größtes Ausbildungsportal Deutschlands</div>
                <span class="site-badge">⭐ Top 1</span>
            </a>

            <a class="site-card" href="https://berufenet.arbeitsagentur.de" target="_blank" rel="noopener">
                <div class="site-logo">
                    <img src="https://www.google.com/s2/favicons?domain=arbeitsagentur.de&sz=64" alt="Berufenet">
                </div>
                <div class="site-name">Berufenet</div>
                <div class="site-desc">Offizielle Berufsinfos der Bundesagentur für Arbeit</div>
                <span class="site-badge">🇩🇪 Offiziell</span>
            </a>

            <a class="site-card" href="https://www.lehrstellenradar.de" target="_blank" rel="noopener">
                <div class="site-logo">
                    <img src="https://www.google.com/s2/favicons?domain=lehrstellenradar.de&sz=64" alt="Lehrstellenradar">
                </div>
                <div class="site-name">Lehrstellenradar</div>
                <div class="site-desc">Ausbildungsplätze auf der Karte finden</div>
                <span class="site-badge">📍 Regional</span>
            </a>

            <a class="site-card" href="https://jobboerse.arbeitsagentur.de" target="_blank" rel="noopener">
                <div class="site-logo">
                    <img src="https://www.google.com/s2/favicons?domain=arbeitsagentur.de&sz=64" alt="Jobbörse">
                </div>
                <div class="site-name">Jobbörse BA</div>
                <div class="site-desc">Jobbörse der Bundesagentur für Arbeit</div>
                <span class="site-badge">🇩🇪 Offiziell</span>
            </a>

            <a class="site-card" href="https://www.azubi.de" target="_blank" rel="noopener">
                <div class="site-logo">
                    <img src="https://www.google.com/s2/favicons?domain=azubi.de&sz=64" alt="Azubi.de">
                </div>
                <div class="site-name">Azubi.de</div>
                <div class="site-desc">Ausbildungsplätze & Bewerbungstipps</div>
                <span class="site-badge">💡 Beliebt</span>
            </a>

            <a class="site-card" href="https://www.ausbildungsstellen.de" target="_blank" rel="noopener">
                <div class="site-logo">
                    <img src="https://www.google.com/s2/favicons?domain=ausbildungsstellen.de&sz=64" alt="Ausbildungsstellen">
                </div>
                <div class="site-name">Ausbildungsstellen</div>
                <div class="site-desc">Aktuelle freie Ausbildungsstellen bundesweit</div>
                <span class="site-badge">✅ Empfohlen</span>
            </a>

            <a class="site-card" href="https://www.meinestadt.de" target="_blank" rel="noopener">
                <div class="site-logo">
                    <img src="https://www.google.com/s2/favicons?domain=meinestadt.de&sz=64" alt="Meinestadt">
                </div>
                <div class="site-name">Meinestadt.de</div>
                <div class="site-desc">Regionale Ausbildungssuche nach Stadtgebiet</div>
                <span class="site-badge">📍 Regional</span>
            </a>

            <a class="site-card" href="https://www.aubi-plus.de" target="_blank" rel="noopener">
                <div class="site-logo">
                    <img src="https://www.google.com/s2/favicons?domain=aubi-plus.de&sz=64" alt="Aubi-plus">
                </div>
                <div class="site-name">Aubi-plus</div>
                <div class="site-desc">Ausbildung & duales Studium finden</div>
                <span class="site-badge">🎓 Dual</span>
            </a>

            <a class="site-card" href="https://www.azubiyo.de" target="_blank" rel="noopener">
                <div class="site-logo">
                    <img src="https://www.google.com/s2/favicons?domain=azubiyo.de&sz=64" alt="Azubiyo">
                </div>
                <div class="site-name">Azubiyo</div>
                <div class="site-desc">Ausbildungsplatzsuche für junge Bewerber</div>
                <span class="site-badge">🚀 Jung</span>
            </a>

        </div>
        <p class="sites-note">
            🔒 Alle Links führen zu offiziellen externen Webseiten. CareerHub ist nicht verantwortlich für deren Inhalte.
        </p>
    </div>
</section>

@endsection

@push('scripts')
<script>
const berufe = [
    {
        id: 1,
        title: 'Fachinformatiker/in – Anwendungsentwicklung',
        kat: 'it', katLabel: 'IT & Digital',
        img: 'https://images.unsplash.com/photo-1461749280684-dccba630e2f6?w=700&q=80',
        dauer: '3 Jahre', gehalt: '800–1.100 €',
        abschluss: 'Mittlere Reife', stellen: '25.000+',
        desc: 'Entwickle professionelle Softwareanwendungen und digitale Lösungen für Unternehmen jeder Größe.',
        condition: '🎓 Schulabschluss: Mittlere Reife oder Abitur. 🇩🇪 Deutsch: B1 (Goethe/telc) empfohlen. Logisches Denken und Englischkenntnisse sind von Vorteil.',
        aufgaben: ['Softwareanwendungen programmieren (Java, Python, PHP...)','Datenbanken entwerfen und verwalten','Apps und Webseiten entwickeln','Fehler analysieren und beheben','Technische Dokumentationen erstellen'],
        weiter: 'Informatikstudium (B.Sc.), IT-Projektleiter, Softwarearchitekt, Selbstständigkeit'
    },
    {
        id: 2,
        title: 'Elektroniker/in – Energie & Gebäudetechnik',
        kat: 'handwerk', katLabel: 'Handwerk & Technik',
        img: 'https://images.unsplash.com/photo-1621905251189-08b45d6a269e?w=700&q=80',
        dauer: '3,5 Jahre', gehalt: '700–1.050 €',
        abschluss: 'Hauptschulabschluss', stellen: '30.000+',
        desc: 'Installiere und warte elektrische Anlagen in Gebäuden, der Industrie und bei erneuerbaren Energien.',
        condition: '🎓 Schulabschluss: Hauptschulabschluss oder Mittlere Reife. 🇩🇪 Deutsch: B1 (Goethe/telc). Handwerkliches Geschick und technisches Verständnis sind wichtig.',
        aufgaben: ['Elektroanlagen in Gebäuden installieren','Schaltschränke verdrahten und programmieren','Fehlersuche und Reparatur durchführen','Sicherheitsprüfungen nach VDE durchführen','Solaranlagen & Wärmepumpen installieren'],
        weiter: 'Elektrotechnikermeister, Techniker, Ingenieurstudium Elektrotechnik'
    },
    {
        id: 3,
        title: 'Kaufmann/-frau im Einzelhandel',
        kat: 'handel', katLabel: 'Handel & Verkauf',
        img: 'https://images.unsplash.com/photo-1556742049-0cfed4f6a45d?w=700&q=80',
        dauer: '3 Jahre', gehalt: '600–900 €',
        abschluss: 'Hauptschulabschluss', stellen: '40.000+',
        desc: 'Berate Kunden kompetent, verwalte Warenbestände und gestalte attraktive Verkaufsflächen.',
        condition: '🎓 Schulabschluss: Hauptschulabschluss. 🇩🇪 Deutsch: B1 (Goethe/telc). Gute Kommunikationsfähigkeiten und Kundenorientierung sind entscheidend.',
        aufgaben: ['Kunden beraten und betreuen','Warenbestand verwalten und bestellen','Kasse bedienen und abrechnen','Verkaufsflächen gestalten und dekorieren','Inventur und Warenpflege durchführen'],
        weiter: 'Handelsfachwirt, Betriebswirtschaftsstudium, Filialleitung, Selbstständigkeit'
    },
    {
        id: 4,
        title: 'Pflegefachmann/-frau',
        kat: 'gesundheit', katLabel: 'Gesundheit & Pflege',
        img: 'https://images.unsplash.com/photo-1559839734-2b71ea197ec2?w=700&q=80',
        dauer: '3 Jahre', gehalt: '1.000–1.300 €',
        abschluss: 'Mittlere Reife', stellen: '50.000+',
        desc: 'Betreue und pflege Menschen aller Altersgruppen in Krankenhäusern und Pflegeeinrichtungen.',
        condition: '🎓 Schulabschluss: Mittlere Reife oder gleichwertig. 🇩🇪 Deutsch: B2 (Goethe/telc) zwingend erforderlich. Ein polizeiliches Führungszeugnis wird benötigt.',
        aufgaben: ['Patienten pflegen und betreuen','Medikamente verabreichen und überwachen','Ärzte bei Behandlungen unterstützen','Pflegedokumentation führen','Angehörige beraten und begleiten'],
        weiter: 'Pflegeleitung, Studium Pflegewissenschaft, Spezialisierung Intensivpflege'
    },
    {
        id: 5,
        title: 'Kaufmann/-frau für Büromanagement',
        kat: 'buero', katLabel: 'Büro & Verwaltung',
        img: 'https://images.unsplash.com/photo-1497366216548-37526070297c?w=700&q=80',
        dauer: '3 Jahre', gehalt: '600–900 €',
        abschluss: 'Mittlere Reife', stellen: '35.000+',
        desc: 'Organisiere Büroabläufe, koordiniere Termine und kommuniziere mit Kunden und Partnern.',
        condition: '🎓 Schulabschluss: Mittlere Reife oder Abitur. 🇩🇪 Deutsch: B1 (Goethe/telc). Gute EDV-Kenntnisse (MS Office) sind von Vorteil.',
        aufgaben: ['Büroorganisation und Verwaltung','Terminplanung und Koordination','Schriftverkehr und E-Mail-Korrespondenz','Buchhaltung und Rechnungsstellung','Personal- und Reiseorganisation'],
        weiter: 'Fachwirt Büro und Projektorganisation, BWL-Studium, Teamleitung'
    },
    {
        id: 6,
        title: 'Erzieher/in',
        kat: 'sozial', katLabel: 'Soziales & Erziehung',
        img: 'https://images.unsplash.com/photo-1587654780291-39c9404d746b?w=700&q=80',
        dauer: '3 Jahre', gehalt: '1.000–1.300 €',
        abschluss: 'Mittlere Reife', stellen: '45.000+',
        desc: 'Begleite, fördere und erziehe Kinder und Jugendliche in Kitas, Schulen und Einrichtungen.',
        condition: '🎓 Schulabschluss: Mittlere Reife + einschlägige Berufsausbildung oder Abitur. 🇩🇪 Deutsch: B2 (Goethe/telc). Erweitertes Führungszeugnis notwendig.',
        aufgaben: ['Kinder im Alltag betreuen und fördern','Bildungs- und Spielangebote gestalten','Elterngespräche führen','Entwicklung der Kinder dokumentieren','Ausflüge und Projekte organisieren'],
        weiter: 'Sozialpädagogik-Studium, Einrichtungsleitung, Heilpädagogik'
    },
    {
        id: 7,
        title: 'Mechatroniker/in',
        kat: 'handwerk', katLabel: 'Handwerk & Technik',
        img: 'https://images.unsplash.com/photo-1581092918056-0c4c3acd3789?w=700&q=80',
        dauer: '3,5 Jahre', gehalt: '750–1.050 €',
        abschluss: 'Mittlere Reife', stellen: '20.000+',
        desc: 'Verbinde Mechanik, Elektronik und Informatik zur Wartung moderner Produktionsanlagen.',
        condition: '🎓 Schulabschluss: Mittlere Reife oder Abitur. 🇩🇪 Deutsch: B1 (Goethe/telc). Grundkenntnisse in Physik und Mathe sind erforderlich.',
        aufgaben: ['Maschinen und Anlagen montieren','Steuerungsprogramme testen und optimieren','Störungen und Defekte beheben','Qualitätskontrollen durchführen','Wartungspläne erstellen und umsetzen'],
        weiter: 'Meister Mechatronik, Techniker, Ingenieurstudium Maschinenbau'
    },
    {
        id: 8,
        title: 'Bankkaufmann/-frau',
        kat: 'buero', katLabel: 'Büro & Finanzen',
        img: 'https://images.unsplash.com/photo-1541354329998-f4d9a9f9297f?w=700&q=80',
        dauer: '3 Jahre', gehalt: '700–1.000 €',
        abschluss: 'Mittlere Reife', stellen: '15.000+',
        desc: 'Berate Kunden in Finanzfragen, verwalte Konten und bearbeite Kredit- und Sparanträge.',
        condition: '🎓 Schulabschluss: Abitur oder sehr gute Mittlere Reife. 🇩🇪 Deutsch: B1/B2 (Goethe/telc). Mathematikkenntnisse sind sehr wichtig.',
        aufgaben: ['Kunden in Finanz- und Anlagefragen beraten','Konten, Depots und Kredite verwalten','Kreditanträge bearbeiten und prüfen','Wertpapiere und Fonds vermitteln','Zahlungsverkehr abwickeln'],
        weiter: 'Bankfachwirt (IHK), BWL-Studium, Filialleitung, Private Banking'
    },
    {
        id: 9,
        title: 'Mediengestalter/in Digital & Print',
        kat: 'it', katLabel: 'IT & Digital',
        img: 'https://images.unsplash.com/photo-1558655146-d09347e92766?w=700&q=80',
        dauer: '3 Jahre', gehalt: '600–900 €',
        abschluss: 'Mittlere Reife', stellen: '10.000+',
        desc: 'Gestalte digitale und gedruckte Medienprodukte, Webseiten, Logos und kreative Grafiken.',
        condition: '🎓 Schulabschluss: Mittlere Reife oder Abitur. 🇩🇪 Deutsch: B1 (Goethe/telc). Kreativität und ein gutes Auge für Ästhetik sind entscheidend.',
        aufgaben: ['Grafiken, Logos und Layouts erstellen','Webseiten und Banner gestalten','Druckprodukte vorbereiten (Prepress)','Fotografie und Bildbearbeitung','Social-Media-Content erstellen'],
        weiter: 'Kommunikationsdesign (B.A.), Art Director, UX/UI-Designer'
    },
    {
        id: 10,
        title: 'Anlagenmechaniker/in SHK',
        kat: 'handwerk', katLabel: 'Handwerk & Technik',
        img: 'https://images.unsplash.com/photo-1504328345606-18bbc8c9d7d1?w=700&q=80',
        dauer: '3,5 Jahre', gehalt: '700–950 €',
        abschluss: 'Hauptschulabschluss', stellen: '22.000+',
        desc: 'Installiere Heizungs-, Sanitär- und Klimaanlagen in Wohn- und Gewerbeobjekten.',
        condition: '🎓 Schulabschluss: Hauptschulabschluss oder Mittlere Reife. 🇩🇪 Deutsch: B1 (Goethe/telc). Handwerkliches Geschick und körperliche Belastbarkeit sind Voraussetzung.',
        aufgaben: ['Heizungsanlagen planen und installieren','Sanitäranlagen und Bäder einbauen','Rohrleitungssysteme verlegen','Wärmepumpen und Solaranlagen installieren','Wartung und Reparatur von Anlagen'],
        weiter: 'Meister SHK, Techniker, Betriebsleitung, Selbstständigkeit'
    },
    {
        id: 11,
        title: 'Altenpfleger/in',
        kat: 'gesundheit', katLabel: 'Gesundheit & Pflege',
        img: 'https://images.unsplash.com/photo-1576765608535-5f04d1e3f289?w=700&q=80',
        dauer: '3 Jahre', gehalt: '950–1.200 €',
        abschluss: 'Hauptschulabschluss', stellen: '60.000+',
        desc: 'Betreue und pflege ältere Menschen in Pflegeheimen oder im häuslichen Umfeld liebevoll.',
        condition: '🎓 Schulabschluss: Hauptschulabschluss mit guten Noten oder Mittlere Reife. 🇩🇪 Deutsch: B2 (Goethe/telc). Geduld, Empathie und Führungszeugnis sind notwendig.',
        aufgaben: ['Körperpflege und Grundversorgung','Medikamente verteilen und dokumentieren','Freizeitaktivitäten planen und begleiten','Angehörige informieren und beraten','Pflegedokumentation pflegen'],
        weiter: 'Pflegeleitung, Studium Gerontologie, Spezialisierung Demenzpflege'
    },
    {
        id: 12,
        title: 'Koch / Köchin',
        kat: 'handel', katLabel: 'Gastronomie',
        img: 'https://images.unsplash.com/photo-1556909114-f6e7ad7d3136?w=700&q=80',
        dauer: '3 Jahre', gehalt: '600–850 €',
        abschluss: 'Hauptschulabschluss', stellen: '18.000+',
        desc: 'Bereite professionell Speisen zu und arbeite in Restaurants, Hotels und Catering-Unternehmen.',
        condition: '🎓 Schulabschluss: Hauptschulabschluss. 🇩🇪 Deutsch: B1 (Goethe/telc). Gesundheitszeugnis (Belehrung nach §43 IfSG) ist verpflichtend.',
        aufgaben: ['Speisen kreativ zubereiten und anrichten','Menüs und Speisekarten planen','Küche organisieren und koordinieren','Hygienevorschriften (HACCP) einhalten','Waren einkaufen und lagern'],
        weiter: 'Küchenmeister, Restaurantleitung, eigenes Restaurant, Chefkoch'
    },
    {
        id: 13,
        title: 'Berufskraftfahrer/in – LKW',
        kat: 'transport', katLabel: 'Transport & Logistik',
        img: 'https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d?w=700&q=80',
        dauer: '3 Jahre', gehalt: '800–1.100 €',
        abschluss: 'Hauptschulabschluss', stellen: '35.000+',
        desc: 'Fahre LKW im Nah- und Fernverkehr, lade Güter sicher und halte alle Lenk- und Ruhezeiten ein.',
        condition: '🎓 Schulabschluss: Hauptschulabschluss. 🇩🇪 Deutsch: B1 (Goethe/telc). Führerscheinklasse B Voraussetzung. Klasse C/CE wird während der Ausbildung erworben. Medizinische Untersuchung notwendig.',
        aufgaben: ['LKW sicher im Straßenverkehr führen','Ladung fachgerecht sichern und kontrollieren','Lenk- und Ruhezeiten einhalten und dokumentieren','Fahrzeugpflege und einfache Wartung durchführen','Frachtpapiere und Liefernachweise bearbeiten'],
        weiter: 'Disponent, Logistikmeister, Gefahrgutbeauftragter, Fuhrunternehmer'
    },
    {
        id: 14,
        title: 'Kraftfahrzeugmechatroniker/in – Nutzfahrzeuge',
        kat: 'handwerk', katLabel: 'Handwerk & Technik',
        img: 'https://images.unsplash.com/photo-1487754180451-c456f719a1fc?w=700&q=80',
        dauer: '3,5 Jahre', gehalt: '700–1.000 €',
        abschluss: 'Hauptschulabschluss', stellen: '20.000+',
        desc: 'Repariere und warte LKW, Busse und andere Nutzfahrzeuge in spezialisierten Werkstätten.',
        condition: '🎓 Schulabschluss: Hauptschulabschluss oder Mittlere Reife. 🇩🇪 Deutsch: B1 (Goethe/telc). Technisches Verständnis und handwerkliches Geschick sind von Vorteil.',
        aufgaben: ['Fehlerdiagnose an Motor, Bremsen und Elektronik','Wartung und Inspektion von Nutzfahrzeugen','Reparatur von Bremsanlagen, Lenkung und Fahrwerk','Arbeiten mit Diagnosesystemen und Prüfgeräten','Durchführung von Sicherheitsprüfungen (SP / HU)'],
        weiter: 'Meister im Kfz-Handwerk, Techniker für Fahrzeugtechnik, Studium Fahrzeugtechnik'
    },
    {
        id: 15,
        title: 'Fachkraft für Altenpflege',
        kat: 'gesundheit', katLabel: 'Gesundheit & Pflege',
        img: 'https://images.unsplash.com/photo-1577212017117-6519d20846b8?w=700&q=80',
        dauer: '3 Jahre', gehalt: '900–1.200 €',
        abschluss: 'Hauptschulabschluss', stellen: '55.000+',
        desc: 'Unterstütze ältere Menschen bei Pflege, Betreuung und Alltagsbewältigung in Pflegeheimen.',
        condition: '🎓 Schulabschluss: Hauptschulabschluss. 🇩🇪 Deutsch: B2 (Goethe/telc) zwingend. Erweitertes polizeiliches Führungszeugnis wird benötigt.',
        aufgaben: ['Grundpflege (Körperpflege, Ernährung, Mobilität) durchführen','Pflegebedürftige bei der Alltagsbewältigung unterstützen','Vitalzeichen messen und dokumentieren','Betreuungsaktivitäten anbieten','Sterbebegleitung und Trauerarbeit'],
        weiter: 'Weiterbildung zur Pflegefachkraft, Wohnbereichsleitung, Praxisanleiter/in'
    }
];

let activeTab = 'alle', searchVal = '';

function renderCards() {
    const grid = document.getElementById('cardsGrid');
    const list = berufe.filter(b => {
        const tabOk    = activeTab === 'alle' || b.kat === activeTab;
        const searchOk = b.title.toLowerCase().includes(searchVal.toLowerCase());
        return tabOk && searchOk;
    });
    if (list.length === 0) {
        grid.innerHTML = '<div class="empty-msg">😕 Kein Beruf gefunden. Versuche eine andere Suche.</div>';
        return;
    }
    grid.innerHTML = list.map(b => `
        <div class="beruf-card">
            <div class="card-img-wrap">
                <img src="${b.img}" alt="${b.title}" loading="lazy">
                <div class="img-overlay"></div>
                <span class="img-cat">${b.katLabel}</span>
                <button class="img-fav" onclick="toggleFav(this)" title="Merken">🤍</button>
            </div>
            <div class="card-body">
                <div class="card-title">${b.title}</div>
                <div class="card-desc">${b.desc}</div>
                <div class="card-pills">
                    <span class="pill">⏱ ${b.dauer}</span>
                    <span class="pill">💶 ${b.gehalt}/Monat</span>
                    <span class="pill">🎓 ${b.abschluss}</span>
                </div>
                <button class="btn-mehr" onclick="openModal(${b.id})">Mehr erfahren →</button>
            </div>
        </div>`).join('');
}

function filterTab(kat, btn) {
    activeTab = kat;
    document.querySelectorAll('.tab-btn').forEach(t => t.classList.remove('active'));
    btn.classList.add('active');
    renderCards();
}

function filterCards() {
    searchVal = document.getElementById('searchInput').value;
    renderCards();
}

function toggleFav(btn) {
    const saved = btn.classList.toggle('saved');
    btn.textContent = saved ? '❤️' : '🤍';
}

function openModal(id) {
    const b = berufe.find(x => x.id === id);
    if (!b) return;
    document.getElementById('modalBox').innerHTML = `
        <div class="modal-hero-img">
            <img src="${b.img}" alt="${b.title}">
            <div class="modal-hero-overlay"></div>
            <button class="modal-hero-close" onclick="closeModal()">✕</button>
            <div class="modal-hero-info">
                <h2>${b.title}</h2>
                <p>${b.katLabel}</p>
            </div>
        </div>
        <div class="modal-inner">
            <div class="modal-meta-grid">
                <div class="modal-meta-item">
                    <div class="m-val">${b.dauer}</div>
                    <div class="m-lbl">Ausbildungsdauer</div>
                </div>
                <div class="modal-meta-item">
                    <div class="m-val">${b.gehalt}</div>
                    <div class="m-lbl">Vergütung / Monat</div>
                </div>
                <div class="modal-meta-item">
                    <div class="m-val">${b.abschluss}</div>
                    <div class="m-lbl">Schulabschluss</div>
                </div>
                <div class="modal-meta-item">
                    <div class="m-val">${b.stellen}</div>
                    <div class="m-lbl">Freie Stellen 🇩🇪</div>
                </div>
            </div>
            <div class="modal-section">
                <h4>Beschreibung</h4>
                <p>${b.desc}</p>
            </div>
            <div class="modal-section">
                <h4>📋 Zugangsvoraussetzungen</h4>
                <p>${b.condition}</p>
            </div>
            <div class="modal-section">
                <h4>Typische Aufgaben</h4>
                <ul class="modal-list">
                    ${b.aufgaben.map(a => `<li>${a}</li>`).join('')}
                </ul>
            </div>
            <div class="modal-section">
                <h4>Weiterbildung nach der Ausbildung</h4>
                <p>${b.weiter}</p>
            </div>
        </div>
        <div class="modal-cta">
            <button class="modal-btn-close" onclick="closeModal()">✕ Schließen</button>
        </div>`;
    document.getElementById('modalOverlay').classList.add('open');
}

function closeModal() {
    document.getElementById('modalOverlay').classList.remove('open');
}

function closeBg(e) {
    if (e.target === document.getElementById('modalOverlay')) closeModal();
}

renderCards();
</script>
@endpush