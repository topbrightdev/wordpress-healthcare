<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<meta content="telephone=no" name="format-detection">
	<title><?php bloginfo('title'); ?> - <?php the_title(); ?></title>
	<style>

		.container { margin: 0 auto; }

		.remove-ios-date-link {
			text-decoration: none !important;
		}

		@media screen and (max-width: 620px) {

			.container {
				width: 92% !important;
			}

			.img-full {
				width: 100%;
				height: auto;
			}

			.logo {
				display: block;
				width: 100%;
				max-width: 300px;
				height: auto;
				margin: 10px auto;
			}

			.header,
			.header tr,
			.header th,
			.header tbody,
			.datebox,
			.datebox tbody,
			.datebox tr {
				display: block;
				width: 100% !important;
			}

			.datebox {
				border-top: 1px solid #000000 !important;
				border-bottom: 1px solid #000000 !important;
				text-align: center;
				margin-top: 20px;
				margin-bottom: 20px;
			}

			.datebox tr.datebox__txt {
				display: inline-block;
				width: auto !important;
				text-align: center;
			}

			.datebox tr td {
				width: auto !important;
				border-left: none !important;
				font-size: 14px !important;
				padding: 5px 0;
			}

			.catbar				 { width: 100%; font-size: 12px !important; }
			.catbar__title { width: 75%; }

			.summary 		   { width: 100% !important; }
			.summary__img  { width: 20%  !important; }
			.summary__txt  { width: 80%  !important; }

			.summary__img img {
				width: 90%;
				height: auto;
			}

			.mobile-hide { display: none !important; }
			.mobile-show-ib { display: inline-block !important; }

		}

	</style>
</head>
<body style="padding: 0; margin: 0;">

	<?php if ( get_field('email_preview_text') ) { ?>
		<div style="display: none;"><?php the_field('email_preview_text'); ?></div>
	<?php } ?>

	<table class="master-table" cellpadding="0" cellspacing="0" border="0" width="100%">
		<tr>
			<td align="center">

				<table class="container" cellpadding="0" cellspacing="0" border="0" width="600">
					<tr>
						<td align="center">

							<!-- Header -->
							<table class="header" cellpadding="0" cellspacing="0" border="0" width="600" style="font-family: Arial, sans-serif;">
								<tr class="mobile-hide"><th style="font-size: 1px; line-height: 0; height: 20px;">&nbsp;</th></tr>
								<tr valign="top">
									<th class="header__logo img-full" width="435" align="left">
										<a href="<?php echo site_url(); ?>"><img src="<?php bloginfo('template_directory'); ?>/assets/dist/img/provider-connection-logo@2x.jpg" class="logo"
											width="350" alt="CentraCare Health Bulletin" border="0" /></a>
									</th>
									<th class="header__date" width="165" align="right">

										<table class="datebox" cellpadding="0" cellspacing="0" border="0" width="100" style="font-family: Arial, sans-serif;">
											<tr class="mobile-hide"><td style="border-left: 1px solid #000000; font-size: 1px; line-height: 0; height: 10px;">&nbsp;</td></tr>
											<tr class="datebox__txt"><td class="datebox__txt-day" align="center"
												style="border-left: 1px solid #000000; font-size: 16px; font-weight: bold;"><span class="remove-ios-date-link" style="color: #000000;"><?php echo strtoupper(get_the_time('M j')); ?></span><span style="display: none;" class="mobile-show-ib">,</span></td></tr>
											<tr class="datebox__txt"><td align="center" style="border-left: 1px solid #000000; font-size: 26px; font-weight: bold;"><?php echo strtoupper(get_the_time('Y')); ?></td></tr>
											<tr class="mobile-hide"><td style="border-left: 1px solid #000000; font-size: 1px; line-height: 0; height: 10px;">&nbsp;</td></tr>
										</table>
										
									</th>
								</tr>
								<tr class="mobile-hide"><th style="font-size: 1px; line-height: 0; height: 20px;">&nbsp;</th></tr>
							</table>
							
							<?php if ( have_rows('newsletter_sections') ) : ?>
							
								<?php while( have_rows('newsletter_sections') ) : the_row(); ?>

									<?php $cat_obj = get_sub_field('category_divider'); ?>

									<!-- Category Header -->
									<?php if ($cat_obj) { ?>
										<table class="catbar" cellpadding="5" cellspacing="0" border="0" width="600" style="font-family: Arial, sans-serif;">
											<tr align="left" style="color: #ffffff; font-weight: bold; text-transform: uppercase;">
												<td class="catbar__title" width="525" bgcolor="#373737"><?php esc_html_e($cat_obj->name); ?></td>
												<td class="catbar__more" align="center" width="75" bgcolor="#00825F"><a
													style="color: #ffffff; text-decoration: none;" href="<?php echo get_category_link($cat_obj->term_id); ?>">More &#187;</a></td>
											</tr>
											<tr><td colspan="2" style="font-size: 1px; line-height: 0; height: 7px;">&nbsp;</td></tr>
										</table>
									<?php } ?>

									<?php $posts = get_sub_field('articles'); ?>

									<?php if ( $posts ) : foreach ( $posts as $post ) : setup_postdata( $post ); ?>
										<!-- Article Summary -->
										<table class="summary" cellpadding="0" cellspacing="0" border="0" width="600" style="font-family: Arial, sans-serif;">
											<tr align="left">
												<td class="summary__img" width="145" valign="top">
													<a href="<?php the_permalink(); ?>"><img class="img-full" style="margin-top: 8px; border: none;"
														src="<?php the_post_thumbnail_url('thumbnail'); ?>" height="125" width="125" border="0" alt="Placeholder image" /></a>
												</td>
												<td class="summary__txt" width="455" valign="top">
													<table cellpadding="0" cellspacing="5" border="0" width="100%" style="font-family: Arial, sans-serif;">
														<tr><td style="font-size: 15px; color: #B3B3B3;"><span class="remove-ios-date-link" style="color: #B3B3B3;"><?php the_time('M j, Y'); ?></span></td></tr>
														<tr>
															<td style="font-size: 20px; font-weight: bold;">
																<a href="<?php the_permalink(); ?>" style="text-decoration: none; color: #000000;"><strong><?php the_title(); ?></strong></a>
															</td>
														</tr>
														<tr>
															<td style="font-size: 15px; line-height: 20px;">
																<?php the_excerpt(); ?>
															</td>
														</tr>
													</table>
												</td>
											</tr>
											<tr><td colspan="2">&nbsp;</td></tr>
										</table>
									<?php endforeach; endif; wp_reset_postdata(); ?>

									<?php $term_obj = get_sub_field('category_divider'); ?>
							
								<?php endwhile; ?>
							
							<?php endif; ?>

						</td>
					</tr>
				</table>

			</td>
		</tr>
	</table>

	<div id="reference" style="padding: 50px; margin: 50px auto 0; background: #cccccc; box-sizing: border-box;">

		<style>

			.preview {
				display: block;
				box-sizing: border-box;
				width: 100%;
				padding: 20px;
				margin-bottom: 50px;
				border: 2px solid #eeeeee;
				border-radius: 4px;
				backgruond: #eeeeee;
				font-size: 1.0em;
				height: 300px;
			}

			.btn {
				font-size: 1em;
				padding: 1em;
				margin-bottom: 1em;
				border: 2px solid #eeeeee;
				background: #666666;
				color: #ffffff;
				border-radius: 4px;
				cursor: pointer;
				transition: background .25s ease;
			}

			#button:hover {
				background-color: #444444;
			}
		
		</style>

		<div id="plaintext" style="display: none;"><?php

				echo 'CentraCare Health Provider Connection' . "\n";
				echo get_the_time('M j, Y') . "\n";
				echo "\n";

				if ( have_rows('newsletter_sections') ) :
				
					while( have_rows('newsletter_sections') ) : the_row();
					
					$cat_obj = get_sub_field('category_divider');
					
					if ($cat_obj) {
						echo '-------------------------------'."\n";
						echo $cat_obj->name . "\n";
						echo '[' . get_category_link($cat_obj->term_id) . ']' . "\n";
						echo '-------------------------------'."\n";
						echo "\n";
					}
					
					$posts = get_sub_field('articles');

					if ( $posts ) : foreach ( $posts as $post ) : setup_postdata( $post );

							$excerpt = get_the_excerpt();
							$excerpt = str_replace('[&hellip;]','',$excerpt);

							echo '***' . "\n";
							echo get_the_time('M j, Y') . ' - ' . get_the_title() . "\n";
							echo $excerpt . "\n";
							echo '[' . get_permalink() . ']' . "\n";
							echo "\n";

					endforeach; endif; wp_reset_postdata();
					
					$term_obj = get_sub_field('category_divider');
				
				endwhile;

			endif;
		
		?>
		</div>

		<button class="btn" id="htmlButton">Copy HTML To Clipboard</button>
		<textarea id="htmlSnippet" class="preview" readonly></textarea>

		<button class="btn" id="plaintextButton">Copy Plain Text To Clipboard</button>
		<textarea id="plaintextSnippet" class="preview" readonly></textarea>

		<script>
			
			var html 		    		 = document.documentElement.outerHTML;
			var plaintext   		 = document.getElementById('plaintext').innerHTML;
			var remote 	    		 = document.getElementById('reference').outerHTML;
			var htmlSnippet 		 = document.getElementById('htmlSnippet');
			var plaintextSnippet = document.getElementById('plaintextSnippet');
			var htmlButton 	     = document.getElementById('htmlButton');
			var plaintextButton	 = document.getElementById('plaintextButton');

			// remove the reference section from the page HTML
			html = html.replace(remote,'');
			
			// output the HTML for copy/paste
			htmlSnippet.value = html;
			plaintextSnippet.value = plaintext;
			
			htmlButton.onclick = function(){
				htmlSnippet.select();
		    document.execCommand('copy');				
			};

			plaintextButton.onclick = function(){
				plaintextSnippet.select();
		    document.execCommand('copy');				
			};

		</script>

	</div>

</body>
</html>