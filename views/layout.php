<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mon super site</title>
    <link rel="stylesheet" href="<?= SCRIPTS . DIRECTORY_SEPARATOR .'css'. DIRECTORY_SEPARATOR . 'app.css' ?>">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="/">Blog</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-between" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="/">Acceuil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/posts">les derniers articles</a>
                </li>
            </ul>

            <ul class="navbar-nav ml-auto">
                <?php if(isset($_SESSION['auth'])): ?>
                <li class="nav-item">
                    <a class="nav-link" href="/logout">Se deconnecter</a>
                </li>
                <?php endif; ?>
            </ul>
        </div>
    </nav>

    <div class="container">
		<?= $content ?>
    </div>

</body>
</html>
