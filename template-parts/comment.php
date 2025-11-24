<?php do_action( 'kava-theme/comments/comment-before' ); ?>

<article class="comment" id="comment-<?php comment_ID(); ?>" itemscope itemtype="https://schema.org/Comment">
<?php if ( ! empty( kava_comment_author_avatar() ) ) : ?>
<div class="comment-author vcard">
	<?php echo kava_comment_author_avatar(); ?>
</div>
<?php endif; ?>
<div class="comment-content-wrapper">
	<header class="comment-meta" aria-label="<?php esc_attr_e( 'Comment metadata', 'kava' ); ?>">
		<span itemscope itemtype="https://schema.org/Person" itemprop="author">
			<?php echo kava_get_comment_author_link(); ?>
		</span>
		<span itemprop="dateCreated">
			<?php echo kava_get_comment_date(); ?>
		</span>
	</header>
	<div class="comment-content" itemprop="text">
		<?php echo kava_get_comment_text(); ?>
	</div>
	<footer class="comment-footer">
		<div class="reply">
			<?php echo kava_get_comment_reply_link( [ 'reply_text' => '<i class="fa-solid fa-reply" aria-hidden="true"></i>' . esc_html__( 'reply', 'kava' ) ] ); ?>
		</div>
	</footer>
</div>
</article>

<?php do_action( 'kava-theme/comments/comment-after' ); ?>
