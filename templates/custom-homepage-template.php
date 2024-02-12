<?php
/**
 * Template Name: Custom Homepage
 * Template Post Type: page
 */
?>

<?php
get_header();
?>


<main>
    <section class="banner" style="background-image: url('<?php echo wp_kses_post(get_field('masthead_image')); ?>'")>
        <h1 class="text-center"><?php echo wp_kses_post(get_field('page_title')); ?></h1>
        <h2 class="text-center"><?php echo wp_kses_post(get_field('page_sub_title')); ?></h2>
    </section>
    <section class="container mx-auto posts-section row">
        <?php
        //define query to get all posts
        $query = new WP_Query('posts_per_page=-1');
        while ($query->have_posts()) : $query->the_post();
            //get every post's featured Image
            $featuredImage = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID),'full');
            ?>

            <!--Creates a postCard for every post-->
            <article class="col-lg-4 col-sm-12 col-md-6 postCard mt-4 mb-4">
                <h3><?php the_title(); ?></h3>
                <figure>
                    <img src="<?php echo $featuredImage[0]; ?>" alt="post featured image">
                </figure>
                <p><?php the_excerpt(); ?>
                </p>
                <div class="row">
                    <small class="col-md-12">Categories: <?php echo the_category(',', '','', get_the_ID()); ?></small>
                    <small class="col-md-8">Posted: <?php echo get_the_date(); ?></small>
                    <a class="col-md-4 readMoreBtn" href="<?php the_permalink(); ?>"><i class="bi bi-book-fill"></i> Read More</a>

                </div>
            </article>

        <?php
        endwhile;
        wp_reset_postdata();
        ?>
    </section>

</main>
<?php
get_footer();
?>

