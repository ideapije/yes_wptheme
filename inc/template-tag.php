<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package jvm
 * @since jvm 1.0
 */
if(!function_exists('jvm_posted_on')):
function jvm_posted_on(){
	printf(__('Posted on <a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s" pubdate>%4$s</time></a><span class="byline">by<span class="author vcard"><a class="url fn n" href="%5$s" title="%6$s" rel="author">%7$s</a></span>','jvm'),	
	esc_url(get_permalink()),
	esc_attr(get_the_time()),
	esc_attr(get_the_date('c')),
	esc_html(get_the_date()),
	esc_url(get_author_posts_url(get_the_author_meta('ID'))),
	esc_attr(sprintf(__('View all posts by %s','jvm'),get_the_author())),
	esc_html(get_the_author())	
	);
}
endif;
/**
 * Returns true if a blog has more than 1 category
 *
 * @since jvm 1.0
 */
function jvm_categorized_blog()
{
	if(false==($all_the_cool_cats=get_transient('all_the_cool_cats'))) {
		//create an array of all the categories that are attached to posts
		$all_the_cool_cats=get_categories(
			array(
				'hide_empty'=>1
			)
		);
		//count the number of categories that are attached to the posts
		$all_the_cool_cats=count($all_the_cool_cats);
		set_transient('all_the_cool_cats',$all_the_cool_cats);
	}
	if('1'!=$all_the_cool_cats) {
		//this blog has more than 1 category so jvm_categorized_blog shold return true
		return true;
	}else{
		//this blog has more than 1 category so jvm_categorized_blog shold return false
		return false;
	}
}
/**
 * Flush out the transients used in jvm_categorized_blog
 *
 * @since jvm 1.0
 */

function jvm_category_transient_flusher(){
	//like ,beat it.Dig?
	delete_transient('all_the_cool_cats');
}
add_action('edit_category','jvm_category_transient_flusher');
add_action('save_post','jvm_category_transient_flusher');

if(!function_exists('jvm_content_nav')):
	/**
	*Display navigation to next/previous pages when applicable
	*
	*@since jvm 1.0
	*/
function jvm_content_nav($nav_id){
	global $wp_query,$post;
	//don't print empty markup on single pages if there's nowhere to navigate.
	if(is_single()) {
		$previous=(is_attachment() ? get_post($post->parent):get_adjacent_post(false,"true"));
		$next=get_adjacent_post(false,'',false);
		if(!$next && ! $previous) {
			return;
		}
	}
	//dont print empty markup in archives if there's only one page
	if($wp_query->max_num_pages < 2 && (is_home() || is_archive() || is_search())) {
		return;
	}	
	$nav_class='site-navigation paging-navigation';
	if(is_single()) {
		$nav_class='site-navigation post-navigation';
	}
	?>
    <nav role="navigation" id="<?php echo $nav_id; ?>" class="<?php echo $nav_class; ?>">
    <?php if ( is_single() ) : // navigation links for single posts ?>
 		<ul class="pager">
        <?php previous_post_link( '<li class="previous">%link</li>', '<span class="meta-nav">' . _x( '&larr;', 'Previous post link', 'jvm' ) . '</span> %title' ); ?>
        <?php next_post_link( '<li class="next">%link</li>', '%title <span class="meta-nav">' . _x( '&rarr;', 'Next post link', 'jvm' ) . '</span>' ); ?>
 
    <?php elseif ( $wp_query->max_num_pages > 1 && ( is_home() || is_archive() || is_search() ) ) : // navigation links for home, archive, and search pages ?>
 
        <?php if ( get_next_posts_link() ) : ?>
        <li class="previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'jvm' ) ); ?></li>
        <?php endif; ?>
 
        <?php if ( get_previous_posts_link() ) : ?>
        <li class="next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'jvm' ) ); ?></li>
        <?php endif; ?>
 
    <?php endif; ?>
 	</ul>
    </nav><!-- #<?php echo $nav_id; ?> -->
    <?php
}
endif; // jvm_content_nav
if(!function_exists('jvm_coment')):
/**
*template for comment and pingbacks
*
*used as callback by wp_list_comment() for displaying the comment
*
*@since jvm 1.0
*/
function jvm_coment($comment,$args,$depth){
	$GLOBALS['comment']=$comment;
	switch ($comment->comment_type) :
		case 'pingback':
		case 'trackback':
	?>
	<li class="post pingback">
		<p><?php _e('Pingback:','jvm');?><?php comment_author_link();?><?php edit_comment_link( __('(edit)','jvm'),'');?></p>
	<?php
		break;
		default:
	?>	
	<li <?php comment_class();?> id="li-<?php comment_ID();?>">
		<article id="comment-<?php comment_ID();?>" class="comment">
	<footer>
		<div class="comment-author vcard">
			<?php echo get_avatar($comment,40);?>
			<?php printf(__('%s <span class="says:</span>">','jvm'),sprintf('<cite class="fn">%s</cite>',get_comment_author_link()));?>
		</div><!--. comment author vcard-->
		<?php
		if($comment->comment_approved=='0'):?>
		<em><?php _e('Your comment is awaiting moderator.','jvm');?></em>
		<br/>
		<?php endif;?>
	<div class="comment-meta commentmetadata">
		<a href="<?php echo esc_url(get_comment_link($comment_ID));?>"><time pubdate date time="<?php comment_time('c');?>">
		<?php
		/*translator:1=date,2=time */
		printf(__('%1$s at %2$s','jvm'),get_comment_date(),get_comment_time());
		?>
	</time></a>
	<?php edit_comment_link(__('(Edit)','jvm'),'');?>
	</div><!--.comment-meta .comentmetadata-->
	</footer>
	<div class="comment-content"><?php comment_text();?></div>
	<div class="reply">	
		<?php comment_reply_link(
		array_merge($args,
			array(
			'depth'=>$depth,
			'max_depth'=>$args['max_depth']
			)
		));?>
	</div><!--.replt-->
	</article>	
	<?php
		break;
		endswitch;
	
}
endif; //end check for jvm_comment()
?>