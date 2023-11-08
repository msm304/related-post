  <?php

  global $post;
  $total_posts = !empty(get_option('_rp_number')) ?   get_option('_rp_number') : '4';
  $related_by =  !empty(get_option('_rp_according_to')) ?   get_option('_rp_according_to') : 'category';
  $order_by =  !empty(get_option('_rp_show_type')) ?   get_option('_rp_show_type') : 'rand';
  if ($related_by == 'category') {
    $cats = get_the_category($post->ID);
    $cat_id = '';
    foreach ($cats as $cat) $cat_id .= $cat->cat_ID . ',';
    $args = [
      'post_type' => 'post',
      'post_per_page' => $total_posts,
      'cat' => $cat_id,
      'orderby' => $order_by,
      'post__not_in' => [$post->ID],
      'status' => 'publish',
    ];
  } elseif ($related_by == 'tags') {
    $tags = wp_get_post_tags($post->ID);
    $tags_id = [];
    foreach ($tags as $tag) $tags_id[] = $tag->term_id;
    $args = [
      'post_type' => 'post',
      'post_per_page' => $total_posts,
      'tag__in' => $tags_id,
      'orderby' => $order_by,
      'post__not_in' => [$post->ID],
      'status' => 'publish',
    ];
  }
