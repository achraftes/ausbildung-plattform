<footer class="site-footer">
    <div class="footer-grid">

        <div class="footer-about">
            <div class="footer-brand">Karriere<span>Nabe</span></div>
            <p class="footer-desc">
                Die Plattform für Bewerbung, Lebenslauf-Erstellung
                und Ausbildungssuche in Deutschland.
            </p>
        </div>

        <div class="footer-col">
            <h4>Plattform</h4>
            <ul>
                <li><a href="{{ url('/') }}">Startseite</a></li>
                <li><a href="{{ route('cv.create') }}">Lebenslauf erstellen</a></li>
                <li><a href="{{ route('chatbot.logs') }}">KI-Chatbot</a></li>
                <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
            </ul>
        </div>

        <div class="footer-col">
            <h4>Ausbildung</h4>
            <ul>
                <li><a href="{{ route('ausbildung.index') }}">Alle Berufe</a></li>
                <li><a href="{{ route('ausbildung.index') }}?kat=it">IT &amp; Technik</a></li>
                <li><a href="{{ route('ausbildung.index') }}?kat=handel">Handel &amp; Büro</a></li>
                <li><a href="{{ route('ausbildung.index') }}?kat=gesundheit">Gesundheit</a></li>
            </ul>
        </div>

        <div class="footer-col">
            <h4>Rechtliches</h4>
            <ul>
                <li><a href="#">Datenschutz</a></li>
                <li><a href="#">Impressum</a></li>
                <li><a href="#">AGB</a></li>
                <li><a href="#">Kontakt</a></li>
            </ul>
        </div>

    </div>

    <div class="footer-bottom">
        <span class="footer-copy">
            &copy; {{ date('Y') }} CareerHub 🇩🇪 — Alle Rechte vorbehalten
        </span>
        <div class="footer-links">
            <a href="#">Datenschutz</a>
            <a href="#">Impressum</a>
            <a href="#">Kontakt</a>
        </div>
    </div>
</footer>