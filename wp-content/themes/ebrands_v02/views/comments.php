<?php
if (! empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME'])) {
	die ('Please do not load this page directly. Thanks!');
}

if (post_password_required()) {
	print "This post is password protected. Enter the password to view comments.";
	return; 
}
?>
<div id="comments">
<?php if (comments_open()) { ?>
	<?php if (have_comments()) { ?>
		<h2>Comments</h2>
		<ul class="commentlist" itemprop="comment">
			<?php wp_list_comments('type=comment'); ?>
		</ul>
	<?php }

	global $current_user;
	get_currentuserinfo();
	$user = $current_user->display_name;
	$commenter = wp_get_current_commenter();

	$fields = comment_form(
		array(
			'title_reply' => 'Leave a comment',
			'title_reply_to' => 'Reply to %s',
			'cancel_reply_link' => '×',
			'label_submit' => 'Submit',
			'logged_in_as' => '<span class="meta"><a href="'.admin_url('profile.php').'">'.get_avatar($user_ID,16).' '.$user.'</a></span> <a href="'.wp_logout_url(apply_filters('the_permalink', get_permalink())).'" title="Log Out">Log Out</a>',
			'id_form' => 'comment_options',
			'id_submit' => 'comment_sumbit',
			'comment_notes_before' => '',
			'comment_notes_after' => '',
			'fields' => array(
				'author' => '<input id="author" placeholder="Your Name" name="author" type="text" value="'.esc_attr($commenter['comment_author']).'"/>',
				'email'  => '<input id="email" placeholder="Your Email" name="email" type="text" value="'.esc_attr($commenter['comment_author_email']).'"/>'
				),
			'comment_field' => '<textarea id="comment" placeholder="Your Comment" name="comment" aria-required="true"></textarea>'
		)
	); 
}
?>
</div>