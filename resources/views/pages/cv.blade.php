@extends('layouts.app')
@section('title', 'Lebenslauf erstellen')

@push('styles')
<style>
    /* ══ HERO ══ */
    .cv-hero { background: #1a1a2e; padding: 4.5rem 1.5rem; text-align: center; }
    .cv-badge {
        display: inline-block; background: rgba(233,69,96,0.15);
        color: #e94560; border: 1px solid rgba(233,69,96,0.3);
        border-radius: 20px; padding: 6px 18px;
        font-size: 0.8rem; font-weight: 700; margin-bottom: 1.2rem;
    }
    .cv-hero h1 {
        font-family: 'Sora', sans-serif;
        font-size: clamp(1.8rem, 4vw, 2.8rem);
        font-weight: 800; color: #fff;
        line-height: 1.2; margin-bottom: 0.8rem;
    }
    .cv-hero h1 span { color: #e94560; }
    .cv-hero p { color: rgba(255,255,255,0.55); font-size: 1rem; max-width: 580px; margin: 0 auto 2rem; }
    .cv-hero-btns { display: flex; gap: 12px; justify-content: center; flex-wrap: wrap; margin-bottom: 2rem; }
    .btn-cv-primary {
        background: #e94560; color: #fff; padding: 14px 32px;
        border-radius: 10px; font-size: 0.95rem; font-weight: 700;
        text-decoration: none; border: none; cursor: pointer; transition: background 0.2s;
    }
    .btn-cv-primary:hover { background: #c73652; }
    .btn-cv-outline {
        background: rgba(255,255,255,0.1); color: #fff;
        border: 1.5px solid rgba(255,255,255,0.2);
        padding: 13px 30px; border-radius: 10px;
        font-size: 0.95rem; font-weight: 600; text-decoration: none;
    }
    .trust-bar {
        display: flex; justify-content: center; gap: 2rem;
        flex-wrap: wrap; padding-top: 1.5rem;
        border-top: 1px solid rgba(255,255,255,0.08);
    }
    .trust-item { color: rgba(255,255,255,0.45); font-size: 0.8rem; display: flex; align-items: center; gap: 5px; }
    .trust-item strong { color: rgba(255,255,255,0.8); }

    /* ══ FEATURES STRIP ══ */
    .features-strip {
        background: #fff; border-bottom: 1px solid #e9ecef;
        padding: 1rem 1.5rem;
    }
    .features-strip-inner {
        max-width: 1100px; margin: 0 auto;
        display: flex; justify-content: center;
        gap: 2.5rem; flex-wrap: wrap;
    }
    .feat-item {
        display: flex; align-items: center; gap: 8px;
        font-size: 0.875rem; font-weight: 600; color: #1a1a2e;
    }

    /* ══ MAIN ══ */
    .cv-main { max-width: 1100px; margin: 0 auto; padding: 3.5rem 1.5rem; }
    .section-badge {
        display: inline-block; background: rgba(233,69,96,0.12);
        color: #e94560; border-radius: 6px; padding: 3px 12px;
        font-size: 0.75rem; font-weight: 700; margin-bottom: 0.6rem;
    }
    .sec-title { font-family: 'Sora', sans-serif; font-size: 1.6rem; font-weight: 700; margin-bottom: 0.4rem; text-align: center; }
    .sec-sub { color: #6c757d; font-size: 0.9rem; margin-bottom: 2.5rem; text-align: center; }

    /* ══ TEMPLATES ══ */
    .templates-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 20px; margin-bottom: 4rem;
    }
    .tpl-card {
        background: #fff; border-radius: 16px;
        border: 2px solid #e9ecef; overflow: hidden;
        cursor: pointer; transition: all 0.2s;
    }
    .tpl-card:hover { border-color: #e94560; transform: translateY(-4px); }
    .tpl-preview { height: 200px; position: relative; overflow: hidden; }
    .tpl-overlay {
        position: absolute; inset: 0;
        background: rgba(26,26,46,0); transition: 0.2s;
        display: flex; align-items: center; justify-content: center;
    }
    .tpl-card:hover .tpl-overlay { background: rgba(26,26,46,0.2); }
    .tpl-select-btn {
        background: #e94560; color: #fff; border: none;
        border-radius: 10px; padding: 12px 28px;
        font-size: 0.875rem; font-weight: 700;
        cursor: pointer; opacity: 0; transition: 0.2s;
        text-decoration: none; display: inline-block;
    }
    .tpl-card:hover .tpl-select-btn { opacity: 1; }
    .tpl-badge {
        position: absolute; top: 12px; left: 12px;
        border-radius: 6px; padding: 3px 10px;
        font-size: 0.72rem; font-weight: 700; color: #fff;
        z-index: 2;
    }
    .tpl-body { padding: 1.2rem; }
    .tpl-name { font-size: 1rem; font-weight: 700; margin-bottom: 4px; }
    .tpl-desc { font-size: 0.825rem; color: #6c757d; margin-bottom: 10px; }
    .tpl-tags { display: flex; gap: 6px; flex-wrap: wrap; }
    .tpl-tag { background: #f5f5f7; border-radius: 5px; padding: 3px 8px; font-size: 0.72rem; font-weight: 600; color: #6c757d; }

    /* ══ ATS SECTION ══ */
    .ats-section {
        background: #1a1a2e; border-radius: 20px;
        padding: 2.5rem; margin-bottom: 4rem;
        display: grid; grid-template-columns: 1fr 1fr;
        gap: 2.5rem; align-items: center;
    }
    .ats-tag { display: inline-block; background: rgba(233,69,96,0.2); color: #e94560; border-radius: 6px; padding: 3px 10px; font-size: 0.75rem; font-weight: 700; margin-bottom: 0.8rem; }
    .ats-left h2 { font-family: 'Sora', sans-serif; font-size: 1.4rem; font-weight: 800; color: #fff; margin-bottom: 0.8rem; line-height: 1.3; }
    .ats-left p { color: rgba(255,255,255,0.5); font-size: 0.875rem; line-height: 1.7; margin-bottom: 1.5rem; }
    .ats-features { display: flex; flex-direction: column; gap: 8px; margin-bottom: 1.5rem; }
    .ats-feat { display: flex; align-items: center; gap: 8px; color: rgba(255,255,255,0.7); font-size: 0.85rem; }
    .ats-feat::before { content: '✓'; color: #28a745; font-weight: 700; }
    .btn-ats {
        background: #e94560; color: #fff; border: none;
        border-radius: 10px; padding: 12px 26px;
        font-size: 0.9rem; font-weight: 700;
        cursor: pointer; font-family: inherit; transition: background 0.15s;
    }
    .btn-ats:hover { background: #c73652; }
    .ats-right { display: flex; flex-direction: column; align-items: center; gap: 1.5rem; }
    .ats-circle-wrap { position: relative; width: 120px; height: 120px; }
    .ats-circle {
        width: 120px; height: 120px; border-radius: 50%;
        border: 8px solid #e94560;
        display: flex; align-items: center; justify-content: center;
        flex-direction: column;
    }
    .ats-score-num { font-size: 2rem; font-weight: 800; color: #fff; }
    .ats-score-lbl { font-size: 0.72rem; color: rgba(255,255,255,0.4); }
    .ats-bars { width: 100%; display: flex; flex-direction: column; gap: 10px; }
    .ats-bar-row { display: flex; align-items: center; gap: 10px; }
    .ats-bar-label { font-size: 0.78rem; color: rgba(255,255,255,0.6); width: 80px; flex-shrink: 0; }
    .ats-track { flex: 1; height: 6px; background: rgba(255,255,255,0.1); border-radius: 3px; }
    .ats-fill { height: 6px; border-radius: 3px; transition: width 1s ease; }
    @media(max-width:768px) { .ats-section { grid-template-columns: 1fr; } }

    /* ══ MES CVS ══ */
    .my-cvs-section { margin-bottom: 3rem; }
    .my-cvs-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem; }
    .my-cvs-header h2 { font-family: 'Sora', sans-serif; font-size: 1.3rem; font-weight: 700; }
    .my-cvs-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(260px, 1fr)); gap: 16px; }
    .my-cv-card {
        background: #fff; border-radius: 14px;
        border: 1px solid #e9ecef; padding: 1.3rem;
        transition: transform 0.15s;
    }
    .my-cv-card:hover { transform: translateY(-2px); }
    .my-cv-top { display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 10px; }
    .my-cv-name { font-size: 0.95rem; font-weight: 700; }
    .my-cv-modele { font-size: 0.72rem; color: #aaa; margin-top: 2px; }
    .my-cv-ats { background: #d4edda; color: #155724; border-radius: 6px; padding: 3px 10px; font-size: 0.75rem; font-weight: 700; }
    .my-cv-date { font-size: 0.78rem; color: #aaa; margin-bottom: 12px; }
    .my-cv-actions { display: flex; gap: 6px; }
    .btn-sm { padding: 7px 12px; border-radius: 7px; font-size: 0.78rem; font-weight: 600; cursor: pointer; font-family: inherit; border: 1.5px solid #e9ecef; background: #fff; color: #1a1a2e; text-decoration: none; transition: all 0.15s; }
    .btn-sm:hover { border-color: #e94560; color: #e94560; }
    .btn-sm.danger { color: #e94560; }
    .btn-sm.danger:hover { background: #fff0f3; border-color: #e94560; }
    .btn-sm.primary { background: #e94560; color: #fff; border-color: #e94560; }
    .btn-sm.primary:hover { background: #c73652; }
</style>
@endpush

@section('content')

{{-- ════ HERO ════ --}}
<section class="cv-hero">
    <div class="cv-badge">📄 Lebenslauf-Generator</div>
    <h1>
        Erstelle deinen<br>
        <span>professionellen Lebenslauf</span><br>
        in wenigen Minuten
    </h1>
    <p>
        Wähle eine professionelle Vorlage nach deutschem Standard, fülle deine Daten aus
        und lade deinen Lebenslauf als PDF herunter — kostenlos und ohne Filigran.
    </p>
    <div class="cv-hero-btns">
        <a href="{{ route('cv.create') }}" class="btn-cv-primary">✨ Lebenslauf erstellen</a>
        <a href="#vorlagen" class="btn-cv-outline">📋 Vorlagen ansehen</a>
    </div>
    <div class="trust-bar">
        <span class="trust-item"><strong>✓</strong> Kostenlos</span>
        <span class="trust-item"><strong>✓</strong> ATS-optimiert</span>
        <span class="trust-item"><strong>✓</strong> PDF-Download</span>
        <span class="trust-item"><strong>✓</strong> Deutsches Format</span>
        <span class="trust-item"><strong>✓</strong> Kein Filigran</span>
    </div>
</section>

{{-- ════ FEATURES STRIP ════ --}}
<div class="features-strip">
    <div class="features-strip-inner">
        <div class="feat-item">🎯 ATS-Score prüfen</div>
        <div class="feat-item">📄 3 professionelle Vorlagen</div>
        <div class="feat-item">⬇️ PDF-Download</div>
        <div class="feat-item">🇩🇪 Deutsches Standardformat</div>
        <div class="feat-item">✍️ Einfaches Formular</div>
    </div>
</div>

<div class="cv-main">

    {{-- ════ MEINE CVS ════ --}}
    @if($userCVs->count() > 0)
    <div class="my-cvs-section">
        <div class="my-cvs-header">
            <h2>📂 Meine Lebensläufe</h2>
            <a href="{{ route('cv.create') }}" class="btn-sm primary">+ Neu erstellen</a>
        </div>
        <div class="my-cvs-grid">
            @foreach($userCVs as $cv)
            <div class="my-cv-card">
                <div class="my-cv-top">
                    <div>
                        <div class="my-cv-name">{{ $cv->vorname }} {{ $cv->nachname }}</div>
                        <div class="my-cv-modele">Vorlage: {{ ucfirst($cv->modele) }}</div>
                    </div>
                    <span class="my-cv-ats">ATS: {{ $cv->ats_score }}%</span>
                </div>
                <div class="my-cv-date">
                    📅 Erstellt: {{ $cv->created_at->format('d.m.Y') }}
                </div>
                <div class="my-cv-actions">
                    <a href="{{ route('cv.show', $cv->id) }}" class="btn-sm">👁 Ansehen</a>
                    <a href="{{ route('cv.edit', $cv->id) }}" class="btn-sm">✏️ Bearbeiten</a>
                    <a href="{{ route('cv.download', $cv->id) }}" class="btn-sm primary">⬇️ PDF</a>
                    <form method="POST" action="{{ route('cv.delete', $cv->id) }}" style="display:inline">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn-sm danger"
                                onclick="return confirm('Lebenslauf wirklich löschen?')">🗑</button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif

    {{-- ════ VORLAGEN ════ --}}
    <div id="vorlagen" style="text-align:center;margin-bottom:0.5rem;">
        <span class="section-badge">Schritt 1 — Vorlage wählen</span>
    </div>
    <h2 class="sec-title">Wähle deine Vorlage</h2>
    <p class="sec-sub">Alle Vorlagen sind nach deutschem Standard optimiert und ATS-kompatibel</p>

    <div class="templates-grid">
        @foreach($modeles as $key => $modele)
        <div class="tpl-card">
            <div class="tpl-preview" style="background:{{ $key === 'modern' ? 'linear-gradient(135deg,#1a1a2e,#2d2d4e)' : ($key === 'klassisch' ? '#f8fff9' : '#f8f4ff') }}">

                @if($key === 'modern')
                <div style="padding:20px;color:#fff;height:100%;">
                    <div style="width:44px;height:44px;border-radius:50%;background:#e94560;margin-bottom:12px;"></div>
                    <div style="height:8px;background:rgba(255,255,255,0.85);border-radius:4px;margin-bottom:6px;width:75%;"></div>
                    <div style="height:4px;background:rgba(255,255,255,0.3);border-radius:2px;margin-bottom:4px;"></div>
                    <div style="height:4px;background:rgba(255,255,255,0.3);border-radius:2px;margin-bottom:4px;width:60%;"></div>
                    <div style="margin-top:12px;height:4px;background:#e94560;border-radius:2px;width:40%;margin-bottom:8px;"></div>
                    <div style="height:3px;background:rgba(255,255,255,0.15);border-radius:2px;margin-bottom:3px;"></div>
                    <div style="height:3px;background:rgba(255,255,255,0.15);border-radius:2px;width:80%;"></div>
                </div>
                @elseif($key === 'klassisch')
                <div style="padding:16px;height:100%;">
                    <div style="display:flex;gap:10px;align-items:center;margin-bottom:10px;">
                        <div style="width:38px;height:38px;border-radius:50%;background:#0f6e56;"></div>
                        <div>
                            <div style="height:6px;background:#1a1a2e;border-radius:2px;width:80px;margin-bottom:4px;"></div>
                            <div style="height:3px;background:#aaa;border-radius:2px;width:55px;"></div>
                        </div>
                    </div>
                    <div style="height:2px;background:#0f6e56;margin-bottom:8px;"></div>
                    <div style="height:4px;background:#e9ecef;border-radius:2px;margin-bottom:3px;"></div>
                    <div style="height:4px;background:#e9ecef;border-radius:2px;margin-bottom:3px;width:85%;"></div>
                    <div style="height:3px;background:#0f6e56;border-radius:2px;width:50%;margin:8px 0 5px;"></div>
                    <div style="height:3px;background:#e9ecef;border-radius:2px;margin-bottom:3px;"></div>
                    <div style="height:3px;background:#e9ecef;border-radius:2px;width:70%;"></div>
                </div>
                @else
                <div style="padding:16px;height:100%;">
                    <div style="background:#533AB7;border-radius:8px;padding:12px;margin-bottom:10px;display:flex;align-items:center;gap:8px;">
                        <div style="width:32px;height:32px;border-radius:50%;background:rgba(255,255,255,0.25);"></div>
                        <div>
                            <div style="height:5px;background:rgba(255,255,255,0.8);border-radius:2px;width:65px;margin-bottom:4px;"></div>
                            <div style="height:3px;background:rgba(255,255,255,0.4);border-radius:2px;width:45px;"></div>
                        </div>
                    </div>
                    <div style="height:3px;background:#e9ecef;border-radius:2px;margin-bottom:3px;"></div>
                    <div style="height:3px;background:#e9ecef;border-radius:2px;margin-bottom:3px;width:80%;"></div>
                    <div style="height:3px;background:#533AB7;border-radius:2px;width:45%;margin:6px 0 4px;"></div>
                    <div style="height:3px;background:#e9ecef;border-radius:2px;margin-bottom:3px;"></div>
                </div>
                @endif

                <div class="tpl-overlay">
                    <a href="{{ route('cv.create') }}?modele={{ $key }}" class="tpl-select-btn">
                        Diese Vorlage wählen →
                    </a>
                </div>
                <span class="tpl-badge" style="background:{{ $modele['color'] }}">
                    {{ $modele['badge'] }}
                </span>
            </div>
            <div class="tpl-body">
                <div class="tpl-name">{{ $modele['name'] }}</div>
                <div class="tpl-desc">{{ $modele['desc'] }}</div>
                <div class="tpl-tags">
                    <span class="tpl-tag">ATS ✓</span>
                    <span class="tpl-tag">PDF ✓</span>
                    <span class="tpl-tag">🇩🇪 Format</span>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    {{-- ════ ATS SECTION ════ --}}
    <div class="ats-section">
        <div class="ats-left">
            <span class="ats-tag">🎯 ATS-Check</span>
            <h2>Was ist ein ATS-Score<br>und warum ist er wichtig?</h2>
            <p>
                ATS (Applicant Tracking System) ist eine Software, die deutsche Unternehmen
                nutzen, um Lebensläufe automatisch zu filtern. Ein niedriger ATS-Score bedeutet,
                dass dein Lebenslauf aussortiert wird — bevor ein Mensch ihn liest!
            </p>
            <div class="ats-features">
                <div class="ats-feat">Über 75% der deutschen Unternehmen nutzen ATS</div>
                <div class="ats-feat">Alle unsere Vorlagen sind ATS-optimiert</div>
                <div class="ats-feat">Prüfe deinen Score nach dem Erstellen</div>
                <div class="ats-feat">Konkrete Verbesserungsvorschläge</div>
            </div>
            @if($userCVs->count() > 0)
                <button class="btn-ats" onclick="openAtsModal()">
                    🎯 Meinen CV prüfen →
                </button>
            @else
                <a href="{{ route('cv.create') }}" class="btn-ats" style="text-decoration:none;display:inline-block;">
                    ✨ Jetzt Lebenslauf erstellen →
                </a>
            @endif
        </div>
        <div class="ats-right">
            <div class="ats-circle">
                <div class="ats-score-num" id="atsScoreDisplay">
                    {{ $userCVs->count() > 0 ? $userCVs->first()->ats_score : '—' }}
                    @if($userCVs->count() > 0)%@endif
                </div>
                <div class="ats-score-lbl">ATS Score</div>
            </div>
            <div class="ats-bars">
                <div class="ats-bar-row">
                    <span class="ats-bar-label">Format</span>
                    <div class="ats-track">
                        <div class="ats-fill" id="barFormat" style="width:0%;background:#28a745;"></div>
                    </div>
                </div>
                <div class="ats-bar-row">
                    <span class="ats-bar-label">Keywords</span>
                    <div class="ats-track">
                        <div class="ats-fill" id="barKeywords" style="width:0%;background:#f0a500;"></div>
                    </div>
                </div>
                <div class="ats-bar-row">
                    <span class="ats-bar-label">Struktur</span>
                    <div class="ats-track">
                        <div class="ats-fill" id="barStruktur" style="width:0%;background:#28a745;"></div>
                    </div>
                </div>
                <div class="ats-bar-row">
                    <span class="ats-bar-label">Sprache</span>
                    <div class="ats-track">
                        <div class="ats-fill" id="barSprache" style="width:0%;background:#28a745;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection

@push('scripts')
<script>
@if($userCVs->count() > 0)
setTimeout(() => {
    const cvId = {{ $userCVs->first()->id }};
    fetch('{{ route("cv.ats") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content
        },
        body: JSON.stringify({ cv_id: cvId })
    })
    .then(r => r.json())
    .then(data => {
        document.getElementById('atsScoreDisplay').textContent = data.score + '%';
        document.getElementById('barFormat').style.width   = data.details.format + '%';
        document.getElementById('barKeywords').style.width = data.details.keywords + '%';
        document.getElementById('barStruktur').style.width = data.details.struktur + '%';
        document.getElementById('barSprache').style.width  = data.details.sprache + '%';
    });
}, 500);
@endif
</script>
@endpush