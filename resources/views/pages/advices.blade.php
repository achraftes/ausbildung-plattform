@extends('layouts.app')
@section('title', 'Karrieretipps')

@push('styles')
<style>   
    .yt-card-video {
        background: rgba(255,255,255,0.06);
        border: 1px solid rgba(255,255,255,0.1);
        border-radius: 14px;
        overflow: hidden;
        transition: 0.2s;
    }

    .yt-card-video:hover {
        transform: translateY(-4px);
    }

    /* HERO */
    .adv-hero { 
        background: #1a1a2e; 
        padding: 4rem 1.5rem; 
        text-align: center; 
    }
    
    .adv-badge {
        display: inline-block; 
        background: rgba(233,69,96,0.15);
        color: #e94560; 
        border: 1px solid rgba(233,69,96,0.3);
        border-radius: 20px; 
        padding: 6px 18px;
        font-size: 0.8rem; 
        font-weight: 700; 
        margin-bottom: 1.2rem;
    }
    
    .adv-hero h1 {
        font-family: 'Sora', sans-serif;
        font-size: clamp(1.8rem, 4vw, 2.6rem);
        font-weight: 800; 
        color: #fff; 
        margin-bottom: 0.7rem;
    }
    
    .adv-hero h1 span { color: #e94560; }
    .adv-hero p { color: rgba(255,255,255,0.55); font-size: 1rem; max-width: 520px; margin: 0 auto 2rem; }
    
    .search-wrap { 
        max-width: 500px; 
        margin: 0 auto; 
        position: relative; 
    }
    
    .search-wrap input {
        width: 100%; 
        padding: 14px 20px 14px 48px;
        border-radius: 12px; 
        border: none; 
        outline: none;
        font-size: 0.95rem; 
        font-family: inherit;
        box-shadow: 0 4px 20px rgba(0,0,0,0.15);
    }
    
    .search-wrap .s-ico {
        position: absolute; 
        left: 16px; 
        top: 50%;
        transform: translateY(-50%); 
        font-size: 1.1rem; 
        pointer-events: none;
    }

    /* MAIN */
    .adv-main { 
        max-width: 1200px; 
        margin: 0 auto; 
        padding: 3rem 1.5rem; 
    }

    /* TOP TIP - bleibt oben */
    .top-tip {
        background: #1a1a2e; 
        border-radius: 18px;
        display: grid; 
        grid-template-columns: 1.2fr 1fr;
        overflow: hidden; 
        margin-bottom: 3rem;
    }
    
    .top-tip-img { height: 280px; overflow: hidden; }
    .top-tip-img img { width: 100%; height: 100%; object-fit: cover; }
    .top-tip-body { padding: 2rem; display: flex; flex-direction: column; justify-content: center; }
    .top-tip-badge {
        display: inline-block; 
        background: #e94560; 
        color: #fff;
        border-radius: 6px; 
        padding: 3px 12px;
        font-size: 0.75rem; 
        font-weight: 700; 
        margin-bottom: 1rem;
    }
    .top-tip-body h2 {
        font-family: 'Sora', sans-serif;
        font-size: 1.4rem; 
        font-weight: 800;
        color: #fff; 
        margin-bottom: 0.8rem; 
        line-height: 1.3;
    }
    .top-tip-body p { color: rgba(255,255,255,0.6); font-size: 0.875rem; line-height: 1.7; margin-bottom: 1.2rem; }
    .top-tip-meta { display: flex; align-items: center; gap: 12px; }
    .cat-pill {
        background: rgba(233,69,96,0.2); 
        color: #e94560;
        border-radius: 6px; 
        padding: 3px 10px;
        font-size: 0.75rem; 
        font-weight: 700;
    }
    .time-pill { color: rgba(255,255,255,0.4); font-size: 0.78rem; }
    
    @media(max-width:768px) { 
        .top-tip { grid-template-columns: 1fr; } 
    }

    /* TABS */
    .tabs-wrap { 
        display: flex; 
        gap: 6px; 
        flex-wrap: wrap; 
        margin-bottom: 2rem; 
    }
    
    .tab-btn {
        padding: 8px 18px; 
        border-radius: 20px;
        border: 1.5px solid #e9ecef; 
        background: #fff;
        font-size: 0.825rem; 
        font-weight: 600;
        cursor: pointer; 
        color: #6c757d;
        font-family: inherit; 
        transition: all 0.15s;
    }
    
    .tab-btn:hover { border-color: #e94560; color: #e94560; }
    .tab-btn.active { background: #e94560; color: #fff; border-color: #e94560; }

    /* LAYOUT: Große Karte links + kleine Karten rechts */
    .cards-container {
        display: flex;
        gap: 24px;
        align-items: flex-start;
    }

    /* Linke Seite: Große Karte */
    .cards-main {
        flex: 1.2;
        position: sticky;
        top: 20px;
    }

    .cards-side {
        flex: 0.8;
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    /* Große Karte */
    .adv-card-large {
        background: #fff;
        border-radius: 20px;
        border: 1px solid #e9ecef;
        overflow: hidden;
        transition: transform 0.2s, box-shadow 0.2s;
        box-shadow: 0 5px 15px rgba(0,0,0,0.08);
    }

    .adv-card-large:hover {
        transform: translateY(-4px);
        box-shadow: 0 15px 35px rgba(0,0,0,0.12);
    }

    .adv-card-large-img {
        height: 280px;
        overflow: hidden;
        position: relative;
    }

    .adv-card-large-img img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s;
    }

    .adv-card-large:hover .adv-card-large-img img {
        transform: scale(1.05);
    }

    .adv-card-large-cat {
        position: absolute;
        top: 15px;
        left: 15px;
        background: #e94560;
        color: #fff;
        border-radius: 8px;
        padding: 5px 14px;
        font-size: 0.75rem;
        font-weight: 700;
        z-index: 2;
    }

    .adv-card-large-body {
        padding: 1.5rem;
    }

    .adv-card-large-title {
        font-size: 1.3rem;
        font-weight: 800;
        margin-bottom: 12px;
        line-height: 1.3;
        color: #1a1a2e;
    }

    .adv-card-large-text {
        font-size: 0.9rem;
        color: #6c757d;
        line-height: 1.7;
        margin-bottom: 20px;
        display: -webkit-box;
        -webkit-line-clamp: 4;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    /* Button Style für große Karte */
    .btn-large {
        padding: 10px 24px;
        border-radius: 30px;
        border: 1.5px solid #e94560;
        background: transparent;
        font-size: 0.85rem;
        font-weight: 600;
        cursor: pointer;
        color: #e94560;
        font-family: inherit;
        transition: all 0.3s;
    }

    .btn-large:hover {
        background: #e94560;
        color: #fff;
        transform: translateX(4px);
    }

    /* Kleine Karten (rechte Seite) */
    .adv-card-small {
        background: #fff;
        border-radius: 16px;
        border: 1px solid #e9ecef;
        overflow: hidden;
        transition: all 0.2s;
        display: flex;
        gap: 12px;
        padding: 12px;
    }

    .adv-card-small:hover {
        transform: translateX(4px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.08);
        border-color: #e94560;
    }

    .adv-card-small-img {
        width: 90px;
        height: 90px;
        flex-shrink: 0;
        border-radius: 12px;
        overflow: hidden;
    }

    .adv-card-small-img img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s;
    }

    .adv-card-small:hover .adv-card-small-img img {
        transform: scale(1.1);
    }

    .adv-card-small-body {
        flex: 1;
        display: flex;
        flex-direction: column;
    }

    .adv-card-small-cat {
        display: inline-block;
        background: rgba(233,69,96,0.12);
        color: #e94560;
        border-radius: 6px;
        padding: 2px 10px;
        font-size: 0.65rem;
        font-weight: 700;
        margin-bottom: 6px;
        width: fit-content;
    }

    .adv-card-small-title {
        font-size: 0.85rem;
        font-weight: 700;
        margin-bottom: 6px;
        line-height: 1.4;
        color: #1a1a2e;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .adv-card-small-text {
        font-size: 0.7rem;
        color: #6c757d;
        line-height: 1.5;
        margin-bottom: 8px;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .adv-card-small-footer {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-top: auto;
    }

    .adv-time-small {
        font-size: 0.65rem;
        color: #aaa;
    }

    /* Button Style für kleine Karte */
    .btn-small {
        padding: 5px 14px;
        border-radius: 20px;
        border: 1.5px solid #e94560;
        background: transparent;
        font-size: 0.7rem;
        font-weight: 600;
        cursor: pointer;
        color: #e94560;
        font-family: inherit;
        transition: all 0.2s;
    }

    .btn-small:hover {
        background: #e94560;
        color: #fff;
        transform: translateX(3px);
    }

    /* Responsive */
    @media (max-width: 900px) {
        .cards-container {
            flex-direction: column;
        }
        
        .cards-main {
            position: static;
        }
        
        .adv-card-large-img {
            height: 220px;
        }
    }

    /* MODAL */
    .modal-overlay {
        display: none; 
        position: fixed; 
        inset: 0;
        background: rgba(0,0,0,0.6); 
        z-index: 9999;
        align-items: center; 
        justify-content: center; 
        padding: 1rem;
    }
    
    .modal-overlay.open { display: flex; }
    
    .modal-box {
        background: #fff; 
        border-radius: 20px;
        max-width: 640px; 
        width: 100%;
        max-height: 90vh; 
        overflow-y: auto;
    }
    
    .modal-img { height: 220px; overflow: hidden; position: relative; }
    .modal-img img { width: 100%; height: 100%; object-fit: cover; }
    .modal-img-ov { position: absolute; inset: 0; background: rgba(26,26,46,0.5); }
    .modal-close {
        position: absolute; top: 12px; right: 14px;
        background: rgba(255,255,255,0.9); border: none;
        border-radius: 8px; width: 34px; height: 34px;
        display: flex; align-items: center; justify-content: center;
        cursor: pointer; font-size: 1rem; font-weight: 700;
    }
    .modal-title-over { position: absolute; bottom: 16px; left: 20px; right: 60px; }
    .modal-title-over h2 { color: #fff; font-size: 1.2rem; font-weight: 800; line-height: 1.3; }
    .modal-title-over p { color: rgba(255,255,255,0.6); font-size: 0.8rem; margin-top: 4px; }
    .modal-body { padding: 1.5rem; }
    .modal-body p { font-size: 0.9rem; color: #444; line-height: 1.8; }
    .modal-footer { padding: 0 1.5rem 1.5rem; }
    .modal-close-btn {
        width: 100%; padding: 13px; background: #1a1a2e; color: #fff;
        border: none; border-radius: 12px; font-size: 0.9rem;
        font-weight: 600; cursor: pointer; font-family: inherit;
    }
    .modal-close-btn:hover { background: #2d2d4e; }

    /* YOUTUBE SECTION */
    .yt-section { background: #0f0f1e; padding: 4.5rem 1.5rem; }
    .yt-inner { max-width: 1100px; margin: 0 auto; }
    .yt-header { text-align: center; margin-bottom: 2.5rem; }
    .yt-header h2 {
        font-family: 'Sora', sans-serif;
        font-size: 1.6rem; 
        font-weight: 800; 
        color: #fff; 
        margin-bottom: 0.5rem;
    }
    .yt-header p { color: rgba(255,255,255,0.7); font-size: 0.9rem; }
    .yt-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 16px;
    }
    .yt-card-video iframe {
        width: 100%;
        height: 200px;
        border: none;
    }
    .yt-info { padding: 1rem; }
    .yt-name { color: #fff; font-size: 0.9rem; font-weight: 700; margin-bottom: 4px; }
    .yt-desc { color: rgba(255,255,255,0.45); font-size: 0.78rem; line-height: 1.5; margin-bottom: 8px; }
    .yt-meta { display: flex; gap: 8px; flex-wrap: wrap; }
    .yt-badge {
        border-radius: 5px; padding: 2px 9px;
        font-size: 0.7rem; font-weight: 700; color: #fff;
    }
    .yt-sub {
        background: rgba(255,255,255,0.1); color: rgba(255,255,255,0.6);
        border-radius: 5px; padding: 2px 9px; font-size: 0.7rem; font-weight: 600;
    }
    .yt-niveau {
        background: rgba(255,255,255,0.08); color: rgba(255,255,255,0.5);
        border-radius: 5px; padding: 2px 9px; font-size: 0.7rem;
    }
    .yt-note {
        text-align: center; margin-top: 2rem;
        color: rgba(255,255,255,0.5); font-size: 0.78rem;
    }

    /* CTA */
    .cta-section { background: #e94560; padding: 4rem 1.5rem; text-align: center; }
    .cta-section h2 { font-family: 'Sora', sans-serif; font-size: 1.8rem; color: #fff; font-weight: 700; margin-bottom: 0.8rem; }
    .cta-section p { color: rgba(255,255,255,0.85); margin-bottom: 2rem; }
    .btn-cta { background: #fff; color: #e94560; padding: 14px 36px; border-radius: 10px; font-weight: 700; font-size: 1rem; text-decoration: none; }

    .empty-msg { text-align: center; padding: 3rem; color: #aaa; }
    
    /* Footer für große Karte */
    .card-footer-large {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 10px;
    }
</style>
@endpush

@section('content')

{{-- HERO --}}
<section class="adv-hero">
    <div class="adv-badge">💡 Karriere & Bewerbung</div>
    <h1>Deine <span>Karrieretipps</span> für Deutschland</h1>
    <p>Professionelle Tipps für Lebenslauf, Anschreiben, Vorstellungsgespräch und mehr — alles auf Deutsch.</p>
    <div class="search-wrap">
        <span class="s-ico">🔍</span>
        <input type="text" id="searchInput"
               placeholder="Tipp suchen... z.B. Lebenslauf, Interview"
               oninput="filterCards()">
    </div>
</section>

<div class="adv-main">

    {{-- TOP TIPP --}}
    @if($topAdvice)
    <div class="top-tip">
        <div class="top-tip-img">
            <img src="{{ $topAdvice->image }}" alt="{{ $topAdvice->titre }}">
        </div>
        <div class="top-tip-body">
            <span class="top-tip-badge">⭐ Tipp der Woche</span>
            <h2>{{ $topAdvice->titre }}</h2>
            <p>{{ Str::limit($topAdvice->contenu, 180) }}</p>
            <div class="top-tip-meta">
                <span class="cat-pill">{{ ucfirst($topAdvice->categorie) }}</span>
                <span class="time-pill">⏱ {{ $topAdvice->temps_lecture }}</span>
            </div>
        </div>
    </div>
    @endif

    {{-- TABS --}}
    <div class="tabs-wrap" id="tabsWrap">
        @foreach($categories as $key => $cat)
            <button class="tab-btn {{ $key === 'alle' ? 'active' : '' }}"
                    onclick="filterTab('{{ $key }}', this)">
                {{ $cat['icon'] }} {{ $cat['label'] }}
            </button>
        @endforeach
    </div>

    {{-- LAYOUT: Große Karte links + kleine Karten rechts --}}
    <div class="cards-container" id="cardsContainer">
        <div class="cards-main" id="mainCardArea">
            <!-- Hier wird die erste/große Karte dynamisch angezeigt -->
        </div>
        <div class="cards-side" id="sideCardsArea">
            <!-- Hier kommen die restlichen kleinen Karten -->
        </div>
    </div>

</div>

{{-- YOUTUBE SECTION --}}
<section class="yt-section">
    <div class="yt-inner">
        <div class="yt-header">
            <h2>🎬 Deutsch lernen auf YouTube</h2>
            <p>Die besten kostenlosen Kanäle um dein Deutsch für die Ausbildung und Bewerbung zu verbessern</p>
        </div>
        <div class="yt-grid">
            @foreach($youtubeChannels as $yt)
            <div class="yt-card-video">
                <iframe
                    src="https://www.youtube.com/embed/{{ $yt['video_id'] }}"
                    title="{{ $yt['name'] }}"
                    frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen>
                </iframe>
                <div class="yt-info">
                    <div class="yt-name">{{ $yt['name'] }}</div>
                    <div class="yt-desc">{{ $yt['description'] }}</div>
                    <div class="yt-meta">
                        <span class="yt-badge" style="background:{{ $yt['badge_color'] }}">
                            {{ $yt['badge'] }}
                        </span>
                        <span class="yt-sub">👥 {{ $yt['subscribers'] }}</span>
                        <span class="yt-niveau">📊 {{ $yt['niveau'] }}</span>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <p class="yt-note">
            🔗 Alle Links führen direkt zu YouTube. CareerHub ist nicht mit diesen Kanälen verbunden.
        </p>
    </div>
</section>

{{-- CTA --}}
@guest
<section class="cta-section">
    <h2>Bereit für deine Bewerbung?</h2>
    <p>Erstelle jetzt deinen professionellen deutschen Lebenslauf — kostenlos und in wenigen Minuten.</p>
    <a href="{{ route('register') }}" class="btn-cta">Lebenslauf erstellen →</a>
</section>
@endguest

{{-- MODAL --}}
<div class="modal-overlay" id="modalOverlay" onclick="closeBg(event)">
    <div class="modal-box" id="modalBox"></div>
</div>

@endsection

@push('scripts')
<script>
let activeTab = 'alle';
let allAdvices = @json($advices);

function filterTab(kat, btn) {
    activeTab = kat;
    document.querySelectorAll('.tab-btn').forEach(t => t.classList.remove('active'));
    btn.classList.add('active');
    applyFilter();
}

function filterCards() {
    applyFilter();
}

function applyFilter() {
    const search = document.getElementById('searchInput').value.toLowerCase();
    
    // Filter die Karten basierend auf Tab und Suche
    let filtered = allAdvices.filter(adv => {
        const katOk = activeTab === 'alle' || adv.categorie === activeTab;
        const searchOk = adv.titre.toLowerCase().includes(search);
        return katOk && searchOk;
    });
    
    // Layout neu rendern
    renderLayout(filtered);
}

function renderLayout(advices) {
    const mainArea = document.getElementById('mainCardArea');
    const sideArea = document.getElementById('sideCardsArea');
    
    if (!advices || advices.length === 0) {
        mainArea.innerHTML = '<div class="empty-msg">😕 Kein Tipp gefunden. Versuche eine andere Suche.</div>';
        sideArea.innerHTML = '';
        return;
    }
    
    // Erste Karte = große Karte (links)
    const firstAdv = advices[0];
    const remainingAdvices = advices.slice(1);
    
    // Große Karte rendern mit schönem Button
    mainArea.innerHTML = `
        <div class="adv-card-large" data-kat="${firstAdv.categorie}">
            <div class="adv-card-large-img">
                <img src="${firstAdv.image}" alt="${firstAdv.titre}" loading="lazy">
                <span class="adv-card-large-cat">${firstAdv.categorie.charAt(0).toUpperCase() + firstAdv.categorie.slice(1)}</span>
            </div>
            <div class="adv-card-large-body">
                <div class="adv-card-large-title">${escapeHtml(firstAdv.titre)}</div>
                <div class="adv-card-large-text">${escapeHtml(firstAdv.contenu)}</div>
                <div class="card-footer-large">
                    <span class="adv-time">⏱ ${firstAdv.temps_lecture}</span>
                    <button class="btn-large" onclick="openModal(
                        '${escapeHtml(firstAdv.titre)}',
                        '${escapeHtml(firstAdv.contenu)}',
                        '${firstAdv.image}',
                        '${firstAdv.categorie.charAt(0).toUpperCase() + firstAdv.categorie.slice(1)}',
                        '${firstAdv.temps_lecture}'
                    )">
                        Mehr lesen →
                    </button>
                </div>
            </div>
        </div>
    `;
    
    // Kleine Karten rendern (rechte Seite) mit schönem Button
    if (remainingAdvices.length === 0) {
        sideArea.innerHTML = '<div class="empty-msg" style="padding: 2rem;">Keine weiteren Tipps</div>';
        return;
    }
    
    sideArea.innerHTML = remainingAdvices.map(adv => `
        <div class="adv-card-small" data-kat="${adv.categorie}">
            <div class="adv-card-small-img">
                <img src="${adv.image}" alt="${adv.titre}" loading="lazy">
            </div>
            <div class="adv-card-small-body">
                <span class="adv-card-small-cat">${adv.categorie.charAt(0).toUpperCase() + adv.categorie.slice(1)}</span>
                <div class="adv-card-small-title">${escapeHtml(adv.titre)}</div>
                <div class="adv-card-small-text">${escapeHtml(adv.contenu.substring(0, 80))}...</div>
                <div class="adv-card-small-footer">
                    <span class="adv-time-small">⏱ ${adv.temps_lecture}</span>
                    <button class="btn-small" onclick="openModal(
                        '${escapeHtml(adv.titre)}',
                        '${escapeHtml(adv.contenu)}',
                        '${adv.image}',
                        '${adv.categorie.charAt(0).toUpperCase() + adv.categorie.slice(1)}',
                        '${adv.temps_lecture}'
                    )">
                        Lesen →
                    </button>
                </div>
            </div>
        </div>
    `).join('');
}

function escapeHtml(str) {
    if (!str) return '';
    return str.replace(/[&<>]/g, function(m) {
        if (m === '&') return '&amp;';
        if (m === '<') return '&lt;';
        if (m === '>') return '&gt;';
        return m;
      }).replace(/[\uD800-\uDBFF][\uDC00-\uDFFF]/g, function(c) {
        return c;
      }).replace(/'/g, "\\'").replace(/"/g, '&quot;');
}

function openModal(titre, contenu, image, cat, temps) {
    document.getElementById('modalBox').innerHTML = `
        <div class="modal-img">
            <img src="${image}" alt="${titre}">
            <div class="modal-img-ov"></div>
            <button class="modal-close" onclick="closeModal()">✕</button>
            <div class="modal-title-over">
                <h2>${titre}</h2>
                <p>${cat} &nbsp;|&nbsp; ⏱ ${temps}</p>
            </div>
        </div>
        <div class="modal-body">
            <p>${contenu}</p>
        </div>
        <div class="modal-footer">
            <button class="modal-close-btn" onclick="closeModal()">✕ Schließen</button>
        </div>`;
    document.getElementById('modalOverlay').classList.add('open');
}

function closeModal() {
    document.getElementById('modalOverlay').classList.remove('open');
}

function closeBg(e) {
    if (e.target === document.getElementById('modalOverlay')) closeModal();
}

// Initial render
document.addEventListener('DOMContentLoaded', function() {
    renderLayout(allAdvices);
});
</script>
@endpush