<?php 
if (is_home()) $page_id = get_option( 'page_for_posts' );
elseif (is_front_page()) $page_id = get_option('page_on_front');
else $page_id = get_the_ID();
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang="en-US"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang="en-US"> <![endif]-->
<!--[if gt IE 8]><!-->
<!--<![endif]-->
<!--[if gte IE 9] <style type="text/css"> .gradient {filter: none;}</style><![endif]-->
<!--[if !IE]><html lang="en"><![endif]-->
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--[if lt IE 9]>
    <script src="<?php echo get_template_directory_uri(); ?>/js/html5shiv.js"></script>
    <script src="<?php echo get_template_directory_uri(); ?>/js/respond.min.js"></script>
    <![endif]-->    
    <style>
    :root {
        --mos-body-bg: <?php echo carbon_get_theme_option( 'mos_body_bg' )?carbon_get_theme_option( 'mos_body_bg' ):'#fff'?>;       
        --mos-primary-color: <?php echo carbon_get_theme_option( 'mos_primary_color' )?carbon_get_theme_option( 'mos_primary_color' ):'#00f5eb'?>;            
        --mos-secondary-color: <?php echo carbon_get_theme_option( 'mos_secondary_color' )?carbon_get_theme_option( 'mos_secondary_color' ):'#21fff6'?>;            
        --mos-content-color: <?php echo carbon_get_theme_option( 'mos_content_color' )?carbon_get_theme_option( 'mos_content_color' ):'#212529'?>;       
    }    
    </style>
    <?php wp_head(); ?>
    <script>
        function hideLoader() {
            console.log(0);
            //document.querySelector(".se-pre-con").style.display = "none";
            document.getElementById("page-loader").classList.add("d-none");
        }
    </script>
</head>

<body <?php body_class(); ?> <?php if (carbon_get_theme_option( 'mos-page-loader' ) == 'on') : ?> onload='document.getElementById("page-loader").classList.add("d-none")' <?php endif?>>    <?php if (carbon_get_theme_option( 'mos-page-loader' ) == 'on') : ?>
    <div id="page-loader" class="se-pre-con position-fixed top-0 start-0 bottom-0 end-0 d-flex justify-content-center align-items-center <?php echo carbon_get_theme_option( 'mos-page-loader-class' )?>" <?php if (carbon_get_theme_option( 'mos-page-loader-background' )) echo 'style="background-color:'.carbon_get_theme_option( 'mos-page-loader-background' ).'"' ?>>
        <?php if(carbon_get_theme_option( 'mos-page-loader-image' )): ?>
        <?php echo wp_get_attachment_image( carbon_get_theme_option( 'mos-page-loader-image' ), 'full', "", array( "class" => "loading-image" ) );  ?>
        <div class="rotating-border"></div>
        <?php else: ?>
        <i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>
        <?php endif?>
    </div>
    <?php endif; ?>
    <?php if (carbon_get_theme_option( 'mos-header-mobile-enable' ) == 'on' || carbon_get_theme_option( 'mos-header-sticky-enable' ) == 'on') : ?>
    <div>
        <div class="wrapper cf">
            <nav id="main-nav">
                <?php
                    wp_nav_menu(array(
                        'theme_location' => 'mobilemenu',
                        'container' => 'ul',
                        'container_class' => '',
                        'menu_class' => 'mos-menu-list', 
                        'add_a_class'=> 'menu-item-link',                          
                    ));        
                ?>
            </nav>
        </div>
    </div>
    <?php endif; ?>
    <header id="header" class="main-header smooth <?php echo carbon_get_theme_option( 'mos-header-class' ) ?>">
        <div class="wrapper">
            
            <?php 
                $option_header_layout = carbon_get_theme_option( 'mos-header-layout' );
                $mos_page_header_type = carbon_get_post_meta( get_the_ID(), 'mos_page_header_type' );
                $mos_page_header_layout = carbon_get_post_meta( get_the_ID(), 'mos_page_header_layout' );
                $header_layout = ($mos_page_header_type == 'custom')?$mos_page_header_layout:$option_header_layout;

                if($mos_page_header_type != 'none' && @$header_layout) : 
                ?>
                <?php 
                    $layout_id = $header_layout[0]['id'];//This is page id or post id
                    $content_post = get_post($layout_id);
                    $content = $content_post->post_content;
                    $content = apply_filters('the_content', $content);
                    $content = str_replace(']]>', ']]&gt;', $content);
                    echo $content;            
                ?>
            <?php endif?>
            <?php if (carbon_get_theme_option( 'mos-header-mobile-enable' ) == 'on') : ?>
                <?php 
                    $mobile_layout = carbon_get_theme_option( 'mos-header-mobile-layout' );
                    $mobile_custom_layout = carbon_get_theme_option( 'mos-header-mobile-custom-layout' );
                    $mobile_icons = carbon_get_theme_option( 'mos-header-mobile-icons' );
                    $search = carbon_get_theme_option( 'mos-header-mobile-search' );
                ?>
                <div class="d-lg-none mobile-header">
                    <div class="wp-block-nk-awb nk-awb alignfull p-0"> 
                        <?php if ($search=='top') : ?> 
                            <div class="pb-3"><?php echo do_shortcode("[woo-searchform]")?></div>
                        <?php endif?>
                        <?php if ($mobile_layout== 'header-0' && $mobile_custom_layout) :
                            $layout_id = $mobile_custom_layout[0]['id'];//This is page id or post id
                            $content_post = get_post($layout_id);
                            $content = $content_post->post_content;
                            $content = apply_filters('the_content', $content);
                            $content = str_replace(']]>', ']]&gt;', $content);
                            echo $content;  
                        ?>
                        <?php else : ?>
                        <?php mos_header_builder($mobile_layout, $mobile_icons)?>
                        <?php endif?>
                        <?php if ($search=='bottom') : ?> 
                            <div class="pt-3"><?php echo do_shortcode("[woo-searchform]")?></div>
                        <?php endif?>
                    </div>
                </div>
            <?php endif?>
            <?php if (carbon_get_theme_option( 'mos-header-sticky-enable' ) == 'on') : ?>
                <?php 
                    $sticky_layout = carbon_get_theme_option( 'mos-header-sticky-layout' );
                    $sticky_custom_layout = carbon_get_theme_option( 'mos-header-sticky-custom-layout' );
                    $sticky_icons = carbon_get_theme_option( 'mos-header-sticky-icons' );
                ?>
                <div class="scroll-header smooth">
                    <?php if ($sticky_layout== 'header-0' && $sticky_custom_layout) :
                        $layout_id = $sticky_custom_layout[0]['id'];//This is page id or post id
                        $content_post = get_post($layout_id);
                        $content = $content_post->post_content;
                        $content = apply_filters('the_content', $content);
                        $content = str_replace(']]>', ']]&gt;', $content);
                        echo $content;  
                    ?>
                    <?php else : ?>
                    <div class="wp-block-nk-awb nk-awb alignfull p-0">                        
                        <?php mos_header_builder($sticky_layout, $sticky_icons)?>
                    </div>
                    <?php endif ?>
                </div>
            <?php endif?>
        </div>
    </header>

