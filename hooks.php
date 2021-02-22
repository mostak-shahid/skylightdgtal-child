<?php
function add_slug_body_class( $classes ) {
    global $post;
    if ( isset( $post ) AND $post->post_type == 'page' ) {
        $classes[] = $post->post_type . '-' . $post->post_name;
    } else {
        $classes[] = $post->post_type . '-archive';
    }
    return $classes;
}
add_filter( 'body_class', 'add_slug_body_class' );

add_action('astra_header_before','custom_sticky_header');
function custom_sticky_header(){
    ?>
    <div class="main-header-bar-wrap mos-sticky-header">
        <div <?php echo astra_attr( 'main-header-bar' ); ?>>
            <div class="ast-container">
                <div class="ast-flex main-header-container">
                    <?php astra_masthead_content(); ?>
                </div><!-- Main Header Container -->
            </div><!-- ast-row -->
            <?php astra_main_header_bar_bottom(); ?>
        </div> <!-- Main Header Bar -->
    </div> <!-- Main Header Bar Wrap -->
    <?php
}
add_action('astra_main_header_bar_top', 'mos_astra_header_before', 5);
function mos_astra_header_before(){
    ?>
    <div class="main-top-bar">
        <div class="ast-container">
            <div class="ast-flex main-top-bar-container">
                <div class="column one">
                    <ul class="contact_details">
                        <li class="email"><i class="fa fa-phone"></i> <a href="tel:(646)583-1385">(646) 583-1385</a></li>
                        <li class="phone"><i class="fa fa-phone"></i> <a href="tel:(646)583-1385">(646) 583-1385</a></li>
                    </ul>                    
                </div>
            </div>
        </div>
    </div>
    <?php
}
add_action('astra_content_top','mos_custom_header');
function mos_custom_header(){
    if (is_home()) :
        $page_for_posts = get_option( 'page_for_posts' );
    ?>       
        <header class="entry-header ast-no-thumbnail ast-no-meta"><h1 class="entry-title" itemprop="headline"><?php echo get_the_title($page_for_posts) ?></h1></header>    
    <?php
    elseif (is_shop()) :
        $page_for_products = get_option( 'woocommerce_shop_page_id' );
    ?>       
        <header class="entry-header ast-no-thumbnail ast-no-meta"><h1 class="entry-title" itemprop="headline"><?php echo get_the_title($page_for_products) ?></h1></header>    
    <?php
    elseif ( is_single() && 'product' == get_post_type() ) :
    ?>       
        <header class="entry-header ast-no-thumbnail ast-no-meta"><h1 class="entry-title" itemprop="headline"><?php echo get_the_title(get_the_ID()) ?></h1></header>    
    <?php
    endif;
}