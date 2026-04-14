<!DOCTYPE html>
<html lang="de">
<head>
<meta charset="UTF-8">
<style>
    * { margin: 0; padding: 0; box-sizing: border-box; }
    body { font-family: DejaVu Sans, sans-serif; font-size: 10px; color: #1a1a2e; }
    .page { display: flex; min-height: 100vh; }
    .sidebar { width: 35%; background: #1a1a2e; padding: 24px 18px; color: #fff; }
    .main { width: 65%; padding: 24px 20px; }
    .avatar { width: 70px; height: 70px; border-radius: 50%; background: #e94560; display: flex; align-items: center; justify-content: center; font-size: 22px; font-weight: 700; color: #fff; margin-bottom: 12px; }
    .name { font-size: 16px; font-weight: 700; margin-bottom: 3px; }
    .titel { font-size: 10px; color: #e94560; margin-bottom: 14px; }
    .side-section { margin-bottom: 14px; }
    .side-title { font-size: 8px; text-transform: uppercase; letter-spacing: 1px; color: #e94560; margin-bottom: 6px; border-bottom: 1px solid rgba(255,255,255,0.1); padding-bottom: 3px; }
    .contact-item { font-size: 9px; color: rgba(255,255,255,0.75); margin-bottom: 4px; }
    .skill-tag { display: inline-block; background: rgba(255,255,255,0.1); border-radius: 3px; padding: 2px 6px; font-size: 8px; color: rgba(255,255,255,0.8); margin: 2px; }
    .lang-row { display: flex; justify-content: space-between; margin-bottom: 3px; font-size: 9px; }
    .lang-badge { background: #e94560; border-radius: 2px; padding: 1px 5px; font-size: 8px; }
    .main-name { font-size: 20px; font-weight: 700; color: #1a1a2e; margin-bottom: 4px; }
    .main-titel { font-size: 11px; color: #e94560; font-weight: 600; margin-bottom: 10px; }
    .main-hr { border: none; border-top: 2px solid #e94560; margin: 10px 0; }
    .section-title { font-size: 9px; text-transform: uppercase; letter-spacing: 0.8px; font-weight: 700; color: #1a1a2e; margin-bottom: 7px; }
    .entry { margin-bottom: 8px; }
    .entry-top { display: flex; justify-content: space-between; }
    .entry-job { font-size: 10px; font-weight: 700; }
    .entry-date { font-size: 8px; color: #aaa; }
    .entry-company { font-size: 9px; color: #e94560; margin-top: 1px; }
    .entry-desc { font-size: 8.5px; color: #555; margin-top: 3px; line-height: 1.5; }
    .profil-text { font-size: 9px; color: #555; line-height: 1.6; margin-bottom: 8px; }
</style>
</head>
<body>
<div class="page">

    <!-- SIDEBAR -->
    <div class="sidebar">
        <div class="avatar">
            {{ strtoupper(substr($cv->vorname, 0, 1)) }}{{ strtoupper(substr($cv->nachname, 0, 1)) }}
        </div>
        <div class="name">{{ $cv->vorname }} {{ $cv->nachname }}</div>
        <div class="titel">{{ $cv->beruf_titel }}</div>

        <div class="side-section">
            <div class="side-title">Kontakt</div>
            @if($cv->email) <div class="contact-item">✉ {{ $cv->email }}</div> @endif
            @if($cv->telefon) <div class="contact-item">📞 {{ $cv->telefon }}</div> @endif
            @if($cv->adresse) <div class="contact-item">📍 {{ $cv->adresse }}</div> @endif
            @if($cv->stadt) <div class="contact-item">🏙 {{ $cv->stadt }}</div> @endif
        </div>

        @if(!empty($cv->kenntnisse))
        <div class="side-section">
            <div class="side-title">Kenntnisse</div>
            @foreach($cv->kenntnisse as $skill)
                <span class="skill-tag">{{ $skill }}</span>
            @endforeach
        </div>
        @endif

        @if(!empty($cv->sprachen))
        <div class="side-section">
            <div class="side-title">Sprachen</div>
            @foreach($cv->sprachen as $spr)
            <div class="lang-row">
                <span style="color:rgba(255,255,255,0.8)">{{ $spr['name'] }}</span>
                <span class="lang-badge">{{ $spr['niveau'] }}</span>
            </div>
            @endforeach
        </div>
        @endif

        @if($cv->hobbys)
        <div class="side-section">
            <div class="side-title">Hobbys</div>
            <div class="contact-item">{{ $cv->hobbys }}</div>
        </div>
        @endif
    </div>

    <!-- MAIN -->
    <div class="main">
        <div class="main-name">{{ $cv->vorname }} {{ $cv->nachname }}</div>
        @if($cv->beruf_titel)
            <div class="main-titel">{{ $cv->beruf_titel }}</div>
        @endif

        @if($cv->profil_text)
        <hr class="main-hr">
        <div class="section-title">Persönliches Profil</div>
        <div class="profil-text">{{ $cv->profil_text }}</div>
        @endif

        @if(!empty($cv->berufserfahrung))
        <hr class="main-hr">
        <div class="section-title">Berufserfahrung</div>
        @foreach($cv->berufserfahrung as $job)
        <div class="entry">
            <div class="entry-top">
                <div class="entry-job">{{ $job['titel'] }}</div>
                <div class="entry-date">{{ $job['zeitraum'] }}</div>
            </div>
            <div class="entry-company">{{ $job['unternehmen'] }}</div>
            @if($job['beschreibung'])
                <div class="entry-desc">{{ $job['beschreibung'] }}</div>
            @endif
        </div>
        @endforeach
        @endif

        @if(!empty($cv->ausbildung))
        <hr class="main-hr">
        <div class="section-title">Ausbildung</div>
        @foreach($cv->ausbildung as $aus)
        <div class="entry">
            <div class="entry-top">
                <div class="entry-job">{{ $aus['titel'] }}</div>
                <div class="entry-date">{{ $aus['zeitraum'] }}</div>
            </div>
            <div class="entry-company">
                {{ $aus['schule'] }}@if($aus['note']) — Note: {{ $aus['note'] }}@endif
            </div>
        </div>
        @endforeach
        @endif

        <div style="margin-top:20px;border-top:1px solid #f0f0f0;padding-top:8px;text-align:right;">
            <div style="font-size:8px;color:#aaa;">
                Erstellt mit CareerHub.de — {{ now()->format('d.m.Y') }}
            </div>
        </div>
    </div>

</div>
</body>
</html>