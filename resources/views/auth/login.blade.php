@extends('layouts.app')
@section('title', 'Anmelden')

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
        max-width: 440px;
    }
    .auth-brand {
        text-align: center;
        margin-bottom: 2rem;
    }
    .auth-logo {
        font-family: 'Sora', sans-serif;
        font-size: 1.6rem;
        font-weight: 800;
        color: #1a1a2e;
    }
    .auth-logo span { color: #e94560; }
    .auth-brand p { font-size: 0.875rem; color: #6c757d; margin-top: 5px; }
    .auth-card h2 {
        font-family: 'Sora', sans-serif;
        font-size: 1.4rem;
        font-weight: 700;
        margin-bottom: 0.3rem;
    }
    .auth-card .sub { font-size: 0.875rem; color: #6c757d; margin-bottom: 1.8rem; }
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
    .is-invalid { border-color: #e94560 !important; }
    .error-msg { color: #e94560; font-size: 0.78rem; margin-top: 3px; }
    .remember-row {
        display: flex; align-items: center;
        justify-content: space-between; margin-bottom: 20px;
    }
    .remember-row label {
        display: flex; align-items: center;
        gap: 7px; font-size: 0.825rem; color: #6c757d; cursor: pointer;
    }
    .remember-row a { font-size: 0.825rem; color: #e94560; font-weight: 600; }
    .btn-submit {
        width: 100%; background: #e94560; color: #fff;
        border: none; border-radius: 10px; padding: 13px;
        font-size: 0.95rem; font-weight: 700;
        cursor: pointer; font-family: inherit; transition: background 0.15s;
        margin-bottom: 1rem;
    }
    .btn-submit:hover { background: #c73652; }
    .divider {
        display: flex; align-items: center;
        gap: 10px; margin-bottom: 1rem;
    }
    .divider span { font-size: 0.8rem; color: #aaa; }
    .divider::before, .divider::after { content: ''; flex: 1; height: 1px; background: #e9ecef; }
    .auth-footer { text-align: center; font-size: 0.825rem; color: #6c757d; margin-top: 1.2rem; }
    .auth-footer a { color: #e94560; font-weight: 600; }
    .alert-error-box {
        background: #fef2f2; color: #b91c1c;
        border: 1px solid #fecaca; border-radius: 9px;
        padding: 0.9rem 1rem; font-size: 0.875rem; margin-bottom: 1.2rem;
    }
</style>
@endpush

@section('content')
<div class="auth-wrapper">
    <div class="auth-card">

        <div class="auth-brand">
            <div class="auth-logo">Career<span>Hub</span></div>
            <p>Willkommen zurück! 👋</p>
        </div>

        <h2>Anmelden</h2>
        <p class="sub">Melde dich mit deinem Konto an</p>

        @if(session('error'))
            <div class="alert-error-box">❌ {{ session('error') }}</div>
        @endif

        <form method="POST" action="{{ route('login.post') }}">
            @csrf

            {{-- E-Mail --}}
            <div class="form-group">
                <label for="email">E-Mail-Adresse</label>
                <div class="input-wrap">
                    <span class="ico">📧</span>
                    <input type="email" id="email" name="email"
                           value="{{ old('email') }}"
                           placeholder="max@beispiel.de"
                           class="{{ $errors->has('email') ? 'is-invalid' : '' }}"
                           required autofocus>
                </div>
                @error('email')
                    <span class="error-msg">{{ $message }}</span>
                @enderror
            </div>

            {{-- Passwort --}}
            <div class="form-group">
                <label for="password">Passwort</label>
                <div class="input-wrap">
                    <span class="ico">🔒</span>
                    <input type="password" id="password" name="password"
                           placeholder="••••••••"
                           class="{{ $errors->has('password') ? 'is-invalid' : '' }}"
                           required>
                </div>
                @error('password')
                    <span class="error-msg">{{ $message }}</span>
                @enderror
            </div>

            {{-- Remember + Forgot --}}
            <div class="remember-row">
                <label>
                    <input type="checkbox" name="remember">
                    Angemeldet bleiben
                </label>
                <a href="#">Passwort vergessen?</a>
            </div>

            <button type="submit" class="btn-submit">
                Anmelden
            </button>
        </form>

        <div class="auth-footer">
            Noch kein Konto? <a href="{{ route('register') }}">Jetzt registrieren</a>
        </div>

    </div>
</div>
@endsection