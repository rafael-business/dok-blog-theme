<?php
    $id 	    = get_the_ID();
    $date	    = ucfirst( get_the_date( 'F d, Y' ) );
    $thumb 	    = get_the_post_thumbnail_url( $id, 'post-thumbnail' );
    $link       = get_permalink( $id );
    $date_link  = get_day_link( get_post_time('Y'), get_post_time('m'), get_post_time('j') );
    ?>
    <li class="artigo" id="artigo-<?= $id ?>">
        <a href="<?= $link ?>">
            <img src="<?= $thumb ? $thumb : get_stylesheet_directory_uri() . '/img/no-image.png' ?>">
        </a>
        <span class="category"><?= dok_blog_get_categories( $id ); ?></span>
        <a href="<?= $link ?>">
            <h3 class="title"><?= get_the_title() ?></h3>
        </a>
        <a href="<?= $date_link ?>">
            <div class="wp-date"><?= $date ?></div>
        </a>
    </li>
<?php
