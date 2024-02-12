<?php
/**
 * Template Name: Single Post Template
 * Template Post Type: post
 */
get_header();
//get the current post's image
$featuredImage = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID),'full');
?>
<main>
    <section class="row container mx-auto">
        <h1 class="text-center mt-4 mb-4"><?php the_title(); ?></h1>
        <figure class="col-md-6 FeaturedImageContainer">
            <img class="img-fluid" src="<?php echo $featuredImage[0]; ?>" alt="<?php the_title(); ?>" />
        </figure>
        <div class="col-md-6">  <?php the_content(); ?></div>
        <div>
            <p>Posted: <?php echo get_the_date(); ?></p>
            <p>Categories: <?php echo the_category(',', '','', get_the_ID()); ?></p>
        </div>
    </section>

    <section class="row container mx-auto">
        <h2 class="text-center">View Related Posts</h2>
        <!--Display 3 Posts with matching categories-->
        <?php
        //get current post id
        $currentPostId = get_the_ID();
        //get current post categories
        $currentPostCategories = wp_get_post_categories($currentPostId);
        $query = new WP_Query(array(
            //Limit to 3 posts
            'posts_per_page' => 3,
            //Exclude the current post
            'post__not_in'   => array($currentPostId),
            //Include only posts with matching categories
            'category__in'   => $currentPostCategories
        ));

        while ($query->have_posts()) : $query->the_post();
            //get every post's featured Image
            $otherFeaturedImages = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID),'full');
            ?>
            <article class="col-lg-4 col-sm-12 col-md-6 postCard mt-4 mb-4">
                <h3><?php the_title(); ?></h3>
                <figure>
                    <img class="mb-2" src="<?php echo $otherFeaturedImages[0]; ?>" alt="post featured image">
                </figure>
                <p><?php the_excerpt(); ?>
                </p>
                <div class="row">
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
