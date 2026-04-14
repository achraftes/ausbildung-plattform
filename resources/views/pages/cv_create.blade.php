@extends('layouts.app')
@section('title', isset($cv) ? 'Lebenslauf bearbeiten' : 'Lebenslauf erstellen')

@push('styles')
<style>
    .cv-form-wrap { max-width: 860px; margin: 0 auto; padding: 2.5rem 1.5rem; }
    .form-hero {
        background: #1a1a2e; border-radius: 16px;
        padding: 2rem; margin-bottom: 2rem;
        display: flex; align-items: center; justify-content: space-between; gap: 1rem;
    }
    .form-hero h1 { font-family:'Sora',sans-serif; font-size:1.4rem; font-weight:800; color:#fff; }
    .form-hero p { color:rgba(255,255,255,0.5); font-size:0.85rem; margin-top:4px; }
    .modele-badge {
        background: #e94560; color: #fff; border-radius: 10px;
        padding: 8px 16px; font-size: 0.8rem; font-weight: 700; white-space: nowrap;
    }

    /* Steps */
    .steps { display:flex; gap:0; margin-bottom:2rem; background:#fff; border-radius:12px; overflow:hidden; border:1px solid #e9ecef; }
    .step { flex:1; padding:12px 8px; text-align:center; font-size:0.78rem; font-weight:600; color:#aaa; border-right:1px solid #e9ecef; cursor:pointer; transition:all 0.15s; }
    .step:last-child { border-right:none; }
    .step.active { background:#e94560; color:#fff; }
    .step.done { background:#d4edda; color:#155724; }

    /* Sections */
    .form-section { background:#fff; border-radius:16px; border:1px solid #e9ecef; padding:1.5rem; margin-bottom:1.5rem; }
    .form-section-title {
        display:flex; align-items:center; gap:10px;
        font-size:1rem; font-weight:700; margin-bottom:1.5rem;
        padding-bottom:0.8rem; border-bottom:1px solid #f0f0f0;
    }
    .form-section-title .ico {
        width:36px; height:36px; border-radius:9px;
        display:flex; align-items:center; justify-content:center; font-size:1rem;
    }

    /* Fields */
    .form-row { display:grid; grid-template-columns:1fr 1fr; gap:14px; margin-bottom:14px; }
    .form-group { display:flex; flex-direction:column; gap:5px; margin-bottom:14px; }
    .form-group label { font-size:0.8rem; font-weight:600; color:#1a1a2e; }
    .form-group input, .form-group textarea, .form-group select {
        padding:11px 14px; border-radius:9px;
        border:1.5px solid #e9ecef; font-size:0.875rem;
        font-family:inherit; color:#1a1a2e; outline:none;
        transition:border 0.15s; background:#fff;
    }
    .form-group input:focus, .form-group textarea:focus, .form-group select:focus { border-color:#e94560; }
    .form-group textarea { resize:vertical; min-height:90px; }
    .form-hint { font-size:0.75rem; color:#aaa; margin-top:3px; }

    /* Repeater */
    .repeater-item {
        background:#f9f9f9; border-radius:10px;
        border:1px solid #e9ecef; padding:1rem; margin-bottom:10px;
    }
    .repeater-header { display:flex; justify-content:space-between; align-items:center; margin-bottom:10px; }
    .repeater-title { font-size:0.85rem; font-weight:700; color:#1a1a2e; }
    .btn-remove {
        width:28px; height:28px; border-radius:6px;
        border:1.5px solid #f5c6cb; background:#fff;
        color:#e94560; font-size:1rem; cursor:pointer;
        display:flex; align-items:center; justify-content:center;
    }
    .btn-add {
        display:flex; align-items:center; gap:8px;
        padding:10px 18px; border-radius:9px;
        border:1.5px dashed #e9ecef; background:#fff;
        color:#6c757d; font-size:0.85rem; font-weight:600;
        cursor:pointer; font-family:inherit; transition:all 0.15s; width:100%;
        justify-content:center;
    }
    .btn-add:hover { border-color:#e94560; color:#e94560; }

    /* Progress */
    .progress-wrap { background:#f0f0f0; border-radius:3px; height:4px; margin-bottom:1.5rem; }
    .progress-fill { height:4px; background:#e94560; border-radius:3px; transition:width 0.3s; }

    /* Submit */
    .form-submit-area { display:flex; gap:12px; justify-content:flex-end; margin-top:2rem; }
    .btn-submit-cv {
        background:#e94560; color:#fff; border:none;
        border-radius:10px; padding:14px 32px;
        font-size:1rem; font-weight:700; cursor:pointer;
        font-family:inherit; transition:background 0.15s;
    }
    .btn-submit-cv:hover { background:#c73652; }
    .btn-cancel {
        background:#f5f5f7; color:#6c757d; border:none;
        border-radius:10px; padding:14px 24px;
        font-size:0.9rem; font-weight:600; cursor:pointer;
        font-family:inherit; text-decoration:none;
    }

    @media(max-width:600px) { .form-row { grid-template-columns:1fr; } }
</style>
@endpush

@section('content')
<div class="cv-form-wrap">

    <div class="form-hero">
        <div>
            <h1>
                {{ isset($cv) ? '✏️ Lebenslauf bearbeiten' : '✨ Lebenslauf erstellen' }}
            </h1>
            <p>Fülle alle Felder aus — je vollständiger, desto besser dein ATS-Score!</p>
        </div>
        <div class="modele-badge">
            @php $modeleLabel = ['modern'=>'Modern','klassisch'=>'Klassisch','kreativ'=>'Kreativ']; @endphp
            📄 Vorlage: {{ $modeleLabel[$modele ?? $cv->modele ?? 'modern'] }}
        </div>
    </div>

    {{-- Progress --}}
    <div class="progress-wrap">
        <div class="progress-fill" id="progressFill" style="width:0%"></div>
    </div>

    <form method="POST"
          action="{{ isset($cv) ? route('cv.update', $cv->id) : route('cv.store') }}"
          id="cvForm">
        @csrf
        @if(isset($cv)) @method('POST') @endif

        <input type="hidden" name="modele"
               value="{{ $modele ?? $cv->modele ?? 'modern' }}">

        {{-- ── 1. PERSÖNLICHE DATEN ── --}}
        <div class="form-section">
            <div class="form-section-title">
                <div class="ico" style="background:#fff0f3;">👤</div>
                Persönliche Daten
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label>Vorname *</label>
                    <input type="text" name="vorname"
                           value="{{ old('vorname', $cv->vorname ?? '') }}"
                           placeholder="Max" required>
                    @error('vorname') <span style="color:#e94560;font-size:0.78rem;">{{ $message }}</span> @enderror
                </div>
                <div class="form-group">
                    <label>Nachname *</label>
                    <input type="text" name="nachname"
                           value="{{ old('nachname', $cv->nachname ?? '') }}"
                           placeholder="Mustermann" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label>E-Mail-Adresse *</label>
                    <input type="email" name="email"
                           value="{{ old('email', $cv->email ?? '') }}"
                           placeholder="max@beispiel.de" required>
                </div>
                <div class="form-group">
                    <label>Telefonnummer</label>
                    <input type="text" name="telefon"
                           value="{{ old('telefon', $cv->telefon ?? '') }}"
                           placeholder="+49 151 12345678">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label>Adresse</label>
                    <input type="text" name="adresse"
                           value="{{ old('adresse', $cv->adresse ?? '') }}"
                           placeholder="Musterstraße 42">
                </div>
                <div class="form-group">
                    <label>Stadt</label>
                    <input type="text" name="stadt"
                           value="{{ old('stadt', $cv->stadt ?? '') }}"
                           placeholder="Berlin">
                </div>
            </div>

            <div class="form-group">
                <label>Berufsbezeichnung / Gewünschte Stelle</label>
                <input type="text" name="beruf_titel"
                       value="{{ old('beruf_titel', $cv->beruf_titel ?? '') }}"
                       placeholder="z.B. Fachinformatiker/in – Anwendungsentwicklung">
                <span class="form-hint">💡 Tipp: Übernimm den genauen Titel aus der Stellenausschreibung</span>
            </div>

            <div class="form-group">
                <label>Persönliches Profil / Über mich</label>
                <textarea name="profil_text"
                          placeholder="Beschreibe kurz deine Stärken, Erfahrungen und Ziele (2–4 Sätze)...">{{ old('profil_text', $cv->profil_text ?? '') }}</textarea>
                <span class="form-hint">💡 3–4 Sätze reichen — fokussiere dich auf das Wichtigste</span>
            </div>
        </div>

        {{-- ── 2. BERUFSERFAHRUNG ── --}}
        <div class="form-section">
            <div class="form-section-title">
                <div class="ico" style="background:#e8f4fd;">💼</div>
                Berufserfahrung
            </div>

            <div id="jobContainer">
                @php
                    $jobs = old('job_titel')
                        ? array_map(null,
                            old('job_titel',[]),
                            old('job_unternehmen',[]),
                            old('job_zeitraum',[]),
                            old('job_beschreibung',[])
                          )
                        : ($cv->berufserfahrung ?? [['titel'=>'','unternehmen'=>'','zeitraum'=>'','beschreibung'=>'']]);
                @endphp

                @foreach($jobs as $i => $job)
                <div class="repeater-item">
                    <div class="repeater-header">
                        <span class="repeater-title">🏢 Job {{ $i + 1 }}</span>
                        <button type="button" class="btn-remove" onclick="removeItem(this)">×</button>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label>Stellenbezeichnung</label>
                            <input type="text" name="job_titel[]"
                                   value="{{ $job['titel'] ?? '' }}"
                                   placeholder="z.B. Softwareentwickler">
                        </div>
                        <div class="form-group">
                            <label>Unternehmen</label>
                            <input type="text" name="job_unternehmen[]"
                                   value="{{ $job['unternehmen'] ?? '' }}"
                                   placeholder="z.B. Siemens GmbH">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Zeitraum</label>
                        <input type="text" name="job_zeitraum[]"
                               value="{{ $job['zeitraum'] ?? '' }}"
                               placeholder="z.B. 01/2022 – 12/2023">
                    </div>
                    <div class="form-group">
                        <label>Aufgaben & Tätigkeiten</label>
                        <textarea name="job_beschreibung[]"
                                  placeholder="Beschreibe deine Hauptaufgaben und Erfolge...">{{ $job['beschreibung'] ?? '' }}</textarea>
                    </div>
                </div>
                @endforeach
            </div>

            <button type="button" class="btn-add" onclick="addJob()">
                + Weitere Berufserfahrung hinzufügen
            </button>
        </div>

        {{-- ── 3. AUSBILDUNG ── --}}
        <div class="form-section">
            <div class="form-section-title">
                <div class="ico" style="background:#e8fdf3;">🎓</div>
                Ausbildung & Bildung
            </div>

            <div id="ausContainer">
                @php
                    $ausbildungen = old('aus_titel')
                        ? array_map(null,
                            old('aus_titel',[]),
                            old('aus_schule',[]),
                            old('aus_zeitraum',[]),
                            old('aus_note',[])
                          )
                        : ($cv->ausbildung ?? [['titel'=>'','schule'=>'','zeitraum'=>'','note'=>'']]);
                @endphp

                @foreach($ausbildungen as $i => $aus)
                <div class="repeater-item">
                    <div class="repeater-header">
                        <span class="repeater-title">🎓 Ausbildung {{ $i + 1 }}</span>
                        <button type="button" class="btn-remove" onclick="removeItem(this)">×</button>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label>Abschluss / Ausbildung</label>
                            <input type="text" name="aus_titel[]"
                                   value="{{ $aus['titel'] ?? '' }}"
                                   placeholder="z.B. Fachinformatiker/in">
                        </div>
                        <div class="form-group">
                            <label>Schule / Unternehmen</label>
                            <input type="text" name="aus_schule[]"
                                   value="{{ $aus['schule'] ?? '' }}"
                                   placeholder="z.B. Berufsschule Berlin">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label>Zeitraum</label>
                            <input type="text" name="aus_zeitraum[]"
                                   value="{{ $aus['zeitraum'] ?? '' }}"
                                   placeholder="z.B. 2020 – 2023">
                        </div>
                        <div class="form-group">
                            <label>Abschlussnote (optional)</label>
                            <input type="text" name="aus_note[]"
                                   value="{{ $aus['note'] ?? '' }}"
                                   placeholder="z.B. 1,8">
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <button type="button" class="btn-add" onclick="addAus()">
                + Weitere Ausbildung hinzufügen
            </button>
        </div>

        {{-- ── 4. KENNTNISSE ── --}}
        <div class="form-section">
            <div class="form-section-title">
                <div class="ico" style="background:#fef9e7;">⚡</div>
                Kenntnisse & Skills
            </div>

            <div class="form-group">
                <label>Kenntnisse (kommagetrennt)</label>
                <textarea name="kenntnisse"
                          placeholder="z.B. Python, JavaScript, MS Office, Projektmanagement, Teamarbeit...">{{ old('kenntnisse', isset($cv) && $cv->kenntnisse ? implode(', ', $cv->kenntnisse) : '') }}</textarea>
                <span class="form-hint">💡 Trenne jede Fähigkeit mit einem Komma</span>
            </div>
        </div>

        {{-- ── 5. SPRACHEN ── --}}
        <div class="form-section">
            <div class="form-section-title">
                <div class="ico" style="background:#e8fdf3;">🌍</div>
                Sprachkenntnisse
            </div>

            <div id="sprContainer">
                @php
                    $sprachen = old('spr_name')
                        ? array_map(null, old('spr_name',[]), old('spr_niveau',[]))
                        : ($cv->sprachen ?? [['name'=>'Deutsch','niveau'=>'B1'],['name'=>'Englisch','niveau'=>'A2']]);
                @endphp

                @foreach($sprachen as $i => $spr)
                <div class="repeater-item">
                    <div class="repeater-header">
                        <span class="repeater-title">🌍 Sprache {{ $i + 1 }}</span>
                        <button type="button" class="btn-remove" onclick="removeItem(this)">×</button>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label>Sprache</label>
                            <input type="text" name="spr_name[]"
                                   value="{{ $spr['name'] ?? '' }}"
                                   placeholder="z.B. Deutsch">
                        </div>
                        <div class="form-group">
                            <label>Niveau</label>
                            <select name="spr_niveau[]">
                                @foreach(['A1','A2','B1','B2','C1','C2','Muttersprache'] as $niv)
                                    <option value="{{ $niv }}"
                                        {{ ($spr['niveau'] ?? '') === $niv ? 'selected' : '' }}>
                                        {{ $niv }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <button type="button" class="btn-add" onclick="addSpr()">
                + Weitere Sprache hinzufügen
            </button>
        </div>

        {{-- ── 6. HOBBYS ── --}}
        <div class="form-section">
            <div class="form-section-title">
                <div class="ico" style="background:#fff0f3;">🎯</div>
                Hobbys & Interessen (optional)
            </div>
            <div class="form-group">
                <input type="text" name="hobbys"
                       value="{{ old('hobbys', $cv->hobbys ?? '') }}"
                       placeholder="z.B. Fußball, Lesen, Programmieren, Reisen">
            </div>
        </div>

        {{-- ── SUBMIT ── --}}
        <div class="form-submit-area">
            <a href="{{ route('cv.index') }}" class="btn-cancel">Abbrechen</a>
            <button type="submit" class="btn-submit-cv">
                {{ isset($cv) ? '✅ Änderungen speichern' : '🎉 Lebenslauf erstellen & PDF erstellen' }}
            </button>
        </div>

    </form>
</div>
@endsection

@push('scripts')
<script>
// ── Progress bar
function updateProgress() {
    const inputs = document.querySelectorAll('#cvForm input[required], #cvForm textarea[required]');
    let filled = 0;
    inputs.forEach(i => { if (i.value.trim()) filled++; });
    const allInputs = document.querySelectorAll('#cvForm input:not([type=hidden]), #cvForm textarea');
    let allFilled = 0;
    allInputs.forEach(i => { if (i.value.trim()) allFilled++; });
    const pct = Math.min(Math.round((allFilled / allInputs.length) * 100), 100);
    document.getElementById('progressFill').style.width = pct + '%';
}
document.querySelectorAll('#cvForm input, #cvForm textarea, #cvForm select')
        .forEach(el => el.addEventListener('input', updateProgress));
updateProgress();

// ── Repeater Job
function addJob() {
    const c = document.getElementById('jobContainer');
    const n = c.children.length + 1;
    c.insertAdjacentHTML('beforeend', `
        <div class="repeater-item">
            <div class="repeater-header">
                <span class="repeater-title">🏢 Job ${n}</span>
                <button type="button" class="btn-remove" onclick="removeItem(this)">×</button>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label>Stellenbezeichnung</label>
                    <input type="text" name="job_titel[]" placeholder="z.B. Softwareentwickler">
                </div>
                <div class="form-group">
                    <label>Unternehmen</label>
                    <input type="text" name="job_unternehmen[]" placeholder="z.B. Siemens GmbH">
                </div>
            </div>
            <div class="form-group">
                <label>Zeitraum</label>
                <input type="text" name="job_zeitraum[]" placeholder="z.B. 01/2022 – 12/2023">
            </div>
            <div class="form-group">
                <label>Aufgaben & Tätigkeiten</label>
                <textarea name="job_beschreibung[]" placeholder="Beschreibe deine Hauptaufgaben..."></textarea>
            </div>
        </div>`);
}

function addAus() {
    const c = document.getElementById('ausContainer');
    const n = c.children.length + 1;
    c.insertAdjacentHTML('beforeend', `
        <div class="repeater-item">
            <div class="repeater-header">
                <span class="repeater-title">🎓 Ausbildung ${n}</span>
                <button type="button" class="btn-remove" onclick="removeItem(this)">×</button>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label>Abschluss</label>
                    <input type="text" name="aus_titel[]" placeholder="z.B. Fachinformatiker/in">
                </div>
                <div class="form-group">
                    <label>Schule</label>
                    <input type="text" name="aus_schule[]" placeholder="z.B. Berufsschule Berlin">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label>Zeitraum</label>
                    <input type="text" name="aus_zeitraum[]" placeholder="2020 – 2023">
                </div>
                <div class="form-group">
                    <label>Note</label>
                    <input type="text" name="aus_note[]" placeholder="z.B. 1,8">
                </div>
            </div>
        </div>`);
}

function addSpr() {
    const c = document.getElementById('sprContainer');
    const n = c.children.length + 1;
    c.insertAdjacentHTML('beforeend', `
        <div class="repeater-item">
            <div class="repeater-header">
                <span class="repeater-title">🌍 Sprache ${n}</span>
                <button type="button" class="btn-remove" onclick="removeItem(this)">×</button>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label>Sprache</label>
                    <input type="text" name="spr_name[]" placeholder="z.B. Arabisch">
                </div>
                <div class="form-group">
                    <label>Niveau</label>
                    <select name="spr_niveau[]">
                        <option>A1</option><option>A2</option>
                        <option selected>B1</option><option>B2</option>
                        <option>C1</option><option>C2</option>
                        <option>Muttersprache</option>
                    </select>
                </div>
            </div>
        </div>`);
}

function removeItem(btn) {
    btn.closest('.repeater-item').remove();
    updateProgress();
}
</script>
@endpush