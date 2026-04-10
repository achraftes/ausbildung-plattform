<nav class="navbar">
    <a href="{{ url('/') }}" class="nav-brand">
        <div class="brand-dot"></div>Karriere<span>Nabe</span>
    </a>

    <div class="nav-links">
        <a href="{{ url('/') }}"
           class="{{ request()->is('/') ? 'active' : '' }}">
            Startseite
        </a>
        <a href="{{ route('ausbildung.index') }}"
           class="{{ request()->is('ausbildung') ? 'active' : '' }}">
            Ausbildung
        </a>
        <a href="{{ route('advices.index') }}"
           class="{{ request()->is('advices') ? 'active' : '' }}">
            Karrieretipps
        </a>

        {{-- ✅ KONTAKT HINZUGEFÜGT --}}
        <a href="{{ route('contact') }}"
           class="{{ request()->is('kontakt') ? 'active' : '' }}">
            Kontakt
        </a>

        <div class="nav-divider"></div>

        @auth
            <a href="{{ route('dashboard') }}"
               class="{{ request()->is('dashboard') ? 'active' : '' }}">
                Dashboard
            </a>
            <a href="{{ route('chatbot.logs') }}"
               class="{{ request()->is('chatbot') ? 'active' : '' }}">
                KI-Chatbot
            </a>

            <div class="nav-divider"></div>

            <div class="user-menu">
                <div class="user-avatar">
                    {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                </div>
                <span class="user-name">{{ Auth::user()->name }}</span>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn-logout">Abmelden</button>
                </form>
            </div>
        @else
            <a href="{{ route('login') }}" class="btn-login">Anmelden</a>
            <a href="{{ route('register') }}" class="btn-register">Registrieren</a>
        @endauth
    </div>
</nav>