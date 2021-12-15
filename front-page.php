<?php get_header(); ?>
<main id="maincontent">
    <section class="about" aria-labelledby="about-h2">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <?php if(!empty($post->post_title)) : ?>
        <h2 id="about-h2"><?php the_title(); ?></h2>
        <?php endif; ?>
        <div class="grid about-copy">
            <div class="body-text">
                <figure>
                    <?php if ( has_post_thumbnail()) : ?>
                        <?php  the_post_thumbnail('full'); ?>
                       <figcaption><?php  the_post_thumbnail_caption() ?></figcaption>
                    <?php endif; ?>
                </figure>
                
                <?php the_content() ?>
            </div>
            <aside>
                <h3><?php echo get_theme_mod('rapsoo_sidebar_heading'); ?></h3>
                <?php echo apply_filters( 'the_content', carbon_get_the_post_meta( 'crb_sidebar_content' ) ); ?>
                <?php
                    $occupations = carbon_get_the_post_meta( 'crb_occupations' );
                    if ( !empty($occupations) ) {
                        echo '<h4><i class="far fa-building" aria-hidden="true"></i> Occupation</h4>';
                    }
                    foreach ( $occupations as $occupation ) {
                        echo '<ul class="no-padding-list">';
                            echo '<li><strong>' . $occupation['occupation_title'] . '</strong></li>';
                            echo '<li><span>' . $occupation['occupation_company'] . '</span></li>';
                            echo '<li><span>' . $occupation['occupation_date'] . '</span></li>';
                        echo '</ul>';
                    }
                ?>
                <?php
                    $educations = carbon_get_the_post_meta( 'crb_educations' );
                    if ( !empty($educations) ) {
                        echo '<h4><i class="fas fa-graduation-cap" aria-hidden="true"></i> Education</h4>';
                    }
                    foreach ( $educations as $education ) {
                        echo '<ul class="no-padding-list">';
                            echo '<li><strong>' . $education['education_field_of_study'] . '</strong></li>';
                            echo '<li><span><i>' . $education['education_degree'] . '</i></span></li>';
                            echo '<li><span>' . $education['education_school'] . '</span></li>';
                            echo '<li><span>' . $education['education_date'] . '</span></li>';
                        echo '</ul>';
                    }
                ?>
                <?php
                    $skills = carbon_get_the_post_meta( 'crb_skills' );
                    if ( !empty($skills) ) {
                        echo '<h4>Skills</h4>';
                    }
                    echo '<ul class="tag-list">';
                    foreach ( $skills as $skill ) {
                        echo '<li>' . $skill['skill_tag'] . '</li>';
                    }
                    echo '</ul>';
                ?>
            </aside>
        </div>
        <?php endwhile; endif; ?>
    </section>
    <section aria-labelledby="works">
        <h2 id="works"><?php echo get_theme_mod('rapsoo_posts_heading'); ?></h2>
        <div class="filters">
            <fieldset>
                <legend class="sr-only">portfolio filters</legend>
                <label for="categories">Filter by categories:</label>
                <select name="categories" id="categories">
                    <option value="" selected disabled>Category</option>
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
                            <span class="ratio"></span>
                            <?php if ( has_post_thumbnail()) : ?>
                                <?php  the_post_thumbnail('full'); ?>
                            <?php endif; ?>
                            <?php $color = get_term_meta($category[0]->term_id, 'cat_color', true); ?>
                            <span class="chip" style="background: <?php echo $color ; ?>"><?php echo $category[0]->cat_name; ?></span>
                            <div class="overlay"><span aria-hidden="true"><?php the_title(); ?></span></div>
                        </a>
            <?php   }
                } ?>
        </div>
    </section>
</main>
<?php get_footer(); ?>