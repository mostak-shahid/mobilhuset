<?php /*Template Name: Contact Page Template*/ ?>
<?php get_header() ?>
<?php
$shortcode = carbon_get_theme_option('mos-contact-form-shortcode');
$address = carbon_get_theme_option('mos-contact-contact-address');
?>
<section class="wp-block-nk-awb nk-awb alignfull contact-metas">
    <div class="wp-bootstrap-blocks-container container mb-0">
        <div class="wp-bootstrap-blocks-row row">
            <div class="col-12 col-md-4 col-lg-4 mb-4 mb-lg-0">
                <div class="unit-meta address-unit-meta text-center">
                    <div class="svg-wrap">
                    <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" width="512" height="512" x="0" y="0" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512" xml:space="preserve" class=""><g><path d="M256 0C153.755 0 70.573 83.182 70.573 185.426c0 126.888 165.939 313.167 173.004 321.035 6.636 7.391 18.222 7.378 24.846 0 7.065-7.868 173.004-194.147 173.004-321.035C441.425 83.182 358.244 0 256 0zm0 278.719c-51.442 0-93.292-41.851-93.292-93.293S204.559 92.134 256 92.134s93.291 41.851 93.291 93.293-41.85 93.292-93.291 93.292z" class=""></path></g></svg>
                    </div>
                    <?php echo do_shortcode('[contact-address display=0 title=1 class="d-block"]') ?>
                </div>    
            </div>
            <div class="col-12 col-md-4 col-lg-4 mb-4 mb-lg-0">                
                <div class="unit-meta contact-unit-meta text-center">
                    <div class="svg-wrap">
                    <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" width="512" height="512" x="0" y="0" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512" xml:space="preserve" class=""><g><path d="M45 422h30c8.285 0 15-6.715 15-15V256c0-8.285-6.715-15-15-15H45c-24.852 0-45 20.148-45 45v91c0 24.852 20.148 45 45 45zM467 241h-30c-8.285 0-15 6.715-15 15v181c0 8.277-6.723 15-15 15h-77.762c-6.215-17.422-22.707-30-42.238-30h-61c-24.813 0-45 20.188-45 45s20.188 45 45 45h61c19.531 0 36.023-12.578 42.238-30H407c24.813 0 45-20.188 45-45v-15h15c24.852 0 45-20.148 45-45v-91c0-24.852-20.148-45-45-45zM30.684 212.45c4.64-.903 9.414-1.45 14.316-1.45h30c5.508 0 10.727 1.133 15.61 2.953C96.8 128.473 168.937 60 256 60s159.2 68.473 165.39 153.953c4.883-1.82 10.102-2.953 15.61-2.953h30c4.902 0 9.676.547 14.316 1.45C474.273 94.53 375.688 0 256 0S37.727 94.531 30.684 212.45zm0 0" class=""></path></g></svg>
                    </div>
                    <?php echo do_shortcode('[email title=1 class="d-block mb-3"]') ?>
                    <?php echo do_shortcode('[phone title=1 class="d-block mb-3"]') ?>
                </div>
            </div>
            <div class="col-12 col-md-4 col-lg-4 mb-4 mb-lg-0">
                <div class="unit-meta business-hours-unit-meta text-center">
                <div class="svg-wrap">
                <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" width="512" height="512" x="0" y="0" viewBox="0 0 31.93 31.93" style="enable-background:new 0 0 512 512" xml:space="preserve" class="hovered-paths"><g><path d="M15.966 0C7.162 0 0 7.162 0 15.965S7.162 31.93 15.966 31.93c8.802 0 15.964-7.162 15.964-15.965S24.768 0 15.966 0zm0 28.184c-6.74 0-12.222-5.479-12.222-12.219 0-6.738 5.482-12.22 12.222-12.22 6.737 0 12.22 5.481 12.22 12.22 0 6.737-5.483 12.219-12.22 12.219z" class="hovered-path"></path><circle cx="15.966" cy="5.984" r=".995" class="hovered-path"></circle><circle cx="15.966" cy="25.821" r=".996" class="hovered-path"></circle><circle cx="25.883" cy="15.903" r=".996" class="hovered-path"></circle><circle cx="6.045" cy="15.903" r=".996" class="hovered-path"></circle><circle cx="22.977" cy="8.89" r=".994" class="hovered-path"></circle><circle cx="8.951" cy="22.916" r=".995" class="hovered-path"></circle><circle cx="22.977" cy="22.916" r=".995" class="hovered-path"></circle><circle cx="8.951" cy="8.89" r=".995" class="hovered-path"></circle><path d="M22.76 14.994h-4.256a2.694 2.694 0 0 0-1.297-1.461V9.885a1.243 1.243 0 1 0-2.485 0v3.646a2.686 2.686 0 0 0-1.488 2.433c0 1.509 1.223 2.748 2.733 2.748.96 0 1.805-.489 2.292-1.235h4.503a1.242 1.242 0 1 0-.002-2.483z" class="hovered-path"></path></g></svg>
                </div>
                <?php echo do_shortcode('[business-hours title=1 class="d-block"]') ?>
                </div>
            </div>
        </div>
    </div>
</section>
<?php if ($shortcode) : ?>
<section class="wp-block-nk-awb nk-awb alignfull contact-form">
    <div class="wp-bootstrap-blocks-container container mb-0">
        <div class="form-wrapper"><?php echo do_shortcode($shortcode)?></div>
    </div>
</section>
<?php endif?>
<?php if (@$address[0]['link']) : ?>
<section class="wp-block-nk-awb nk-awb alignfull contact-map">
    <div class="wp-bootstrap-blocks-container container mb-0">
        <div class="form-wrapper">
        <div class="ratio ratio-450">
            <iframe src="<?php echo $address[0]['link']?>" title="<?php echo $address[0]['title']?>" allowfullscreen></iframe>
        </div>
        </div>
    </div>
</section>
<?php endif?>
<?php the_content() ?>
<?php get_footer() ?>