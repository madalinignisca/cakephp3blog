<!-- File: /App/Template/Articles/index.ctp -->

<h1>Blog articles</h1>
<?=$this->Html->link(
        'Add Article',
        ['controller' => 'articles', 'action' => 'add']
) ?>
<table>
    <tr>
        <th>Id</th>
        <th>Title</th>
        <th>Actions</th>
        <th>Created</th>
    </tr>
    
    <!-- Here is where we iterate through our $articles query object, printing out article i-->
    
    <?php foreach ($articles as $article): ?>
    <tr>
        <td><?= $article->id ?></td>
        <td>
            <?= $this->Html->link($article->title,
                    ['controller' => 'articles',
                        'action' => 'view',
                        $article->id])
            ?>
        </td>
        <td>
            <?= $this->Html->link('Edit',
                    ['action' => 'edit', $article->id])
            ?>
            <?= $this->Form->postLink(
                    'Delete',
                    ['action' => 'delete', $article->id],
                    ['confirm' => 'Are you sure?'])
            ?>
        </td>
        <td><?= $article->created->format(DATE_RFC850) ?></td>
    </tr>
    <?php endforeach; ?>
</table>