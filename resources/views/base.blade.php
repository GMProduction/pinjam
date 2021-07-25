<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bona+Nova:ital,wght@0,400;0,700;1,400&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/genosstyle.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/hero-slider.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/hero.css') }}" type="text/css">
    <!-- Styles -->
    <style>
        /*! normalize.css v8.0.1 | MIT License | github.com/necolas/normalize.css */
        html {
            line-height: 1.15;
            -webkit-text-size-adjust: 100%
        }

        body {
            margin: 0
        }

        a {
            background-color: transparent
        }

        [hidden] {
            display: none
        }

        html {
            font-family: system-ui, -apple-system, BlinkMacSystemFont, Segoe UI, Roboto, Helvetica Neue, Arial, Noto Sans, sans-serif, Apple Color Emoji, Segoe UI Emoji, Segoe UI Symbol, Noto Color Emoji;
            line-height: 1.5
        }

        *,
        :after,
        :before {
            box-sizing: border-box;
            border: 0 solid #e2e8f0
        }

        a {
            color: inherit;
            text-decoration: inherit
        }

        svg,
        video {
            display: block;
            vertical-align: middle
        }

        video {
            max-width: 100%;
            height: auto
        }

        .bg-white {
            --bg-opacity: 1;
            background-color: #fff;
            background-color: rgba(255, 255, 255, var(--bg-opacity))
        }

        .bg-gray-100 {
            --bg-opacity: 1;
            background-color: #f7fafc;
            background-color: rgba(247, 250, 252, var(--bg-opacity))
        }

        .border-gray-200 {
            --border-opacity: 1;
            border-color: #edf2f7;
            border-color: rgba(237, 242, 247, var(--border-opacity))
        }

        .border-t {
            border-top-width: 1px
        }

        .flex {
            display: flex
        }

        .grid {
            display: grid
        }

        .hidden {
            display: none
        }

        .items-center {
            align-items: center
        }

        .justify-center {
            justify-content: center
        }

        .font-semibold {
            font-weight: 600
        }

        .h-5 {
            height: 1.25rem
        }

        .h-8 {
            height: 2rem
        }

        .h-16 {
            height: 4rem
        }

        .text-sm {
            font-size: .875rem
        }

        .text-lg {
            font-size: 1.125rem
        }

        .leading-7 {
            line-height: 1.75rem
        }

        .mx-auto {
            margin-left: auto;
            margin-right: auto
        }

        .ml-1 {
            margin-left: .25rem
        }

        .mt-2 {
            margin-top: .5rem
        }

        .mr-2 {
            margin-right: .5rem
        }

        .ml-2 {
            margin-left: .5rem
        }

        .mt-4 {
            margin-top: 1rem
        }

        .ml-4 {
            margin-left: 1rem
        }

        .mt-8 {
            margin-top: 2rem
        }

        .ml-12 {
            margin-left: 3rem
        }

        .-mt-px {
            margin-top: -1px
        }

        .max-w-6xl {
            max-width: 72rem
        }

        .min-h-screen {
            min-height: 100vh
        }

        .overflow-hidden {
            overflow: hidden
        }

        .p-6 {
            padding: 1.5rem
        }

        .py-4 {
            padding-top: 1rem;
            padding-bottom: 1rem
        }

        .px-6 {
            padding-left: 1.5rem;
            padding-right: 1.5rem
        }

        .pt-8 {
            padding-top: 2rem
        }

        .fixed {
            position: fixed
        }

        .relative {
            position: relative
        }

        .top-0 {
            top: 0
        }

        .right-0 {
            right: 0
        }

        .shadow {
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, .1), 0 1px 2px 0 rgba(0, 0, 0, .06)
        }

        .text-center {
            text-align: center
        }

        .text-gray-200 {
            --text-opacity: 1;
            color: #edf2f7;
            color: rgba(237, 242, 247, var(--text-opacity))
        }

        .text-gray-300 {
            --text-opacity: 1;
            color: #e2e8f0;
            color: rgba(226, 232, 240, var(--text-opacity))
        }

        .text-gray-400 {
            --text-opacity: 1;
            color: #cbd5e0;
            color: rgba(203, 213, 224, var(--text-opacity))
        }

        .text-gray-500 {
            --text-opacity: 1;
            color: #a0aec0;
            color: rgba(160, 174, 192, var(--text-opacity))
        }

        .text-gray-600 {
            --text-opacity: 1;
            color: #718096;
            color: rgba(113, 128, 150, var(--text-opacity))
        }

        .text-gray-700 {
            --text-opacity: 1;
            color: #4a5568;
            color: rgba(74, 85, 104, var(--text-opacity))
        }

        .text-gray-900 {
            --text-opacity: 1;
            color: #1a202c;
            color: rgba(26, 32, 44, var(--text-opacity))
        }

        .underline {
            text-decoration: underline
        }

        .antialiased {
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale
        }

        .w-5 {
            width: 1.25rem
        }

        .w-8 {
            width: 2rem
        }

        .w-auto {
            width: auto
        }

        .grid-cols-1 {
            grid-template-columns: repeat(1, minmax(0, 1fr))
        }

        @media (min-width:640px) {
            .sm\:rounded-lg {
                border-radius: .5rem
            }

            .sm\:block {
                display: block
            }

            .sm\:items-center {
                align-items: center
            }

            .sm\:justify-start {
                justify-content: flex-start
            }

            .sm\:justify-between {
                justify-content: space-between
            }

            .sm\:h-20 {
                height: 5rem
            }

            .sm\:ml-0 {
                margin-left: 0
            }

            .sm\:px-6 {
                padding-left: 1.5rem;
                padding-right: 1.5rem
            }

            .sm\:pt-0 {
                padding-top: 0
            }

            .sm\:text-left {
                text-align: left
            }

            .sm\:text-right {
                text-align: right
            }
        }

        @media (min-width:768px) {
            .md\:border-t-0 {
                border-top-width: 0
            }

            .md\:border-l {
                border-left-width: 1px
            }

            .md\:grid-cols-2 {
                grid-template-columns: repeat(2, minmax(0, 1fr))
            }
        }

        @media (min-width:1024px) {
            .lg\:px-8 {
                padding-left: 2rem;
                padding-right: 2rem
            }
        }

        @media (prefers-color-scheme:dark) {
            .dark\:bg-gray-800 {
                --bg-opacity: 1;
                background-color: #2d3748;
                background-color: rgba(45, 55, 72, var(--bg-opacity))
            }

            .dark\:bg-gray-900 {
                --bg-opacity: 1;
                background-color: #1a202c;
                background-color: rgba(26, 32, 44, var(--bg-opacity))
            }

            .dark\:border-gray-700 {
                --border-opacity: 1;
                border-color: #4a5568;
                border-color: rgba(74, 85, 104, var(--border-opacity))
            }

            .dark\:text-white {
                --text-opacity: 1;
                color: #fff;
                color: rgba(255, 255, 255, var(--text-opacity))
            }

            .dark\:text-gray-400 {
                --text-opacity: 1;
                color: #cbd5e0;
                color: rgba(203, 213, 224, var(--text-opacity))
            }
        }

    </style>

    <style>


    </style>
</head>

<body class="antialiased">
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-transparent fixed-top navtop">
            <div class="container">
                <div class="d-flex items-center">
                    <a href="/">
                        <img src="{{ asset('static-image/logo-karisma.png') }}" style="height: 40px;" />

                    </a>
                    <a class="navbar-brand ms-3 d-none d-lg-block" href="/"
                        style="font-weight: 700; font-size: 1rem; ">Kharisma Tunggal Kamikawa</a>
                </div>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarToggler"
                    aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse " id="navbarToggler">
                    <ul class="navbar-nav mb-2 mb-lg-0 ms-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="#">Home</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="https://syariah.iain-surakarta.ac.id/">Tentang Kami</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="https://syariah.iain-surakarta.ac.id/download-2/">Produk</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="/materi-kuliah">Download</a>
                        </li>
                    </ul>

                    <div style="width: 100px">
                        <svg class="icon-sosmed" viewBox="0 0 24 24">
                            <path
                                d="M12 2.04C6.5 2.04 2 6.53 2 12.06C2 17.06 5.66 21.21 10.44 21.96V14.96H7.9V12.06H10.44V9.85C10.44 7.34 11.93 5.96 14.22 5.96C15.31 5.96 16.45 6.15 16.45 6.15V8.62H15.19C13.95 8.62 13.56 9.39 13.56 10.18V12.06H16.34L15.89 14.96H13.56V21.96A10 10 0 0 0 22 12.06C22 6.53 17.5 2.04 12 2.04Z" />
                        </svg>

                        <svg class="icon-sosmed" viewBox="0 0 24 24">
                            <path
                                d="M7.8,2H16.2C19.4,2 22,4.6 22,7.8V16.2A5.8,5.8 0 0,1 16.2,22H7.8C4.6,22 2,19.4 2,16.2V7.8A5.8,5.8 0 0,1 7.8,2M7.6,4A3.6,3.6 0 0,0 4,7.6V16.4C4,18.39 5.61,20 7.6,20H16.4A3.6,3.6 0 0,0 20,16.4V7.6C20,5.61 18.39,4 16.4,4H7.6M17.25,5.5A1.25,1.25 0 0,1 18.5,6.75A1.25,1.25 0 0,1 17.25,8A1.25,1.25 0 0,1 16,6.75A1.25,1.25 0 0,1 17.25,5.5M12,7A5,5 0 0,1 17,12A5,5 0 0,1 12,17A5,5 0 0,1 7,12A5,5 0 0,1 12,7M12,9A3,3 0 0,0 9,12A3,3 0 0,0 12,15A3,3 0 0,0 15,12A3,3 0 0,0 12,9Z" />
                        </svg>
                    </div>

                </div>
            </div>
        </nav>

    </header>
    <main>

        <div class="demo-cont">
            <!-- slider start -->
            <div class="fnc-slider example-slider">
                <div class="fnc-slider__slides">
                    <!-- slide start -->
                    <div class="fnc-slide m--blend-green m--active-slide">
                        <div class="fnc-slide__inner">
                          
                            <div class="fnc-slide__content">
                                <h2 class="fnc-slide__heading">
                                    <div class="fnc-slide__heading-line">
                                        <span>DRY</span>
                                    </div>
                                    <div class="fnc-slide__heading-line">
                                        <span>MIST</span>
                                    </div>
                                </h2>
                                <button type="button" class="fnc-slide__action-btn">
                                    Lihat Detail
                                    <span data-text="Lihat Detail">Lihat Detail</span>
                                </button>
                            </div>
                        </div>
                    </div>
                    <!-- slide end -->
                    <!-- slide start -->
                    <div class="fnc-slide m--blend-dark">
                        <div class="fnc-slide__inner">
                            
                            <div class="fnc-slide__content">
                                <h2 class="fnc-slide__heading">
                                    <div class="fnc-slide__heading-line">
                                        <span>HANDHELD</span>
                                    </div>
                                    <div class="fnc-slide__heading-line">
                                        <span>SPRAYER</span>
                                    </div>
                                </h2>
                                <button type="button" class="fnc-slide__action-btn">
                                    Lihat Detail
                                    <span data-text="Lihat Detail">Lihat Detail</span>
                                </button>
                            </div>
                        </div>
                    </div>
                    <!-- slide end -->
                    <!-- slide start -->
                    <div class="fnc-slide m--blend-red">
                        <div class="fnc-slide__inner">
                            
                            <div class="fnc-slide__content">
                                <h2 class="fnc-slide__heading">
                                    <div class="fnc-slide__heading-line">
                                        <span>BACKPACK</span>
                                    </div>
                                    <div class="fnc-slide__heading-line">
                                        <span>
                                            SPRAYER
                                        </span>
                                    </div>
                                </h2>
                                <button type="button" class="fnc-slide__action-btn">
                                    Lihat Detail
                                    <span data-text="Lihat Detail">Lihat Detail</span>
                                </button>
                            </div>
                        </div>
                    </div>
                    <!-- slide end -->
                    <!-- slide start -->
                    <div class="fnc-slide m--blend-blue">
                        <div class="fnc-slide__inner">
                           
                            <div class="fnc-slide__content">
                                <h2 class="fnc-slide__heading">
                                    <div class="fnc-slide__heading-line">
                                        <span>ATOM</span>
                                    </div>
                                    <div class="fnc-slide__heading-line">
                                        <span>SPRAYER</span>
                                    </div>
                                </h2>
                                <button type="button" class="fnc-slide__action-btn">
                                    Lihat Detail
                                    <span data-text="Lihat Detail">Lihat Detail</span>
                                </button>
                            </div>
                        </div>
                    </div>
                    <!-- slide end -->
                </div>
                <nav class="fnc-nav">
                    <div class="fnc-nav__bgs">
                        <div class="fnc-nav__bg m--navbg-green m--active-nav-bg"></div>
                        <div class="fnc-nav__bg m--navbg-dark"></div>
                        <div class="fnc-nav__bg m--navbg-red"></div>
                        <div class="fnc-nav__bg m--navbg-blue"></div>
                    </div>
                    <div class="fnc-nav__controls">
                        <button class="fnc-nav__control">
                            Dry Mist
                            <span class="fnc-nav__control-progress"></span>
                        </button>
                        <button class="fnc-nav__control">
                            Handheld Sprayer
                            <span class="fnc-nav__control-progress"></span>
                        </button>
                        <button class="fnc-nav__control">
                            Backpack Sprayer
                            <span class="fnc-nav__control-progress"></span>
                        </button>
                        <button class="fnc-nav__control">
                            Atom Sprayer
                            <span class="fnc-nav__control-progress"></span>
                        </button>
                    </div>
                </nav>
            </div>
            <!-- slider end -->
            <div class="demo-cont__Lihat Detail">
                <div class="demo-cont__Lihat Detail-close"></div>
                <h2 class="demo-cont__Lihat Detail-heading">Made by</h2>
                <img src="//s3-us-west-2.amazonaws.com/s.cdpn.io/142996/profile/profile-512_5.jpg" alt=""
                    class="demo-cont__Lihat Detail-img" />
                <h3 class="demo-cont__Lihat Detail-name">Nikolay Talanov</h3>
                <a href="https://codepen.io/suez/" target="_blank" class="demo-cont__Lihat Detail-link">My codepen</a>
                <a href="https://twitter.com/NikolayTalanov" target="_blank" class="demo-cont__Lihat Detail-link">My
                    twitter</a>
                <h2 class="demo-cont__Lihat Detail-heading">Based on</h2>
                <a href="https://dribbble.com/shots/2375246-Fashion-Butique-slider-animation" target="_blank"
                    class="demo-cont__Lihat Detail-link">Concept by Kreativa Studio</a>
                <h4 class="demo-cont__Lihat Detail-blend">Global Blend Mode</h4>
                <div class="colorful-switch">
                    <input type="checkbox" class="colorful-switch__checkbox js-activate-global-blending"
                        id="colorful-switch-cb" />
                    <label class="colorful-switch__label" for="colorful-switch-cb">
                        <span class="colorful-switch__bg"></span>
                        <span class="colorful-switch__dot"></span>
                        <span class="colorful-switch__on">
                            <span class="colorful-switch__on__inner"></span>
                        </span>
                        <span class="colorful-switch__off"></span>
                    </label>
                </div>
            </div>
        </div>


        <hr class="divider mt-5"/>
        <h1 class="title mt-5">
            Mengapa Harus Kharisma Tunggal Kamikawa
        </h1>
    </main>



    <footer class="container-fluid footerstyle">
        <div class="footer-up">
            <div class="row row-cols-lg-3">
                <div class="col">
                    <p class="title-footer">
                        Contact
                    </p>

                    <div class="content-footer">
                        <table>
                            <td style="vertical-align:top">
                                <svg class="icon me-2" viewBox="0 0 24 24">
                                    <path
                                        d="M12,6.5A2.5,2.5 0 0,1 14.5,9A2.5,2.5 0 0,1 12,11.5A2.5,2.5 0 0,1 9.5,9A2.5,2.5 0 0,1 12,6.5M12,2A7,7 0 0,1 19,9C19,14.25 12,22 12,22C12,22 5,14.25 5,9A7,7 0 0,1 12,2M12,4A5,5 0 0,0 7,9C7,10 7,12 12,18.71C17,12 17,10 17,9A5,5 0 0,0 12,4Z" />
                                </svg>
                            </td>

                            <td>
                                <p>Jl. Pandawa, Dusun IV, Pucangan, Kec. Kartasura, Kabupaten Sukoharjo, Jawa Tengah
                                    57168
                                </p>

                            </td>

                        </table>
                    </div>

                    <table>
                        <td style="vertical-align:top">
                            <svg class="icon me-2" viewBox="0 0 24 24">
                                <path
                                    d="M20,15.5C18.8,15.5 17.5,15.3 16.4,14.9C16.3,14.9 16.2,14.9 16.1,14.9C15.8,14.9 15.6,15 15.4,15.2L13.2,17.4C10.4,15.9 8,13.6 6.6,10.8L8.8,8.6C9.1,8.3 9.2,7.9 9,7.6C8.7,6.5 8.5,5.2 8.5,4C8.5,3.5 8,3 7.5,3H4C3.5,3 3,3.5 3,4C3,13.4 10.6,21 20,21C20.5,21 21,20.5 21,20V16.5C21,16 20.5,15.5 20,15.5M5,5H6.5C6.6,5.9 6.8,6.8 7,7.6L5.8,8.8C5.4,7.6 5.1,6.3 5,5M19,19C17.7,18.9 16.4,18.6 15.2,18.2L16.4,17C17.2,17.2 18.1,17.4 19,17.4V19Z" />
                            </svg>
                        </td>

                        <td>
                            <p>(0271) 781516
                            </p>

                        </td>

                    </table>

                    <table>
                        <td style="vertical-align:top">
                            <svg class="icon me-2" viewBox="0 0 24 24">
                                <path
                                    d="M22 6C22 4.9 21.1 4 20 4H4C2.9 4 2 4.9 2 6V18C2 19.1 2.9 20 4 20H20C21.1 20 22 19.1 22 18V6M20 6L12 11L4 6H20M20 18H4V8L12 13L20 8V18Z" />
                            </svg>
                        </td>

                        <td>
                            <p>info@iain-surakarta.ac.id</p>

                        </td>

                    </table>

                    <table>
                        <td style="vertical-align:top">
                            <svg class="icon me-2" viewBox="0 0 24 24">
                                <path
                                    d="M16.36,14C16.44,13.34 16.5,12.68 16.5,12C16.5,11.32 16.44,10.66 16.36,10H19.74C19.9,10.64 20,11.31 20,12C20,12.69 19.9,13.36 19.74,14M14.59,19.56C15.19,18.45 15.65,17.25 15.97,16H18.92C17.96,17.65 16.43,18.93 14.59,19.56M14.34,14H9.66C9.56,13.34 9.5,12.68 9.5,12C9.5,11.32 9.56,10.65 9.66,10H14.34C14.43,10.65 14.5,11.32 14.5,12C14.5,12.68 14.43,13.34 14.34,14M12,19.96C11.17,18.76 10.5,17.43 10.09,16H13.91C13.5,17.43 12.83,18.76 12,19.96M8,8H5.08C6.03,6.34 7.57,5.06 9.4,4.44C8.8,5.55 8.35,6.75 8,8M5.08,16H8C8.35,17.25 8.8,18.45 9.4,19.56C7.57,18.93 6.03,17.65 5.08,16M4.26,14C4.1,13.36 4,12.69 4,12C4,11.31 4.1,10.64 4.26,10H7.64C7.56,10.66 7.5,11.32 7.5,12C7.5,12.68 7.56,13.34 7.64,14M12,4.03C12.83,5.23 13.5,6.57 13.91,8H10.09C10.5,6.57 11.17,5.23 12,4.03M18.92,8H15.97C15.65,6.75 15.19,5.55 14.59,4.44C16.43,5.07 17.96,6.34 18.92,8M12,2C6.47,2 2,6.5 2,12A10,10 0 0,0 12,22A10,10 0 0,0 22,12A10,10 0 0,0 12,2Z" />
                            </svg>
                        </td>

                        <td>
                            <p> https://iain-surakarta.ac.id</p>

                        </td>

                    </table>

                </div>
                <div class="col">
                    <p class="title-footer">Menu</p>
                    <div class="content-footer">
                        <a href="#" class="d-block link">Profil</a>
                        <a href="https://syariah.iain-surakarta.ac.id/" class="d-block link">Informasi</a>
                        <a href="https://syariah.iain-surakarta.ac.id/download-2/" class="d-block link">Layanan</a>
                        <a href="#" class="d-block link">Materi Kuliah</a>
                    </div>
                </div>

                <div class="col">
                    <p class="title-footer">Stay Connected</p>
                    <div class="d-flex">
                        <svg class="icon-sosmed me-2" viewBox="0 0 24 24">
                            <path
                                d="M12 2.04C6.5 2.04 2 6.53 2 12.06C2 17.06 5.66 21.21 10.44 21.96V14.96H7.9V12.06H10.44V9.85C10.44 7.34 11.93 5.96 14.22 5.96C15.31 5.96 16.45 6.15 16.45 6.15V8.62H15.19C13.95 8.62 13.56 9.39 13.56 10.18V12.06H16.34L15.89 14.96H13.56V21.96A10 10 0 0 0 22 12.06C22 6.53 17.5 2.04 12 2.04Z" />
                        </svg>

                        <svg class="icon-sosmed" viewBox="0 0 24 24">
                            <path
                                d="M7.8,2H16.2C19.4,2 22,4.6 22,7.8V16.2A5.8,5.8 0 0,1 16.2,22H7.8C4.6,22 2,19.4 2,16.2V7.8A5.8,5.8 0 0,1 7.8,2M7.6,4A3.6,3.6 0 0,0 4,7.6V16.4C4,18.39 5.61,20 7.6,20H16.4A3.6,3.6 0 0,0 20,16.4V7.6C20,5.61 18.39,4 16.4,4H7.6M17.25,5.5A1.25,1.25 0 0,1 18.5,6.75A1.25,1.25 0 0,1 17.25,8A1.25,1.25 0 0,1 16,6.75A1.25,1.25 0 0,1 17.25,5.5M12,7A5,5 0 0,1 17,12A5,5 0 0,1 12,17A5,5 0 0,1 7,12A5,5 0 0,1 12,7M12,9A3,3 0 0,0 9,12A3,3 0 0,0 12,15A3,3 0 0,0 15,12A3,3 0 0,0 12,9Z" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>
        <div style="height: 50px; background-color: #1caa5c" class="d-flex justify-content-center align-items-center">
            <p class="mb-0 "> Copy Right 2020</p>
        </div>

    </footer>

    <script src="{{ asset('bootstrap/js/jquery.js') }}"></script>
    <script src="{{ asset('bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/hero-slider.js') }}"></script>
    <script src="{{ asset('js/genosstyle.js') }}"></script>





</body>

</html>
