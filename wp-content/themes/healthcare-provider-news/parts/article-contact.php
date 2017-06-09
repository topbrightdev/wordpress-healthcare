<?php

	$article_email 		= get_option('default_article_contact');
	$article_email_cc = get_option('default_article_contact_cc');

	if ( get_field('post_contact_type') == 'custom' && get_field('post_contact_custom_email') ) {
		$article_email = get_field('post_contact_custom_email');
	}

	if ( get_field('post_contact_type') == 'custom' && get_field('post_contact_custom_cc') ) {
		$article_email_cc = get_field('post_contact_custom_cc');
	}

?>

<?php if ( $article_email && $article_email != '' ) { ?>
	<div class="meta-close wysiwyg">
		<p>Please contact <a href="mailto:<?php echo $article_email; ?>?subject=<?php esc_attr_e(get_the_title()); ?><?php
			if ($article_email_cc) { echo '&cc='.$article_email_cc; }; ?>"><?php echo $article_email; ?></a> with questions regarding this article.</p>
	</div>
<?php } ?>