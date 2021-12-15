<?php get_header('post'); ?>
    <main id="maincontent">
        <section class="grid portfolio-copy" aria-labelledby="heading-main">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <?php if(!empty($post->post_title)) : ?>
                    <h1 id="heading-main"><?php the_title(); ?></h1>
            <?php endif; ?>
            <?php if ( has_post_thumbnail()) : ?>
                    <?php the_post_thumbnail( 'full', array( 'class'  => 'feature' ) ); ?>
            <?php endif; ?>
            <div class="body-text">
                <?php the_content() ?>
            </div>
            <aside class="side-text">
                <h3>Additional information</h3>
                <?php echo apply_filters( 'the_content', carbon_get_the_post_meta( 'crb_details' ) ); ?>
            </aside>
        <?php endwhile; endif; ?>
        </section>
    </main>
<?php get_footer(); ?>