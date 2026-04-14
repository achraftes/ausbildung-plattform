@extends('layouts.app')
@section('title', 'Mein Lebenslauf — ' . $cv->vorname . ' ' . $cv->nachname)

@push('styles')
<style>
    .cv-show-wrap { max-width: 1000px; margin: 0 auto; padding: 2.5rem 1.5rem; }
    .show-header {
        display: flex; justify-content: space-between; align-items: center;
        background: #1a1a2e; border-radius: 16px; padding: 1.5rem 2rem;
        margin-bottom: 2rem; flex-wrap: wrap; gap: 1rem;
    }
    .show-header h1 { font-family:'Sora',sans-serif; font-size:1.3rem; font-weight:800; color:#fff; }
    .show-header p { color:rgba(255,255,255,0.5); font-size:0.85rem; margin-top:4px; }
    .header-actions { display:flex; gap:10px; }
    .btn-dl {
        background:#e94560; color:#fff; border:none; border-radius:10px;
        padding:12px 24px; font-size:0.9rem; font-weight:700;
        cursor:pointer; font-family:inherit; text-decoration:none;
        display:inline-flex; align-items:center; gap:6px; transition:background 0.15s;
    }
    .btn-dl:hover { background:#c73652; }
    .btn-edit {
        background:rgba(255,255,255,0.1); color:#fff; border:1.5px solid rgba(255,255,255,0.2);
        border-radius:10px; padding:11px 20px; font-size:0.9rem; font-weight:600;
        cursor:pointer; font-family:inherit; text-decoration:none;
        display:inline-flex; align-items:center; gap:6px;
    }

    /* ATS Result */
    .ats-result {
        background: #fff; border-radius: 14px; border:1px solid #e9ecef;
        padding:1.5rem; margin-bottom:2rem;
        display:flex; align-items:center; gap:2rem; flex-wrap:wrap;
    }
    .ats-big-score { text-align:center; }
    .ats-big-num { font-size:3rem; font-weight:800; color:#e94560; line-height:1; }
    .ats-big-lbl { font-size:0.8rem; color:#aaa; margin-top:4px; }
    .ats-details { flex:1; }
    .ats-details h3 { font-size:1rem; font-weight:700; margin-bottom:0.8rem; }
    .ats-tip { display:flex; align-items:flex-start; gap:8px; margin-bottom:6px; font-size:0.85rem; color:#6c757d; }
    .ats-tip.good::before { content:'✅'; }
    .ats-tip.warn::before { content:'⚠️'; }

    /* CV Preview */
    .cv-preview-box {
        background:#fff; border-radius:16px; border:1px solid #e9ecef;
        padding:2.5rem; box-shadow:0 4px 24px rgba(0,0,0,0.06);
    }
    .cv-preview-box h2 { font-family:'Sora',sans-serif; font-size:1.2rem; font-weight:700; margin-bottom:1.5rem; padding-bottom:0.8rem; border-bottom:2px solid #e94560; }

    /* Preview content */
    .preview-header { margin-bottom:1.5rem; }
    .preview-name { font-family:'Sora',sans-serif; font-size:1.8rem; font-weight:800; color:#1a1a2e; }
    .preview-titel { font-size:1rem; color:#e94560; font-weight:600; margin-top:4px; }
    .preview-contact { display:flex; gap:1.5rem; flex-wrap:wrap; margin-top:0.8rem; }
    .preview-contact span { font-size:0.85rem; color:#6c757d; }
    .preview-hr { height:2px; background:#e94560; border:none; margin:1.5rem 0; }
    .preview-section-title { font-size:0.85rem; font-weight:700; color:#1a1a2e; text-transform:uppercase; letter-spacing:0.5px; margin-bottom:0.8rem; }
    .preview-entry { margin-bottom:1rem; }
    .preview-entry-header { display:flex; justify-content:space-between; align-items:baseline; }
    .preview-entry-title { font-size:0.9rem; font-weight:700; }
    .preview-entry-date { font-size:0.8rem; color:#aaa; }
    .preview-entry-sub { font-size:0.85rem; color:#e94560; margin-top:2px; }
    .preview-entry-text { font-size:0.85rem; color:#6c757d; margin-top:4px; line-height:1.6; }
    .preview-skills { display:flex; flex-wrap:wrap; gap:8px; }
    .preview-skill { background:#f5f5f7; border-radius:6px; padding:4px 12px; font-size:0.8rem; font-weight:600; color:#1a1a2e; }
    .preview-lang-row { display:flex; align-items:center; gap:10px; margin-bottom:6px; }
    .preview-lang-name { font-size:0.85rem; font-weight:600; width:80px; }
    .preview-lang-badge { background:#e94560; color:#fff; border-radius:4px; padding:1px 8px; font-size:0.75rem; font-weight:700; }
</style>
@endpush

@section('content')
<div class="cv-show-wrap">

    @if(session('success'))
        <div style="background:#d4edda;color:#155724;border-radius:10px;padding:1rem 1.2rem;margin-bottom:1.5rem;font-size:0.9rem;font-weight:600;">
            🎉 {{ session('success') }}
        </div>
    @endif

    <div class="show-header">
        <div>
            <h1>📄 {{ $cv->vorname }} {{ $cv->nachname }}</h1>
            <p>Vorlage: {{ ucfirst($cv->modele) }} &nbsp;|&nbsp; Erstellt: {{ $cv->created_at->format('d.m.Y') }}</p>
        </div>
        <div class="header-actions">
            <a href="{{ route('cv.edit', $cv->id) }}" class="btn-edit">✏️ Bearbeiten</a>
            <a href="{{ route('cv.download', $cv->id) }}" class="btn-dl">⬇️ PDF herunterladen</a>
        </div>
    </div>

    {{-- ATS Result --}}
    <div class="ats-result">
        <div class="ats-big-score">
            <div class="ats-big-num">{{ $cv->ats_score }}%</div>
            <div class="ats-big-lbl">ATS Score</div>
        </div>
        <div class="ats-details">
            <h3>🎯 ATS-Analyse deines Lebenslaufs</h3>
            @if($cv->ats_score >= 80)
                <div class="ats-tip good">Sehr guter ATS-Score — dein Lebenslauf wird von Systemen erkannt</div>
            @elseif($cv->ats_score >= 60)
                <div class="ats-tip good">Guter Score — noch etwas Verbesserungspotenzial</div>
            @else
                <div class="ats-tip warn">Score verbesserbar — fülle mehr Felder aus</div>
            @endif
            @if(empty($cv->berufserfahrung))
                <div class="ats-tip warn">Berufserfahrung fehlt — füge mindestens einen Eintrag hinzu</div>
            @else
                <div class="ats-tip good">Berufserfahrung vorhanden</div>
            @endif
            @if(empty($cv->kenntnisse))
                <div class="ats-tip warn">Kenntnisse fehlen — füge relevante Skills hinzu</div>
            @else
                <div class="ats-tip good">{{ count($cv->kenntnisse) }} Kenntnisse eingetragen</div>
            @endif
            @if(!$cv->profil_text)
                <div class="ats-tip warn">Persönliches Profil fehlt — sehr wichtig für ATS</div>
            @else
                <div class="ats-tip good">Persönliches Profil vorhanden</div>
            @endif
        </div>
    </div>

    {{-- Preview --}}
    <div class="cv-preview-box">
        <h2>👁️ Vorschau deines Lebenslaufs</h2>

        <div class="preview-header">
            <div class="preview-name">{{ $cv->vorname }} {{ $cv->nachname }}</div>
            @if($cv->beruf_titel)
                <div class="preview-titel">{{ $cv->beruf_titel }}</div>
            @endif
            <div class="preview-contact">
                @if($cv->email) <span>📧 {{ $cv->email }}</span> @endif
                @if($cv->telefon) <span>📞 {{ $cv->telefon }}</span> @endif
                @if($cv->stadt) <span>📍 {{ $cv->stadt }}</span> @endif
            </div>
        </div>

        @if($cv->profil_text)
        <hr class="preview-hr">
        <div class="preview-section-title">Persönliches Profil</div>
        <p style="font-size:0.875rem;color:#444;line-height:1.7;">{{ $cv->profil_text }}</p>
        @endif

        @if(!empty($cv->berufserfahrung))
        <hr class="preview-hr">
        <div class="preview-section-title">Berufserfahrung</div>
        @foreach($cv->berufserfahrung as $job)
        <div class="preview-entry">
            <div class="preview-entry-header">
                <div class="preview-entry-title">{{ $job['titel'] }}</div>
                <div class="preview-entry-date">{{ $job['zeitraum'] }}</div>
            </div>
            <div class="preview-entry-sub">{{ $job['unternehmen'] }}</div>
            @if($job['beschreibung'])
                <div class="preview-entry-text">{{ $job['beschreibung'] }}</div>
            @endif
        </div>
        @endforeach
        @endif

        @if(!empty($cv->ausbildung))
        <hr class="preview-hr">
        <div class="preview-section-title">Ausbildung & Bildung</div>
        @foreach($cv->ausbildung as $aus)
        <div class="preview-entry">
            <div class="preview-entry-header">
                <div class="preview-entry-title">{{ $aus['titel'] }}</div>
                <div class="preview-entry-date">{{ $aus['zeitraum'] }}</div>
            </div>
            <div class="preview-entry-sub">{{ $aus['schule'] }}@if($aus['note']) &nbsp;|&nbsp; Note: {{ $aus['note'] }} @endif</div>
        </div>
        @endforeach
        @endif

        @if(!empty($cv->kenntnisse))
        <hr class="preview-hr">
        <div class="preview-section-title">Kenntnisse & Skills</div>
        <div class="preview-skills">
            @foreach($cv->kenntnisse as $skill)
                <span class="preview-skill">{{ $skill }}</span>
            @endforeach
        </div>
        @endif

        @if(!empty($cv->sprachen))
        <hr class="preview-hr">
        <div class="preview-section-title">Sprachkenntnisse</div>
        @foreach($cv->sprachen as $spr)
        <div class="preview-lang-row">
            <span class="preview-lang-name">{{ $spr['name'] }}</span>
            <span class="preview-lang-badge">{{ $spr['niveau'] }}</span>
        </div>
        @endforeach
        @endif

        @if($cv->hobbys)
        <hr class="preview-hr">
        <div class="preview-section-title">Hobbys & Interessen</div>
        <p style="font-size:0.875rem;color:#6c757d;">{{ $cv->hobbys }}</p>
        @endif

    </div>

    <div style="text-align:center;margin-top:2rem;">
        <a href="{{ route('cv.download', $cv->id) }}" class="btn-dl">
            ⬇️ Lebenslauf als PDF herunterladen
        </a>
    </div>

</div>
@endsection