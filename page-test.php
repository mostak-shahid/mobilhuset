<?php get_header() ?>
<?php
$logo = carbon_get_theme_option( 'mos_portfolio_logo' );    
$name = carbon_get_theme_option( 'mos_portfolio_name' );    
$like = carbon_get_theme_option( 'mos_portfolio_like' );    
?>

    <!-- Dialog Contents -->
    <div id="dialog-content" class="dialog-content">
        <div class="item">
            <div class="popup-heading d-flex flex-column flex-md-row gap-3 justify-content-between align-items-start">
                <div class="portfolio-meta d-flex align-items-center gap-3">
                    <?php echo wp_get_attachment_image( $logo, 'full', "", array( "class" => "lazy-load-image lazyload popup-top-img img-fluid" ) );  ?>
                    <div class="w-100">
                        <h5 class="templateHeading mb-1">Easpa – Mobile Wallet App</h5>
                        <div class="d-flex align-items-center gap-3">
                            <p class="companyName mb-0"><?php echo $name ?></p>
                            <div class="d-flex align-items-center gap-2">
                                <svg width="3" height="4" viewBox="0 0 3 4" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="1.5" cy="2" r="1.5" fill="white"></circle>
                                </svg><a class="followLink" href="https://www.facebook.com/mosgutenberginc" target="_blank" rel="noreferrer">Follow</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="popup-body-right d-flex gap-3">
                    <span class="text-center">
                        <img class="lazy-load-image lazyload img-fluid" src="https://mosgutenberginc.com/api/wp-content/uploads/2022/08/tools.svg" alt="" width="" height="" loading="lazy">
                        <p class="rightImageContent mb-0">Tools</p>
                    </span>
                    <a href="#" class="text-center">                        
                        <?php echo wp_get_attachment_image( $like, 'full', "", array( "class" => "llazy-load-image lazyload img-fluid" ) );  ?>
                        <p class="rightImageContent mb-0">Appreciate</p>
                    </a>
                </div>                
            </div>
            
            <div class="popup-body-images">
                <img class="lazy-load-image lazyload img-fluid" src="https://mosgutenberginc.com/api/wp-content/uploads/2022/08/Easpa-Mobile-Wallet-App-Image-Preview-min.png" alt="" width="" height="" loading="lazy">
            </div>
            <div class="popup-footer d-flex align-items-center justify-content-center bg-black">
                <div>
                    <h5 class="popup-footer-heading">Easpa – Mobile Wallet App</h5>
                    <div class="popup-footer-icons d-flex align-items-center justify-content-center gap-3">
                        <div class="text-center d-flex align-items-center justify-content-center gap-2"><img class="lazy-load-image lazyload " src="<?php echo get_template_directory_uri() ?>/images/like.svg" alt="" width="" height="" loading="lazy">
                            <p class="mb-0">0</p>
                        </div>
                        <div class="text-center d-flex align-items-center justify-content-center gap-2"><img class="lazy-load-image lazyload " src="<?php echo get_template_directory_uri() ?>/images/preview.svg" alt="" width="" height="" loading="lazy">
                            <p class="mb-0">0</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Dialog Trigger -->
    <img src="https://www.dev.mosgutenberginc.com/wp-content/uploads/2022/11/Outplay-Sales-Engagement-Platform-Website-Thumbnail-min.png" data-fancybox="dialog" data-src="#dialog-content">


<?php get_footer() ?>
