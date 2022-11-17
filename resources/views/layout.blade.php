<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Adoorei ❤️</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">


        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
    </head>
    <body>
        
        <header>
            <h1>Adoorei ❤️</h1>
        </header>

        <main>
            @yield('content')
        </main>

        <footer>
            by <strong>Rodrigo Nishino</strong>
        </footer>

        <style>
        
            html {
                scroll-behavior: smooth;
            }

            body
            {
                padding: 0;
                margin: 0;
                display: flex;
                flex-direction: column;
                height: 100vh;
                scroll-behavior: smooth;
            }

            header, main, footer
            {
                padding: 64px;
            }

            header{ background-color: #eee; }
            footer{ background-color: #888; color: white; }

            h1{ margin: 0; padding: 0; }

        </style>

    </body>
</html>
