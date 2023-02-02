<?php

use Carbon_Fields\Block;
use Carbon_Fields\Container;
use Carbon_Fields\Field;

add_action('carbon_fields_register_fields', 'crb_attach_theme_options');

function crb_attach_theme_options() {
    /* Container::make( 'theme_options', __( 'Theme Options', 'crb' ) )
      ->add_fields( array(
      Field::make( 'image', 'mos-logo', __( 'Logo' ) ),
      Field::make( 'textarea', 'mos_additional_coding', 'Additional Coding' ),
      )); */
    // Default options page
    $basic_options_container = Container::make('theme_options', __('Theme Options'))
            ->set_icon('dashicons-admin-customizer')
            ->add_fields(array(
        Field::make('image', 'mos-logo', __('Logo')),
        Field::make('header_scripts', 'crb_header_script', __('Header Script')),
        Field::make('footer_scripts', 'crb_footer_script', __('Footer Script')),
    ));

    Container::make('theme_options', __('Contact Info'))
            ->set_page_parent($basic_options_container) // reference to a top level container
            ->add_fields(array(
                Field::make('complex', 'mos-contact-phone', __('Phone'))
                ->add_fields(array(
                    Field::make('text', 'title', __('Title')),
                    Field::make('text', 'number', __('Phone Number')),
                )),
                Field::make('complex', 'mos-contact-email', __('Email'))
                ->add_fields(array(
                    Field::make('text', 'title', __('Title')),
                    Field::make('text', 'email', __('Email Address')),
                )),
                Field::make('complex', 'mos-contact-business-hours', __('Business Hours'))
                ->add_fields(array(
                    Field::make('text', 'title', __('Title')),
                    Field::make('text', 'hours', __('Business Hours')),
                )),
                Field::make('complex', 'mos-contact-contact-address', __('Contact Address'))
                ->add_fields(array(
                    Field::make('text', 'title', __('Title')),
                    Field::make('text', 'address', __('Address')),
                    Field::make('text', 'link', __('Map Link')),
                )),
                Field::make('complex', 'mos-contact-social-media', __('Social Media'))
                ->add_fields(array(
                    Field::make('text', 'title', __('Title')),
                    Field::make('text', 'link', __('Link')),
                    Field::make('checkbox', 'new-tab', __('Open in new tab'))
                    ->set_option_value('no'),
                )),
                Field::make('text', 'mos-contact-skype', __('Skype'))
                ->set_attribute('placeholder', 'Link|Username'),
                Field::make('text', 'mos-contact-whatsapp', __('WhatsApp'))
                ->set_attribute('placeholder', 'Link|Username'),
                Field::make('text', 'mos-contact-calendly', __('Calendly')),
                Field::make('text', 'mos-contact-dropbox-token', __('Dropbox Token')),
                Field::make('text', 'mos-contact-careers', __('Careers')),
    ));
    Container::make('theme_options', __('Back to Top'))
            ->set_page_parent($basic_options_container) // reference to a top level container
            ->add_fields(array(
                Field::make('radio', 'mos-back-to-top', __('Back to top option'))
                ->set_options(array(
                    'on' => 'Enabled',
                    'off' => 'Disabled',
                ))
                ->set_default_value(['on']),
                Field::make('image', 'mos-back-to-top-image', __('Back to top image')),
                Field::make('color', 'mos-back-to-top-background', 'Back to top background')
                ->set_alpha_enabled(true),
                Field::make('text', 'mos-back-to-top-class', __('Back to top class')),
    ));
    Container::make('theme_options', __('Page Loader'))
            ->set_page_parent($basic_options_container) // reference to a top level container
            ->add_fields(array(
                Field::make('radio', 'mos-page-loader', __('Page loader option'))
                ->set_options(array(
                    'on' => 'Enabled',
                    'off' => 'Disabled',
                ))
                ->set_default_value(['on']),
                Field::make('image', 'mos-page-loader-image', __('Page loader image')),
                Field::make('color', 'mos-page-loader-background', 'Page loader background')
                ->set_alpha_enabled(true),
                Field::make('text', 'mos-page-loader-class', __('Page loader class')),
    ));

    Container::make('theme_options', __('Header Section'))
            ->set_page_parent($basic_options_container) // reference to a top level container
            ->add_fields(array(
                Field::make('text', 'mos-header-padding', __('Padding')),
                Field::make('text', 'mos-header-margin', __('Margin')),
                Field::make('text', 'mos-header-border', __('Border')),
                Field::make('text', 'mos-header-class', __('Class')),
                Field::make('color', 'mos-header-content-color', __('Content Color')),
                Field::make('color', 'mos-header-link-color', __('Links Color')),
                Field::make('color', 'mos-header-link-color-hover', __('Hover Color')),
                Field::make('text', 'mos-header-button-class', __('Button Class')),
                Field::make('complex', 'mos-header-background', __('Background'))
                ->set_max(1)
                ->set_collapsed(true)
                ->add_fields(array(
                    Field::make('color', 'background-color', __('Background Color')),
                    Field::make('image', 'background-image', __('Background Image')),
                    Field::make('select', 'background-position', __('Background Position'))
                    ->set_options(array(
                        'top left' => 'Top Left',
                        'top center' => 'Top Center',
                        'top right' => 'Top Right',
                        'center left' => 'Center Left',
                        'center center' => 'Center Center',
                        'center right' => 'Center Right',
                        'bottom left' => 'Bottom left',
                        'bottom center' => 'Bottom Center',
                        'bottom right' => 'Bottom Right',
                    ))
                    ->set_default_value(['top left']),
                    Field::make('select', 'background-size', __('Background Size'))
                    ->set_options(array(
                        'cover' => 'cover',
                        'contain' => 'contain',
                        'auto' => 'auto',
                        'inherit' => 'inherit',
                        'initial' => 'initial',
                        'revert' => 'revert',
                        'revert-layer' => 'revert-layer',
                        'unset' => 'unset',
                    ))
                    ->set_default_value(['cover']),
                    //background-repeat: repeat|repeat-x|repeat-y|no-repeat|initial|inherit;
                    Field::make('select', 'background-repeat', __('Background Repeat'))
                    ->set_options(array(
                        'repeat' => 'repeat',
                        'repeat-x' => 'repeat-x',
                        'repeat-y' => 'repeat-y',
                        'no-repeat' => 'no-repeat',
                        'initial' => 'initial',
                        'inherit' => 'inherit',
                    ))
                    ->set_default_value(['scroll']),
                    Field::make('select', 'background-attachment', __('Background Attachment'))
                    ->set_options(array(
                        'scroll' => 'Scroll',
                        'fixed' => 'Fixed',
                    ))
                    ->set_default_value(['scroll']),
                )),
    ));
    //Sidebar Options
    Container::make('theme_options', __('Sidebar Section'))
            ->set_page_parent($basic_options_container) // reference to a top level container
            ->add_fields(array(
                Field::make('radio', 'mos-sidebar-enable', __('Enable Sidebar'))
                ->set_options(array(
                    'on' => 'Enabled',
                    'off' => 'Disabled',
                ))
                ->set_default_value(['on']),
                Field::make('text', 'mos-sidebar-title', __('Sidebar Title')),
                Field::make('text', 'mos-sidebar-subtitle', __('Sidebar Subtitle')),
                Field::make('text', 'mos-sidebar-form-title', __('Sidebar Form Title')),
                Field::make('text', 'mos-sidebar-form-subtitle', __('Sidebar Form Subtitle')),
                Field::make('text', 'mos-sidebar-form-shortcode', __('Sidebar Form Shortcode')),
                Field::make('text', 'mos-sidebar-class', __('Additional Class')),
    ));

    Container::make('theme_options', __('Footer Section'))
            ->set_page_parent($basic_options_container) // reference to a top level container
            ->add_fields(array(
                Field::make('text', 'mos-footer-padding', __('Padding')),
                Field::make('text', 'mos-footer-margin', __('Margin')),
                Field::make('text', 'mos-footer-border', __('Border')),
                Field::make('text', 'mos-footer-class', __('Class')),
                Field::make('color', 'mos-footer-content-color', __('Content Color')),
                Field::make('color', 'mos-footer-link-color', __('Links Color')),
                Field::make('color', 'mos-footer-link-color-hover', __('Hover Color')),
                Field::make('text', 'mos-footer-button-class', __('Button Class')),
                Field::make('rich_text', 'mos-footer-content', __('Copyright')),
                Field::make('rich_text', 'footer-desc', __('Widget Intro')),
                Field::make('media_gallery', 'footer_media_gallery', __('Media Gallery'))
                ->set_type(array('image')),
                Field::make('complex', 'mos-footer-background', __('Background'))
                ->set_max(1)
                ->set_collapsed(true)
                ->add_fields(array(
                    Field::make('color', 'background-color', __('Background Color')),
                    Field::make('image', 'background-image', __('Background Image')),
                    Field::make('select', 'background-position', __('Background Position'))
                    ->set_options(array(
                        'top left' => 'Top Left',
                        'top center' => 'Top Center',
                        'top right' => 'Top Right',
                        'center left' => 'Center Left',
                        'center center' => 'Center Center',
                        'center right' => 'Center Right',
                        'bottom left' => 'Bottom left',
                        'bottom center' => 'Bottom Center',
                        'bottom right' => 'Bottom Right',
                    ))
                    ->set_default_value(['top left']),
                    Field::make('select', 'background-size', __('Background Size'))
                    ->set_options(array(
                        'cover' => 'cover',
                        'contain' => 'contain',
                        'auto' => 'auto',
                        'inherit' => 'inherit',
                        'initial' => 'initial',
                        'revert' => 'revert',
                        'revert-layer' => 'revert-layer',
                        'unset' => 'unset',
                    ))
                    ->set_default_value(['cover']),
                    //background-repeat: repeat|repeat-x|repeat-y|no-repeat|initial|inherit;
                    Field::make('select', 'background-repeat', __('Background Repeat'))
                    ->set_options(array(
                        'repeat' => 'repeat',
                        'repeat-x' => 'repeat-x',
                        'repeat-y' => 'repeat-y',
                        'no-repeat' => 'no-repeat',
                        'initial' => 'initial',
                        'inherit' => 'inherit',
                    ))
                    ->set_default_value(['scroll']),
                    Field::make('select', 'background-attachment', __('Background Attachment'))
                    ->set_options(array(
                        'scroll' => 'Scroll',
                        'fixed' => 'Fixed',
                    ))
                    ->set_default_value(['scroll']),
                )),
    ));

    Container::make('theme_options', __('Archive Page'))
            ->set_page_parent($basic_options_container) // reference to a top level container
            ->add_fields(array(  
                
                Field::make( 'separator', 'mos-archive-banner-hr', __( 'Archive Banner' ) ), 

                Field::make('radio', 'mos-archive-banner-enable', __('Show banner?'))
                ->set_options(array(
                'on' => 'Yes',
                'off' => 'No',
                ))
                ->set_default_value(['on']),    
                Field::make('text', 'mos-archive-banner-title', __('Archive banner title')),
                Field::make('text', 'mos-archive-banner-subtitle', __('Archive banner Subtitle')),
                Field::make('textarea', 'mos-archive-banner-intro', __('Archive banner intro')),
                Field::make( 'image', 'mos-archive-banner-image', __( 'Archive banner image' ) )
                ->set_type( array( 'image' ) ),
                Field::make('text', 'mos-archive-banner-button-title', __('Archive banner button title')),
                Field::make('text', 'mos-archive-banner-button-url', __('Archive banner button URL')),
                Field::make('text', 'mos-archive-banner-button-title-2', __('Internal linking tag')),
                Field::make('text', 'mos-archive-banner-button-url-2', __('Internal linking URL')),

                Field::make( 'separator', 'mos-archive-newsletter-hr', __( 'Newsletter' ) ),

                Field::make('radio', 'mos-archive-newsletter-enable', __('Show newsletter?'))
                ->set_options(array(
                'on' => 'Yes',
                'off' => 'No',
                ))
                ->set_default_value(['on']),
                Field::make('text', 'mos-archive-newsletter-title', __('Newsletter title')),
                Field::make('text', 'mos-archive-newsletter-subtitle', __('Newsletter subtitle')),
                Field::make('textarea', 'mos-archive-newsletter-intro', __('Newsletter intro')),
                Field::make('text', 'mos-archive-newsletter-button-title', __('Newsletter button title')),
                Field::make('text', 'mos-archive-newsletter-button-url', __('Newsletter button URL')),
                
                
    ));

    Container::make('theme_options', __('Search Page'))
            ->set_page_parent($basic_options_container) // reference to a top level container
            ->add_fields(array(  

                Field::make('radio', 'mos-search-banner-enable', __('Show banner?'))
                ->set_options(array(
                'on' => 'Yes',
                'off' => 'No',
                ))
                ->set_default_value(['on']),  
                
                Field::make( 'separator', 'mos-search-banner-hr', __( 'Search Banner' ) ),     
                Field::make('text', 'mos-search-banner-title', __('Search banner title')),
                Field::make('text', 'mos-search-banner-subtitle', __('Search banner subtitle')),
                Field::make('textarea', 'mos-search-banner-intro', __('Search banner intro')),
                Field::make( 'image', 'mos-search-banner-image', __( 'Search banner image' ) )
                ->set_type( array( 'image' ) ),
                Field::make('text', 'mos-search-banner-button-title', __('Search banner button title')),
                Field::make('text', 'mos-search-banner-button-url', __('Search banner button URL')),

                Field::make( 'separator', 'mos-search-newsletter-hr', __( 'Newsletter' ) ),

                Field::make('radio', 'mos-search-newsletter-enable', __('Show newsletter?'))
                ->set_options(array(
                'on' => 'Yes',
                'off' => 'No',
                ))
                ->set_default_value(['on']),
                Field::make('text', 'mos-search-newsletter-title', __('Newsletter title')),
                Field::make('text', 'mos-search-newsletter-subtitle', __('Newsletter subtitle')),
                Field::make('textarea', 'mos-search-newsletter-intro', __('Newsletter intro')),
                Field::make('text', 'mos-search-newsletter-button-title', __('Newsletter button title')),
                Field::make('text', 'mos-search-newsletter-button-url', __('Newsletter button URL')),
                
                
    ));

    Container::make('theme_options', __('Single Post'))
            ->set_page_parent($basic_options_container) // reference to a top level container
            ->add_fields(array(  
                
                Field::make( 'separator', 'mos-single-post-related-hr', __( 'Related post' ) ),                  
                Field::make('radio', 'mos-single-post-related-enable', __('Show related post?'))
                ->set_options(array(
                    'on' => 'Yes',
                    'off' => 'No',
                ))
                ->set_default_value(['on']),
                Field::make('text', 'mos-single-post-related-title', __('Related post title')),
                Field::make('text', 'mos-single-post-related-subtitle', __('Related post Subtitle')),
                Field::make('textarea', 'mos-single-post-related-intro', __('Related post intro')),
                Field::make('text', 'mos-single-post-related-button-title', __('Related post button title')),
                Field::make('text', 'mos-single-post-related-button-url', __('Related post button URL')),
                
                Field::make( 'separator', 'mos-single-post-related-newsletter-hr', __( 'Newsletter' ) ),
                
                Field::make('radio', 'mos-single-post-newsletter-enable', __('Show newsletter?'))
                ->set_options(array(
                    'on' => 'Yes',
                    'off' => 'No',
                ))
                ->set_default_value(['on']),
                Field::make('text', 'mos-single-post-newsletter-title', __('Newsletter title')),
                Field::make('text', 'mos-single-post-newsletter-subtitle', __('Newsletter subtitle')),
                Field::make('textarea', 'mos-single-post-newsletter-intro', __('Newsletter intro')),
                Field::make('text', 'mos-single-post-newsletter-button-title', __('Newsletter button title')),
                Field::make('text', 'mos-single-post-newsletter-button-url', __('Newsletter button URL')),
                
                
    ));

    Container::make('theme_options', __('Single Job'))
            ->set_page_parent($basic_options_container) // reference to a top level container
            ->add_fields(array(
                
                Field::make( 'separator', 'mos-single-job-application-page-hr', __( 'Application page' ) ),
                Field::make('text', 'mos-single-job-application-page', __('Application page')),
//                
                Field::make( 'separator', 'mos-single-job-newsletter-hr', __( 'Newsletter' ) ),
                
                Field::make('radio', 'mos-single-job-newsletter-enable', __('Show newsletter?'))
                ->set_options(array(
                    'on' => 'Yes',
                    'off' => 'No',
                ))
                ->set_default_value(['on']),
                Field::make('text', 'mos-single-job-newsletter-title', __('Newsletter title')),
                Field::make('text', 'mos-single-job-newsletter-subtitle', __('Newsletter subtitle')),
                Field::make('textarea', 'mos-single-job-newsletter-intro', __('Newsletter intro')),
                Field::make('text', 'mos-single-job-newsletter-button-title', __('Newsletter button title')),
                Field::make('text', 'mos-single-job-newsletter-button-url', __('Newsletter button URL')),
                
    ));

    Container::make('theme_options', __('Single Portfolio'))
            ->set_page_parent($basic_options_container) // reference to a top level container
            ->add_fields(array(
                Field::make('image', 'mos_portfolio_logo', __('Company Logo')),
                Field::make( 'text', 'mos_portfolio_name', __( 'Company Name' ) ),
                Field::make('image', 'mos_portfolio_like', __('Like Image')),
                
    ));

    // Add third options page under "Appearance"
    /* Container::make( 'theme_options', __( 'Customize Background' ) )
      ->set_page_parent( 'themes.php' ) // identificator of the "Appearance" admin section
      ->add_fields( array(
      Field::make( 'color', 'crb_background_color', __( 'Background Color' ) ),
      Field::make( 'image', 'crb_background_image', __( 'Background Image' ) ),
      ) ); */
    /* Container::make( 'post_meta', 'Custom Data' )
      ->where( 'post_type', '=', 'page' )
      ->add_fields( array(
      Field::make( 'map', 'crb_location' )
      ->set_position( 37.423156, -122.084917, 14 ),
      Field::make( 'sidebar', 'crb_custom_sidebar' ),
      Field::make( 'image', 'crb_photo' ),
      )); */

    // Section title block start
    Block::make(__('Job Apply Form'))
    ->add_fields(array(
        Field::make('text', 'mos_sec_heading', __('Section Name')),
        Field::make('text', 'mos_sec_title', __('Section TagLine')),
        Field::make('textarea', 'mos_sec_desc', __('Section Intro')),
        Field::make('text', 'mos_sec_form_title', __('Form Title')),
        Field::make('textarea', 'mos_sec_form_intro', __('Form Intro')),
        Field::make('text', 'mos_sec_shortcode', __('Form Shortcode')),
    ))
    ->set_render_callback(function ($fields, $attributes, $inner_blocks) {
        ?>
<section class="JobApplicationForm commonPadding">
    <div class="container-lg">
        <div class="part-one">
            <?php if ($fields['mos_sec_heading']) :?>
            <div class="secTagLine text-center"><?php echo $fields['mos_sec_heading']; ?></div>
            <?php endif?>
            <?php if ($fields['mos_sec_title'] || $fields['mos_sec_desc']) :?>
            <div class="secIntro text-center">
                <?php if ($fields['mos_sec_title']) :?>
                <div class="JobApplicationSecIntro fs-48 fw-normal">
                    <h1><?php echo $fields['mos_sec_title'] ?></h1>
                </div>
                <?php endif?>
                <?php if ($fields['mos_sec_desc']) :?>
                <p><?php echo $fields['mos_sec_desc'] ?></p>
                <?php endif?>
                <hr>
            </div>
            <?php endif?>
            <div class="ApplicationForm bgClrSolitude isRadius16 form-validation">
                <div class="contactHeader mb-4 text-center">
                    <?php if ($fields['mos_sec_form_title']) : ?>
                    <div class="textClrThemeDark fs-4 fw-bold mb-10"><?php echo $fields['mos_sec_form_title']?></div>
                    <?php endif?>
                    <?php if ($fields['mos_sec_form_intro']) :?>
                    <p class="textClrGrayDark fs-6 fw-normal mb-0"><?php echo $fields['mos_sec_form_intro']?></p>
                    <?php endif?>
                </div>
                <?php if ($fields['mos_sec_shortcode']) : ?>
                <div class="form-job-application">
                    <?php echo do_shortcode($fields['mos_sec_shortcode'])?>
                </div>
                <?php endif?>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="applySuccessModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="applySuccessModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="border-0 p-xl-5 p-4 modal-body">
                    <div class="bodyContents text-center">
                        <div class="mb-5">
                            <img class="lazy-load-image lazyload img" src="<?php echo get_template_directory_uri() ?>/images/succesful-icon.svg" alt="icon" width="203px" height="184px" loading="lazy">
                        </div>
                        <h2 class="fs-30 fw-bold text-dark mb-4">Thanks for your application!</h2>
                        <p class="fs-6 fw-normal textClrGray mb-5">A mosgutenberg team member will reach out to schedule a call within 2 days.</p>
                        <div class="sbm-btn">
                            <a class="btn bgClrGreen h-42 textClrThemeDark fs-14 fwSemiBold border-0 py-2 px-4 rounded-pill d-inline-flex align-items-center" href="<?php echo home_url() ?>">
                                <svg width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M13.1244 17.4301L7.41937 11.7251C6.74563 11.0513 6.74563 9.94882 7.41937 9.27507L13.1244 3.57007" stroke="#121316" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                                Back to Home
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
    });
    //Home Banner start      
    Block::make(__('Home Banner Block'))
            ->add_fields(array(
                Field::make('text', 'get_heading', __('Banner Heading')),
                Field::make('text', 'get_subheading', __('Sub Heading')),
                Field::make('text', 'get_button_text', __('Button Text')),
                Field::make('text', 'get_button_url', __('Button URL')),
                Field::make('media_gallery', 'get_client_logo_gallery', __('Client logo Gallery')),
                Field::make('image', 'get_banner_bgimage', __('Background Image'))
            ))
            ->set_render_callback(function ($fields, $attributes, $inner_blocks) {
                ?>
<section class="banner">
    <div class="container-lg">
        <div class="bannerContent d-flex align-items-center position-relative">
            <div class="content text-center">
                <div class="bannerTitle text-white fs-72 fw-normal mb-30">
                    <h1><?php echo ( $fields['get_heading'] ); ?></h1>
                </div>
                <div class="bannerIntro fw-normal"><?php echo esc_html($fields['get_subheading']); ?>
                </div>
                <div class="d-flex justify-content-center gap-3">
                    <div class="btn-wrapper">
                        <a class="btn position-relative border-0 rounded-pill d-flex align-items-center justify-content-center link-to-id active gap-2" href="<?php echo do_shortcode($fields['get_button_url']); ?>">
                            <span><?php echo esc_html($fields['get_button_text']); ?></span>
                            <span class="btn-arrow"></span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-lg trustedWrapper">
        <div class="row justify-content-center">
            <?php foreach ($fields['get_client_logo_gallery'] as $img_item) : ?>
            <div class="col-4 col-sm-2 col-lg-2 text-center mb-3 mb-sm-0">
                <img class="lazy-load-image lazyload img-fluid partner-img" src="<?php echo wp_get_attachment_url($img_item); ?>" alt="celimax - Logo" width="160px" height="40px" loading="lazy">
            </div>
            <?php endforeach; ?>
        </div>
    </div>
    <?php
                    $bgimage = $fields['get_banner_bgimage'];
                    echo '<style> .banner::after {background-image: url("' . get_template_directory_uri() . '/images/banner-animation.4f3c4214.webp");}</style>';
                    ?>
</section>

<?php
            });

// Section title block start
    Block::make(__('Section Title Block'))
            ->add_fields(array(
                Field::make('text', 'get_sec_heading', __('Section Name')),
                Field::make('text', 'get_sec_title', __('Section TagLine')),
                Field::make('text', 'get_sec_desc', __('Section Intro')),
            ))
            ->set_render_callback(function ($fields, $attributes, $inner_blocks) {
                ?>

<div class="section-wrapper secPadding section-js contentCenter">
    <div class="container-lg">
                <div class="part-one text-center">
                    <div class="secTagLine"><?php echo ( $fields['get_sec_heading'] ); ?></div>
                    <div class="secIntro">
                        <h2><?php echo ( $fields['get_sec_title'] ); ?></h2>
                        <p><?php echo ( $fields['get_sec_desc'] ); ?></p>
                        <hr>
                    </div>
                </div>
    </div>
</div>

<?php
            });

    // Our Service block
    Block::make(__('Our Service Block'))
            ->add_fields(array(
                Field::make('complex', 'get_serv_block', __('Service Block'))
                ->set_layout('tabbed-vertical')
                ->add_fields(array(
                    Field::make('text', 'get_srv_heading', __('Service Name')),
                    Field::make('text', 'get_srv_title', __('Service TagLine')),
                    Field::make('image', 'get_srv_icon', __('Service Icon')),
                    Field::make('text', 'get_srv_url', __('Page Url')),
                    Field::make('text', 'get_srv_class', __('Unit Class')),
                )),
                Field::make('text', 'get_serviec_class', __('Container Class')),
                Field::make('select', 'get_serviec', __('Grid Number Select'))
                ->add_options(array(
                    'col-lg-3' => __('4 Item'),
                    'col-lg-4' => __('3 Item')
                ))
            ))
            ->set_render_callback(function ($fields, $attributes, $inner_blocks) {
                ?>
<div class="container-lg">
            <div class="part-two text-start">
                <div class="media-group <?php echo @$fields['get_serviec_class'] ?>">
                    <div class="row mb--4">
                        <?php
                        $grid_number = $fields['get_serviec'];
                        ?>
                        <?php foreach ($fields['get_serv_block'] as $item) { ?>
                        <div class="mb-4 block-unit <?php
                                            if (!empty($grid_number)) {
                                                echo $grid_number;
                                            } else {
                                                echo 'col-lg-4';
                                            } if (@$item['get_srv_class']) {
                                                echo ' ' . $item['get_srv_class'];
                                            } 
                                            ?> col-sm-6">
                            <div class="media-block template-1">
                                <div class="block-part-one">
                                    <div class="block-image">
                                        <?php echo wp_get_attachment_image( $item['get_srv_icon'], 'full', '', array( "class" => "lazy-load-image lazyload" ) ); ?>

                                    </div>
                                    <h3 class="block-title ">
                                        <?php if($item['get_srv_url']) : ?>
                                        <a href="<?php echo do_shortcode($item['get_srv_url']) ?>" class="block-title-link">
                                            <?php echo ( $item['get_srv_heading'] ); ?>
                                        </a>
                                        <?php else : ?>
                                        <span class="block-title-link"><?php echo ( $item['get_srv_heading'] ); ?></span>
                                        <?php endif?>
                                    </h3>
                                    <div class="block-desc">
                                        <p>
                                            <?php echo ( $item['get_srv_title'] ); ?>
                                        </p>
                                    </div>
                                </div>
                                <?php if (!empty($item['get_srv_url'])): ?>
                                <div class="block-part-two">
                                    <a class="fs-14 fwSemiBold d-flex align-items-center block-btn wrapper-btn" href="<?php echo ( $item['get_srv_url'] ); ?>">
                                        <span>Read More</span><svg width="19" height="19" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M7.05371 15.77L12.2154 10.6083C12.825 9.99873 12.825 9.00123 12.2154 8.39165L7.05371 3.22998" stroke="#6B6E78" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path>
                                        </svg>
                                    </a>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
</div>
<?php
            });

    // Why USblock
    Block::make(__('Why Us Block'))
            ->add_fields(array(
                Field::make('complex', 'get_wu_block', __('Why Us Block'))
                ->set_layout('tabbed-vertical')
                ->add_fields(array(
                    Field::make('text', 'get_wu_title', __('TagLine')),
                    Field::make('text', 'get_wu_content', __('Content')),
                ))
            ))
            ->set_render_callback(function ($fields, $attributes, $inner_blocks) {
                ?>
<div class="container-lg">
            <div class="part-two text-start">
                <div class="media-group">
                    <div class="row mb--4">
                        <?php
                                        $i = 1;
                                        foreach ($fields['get_wu_block'] as $item) {
                                            ?>
                        <div class="mb-4 block-unit col-lg-3 col-sm-6">
                            <div class="media-block template-4">
                                <div class="block-part-one">
                                    <h3 class="block-title ">
                                        <span class="block-title-text"> <?php echo ( $item['get_wu_title'] ); ?></span>
                                    </h3>
                                    <div class="block-desc">
                                        <p><span style="font-weight: 400;"> <?php echo ( $item['get_wu_content'] ); ?></span></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                                        }
                                        ?>
                    </div>
                </div>
            </div>
</div>
<?php
            });

    // Our focus industries
    Block::make(__('Our focus industries'))
            ->add_fields(array(
                Field::make('complex', 'get_ofi_block', __('Industries we specialize'))
                ->set_layout('tabbed-vertical')
                ->add_fields(array(
                    Field::make('text', 'get_ofi_title', __('Title')),
                    Field::make('image', 'get_ofi_icon', __('Industries Icon')),
                )),
            ))
            ->set_render_callback(function ($fields, $attributes, $inner_blocks) {
                ?>
<div class="container-lg">
            <div class="part-two text-start">
                <div class="industriesWrapper">
                    <div class="row position-relative g-0">
                        <?php
                                        foreach ($fields['get_ofi_block'] as $item) {
                                            $ofiicon = $item['get_ofi_icon'];
                                            ?>
                        <div class="col-4 col-sm-3 col-lg-2 industriesItem text-end">
                            <div class="icon px-3 py-3 text-center">
                                <div class="wrapper-img">
                                    <img class="d-inline-block mb-1 mb-sm-2 mb-lg-4" src="<?php echo wp_get_attachment_url($ofiicon); ?>" alt="<?php echo $item['get_ofi_title'] ?>" width="100px" height="100px" loading="lazy">
                                </div>
                                <div class="iITitle fs-14 fw-bold text-white"><?php echo $item['get_ofi_title'] ?></div>
                            </div>
                        </div>
                        <?php
                                        }
                                        ?>
                    </div>
                </div>
            </div>
</div>
<?php
            });

// Technologies we leverage
    Block::make(__('Technologies we leverage'))
            ->add_fields(array(
                Field::make('text', 'get_twl_title', __('Title')),
                Field::make('complex', 'get_twl_block', __('Technologies'))
                ->set_layout('tabbed-vertical')
                ->add_fields(array(
                    Field::make('text', 'get_twl_item_title', __('Title')),
                    Field::make('image', 'get_twl_icon', __('Industries Icon')),
                ))
            ))
            ->set_render_callback(function ($fields, $attributes, $inner_blocks) {
                ?>

<?php if(!empty($fields['get_twl_title'])) {?>
<div class="singleTechnology p-2 product-design">
    <div class="row align-items-center">
        <div class="col-xl-3">
            <div class="p-3">
                <h4 class="tech-title fs-6 fwSemiBold text-white mb-0">
                    <?php echo $fields['get_twl_title']; ?>
                </h4>
            </div>
        </div>
        <div class="col-xl-9">
            <div class="singleTechLogo d-flex align-items-center flex-wrap">
                <?php
                 foreach ($fields['get_twl_block'] as $tecitem):
                 $tecicon = $tecitem['get_twl_icon'];
               ?>
                <div class="techLogos">
                    <div class="techLogo-icon icons mb-2">
                        <img class="lazy-load-image lazyload " src="<?php echo wp_get_attachment_url($tecicon); ?>" alt="<?php echo $tecitem['get_twl_item_title']; ?>" width="34px" height="34px" loading="lazy">
                    </div>
                    <h5 class="techLogo-text">
                        <?php echo $tecitem['get_twl_item_title']; ?>
                    </h5>
                </div>

                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>
<?php } else {?>
<div class="col-sm-12">
    <div class="part-two text-center">
        <div class="singleTechnology p-2 d-inline-block singleTechnology-without-border">
            <div class="singleTechLogo d-flex align-items-center justify-content-center flex-wrap border-start-0">
                <?php
     foreach ($fields['get_twl_block'] as $tecitem):      
        $tecicon = $tecitem['get_twl_icon'];
               ?>
                <div class="techLogos">
                    <div class="techLogo-icon icons mb-2">
                        <img class="lazy-load-image lazyload " src="<?php echo wp_get_attachment_url($tecicon); ?>" alt="<?php echo $tecitem['get_twl_item_title']; ?>" width="34px" height="34px" loading="lazy">
                    </div>
                    <h5 class="techLogo-text"><?php echo $tecitem['get_twl_item_title']; ?></h5>
                </div>
                <?php endforeach; ?>

            </div>
        </div>
    </div>
</div>

<?php
} ?>


<?php
            });

//how we can help
    Block::make(__('How we can help'))
            ->add_fields(array(
                Field::make('text', 'get_hwch_title', __('Title')),
                Field::make('text', 'get_hwch_block', __('Descreption')),
                Field::make('text', 'get_hwch_buttontitle', __('Button Text')),
                Field::make('text', 'get_hwch_buttonurl', __('Button URL'))
            ))
            ->set_render_callback(function ($fields, $attributes, $inner_blocks) {
                ?>
<div class="container-lg">
            <div class="part-one">
                <div class="secIntro">
                    <h2><?php echo $fields['get_hwch_title'] ?></h2>
                    <p><?php echo $fields['get_hwch_block'] ?></p>
                </div>
                <div class="btn-wrapper">
                    <a data-target="<?php echo $fields['get_hwch_buttonurl'] ?>" class="btn position-relative border-0 rounded-pill d-flex align-items-center justify-content-center gap-2" href="<?php echo $fields['get_hwch_buttonurl'] ?>">
                        <span data-target="<?php echo $fields['get_hwch_buttonurl'] ?>"><?php echo $fields['get_hwch_buttontitle'] ?></span>
                        <span class="btn-arrow"></span>
                    </a>
                </div>
            </div>
</div>
<?php
            });

//Client Stories carosol

    Block::make(__('Client Stories'))
            ->add_fields([
                //   Field::make('text', 'sec_title', __('Section Heading')),
                Field::make('association', 'get_association', __('Select Stories'))
                ->set_types(array(
                    array(
                        'type' => 'post',
                        'post_type' => 'client_stories',
                        'post_status' => array('publish'),
                    )
                ))
            ])
            ->set_icon('groups')
            ->set_render_callback(function ($fields, $attributes, $inner_blocks) {
                ?>

<div class="container-fluid full-width <?php echo @$attributes['className'] ?>">
    <div class="tmsliderWrapper slick-slider-wrapper testimonial-slider-wrapper">
        <?php
                            foreach ($fields['get_association'] as $item) {
                                $postId = $item['id'];
                                //$postdata = get_post($item['id']);                             
                                $featured_img_url = aq_resize(get_the_post_thumbnail_url($item['id'], 'full'), 45,45,true);
                                $my_post_content = apply_filters('the_content', get_post_field('post_content', $postId));
                                $tmmetades = carbon_get_post_meta($postId, 'get_client_des');
                                $tmmeticon = carbon_get_post_meta($postId, 'get_client_logo');
                                ?>
        <div class="item-wrapper" tabindex="-1" style="width: 100%; display: inline-block;">
            <div class="item-wrapper singleFeedback isRadius16 p-30 bgClrDarkLight d-flex flex-column justify-content-between">
                <div class="reviewerContent">
                    <?php if ($tmmeticon) : ?>
                    <div class="logos mb-4">
                        <?php echo wp_get_attachment_image( $tmmeticon, 'full', "", array( "class" => "lazy-load-image lazyload testimonial-company" ) );  ?>
                    </div>
                    <?php endif?>
                    <div class="feedbackText textClrGray fw-normal fs-6 mb-5">
                        <p>
                            <?php echo wp_trim_words($my_post_content, 100); ?>
                        </p>
                    </div>
                </div>


                <div class="reviewerInfo d-flex align-props-center justify-content-between">
                    <div class="d-flex align-props-center gap-3">
                        <div class="pic">
                            <img class="lazy-load-image lazyload rounded-circle" src="<?php echo $featured_img_url; ?>" alt="<?php echo get_the_title($postId); ?>" width="45px" height="45px" loading="lazy">
                        </div>
                        <span class="info">
                            <div class="fs-14 fw-bold text-white mb-1">
                                <?php echo get_the_title($postId); ?>
                            </div>
                            <div class="fs-12 fw-medium textClrGray mb-0">
                                <?php echo $tmmetades; ?>
                            </div>
                        </span>
                    </div>
                    <div class="qoute">
                        <svg width="23" height="17" viewBox="0 0 23 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M2.98242 16.8035C2.40953 17.131 1.87033 17.0491 1.36483 16.5578C0.893039 16.0337 0.893039 15.5588 1.36483 15.1329C2.44322 14.052 3.18462 13.2495 3.58902 12.7254C3.99341 12.1686 4.21246 11.5626 4.24615 10.9075C4.34725 10.1869 4.14506 9.82659 3.63956 9.82659C2.62857 9.82659 1.76923 9.40077 1.06154 8.54914C0.353848 7.6975 0 6.60019 0 5.25723C0 3.68497 0.454944 2.42389 1.36483 1.47399C2.30842 0.491331 3.55531 0 5.1055 0C6.58828 0 7.85202 0.540462 8.8967 1.62139C9.94139 2.70231 10.4637 4.14355 10.4637 5.94509C10.4637 10.2033 7.96996 13.8227 2.98242 16.8035ZM15.5187 16.8035C14.9458 17.131 14.4066 17.0491 13.9011 16.5578C13.4293 16.0665 13.4293 15.5915 13.9011 15.1329C14.9795 14.052 15.7209 13.2495 16.1253 12.7254C16.5297 12.1686 16.7656 11.5626 16.833 10.9075C16.9004 10.1869 16.6813 9.82659 16.1758 9.82659C15.1648 9.82659 14.3055 9.40077 13.5978 8.54914C12.8901 7.66474 12.5363 6.56744 12.5363 5.25723C12.5363 3.68497 12.9912 2.42389 13.9011 1.47399C14.8447 0.491331 16.0916 0 17.6418 0C19.1245 0 20.3883 0.540462 21.433 1.62139C22.4777 2.70231 23 4.14355 23 5.94509C23 10.2033 20.5062 13.8227 15.5187 16.8035Z" fill="#00FFA3">

                            </path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
</div>

<?php
                });

//Blog  carosol

        Block::make(__('Blog  carosol'))
                ->add_fields([
                    Field::make('association', 'get_blog_association', __('Select Item'))
                    ->set_types(array(
                        array(
                            'type' => 'post',
                            'post_type' => 'post',
                        )
                    )),
                    Field::make('text', 'get_blog_buttontitle', __('Button Text')),
                    Field::make('text', 'get_blog_buttonurl', __('Page URL'))
                ])
                ->set_icon('groups')
                ->set_render_callback(function ($fields, $attributes, $inner_blocks) {
                    ?>
<div class="container-lg-custom">
    <div class="part-two">
        <div class="media-group">
            <div class="mb-4 slick-slider-wrapper post-slider-wrapper">
                <!-- <div class="slick-slider base-slick-slider post-slider slick-initialized" dir="ltr"> -->
                <?php
                                                foreach ($fields['get_blog_association'] as $bitem) {
                                                    $postId = $bitem['id'];
                                                    //$postdata = get_post($item['id']);                             
                                                    
                                                    
                                                    $my_post_content = apply_filters('the_content', get_post_field('post_content', $postId));
                                                    ?>
                <div class="item-wrapper" tabindex="-1" style="width: 100%; display: inline-block;">
                    <div class="singleBlog isRadius16 d-flex flex-column justify-content-between">
                        <div class="content-part">
                            <?php if (has_post_thumbnail($postId)) : 
                                            $featured_img_url = get_the_post_thumbnail_url($postId, 'full');
                                            $featured_img_resized = aq_resize($featured_img_url, 350, 200, true);
                                            ?>
                            <div class="blogImage">
                                <a data-target="#root" class="text-decoration-none" href="<?php echo get_permalink($postId); ?>">
                                    <img class="lazy-load-image lazyload img-fluid w-100" src="<?php echo $featured_img_resized?$featured_img_resized:$featured_img_url ?>" alt="<?php echo get_the_title($postId); ?>" width="350px" height="200px" loading="lazy">
                                </a>
                            </div>

                            <?php endif?>
                            <div class="blogInfo p-4">
                                <h3 class="blogTitle fs-6 fw-bold mb-2">
                                    <a data-target="#root" class="text-decoration-none text-white" href="<?php echo get_permalink($postId); ?>"><?php echo get_the_title($postId); ?></a>
                                </h3>
                                <div class="blogDesc textClrGray fw-normal fs-14">
                                    <p class="mb-0"><?php echo wp_trim_words($my_post_content, 28, '...'); ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="link-part p-4 pt-0">
                            <a class="readMore d-flex align-items-center fs-14 fwSemiBold text-decoration-none" href="<?php echo get_permalink($postId); ?>">
                                <span>Read More</span>
                                <svg width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12.6265 5.18872L17.9377 10.5L12.6265 15.8112" stroke="#6B6E78" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M3.0625 10.5H17.7887" stroke="#6B6E78" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round">
                                    </path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
                <?php } ?>
                <!-- </div> -->
            </div>
        </div>
        <?php if (@$fields['get_blog_buttonurl']) : ?>
        <div class="part-two-button">
            <div class="btn-wrapper blog-btnwrwpper">
                <a class="blogpagelink d-inline-flex justify-content-center align-items-center gap-2" href="<?php echo do_shortcode($fields['get_blog_buttonurl']) ?>">
                    <span><?php echo $fields['get_blog_buttontitle'] ?></span>
                    <span class="btn-arrow"><svg width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12.6265 5.18872L17.9377 10.5L12.6265 15.8112" stroke="#6B6E78" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path>
                            <path d="M3.0625 10.5H17.7887" stroke="#6B6E78" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg></span>
                </a>
            </div>
        </div>
        <?php endif?>
    </div>
</div>

<?php
                });
// Inner page banner

        Block::make(__('Inner page banner'))
                ->add_fields(array(
                    Field::make('text', 'get_inner_heading', __('Block Heading')),
                    Field::make('text', 'get_inner_title', __('Block Title')),
                    Field::make('text', 'get_inner_desc', __('Block Description')),
                    Field::make('image', 'get_inner_img', __('Block Image')),
                    Field::make('text', 'get_inner_btn', __('Button text')),
                    Field::make('text', 'get_inner_url', __('Button URL')),
                    Field::make('text', 'get_inner_btn_2', __('Internal linking text')),
                    Field::make('text', 'get_inner_url_2', __('Internal linking URL')),
                ))
                ->set_render_callback(function ($fields, $attributes, $inner_blocks) {
                    ?>

<section class="subPageBanner position-relative bgClrDarkLight">
    <div class="container-lg">
        <div class="bannerContent row align-items-center">
            <div class="bannerInfo col-lg-6">
                <h6 class="banner-tag-line textClrGreen fs-6 fwBold"><?php echo $fields['get_inner_heading'] ?></h6>
                <div class="banner-heading fs-48 fw-normal">
                    <h1><?php echo $fields['get_inner_title']; ?></h1>
                </div>
                <div class="banner-desc"><?php echo $fields['get_inner_desc'] ?></div>
                <?php 
                    $url = $fields['get_inner_url'];
                    if (!empty( $url)) :                    
                    ?>
                <div class="btn-wrapper">
                    <a class="btn position-relative border-0 rounded-pill d-flex align-items-center justify-content-center gap-2" href="<?php echo do_shortcode($url) ?>">
                        <span><?php echo $fields['get_inner_btn'] ?></span>
                        <span class="btn-arrow"></span>
                    </a>
                </div>
                <?php endif; ?>
            </div>
            <div class="bannerImage col-lg-6 text-center text-lg-end">
                <?php $inner_banner_img = $fields['get_inner_img'] ?>
                <img class="lazy-load-image lazyload img-fluid img-banner" src="<?php echo wp_get_attachment_url($inner_banner_img); ?>" alt="<?php echo $fields['get_inner_heading'] ?>" width="500px" height="422px" loading="lazy">
            </div>
        </div>
    </div>
    <?php if (@$fields['get_inner_url_2']) : ?>
    <div class="banner-go-to text-center">
        <a href="<?php echo do_shortcode($fields['get_inner_url_2']) ?>">
            <span><?php echo (@$fields['get_inner_btn_2'])?$fields['get_inner_btn_2']:'Show more' ?></span>
            <img class="lazy-load-image lazyload " src="<?php echo get_template_directory_uri() ?>/images/go-to-btn.svg" alt="" width="50px" height="50px" loading="lazy">
        </a>
    </div>
    <?php endif?>
</section>
<?php
                });
// Our Sucess Story
        Block::make(__('Our success'))
                ->add_fields(array(
                    Field::make('text', 'get_os_heading', __('Block Heading')),
                    Field::make('text', 'get_os_title', __('Block Title')),
                    Field::make('text', 'get_os_desc', __('Block Description')),
                    Field::make('text', 'get_os_cp', __('Completed project')),
                    Field::make('text', 'get_os_hc', __('Happy client')),
                    Field::make('text', 'get_os_aw', __('Award-win')),
                ))
                ->set_render_callback(function ($fields, $attributes, $inner_blocks) {
                    ?>

<section id="about-0" class="wrapper-section secPadding secPaddingBottom about-0 about-our-success our-success WhoWeAre contentVerticallyCenter">
    <div class="container-lg">
        <div class="row">
            <div class="col-lg-6 order-lg-last">
                <div class="sectionHeader">
                    <div class="secTagLine"><?php echo $fields['get_os_heading'] ?></div>
                    <div class="secIntro">
                        <h2><?php echo $fields['get_os_title'] ?></h2>
                        <hr>
                        <p><?php echo $fields['get_os_desc'] ?></p>
                    </div>
                </div>
            </div>
            <div class="tab-mobile-margin-top col-lg-6">
                <div class="activity-grid-container">
                    <div class="items item2">
                        <div class="wrapper">
                            <div class="icon">
                                <svg width="100" height="100" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <rect opacity="0.05" width="100" height="100" rx="16" fill="#FF317B"></rect>
                                    <path d="M60.0374 33.0646H31.3257C30.2833 33.0646 29.4355 33.9124 29.4355 34.9547V73.1099C29.4355 74.1523 30.2833 75 31.3257 75H60.0374C61.0787 75 61.9265 74.1523 61.9265 73.1099V34.9547C61.9265 33.9124 61.0787 33.0646 60.0374 33.0646ZM53.6291 59.6775H38.3065C37.4154 59.6775 36.6936 58.9557 36.6936 58.0646C36.6936 57.1734 37.4154 56.4517 38.3065 56.4517H53.6291C54.5202 56.4517 55.242 57.1734 55.242 58.0646C55.242 58.9557 54.5202 59.6775 53.6291 59.6775ZM53.6291 53.2259H38.3065C37.4154 53.2259 36.6936 52.5041 36.6936 51.613C36.6936 50.7218 37.4154 50.0001 38.3065 50.0001H53.6291C54.5202 50.0001 55.242 50.7218 55.242 51.613C55.242 52.5041 54.5202 53.2259 53.6291 53.2259ZM53.6291 46.7743H38.3065C37.4154 46.7743 36.6936 46.0525 36.6936 45.1613C36.6936 44.2702 37.4154 43.5484 38.3065 43.5484H53.6291C54.5202 43.5484 55.242 44.2702 55.242 45.1613C55.242 46.0525 54.5202 46.7743 53.6291 46.7743Z" fill="#FF317B"></path>
                                    <path d="M70.5644 29.8387V65.3226C70.5644 67.7581 68.6046 70.1613 65.1521 70.1613V34.9546C65.1521 32.1331 62.8577 29.8387 60.0372 29.8387H34.8477C34.8477 27.1704 37.1471 25 39.9727 25H65.4394C68.265 25 70.5644 27.1704 70.5644 29.8387Z" fill="#FF317B"></path>
                                </svg>
                            </div>
                            <div class="title">Completed project</div>
                            <div class="content">
                                <p><?php echo $fields['get_os_cp'] ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="items item3">
                        <div class="wrapper">
                            <div class="icon">
                                <svg width="100" height="100" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <rect opacity="0.05" width="100" height="100" rx="16" fill="#4991FF"></rect>
                                    <path d="M66.8273 43.4479H55.8148L58.2253 37.4229C58.5699 36.5645 58.6549 35.6238 58.4698 34.7176C58.2846 33.8113 57.8374 32.9793 57.1836 32.325C56.8159 31.9576 56.3726 31.6748 55.8846 31.4959C55.3966 31.3171 54.8755 31.2467 54.3575 31.2895C53.8395 31.3323 53.3371 31.4874 52.8851 31.7439C52.433 32.0004 52.0422 32.3523 51.7398 32.775L45.3003 41.7854C44.3391 43.1277 43.2703 44.3895 42.1044 45.5583L40.0419 47.6208C39.948 47.7146 39.8735 47.826 39.8228 47.9486C39.772 48.0712 39.746 48.2027 39.7461 48.3354V63.8375C39.7459 64.1061 39.8523 64.3638 40.0419 64.5541L42.3523 66.875C42.9409 67.4666 43.6409 67.9356 44.4119 68.255C45.1829 68.5743 46.0095 68.7376 46.844 68.7354H59.3982C60.3894 68.7346 61.3592 68.4467 62.1903 67.9066C63.0214 67.3664 63.6783 66.5971 64.0815 65.6916L70.2398 51.8354C70.6339 50.9517 70.8362 49.9946 70.8336 49.0271V47.4562C70.8325 46.3939 70.4101 45.3753 69.6591 44.6239C68.9081 43.8725 67.8897 43.4495 66.8273 43.4479Z" fill="#4991FF"></path>
                                    <path d="M32.8056 46.2645C31.8403 46.2645 30.9146 46.648 30.232 47.3305C29.5495 48.0131 29.166 48.9388 29.166 49.9041V63.5895C29.166 64.5548 29.5495 65.4805 30.232 66.1631C30.9146 66.8456 31.8403 67.2291 32.8056 67.2291C33.7709 67.2291 34.6966 66.8456 35.3792 66.1631C36.0617 65.4805 36.4452 64.5548 36.4452 63.5895V49.9041C36.4452 48.9388 36.0617 48.0131 35.3792 47.3305C34.6966 46.648 33.7709 46.2645 32.8056 46.2645Z" fill="#4991FF"></path>
                                </svg>
                            </div>
                            <div class="title">Happy client</div>
                            <div class="content">
                                <p><?php echo $fields['get_os_hc'] ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="items item4">
                        <div class="wrapper">
                            <div class="icon">
                                <svg width="100" height="100" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <rect opacity="0.05" width="100" height="100" rx="16" fill="#FFB156"></rect>
                                    <path d="M50.0001 34.8711C45.2887 34.8711 41.4551 38.7047 41.4551 43.4161C41.4551 48.1275 45.2887 51.9611 50.0001 51.9611C54.7115 51.9611 58.5451 48.1275 58.5451 43.4161C58.5451 38.7047 54.7115 34.8711 50.0001 34.8711Z" fill="#FFB156"></path>
                                    <path d="M48.0807 64.0469L48.0348 64.005L46.946 63.0197L44.3838 60.7015L41.5979 61.0013L39.893 61.184L39.4888 61.2279L38.1871 61.3676L34.0879 70.0786L40.4359 70.1626L44.5448 75L49.2163 65.0742L48.0807 64.0469Z" fill="#FFB156"></path>
                                    <path d="M61.8124 61.3676L60.5107 61.2279L60.1065 61.1849L58.4017 61.0013L55.6157 60.7015L53.0535 63.0197L51.9647 64.005L51.9188 64.0469L50.7832 65.0742L55.4547 75L59.5636 70.1626L65.9116 70.0786L61.8124 61.3676Z" fill="#FFB156"></path>
                                    <path d="M64.9646 43.4162L67.5142 37.7254L62.1065 34.6201L60.8244 28.5172L54.6238 29.1831L49.9993 25L45.3748 29.1832L39.1742 28.5173L37.8921 34.6201L32.4844 37.7253L35.0339 43.4161L32.4844 49.1069L37.8921 52.2121L39.1742 58.315L39.6469 58.2643L41.3527 58.0807L43.0576 57.898L43.5146 57.8492H43.5156L45.3748 57.649L46.7731 58.9136L48.2486 60.2484L48.7086 60.6645L49.3843 61.2757L49.9994 61.8322L50.6145 61.2757L51.2902 60.6645L51.7502 60.2484L52.8976 59.2114L52.8985 59.2104L54.6239 57.6491L57.6373 57.9724H57.6383L57.9449 58.0056L58.646 58.0808H58.647L60.3519 58.2644L60.8245 58.3151L62.1066 52.2122L67.5144 49.107L64.9646 43.4162ZM49.9993 54.8906C43.6728 54.8906 38.5248 49.7437 38.5248 43.4161C38.5248 37.0896 43.6728 31.9416 49.9993 31.9416C56.3259 31.9416 61.4738 37.0896 61.4738 43.4161C61.4738 49.7437 56.3259 54.8906 49.9993 54.8906Z" fill="#FFB156"></path>
                                </svg>
                            </div>
                            <div class="title">Award-win</div>
                            <div class="content">
                                <p><?php echo $fields['get_os_aw'] ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
                });

        // Awards & recognition
        Block::make(__('Awards and recognition'))
                ->add_fields(array(
                    Field::make('complex', 'get_ar_block', __('Awards and recognition'))
                    ->set_layout('tabbed-vertical')
                    ->add_fields(array(
                        Field::make('text', 'get_ar_title', __('Title')),
                        Field::make('image', 'get_ar_icon', __('Icon')),
                    )),
                ))
                ->set_render_callback(function ($fields, $attributes, $inner_blocks) {
                    ?>
<div class="container-lg">
            <div class="OurAwardWrapper mb--3">
                <?php
                                    foreach ($fields['get_ar_block'] as $item) {
                                        $aricon = $item['get_ar_icon'];
                                        ?>
                <div class="OurAwardItem px-3 py-3 text-center">
                    <div class="icon mb-3">
                        <img class="lazy-load-image lazyload " src="<?php echo wp_get_attachment_url($aricon); ?>" alt="<?php echo $item['get_ar_title'] ?>" width="" height="" loading="lazy">
                    </div>
                    <h4 class="title fs-14 fw-bold text-white">
                        <?php echo $item['get_ar_title'] ?>
                    </h4>
                </div>
                <?php
                                    }
                                    ?>
            </div>
</div>
<?php
                });

        /*
          Inner page content block
         */
        Block::make(__('Inner page content block'))
                ->add_fields(array(
                    Field::make('text', 'get_ipcb_heading', __('Inner Block Heading')),
                    Field::make('text', 'get_ipcb_title', __('Inner Block Title')),
                    Field::make('radio', 'get_ipcb_title_tag', __('Title Tag'))
                    ->add_options(array(
                        'h4' => __('H4'),
                        'h2' => __('H2'),
                    )),
                    Field::make('rich_text', 'get_ipcb_desc', __('Inner Block Description')),
                    Field::make('image', 'get_ipcb_image', __('Inner Block Image')),                   
                    Field::make('text', 'get_ipcb_butn', __('Inner Button Title')),
                    Field::make('text', 'get_ipcb_url', __('Inner URL')),
                    Field::make('radio', 'get_ipcb_styling', __('Image Position'))
                    ->add_options(array(
                        'left' => __('Left'),
                        'Right' => __('Right'),
                    )),
                    Field::make('radio', 'get_ipcb_stylingbg', __('Background Style'))
                    ->add_options(array(
                        'dark' => __('Dark'),
                        'bgClrDarkLight' => __('bgClrDarkLight'),
                    )),
                ))
                ->set_render_callback(function ($fields, $attributes, $inner_blocks) {
                    $img = $fields['get_ipcb_image'];
                    $imgposition = $fields['get_ipcb_styling'];
                    $bgclass = $fields['get_ipcb_stylingbg']; 
                    ?>

<div id="product-design-sprint-4" class="<?php echo $bgclass; ?> section-wrapper secPadding secPaddingBottom section-js product-design-sprint-4 product-design-sprint-our-mission our-mission  contentVerticallyCenter">
    <div class="container-lg">
        <div class="row">
            <?php  
            $tag = $fields['get_ipcb_title_tag']?$fields['get_ipcb_title_tag']:'h4';
                ?>
            <div class="col-lg-6 left-right-content <?php echo ($imgposition == 'left')?'order-lg-last':'' ?>">
                <div class="part-one">
                    <div class="secTagLine"><?php echo $fields['get_ipcb_heading']; ?></div>
                    <div class="secIntro">
                        <?php if ($fields['get_ipcb_title']) : ?>
                            <?php echo '<'.$tag.'>' ?><?php echo $fields['get_ipcb_title']; ?><?php echo '</'.$tag.'>' ?>                        
                            <hr>
                        <?php endif?>
                        <div><?php echo do_shortcode($fields['get_ipcb_desc']); ?></div>
                    </div>
                    <?php                
                    if(!empty($fields['get_ipcb_url'])): ?>
                    <div class="btn-wrapper">
                        <a data-target="#front-end-development-5" aria-current="page" class="btn position-relative border-0 rounded-pill d-flex align-items-center justify-content-center link-to-id active gap-2" href="<?php echo $fields['get_ipcb_url']; ?>">
                            <span data-target="#front-end-development-5"><?php echo do_shortcode($fields['get_ipcb_butn']); ?></span>
                            <span class="btn-arrow"></span>
                        </a>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-lg-6 tab-mobile-margin-top">
                <div class="part-two text-start">
                    <img class="lazy-load-image lazyload img-fluid section-featured-img" src="<?php echo wp_get_attachment_url($img); ?>" alt="Developin" width="540px" height="440px" loading="lazy">
                </div>
            </div>


        </div>
    </div>
</div>

<?php
                });

// FAQ
        Block::make(__('FAQ Block'))
                ->add_fields(array(
                    Field::make('complex', 'get_faq', __('FAQ Block'))
                    ->set_layout('tabbed-vertical')
                    ->add_fields(array(
                        Field::make('text', 'question', __('Question')),
                        Field::make('rich_text', 'answer', __('Answer')),
                    )),
                ))
                ->set_render_callback(function ($fields, $attributes, $inner_blocks) {
                    ?>
<div class="container-lg faqblock">
            <div class="part-two text-start">
                <div class="media-group">
                    <div class="faqList">
                        <div class="accordion accordion-flush" id="accordionFlushExample">
                            <div class="row">
                                <div class="col-xl-6">
                                <?php
                                $id = 1;
                                $breakPoint = ceil(count($fields['get_faq'])/2);
                                foreach ($fields['get_faq'] as $faq) {
                                ?>
                                    <div class="mb-3 overflow-hidden accordion-item" id="flush-heading<?php echo $id; ?>">
                                        <h2 class="fs-6 fw-bold accordion-header">
                                            <button aria-expanded="false" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#flush-collapse<?php echo $id; ?>" aria-expanded="false" aria-controls="flush-collapseOne">
                                                <?php echo $faq['question'] ?>
                                            </button>
                                        </h2>
                                        <div id="flush-collapse<?php echo $id; ?>" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                            <div class="fw-normal fs-6 accordion-body">
                                                <?php echo $faq['answer'] ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                                    if($id==$breakPoint) echo '</div><div class="col-xl-6">';
                                    $id++;
                                }
                                ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
</div>

<?php
                });

//What we offer    
        Block::make(__('What we offer'))
                ->add_fields(array(
                    Field::make('text', 'wwo_heading', __('What we offer')),
                    Field::make('text', 'wwo_tag', __('Tagline')),                    
                    Field::make('radio', 'wwo_tag_tag', __('Tagline Tag'))
                    ->add_options(array(
                        'h4' => __('H4'),
                        'h2' => __('H2'),
                    )),
                    Field::make('rich_text', 'wwo_desc', __('Blok description')),
                    Field::make('text', 'wwo_btn', __('Button')),
                    Field::make('text', 'wwo_btn_url', __('Button URL')),
                    Field::make('complex', 'wwo_associet', __('Offer Item'))
                    ->set_layout('tabbed-vertical')
                    ->add_fields(array(
                        Field::make('text', 'wwo_associet_title', __('Offer Title')),
                        Field::make('text', 'wwo_associet_desc', __('Offer item description')),
                        Field::make('image', 'wwo_associet_photo', __('Offer Icon')),
                    )),
                    Field::make('select', 'wwo_grid', __('Grid Number Select'))
                ->add_options(array(
                    'col-lg-6' => __('2 Item'),
                    'col-lg-12' => __('1 Item'),                   
                ))
                ))
                ->set_render_callback(function ($fields, $attributes, $inner_blocks) {
                    $tag = $fields['wwo_tag_tag']?$fields['wwo_tag_tag']:'h4';
                    ?>

<div id="workshops-2" class="section-wrapper secPadding section-js workshops-2 workshops-what-we-offer what-we-offer ">
    <div class="container-lg">
        <div class="row">
            <div class="col-lg-6   left-right-content">
                <div class="part-one">
                    <div class="secTagLine"><?php echo $fields['wwo_heading'] ?></div>
                    <div class="secIntro">
                        <?php if ($fields['wwo_tag']) :?>
                            <?php echo '<'.$tag.'>' ?><?php echo $fields['wwo_tag'] ?><?php echo '</'.$tag.'>' ?>
                            <hr>
                        <?php endif?>
                        <div>
                            <?php echo do_shortcode($fields['wwo_desc']) ?>
                        </div>
                    </div>
                    <div class="btn-wrapper">
                        <a class="btn position-relative border-0 rounded-pill d-flex align-items-center justify-content-cente gap-2" href="<?php echo do_shortcode($fields['wwo_btn_url']) ?>">
                            <span><?php echo $fields['wwo_btn'] ?></span>
                            <span class="btn-arrow"></span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 tab-mobile-margin-top">
                <div class="part-two text-start">
                    <div class="media-group">
                        <div class="row mb--4">
                            <?php
                            foreach ($fields['wwo_associet'] as $item) {
                                $woicon = $item['wwo_associet_photo'];
                                ?>
                            <div class="mb-4 block-unit <?php echo ($fields['wwo_grid'] != 'col-lg-12')?'col-sm-6':'col-sm-12' ?> <?php echo $fields['wwo_grid'] ?>">
                                <div class="media-block template-3">
                                    <div class="block-part-one">
                                        <div class="block-image">
                                            <img class="lazy-load-image lazyload " src="<?php echo wp_get_attachment_url($woicon); ?>" alt="<?php echo $item['wwo_associet_title'] ?>" width="40px" height="40px" loading="lazy">
                                        </div>
                                        <h3 class="block-title active">
                                            <span class="block-title-text"><?php echo $item['wwo_associet_title'] ?></span>
                                        </h3>
                                        <div class="block-desc">
                                            <?php echo $item['wwo_associet_desc'] ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
                });

// Scrolling Content Block
        Block::make(__('Scrolling Content Block'))
                ->add_fields(array(
                    Field::make('complex', 'seb_block', __('Scrolling Content Block'))
                    ->set_layout('tabbed-vertical')
                    ->add_fields(array(
                        Field::make('text', 'scb_title', __('Slide Title')),
                        Field::make('rich_text', 'scb_sidenote', __('Sidenote Content'))
                    )),
                ))
                ->set_render_callback(function ($fields, $attributes, $inner_blocks) {
                    ?>

<div class="container-lg scrolling-content-block">
            <div class="part-two text-start">
                <div class="media-group">
                    <div class="row">
                        <div class="col-lg-4 tab-anchor-list d-none d-lg-block">
                            <div class="list-group position-sticky start-0 tab-navigation">
                                <h4 class="fs-24">Contents</h4>
                                <?php
                                $id = 0;
                                foreach ($fields['seb_block'] as $aitems) {
                                ?>
                                <a id="list-item-<?php echo $id ?>-link" href="#list-item-<?php echo $id; ?>" class="list-group-item list-group-item-action <?php echo !$id?'active':'' ?>">
                                    <span>
                                        <?php echo $aitems['scb_title'] ?>
                                    </span>
                                </a>

                                <?php
                                                        $id++;
                                                    }
                                                    ?>
                            </div>
                        </div>
                        <div class="col-lg-8 tab-content-list">
                            <?php
                            $i = 0;
                            foreach ($fields['seb_block'] as $items) {
                            ?>
                            <div id="list-item-<?php echo $i ?>" class="section tab-content">
                                <div class="media-block template-3">
                                    <div class="block-part-one">
                                        <h3 class="block-title ">
                                            <span class="block-title-text">
                                                <?php echo $items['scb_title'] ?>
                                            </span>
                                        </h3>
                                        <div class="block-desc">
                                            <?php echo $items['scb_sidenote'] ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                                                    $i++;
                                                }
                                                ?>
                        </div>
                    </div>
                </div>
            </div>
</div>
<?php
                });

//Process
        Block::make(__('Process'))
                ->add_fields(array(
                    Field::make('complex', 'proc_block', __('Process Block'))
                    ->set_layout('tabbed-vertical')
                    ->add_fields(array(
                        Field::make('text', 'proc_heading', __('Block Heading')),
                        Field::make('textarea', 'proc_content', __('Block Content')),
                        Field::make('image', 'proc_image', __('Block Image')),
                    )),
                    Field::make('select', 'proc_select', __('Select Grid'))
                    ->set_options(array(
                        'col-lg-6' => __('2 Item'),
                        'col-lg-4' => __('3 Item'),
                        'col-lg-3' => __('4 Item'),
                        'col-lg-one-fifth' => __('5 Item'),
                        'col-lg-2' => __('6 Item'),
                    )),
                ))
                ->set_render_callback(function ($fields, $attributes, $inner_blocks) {
                    $gridclass = $fields['proc_select'];
                    ?>
<div class="container-lg">
            <div class="part-two text-start">
                <div class="media-group">
                    <div class="row mb--4">
                        <?php
                                            foreach ($fields['proc_block'] as $proc) {
                                                $img = $proc['proc_image'];
                                                ?>
                        <div class="mb-4 block-unit process-unit col-lg-2 col-sm-4 <?php echo $gridclass?>">
                            <div class="media-block template-6">
                                <div class="block-part-one">
                                    <div class="block-image">
                                        <img class="lazy-load-image lazyload " src="<?php echo wp_get_attachment_url($img); ?>" alt="<?php echo $proc['proc_heading']; ?>" width="60px" height="60px" loading="lazy">
                                    </div>
                                    <h3 class="block-title active">
                                        <span class="block-title-text"> <?php echo $proc['proc_heading']; ?></span>
                                    </h3>
                                    <div class="block-desc">
                                        <?php echo $proc['proc_content']; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
</div>

<?php
                });

//Inner Content With Form
Block::make(__('Inner Content With Form'))
->add_fields(array(
    Field::make('text', 'icwf_heading', __('Inner Content With Form')),
    Field::make('text', 'icwf_tag', __('Tagline')),
    Field::make('text', 'icwf_desc', __('Blok description')),
    Field::make('text', 'icwf_btn', __('Button')),
    Field::make('text', 'icwf_btn_url', __('Button URL')),
    Field::make('text', 'icwf_btn_shortcode', __('Shortcode')),
   
))
->set_render_callback(function ($fields, $attributes, $inner_blocks) {
    ?>
<section id="front-end-development-5" class="wrapper-section secPadding secPaddingBottom front-end-development-5 front-end-development-lets-chat lets-chat bgClrDarkLight">
    <div class="container-lg">
        <div class="row">
            <div class="col-lg-6 ">
                <div class="sectionHeader">
                    <div class="secTagLine"><?php echo $fields['icwf_heading'] ?></div>
                    <div class="secIntro">
                        <h2><?php echo $fields['icwf_tag'] ?></h2>
                        <hr>
                        <div>
                            <?php echo $fields['icwf_desc'] ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-mobile-margin-top col-lg-6">
                <div class="contactWrapper bgClrSolitude isRadius12 h-100 form-validation undefined">
                    <div class="Toastify">
                    </div>
                    <?php echo $fields['icwf_btn_shortcode'] ?>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
});



//Content and List item block
Block::make(__('Content and List item block'))
->add_fields(array(
    Field::make('textarea', 'content_part', __('Content item')),
    Field::make('textarea', 'list_part', __('List Item')),
    
   
))
->set_render_callback(function ($fields, $attributes, $inner_blocks) {
    ?>
<div class="container-lg">
            <div class="part-two text-start">
                <div class="media-group">
                    <div class="row">
                        <div class="mb-4 block-unit col-sm-6">
                            <div class="media-block template-2">
                                <div class="block-part-one">
                                    <div class="block-desc">
                                        <div class="contentpart"><?php echo $fields['content_part'] ?></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mb-4 block-unit listpart col-sm-6">
                            <div class="media-block template-2">
                                <div class="block-part-one">
                                    <div class="block-desc">
                                        <div class="listpart"><?php echo $fields['list_part'] ?></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
</div>
<?php
});



// Section title block start
    Block::make(__('CTA Block'))
            ->add_fields(array(
                Field::make('text', 'mos_cta_title', __('Section title')),
                Field::make('text', 'mos_cta_heading', __('Section subtitle')),
                Field::make('textarea', 'mos_cta_desc', __('Section Intro')),
                Field::make('text', 'mos_cta_form_title', __('Form title')),
                Field::make('text', 'mos_cta_form_shortcode', __('Form Shortcode')),
            ))
            ->set_render_callback(function ($fields, $attributes, $inner_blocks) {
                $address = carbon_get_theme_option('mos-contact-contact-address'); 
                $phone = carbon_get_theme_option('mos-contact-phone');
                $whatsapp = carbon_get_theme_option('mos-contact-whatsapp');
                $skype = carbon_get_theme_option('mos-contact-skype');
                $business_hours = carbon_get_theme_option('mos-contact-business-hours');
                ?>

<section id="contact-0" class="wrapper-section secPadding contact-0 contact-lets-talk lets-talk contactDetails bgClrDarkLight">
    <div class="container-lg">
        <div class="row">
            <div class="col-lg-6 ">
                <div class="part-one">
                    <div class="sectionHeader">
                        <?php if($fields['mos_cta_heading']) : ?>
                        <div class="secTagLine"><?php echo $fields['mos_cta_heading'] ?></div>
                        <?php endif?>

                        <div class="ContactSecIntro secIntro">
                            <?php if($fields['mos_cta_title']) : ?><h1><?php echo $fields['mos_cta_title'] ?></h1><?php endif?>
                            <?php if($fields['mos_cta_desc']) : ?><p><?php echo $fields['mos_cta_desc'] ?></p><?php endif?>
                            <hr>
                        </div>

                    </div>
                    <div class="getInTouch">
                        <div class="row isBgBorder mb-30">
                            <?php if ($address && sizeof($address)): ?>
                            <?php foreach($address as $key => $value) : ?>

                            <div class="col-sm-<?php echo ($key<2)? '6': '12' ?>">
                                <div class="contact-page-address singleInfo d-flex gap-3 gap-xl-4 align-items-center mb-30">
                                    <div class="icon">
                                        <img class="lazy-load-image lazyload " src="<?php echo get_template_directory_uri(); ?>/images/location-icon.706bc3e6.svg" alt="lineShape" width="" height="" loading="lazy">
                                    </div>
                                    <div class="info">
                                        <h4 class="country text-white fw-bold fs-14"><?php echo ($value['title'])?$value['title']:'Office Location' ?></h4>
                                        <div class="address fs-14 fw-medium mb-0">
                                            <?php if ($value["link"]):?>
                                            <a class="textClrGray" href="<?php echo $value["link"];?>" target="_blank"><?php echo  $value["address"];?></a>
                                            <?php else : ?>
                                            <span class="textClrGray"><?php echo $value["address"];?></span>
                                            <?php endif?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach?>
                            <?php endif?>
                        </div>
                        <div class="row isBgBorder mb-30">
                            <?php if ($phone && sizeof($phone)) :?>
                            <?php foreach($phone as $key => $value) :?>
                            <div class="col-6 col-sm-4">
                                <div class="singleInfo d-flex gap-3 gap-xl-4 align-items-center mb-30">
                                    <div class="icon">
                                        <img class="lazy-load-image lazyload " src="<?php echo get_template_directory_uri(); ?>/images/phone.78735261.svg" alt="lineShape" width="" height="" loading="lazy">
                                    </div>
                                    <div class="info">
                                        <h4 class="country text-white fw-bold fs-14"><?php echo ($value['title'])?$value['title']:'Phone' ?></h4>
                                        <?php
                                                $a = carbon_get_theme_option('mos-contact-phone'); 
                                                ?>
                                        <a href="tel:<?php echo @$value["number"];?>" class="address textClrGray fs-14 fw-medium mb-0 text-decoration-none">
                                            <?php echo @$value["number"];?>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach;?>
                            <?php endif?>
                            <?php 
                            if ($whatsapp): 
                                $values = explode("|",$whatsapp)
                                ?>
                            <div class="col-6 col-sm-4">
                                <div class="singleInfo d-flex gap-3 gap-xl-4 align-items-center mb-30">
                                    <div class="icon">
                                        <img class="lazy-load-image lazyload " src="<?php echo get_template_directory_uri(); ?>/images/whatsapp.3c1b923b.svg" alt="lineShape" width="" height="" loading="lazy">
                                    </div>
                                    <div class="info">
                                        <h4 class="country text-white fw-bold fs-14">WhatsApp</h4>
                                        <a href="<?php echo $values[0]; ?>" class="address textClrGray fs-14 fw-medium mb-0" target="_blank"><?php echo $values[1]?$values[1]:$values[0]; ?></a>
                                    </div>
                                </div>
                            </div>
                            <?php endif?>
                            <?php 
                            if ($skype): 
                                $values = explode("|",$skype)
                                ?>
                            <div class="col-12 col-sm-4 mt-3 mt-sm-0">
                                <div class="singleInfo d-flex gap-3 gap-xl-4 align-items-center mb-30">
                                    <div class="icon">
                                        <img class="lazy-load-image lazyload " src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABQAAAAVCAYAAABG1c6oAAAACXBIWXMAAAsTAAALEwEAmpwYAAAAAXNSR0IArs4c6
                                    QAAAARnQU1BAACxjwv8YQUAAAOmSURBVHgBlZVPaBxVHMe/7/dmM7NJdjObNHW1hU4tlbagbGoPeqjdHBRMq1Q8eJ
                                    KQgwdPRfAiiE1E9CKlevGYBEWoEexFDwVhix4CYrMiUejfof+SNqXZNN1Ndnd2X3/vzZ/tUgrtg8e8efP7feb7+/NmBB4abnHa
                                    dRynAEJR37cVlRsbtVKlNFHBEw4RL54Z++kYhJoUCq55IAWcLX2w+mw4+WxJSgtEoiIknW4122fLn4z4jwXmx+aOs
                                    57JGNS7fQDOcB9ISghBvCcZFl4FX/UaZM1I1Z6a/2hvF1hsffPUURL4Rd/ItIXMrkFIJ8WODJHUDdSwCMobYNW+Ihqd/3BnAt
                                    Vmx8yiRyLzPMNsyzgbgKBEkX6BnujaE54kOvfKd1e8GGgpUgXOGzK7tTIrdIoUaMcDO7LYk+9FhtVfuFPHH/6GtlEME2yjeLo9KUtHO
                                    GJCzo+dUvZQGv1ejkPTqmQS2udHPLz14mBX0pfWA4zP3VC1JjQwSQEnYKI0sXXGYhvfHur1THiCkly9/dKQgS3da2LqzE2zf3ifi4wtUW2yQApB
                                    goVqxSAxzqwZi3poNpVNHxdRnuJQM+mUUfT39RoWbmyYwpSXVzqFMaBwzTBeUrE4verSYCFfEhEkNAoNf12sYL3ewpF9A/jsjefw8rZexHbQdnG1
                                    TSrD/VQPPEuQzSVpJ8riUO43gfd/9PHBq8M4vDdr5jLn79v5Nfx5rRHZx9DQV1nkUquNNQ2J3yKSfiMuQAtf/L6Cd3+4ht/O30c+Y+HL14ewf5vziL1Jl2k/pP
                                    w4H0nYktsibGjdHliutvHV2VXMLVaN08EdTmTbDb260C5SeXKEz6fs5DFMuDi0qx/fv7ddjO3J4oVhGwe9PgPS4+Jqq1OUaDZqQLOuxi3TjIRZfliMwtDqRDa
                                    dUru32OLTUburD8u3Apy50kjyF8/KUqAfe8nX5sCJxQUGFuJ86HZ4diCF13b2I+tIU6RLlRb+ud3qNLOGcq6DhsDlvzY1pmIlZ1DQO0pa5ziSHBvpzhXLVaV+/r+
                                    mQxKdF5kzHH19QtjVf+uGwe1SphioP0MiCPazo0/8DYublnRCu2BhMXTbBNw9N/+rI9hUIUSpWXo4PxrK0kb5lM6aBteOccXjqopQ2fqKgr/QwGZVRerUN/6J3IzAY0
                                    ZxesljSYdYyVEpydWK6jXp1u6qwhrD2oGKTStKqCn/69xJU2A85fA+Xi3ywSrwUv8qfF6f9k/mkn/OAyusDVBu4I7RAAAAAElFTkSuQmCC" alt="lineShape" width="" height="" loading="lazy">
                                    </div>
                                    <div class="info">
                                        <h4 class="country text-white fw-bold fs-14">Skype</h4>
                                        <a href="<?php echo $values[0]; ?>" class="address textClrGray fs-14 fw-medium mb-0"><?php echo $values[1]?$values[1]:$values[0]; ?></a>
                                    </div>
                                </div>
                            </div>
                            <?php endif?>
                        </div>
                        <?php if ($business_hours && sizeof($business_hours)) :?>
                        <div class="row">
                            <div class="col-lg-12">
                                <?php foreach($business_hours as $key => $value) :?>
                                <div class="singleInfo d-flex gap-3 gap-xl-4 align-items-center">
                                    <div class="icon">
                                        <img class="lazy-load-image lazyload " src="<?php echo get_template_directory_uri(); ?>/images/clock.af3f340c.svg" alt="lineShape" width="" height="" loading="lazy">
                                    </div>
                                    <div class="info">
                                        <h4 class="country text-white fw-bold fs-14"><?php echo @$value['title'] ?></h4>
                                        <div class="address textClrGray fs-14 fw-medium mb-0 text-decoration-none"><?php echo @$value['hours'] ?></div>
                                    </div>
                                </div>
                                <?php endforeach;?>
                            </div>
                        </div>
                        <?php endif?>
                    </div>
                </div>
            </div>
            <div class="tab-mobile-margin-top col-lg-6">
                <div class="part-two">
                    <div class="contactWrapper bgClrSolitude isRadius12 h-100 form-validation undefined">
                        <?php if($fields['mos_cta_form_title']) : ?>
                        <div class="contactHeader mb-30">
                            <div class="textClrThemeDark fs-24 fw-bold mb-10"><?php echo $fields['mos_cta_form_title'] ?></div>
                        </div>
                        <?php endif?>
                        <?php if($fields['mos_cta_form_shortcode']) : ?>
                        <?php echo do_shortcode($fields['mos_cta_form_shortcode']) ?>
                        <?php endif?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
});




        //Mostack
        Block::make(__('Mos Media Block'))
                ->add_fields(array(
                    Field::make('image', 'mos-media-image', __('Image')),
                    Field::make('text', 'mos-media-icon-class', __('Icon Class')),
                    Field::make('textarea', 'mos-media-svg', __('SVG Code')),
                    Field::make('text', 'mos-media-heading', __('Heading')),
                    Field::make('rich_text', 'mos-media-content', __('Content')),
                    Field::make('text', 'mos-media-btn-title', __('Button')),
                    Field::make('text', 'mos-media-btn-url', __('URL')),
                    Field::make('multiselect', 'mos-media-block-one', __('Block One'))
                    ->set_options(array(
                        'image' => 'Image',
                        'icon' => 'Icon',
                        'svg' => 'SVG',
                        'heading' => 'Heading',
                        'content' => 'Content',
                        'button' => 'Button',
                    ))
                    ->set_default_value(['image', 'icon', 'svg', 'heading', 'content', 'button']),
                    Field::make('multiselect', 'mos-media-block-two', __('Block Two'))
                    ->set_options(array(
                        'image' => 'Image',
                        'icon' => 'Icon',
                        'svg' => 'SVG',
                        'heading' => 'Heading',
                        'content' => 'Content',
                        'button' => 'Button',
                    )),
                    Field::make('select', 'mos-media-alignment', __('Content Alignment'))
                    ->set_options(array(
                        'left' => 'Left',
                        'right' => 'Right',
                        'center' => 'Center',
                    )),
                ))
                ->set_icon('id-alt')
                ->set_render_callback(function ($fields, $attributes, $inner_blocks) {
                    ?>
<div class="mos-media-block-wrapper <?php echo (@$attributes['className']) ? $attributes['className'] : '' ?>">
    <div class="mos-media-block position-relative text-<?php echo esc_html($fields['mos-media-alignment']) ?>">
        <?php if (sizeof($fields['mos-media-block-one'])) : ?>
        <div class="part-one">
            <?php foreach ($fields['mos-media-block-one'] as $part_1) : ?>
            <?php if ($part_1 == 'image' && $fields['mos-media-image']) : ?>
            <div class="img-part"><?php echo wp_get_attachment_image($fields['mos-media-image'], 'full'); ?></div>
            <?php elseif ($part_1 == 'icon' && $fields['mos-media-icon-class']) : ?>
            <span class="icon-part"><i class="<?php echo esc_html($fields['mos-media-icon-class']); ?>"></i></span>
            <?php elseif ($part_1 == 'svg' && $fields['mos-media-svg']) : ?>
            <span class="svg-part"><?php echo $fields['mos-media-svg']; ?></span>
            <?php elseif ($part_1 == 'heading' && $fields['mos-media-heading']) : ?>
            <h4 class="title-part"><?php echo esc_html($fields['mos-media-heading']); ?></h4>
            <?php elseif ($part_1 == 'content' && $fields['mos-media-content']) : ?>
            <div class="desc"><?php echo apply_filters('the_content', $fields['mos-media-content']); ?></div>
            <?php elseif ($part_1 == 'button' && $fields['mos-media-btn-title'] && $fields['mos-media-btn-url']) : ?>
            <div class="wp-block-buttons">
                <div class="wp-block-button"><span title="" class="wp-block-button__link"><?php echo do_shortcode($fields['mos-media-btn-title']); ?></span>
                </div>
            </div>
            <?php endif; ?>
            <?php endforeach; ?>
        </div>
        <?php endif ?>
        <?php if (sizeof($fields['mos-media-block-two'])) : ?>
        <div class="part-two">
            <?php foreach ($fields['mos-media-block-two'] as $part_2) : ?>
            <?php if ($part_2 == 'image' && $fields['mos-media-image']) : ?>
            <div class="img-part"><?php echo wp_get_attachment_image($fields['mos-media-image'], 'full'); ?></div>
            <?php elseif ($part_2 == 'icon' && $fields['mos-media-icon-class']) : ?>
            <span class="icon-part"><i class="<?php echo esc_html($fields['mos-media-icon-class']); ?>"></i></span>
            <?php elseif ($part_2 == 'svg' && $fields['mos-media-svg']) : ?>
            <span class="svg-part"><?php echo $fields['mos-media-svg']; ?></span>
            <?php elseif ($part_2 == 'heading' && $fields['mos-media-heading']) : ?>
            <h4 class="title-part"><?php echo esc_html($fields['mos-media-heading']); ?></h4>
            <?php elseif ($part_2 == 'content' && $fields['mos-media-content']) : ?>
            <div class="desc"><?php echo apply_filters('the_content', $fields['mos-media-content']); ?></div>
            <?php elseif ($part_2 == 'button' && $fields['mos-media-btn-title'] && $fields['mos-media-btn-url']) : ?>
            <div class="wp-block-buttons">
                <div class="wp-block-button"><span title="" class="wp-block-button__link"><?php echo do_shortcode($fields['mos-media-btn-title']); ?></span>
                </div>
            </div>
            <?php endif; ?>
            <?php endforeach; ?>
        </div>
        <?php endif ?>
        <?php if ($fields['mos-media-btn-url']) : ?>
        <a href="<?php echo esc_url($fields['mos-media-btn-url']); ?>" class="hidden-link">Read more</a>
        <?php endif ?>
    </div>
</div>
<?php
                });
    }

add_action('carbon_fields_register_fields', 'crb_attach_post_meta_options');

function crb_attach_post_meta_options() {
    Container::make('post_meta', 'Client Information Box')
            ->where('post_type', '=', 'client_stories')
            ->add_fields(array(
                Field::make('text', 'get_client_des', __('Designation')),
                Field::make('image', 'get_client_logo', __('Company Logo')),
    ));

    Container::make('post_meta', 'Project Data')
            ->where('post_type', '=', 'project')
            ->add_fields(array(
                Field::make('media_gallery', 'mos_project_gallery', __('Project Gallery'))
                ->set_type(array('image'))
                ->set_duplicates_allowed(false),
                Field::make('image', 'mos_project_tool', __('Tool')),
                Field::make( 'text', 'mos_project_follow', __( 'Follow Link' ) ),
                Field::make( 'text', 'mos_project_like', __( 'Like Count' ) ),
                Field::make( 'text', 'mos_project_view', __( 'View Count' ) ),
    ));

    Container::make('post_meta', 'Audio Data')
            ->where('post_type', '=', 'post')
            ->add_fields(array(
                Field::make( 'select', 'mos_blog_details_audio_option', __( 'Audio Source' ) )
                ->set_options( array(
                    'none' => 'No Audio',
                    'tts' => 'Text to Speech',
                    'ga' => 'Given Audio',
                )),
                Field::make('file', 'mos_blog_details_audio', __('Audio File'))
                ->set_type(array( 'audio' ))
    ));

    Container::make('post_meta', 'Job Details')
            ->where('post_type', '=', 'job')
            ->add_fields(array(
                Field::make( 'text', 'mos_job_employment_basis', __( 'Employment Basis' ) ),
                Field::make( 'text', 'mos_job_vacancy', __( 'Vacancy' ) ),
                Field::make( 'text', 'mos_job_employment_status', __( 'Employment Status' ) ),
                Field::make( 'text', 'mos_job_experience', __( 'Experience' ) ),
                Field::make( 'text', 'mos_job_gender', __( 'Gender' ) ),
                Field::make( 'text', 'mos_job_age', __( 'Age' ) ),
                Field::make( 'text', 'mos_job_location', __( 'Job Location' ) ),
                Field::make( 'text', 'mos_job_salary', __( 'Salary' ) ),
                Field::make( 'date', 'mos_job_application_deadline', __( 'Application Deadline' ) )
                ->set_storage_format( 'Y-m-d' ),
                //->set_input_format( 'F Y', 'M Y' )
                Field::make( 'textarea', 'mos_job_short_description', __( 'Short Description' ) ),
    ));
}

add_action('carbon_fields_register_fields', 'crb_attach_user_meta_options');

function crb_attach_user_meta_options() {
    Container::make('user_meta', 'Address')
            ->add_fields(array(
                Field::make('image', 'mos_profile_image', __('Profile Image'))
                ->set_type(array('image'))
                ->set_value_type('url'),
                Field::make('text', 'mos_profile_designation', 'Designation'),
    ));
}