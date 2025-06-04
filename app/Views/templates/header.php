<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8" />
    <title>Hap - Portaria</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
</head>

<body>
    <pre>
<?php print_r($urls); ?>
</pre>

    <!-- Navbar com Logo -->
    <nav class="navbar navbar-expand-lg bg-primary shadow-lg mb-5 fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand text-white" href="#">
                <img src="<?= base_url('img/logo.png'); ?>" alt="Logo" width="40" height="40"
                    class="d-inline-block align-text-top">
                Hap - Portaria
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <?php if (!empty($urls)) : ?>
                    <?php foreach ($urls as $name => $link) : ?>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="<?= base_url($link); ?>">
                            <?= ucfirst($name); ?>
                        </a>
                    </li>
                    <?php endforeach; ?>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>