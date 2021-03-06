<?php
	global $publish, $post;

	$title = apply_filters( 'the_title', get_the_title() );

	// There's never a line with one word unless it's the first line ;)
	if ( strlen( $title ) > 1 && strrpos( $title, ' ' ) !== false )
		$title = substr_replace( $title, '&nbsp;', strrpos( $title, ' ' ), 1 );

	// h1 if singular and h2 + link if not
	if ( is_singular() )
		$title = sprintf( '<h1 class="post-title">%s</h1>', $title );
	else
		$title = sprintf( '<h2 class="post-title"><a href="%s" rel="bookmark">%s</a></h2>', get_permalink(), $title );

	
	if ( strlen( $post->post_title ) > 0 )
		echo $title;

	if ( ! is_search() )
		the_content( 'Continue reading' );
	else
		the_excerpt();

	if ( is_singular() ): ?>

	<div id="social">
		<!-- Twitter -->
		<a href="https://twitter.com/share" class="twitter-share-button" data-via="soulseekah" data-lang="en">Tweet</a>
		<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>

		<!-- Google +1 -->
		<g:plusone size="medium" annotation="inline"></g:plusone>

		<!-- Place this render call where appropriate -->
		<script type="text/javascript">
		  (function() {
			var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
			po.src = 'https://apis.google.com/js/plusone.js';
			var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
		  })();
		</script>
	</div>

	<div class="clear"></div>
	<?php endif; ?>

<?php if ( ! is_search() ): ?>
	<?php wp_link_pages(); ?>


	<p class="show-when-narrow post-meta-helper">
		<?php if ( get_post_type() == 'page' ) : ?>

		<?php else : ?>
			<?php _e( 'Published', 'publish' ); ?> <a href="<?php the_permalink(); ?>" rel="bookmark"><?php $publish->the_time_diff(); ?></a>

			<?php if ( $publish->options['display-author'] ) : ?>
			<?php
				// Translators: by <author display name>
				printf( __( 'by %s', 'publish' ),
					sprintf( '<a href="%s" rel="author">%s</a>',
						get_author_posts_url( get_the_author_meta( 'ID' ) ),
						get_the_author()
					)
				);
			?>
			<?php endif; ?>

			<?php _e( 'with', 'publish' ); ?> <a href="<?php comments_link(); ?>"><?php comments_number( __( 'no comments', 'publish' ), __( 'one comment', 'publish' ), __( '% comments', 'publish' ) ); ?></a>

			<?php if ( $publish->options['display-tags'] ) { the_tags( __( 'tagged ', 'publish' ), ', ' ); } ?>
			<?php if ( $publish->options['display-categories'] ) { _e( ' in ', 'publish' ); the_category( ', ' ); } ?>
		<?php endif; ?>
	</p>

	<p class="post-tags hide-when-narrow">
		<?php if ( $publish->options['display-tags'] ) the_tags( '', ' ' ); ?>
		<?php if ( $publish->options['display-categories'] ) the_category( ' ' ); ?>
	</p>
<?php endif; ?>
