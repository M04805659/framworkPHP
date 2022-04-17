<h1><?= $params['tag']->name; ?> </h1>

<?php foreach ($params['tag']->getPosts() as $post): ?>

	<div class="card mb-4">
		<div class="card-body">
			<h2><a href="/posts/<?= $post->id; ?>"><?=  $post->title; ?></a></h2>
		</div>
	</div>

<?php endforeach; ?>
