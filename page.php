<?php get_header() ?>
<?php if (!is_front_page()) :?>
    <section class="page-title py-5 bg-theme text-white">
        <div class="wrapper">
            <div class="container">
                <h1><?php echo get_the_title() ?></h1>
                <?php echo mos_breadcrumbs() ?>
            </div>
        </div>
    </section>
<?php endif?>
<?php the_content() ?>
<?php get_footer() ?>