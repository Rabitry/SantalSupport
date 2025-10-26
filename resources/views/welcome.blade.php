<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Santal Community - Welcome</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- Styles -->
        <style>
            /* ! tailwindcss v3.2.4 | MIT License | https://tailwindcss.com */
            /* Your existing Tailwind styles here */
            *,
            ::after,
            ::before {
                box-sizing: border-box;
                border-width: 0;
                border-style: solid;
                border-color: #e5e7eb
            }

            ::after,
            ::before {
                --tw-content: ''
            }

            html {
                line-height: 1.5;
                -webkit-text-size-adjust: 100%;
                -moz-tab-size: 4;
                tab-size: 4;
                font-family: Figtree, sans-serif;
                font-feature-settings: normal
            }

            body {
                margin: 0;
                line-height: inherit
            }

            hr {
                height: 0;
                color: inherit;
                border-top-width: 1px
            }

            abbr:where([title]) {
                -webkit-text-decoration: underline dotted;
                text-decoration: underline dotted
            }

            h1,
            h2,
            h3,
            h4,
            h5,
            h6 {
                font-size: inherit;
                font-weight: inherit
            }

            a {
                color: inherit;
                text-decoration: inherit
            }

            b,
            strong {
                font-weight: bolder
            }

            code,
            kbd,
            pre,
            samp {
                font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace;
                font-size: 1em
            }

            small {
                font-size: 80%
            }

            sub,
            sup {
                font-size: 75%;
                line-height: 0;
                position: relative;
                vertical-align: baseline
            }

            sub {
                bottom: -.25em
            }

            sup {
                top: -.5em
            }

            table {
                text-indent: 0;
                border-color: inherit;
                border-collapse: collapse
            }

            button,
            input,
            optgroup,
            select,
            textarea {
                font-family: inherit;
                font-size: 100%;
                font-weight: inherit;
                line-height: inherit;
                color: inherit;
                margin: 0;
                padding: 0
            }

            button,
            select {
                text-transform: none
            }

            [type=button],
            [type=reset],
            [type=submit],
            button {
                -webkit-appearance: button;
                background-color: transparent;
                background-image: none
            }

            :-moz-focusring {
                outline: auto
            }

            :-moz-ui-invalid {
                box-shadow: none
            }

            progress {
                vertical-align: baseline
            }

            ::-webkit-inner-spin-button,
            ::-webkit-outer-spin-button {
                height: auto
            }

            [type=search] {
                -webkit-appearance: textfield;
                outline-offset: -2px
            }

            ::-webkit-search-decoration {
                -webkit-appearance: none
            }

            ::-webkit-file-upload-button {
                -webkit-appearance: button;
                font: inherit
            }

            summary {
                display: list-item
            }

            blockquote,
            dd,
            dl,
            figure,
            h1,
            h2,
            h3,
            h4,
            h5,
            h6,
            hr,
            p,
            pre {
                margin: 0
            }

            fieldset {
                margin: 0;
                padding: 0
            }

            legend {
                padding: 0
            }

            menu,
            ol,
            ul {
                list-style: none;
                margin: 0;
                padding: 0
            }

            textarea {
                resize: vertical
            }

            input::placeholder,
            textarea::placeholder {
                opacity: 1;
                color: #9ca3af
            }

            [role=button],
            button {
                cursor: pointer
            }

            :disabled {
                cursor: default
            }

            audio,
            canvas,
            embed,
            iframe,
            img,
            object,
            svg,
            video {
                display: block;
                vertical-align: middle
            }

            img,
            video {
                max-width: 100%;
                height: auto
            }

            [hidden] {
                display: none
            }

            *,
            ::before,
            ::after {
                --tw-border-spacing-x: 0;
                --tw-border-spacing-y: 0;
                --tw-translate-x: 0;
                --tw-translate-y: 0;
                --tw-rotate: 0;
                --tw-skew-x: 0;
                --tw-skew-y: 0;
                --tw-scale-x: 1;
                --tw-scale-y: 1;
                --tw-pan-x: ;
                --tw-pan-y: ;
                --tw-pinch-zoom: ;
                --tw-scroll-snap-strictness: proximity;
                --tw-ordinal: ;
                --tw-slashed-zero: ;
                --tw-numeric-figure: ;
                --tw-numeric-spacing: ;
                --tw-numeric-fraction: ;
                --tw-ring-inset: ;
                --tw-ring-offset-width: 0px;
                --tw-ring-offset-color: #fff;
                --tw-ring-color: rgb(59 130 246 / 0.5);
                --tw-ring-offset-shadow: 0 0 #0000;
                --tw-ring-shadow: 0 0 #0000;
                --tw-shadow: 0 0 #0000;
                --tw-shadow-colored: 0 0 #0000;
                --tw-blur: ;
                --tw-brightness: ;
                --tw-contrast: ;
                --tw-grayscale: ;
                --tw-hue-rotate: ;
                --tw-invert: ;
                --tw-saturate: ;
                --tw-sepia: ;
                --tw-drop-shadow: ;
                --tw-backdrop-blur: ;
                --tw-backdrop-brightness: ;
                --tw-backdrop-contrast: ;
                --tw-backdrop-grayscale: ;
                --tw-backdrop-hue-rotate: ;
                --tw-backdrop-invert: ;
                --tw-backdrop-opacity: ;
                --tw-backdrop-saturate: ;
                --tw-backdrop-sepia: ;
            }

            ::-webkit-backdrop {
                --tw-border-spacing-x: 0;
                --tw-border-spacing-y: 0;
                --tw-translate-x: 0;
                --tw-translate-y: 0;
                --tw-rotate: 0;
                --tw-skew-x: 0;
                --tw-skew-y: 0;
                --tw-scale-x: 1;
                --tw-scale-y: 1;
                --tw-pan-x: ;
                --tw-pan-y: ;
                --tw-pinch-zoom: ;
                --tw-scroll-snap-strictness: proximity;
                --tw-ordinal: ;
                --tw-slashed-zero: ;
                --tw-numeric-figure: ;
                --tw-numeric-spacing: ;
                --tw-numeric-fraction: ;
                --tw-ring-inset: ;
                --tw-ring-offset-width: 0px;
                --tw-ring-offset-color: #fff;
                --tw-ring-color: rgb(59 130 246 / 0.5);
                --tw-ring-offset-shadow: 0 0 #0000;
                --tw-ring-shadow: 0 0 #0000;
                --tw-shadow: 0 0 #0000;
                --tw-shadow-colored: 0 0 #0000;
                --tw-blur: ;
                --tw-brightness: ;
                --tw-contrast: ;
                --tw-grayscale: ;
                --tw-hue-rotate: ;
                --tw-invert: ;
                --tw-saturate: ;
                --tw-sepia: ;
                --tw-drop-shadow: ;
                --tw-backdrop-blur: ;
                --tw-backdrop-brightness: ;
                --tw-backdrop-contrast: ;
                --tw-backdrop-grayscale: ;
                --tw-backdrop-hue-rotate: ;
                --tw-backdrop-invert: ;
                --tw-backdrop-opacity: ;
                --tw-backdrop-saturate: ;
                --tw-backdrop-sepia: ;
            }

            ::backdrop {
                --tw-border-spacing-x: 0;
                --tw-border-spacing-y: 0;
                --tw-translate-x: 0;
                --tw-translate-y: 0;
                --tw-rotate: 0;
                --tw-skew-x: 0;
                --tw-skew-y: 0;
                --tw-scale-x: 1;
                --tw-scale-y: 1;
                --tw-pan-x: ;
                --tw-pan-y: ;
                --tw-pinch-zoom: ;
                --tw-scroll-snap-strictness: proximity;
                --tw-ordinal: ;
                --tw-slashed-zero: ;
                --tw-numeric-figure: ;
                --tw-numeric-spacing: ;
                --tw-numeric-fraction: ;
                --tw-ring-inset: ;
                --tw-ring-offset-width: 0px;
                --tw-ring-offset-color: #fff;
                --tw-ring-color: rgb(59 130 246 / 0.5);
                --tw-ring-offset-shadow: 0 0 #0000;
                --tw-ring-shadow: 0 0 #0000;
                --tw-shadow: 0 0 #0000;
                --tw-shadow-colored: 0 0 #0000;
                --tw-blur: ;
                --tw-brightness: ;
                --tw-contrast: ;
                --tw-grayscale: ;
                --tw-hue-rotate: ;
                --tw-invert: ;
                --tw-saturate: ;
                --tw-sepia: ;
                --tw-drop-shadow: ;
                --tw-backdrop-blur: ;
                --tw-backdrop-brightness: ;
                --tw-backdrop-contrast: ;
                --tw-backdrop-grayscale: ;
                --tw-backdrop-hue-rotate: ;
                --tw-backdrop-invert: ;
                --tw-backdrop-opacity: ;
                --tw-backdrop-saturate: ;
                --tw-backdrop-sepia: ;
            }

            .relative {
                position: relative
            }

            .mx-auto {
                margin-left: auto;
                margin-right: auto
            }

            .mx-6 {
                margin-left: 1.5rem;
                margin-right: 1.5rem
            }

            .ml-4 {
                margin-left: 1rem
            }

            .mt-16 {
                margin-top: 4rem
            }

            .mt-6 {
                margin-top: 1.5rem
            }

            .mt-4 {
                margin-top: 1rem
            }

            .-mt-px {
                margin-top: -1px
            }

            .mr-1 {
                margin-right: 0.25rem
            }

            .flex {
                display: flex
            }

            .inline-flex {
                display: inline-flex
            }

            .grid {
                display: grid
            }

            .h-16 {
                height: 4rem
            }

            .h-7 {
                height: 1.75rem
            }

            .h-6 {
                height: 1.5rem
            }

            .h-5 {
                height: 1.25rem
            }

            .min-h-screen {
                min-height: 100vh
            }

            .w-auto {
                width: auto
            }

            .w-16 {
                width: 4rem
            }

            .w-7 {
                width: 1.75rem
            }

            .w-6 {
                width: 1.5rem
            }

            .w-5 {
                width: 1.25rem
            }

            .max-w-7xl {
                max-width: 80rem
            }

            .shrink-0 {
                flex-shrink: 0
            }

            .scale-100 {
                --tw-scale-x: 1;
                --tw-scale-y: 1;
                transform: translate(var(--tw-translate-x), var(--tw-translate-y)) rotate(var(--tw-rotate)) skewX(var(--tw-skew-x)) skewY(var(--tw-skew-y)) scaleX(var(--tw-scale-x)) scaleY(var(--tw-scale-y))
            }

            .grid-cols-1 {
                grid-template-columns: repeat(1, minmax(0, 1fr))
            }

            .grid-cols-3 {
                grid-template-columns: repeat(3, minmax(0, 1fr))
            }

            .items-center {
                align-items: center
            }

            .justify-center {
                justify-content: center
            }

            .gap-6 {
                gap: 1.5rem
            }

            .gap-4 {
                gap: 1rem
            }

            .self-center {
                align-self: center
            }

            .rounded-lg {
                border-radius: 0.5rem
            }

            .rounded-full {
                border-radius: 9999px
            }

            .bg-gray-100 {
                --tw-bg-opacity: 1;
                background-color: rgb(243 244 246 / var(--tw-bg-opacity))
            }

            .bg-white {
                --tw-bg-opacity: 1;
                background-color: rgb(255 255 255 / var(--tw-bg-opacity))
            }

            .bg-green-50 {
                --tw-bg-opacity: 1;
                background-color: rgb(240 253 244 / var(--tw-bg-opacity))
            }

            .bg-blue-50 {
                --tw-bg-opacity: 1;
                background-color: rgb(239 246 255 / var(--tw-bg-opacity))
            }

            .bg-orange-50 {
                --tw-bg-opacity: 1;
                background-color: rgb(255 247 237 / var(--tw-bg-opacity))
            }

            .bg-dots-darker {
                background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(0,0,0,0.07)'/%3E%3C/svg%3E")
            }

            .from-gray-700\/50 {
                --tw-gradient-from: rgb(55 65 81 / 0.5);
                --tw-gradient-to: rgb(55 65 81 / 0);
                --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to)
            }

            .via-transparent {
                --tw-gradient-to: rgb(0 0 0 / 0);
                --tw-gradient-stops: var(--tw-gradient-from), transparent, var(--tw-gradient-to)
            }

            .bg-center {
                background-position: center
            }

            .stroke-green-500 {
                stroke: #22c55e
            }

            .stroke-blue-500 {
                stroke: #3b82f6
            }

            .stroke-orange-500 {
                stroke: #f97316
            }

            .stroke-gray-400 {
                stroke: #9ca3af
            }

            .p-6 {
                padding: 1.5rem
            }

            .px-6 {
                padding-left: 1.5rem;
                padding-right: 1.5rem
            }

            .text-center {
                text-align: center
            }

            .text-right {
                text-align: right
            }

            .text-xl {
                font-size: 1.25rem;
                line-height: 1.75rem
            }

            .text-sm {
                font-size: 0.875rem;
                line-height: 1.25rem
            }

            .font-semibold {
                font-weight: 600
            }

            .leading-relaxed {
                line-height: 1.625
            }

            .text-gray-600 {
                --tw-text-opacity: 1;
                color: rgb(75 85 99 / var(--tw-text-opacity))
            }

            .text-gray-900 {
                --tw-text-opacity: 1;
                color: rgb(17 24 39 / var(--tw-text-opacity))
            }

            .text-gray-500 {
                --tw-text-opacity: 1;
                color: rgb(107 114 128 / var(--tw-text-opacity))
            }

            .underline {
                -webkit-text-decoration-line: underline;
                text-decoration-line: underline
            }

            .antialiased {
                -webkit-font-smoothing: antialiased;
                -moz-osx-font-smoothing: grayscale
            }

            .shadow-2xl {
                --tw-shadow: 0 25px 50px -12px rgb(0 0 0 / 0.25);
                --tw-shadow-colored: 0 25px 50px -12px var(--tw-shadow-color);
                box-shadow: var(--tw-ring-offset-shadow, 0 0 #0000), var(--tw-ring-shadow, 0 0 #0000), var(--tw-shadow)
            }

            .shadow-gray-500\/20 {
                --tw-shadow-color: rgb(107 114 128 / 0.2);
                --tw-shadow: var(--tw-shadow-colored)
            }

            .transition-all {
                transition-property: all;
                transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
                transition-duration: 150ms
            }

            .selection\:bg-red-500 *::selection {
                --tw-bg-opacity: 1;
                background-color: rgb(239 68 68 / var(--tw-bg-opacity))
            }

            .selection\:text-white *::selection {
                --tw-text-opacity: 1;
                color: rgb(255 255 255 / var(--tw-text-opacity))
            }

            .selection\:bg-red-500::selection {
                --tw-bg-opacity: 1;
                background-color: rgb(239 68 68 / var(--tw-bg-opacity))
            }

            .selection\:text-white::selection {
                --tw-text-opacity: 1;
                color: rgb(255 255 255 / var(--tw-text-opacity))
            }

            .hover\:text-gray-900:hover {
                --tw-text-opacity: 1;
                color: rgb(17 24 39 / var(--tw-text-opacity))
            }

            .hover\:text-gray-700:hover {
                --tw-text-opacity: 1;
                color: rgb(55 65 81 / var(--tw-text-opacity))
            }

            .focus\:rounded-sm:focus {
                border-radius: 0.125rem
            }

            .focus\:outline:focus {
                outline-style: solid
            }

            .focus\:outline-2:focus {
                outline-width: 2px
            }

            .focus\:outline-red-500:focus {
                outline-color: #ef4444
            }

            .group:hover .group-hover\:stroke-gray-600 {
                stroke: #4b5563
            }

            .z-10 {
                z-index: 10
            }

            @media (prefers-reduced-motion: no-preference) {
                .motion-safe\:hover\:scale-\[1\.01\]:hover {
                    --tw-scale-x: 1.01;
                    --tw-scale-y: 1.01;
                    transform: translate(var(--tw-translate-x), var(--tw-translate-y)) rotate(var(--tw-rotate)) skewX(var(--tw-skew-x)) skewY(var(--tw-skew-y)) scaleX(var(--tw-scale-x)) scaleY(var(--tw-scale-y))
                }
            }

            @media (prefers-color-scheme: dark) {
                .dark\:bg-gray-900 {
                    --tw-bg-opacity: 1;
                    background-color: rgb(17 24 39 / var(--tw-bg-opacity))
                }

                .dark\:bg-gray-800\/50 {
                    background-color: rgb(31 41 55 / 0.5)
                }

                .dark\:bg-green-800\/20 {
                    background-color: rgb(22 101 52 / 0.2)
                }

                .dark\:bg-blue-800\/20 {
                    background-color: rgb(30 64 175 / 0.2)
                }

                .dark\:bg-orange-800\/20 {
                    background-color: rgb(154 52 18 / 0.2)
                }

                .dark\:bg-dots-lighter {
                    background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(255,255,255,0.07)'/%3E%3C/svg%3E")
                }

                .dark\:bg-gradient-to-bl {
                    background-image: linear-gradient(to bottom left, var(--tw-gradient-stops))
                }

                .dark\:stroke-gray-600 {
                    stroke: #4b5563
                }

                .dark\:text-gray-400 {
                    --tw-text-opacity: 1;
                    color: rgb(156 163 175 / var(--tw-text-opacity))
                }

                .dark\:text-white {
                    --tw-text-opacity: 1;
                    color: rgb(255 255 255 / var(--tw-text-opacity))
                }

                .dark\:shadow-none {
                    --tw-shadow: 0 0 #0000;
                    --tw-shadow-colored: 0 0 #0000;
                    box-shadow: var(--tw-ring-offset-shadow, 0 0 #0000), var(--tw-ring-shadow, 0 0 #0000), var(--tw-shadow)
                }

                .dark\:ring-1 {
                    --tw-ring-offset-shadow: var(--tw-ring-inset) 0 0 0 var(--tw-ring-offset-width) var(--tw-ring-offset-color);
                    --tw-ring-shadow: var(--tw-ring-inset) 0 0 0 calc(1px + var(--tw-ring-offset-width)) var(--tw-ring-color);
                    box-shadow: var(--tw-ring-offset-shadow), var(--tw-ring-shadow), var(--tw-shadow, 0 0 #0000)
                }

                .dark\:ring-inset {
                    --tw-ring-inset: inset
                }

                .dark\:ring-white\/5 {
                    --tw-ring-color: rgb(255 255 255 / 0.05)
                }

                .dark\:hover\:text-white:hover {
                    --tw-text-opacity: 1;
                    color: rgb(255 255 255 / var(--tw-text-opacity))
                }

                .group:hover .dark\:group-hover\:stroke-gray-400 {
                    stroke: #9ca3af
                }
            }

            @media (min-width: 640px) {
                .sm\:fixed {
                    position: fixed
                }

                .sm\:top-0 {
                    top: 0px
                }

                .sm\:right-0 {
                    right: 0px
                }

                .sm\:ml-0 {
                    margin-left: 0px
                }

                .sm\:flex {
                    display: flex
                }

                .sm\:items-center {
                    align-items: center
                }

                .sm\:justify-center {
                    justify-content: center
                }

                .sm\:justify-between {
                    justify-content: space-between
                }

                .sm\:text-left {
                    text-align: left
                }

                .sm\:text-right {
                    text-align: right
                }
            }

            @media (min-width: 768px) {
                .md\:grid-cols-2 {
                    grid-template-columns: repeat(2, minmax(0, 1fr))
                }

                .md\:grid-cols-3 {
                    grid-template-columns: repeat(3, minmax(0, 1fr))
                }
            }

            @media (min-width: 1024px) {
                .lg\:gap-8 {
                    gap: 2rem
                }

                .lg\:p-8 {
                    padding: 2rem
                }
            }

            /* Custom styles for the big image */
            .hero-image {
                width: 100%;
                max-width: 900px;
                height: 500px;
                object-fit: cover;
                border-radius: 15px;
                box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
                margin: 2rem auto;
                display: block;
            }

            @media (max-width: 768px) {
                .hero-image {
                    height: 300px;
                    max-width: 95%;
                }
            }

            .welcome-title {
                font-size: 3rem;
                font-weight: bold;
                text-align: center;
                margin-bottom: 1rem;
                color: #1f2937;
            }

            .welcome-subtitle {
                font-size: 1.5rem;
                text-align: center;
                color: #6b7280;
                margin-bottom: 3rem;
            }

            .feature-card {
                background: white;
                padding: 2rem;
                border-radius: 15px;
                box-shadow: 0 10px 25px rgba(0,0,0,0.1);
                text-align: center;
                transition: all 0.3s ease;
            }

            .feature-card:hover {
                transform: translateY(-5px);
                box-shadow: 0 15px 35px rgba(0,0,0,0.15);
            }

            .feature-icon {
                width: 80px;
                height: 80px;
                margin: 0 auto 1rem;
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
            }
        </style>
    </head>
    <body class="antialiased">
        <div class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white">
            
            <!-- Login/Register Links - SAME PLACE -->
            @if (Route::has('login'))
                <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log in</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="max-w-7xl mx-auto p-6 lg:p-8">
                <!-- Big Santal Community Image -->
                <div class="text-center mb-12">
                    <h1 class="welcome-title dark:text-white">🏠 Santal Community</h1>
                    <p class="welcome-subtitle dark:text-gray-400">Welcome to Our Digital Home</p>
                    
                    <!-- Big Image -->
                    <img 
                        src="/images/santal-community-welcome.jpg" 
                        alt="Santal Community Welcome" 
                        class="hero-image"
                        onerror="this.src='https://images.unsplash.com/photo-1518837695005-2083093ee35b?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=2070&q=80'"
                    >
                    
                    <p class="text-gray-600 dark:text-gray-400 text-lg mt-4 max-w-2xl mx-auto">
                        Connecting Santal people. Share your culture, connect with community members, and preserve our heritage together.
                    </p>
                </div>

                <!-- Santal Community Features -->
                <div class="mt-16">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 lg:gap-8">
                        <!-- Feature 1 -->
                        <div class="feature-card">
                            <div class="feature-icon bg-green-50 dark:bg-green-800/20">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" class="w-10 h-10 stroke-green-500">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z" />
                                </svg>
                            </div>
                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">Community Connect</h3>
                            <p class="text-gray-600 dark:text-gray-400 text-sm leading-relaxed">
                                Connect with Santal community members from around the Country. Share experiences and build meaningful relationships.
                            </p>
                        </div>

                        <!-- Feature 2 -->
                        <div class="feature-card">
                            <div class="feature-icon bg-blue-50 dark:bg-blue-800/20">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" class="w-10 h-10 stroke-blue-500">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 01-2.25 2.25M16.5 7.5V18a2.25 2.25 0 002.25 2.25M16.5 7.5V4.875c0-.621-.504-1.125-1.125-1.125H4.125C3.504 3.75 3 4.254 3 4.875V18a2.25 2.25 0 002.25 2.25h13.5M6 7.5h3v3H6v-3z" />
                                </svg>
                            </div>
                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">Cultural Heritage</h3>
                            <p class="text-gray-600 dark:text-gray-400 text-sm leading-relaxed">
                                Preserve and celebrate Santal culture, traditions, language, and heritage through shared stories and knowledge.
                            </p>
                        </div>

                        <!-- Feature 3 -->
                        <div class="feature-card">
                            <div class="feature-icon bg-orange-50 dark:bg-orange-800/20">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" class="w-10 h-10 stroke-orange-500">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z" />
                                </svg>
                            </div>
                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">Support Network</h3>
                            <p class="text-gray-600 dark:text-gray-400 text-sm leading-relaxed">
                                Find support, guidance, and resources from fellow community members. Together we grow stronger.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="text-center mt-16">
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-8">Get Started</h2>
                    <div class="flex flex-col sm:flex-row justify-center gap-4">
                        @auth
                            <a href="{{ url('/population') }}" class="bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-6 rounded-lg text-lg transition duration-300">
                                👥 View Community
                            </a>
                            <a href="{{ url('/population/create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg text-lg transition duration-300">
                                ➕ Add Profile
                            </a>
                        @else
                            <a href="{{ route('register') }}" class="bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-6 rounded-lg text-lg transition duration-300">
                                📝 Join Community
                            </a>
                            <a href="{{ route('login') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg text-lg transition duration-300">
                                🔑 Member Login
                            </a>
                        @endauth
                    </div>
                </div>

                <div class="flex justify-center mt-16 px-0 sm:items-center sm:justify-between">
                    <div class="text-center text-sm sm:text-left">
                        &nbsp;
                    </div>

                    <div class="text-center text-sm text-gray-500 dark:text-gray-400 sm:text-right sm:ml-0">
                        Santal Community Platform
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>