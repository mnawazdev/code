/* Integrated the sign up button based on what URL is provided in the admin in closed acess mode for 
   Surge Masterclass - THE PERFECT RIA
   Estate Planning Course - THE PERFECT RIA

*/

<?php echo do_shortcode('[learndash_payment_buttons course_id="'.$course_id.'"]');?>


/* Custom LearnDash Courses files with role based navigation and the content */

<?php


		$cuser     = wp_get_current_user();
		$course_id = learndash_get_course_id();
		$user_id   = ( is_user_logged_in() ? $cuser->ID : false );


		$user = wp_get_current_user();
		$user_roles=$user->roles;
	

		/**
		 * Fires before the header in the focus template.
		 *
		 * @since 3.0.0
		 *
		 * @param int $course_id Course ID.
		 * @param int $user_id   User ID.
		 */
		do_action( 'learndash-focus-header-before', $course_id, $user_id );

		learndash_get_template_part(
			'focus/header.php',
			array(
				'course_id' => $course_id,
				'user_id'   => $user_id,
				'context'   => 'focus',
			),
			true
		);

		/**
		 * Fires before the sidebar in the focus template.
		 *
		 * @since 3.0.0
		 *
		 * @param int $course_id Course ID.
		 * @param int $user_id   User ID.
		 */
		
	?>

	<div class="ld-focus-sidebar">
		<div class="ld-course-navigation-heading">

			<span class="ld-focus-sidebar-trigger">
			<span class="ld-icon ld-icon-arrow-left"></span>

			</span>

			<h3>
				<a href="<?php echo esc_url( get_the_permalink( $course_id ) ); ?>" id="ld-focus-mode-course-heading">
					<span class="ld-icon ld-icon-content"></span>
					<?php echo esc_html( get_the_title( $course_id ) ); ?>
				</a>
			</h3>

		</div>
		<div class="ld-focus-sidebar-wrapper">
			
			<div class="ld-course-navigation">
				<div class="ld-course-navigation-list">
				<div class="bsp_main">		
	<?php if( have_rows('navigation_urb', 'option') ): ?>
		<ul class="rolebasedmenu">
		<?php while( have_rows('navigation_urb', 'option') ): the_row(); 
			$name = get_sub_field('name');
			$icon = get_sub_field('icon');
			$url_if_access = get_sub_field('url_if_access');
			$url_ifno_access = get_sub_field('url_ifno_access');
			$nh_fl = get_sub_field('nh_fl');
			$nh_sl = get_sub_field('nh_sl');
			
			$access_required = get_sub_field('access_required');
			
			$access=array_intersect($user_roles,$access_required);
				
			?>
			
				 
			<?php if( !empty($access) ): ?>
			<li>
				<?php if($nh_fl or $nh_sl): ?>
				<div>
					<?php if($nh_fl): ?><span><?php echo $nh_fl; ?></span><?php endif; ?>
					<?php if($nh_sl): ?><strong><?php echo $nh_sl; ?></strong><?php endif; ?>
				</div>
				<?php endif; ?>
				<a href="<?php echo $url_if_access; ?>"><span><?php if($icon): ?><img src="<?php echo $icon; ?>" alt="" width="32"><?php endif; ?></span><?php echo $name; ?></a>
			</li>
			<?php else: ?>
			<li class="no-access">
				<?php if($nh_fl or $nh_sl): ?>
				<div>
					<?php if($nh_fl): ?><span><?php echo $nh_fl; ?></span><?php endif; ?>
					<?php if($nh_sl): ?><strong><?php echo $nh_sl; ?></strong><?php endif; ?>
				</div>
				<?php endif; ?>
				<a href="<?php echo $url_ifno_access; ?>" target="_blank"><?php echo $name; ?><em class="no-ac-lock"></em></a>
			</li>
			<?php endif; ?>
				 

			
			
			
		<?php endwhile; ?>
		</ul>
	<?php endif; ?>
	</div>
				</div> <!--/.ld-course-navigation-list-->
			</div> <!--/.ld-course-navigation-->
			
		</div> <!--/.ld-focus-sidebar-wrapper-->
	</div>

	<div class="ld-focus-main">

		<?php
		/**
		 * Fires before the masthead in the focus template.
		 *
		 * @since 3.0.0
		 *
		 * @param int $course_id Course ID.
		 * @param int $user_id   User ID.
		 */
		do_action( 'learndash-focus-masthead-before', $course_id, $user_id );

		learndash_get_template_part(
			'focus/masthead.php',
			array(
				'course_id' => $course_id,
				'user_id'   => $user_id,
				'context'   => 'focus',
			),
			true
		);

		/**
		 * Fires after the masthead in the focus template.
		 *
		 * @since 3.0.0
		 *
		 * @param int $course_id Course ID.
		 * @param int $user_id   User ID.
		 */
		do_action( 'learndash-focus-masthead-after', $course_id, $user_id );
		?>

		<div class="ld-focus-content">

			<?php
			/**
			 * Fires before the title in the focus template.
			 *
			 * @since 3.0.0
			 *
			 * @param int $course_id Course ID.
			 * @param int $user_id   User ID.
			 */
			do_action( 'learndash-focus-content-title-before', $course_id, $user_id );
			?>

			<h1><?php the_title(); ?></h1>


			<?php the_content(); ?>
			

			<?php echo do_shortcode('[course_content]');?>	

			<?php echo do_shortcode('[learndash_payment_buttons course_id="'.$course_id.'"]');?>


			<?php
				wp_link_pages(
					array(
						'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'learndash' ),
						'after'  => '</div>',
					)
				);
			?>

			<?php
			/**
			 * Filters whether to show existing comments when comments are not enabled.
			 *
			 * @since 3.4.2
			 *
			 * @param boolean $show_existing_comments Whether to show existing comments.
			 */
			if ( comments_open() || ( apply_filters( 'learndash_focus_mode_show_existing_comments', false ) ) ) {
				if ( has_filter( 'learndash_focus_mode_can_view_comments' ) ) {
					/**
					 * Filters the post listing before displaying it to user.
					 *
					 * @since 3.1.4
					 * @deprecated 4.3.0
					 *
					 * @param boolean $load_focus_comments Whether to show comments in focus mode or not.
					 */
					apply_filters_deprecated(
						'learndash_focus_mode_can_view_comments',
						array( is_user_logged_in() ),
						'4.3.0'
					);
				}
				learndash_get_template_part(
					'focus/comments.php',
					array(
						'course_id' => $course_id,
						'user_id'   => $user_id,
						'context'   => 'focus',
					),
					true
				);
			}
			?>

			<?php
			/**
			 * Fires at the focus mode content end.
			 *
			 * @since 3.1.4
			 *
			 * @param int $course_id Course ID.	
			 * @param int $user_id   User ID.
			 */
			do_action( 'learndash-focus-content-end', $course_id, $user_id );
			?>
		</div> <!--/.ld-focus-content-->

	</div> <!--/.ld-focus-main-->

		<?php
		/**
		 * Fires before the footer in the focus template.
		 *
		 * @since 3.0.0
		 *
		 * @param int $course_id Course ID.
		 * @param int $user_id   User ID.
		 */
		do_action( 'learndash-focus-content-footer-before', $course_id, $user_id );

		learndash_get_template_part(
			'focus/footer.php',
			array(
				'course_id' => $course_id,
				'user_id'   => $user_id,
				'context'   => 'focus',
			),
			true
		);

		/**
		 * Fires after the footer in the focus template.
		 *
		 * @since 3.0.0
		 *
		 * @param int $course_id Course ID.
		 * @param int $user_id   User ID.
		 */
		do_action( 'learndash-focus-content-footer-after', $course_id, $user_id );


