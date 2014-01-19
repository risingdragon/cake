<h2><?php echo h($post['Post']['title']); ?></h2>

<p><small>Created: <?php echo date('Y-m-d H:i:s', $post['Post']['created']->sec); ?></small></p>

<p><?php echo h($post['Post']['body']); ?></p>
