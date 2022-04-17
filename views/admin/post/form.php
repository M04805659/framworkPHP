<h1>Modifier <?= $params['post']->title ?? 'Créer un nouvel article'; ?></h1>

<form action="<?= isset($params['post']) ? "/admin/posts/edit/{$params['post']->id}" : "/admin/posts/create" ?>" method="post">
    <div class="form-group">
        <label for="title"> Titre de l'article</label>
        <input type="text" class="form-control" name="title" id="title" value="<?= $params['post']->title ?? ''?>">
    </div>
    <div class="form-group">
        <label for="content">Contenu de l'article</label>
        <textarea name="content" id="content" class="form-control" rows="8"><?=  $params['post']->content  ?? ''?></textarea>
    </div>
    <div class="form-group">
        <label for="tags" class="mt-4 mb-2">Tags de l'article</label>
        <select multiple class="form-control" id="tags" name="tags[]">
           <?php foreach ($params['tags'] as $tag): ?>
               <option value="<?= $tag->id ?>"
                    <?php if(isset($params['post'])): ?>
						<?php  foreach ($params['post']->getTags() as $tagpost):
							echo ($tagpost->id === $tag->id) ? 'selected' : ''
							?>
						<?php endforeach; ?>
                    <?php endif;?>
               ><?= $tag->name?></option>
           <?php endforeach; ?>
        </select>
    </div>
    <button type="submit" class="btn btn-primary mt-4"><?= isset($params['post']) ? 'Enregister la modification' : 'Enregister mon article'?></button>

</form>