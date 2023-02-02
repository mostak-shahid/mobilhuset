
					<div id="error" class="text-center">
    					<div class="content-wrap">
					<?php if(is_home()) : ?>
						<img class="img-fluid img-centered img-content-none" src="<?php echo get_template_directory_uri() ?>/images/comingsoon.png" alt="Coming Soon">
					<?php else : ?>
						<h2>OOOPPS.! THE CONTENT YOU WERE LOOKING FOR, COULDN'T BE FOUND.</h2>				    
					<?php endif; ?>
					<?php if(!is_front_page()):?>
					    <div class="btn-wrapper">
                            <a class="btn position-relative border-0 rounded-pill d-flex align-items-center justify-content-center gap-2" href="<?php esc_url(bloginfo('home'))?>">
                                <span>GO BACK TO THE HOMEPAGE</span>
                                <span class="btn-arrow"></span>
                            </a>
                        </div>
					<?php endif;?>
						</div>
					</div>
