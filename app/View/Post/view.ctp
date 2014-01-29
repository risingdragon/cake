<h2><?php echo h($post['Post']['title']); ?></h2>

<p>Email: <?php echo h($post['Post']['email']); ?></p>
<p><small>Created: <?php echo date('Y-m-d H:i:s', $post['Post']['created']->sec); ?></small></p>
<p><small>Modified: <?php echo date('Y-m-d H:i:s', $post['Post']['modified']->sec); ?></small></p>

<p><?php echo h($post['Post']['body']); ?></p>
