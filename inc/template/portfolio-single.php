<?php

get_header();

$portfolio_details_sub_title = function_exists('get_field') ? get_field('portfolio_details_sub_title') : null;
$portfolio_details_bg = function_exists('get_field') ? get_field('portfolio_details_bg') : null;
$portfolio_gallery_images = function_exists('get_field') ? get_field('portfolio_gallery_images') : null;
$project_url = function_exists('get_field') ? get_field('project_url') : null;
?>



    <!-- breadcrumb area start -->
    <section class="breadcrumb__area breadcrumb__style-3 breadcrumb__spacing-2 include-bg pt-200 pb-235 grey-bg-4" data-background="<?php echo esc_url($portfolio_details_bg['url']); ?>">
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
    <section class="portfolio__area pt-100 pb-120">
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

    <?php 
    $prev_post = get_previous_post();
    $next_post = get_next_post();
    ?>

    <!-- portfolio navigation area start -->
    <?php if(!empty($prev_post) && !empty($next_post))  : ?>

    <section class="portfolio__navigation-area portfolio__more-border d-none d-md-block">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-xl-5 col-lg-5 col-md-5">
                <div class="portfolio__more-left d-flex align-items-center">
                <div class="portfolio__more-icon">
                    <a href="<?php echo get_the_permalink( $prev_post ); ?>">
                        <svg width="8" height="14" viewBox="0 0 8 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M7 12.9718L2.06061 8.04401C1.47727 7.46205 1.47727 6.50975 2.06061 5.92778L7 1" stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </a>
                </div>
                <div class="portfolio__more-content">
                    <p>Previous Work</p>
                    <h4>
                        <a href="<?php echo get_the_permalink( $prev_post ); ?>"><?php echo get_the_title($prev_post); ?></a>
                    </h4>
                </div>
                </div>
            </div>
            <div class="col-xl-2 col-lg-2 col-md-2">
                <div class="portfolio__more-menu text-center">
                <a href="<?php echo esc_url(home_url('/')); ?>">
                    <span>
                        <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M11.6673 4.66662C12.9559 4.66662 14.0006 3.62196 14.0006 2.33331C14.0006 1.04466 12.9559 0 11.6673 0C10.3786 0 9.33398 1.04466 9.33398 2.33331C9.33398 3.62196 10.3786 4.66662 11.6673 4.66662Z" fill="currentColor"/>
                            <path d="M2.33331 4.66662C3.62196 4.66662 4.66662 3.62196 4.66662 2.33331C4.66662 1.04466 3.62196 0 2.33331 0C1.04466 0 0 1.04466 0 2.33331C0 3.62196 1.04466 4.66662 2.33331 4.66662Z" fill="currentColor"/>
                            <path d="M11.6673 13.9996C12.9559 13.9996 14.0006 12.955 14.0006 11.6663C14.0006 10.3777 12.9559 9.33301 11.6673 9.33301C10.3786 9.33301 9.33398 10.3777 9.33398 11.6663C9.33398 12.955 10.3786 13.9996 11.6673 13.9996Z" fill="currentColor"/>
                            <path d="M2.33331 13.9996C3.62196 13.9996 4.66662 12.955 4.66662 11.6663C4.66662 10.3777 3.62196 9.33301 2.33331 9.33301C1.04466 9.33301 0 10.3777 0 11.6663C0 12.955 1.04466 13.9996 2.33331 13.9996Z" fill="currentColor"/>
                        </svg>                                    
                    </span>
                </a>
                </div>
            </div>
            <div class="col-xl-5 col-lg-5 col-md-5">
                <div class="portfolio__more-right d-flex align-items-center justify-content-end">
                    <div class="portfolio__more-content">
                        <p>Next Work</p>
                        <h4>
                            <a href="<?php echo get_the_permalink( $next_post ); ?>"><?php echo get_the_title($next_post); ?></a>
                        </h4>
                    </div>
                    <div class="portfolio__more-icon">
                        <a href="<?php echo get_the_permalink( $next_post ); ?>">
                            <svg width="8" height="14" viewBox="0 0 8 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M1 12.9718L5.93939 8.04401C6.52273 7.46205 6.52273 6.50975 5.93939 5.92778L1 1" stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>                                                      
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </section>
    <!-- portfolio navigation area end -->

    <?php endif; ?>


<?php get_footer();
