<?php get_header(); ?>
<main id="maincontent">
    <section class="about" aria-labelledby="about-h2">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <?php if(!empty($post->post_title)) : ?>
        <h2 id="about-h2"><?php the_title(); ?></h2>
        <?php endif; ?>
        <div class="grid about-copy">
            <div class="body-text">
                <?php if ( has_post_thumbnail()) : ?>
                <?php  the_post_thumbnail('full'); ?>
                <?php endif; ?>
                <?php the_content() ?>
            </div>
            <aside>
                <p>Aside</p>
            </aside>
        </div>
        <?php endwhile; endif; ?>
    </section>
    <section aria-labelledby="works">
        <h2 id="works">My works</h2>
        <div class="filters">
            <fieldset>
                <legend class="sr-only">portfolio filters</legend>
                <label for="categories">Filter categories:</label>
                <select name="categories" id="categories">
                    <option value="" selected disabled>Category</option>
                    <!-- <option value="graphic-design">Graphic design</option> -->
                    <?php
                        foreach ( get_categories() as $category ) :
                            ?><option value="cat-<?php echo $category->term_id; ?>"><?php echo $category->name; ?></option> <?php
                        endforeach;
                    ?>
                </select>
            </fieldset>
        </div>
        <div class="sr-only" id="sr-results"></div>
        <div class="grid cards">
            <?php
                $args = array(
                    'post_type' => 'post'
                );

                $post_query = new WP_Query($args);

                if($post_query->have_posts() ) {
                    while($post_query->have_posts() ) {
                        $post_query->the_post(); ?>
            
                        <?php $category = get_the_category();?>

                        <a class="anchor-button card cat-<?php echo $category[0]->term_id ?>" href="<?php the_permalink() ?>">
                            <?php if ( has_post_thumbnail()) : ?>
                                <?php  the_post_thumbnail('full'); ?>
                            <?php endif; ?>
                            <?php $color = get_term_meta($category[0]->term_id, 'cat_color', true); ?>
                            <span class="chip"
                                style="background: <?php echo $color ; ?>"><?php echo $category[0]->cat_name; ?></span>

                            <div class="overlay"><span aria-hidden="true"><?php the_title(); ?></span></div>
                        </a>
            <?php   }
                } ?>
        </div>
    </section>
</main>
<?php get_footer(); ?>