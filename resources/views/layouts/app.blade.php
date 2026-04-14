<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>KarriereNabe – @yield('title', 'Startseite')</title>

    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@400;600;700;800&family=DM+Sans:wght@400;500;600&display=swap" rel="stylesheet">

    <style>
        /* ══════════════════════════════
           RESET & BASE
        ══════════════════════════════ */
        *, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }

        :root {
            --primary:   #1a1a2e;
            --accent:    #e94560;
            --accent-hv: #c73652;
            --light:     #f5f5f7;
            --white:     #ffffff;
            --muted:     #6c757d;
            --border:    #e9ecef;
            --radius:    10px;
            --font-head: 'Sora', sans-serif;
            --font-body: 'DM Sans', sans-serif;
        }

        body {
            font-family: var(--font-body);
            background: var(--light);
            color: var(--primary);
            line-height: 1.6;
        }

        a { text-decoration: none; color: inherit; }
        ul { list-style: none; }
        button { font-family: inherit; cursor: pointer; }

        /* ══════════════════════════════
           NAVBAR
        ══════════════════════════════ */
        .navbar {
            background: var(--white);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 2.5rem;
            height: 65px;
            border-bottom: 1px solid var(--border);
            position: sticky;
            top: 0;
            z-index: 999;
            box-shadow: 0 2px 16px rgba(0,0,0,0.04);
        }

        .nav-brand {
            font-family: var(--font-head);
            font-size: 1.35rem;
            font-weight: 800;
            color: var(--primary);
            display: flex;
            align-items: center;
            gap: 7px;
        }
        .nav-brand span { color: var(--accent); }
        .brand-dot {
            width: 7px; height: 7px;
            border-radius: 50%;
            background: var(--accent);
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 4px;
        }
        .nav-links a {
            padding: 7px 14px;
            border-radius: 8px;
            font-size: 0.875rem;
            font-weight: 500;
            color: var(--muted);
            transition: all 0.15s;
        }
        .nav-links a:hover { color: var(--primary); background: var(--light); }
        .nav-links a.active { color: var(--accent); background: #fff0f3; font-weight: 600; }

        .nav-divider {
            width: 1px; height: 22px;
            background: var(--border);
            margin: 0 8px;
        }
   
        
        /* Boutons navbar */
        .btn-login {
            padding: 7px 18px;
            border-radius: 8px;
            font-size: 0.8rem;
            font-weight: 600;
            border: 1.5px solid var(--border);
            color: var(--primary);
            background: var(--white);
            transition: all 0.15s;
        }
        .btn-login:hover { border-color: var(--accent); color: var(--accent); }

        .btn-register {
            padding: 7px 18px;
            border-radius: 8px;
            font-size: 0.8rem;
            font-weight: 600;
            background: var(--accent);
            color: var(--white);
            border: none;
            transition: background 0.15s;
        }
        .btn-register:hover { background: var(--accent-hv); }

        /* User menu */
        .user-menu { display: flex; align-items: center; gap: 10px; }
        .user-avatar {
            width: 34px; height: 34px;
            border-radius: 50%;
            background: var(--accent);
            color: var(--white);
            font-size: 0.8rem;
            font-weight: 700;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .user-name { font-size: 0.875rem; font-weight: 600; }
        .btn-logout {
            padding: 6px 14px;
            border-radius: 7px;
            font-size: 0.8rem;
            font-weight: 600;
            border: 1.5px solid var(--border);
            color: var(--muted);
            background: var(--white);
            transition: all 0.15s;
        }
        .btn-logout:hover { border-color: var(--accent); color: var(--accent); }

        /* ══════════════════════════════
           ALERTS
        ══════════════════════════════ */
        .alert {
            padding: 0.8rem 2rem;
            text-align: center;
            font-size: 0.875rem;
            font-weight: 500;
            border-bottom: 1px solid;
        }
        .alert-success {
            background: #d4edda; color: #155724;
            border-color: #c3e6cb;
        }
        .alert-error {
            background: #f8d7da; color: #721c24;
            border-color: #f5c6cb;
        }

        /* ══════════════════════════════
           MAIN CONTENT
        ══════════════════════════════ */
        main { min-height: calc(100vh - 65px - 280px); }

        /* ══════════════════════════════
           SCROLL TO TOP BUTTON
        ══════════════════════════════ */
        .scroll-top {
            position: fixed;
            bottom: 30px;
            right: 30px;
            width: 50px;
            height: 50px;
            background: var(--accent);
            color: white;
            border: none;
            border-radius: 50%;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(233, 69, 96, 0.3);
            z-index: 999;
        }

        .scroll-top.show {
            opacity: 1;
            visibility: visible;
        }

        .scroll-top:hover {
            background: var(--accent-hv);
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(233, 69, 96, 0.4);
        }

        .scroll-top:active {
            transform: translateY(0);
        }

        /* ══════════════════════════════
           FOOTER
        ══════════════════════════════ */
        .site-footer {
            background: var(--primary);
            color: rgba(255,255,255,0.65);
            padding: 3.5rem 2.5rem 1.5rem;
        }
        .footer-grid {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1fr;
            gap: 2.5rem;
            max-width: 1100px;
            margin: 0 auto 2.5rem;
        }
        .footer-brand {
            font-family: var(--font-head);
            font-size: 1.3rem;
            font-weight: 800;
            color: var(--white);
            margin-bottom: 0.8rem;
        }
        .footer-brand span { color: var(--accent); }
        .footer-desc {
            font-size: 0.85rem;
            line-height: 1.7;
            color: rgba(255,255,255,0.45);
            max-width: 240px;
        }
        .footer-col h4 {
            font-size: 0.75rem;
            font-weight: 700;
            color: var(--white);
            margin-bottom: 1rem;
            text-transform: uppercase;
            letter-spacing: 0.6px;
        }
        .footer-col ul { display: flex; flex-direction: column; gap: 9px; }
        .footer-col ul li a {
            font-size: 0.875rem;
            color: rgba(255,255,255,0.45);
            transition: color 0.15s;
        }
        .footer-col ul li a:hover { color: var(--accent); }

        .footer-bottom {
            max-width: 1100px;
            margin: 0 auto;
            padding-top: 1.5rem;
            border-top: 1px solid rgba(255,255,255,0.08);
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 0.8rem;
        }
        .footer-copy { font-size: 0.8rem; color: rgba(255,255,255,0.3); }
        .footer-links { display: flex; gap: 1.5rem; }
        .footer-links a { font-size: 0.8rem; color: rgba(255,255,255,0.3); }
        .footer-links a:hover { color: var(--accent); }

        /* ══════════════════════════════
           RESPONSIVE
        ══════════════════════════════ */
        @media (max-width: 900px) {
            .footer-grid { grid-template-columns: 1fr 1fr; }
        }
        @media (max-width: 600px) {
            .navbar { padding: 0 1rem; }
            .nav-links a { padding: 6px 9px; font-size: 0.8rem; }
            .footer-grid { grid-template-columns: 1fr; }
            .footer-bottom { flex-direction: column; text-align: center; }
            .scroll-top {
                bottom: 20px;
                right: 20px;
                width: 45px;
                height: 45px;
                font-size: 1.3rem;
            }
        }
    </style>

    @stack('styles')
</head>
<body>

    @include('partials.header')

    <main>
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-error">{{ session('error') }}</div>
        @endif

        @yield('content')
    </main>

    @include('partials.footer')

    <!-- Scroll to Top Button -->
    <button class="scroll-top" id="scrollTopBtn" aria-label="Nach oben scrollen">
        ↑
    </button>

    <script>
        // Scroll to Top Button Logic
        (function() {
            const scrollBtn = document.getElementById('scrollTopBtn');
            
            if (!scrollBtn) return;
            
            // Show/hide button based on scroll position
            function toggleScrollButton() {
                if (window.scrollY > 300) {
                    scrollBtn.classList.add('show');
                } else {
                    scrollBtn.classList.remove('show');
                }
            }
            
            // Scroll to top smoothly
            function scrollToTop() {
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            }
            
            // Add event listeners
            window.addEventListener('scroll', toggleScrollButton);
            scrollBtn.addEventListener('click', scrollToTop);
            
            // Initial check
            toggleScrollButton();
        })();
    </script>

    @stack('scripts')
</body>
</html>