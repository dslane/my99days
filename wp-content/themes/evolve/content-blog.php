<?php $first = "";
       global $authordata;
       $xyz = ""; 
       $options = get_option('evolve'); 
 		   $evl_layout = evl_get_option('evl_layout','2cl'); 
	     $evl_post_layout = evl_get_option('evl_post_layout','two');  
 		   $evl_nav_links = evl_get_option('evl_nav_links','after'); 
 		   $evl_header_meta = evl_get_option('evl_header_meta','disable'); 
       $evl_excerpt_thumbnail = evl_get_option('evl_excerpt_thumbnail','0'); 
	     $evl_share_this = evl_get_option('evl_share_this','single'); 
 	     $evl_post_links = evl_get_option('evl_post_links','after'); 
 	     $evl_similar_posts = evl_get_option('evl_similar_posts','disable'); 
?>
	
  
  
  <!--BEGIN #primary .hfeed-->
			<div id="primary" class="hfeed">
      
      

 <!---------------------- 
 ---- 2 or 3 columns begin
 ----------------------->
 
  
<?php $options = get_option('evolve'); if ($evl_post_layout == "two" || $evl_post_layout == "three") { ?>       
	       <?php if (($evl_nav_links == "before") || ($evl_nav_links == "both")) { ?> 
          
          
        
				   <span class="nav-top">
				<?php get_template_part( 'navigation', 'index' ); ?>
        </span>
        
        <?php } else { ?> 
        
        <?php } ?>         
    
   
      
	     
      <?php
$temp = $wp_query;
$wp_query= null;
$wp_query = new WP_Query();
$wp_query->query('posts_per_page=6'.'&paged='.$paged);
while ($wp_query->have_posts()) : $wp_query->the_post(); $first++;
?>
      
      
 
      
      
                
        
                

				<!--BEGIN .hentry-->
				<div id="post-<?php the_ID(); ?>" class="<?php semantic_entries(); ?> 
        
       <?php $options = get_option('evolve'); if ($options['evl_post_layout'] == "two") { ?> 
        <?php echo 'odd'.($xyz++%2); ?>
        
        <?php } else { ?>
        <?php echo 'odd'.($xyz++%3); ?>
        
        
        <?php } ?>
        
        " style="margin-bottom:40px;">
        
        
        
          <?php  if (($evl_header_meta == "") || ($evl_header_meta == "single_archive")) 
        { ?>
        
					<h1 class="entry-title">
          
          
         
          <a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>">
<?php
if ( get_the_title() ){ $title = the_title('', '', false);
echo evltruncate($title, 40, '...'); }else{ _e( 'Untitled', 'evolve' );  }
 ?></a> 
          
          
          
          </h1>

					<!--BEGIN .entry-meta .entry-header-->
					<div class="entry-meta entry-header">
          <a href="<?php the_permalink() ?>"><span class="published"><?php the_time('MjS'); ?><br /><strong><?php the_time('Y'); ?></strong></span></a> 
          <span class="author vcard">
 
          <?php _e( 'Written by', 'evolve' ); ?> <strong><?php printf( '<a class="url fn" href="' . get_author_posts_url( $authordata->ID, $authordata->user_nicename ) . '" title="' . sprintf( 'View all posts by %s', $authordata->display_name ) . '">' . get_the_author() . '</a>' ) ?></strong></span>
						
						 <?php edit_post_link( __( 'edit', 'evolve' ), '<span class="edit-post">', '</span>' ); ?>

					<!--END .entry-meta .entry-header-->
                    </div>
                    
                  <?php } else { ?>
                    
                    <h1 class="entry-title fl-l"><a href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php
if ( get_the_title() ){ $title = the_title('', '', false);
echo evltruncate($title, 40, '...'); }else{ _e( 'Untitled', 'evolve' );  }
 ?></a></h1> 
</a> </h1>
                    
                     <?php if ( current_user_can( 'edit_post', $post->ID ) ): ?>
       
						 <?php edit_post_link( __( 'EDIT', 'evolve' ), '<span class="edit-post edit-attach">', '</span>' ); ?> 
            
            
				
                    <?php endif; ?>

                    <br /><br /><?php } ?> 

					<!--BEGIN .entry-content .article-->
					<div class="entry-content article">
          
            <?php  
           
          
if(has_post_thumbnail()) {
	echo '<span class="thumbnail-post"><a href="'; the_permalink(); echo '">';the_post_thumbnail(array(100,100)); echo '</a></span>';
  
     } else {

                      $image = evlget_first_image(); 
                        if ($image):
                      echo '<a href="'; the_permalink(); echo'"><img src="'.$image.'" alt="';the_title();echo'" /></a>';
                      
                      
                       endif;
               } ?>
               

          
          <?php $postexcerpt = get_the_content();
$postexcerpt = apply_filters('the_content', $postexcerpt);
$postexcerpt = str_replace(']]>', ']]&gt;', $postexcerpt);
$postexcerpt = strip_tags($postexcerpt);
$postexcerpt = strip_shortcodes($postexcerpt);

echo evltruncate($postexcerpt, 350, ' [...]');
 ?>
          
          
          <div class="entry-meta entry-footer">
          
          <span class="read-more">
           <a href="<?php the_permalink(); ?>"><?php _e('READ MORE &raquo;', 'evolve' ); ?></a>
           </span>
          
           <?php if ( comments_open() ) : ?>           
          <span class="comment-count"><?php comments_popup_link( __( 'Leave a Comment', 'evolve' ), __( '1 Comment', 'evolve' ), __( '% Comments', 'evolve' ) ); ?></span>
          <?php else : // comments are closed 
           endif; ?>
          </div>

					<!--END .entry-content .article-->
           <div class="clearfix"></div>
					</div>
          
          

				<!--END .hentry-->  
        
        
        

        
        

				</div>   
        
        <?php $i='';$i++; ?> 

				<?php endwhile; ?>
				<?php get_template_part( 'navigation', 'index' ); ?>

		<?php $wp_query = null; $wp_query = $temp;?>
           
      
<!---------------------- 
 -----------------------
 -----------------------  
 ---- 2 or 3 columns end
 -----------------------
 -----------------------
 ----------------------->  
 
 
 <!---------------------- 
 -----------------------
 -----------------------  
 ---- 1 column begin
 -----------------------
 -----------------------
 -----------------------> 
  
  
  <?php } else { ?>    
     
      <?php  if (($evl_nav_links == "before") || ($evl_nav_links == "both")) { ?> 
          
          
        
				   <span class="nav-top">
				<?php get_template_part( 'navigation', 'index' ); ?>
        </span>
        
        <?php } else {?> 
        
        <?php } ?> 
         

      
 <?php
$temp = $wp_query;
$wp_query= null;
$wp_query = new WP_Query();
$wp_query->query('posts_per_page=6'.'&paged='.$paged);
while ($wp_query->have_posts()) : $wp_query->the_post(); $first++;
?>
        
                

				<!--BEGIN .hentry-->
				<div id="post-<?php the_ID(); ?>" class="<?php semantic_entries(); ?> 
        
        
        <?php if ($options['evl_highlight_post'] == "1") { ?>
        
               <?php if ( 1 == $first ):?>" style="margin-bottom:40px;width:100%;">


    <div class="entry-meta highlight" style="text-transform:none;">
			<h1 class="entry-title" style="float:left;margin-bottom: 5px;">
          
          
         
          <a href="<?php the_permalink() ?>" style="font-size:200%!important;line-height:200%!important;" rel="bookmark" title="Permanent Link to <?php the_title(); ?>">
<?php
if ( get_the_title() ){ $title = the_title('', '', false);
echo evltruncate($title, 40, '...'); }else{ _e( 'Untitled', 'evolve' );  }
 ?></a> 
          
          
          
          </h1>

					<!--BEGIN .entry-meta .entry-header-->
					
                
            <?php if ( comments_open() ) : ?>           
          <span class="comment-count" style="float:right;font-weight:bold;position:relative;top:15px;font-size:15px;"><?php comments_popup_link( __( 'Leave a Comment', 'evolve' ), __( '1 Comment', 'evolve' ), __( '% Comments', 'evolve' ) ); ?></span>
          <?php else : // comments are closed 
           endif; ?>
           
           <?php if ( current_user_can( 'edit_post', $post->ID ) ): ?>
       
						<?php edit_post_link( __( 'EDIT', 'evolve' ), '<span class="edit-post" style="left:10px;position:relative;top:15px;">', '</span>' ); ?>
            
                        				    
				
                    <?php endif; ?>
             
					<!--END .entry-meta .entry-header-->
                    </div>
                    
         

					<!--BEGIN .entry-content .article-->
					<div class="entry-content article highlight-content" style="font-size: 15px">
          
            <?php the_content(); ?>
          
          
   			<!--END .entry-content .article-->
          <div style="clear:both;"></div>
					</div>
          
          

				<!--END .hentry--> 
         <?php else :?>" style="margin-bottom:40px;">


        
           <h1 class="entry-title" style="float:left;"><a href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php if ( get_the_title() ){ the_title();}else{ _e( 'Untitled', 'evolve' );  } ?></a></h1>
                    
                     <?php if ( current_user_can( 'edit_post', $post->ID ) ): ?>
       
						<?php edit_post_link( __( 'EDIT', 'evolve' ), '<span class="edit-post" style="left:10px;position:relative;top:15px;">', '</span>' ); ?>
            
				
                    <?php endif; ?>

                    <br /><br />

					<!--BEGIN .entry-content .article-->
					<div class="entry-content article">
          
          
         
           
            <?php if(has_post_thumbnail()) {
            $options = get_option('evolve');
$thumbsize = $options['evl_custom_thumbnail'];
	echo '<span class="thumbnail-post"><a href="'; the_permalink(); echo '">';the_post_thumbnail(array($thumbsize,$thumbsize)); echo '</a></span>';
  
     } else {

                      $image = evlget_first_image(); 
                        if ($image):
                      echo '<span class="thumbnail-post"><a href="'; the_permalink(); echo'"><img src="'.$image.'" alt="';the_title();echo'" /></a></span>';
                       endif;
               } ?>
               
               
               
               

               

          
          <?php the_excerpt();?>
 
          
           <span class="read-more">
           <a href="<?php the_permalink(); ?>"><?php _e('READ MORE &raquo;', 'evolve' ); ?></a>
           </span>
           
    					<!--END .entry-content .article--> 
          <div style="clear:both;"></div>                    
					</div>
          
          
          
					<!--BEGIN .entry-meta .entry-footer-->
         
                    <div class="entry-meta entry-footer">
                     <?php if ( evolve_get_terms( 'cats' ) ) { ?>
                    <span class="entry-categories"> <?php echo evolve_get_terms( 'cats' ); ?></span> 
 	                    <?php } ?><?php if ( evolve_get_terms( 'cats' ) && evolve_get_terms( 'tags' ) ) { ?><span class="meta-sep">&nbsp;&nbsp;</span><?php } ?> 
						<?php if ( evolve_get_terms( 'tags' ) ) { ?>
                        
                         <span class="entry-tags"> <?php echo evolve_get_terms( 'tags' ); ?></span> 
                        <?php } ?>
					<!--END .entry-meta .entry-footer-->
                    </div>
                   
				
          
          

	  <?php endif;?>
        
        
        <?php } else { ?>
        
        
					" style="margin-bottom:40px;">


          <?php $options = get_option('evolve'); if (($options['evl_header_meta'] == "") || ($options['evl_header_meta'] == "single_archive")) 
        { ?>
        
        <h1 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php if ( get_the_title() ){ the_title();}else{ _e( 'Untitled', 'evolve' );  } ?></a></h1>
        
					<!--BEGIN .entry-meta .entry-header-->
					<div class="entry-meta entry-header">
          <a href="<?php the_permalink() ?>"><span class="published"><?php the_time('Md'); ?><br /><strong><?php the_time('Y'); ?></strong></span></a>
          
           <?php if ( comments_open() ) : ?>           
          <span class="comment-count"><?php comments_popup_link( __( 'Leave a Comment', 'evolve' ), __( '1 Comment', 'evolve' ), __( '% Comments', 'evolve' ) ); ?></span>
          <?php else : // comments are closed 
           endif; ?>
          
          <span class="author vcard">
          
        <?php $evl_author_avatar = evl_get_option('evl_author_avatar','0'); 
       if ($evl_author_avatar == "1") { echo get_avatar( get_the_author_meta('email'), '30' ); 
          
          } ?>
          
          

          <?php _e( 'Written by', 'evolve' ); ?> <strong><?php printf( '<a class="url fn" href="' . get_author_posts_url( $authordata->ID, $authordata->user_nicename ) . '" title="' . sprintf( 'View all posts by %s', $authordata->display_name ) . '">' . get_the_author() . '</a>' ) ?></strong></span>
						
						
						
            <?php edit_post_link( __( 'edit', 'evolve' ), '<span class="edit-post">', '</span>' ); ?>
					<!--END .entry-meta .entry-header-->
                    </div>
                    
                    <?php } else { ?>
                    
                    <h1 class="entry-title" style="float:left;"><a href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php if ( get_the_title() ){ the_title();}else{ _e( 'Untitled', 'evolve' );  } ?></a></h1>
                    
                     <?php if ( current_user_can( 'edit_post', $post->ID ) ): ?>
       
						<?php edit_post_link( __( 'EDIT', 'evolve' ), '<span class="edit-post" style="right:10px;position:absolute;bottom:15px;">', '</span>' ); ?> 
            
				
                    <?php endif; ?>

                    <br /><br /><?php } ?>

					<!--BEGIN .entry-content .article-->
					<div class="entry-content article">
          
          
           <?php  if (($evl_excerpt_thumbnail == "1")) { ?>   
           
            <?php if(has_post_thumbnail()) {
            $options = get_option('evolve');
$thumbsize = $options['evl_custom_thumbnail'];
	echo '<span class="thumbnail-post"><a href="'; the_permalink(); echo '">';the_post_thumbnail(array($thumbsize,$thumbsize)); echo '</a></span>';
  
     } else {

                      $image = evlget_first_image(); 
                        if ($image):
                      echo '<span class="thumbnail-post"><a href="'; the_permalink(); echo'"><img src="'.$image.'" alt="';the_title();echo'" /></a></span>';
                       endif;
               } ?>
          
          <?php the_excerpt();?>
 
          
           <span class="read-more">
           <a href="<?php the_permalink(); ?>"><?php _e('READ MORE &raquo;', 'evolve' ); ?></a>
           </span>
           
          <?php } else { ?>
          
          
						<?php the_content( __('READ MORE &raquo;', 'evolve' ) ); ?>
            
            <?php wp_link_pages( array( 'before' => '<div id="page-links"><p>' . __( '<strong>Pages:</strong>', 'evolve' ), 'after' => '</p></div>' ) ); ?>
            
            <?php } ?>
						
					<!--END .entry-content .article--> 
          <div style="clear:both;"></div>                    
					</div>
          
          
          
					<!--BEGIN .entry-meta .entry-footer-->
         
                    <div class="entry-meta entry-footer">
                     <?php if ( evolve_get_terms( 'cats' ) ) { ?>
                    	<span class="entry-categories"><strong><?php _e('Posted in', 'evolve' ); ?></strong> <?php echo evolve_get_terms( 'cats' ); ?></span>
                      <?php } ?><?php if ( evolve_get_terms( 'cats' ) && evolve_get_terms( 'tags' ) ) { ?><span class="meta-sep">-</span><?php } ?>
						<?php if ( evolve_get_terms( 'tags' ) ) { ?>
                        
                        <span class="entry-tags"><strong><?php _e('Tagged', 'evolve' ); ?></strong> <?php echo evolve_get_terms( 'tags' ); ?></span>
                        <?php } ?>
					<!--END .entry-meta .entry-footer-->
                    </div>
                   
				<!--END .hentry-->   <?php } ?>
				</div>
        
        
       <?php  if (($evl_share_this == "single_archive") || ($evl_share_this == "all")) {   
        evolve_sharethis();  } else { ?> <div class="margin-40"></div> <?php }?> 
      <hr />
         
				<?php endwhile; ?>
        
        
        <?php  if (($evl_nav_links == "") || ($evl_nav_links == "after") || ($evl_nav_links == "both")) { ?> 
          
          
        
				<?php get_template_part( 'navigation', 'index' ); ?>
        
        <?php } else {?>
        
        <?php } ?>
        

<?php $wp_query = null; $wp_query = $temp;?>
      
      
      
      <?php } ?>
      
 <!---------------------- 
 -----------------------
 -----------------------  
 ---- 1 column end
 -----------------------
 -----------------------
 ----------------------->       
  
<!--END #primary .hfeed-->
			</div>