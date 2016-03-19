<h2>Blog Posts</h2>

<?php// debug($posts); ?>

<table>
    <tr>
        <th>Id</th>
        <th>タイトル</th>
        <th>投稿日</th>
    </tr>

    <?php foreach ($posts as $post) : ?>
    <tr>
        <td><?php echo h($post['Post']['id']); ?></td>
        <td><?php echo h($post['Post']['title']); ?></td>
        <td><?php echo h($post['Post']['created']); ?></td>
    </tr>
    <?php endforeach; ?>
</table>
