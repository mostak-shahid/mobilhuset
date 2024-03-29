<footer class="footer">
    <?php 
    $footer_layout = carbon_get_theme_option( 'mos-footer-layout' );
    if(!carbon_get_post_meta( get_the_ID(), 'mos_page_hide_footer' ) && $footer_layout) : 
    ?>
    <?php 
        $my_postid = $footer_layout[0]['id'];//This is page id or post id
        $content_post = get_post($my_postid);
        $content = $content_post->post_content;
        $content = apply_filters('the_content', $content);
        $content = str_replace(']]>', ']]&gt;', $content);
        echo $content;            
    ?>
    <?php endif?>
</footer>

<?php 
$btt_enable = carbon_get_theme_option('mos-back-to-top');
$btt_image = carbon_get_theme_option('mos-back-to-top-image');
$btt_background = carbon_get_theme_option('mos-back-to-top-background');
$btt_class = carbon_get_theme_option('mos-back-to-top-class');
if($btt_enable) :
?>    
<div id="btt-btn" class="scrollup <?php echo $btt_class ?>" onclick="backToTop()">
    <?php if ($btt_image): ?>
    <?php echo wp_get_attachment_image( $btt_image, 'full' );  ?>
    <?php else : ?>
    <i class="fa fa-angle-up"></i>
    <?php endif?>
</div>
<?php endif?>
<?php wp_footer();?>
<!--Theme Options CSS-->
<style>
    body {
        background-color: <?php echo carbon_get_theme_option('mos_body_bg') ? 'var(--mos-body-bg)' : 'var(--bs-body-bg)' ?>;
        color: <?php echo carbon_get_theme_option('mos_content_color') ? 'var(--mos-content-color)' : 'var(--bs-body-color)' ?>;
    }
    a {color: <?php echo carbon_get_theme_option('mos_link_color') ? carbon_get_theme_option('mos_link_color') : 'var(--bs-link-color)' ?>;}
    a:hover {color: <?php echo carbon_get_theme_option('mos_link_hover_color') ? carbon_get_theme_option('mos_link_hover_color') : 'var(--bs-link-hover-color)' ?>;}
    <?php $header_background=carbon_get_theme_option('mos-header-background');

    ?>.main-header {
        <?php if(carbon_get_theme_option('mos-header-content-color')): ?> color: <?php echo carbon_get_theme_option('mos-header-content-color') ?>; <?php endif?> <?php if(carbon_get_theme_option('mos-header-padding')): ?> padding: <?php echo carbon_get_theme_option('mos-header-padding') ?>; <?php endif?> <?php if(carbon_get_theme_option('mos-header-margin')): ?> margin: <?php echo carbon_get_theme_option('mos-header-margin') ?>; <?php endif?> <?php if(carbon_get_theme_option('mos-header-border')): ?> border: <?php echo carbon_get_theme_option('mos-header-border') ?>; <?php endif?> <?php if(@$header_background && sizeof($header_background)): ?> <?php foreach($header_background as $value): ?> <?php //var_dump($value) ?>
            <?php foreach($value as $key=> $val): ?> <?php if ($key !='background-image'&& $key !='_type'): ?> <?php echo $val? $key . ':'. $val . ';':''?> <?php elseif ($key=='background-image'): ?> <?php echo $val ? $key . ':url('. wp_get_attachment_url($val) . ');':''?> <?php endif?> <?php endforeach?> <?php endforeach?> <?php endif?>
    }

    <?php if(carbon_get_theme_option('mos-header-link-color')) : ?>.main-header a {
        color: <?php echo carbon_get_theme_option('mos-header-link-color') ?>
    }

    <?php endif?><?php if(carbon_get_theme_option('mos-header-link-color-hover')) : ?>.main-header a:hover {
        color: <?php echo carbon_get_theme_option('mos-header-link-color-hover') ?>
    }

    <?php endif?><?php $footer_background=carbon_get_theme_option('mos-footer-background');
    $breadcumb_background=carbon_get_theme_option('mos-breadcumb-background');

    ?>section.page-title {        
        <?php if(carbon_get_theme_option('mos-breadcumb-padding')): ?> padding: <?php echo carbon_get_theme_option('mos-breadcumb-padding') ?>; <?php endif?> <?php if(carbon_get_theme_option('mos-breadcumb-margin')): ?> margin: <?php echo carbon_get_theme_option('mos-breadcumb-margin') ?>; <?php endif?> <?php if(carbon_get_theme_option('mos-breadcumb-border')): ?> border: <?php echo carbon_get_theme_option('mos-breadcumb-border') ?>; <?php endif?> <?php if(carbon_get_theme_option('mos-breadcumb-height')): ?> height: <?php echo carbon_get_theme_option('mos-breadcumb-height') ?>; <?php endif?>
        <?php if(carbon_get_theme_option('mos-breadcumb-content-color')): ?> color: <?php echo carbon_get_theme_option('mos-breadcumb-content-color') ?>; <?php endif?><?php if(@$breadcumb_background && sizeof($breadcumb_background)): ?> <?php foreach($breadcumb_background as $value): ?> <?php //var_dump($value) ?>
            <?php foreach($value as $key=> $val): ?> <?php if ($key !='background-image'&& $key !='_type'): ?> <?php echo $val? $key . ':'. $val . ';':''?> <?php elseif ($key=='background-image'): ?> <?php echo $val ? $key . ':url('. wp_get_attachment_url($val) . ');':''?> <?php endif?> <?php endforeach?> <?php endforeach?> <?php endif?>
    }
    <?php if(carbon_get_theme_option('mos-breadcumb-content-color')): ?>
    section.page-title .breadcrumb-item.active,
    .woocommerce .woocommerce-breadcrumb,
    .breadcrumb-item+.breadcrumb-item::before {
         color: <?php echo carbon_get_theme_option('mos-breadcumb-content-color') ?>; 
    }
    <?php endif?>
    <?php if(carbon_get_theme_option('mos-breadcumb-link-color')): ?>
    section.page-title .woocommerce-breadcrumb a,
    section.page-title .breadcrumb-item a {
        color: <?php echo carbon_get_theme_option('mos-breadcumb-link-color') ?>
    }
    <?php endif?>
    <?php if(carbon_get_theme_option('mos-breadcumb-link-color-hover')) : ?>section.page-title .woocommerce-breadcrumb a:hover,
    section.page-title .breadcrumb-item a:hover {
        color: <?php echo carbon_get_theme_option('mos-breadcumb-link-color-hover') ?>
    }

    <?php endif?><?php $footer_background=carbon_get_theme_option('mos-footer-background');

    ?>.footer {
        <?php if(carbon_get_theme_option('mos-footer-content-color')): ?> color: <?php echo carbon_get_theme_option('mos-footer-content-color') ?>; <?php endif?> <?php if(carbon_get_theme_option('mos-footer-padding')): ?> padding: <?php echo carbon_get_theme_option('mos-footer-padding') ?>; <?php endif?> <?php if(carbon_get_theme_option('mos-footer-margin')): ?> margin: <?php echo carbon_get_theme_option('mos-footer-margin') ?>; <?php endif?> <?php if(carbon_get_theme_option('mos-footer-border')): ?> border: <?php echo carbon_get_theme_option('mos-footer-border') ?>; <?php endif?> <?php if(@$footer_background && sizeof($footer_background)): ?> <?php foreach($footer_background as $value): ?> <?php //var_dump($value) ?>
            <?php foreach($value as $key=> $val): ?> <?php if ($key !='background-image'&& $key !='_type'): ?> <?php echo $val? $key . ':'. $val . ';':''?> <?php elseif ($key=='background-image'): ?> <?php echo $val ? $key . ':url('. wp_get_attachment_url($val) . ');':''?> <?php endif?> <?php endforeach?> <?php endforeach?> <?php endif?>
    }

    <?php if(carbon_get_theme_option('mos-footer-link-color')) : ?>.footer a {
        color: <?php echo carbon_get_theme_option('mos-footer-link-color') ?>
    }

    <?php endif?><?php if(carbon_get_theme_option('mos-footer-link-color-hover')) : ?>.footer a:hover {
        color: <?php echo carbon_get_theme_option('mos-footer-link-color-hover') ?>
    }

    <?php endif?>  
    <?php if(carbon_get_theme_option('mos-header-sticky-menu-icon')): ?>
        .scroll-header .hc-nav-trigger{
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center center;
            background-image:url(<?php echo wp_get_attachment_url(carbon_get_theme_option('mos-header-sticky-menu-icon')) ?>);
        }
        .scroll-header .hc-nav-trigger span{display: none}
    <?php endif?>   
    <?php if(carbon_get_theme_option('mos-header-mobile-menu-icon')): ?>
        .mobile-header .hc-nav-trigger{            
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center center;
            background-image:url(<?php echo wp_get_attachment_url(carbon_get_theme_option('mos-header-mobile-menu-icon')) ?>);
        }
        .mobile-header .hc-nav-trigger span{display: none}
    <?php endif?>   
</style>
    <?php if (carbon_get_theme_option( 'mos_plugin_wow' ) == 'on') : ?>
    <script>new WOW().init();</script>
    <?php endif?>
    <?php if (carbon_get_theme_option( 'mos_plugin_owlcarousel' ) == 'on') : ?>
    <script>
        jQuery(document).ready(function($) {
            $('body').find('.mos-owl-carousel').each(function( e ) {            
                var oc = $(this);
                var ocOptions = oc.data('carousel-options');
                var defaults = {
                    loop: true,
                    nav: false,
                    autoplay: true,
                }
                oc.owlCarousel($.extend(defaults, ocOptions));
            });
        });
    </script>
    <?php endif?>
    <?php if (carbon_get_theme_option( 'mos_plugin_slick' ) == 'on') : ?>
    <script>
        jQuery(document).ready(function($) {
            $('.mos-slick').slick();
        });
    </script>
    <?php endif?>

    <script>
        jQuery(document).ready(function($) {
            if($('.woocommerce .term-description').height() > 72) {
                $('.woocommerce .term-description').addClass('collapsed');
                $('.woocommerce .term-description').after('<span class="term-description-readmore text-theme"><span class="read-more"><?php echo __('Show more')?></span><span class="read-less"><?php echo __('Show less')?></span></span>');
            }
            $('body').on('click', '.term-description-readmore', function (){
                $('.woocommerce .term-description').toggleClass('collapsed');
                $(this).toggleClass('active');
            });
        });
    </script>
</body>

</html>
