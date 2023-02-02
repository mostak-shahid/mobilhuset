<?php 
get_header();
$post_id = get_the_ID();
$author_id = get_post_field( 'post_author', $post_id );
$author_name = get_the_author_meta('display_name',$author_id);
$author_description = get_the_author_meta('description',$author_id);
$author_designation = carbon_get_user_meta( $author_id, 'mos_profile_designation' );
$author_image = carbon_get_user_meta( $author_id, 'mos_profile_image' );
$categories = get_the_category();

//$newsletter_button_url = carbon_get_theme_option( 'mos-single-post-newsletter-button-url' );

$audio_option = carbon_get_the_post_meta( 'mos_blog_details_audio_option' );
//var_dump($audio_option);
$audio = carbon_get_the_post_meta( 'mos_blog_details_audio' );
//var_dump($audio);

?>

<section class="blog-single-wrapper">
    <div class="container-lg">
        <div class="wrapper">
            <div class="row">
                <div class="col-lg-8">
                    <article id="<?php echo get_post_type() ?>-<?php echo $post_id ?>" <?php post_class( 'single-blog' ); ?> itemtype="https://schema.org/CreativeWork" itemscope="itemscope">
                        <div class="entry-header">                            
                            <?php if ( ! empty( $categories ) ) : ?>
                                <p class="blogSingleTag"><?php echo esc_html( $categories[0]->name ); ?></p>
                            <?php endif?>
                            <h1 class="blog-title" itemprop="headline"><?php echo get_the_title() ?></h1>
                            <div class="entry-meta">	
                                <?php if (comments_open() || '0' != get_comments_number()) : ?>
                                    <span class="comments-link">
                                    <?php if ( get_comments_number() ) : ?>
                                        <a href="<?php echo get_the_permalink() ?>#comments"><?php comments_number( 'No Comments', '1 Comments', '% Comments' );?></a>
                                    <?php else : ?>
                                        <a href="<?php echo get_the_permalink() ?>#respond">Leave a Comment</a>
                                    <?php endif ?>
                                    </span>
                                <?php endif;?>	
                                <?php if (! empty( $categories ) ) : ?>
                                    <span class="cat-links">
                                        <?php
                                        $separator = ', ';
                                        $output = '';
                                        foreach( $categories as $category ) {
                                            $output .= '<a href="' . esc_url( get_category_link( $category->term_id ) ) . '" title="' . esc_attr( sprintf( __( 'View all posts in %s', 'textdomain' ), $category->name ) ) . '">' . esc_html( $category->name ) . '</a>' . $separator;
                                        }
                                        echo trim( $output, $separator );                                    
                                        ?>
                                    </span>
                                <?php endif?>
                                <span class="posted-by" itemtype="https://schema.org/Person" itemscope="itemscope" itemprop="author">By 
                                    <a title="View all posts by <?php echo $author_name ?>" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author" class="url" itemprop="url">
                                        <span class="author-name" itemprop="name"><?php echo $author_name ?></span>
                                    </a>
                                </span>
                            </div>
                            <?php if (has_post_thumbnail()) : ?>
                            <div class="blog-image"><?php the_post_thumbnail('full', ['class' => 'lazy-load-image lazyload img-fluid img-blog-single', 'title' => get_the_title()]); ?></div>
                            <?php endif?>                            
                        </div>
                        <div class="blog-info">
                            <?php if ($audio_option == 'ga') : ?>
                                <div id="audio-player-blog" class="audio-player audio-player-template-2 audio-player-blog mb-40">
                                    <div class="controls">
                                        <source src="<?php echo wp_get_attachment_url($audio) ?>">
                                        <div class="part-one">
                                            <div class="left-part">
                                                <div class="play-container">
                                                    <div class="toggle-play play"></div>
                                                </div>
                                                <p>Click play to listen to the blog</p>
                                            </div>
                                            <div class="right-part">                    
                                                <div class="volume-container">
                                                    <div class="volume-button">
                                                        <div class="volume icono-volumeMedium"></div>
                                                    </div>
                                                    <div class="volume-slider">
                                                        <div class="volume-percentage"></div>
                                                    </div>
                                                </div>
                                                <select class="playback-rate">
                                                    <option value=".25">0.25x</option>
                                                    <option value=".5">0.50x</option>
                                                    <option value=".75">0.75x</option>
                                                    <option value="1" selected>1x</option>
                                                    <option value="1.25">1.25x</option>
                                                    <option value="1.5">1.5x</option>
                                                    <option value="1.75">1.75x</option>
                                                    <option value="2">2x</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="part-two time">
                                            <div class="current">0:00</div>
                                            <div class="timeline">
                                                <div class="progress"></div>
                                            </div>
                                            <div class="length">0:00</div>
                                        </div>
                                    </div>
                                </div>
                            <?php endif?>
                            <div class="blog-intro"><?php the_content()?></div>
                            <hr>
                            <div class="author-intro">
                                <?php if ($author_image) :?>
                                    <div class="left-part">
                                        <img class="lazy-load-image lazyload author-image mb-1" src="<?php echo $author_image ?>" alt="<?php echo $author_name ?>" width="120px" height="120px" loading="lazy">
                                    </div>
                                <?php endif; ?>
                                <div class="right-part">
                                    <div class="contributor-title">Author</div>
                                    <div class="d-sm-flex justify-content-start align-items-center mb-15">
                                        <div class="fs-24 authoredBy"><strong><?php echo $author_name; ?></strong></div>
                                        <?php if ($author_designation) : ?>
                                            <div class="authorDesignation">
                                                <div class="d-inline-block"><?php echo $author_designation; ?></div>
                                            </div>
                                        <?php endif?>
                                    </div>
                                    <?php if ($author_description) :  ?>
                                    <div class="fs-6 fw-normal textClrGray authorDesc">
                                        <?php echo $author_description; ?>
                                    </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </article>
                </div>
                <div class="col-lg-4">
                    <?php get_sidebar();?>
                    <div class="blogSingle-sidebar pb-5 position-sticky">
                        <div class="widget">
                            <?php get_search_form( true ); ?>
                        </div>
                        <div class="widget">
                            <span class="widget-title">Categories</span>
                            <div class="widget-content">
                                <?php $categories = mos_get_terms ('category');?>
                                <ul class="widget-category-list">
                                    <?php foreach($categories as $category) : ?>
                                        <?php if ($category['count']) :  ?>
                                        <li>
                                            <a class="" href="<?php echo home_url()?>/category/<?php echo $category['slug']?>/">
                                                <span class="title"><?php echo $category['name']?></span> 
                                                <span class="count">(<?php echo $category['count']?>)</span>
                                            </a>
                                        </li>
                                        <?php endif?>
                                    <?php endforeach?>
                                </ul>
                            </div>
                        </div>
                        <div class="widget">
                            <div class="socialLink d-flex align-items-center">
                                <div class="socialLinkTitle">Share</div>
                                <div class="socialLinkShare d-flex align-items-center">
                                    <?php echo do_shortcode("[addtoany]") ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>        
            <div class="comment-part">
                <?php if (comments_open() || '0' != get_comments_number()) : comments_template(); endif;?>
            </div>
        </div>
    </div>
</section> 
<?php if ($audio_option == 'ga') : ?>   
    <script>
        const audioPlayer = document.querySelector("#audio-player-blog");
        const audio = new Audio(audioPlayer.querySelector("source").src);
        //credit for song: Adrian kreativaweb@gmail.com

        console.dir(audio);

        audio.addEventListener(
            "loadeddata",
            () => {
                audioPlayer.querySelector(".time .length").textContent = getTimeCodeFromNum(
                    audio.duration
                );
                audio.volume = .75;
                audio.playbackRate = 1;
            },
            false
        );

        //click on timeline to skip around
        const timeline = audioPlayer.querySelector(".timeline");
        timeline.addEventListener("click", e => {
            const timelineWidth = window.getComputedStyle(timeline).width;
            const timeToSeek = e.offsetX / parseInt(timelineWidth) * audio.duration;
            audio.currentTime = timeToSeek;
        }, false);

        //click volume slider to change volume
        const volumeSlider = audioPlayer.querySelector(".controls .volume-slider");
        volumeSlider.addEventListener('click', e => {
            const sliderWidth = window.getComputedStyle(volumeSlider).width;
            const newVolume = e.offsetX / parseInt(sliderWidth);
            audio.volume = newVolume;
            audioPlayer.querySelector(".controls .volume-percentage").style.width = newVolume * 100 + '%';
        }, false)

        //check audio percentage and update time accordingly
        setInterval(() => {
            const progressBar = audioPlayer.querySelector(".progress");
            progressBar.style.width = audio.currentTime / audio.duration * 100 + "%";
            audioPlayer.querySelector(".time .current").textContent = getTimeCodeFromNum(
                audio.currentTime
            );
        }, 500);

        //toggle between playing and pausing on button click
        const playBtn = audioPlayer.querySelector(".controls .toggle-play");
        playBtn.addEventListener(
            "click",
            () => {
                if (audio.paused) {
                    playBtn.classList.remove("play");
                    playBtn.classList.add("pause");
                    audio.play();
                } else {
                    playBtn.classList.remove("pause");
                    playBtn.classList.add("play");
                    audio.pause();
                }
            },
            false
        );

        audioPlayer.querySelector(".volume-button").addEventListener("click", () => {
            const volumeEl = audioPlayer.querySelector(".volume-container .volume");
            audio.muted = !audio.muted;
            if (audio.muted) {
                volumeEl.classList.remove("icono-volumeMedium");
                volumeEl.classList.add("icono-volumeMute");
            } else {
                volumeEl.classList.add("icono-volumeMedium");
                volumeEl.classList.remove("icono-volumeMute");
            }
        });

        audioPlayer.querySelector(".playback-rate").addEventListener("change", e => {
            //console.log(e.target.value);
            audio.playbackRate = e.target.value;
        });

        //turn 128 seconds into 2:08
        function getTimeCodeFromNum(num) {
            let seconds = parseInt(num);
            let minutes = parseInt(seconds / 60);
            seconds -= minutes * 60;
            const hours = parseInt(minutes / 60);
            minutes -= hours * 60;

            if (hours === 0) return `${minutes}:${String(seconds % 60).padStart(2, 0)}`;
            return `${String(hours).padStart(2, 0)}:${minutes}:${String(seconds % 60).padStart(2, 0)}`;
        }

    </script>
<?php endif?> 
<?php get_footer() ?>
