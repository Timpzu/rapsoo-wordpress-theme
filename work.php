<?php /* Template Name: Work */ ?>
<?php get_header(); ?>
    <main id="maincontent">
        <section class="about" aria-labelledby="about-h2">
            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                <?php if(!empty($post->post_title)) : ?>
                    <h1 id="about-h2"><?php the_title(); ?></h1>
                <?php endif; ?>
                <?php if ( has_post_thumbnail()) : ?>
                        <?php the_post_thumbnail( 'full', array( 'class'  => 'feature' ) ); ?>
                <?php endif; ?>
                <div class="body-text">
                    <?php the_content() ?>
                    <aside class="side-text">
                        <p>Aside</p>
                    </aside>
                </div>
            <?php endwhile; endif; ?>
        </section>
    </main>
<?php get_footer(); ?>