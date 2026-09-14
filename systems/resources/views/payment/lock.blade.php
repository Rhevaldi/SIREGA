<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow">
    <title>Akses Ditangguhkan | {{ config('app.name', 'SIREGA') }}</title>
    <link rel="shortcut icon" href="{{ asset(env('APP_FAVICON_PATH')) }}" type="image/x-icon">
    <style>
        :root {
            --navy: #16243a;
            --navy-soft: #263852;
            --text: #243249;
            --muted: #6d788b;
            --subtle: #f5f7fa;
            --line: #e4e9ef;
            --teal: #167d78;
            --teal-dark: #12635f;
            --gold: #c3984d;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            color: var(--text);
            font-family: Inter, ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            background: #f3f6f9;
            display: grid;
            place-items: center;
            padding: 32px 20px;
        }

        .shell {
            width: min(100%, 850px);
        }

        .topbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            margin: 0 8px 20px;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 12px;
            color: var(--navy);
            font-size: 14px;
            font-weight: 800;
            letter-spacing: .16em;
            text-transform: uppercase;
        }

        .brand-mark {
            width: 40px;
            height: 40px;
            display: grid;
            place-items: center;
            border-radius: 10px;
            color: #fff;
            background: var(--navy);
            box-shadow: 0 7px 16px rgba(22, 36, 58, .18);
        }

        .icon {
            width: 18px;
            height: 18px;
            flex: 0 0 auto;
            stroke: currentColor;
            stroke-width: 1.8;
            stroke-linecap: round;
            stroke-linejoin: round;
        }

        .brand-mark .icon {
            width: 20px;
            height: 20px;
        }

        .status {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 12px;
            border: 1px solid #e9d9b9;
            border-radius: 6px;
            color: #85672f;
            background: #fffaf1;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: .04em;
        }

        .status::before {
            content: "!";
            width: 16px;
            height: 16px;
            display: grid;
            place-items: center;
            border-radius: 50%;
            color: #fff;
            background: var(--gold);
            font-size: 10px;
            font-weight: 800;
        }

        .card {
            position: relative;
            overflow: hidden;
            padding: clamp(30px, 6vw, 64px);
            border: 1px solid #fff;
            border-radius: 18px;
            background: #fff;
            box-shadow: 0 18px 55px rgba(28, 47, 71, .11);
        }

        .card::after {
            content: "";
            position: absolute;
            width: 320px;
            height: 320px;
            right: -175px;
            bottom: -185px;
            border: 1px solid rgba(22, 125, 120, .12);
            border-radius: 50%;
            box-shadow: 0 0 0 22px rgba(22, 125, 120, .035), 0 0 0 44px rgba(22, 125, 120, .025);
            pointer-events: none;
        }

        .content {
            position: relative;
            z-index: 1;
        }

        .eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 9px;
            color: var(--teal);
            font-size: 11px;
            font-weight: 800;
            letter-spacing: .14em;
            text-transform: uppercase;
        }

        .eyebrow::before {
            content: "✓";
            width: 19px;
            height: 19px;
            display: grid;
            place-items: center;
            border-radius: 50%;
            color: #fff;
            background: var(--teal);
            font-size: 11px;
        }

        h1 {
            max-width: 650px;
            margin: 20px 0 16px;
            color: var(--navy);
            font-size: clamp(32px, 5.6vw, 54px);
            font-weight: 750;
            line-height: 1.08;
            letter-spacing: -.045em;
        }

        .intro {
            max-width: 650px;
            margin: 0;
            color: var(--muted);
            font-size: 16px;
            line-height: 1.8;
        }

        .invoice {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 16px;
            margin: 34px 0;
        }

        .detail {
            padding: 19px 20px;
            border: 1px solid var(--line);
            border-radius: 10px;
            background: var(--subtle);
        }

        .detail:last-child {
            border-left: 3px solid var(--gold);
        }

        .detail span {
            display: block;
            margin-bottom: 8px;
            color: #8792a3;
            font-size: 10px;
            font-weight: 800;
            letter-spacing: .12em;
            text-transform: uppercase;
        }

        .detail strong {
            color: var(--navy);
            font-size: 16px;
        }

        .deadline strong {
            color: #85672f;
        }

        .contact {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: space-between;
            gap: 22px;
            padding-top: 27px;
            border-top: 1px solid var(--line);
        }

        .contact p {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            margin: 0;
            color: var(--muted);
            font-size: 14px;
            line-height: 1.6;
        }

        .contact-copy {
            display: block;
        }

        .contact-icon {
            width: 38px;
            height: 38px;
            padding: 9px;
            border-radius: 10px;
            color: var(--teal);
            background: #edf8f7;
        }

        .contact b {
            display: block;
            margin-top: 3px;
            color: var(--navy);
            font-size: 19px;
            font-weight: 750;
        }

        .actions {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            min-height: 46px;
            padding: 0 19px;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 750;
            text-decoration: none;
            transition: transform .2s ease, box-shadow .2s ease, background .2s ease;
        }

        .button:hover {
            transform: translateY(-1px);
        }

        .primary {
            color: #fff;
            background: var(--teal);
            box-shadow: 0 8px 16px rgba(22, 125, 120, .18);
        }

        .primary:hover {
            background: var(--teal-dark);
        }

        .secondary {
            color: var(--navy);
            border: 1px solid #ccd5df;
            background: #fff;
        }

        .secondary:hover {
            background: var(--subtle);
        }

        .note {
            margin: 23px 0 0;
            color: #929baa;
            font-size: 12px;
            line-height: 1.65;
        }

        @media (max-width: 560px) {
            body {
                padding: 18px 12px;
            }

            .shell {
                width: 100%;
            }

            .topbar {
                align-items: flex-start;
                flex-direction: column;
                gap: 12px;
                margin: 0 3px 14px;
            }

            .brand {
                gap: 9px;
                font-size: 12px;
            }

            .brand-mark {
                width: 36px;
                height: 36px;
            }

            .status {
                width: 100%;
                justify-content: center;
                padding: 8px 10px;
                font-size: 10px;
            }

            .card {
                padding: 26px 20px 24px;
                border-radius: 16px;
            }

            .eyebrow {
                gap: 7px;
                font-size: 10px;
                letter-spacing: .1em;
            }

            h1 {
                margin: 16px 0 13px;
                font-size: clamp(29px, 9vw, 38px);
                line-height: 1.1;
                letter-spacing: -.04em;
            }

            .intro {
                font-size: 14px;
                line-height: 1.65;
            }

            .invoice {
                grid-template-columns: 1fr;
                gap: 10px;
                margin: 25px 0;
            }

            .detail {
                padding: 15px 16px;
            }

            .detail strong {
                font-size: 14px;
            }

            .contact {
                align-items: flex-start;
                flex-direction: column;
                gap: 16px;
                padding-top: 21px;
            }

            .contact p {
                width: 100%;
                gap: 10px;
                font-size: 13px;
            }

            .contact b {
                font-size: 17px;
            }

            .actions {
                width: 100%;
                gap: 8px;
            }

            .button {
                width: 100%;
                min-height: 45px;
                padding: 0 14px;
                font-size: 12px;
            }
        }

        @media (max-width: 380px) {
            .card {
                padding-right: 16px;
                padding-left: 16px;
            }

            h1 {
                font-size: 29px;
            }

            .contact b {
                font-size: 16px;
                letter-spacing: -.02em;
            }
        }
    </style>
</head>

<body>
    <main class="shell">
        <header class="topbar">
            <div class="brand">
                <div class="brand-mark" aria-hidden="true">
                    <svg class="icon" viewBox="0 0 24 24" fill="none">
                        <path d="M12 3 5 6v5c0 4.5 2.9 8.3 7 10 4.1-1.7 7-5.5 7-10V6l-7-3Z" />
                        <path d="m9 12 2 2 4-4" />
                    </svg>
                </div>
                <span>SIREGA</span>
            </div>
        </header>

        <section class="card" aria-labelledby="lock-title">
            <div class="content">
                <div class="eyebrow">Informasi layanan</div>
                <h1 id="lock-title">Akses aplikasi sedang ditangguhkan.</h1>

                <div class="contact">
                    <p>
                        <svg class="icon contact-icon" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                            <path
                                d="M22 16.9v3a2 2 0 0 1-2.2 2 19.8 19.8 0 0 1-8.6-3.1 19.5 19.5 0 0 1-6-6A19.8 19.8 0 0 1 2.1 4.2 2 2 0 0 1 4.1 2h3a2 2 0 0 1 2 1.7c.1 1 .4 2 .7 2.9a2 2 0 0 1-.5 2.1L8 9.9a16 16 0 0 0 6 6l1.2-1.3a2 2 0 0 1 2.1-.5c.9.3 1.9.6 2.9.7A2 2 0 0 1 22 16.9Z" />
                        </svg>
                        <span class="contact-copy">Silahkan hubungi untuk aktivasi ulang:<b>Zein · 0821 5017
                                9040</b></span>
                    </p>
                    <div class="actions">
                        <a class="button primary"
                            href="https://wa.me/6282150179040?text=Halo%20Zein%2C%20saya%20ingin%20konfirmasi%20pembayaran%20invoice%20PLG-SVRDN-2025005."
                            target="_blank" rel="noopener">
                            <svg class="icon" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                <path d="M20 11.5a8 8 0 0 1-11.8 7L4 20l1.5-4.1A8 8 0 1 1 20 11.5Z" />
                                <path d="M8.5 8.5c.2 1.8 2.2 4 4 4.5l1.2-1.1c.2-.2.5-.3.8-.1l1.8.8" />
                            </svg>
                            Hubungi via WhatsApp
                        </a>
                        <a class="button secondary" href="tel:+6282150179040">
                            <svg class="icon" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                <path
                                    d="M22 16.9v3a2 2 0 0 1-2.2 2 19.8 19.8 0 0 1-8.6-3.1 19.5 19.5 0 0 1-6-6A19.8 19.8 0 0 1 2.1 4.2 2 2 0 0 1 4.1 2h3a2 2 0 0 1 2 1.7c.1 1 .4 2 .7 2.9a2 2 0 0 1-.5 2.1L8 9.9a16 16 0 0 0 6 6l1.2-1.3a2 2 0 0 1 2.1-.5c.9.3 1.9.6 2.9.7A2 2 0 0 1 22 16.9Z" />
                            </svg>
                            Telepon
                        </a>
                    </div>
                </div>
            </div>
        </section>
    </main>
</body>

</html>