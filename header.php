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

<body <?php body_class(); ?> <?php if (carbon_get_theme_option( 'mos-page-loader' ) == 'on') : ?> onload='document.getElementById("page-loader").classList.add("d-none")' <?php endif?>>

    <?php if (carbon_get_theme_option( 'mos-page-loader' ) == 'on') : ?>
    <div id="page-loader" class="se-pre-con position-fixed top-0 start-0 bottom-0 end-0 d-flex justify-content-center align-items-center <?php echo carbon_get_theme_option( 'mos-page-loader-class' )?>" <?php if (carbon_get_theme_option( 'mos-page-loader-background' )) echo 'style="background-color:'.carbon_get_theme_option( 'mos-page-loader-background' ).'"' ?>>
        <?php if(carbon_get_theme_option( 'mos-page-loader-image' )): ?>
        <?php echo wp_get_attachment_image( carbon_get_theme_option( 'mos-page-loader-image' ), 'full', "", array( "class" => "loading-image" ) );  ?>
        <div class="rotating-border"></div>
        <?php else: ?>
        <i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>
        <?php endif?>
    </div>
    <?php endif; ?>
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
                <ul class="bottom-nav">
              <li class="myaccount">
                <a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>">
                  <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" width="512" height="512" x="0" y="0" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512" xml:space="preserve" class=""><g><path d="M437.02 330.98c-27.883-27.882-61.071-48.523-97.281-61.018C378.521 243.251 404 198.548 404 148 404 66.393 337.607 0 256 0S108 66.393 108 148c0 50.548 25.479 95.251 64.262 121.962-36.21 12.495-69.398 33.136-97.281 61.018C26.629 379.333 0 443.62 0 512h40c0-119.103 96.897-216 216-216s216 96.897 216 216h40c0-68.38-26.629-132.667-74.98-181.02zM256 256c-59.551 0-108-48.448-108-108S196.449 40 256 40s108 48.448 108 108-48.449 108-108 108z" fill="#000000" data-original="#000000" class=""></path></g></svg>
                </a>
              </li>
              <li class="cart">
                <a href="<?php echo wc_get_cart_url() ?>">
                  <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" width="24" height="24" x="0" y="0" viewBox="0 0 682.667 682.667" style="enable-background:new 0 0 512 512" xml:space="preserve" class="">
                    <g>
                        <defs>
                            <clipPath id="b" clipPathUnits="userSpaceOnUse">
                                <path d="M0 512h512V0H0Z" fill="#000000" data-original="#000000"></path>
                            </clipPath>
                        </defs>
                        <g clip-path="url(#b)" transform="matrix(1.33333 0 0 -1.33333 0 682.667)">
                            <path d="M0 0h391l-60-210H60" style="stroke-width:30;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1" transform="translate(106 406)" fill="none" stroke="#000000" stroke-width="30" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-dasharray="none" stroke-opacity="" data-original="#000000"></path>
                            <path d="M0 0c0-16.568-13.432-30-30-30-16.568 0-30 13.432-30 30 0 16.568 13.432 30 30 30C-13.432 30 0 16.568 0 0Z" style="stroke-width:30;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1" transform="translate(256 76)" fill="none" stroke="#000000" stroke-width="30" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-dasharray="none" stroke-opacity="" data-original="#000000"></path>
                            <path d="M0 0c0-16.568-13.432-30-30-30-16.568 0-30 13.432-30 30 0 16.568 13.432 30 30 30C-13.432 30 0 16.568 0 0Z" style="stroke-width:30;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1" transform="translate(407 76)" fill="none" stroke="#000000" stroke-width="30" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-dasharray="none" stroke-opacity="" data-original="#000000"></path>
                            <path d="M0 0h-252.459c-22.301 0-36.806 23.469-26.833 43.417L-271 60" style="stroke-width:30;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1" transform="translate(437 136)" fill="none" stroke="#000000" stroke-width="30" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-dasharray="none" stroke-opacity="" data-original="#000000"></path>
                            <path d="M0 0h73.861C99.402-89.409 151-270 151-270" style="stroke-width:30;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1" transform="translate(15 466)" fill="none" stroke="#000000" stroke-width="30" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-dasharray="none" stroke-opacity="" data-original="#000000"></path>
                        </g>
                    </g>
                </svg>
                </a>
              </li>
              <li class="ko-fi">
                <a href="<?php echo (carbon_get_theme_option( 'mos-contact-page' )?carbon_get_theme_option( 'mos-contact-page' ):'#') ?>">
                  <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" width="512" height="512" x="0" y="0" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512" xml:space="preserve" class=""><g><path d="M469.333 64H42.667C19.135 64 0 83.135 0 106.667v298.667C0 428.865 19.135 448 42.667 448h426.667C492.865 448 512 428.865 512 405.333V106.667C512 83.135 492.865 64 469.333 64zM42.667 85.333h426.667c1.572 0 2.957.573 4.432.897-36.939 33.807-159.423 145.859-202.286 184.478-3.354 3.021-8.76 6.625-15.479 6.625s-12.125-3.604-15.49-6.635C197.652 232.085 75.161 120.027 38.228 86.232c1.478-.324 2.866-.899 4.439-.899zm-21.334 320V106.667c0-2.09.63-3.986 1.194-5.896 28.272 25.876 113.736 104.06 169.152 154.453C136.443 302.671 50.957 383.719 22.46 410.893c-.503-1.814-1.127-3.588-1.127-5.56zm448 21.334H42.667c-1.704 0-3.219-.594-4.81-.974 29.447-28.072 115.477-109.586 169.742-156.009a7980.773 7980.773 0 0 0 18.63 16.858c8.792 7.938 19.083 12.125 29.771 12.125s20.979-4.188 29.76-12.115a8178.815 8178.815 0 0 0 18.641-16.868c54.268 46.418 140.286 127.926 169.742 156.009-1.591.38-3.104.974-4.81.974zm21.334-21.334c0 1.971-.624 3.746-1.126 5.56-28.508-27.188-113.984-108.227-169.219-155.668 55.418-50.393 140.869-128.57 169.151-154.456.564 1.91 1.194 3.807 1.194 5.897v298.667z" fill="#000000" data-original="#000000" class=""></path></g></svg>
                </a>
              </li>
            </ul>
            </nav>
        </div>
    </div>
    <header id="header" class="main-header smooth <?php echo carbon_get_theme_option( 'mos-header-class' ) ?>">
        <div class="wrapper">
            <?php 
            $header_layout = carbon_get_theme_option( 'mos-header-layout' );
            if(!carbon_get_post_meta( get_the_ID(), 'mos_page_hide_header' ) && $header_layout) : 
            ?>
            <?php 
                $my_postid = $header_layout[0]['id'];//This is page id or post id
                $content_post = get_post($my_postid);
                $content = $content_post->post_content;
                $content = apply_filters('the_content', $content);
                $content = str_replace(']]>', ']]&gt;', $content);
                echo $content;            
            ?>
            <?php endif?>
        </div>
    </header>

