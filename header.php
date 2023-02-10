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
                <!-- <ul>
                    <li>
                        <a href="https://www.google.com/search?q=Crypto" rel="noreferrer" target="_blank">Cryptocurrency</a>
                        <ul>
                            <li><a href="#">Bitcoin</a></li>
                            <li><a href="#">Ethereum</a></li>
                        </ul>
                    </li>
                    <li>
                        <span>Devices</span>
                        <ul>
                            <li>
                                <a href="#">Mobile Phones</a>
                                <ul>
                                    <li><a href="#">Super Smart Phone</a></li>
                                    <li><a href="#">Thin Magic Mobile</a></li>
                                    <li><a href="#">Performance Crusher</a></li>
                                    <li><a href="#">Futuristic Experience</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="#">Televisions</a>
                                <div class="subnav-container">
                                    <ul>
                                        <li><a href="#">Flat Superscreen</a></li>
                                        <li><a href="#">Gigantic LED</a></li>
                                        <li><a href="#">Power Eater</a></li>
                                        <li><a href="#">3D Experience</a></li>
                                        <li><a href="#">Classic Comfort</a></li>
                                    </ul>
                                </div>
                            </li>
                            <li>
                                <a href="#">Cameras</a>
                                <ul>
                                    <li><a href="#">Smart Shot</a></li>
                                    <li><a href="#">Power Shooter</a></li>
                                    <li><a href="#">Easy Photo Maker</a></li>
                                    <li><a href="#">Super Pixel</a></li>
                                </ul>
                            </li>
                            <li data-nav-custom-content>
                                <div class="custom-message">
                                    You can add any custom content to your navigation items.
                                    This text is just an example.
                                </div>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#magazines">Magazines</a>
                        <ul>
                            <li><a href="#">National Geographic</a></li>
                            <li><a href="#">Scientific American</a></li>
                            <li><a href="#">The Spectator</a></li>
                            <li><a href="#">The Rambler</a></li>
                            <li><a href="#">Physics World</a></li>
                            <li><a href="#">Popular Science</a></li>
                            <li><a href="#">Popular Mechanics</a></li>
                            <li><a href="#">Sky & Telescope</a></li>
                            <li><a href="#">Discover</a></li>
                            <li><a href="#">New Scientist</a></li>
                            <li><a href="#">Psychology Today</a></li>
                            <li><a href="#">Man's Health</a></li>
                            <li><a href="#">Wired</a></li>
                            <li><a href="#">Vogue</a></li>
                            <li><a href="#">Elle</a></li>
                            <li><a href="#">Cosmopolitan</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#">Store</a>
                        <ul>
                            <li>
                                <a href="#">Clothes</a>
                                <ul>
                                    <li>
                                        <a href="#">Women's Clothing</a>
                                        <ul>
                                            <li><a href="#">Tops</a></li>
                                            <li><a href="#">Dresses</a></li>
                                            <li><a href="#">Trousers</a></li>
                                            <li><a href="#">Shoes</a></li>
                                            <li><a href="#">Sale</a></li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="#">Men's Clothing</a>
                                        <ul>
                                            <li><a href="#">Shirts</a></li>
                                            <li><a href="#">Trousers</a></li>
                                            <li><a href="#">Shoes</a></li>
                                            <li><a href="#">Sale</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li><a href="#">Jewelry</a></li>
                            <li><a href="#">Music</a></li>
                            <li>
                                <a href="#">Grocery</a>
                                <h3>Fruits</h3>
                                <ul>
                                    <li><a href="#">Citruses and southern fruits</a></li>
                                    <li><a href="#">Exotic fruits</a></li>
                                    <li><a href="#">Apples and pears</a></li>
                                    <li><a href="#">Nuts</a></li>
                                </ul>
                                <h3>Vegetables</h3>
                                <ul>
                                    <li><a href="#">Root vegetables</a></li>
                                    <li><a href="#">Exotic vegetables</a></li>
                                    <li><a href="#">Herbs</a></li>
                                    <li><a href="#">Salads</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                </ul> -->
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

