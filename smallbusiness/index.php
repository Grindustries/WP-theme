<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
get_header();
?>
<h1>Blog</h1>


<?php
$custom_terms = get_terms('customer_type');

foreach ($custom_terms as $custom_term) {
    wp_reset_query();
    $args = array('post_type' => 'testimonials',
        'tax_query' => array(
            array(
                'taxonomy' => 'customer_type',
                'field' => 'slug',
                'terms' => $custom_term->slug,
            ),
        ),
    );

    $loop = new WP_Query($args);
    if ($loop->have_posts()) {
        echo '<h2>' . $custom_term->name . '</h2>';

        while ($loop->have_posts()) : $loop->the_post();
            ?><div style="width: 350px; background-color: #398f14;">
                <h3><?php echo get_the_title(); ?></h3>

                <br>

                <p><?php echo get_the_content(); ?></p>
            </div><?php
        endwhile;
    }
}


get_footer();
