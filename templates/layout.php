<html lang="pl">
    <head>
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <meta charset="utf-8">
    <title>Strona</title>
    <link rel="stylesheet" href="public/styl.css">
    <script href="public/skrypt.js" >
    </script> 
    </head>
    <body>
        <header></header>
        <nav>
            <ul class="menu">
                <li><a href="/?&app=Task">Podglad zadan</a></li>
                <li><a href="/?action=create&app=Task">Dodaj zadanie</a></li>
            </ul>
        </nav>
        <main>
        <article>
            <scection> 
            <?php 
                require_once("templates/pages/$page.php");
            ?>
            </scection>
        </article>
        </main>
        <footer>Copy right@ InforMar 2022r</footer>
    </body>
</html>

