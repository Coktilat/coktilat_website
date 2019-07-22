<footer>
    <div class="container">
        <p>
            <?php if(is_rtl()){echo ps_option('copyright_ar');}
            else{echo ps_option('copyright');}?></p>
    </div>
</footer>

<div id="topcontrol" class="fa fa-angle-up" title="<?php _e( 'Scroll To Top' ); ?>"></div>

<div class="modal fade" id="HireModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <?php if(is_rtl()){echo ps_option('hire_form_title_ar');}
                else{echo ps_option('hire_form_title');}?>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-8">
                        <?php if(is_rtl()){echo do_shortcode(ps_option('hire_form_ar'));}
                        else{echo do_shortcode(ps_option('hire_form'));}?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="topcontrol" class="fa fa-angle-up" title="<?php _e( 'Scroll To Top' ); ?>"></div>

<div class="modal fade" id="joinModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <?php if(is_rtl()){echo ps_option('join_form_title_ar');}
                else{echo ps_option('join_form_title');}?>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12">
                        <?php if(is_rtl()){echo do_shortcode(ps_option('join_form_ar'));}
                        else{echo do_shortcode('[gravityform id="2" title="false" description="false" ajax="true"]');}?>
                         <img class="anim-img-2" src="<?php echo THEME_DIR?>/images/cok.png">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="clientModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <?php if(is_rtl()){echo ps_option('client_form_title_ar');}
                else{echo ps_option('client_form_title');}?>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12">
                        <?php if(is_rtl()){echo do_shortcode(ps_option('client_form_ar'));}
                        else{echo do_shortcode('[gravityform id="1" title="false" description="false" ajax="true"]');}?>
                        <img class="anim-img-2" src="<?php echo THEME_DIR?>/images/cok.png">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    <?php wp_footer(); ?>

    </body>
</html>