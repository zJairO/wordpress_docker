<?php
$social_sharing = Atomlab::setting( 'social_sharing_item_enable' );
if ( ! empty( $social_sharing ) ) {
	?>
	<div class="post-share">
		<div class="post-share-toggle">
			<span class="ion-android-share-alt"></span>
			<div class="post-share-list">
				<?php Atomlab_Templates::get_sharing_list(); ?>
			</div>
		</div>
	</div>
	<?php
}
