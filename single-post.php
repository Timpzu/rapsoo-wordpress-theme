<?php get_header('post'); ?>
    <main id="maincontent">
        <section class="grid portfolio-copy" aria-labelledby="heading-main">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <?php if(!empty($post->post_title)) : ?>
                    <h1 id="heading-main"><?php the_title(); ?></h1>
            <?php endif; ?>
            <figure class="feature">
                <?php if ( has_post_thumbnail()) : ?>
                    <?php  the_post_thumbnail( 'full'); ?>
                    <?php if ( !empty(get_the_post_thumbnail_caption()) ) : ?>
                        <figcaption><?php  the_post_thumbnail_caption() ?></figcaption>
                    <?php endif; ?>
                <?php endif; ?>
            </figure>
            <div class="body-text">
                <?php the_content() ?>
            </div>
            <aside class="side-text">
                <h3>Additional information</h3>
                <?php echo apply_filters( 'the_content', carbon_get_the_post_meta( 'crb_details' ) ); ?>
                <ul class="tag-list">
                    <?php
                    $tags = get_the_tags();
                    if ( $tags ) :
                        echo '<h4>Tags</h4>';
                        foreach ( $tags as $tag ) : ?>
                            <li><?php echo esc_html( $tag->name ); ?></li>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </ul>
            </aside>
        <?php endwhile; endif; ?>
        </section>
    </main>
<?php get_footer(); ?>