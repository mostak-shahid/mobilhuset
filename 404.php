<?php get_header() ?>

<section class="notFound-banner text-center subPageBanner position-relative bgClrDarkLight">
    <div class="container-lg">
        <div class="bannerContent d-flex align-items-center justify-content-center">
            <div class="wrapper"><img class="lazy-load-image lazyload img-fluid img-404-page" src="<?php echo get_template_directory_uri() ?>/images/404.svg" alt="404 Page" width="600" height="455" loading="lazy">
                <div class="banner-heading fs-48 fw-normal">
                    <h2>Oops! this page <strong>not found</strong></h2>
                </div>
                <div class="banner-desc">The page you are looking for might have been removed its name, changed or is temporary unavailable.</div>
                <div class="btn-wrapper">
                    <a class="btn position-relative border-0 rounded-pill d-flex align-items-center justify-content-center gap-2" href="<?php echo home_url()?>">
                        <span>Back to Home</span>
                        <span class="btn-arrow"></span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
<?php get_footer() ?>
