<?php
function wp_rp_related_posts_layout()
{
  include_once RP_PLUGIN_DIR . '_inc/get-related-posts.php';
  $the_query = new WP_Query($args);
  echo '<h4>مطالب مرتبط</h4>';
  /* echo ' <div class="owl-carousel owl-theme  rp-owl-carousel">';*/
  /*echo '<ul class="related-post-wrapper">';*/
  /*    if (get_option('_rp_show_type') == 'list') {
            echo '<ul class="related-post-wrapper">';
        }
       if (get_option('_rp_show_type') == 'block') {
            echo ' <div class="owl-carousel owl-theme  rp-owl-carousel">';
        }*/
  echo (get_option('_rp_show_type') == 'list') ? '<ul class="related-post-wrapper">' : ((get_option('_rp_show_type') == 'block') ? '<div class="owl-carousel owl-theme  rp-owl-carousel">' : '');
  if ($the_query->have_posts()) :
    while ($the_query->have_posts()) : $the_query->the_post();
      /*            echo '<div class="rp-post-wrapper">
               <a href=' . get_the_permalink() . '>
               <div>' . get_the_post_thumbnail() . '</div>
               <p>' . get_the_title() . '</p>
            </a>
            </div>';*/
      /*     if (get_option('_rp_show_type') == 'list') {
                     echo '<a href=' . get_the_permalink() . '>
     <li class="related-post-list"><span>' . get_the_post_thumbnail() . '</span>' . get_the_title() . '</li>
     </a>';
                 }
                 if (get_option('_rp_show_type') == 'block') {
                     echo '<div class="rp-post-wrapper">
                         <a href=' . get_the_permalink() . '>
                         <div>' . get_the_post_thumbnail() . '</div>
                         <p>' . get_the_title() . '</p>
                      </a>
                      </div>';
                 }*/
      echo (get_option('_rp_show_type') == 'list') ? '<a href=' . get_the_permalink() . '>
<li class="related-post-list"><span>' . get_the_post_thumbnail() . '</span>' . get_the_title() . '</li>
</a>' : ((get_option('_rp_show_type') == 'block') ? '<div class="rp-post-wrapper">
                    <a href=' . get_the_permalink() . '>
                    <div>' . get_the_post_thumbnail() . '</div>
                    <p>' . get_the_title() . '</p>
                 </a>
                 </div>' : '');


    endwhile;
    wp_reset_postdata();
  else :
    echo '<div>مطلب مرتبطی پیدا نشد.</div>';
  endif;

  /*    if (get_option('_rp_show_type') == 'list') {
            echo '</ul>';
        }
        if (get_option('_rp_show_type') == 'block') {
            echo '</div>';
        }*/

  echo (get_option('_rp_show_type') == 'list') ? '</ul>' : ((get_option('_rp_show_type') == 'block') ? '</div>' : '');
  /*   </div>*/
  /*</ul>*/
}

add_shortcode('related-posts', 'wp_rp_related_posts_layout');
