<?php

/**
 * @file
 * Display Suite reset template For-More-Information.
 */
?><div class="vcard proper-name">
<?php print $ds_content; ?>
<?php if (!empty($drupal_render_children)): ?>
  <?php print $drupal_render_children ?>
<?php endif; ?>
</div>