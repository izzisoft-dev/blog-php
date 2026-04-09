<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{$title|default:'Blogy'}</title>
    <link rel="stylesheet" href="/css/main.css">
</head>
<body>

<header class="header">
    <div class="container">
        <a href="/" class="header__logo">Blogy.</a>
    </div>
</header>

<main class="main">
    <div class="container">
        {block name="content"}{/block}
    </div>
</main>

</body>
</html>
