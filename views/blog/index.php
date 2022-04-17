<h1>Les derniers articles </h1>

<?php foreach ($params['posts'] as $post): ?>

<div class="card mb-4">
    <div class="card-body">
        <h2><?=  $post->title; ?></h2>
        <div>
            <?php foreach ($post->getTags() as $tag) : ?>
                <span class="badge bg-secondary">
                    <a href="/tags/<?= $tag->id; ?>" class="text-white text-decoration-none"><?= $tag->name ?></a>
                </span>
            <?php endforeach; ?>
        </div>
        <span class="text-info">Publié le <?= $post->getCreatedAt(); ?></span>
        <p> <?= $post->getExcerpt(); ?></p>
        <?= $post->getButton(); ?>
    </div>
</div>

<?php endforeach; ?>
