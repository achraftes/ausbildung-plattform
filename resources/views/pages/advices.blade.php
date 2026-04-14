@extends('layouts.app')
@section('title', 'Karrieretipps')

@push('styles')
<style>
    /* ══ HERO ══ */
    .adv-hero { background: #1a1a2e; padding: 4rem 1.5rem; text-align: center; }
    .adv-badge {
        display: inline-block; background: rgba(233,69,96,0.15);
        color: #e94560; border: 1px solid rgba(233,69,96,0.3);
        border-radius: 20px; padding: 6px 18px;
        font-size: 0.8rem; font-weight: 700; margin-bottom: 1.2rem;
    }
    .adv-hero h1 {
        font-family: 'Sora', sans-serif;
        font-size: clamp(1.8rem, 4vw, 2.6rem);
        font-weight: 800; color: #fff; margin-bottom: 0.7rem;
    }
    .adv-hero h1 span { color: #e94560; }
    .adv-hero p { color: rgba(255,255,255,0.55); font-size: 1rem; max-width: 520px; margin: 0 auto 2rem; }
    .search-wrap { max-width: 500px; margin: 0 auto; position: relative; }
    .search-wrap input {
        width: 100%; padding: 14px 20px 14px 48px;
        border-radius: 12px; border: none; outline: none;
        font-size: 0.95rem; font-family: inherit;
        box-shadow: 0 4px 20px rgba(0,0,0,0.15);
    }
    .search-wrap .s-ico {
        position: absolute; left: 16px; top: 50%;
        transform: translateY(-50%); font-size: 1.1rem; pointer-events: none;
    }

    /* ══ MAIN ══ */
    .adv-main { max-width: 1100px; margin: 0 auto; padding: 3rem 1.5rem; }

    /* ══ TOP TIP ══ */
    .top-tip {
        background: #1a1a2e; border-radius: 18px;
        display: grid; grid-template-columns: 1.2fr 1fr;
        overflow: hidden; margin-bottom: 3rem;
    }
    .top-tip-img { height: 280px; overflow: hidden; }
    .top-tip-img img { width: 100%; height: 100%; object-fit: cover; }
    .top-tip-body { padding: 2rem; display: flex; flex-direction: column; justify-content: center; }
    .top-tip-badge {
        display: inline-block; background: #e94560; color: #fff;
        border-radius: 6px; padding: 3px 12px;
        font-size: 0.75rem; font-weight: 700; margin-bottom: 1rem;
    }
    .top-tip-body h2 {
        font-family: 'Sora', sans-serif;
        font-size: 1.4rem; font-weight: 800;
        color: #fff; margin-bottom: 0.8rem; line-height: 1.3;
    }
    .top-tip-body p { color: rgba(255,255,255,0.6); font-size: 0.875rem; line-height: 1.7; margin-bottom: 1.2rem; }
    .top-tip-meta { display: flex; align-items: center; gap: 12px; }
    .cat-pill {
        background: rgba(233,69,96,0.2); color: #e94560;
        border-radius: 6px; padding: 3px 10px;
        font-size: 0.75rem; font-weight: 700;
    }
    .time-pill { color: rgba(255,255,255,0.4); font-size: 0.78rem; }
    @media(max-width:768px) { .top-tip { grid-template-columns: 1fr; } }

    /* ══ TABS ══ */
    .tabs-wrap { display: flex; gap: 6px; flex-wrap: wrap; margin-bottom: 2rem; }
    .tab-btn {
        padding: 8px 18px; border-radius: 20px;
        border: 1.5px solid #e9ecef; background: #fff;
        font-size: 0.825rem; font-weight: 600;
        cursor: pointer; color: #6c757d;
        font-family: inherit; transition: all 0.15s;
    }
    .tab-btn:hover { border-color: #e94560; color: #e94560; }
    .tab-btn.active { background: #e94560; color: #fff; border-color: #e94560; }

    /* ══ CARDS GRID ══ */
    .cards-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 20px;
    }
    .adv-card {
        background: #fff; border-radius: 16px;
        border: 1px solid #e9ecef; overflow: hidden;
        transition: transform 0.2s;
    }
    .adv-card:hover { transform: translateY(-4px); }
    .adv-card-img { height: 180px; overflow: hidden; position: relative; }
    .adv-card-img img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.3s; }
    .adv-card:hover .adv-card-img img { transform: scale(1.04); }
    .adv-card-img-overlay { position: absolute; inset: 0; background: rgba(26,26,46,0.25); }
    .adv-card-cat {
        position: absolute; top: 12px; left: 12px;
        background: #e94560; color: #fff;
        border-radius: 6px; padding: 3px 10px;
        font-size: 0.72rem; font-weight: 700;
    }
    .adv-card-body { padding: 1.3rem; }
    .adv-card-title { font-size: 0.95rem; font-weight: 700; margin-bottom: 6px; line-height: 1.4; }
    .adv-card-text { font-size: 0.825rem; color: #6c757d; line-height: 1.6; margin-bottom: 14px;
        display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden;
    }
    .adv-card-footer { display: flex; align-items: center; justify-content: space-between; }
    .adv-time { font-size: 0.78rem; color: #aaa; }
    .btn-lesen {
        padding: 8px 16px; border-radius: 8px;
        border: 1.5px solid #e9ecef; background: #fff;
        font-size: 0.8rem; font-weight: 600;
        cursor: pointer; color: #1a1a2e;
        font-family: inherit; transition: all 0.15s;
    }
    .btn-lesen:hover { border-color: #e94560; color: #e94560; }

    /* ══ MODAL ══ */
    .modal-overlay {
        display: none; position: fixed; inset: 0;
        background: rgba(0,0,0,0.6); z-index: 9999;
        align-items: center; justify-content: center; padding: 1rem;
    }
    .modal-overlay.open { display: flex; }
    .modal-box {
        background: #fff; border-radius: 20px;
        max-width: 640px; width: 100%;
        max-height: 90vh; overflow-y: auto;
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

    /* ══ YOUTUBE SECTION ══ */
    .yt-section { background: #0f0f1e; padding: 4.5rem 1.5rem; }
    .yt-inner { max-width: 1100px; margin: 0 auto; }
    .yt-header { text-align: center; margin-bottom: 2.5rem; }
    .yt-header h2 {
        font-family: 'Sora', sans-serif;
        font-size: 1.6rem; font-weight: 800; color: #fff; margin-bottom: 0.5rem;
    }
    .yt-header p { color: rgba(255,255,255,0.45); font-size: 0.9rem; }
    .yt-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 16px;
    }
    .yt-card {
        background: rgba(255,255,255,0.06);
        border: 1px solid rgba(255,255,255,0.1);
        border-radius: 14px; padding: 1.3rem;
        text-decoration: none;
        display: flex; gap: 14px; align-items: flex-start;
        transition: all 0.2s;
    }
    .yt-card:hover {
        background: rgba(255,0,0,0.1);
        border-color: rgba(255,0,0,0.3);
        transform: translateY(-2px);
    }
    .yt-thumb {
        width: 56px; height: 56px; border-radius: 12px;
        overflow: hidden; flex-shrink: 0; border: 2px solid rgba(255,255,255,0.1);
    }
    .yt-thumb img { width: 100%; height: 100%; object-fit: cover; }
    .yt-info { flex: 1; }
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
    .yt-play {
        color: rgba(255,255,255,0.3); font-size: 1.2rem;
        align-self: center; transition: color 0.15s;
    }
    .yt-card:hover .yt-play { color: #ff4444; }
    .yt-note {
        text-align: center; margin-top: 2rem;
        color: rgba(255,255,255,0.2); font-size: 0.78rem;
    }

    /* ══ CTA ══ */
    .cta-section { background: #e94560; padding: 4rem 1.5rem; text-align: center; }
    .cta-section h2 { font-family: 'Sora', sans-serif; font-size: 1.8rem; color: #fff; font-weight: 700; margin-bottom: 0.8rem; }
    .cta-section p { color: rgba(255,255,255,0.85); margin-bottom: 2rem; }
    .btn-cta { background: #fff; color: #e94560; padding: 14px 36px; border-radius: 10px; font-weight: 700; font-size: 1rem; text-decoration: none; }

    .empty-msg { grid-column: 1 / -1; text-align: center; padding: 3rem; color: #aaa; }
</style>
@endpush

@section('content')

{{-- ════ HERO ════ --}}
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

    {{-- ════ TOP TIPP ════ --}}
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

    {{-- ════ TABS ════ --}}
    <div class="tabs-wrap" id="tabsWrap">
        @foreach($categories as $key => $cat)
            <button class="tab-btn {{ $key === 'alle' ? 'active' : '' }}"
                    onclick="filterTab('{{ $key }}', this)">
                {{ $cat['icon'] }} {{ $cat['label'] }}
            </button>
        @endforeach
    </div>

    {{-- ════ CARDS ════ --}}
    <div class="cards-grid" id="cardsGrid">
        @forelse($advices as $adv)
            <div class="adv-card"
                 data-kat="{{ $adv->categorie }}"
                 data-titre="{{ strtolower($adv->titre) }}">
                <div class="adv-card-img">
                    <img src="{{ $adv->image }}" alt="{{ $adv->titre }}" loading="lazy">
                    <div class="adv-card-img-overlay"></div>
                    <span class="adv-card-cat">{{ ucfirst($adv->categorie) }}</span>
                </div>
                <div class="adv-card-body">
                    <div class="adv-card-title">{{ $adv->titre }}</div>
                    <div class="adv-card-text">{{ $adv->contenu }}</div>
                    <div class="adv-card-footer">
                        <span class="adv-time">⏱ {{ $adv->temps_lecture }}</span>
                        <button class="btn-lesen"
                                onclick="openModal(
                                    '{{ addslashes($adv->titre) }}',
                                    '{{ addslashes($adv->contenu) }}',
                                    '{{ $adv->image }}',
                                    '{{ ucfirst($adv->categorie) }}',
                                    '{{ $adv->temps_lecture }}'
                                )">
                            Mehr lesen →
                        </button>
                    </div>
                </div>
            </div>
        @empty
            <div class="empty-msg">😕 Keine Tipps gefunden.</div>
        @endforelse
    </div>

</div>

{{-- ════ YOUTUBE DEUTSCH LERNEN ════ --}}
<section class="yt-section">
    <div class="yt-inner">
        <div class="yt-header">
            <h2>🎬 Deutsch lernen auf YouTube</h2>
            <p>Die besten kostenlosen Kanäle um dein Deutsch für die Ausbildung und Bewerbung zu verbessern</p>
        </div>
        <div class="yt-grid">
            @foreach($youtubeChannels as $yt)
                <a class="yt-card" href="{{ $yt['url'] }}" target="_blank" rel="noopener">
                    <div class="yt-thumb">
                        <img src="{{ $yt['thumbnail'] }}" alt="{{ $yt['name'] }}"
                             onerror="this.src='https://img.youtube.com/vi/default/mqdefault.jpg'">
                    </div>
                    <div class="yt-info">
                        <div class="yt-name">{{ $yt['name'] }}</div>
                        <div class="yt-desc">{{ $yt['description'] }}</div>
                        <div class="yt-meta">
                            <span class="yt-badge" style="background:{{ $yt['badge_color'] }}">{{ $yt['badge'] }}</span>
                            <span class="yt-sub">👥 {{ $yt['subscribers'] }}</span>
                            <span class="yt-niveau">📊 {{ $yt['niveau'] }}</span>
                        </div>
                    </div>
                    <div class="yt-play">▶</div>
                </a>
            @endforeach
        </div>
        <p class="yt-note">
            🔗 Alle Links führen direkt zu YouTube. CareerHub ist nicht mit diesen Kanälen verbunden.
        </p>
    </div>
</section>

{{-- ════ CTA ════ --}}
@guest
<section class="cta-section">
    <h2>Bereit für deine Bewerbung?</h2>
    <p>Erstelle jetzt deinen professionellen deutschen Lebenslauf — kostenlos und in wenigen Minuten.</p>
    <a href="{{ route('register') }}" class="btn-cta">Lebenslauf erstellen →</a>
</section>
@endguest

{{-- ════ MODAL ════ --}}
<div class="modal-overlay" id="modalOverlay" onclick="closeBg(event)">
    <div class="modal-box" id="modalBox"></div>
</div>

@endsection

@push('scripts')
<script>
let activeTab = 'alle';

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
    const cards  = document.querySelectorAll('.adv-card');
    let visible  = 0;

    cards.forEach(card => {
        const katOk    = activeTab === 'alle' || card.dataset.kat === activeTab;
        const searchOk = card.dataset.titre.includes(search);
        card.style.display = (katOk && searchOk) ? 'block' : 'none';
        if (katOk && searchOk) visible++;
    });

    const grid = document.getElementById('cardsGrid');
    const existing = grid.querySelector('.empty-js');
    if (visible === 0) {
        if (!existing) {
            const div = document.createElement('div');
            div.className = 'empty-msg empty-js';
            div.style.gridColumn = '1/-1';
            div.textContent = '😕 Kein Tipp gefunden. Versuche eine andere Suche.';
            grid.appendChild(div);
        }
    } else {
        if (existing) existing.remove();
    }
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
</script>
@endpush