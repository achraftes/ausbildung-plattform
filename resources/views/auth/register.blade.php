@extends('layouts.app')
@section('title', 'Registrieren')

@push('styles')
<style>
    .auth-wrapper {
        min-height: calc(100vh - 145px);
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 2rem 1rem;
        background: #f5f5f7;
    }
    .auth-card {
        background: #fff;
        border-radius: 18px;
        padding: 2.5rem;
        border: 1px solid #e9ecef;
        width: 100%;
        max-width: 480px;
    }
    .auth-brand { text-align: center; margin-bottom: 2rem; }
    .auth-logo { font-family: 'Sora', sans-serif; font-size: 1.6rem; font-weight: 800; color: #1a1a2e; }
    .auth-logo span { color: #e94560; }
    .auth-brand p { font-size: 0.875rem; color: #6c757d; margin-top: 5px; }
    .auth-title { display: flex; align-items: center; gap: 10px; margin-bottom: 0.3rem; }
    .auth-title h2 { font-family: 'Sora', sans-serif; font-size: 1.4rem; font-weight: 700; }
    .badge-free {
        background: #fff0f3; color: #e94560;
        border-radius: 6px; padding: 3px 10px;
        font-size: 0.75rem; font-weight: 700;
    }
    .sub { font-size: 0.875rem; color: #6c757d; margin-bottom: 1.8rem; }
    .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 12px; }
    .form-group { display: flex; flex-direction: column; gap: 6px; margin-bottom: 16px; }
    .form-group label { font-size: 0.825rem; font-weight: 600; }
    .input-wrap { position: relative; }
    .input-wrap .ico {
        position: absolute; left: 13px;
        top: 50%; transform: translateY(-50%);
        font-size: 15px; color: #aaa; pointer-events: none;
    }
    .input-wrap input {
        width: 100%; padding: 11px 14px 11px 40px;
        border-radius: 9px; border: 1.5px solid #e9ecef;
        font-size: 0.875rem; font-family: inherit;
        color: #1a1a2e; outline: none; transition: border 0.15s;
    }
    .input-wrap input:focus { border-color: #e94560; }
    .no-icon input { padding-left: 14px; }
    .is-invalid { border-color: #e94560 !important; }
    .error-msg { color: #e94560; font-size: 0.78rem; }

    /* Passwortstärke */
    .strength-wrap { margin-top: 6px; }
    .strength-bars { display: flex; gap: 4px; margin-bottom: 3px; }
    .s-bar { height: 3px; flex: 1; border-radius: 2px; background: #e9ecef; transition: background 0.3s; }
    .strength-label { font-size: 0.75rem; color: #aaa; }

    .terms {
        font-size: 0.78rem; color: #6c757d;
        line-height: 1.6; margin-bottom: 16px;
    }
    .terms a { color: #e94560; font-weight: 600; }
    .btn-submit {
        width: 100%; background: #e94560; color: #fff;
        border: none; border-radius: 10px; padding: 13px;
        font-size: 0.95rem; font-weight: 700;
        cursor: pointer; font-family: inherit;
        transition: background 0.15s; margin-bottom: 1rem;
    }
    .btn-submit:hover { background: #c73652; }
    .auth-footer { text-align: center; font-size: 0.825rem; color: #6c757d; margin-top: 0.5rem; }
    .auth-footer a { color: #e94560; font-weight: 600; }

    @media(max-width:500px) { .form-row { grid-template-columns: 1fr; } }
</style>
@endpush

@section('content')
<div class="auth-wrapper">
    <div class="auth-card">

        <div class="auth-brand">
            <div class="auth-logo">Karriere<span>Nabe</span></div>
            <p>Erstelle dein kostenloses Konto 🚀</p>
        </div>

        <div class="auth-title">
            <h2>Registrieren</h2>
            <span class="badge-free">Kostenlos</span>
        </div>
        <p class="sub">Starte deine Karriere in Deutschland</p>

        <form method="POST" action="{{ route('register.post') }}">
            @csrf

            {{-- Vor- und Nachname --}}
            <div class="form-row">
                <div class="form-group">
                    <label for="vorname">Vorname</label>
                    <div class="input-wrap no-icon">
                        <input type="text" id="vorname" name="vorname"
                               value="{{ old('vorname') }}"
                               placeholder="Max"
                               class="{{ $errors->has('vorname') ? 'is-invalid' : '' }}"
                               required>
                    </div>
                    @error('vorname') <span class="error-msg">{{ $message }}</span> @enderror
                </div>
                <div class="form-group">
                    <label for="nachname">Nachname</label>
                    <div class="input-wrap no-icon">
                        <input type="text" id="nachname" name="nachname"
                               value="{{ old('nachname') }}"
                               placeholder="Mustermann"
                               class="{{ $errors->has('nachname') ? 'is-invalid' : '' }}"
                               required>
                    </div>
                    @error('nachname') <span class="error-msg">{{ $message }}</span> @enderror
                </div>
            </div>

            {{-- E-Mail --}}
            <div class="form-group">
                <label for="email">E-Mail-Adresse</label>
                <div class="input-wrap">
                    <span class="ico">📧</span>
                    <input type="email" id="email" name="email"
                           value="{{ old('email') }}"
                           placeholder="max@beispiel.de"
                           class="{{ $errors->has('email') ? 'is-invalid' : '' }}"
                           required>
                </div>
                @error('email') <span class="error-msg">{{ $message }}</span> @enderror
            </div>

            {{-- Passwort --}}
            <div class="form-group">
                <label for="password">Passwort</label>
                <div class="input-wrap">
                    <span class="ico">🔒</span>
                    <input type="password" id="password" name="password"
                           placeholder="Mindestens 8 Zeichen"
                           class="{{ $errors->has('password') ? 'is-invalid' : '' }}"
                           required>
                </div>
                <div class="strength-wrap">
                    <div class="strength-bars">
                        <div class="s-bar" id="s1"></div>
                        <div class="s-bar" id="s2"></div>
                        <div class="s-bar" id="s3"></div>
                        <div class="s-bar" id="s4"></div>
                    </div>
                    <span class="strength-label" id="s-label">Passwortstärke</span>
                </div>
                @error('password') <span class="error-msg">{{ $message }}</span> @enderror
            </div>

            {{-- Passwort bestätigen --}}
            <div class="form-group">
                <label for="password_confirmation">Passwort bestätigen</label>
                <div class="input-wrap">
                    <span class="ico">🔒</span>
                    <input type="password" id="password_confirmation"
                           name="password_confirmation"
                           placeholder="Passwort wiederholen" required>
                </div>
            </div>

            <p class="terms">
                Mit der Registrierung akzeptierst du unsere
                <a href="#">AGB</a> und
                <a href="#">Datenschutzrichtlinie</a>.
            </p>

            <button type="submit" class="btn-submit">
                Konto erstellen 🎉
            </button>
        </form>

        <div class="auth-footer">
            Bereits ein Konto? <a href="{{ route('login') }}">Anmelden</a>
        </div>

    </div>
</div>
@endsection

@push('scripts')
<script>
    document.getElementById('password').addEventListener('input', function() {
        const pw = this.value;
        const bars = [
            document.getElementById('s1'),
            document.getElementById('s2'),
            document.getElementById('s3'),
            document.getElementById('s4')
        ];
        const label = document.getElementById('s-label');

        bars.forEach(b => b.style.background = '#e9ecef');

        if (pw.length === 0) {
            label.textContent = 'Passwortstärke';
            return;
        }
        let score = 0;
        if (pw.length >= 8)  score++;
        if (/[A-Z]/.test(pw)) score++;
        if (/[0-9]/.test(pw)) score++;
        if (/[^A-Za-z0-9]/.test(pw)) score++;

        const colors = ['#e94560','#f0a500','#3b82f6','#28a745'];
        const labels = ['Schwach','Mittel','Gut','Stark'];
        for (let i = 0; i < score; i++) bars[i].style.background = colors[score - 1];
        label.textContent = labels[score - 1] || 'Schwach';
        label.style.color = colors[score - 1];
    });
</script>
@endpush