<?php

get_header();

$portfolio_details_sub_title = function_exists('get_field') ? get_field('portfolio_details_sub_title') : null;
$portfolio_details_bg = function_exists('get_field') ? get_field('portfolio_details_bg') : null;
$portfolio_gallery_images = function_exists('get_field') ? get_field('portfolio_gallery_images') : null;
$project_url = function_exists('get_field') ? get_field('project_url') : null;
?>




    <section class="services__area pt-120 pb-125">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="services__widget-2 pr-50">
                        <?php dynamic_sidebar('services-sidebar'); ?>
                    </div>
                </div>
                <div class="col-lg-8 order-first order-lg-last">
                    <div class="services__details-wrapper">
                        <?php the_content(); ?>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <!-- breadcrumb area start -->
    <section class="d-none  breadcrumb__area breadcrumb__style-3 breadcrumb__spacing-2 include-bg pt-200 pb-235 grey-bg-4" data-background="<?php echo esc_url($portfolio_details_bg['url']); ?>">
        <div class="container">
            <div class="row">
                <div class="col-xxl-7">
                    <div class="breadcrumb__content p-relative z-index-1">
                        <?php if(function_exists('bcn_display')) : ?>
                    <div class="breadcrumb__list">
                        <?php bcn_display(); ?> 
                    </div>
                    <?php endif; ?>
                    <h3 class="breadcrumb__title"><?php the_title(); ?></h3>
                    <?php if(!empty($portfolio_details_sub_title)): ?>
                    <p><?php echo wp_kses_post($portfolio_details_sub_title); ?></p>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
    <!-- breadcrumb area end -->

    <!-- portfolio area start -->
    <section class="d-none portfolio__area pt-100 pb-120">
        <div class="container">
            <div class="row">
                <?php if(!empty($portfolio_gallery_images)): ?>
                <div class="col-xl-8">
                    <div class="portfolio__details-img-list position-relative">
                        <div class="portfolio__details-img-list-social d-flex flex-column">
                            <a href="https://www.linkedin.com/shareArticle?url=<?php the_permalink(); ?>" target="_blank">
                                <i class="fa-brands fa-linkedin-in"></i>
                            </a>
                            <a href="https://twitter.com/intent/tweet?url=<?php the_permalink(); ?>&text=<?php the_title(); ?>" target="_blank">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>" target="_blank">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                        </div>
                        <?php foreach($portfolio_gallery_images as $gallery_item_img): ?>
                        <div class="portfolio__details-img-list-box mb-10">
                            <img src="<?php echo esc_url($gallery_item_img["url"]); ?>" alt="">
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php endif; ?>

                <div class="col-xl-4">
                    <div class="portfolio__details-info-wrapper">
                    <div class="portfolio__details-info-content">
                        <h3 class="portfolio__details-info-box-title">Project Details</h3>
                        <div class="portfolio-details-content">
                            <?php the_content(); ?>
                        </div>
                    </div>
                    <?php if( have_rows('portfolio_info_list') ): ?>
                    <div class="portfolio__details-meta flex-wrap mb-40">
                        <?php while( have_rows('portfolio_info_list') ): the_row(); 
                            $portfolio_svg_icon = get_sub_field('portfolio_svg_icon');
                            $title = get_sub_field('portfolio_info_title');
                            $sub_title = get_sub_field('portfolio_info_subtitle');
                        ?>
                        <div class="portfolio__details-meta-item d-flex align-items-start">
                            <?php if(!empty($portfolio_svg_icon)): ?>
                            <div class="portfolio__details-meta-icon">
                                <span>
                                    <?php echo $portfolio_svg_icon; ?>                                      
                                </span>
                            </div>
                            <?php endif; ?>
                            <div class="portfolio__details-meta-content">
                                <?php if(!empty($title)): ?>
                                <h5><?php echo esc_html($title); ?></h5>
                                <?php endif; ?>
                                <?php if(!empty($sub_title)): ?>
                                <span><?php echo esc_html($sub_title); ?></span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <?php endwhile; ?>
                    </div>
                    <?php endif; ?>
                    <?php if(!empty($project_url)): ?>
                    <div class="portfolio__details-info-btn">
                        <a target="_blank" href="<?php echo esc_url($project_url); ?>" class="tp-btn w-100">Visit Website</a>
                    </div>
                    <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- portfolio area end -->


<?php get_footer();
