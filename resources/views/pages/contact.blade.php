@extends('layouts.app')

@section('title', 'Kontakt')

@push('styles')
<style>
    /* ── HERO ── */
    .contact-hero {
        background: #1a1a2e;
        padding: 4rem 1.5rem;
        text-align: center;
    }
    .contact-badge {
        display: inline-block;
        background: rgba(233,69,96,0.15);
        color: #e94560;
        border: 1px solid rgba(233,69,96,0.3);
        border-radius: 20px;
        padding: 6px 18px;
        font-size: 0.8rem;
        font-weight: 600;
        margin-bottom: 1.2rem;
    }
    .contact-hero h1 {
        font-family: 'Sora', sans-serif;
        font-size: clamp(1.8rem, 4vw, 2.6rem);
        font-weight: 800;
        color: #fff;
        margin-bottom: 0.8rem;
    }
    .contact-hero h1 span { color: #e94560; }
    .contact-hero p {
        color: rgba(255,255,255,0.55);
        font-size: 1rem;
        max-width: 500px;
        margin: 0 auto;
    }

    /* ── LAYOUT ── */
    .contact-wrap {
        max-width: 1100px;
        margin: 0 auto;
        padding: 4rem 1.5rem;
        display: grid;
        grid-template-columns: 1fr 1.6fr;
        gap: 3rem;
        align-items: start;
    }

    /* ── INFO SIDE ── */
    .info-title {
        font-family: 'Sora', sans-serif;
        font-size: 1.4rem;
        font-weight: 700;
        margin-bottom: 0.6rem;
    }
    .info-sub {
        color: #6c757d;
        font-size: 0.9rem;
        line-height: 1.7;
        margin-bottom: 2rem;
    }
    .info-cards {
        display: flex;
        flex-direction: column;
        gap: 14px;
        margin-bottom: 2rem;
    }
    .info-card {
        background: #fff;
        border-radius: 12px;
        padding: 1.1rem 1.3rem;
        border: 1px solid #e9ecef;
        display: flex;
        align-items: flex-start;
        gap: 14px;
        transition: transform 0.15s;
    }
    .info-card:hover { transform: translateX(4px); }
    .info-icon {
        width: 44px; height: 44px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
        flex-shrink: 0;
    }
    .info-card h4 { font-size: 0.875rem; font-weight: 700; margin-bottom: 3px; }
    .info-card p  { font-size: 0.825rem; color: #6c757d; line-height: 1.5; }
    .info-card a  { color: #e94560; font-size: 0.875rem; font-weight: 600; }
    .info-card a:hover { text-decoration: underline; }

    /* ── SOCIAL ── */
    .social-title {
        font-size: 0.8rem;
        font-weight: 700;
        color: #6c757d;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 10px;
    }
    .social-row { display: flex; gap: 10px; }
    .social-btn {
        width: 40px; height: 40px;
        border-radius: 10px;
        border: 1.5px solid #e9ecef;
        background: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.875rem;
        font-weight: 700;
        color: #1a1a2e;
        text-decoration: none;
        transition: all 0.15s;
    }
    .social-btn:hover { border-color: #e94560; color: #e94560; background: #fff0f3; }

    /* ── FORM CARD ── */
    .form-card {
        background: #fff;
        border-radius: 16px;
        padding: 2.5rem;
        border: 1px solid #e9ecef;
    }
    .form-card h3 {
        font-family: 'Sora', sans-serif;
        font-size: 1.3rem;
        font-weight: 700;
        margin-bottom: 0.4rem;
    }
    .form-card > p {
        color: #6c757d;
        font-size: 0.875rem;
        margin-bottom: 2rem;
    }
    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 14px;
    }
    .form-group { display: flex; flex-direction: column; gap: 6px; margin-bottom: 16px; }
    .form-group label { font-size: 0.825rem; font-weight: 600; }
    .form-group input,
    .form-group textarea,
    .form-group select {
        padding: 11px 14px;
        border-radius: 9px;
        border: 1.5px solid #e9ecef;
        font-size: 0.875rem;
        font-family: inherit;
        color: #1a1a2e;
        background: #fff;
        transition: border 0.15s;
        outline: none;
    }
    .form-group input:focus,
    .form-group textarea:focus,
    .form-group select:focus { border-color: #e94560; }
    .form-group textarea { resize: vertical; min-height: 130px; }

    .alert-success-form {
        background: #d4edda; color: #155724;
        border: 1px solid #c3e6cb;
        border-radius: 9px;
        padding: 0.9rem 1rem;
        font-size: 0.875rem;
        margin-bottom: 1.5rem;
    }
    .error-msg { color: #e94560; font-size: 0.78rem; margin-top: 3px; }

    .btn-submit {
        width: 100%;
        background: #e94560;
        color: #fff;
        border: none;
        border-radius: 10px;
        padding: 14px;
        font-size: 1rem;
        font-weight: 700;
        cursor: pointer;
        font-family: inherit;
        transition: background 0.15s;
    }
    .btn-submit:hover { background: #c73652; }
    .form-note {
        text-align: center;
        font-size: 0.78rem;
        color: #aaa;
        margin-top: 12px;
    }

    /* ── MAP ── */
    .map-section {
        background: #fff;
        border-top: 1px solid #e9ecef;
        padding: 3rem 1.5rem;
    }
    .map-inner { max-width: 1100px; margin: 0 auto; }
    .map-inner h3 {
        font-family: 'Sora', sans-serif;
        font-size: 1.2rem;
        font-weight: 700;
        margin-bottom: 1.2rem;
    }
    .map-frame {
        border-radius: 14px;
        overflow: hidden;
        border: 1px solid #e9ecef;
        height: 320px;
    }
    .map-frame iframe { width: 100%; height: 100%; border: none; }

    @media (max-width: 860px) {
        .contact-wrap { grid-template-columns: 1fr; }
        .form-row { grid-template-columns: 1fr; }
    }
</style>
@endpush

@section('content')

{{-- ════ HERO ════ --}}
<section class="contact-hero">
    <div class="contact-badge">✉️ Wir helfen dir gerne</div>
    <h1>Nimm <span>Kontakt</span> auf</h1>
    <p>Hast du Fragen zur Plattform, zur Ausbildung oder zu deiner Bewerbung? Schreib uns einfach!</p>
</section>

{{-- ════ HAUPT-CONTENT ════ --}}
<div class="contact-wrap">

    {{-- ── INFO LINKS ── --}}
    <div>
        <h2 class="info-title">So erreichst du uns</h2>
        <p class="info-sub">
            Unser Team antwortet dir in der Regel innerhalb von 24 Stunden.
            Wir freuen uns auf deine Nachricht!
        </p>

        <div class="info-cards">
            <div class="info-card">
                <div class="info-icon" style="background:#fff0f3;">📧</div>
                <div>
                    <h4>E-Mail</h4>
                    <p>Für allgemeine Anfragen:</p>
                    <a href="mailto:kontakt@careerhub.de">kontakt@careerhub.de</a>
                </div>
            </div>
            <div class="info-card">
                <div class="info-icon" style="background:#e8f4fd;">📞</div>
                <div>
                    <h4>Telefon</h4>
                    <p>Montag – Freitag, 09:00 – 17:00 Uhr</p>
                    <a href="tel:+4930123456">+49 30 1234 5678</a>
                </div>
            </div>
            <div class="info-card">
                <div class="info-icon" style="background:#e8fdf3;">📍</div>
                <div>
                    <h4>Adresse</h4>
                    <p>Musterstraße 42, 10115 Berlin<br>Deutschland 🇩🇪</p>
                </div>
            </div>
            <div class="info-card">
                <div class="info-icon" style="background:#fef9e7;">🕐</div>
                <div>
                    <h4>Öffnungszeiten</h4>
                    <p>Montag – Freitag: 09:00 – 17:00 Uhr<br>Wochenende: Geschlossen</p>
                </div>
            </div>
        </div>

        <p class="social-title">Folge uns</p>
        <div class="social-row">
            <a href="#" class="social-btn" title="LinkedIn">in</a>
            <a href="#" class="social-btn" title="Twitter/X">𝕏</a>
            <a href="#" class="social-btn" title="Facebook">f</a>
            <a href="#" class="social-btn" title="Instagram">ig</a>
        </div>
    </div>

    {{-- ── FORMULAR RECHTS ── --}}
    <div class="form-card">
        <h3>Nachricht senden</h3>
        <p>Fülle das Formular aus – wir melden uns so schnell wie möglich bei dir.</p>

        @if(session('success'))
            <div class="alert-success-form">
                ✅ Deine Nachricht wurde erfolgreich gesendet! Wir melden uns bald.
            </div>
        @endif

        <form method="POST" action="{{ route('contact.send') }}">
            @csrf

            <div class="form-row">
                <div class="form-group">
                    <label for="vorname">Vorname *</label>
                    <input type="text" id="vorname" name="vorname"
                           value="{{ old('vorname') }}"
                           placeholder="Max" required>
                    @error('vorname')
                        <span class="error-msg">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="nachname">Nachname *</label>
                    <input type="text" id="nachname" name="nachname"
                           value="{{ old('nachname') }}"
                           placeholder="Mustermann" required>
                    @error('nachname')
                        <span class="error-msg">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="email">E-Mail-Adresse *</label>
                <input type="email" id="email" name="email"
                       value="{{ old('email') }}"
                       placeholder="max@beispiel.de" required>
                @error('email')
                    <span class="error-msg">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="betreff">Betreff *</label>
                <select id="betreff" name="betreff" required>
                    <option value="">-- Bitte wählen --</option>
                    <option value="allgemein"    {{ old('betreff') == 'allgemein'    ? 'selected' : '' }}>Allgemeine Anfrage</option>
                    <option value="technisch"   {{ old('betreff') == 'technisch'   ? 'selected' : '' }}>Technisches Problem</option>
                    <option value="lebenslauf"  {{ old('betreff') == 'lebenslauf'  ? 'selected' : '' }}>Lebenslauf-Hilfe</option>
                    <option value="ausbildung"  {{ old('betreff') == 'ausbildung'  ? 'selected' : '' }}>Ausbildung Info</option>
                    <option value="sonstiges"   {{ old('betreff') == 'sonstiges'   ? 'selected' : '' }}>Sonstiges</option>
                </select>
                @error('betreff')
                    <span class="error-msg">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="nachricht">Nachricht *</label>
                <textarea id="nachricht" name="nachricht"
                          placeholder="Schreib uns deine Frage oder dein Anliegen..."
                          required>{{ old('nachricht') }}</textarea>
                @error('nachricht')
                    <span class="error-msg">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="btn-submit">
                Nachricht absenden ✉️
            </button>
            <p class="form-note">
                🔒 Deine Daten werden vertraulich behandelt und nicht an Dritte weitergegeben.
            </p>
        </form>
    </div>

</div>

{{-- ════ KARTE ════ --}}
<section class="map-section">
    <div class="map-inner">
        <h3>📍 Unser Standort — Berlin, Deutschland</h3>
        <div class="map-frame">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2427.9!2d13.404954!3d52.520008!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zNTLCsDMxJzEyLjAiTiAxM8KwMjQnMTcuOCJF!5e0!3m2!1sde!2sde!4v1234567890"
                allowfullscreen loading="lazy">
            </iframe>
        </div>
    </div>
</section>

@endsection