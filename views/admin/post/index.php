<?php  if($_GET['success']): ?>
   <div class="alert alert-success">Vous etes Connecté</div>
<?php endif;?>
<h1> Panel d'administration </h1>

<a href="/admin/posts/create" class="btn btn-success my-3">Créer un nouvelle article</a>
<table class="table">
	<thead>
	<tr>
		<th scope="col">#</th>
		<th scope="col">Titre</th>
		<th scope="col">Publié le</th>
		<th scope="col">Action</th>
	</tr>
	</thead>
	<tbody>
		<?php foreach ( $params['posts'] as $post): ?>
			<tr>
				<th scope="row"><?= $post->id ?></th>
				<td><?= $post->title ?></td>
				<td><?= $post->getCreatedAt() ?></td>
				<td>
					<a href="/admin/posts/edit/<?= $post->id ?>" class="btn btn-warning">Modifier</a>
					<form action="/admin/posts/delete/<?= $post->id ?>" method="POST" style="display: inline">
                        <button type="submit" class="btn btn-danger">Supprimer</button>
                    </form>
				</td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>