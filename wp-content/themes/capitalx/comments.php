<?php
/**
* @package WordPress
* @subpackage capitalx
*/
// Do not delete these lines
?>
<!-- You can start editing here. -->
<section id="c-comment" class="c-comment">
    <div class="container">
      <div class="row">
          <?php 
		  $comments_number = get_comments_number($post->ID);
		  if ( have_comments() ) : ?>
             <h1><?php esc_html_e('COMMENTS','capitalx'); echo  '('.$comments_number.')';?>
            </h1>
          <?php endif;?>
        <div class="c-comment_section">
          <div class="row">
			<?php if ( have_comments() ) : ?>
            <div id="a-comment" class="col-lg-8 col-md-8 col-sm-8 col-xs-12 c-comment_listing">
            <header class="c-section_subheader">
         
            <span class="c-section_subheader_border"></span>
            </header>
           
            <?php wp_list_comments( array('walker' => new capitalx_walker_comment,'avatar_size' => 136,) );?>
            <div class="comments-navigation">

                                            <div class="alignleft"><?php previous_comments_link(); ?></div>
                                            <div class="alignright"><?php next_comments_link(); ?></div>

                                     </div>
            
            </div>
            
            
            <?php endif; ?>
            <?php if ( comments_open() ) : ?>
            <?php 
				if ($comments_number ==  0) {?>
          
             <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 c-ask_question c-comment_post"> 
				<?php }else {?>
                   <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 c-ask_question c-comment_post">
                <?php }?>
            <div id="respond" >
            <div id="cancel-comment-reply">
            <small><?php cancel_comment_reply_link() ?></small>
            </div>
            <?php if ( get_option('comment_registration') && !is_user_logged_in() ) : ?>
<p><?php printf(esc_html__('You must be <a href="%s">logged in</a> to post a comment.', 'capitalx'), wp_login_url( get_permalink() )); ?></p>
            <?php else : ?>
            <?php
            $comment_capitalx   = array(
           'id_submit'         => 'c-submit',
           'title_reply'       => esc_html__( 'ask us to Comment' ,'capitalx'),
           'label_submit'      => esc_html__( 'Send','capitalx' ),
            'comment_notes_before' =>'',
           'fields' => apply_filters( 'comment_form_default_fields', array(
		  'author' =>
	'<input id="author" name="author" type="text" placeholder="' .esc_html__('Name*','capitalx').'" value="' . esc_attr( $commenter['comment_author'] ) .
			'" size="30"'. ( $req ? 'aria-required="true"' : '' ) .' />',
		
		  'email' =>
			'<input id="email" name="email" placeholder="' .esc_html__('Email*','capitalx').'"   type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) .
			'" size="30"'. ( $req ? 'aria-required="true"' : '' ) .' />',

		)),

  'comment_field' =>  '<textarea id="comment" name="comment"  placeholder="' .esc_html__('Message','capitalx').'" cols="45" rows="8" aria-required="true">' .
    '</textarea>',
);

            comment_form($comment_capitalx);?>
            <?php endif; // If registration required and not logged in ?>
            </div>
            <?php endif; // if you delete this the sky will fall on your head ?>
            </div>
          </div>
        <div class="clearfix"></div>
        
        </div>
      </div>
    </div>
    <div class="clearfix"></div>
  </section>