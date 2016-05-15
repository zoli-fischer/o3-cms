<!DOCTYPE HTML>
<html lang="en">
<head>

	<?php 

		//load html head
		$this->view( 'o3_cms_template_view_html_head' );

	?>

</head>
<body class="<?php echo o3_ua_body_classes(); ?>">	
	
	<?php
		
		//load header
		$this->view( 'o3_cms_template_view_header' );
		
	?>

		<div id="transfer-view-top">			
			<div class="container">
				<div class="row">
					<div class="col-sm-12">

						<h1><?php echo $this->page_title(); ?></h1>

					</div>
				</div>			
			</div>
		</div>

		<?php 
		if ( count($this->files) > 0 ) {
		?>
			<div id="transfer-view" class="<?php echo !$this->show_group_headers() ? 'no-h3' : '';  ?>">			

				<div class="container">
					<div class="row">
						<div class="col-sm-8">
							<h3>
								<?php  echo $this->transfer->files_count().' '.( $this->transfer->files_count() == 1 ? ' file ' : ' files ' ); ?> 
								<span><?php echo ' ( <small>size:</small> '.o3_bytes_display( 'vU', $this->transfer->size() ).' ) '; ?></span>							
							</h3>
							<a href="<?php echo $this->transfer->zip_url(); ?>" title="Download all"><i class="fa fa-cloud-download"></i> Download all</a>
						</div>
						<div class="col-sm-4 text-right header-right" data-title="<?php echo o3_html($this->transfer->share_title()); ?>" data-desc="<?php echo o3_html($this->transfer->share_desc()); ?>">
							<small>Share on:</small><br>
							<a href="<?php echo o3_html($this->transfer->url()); ?>" class="btn btn-facebook share-link" title="Share on Facebook"><i class="fa fa-facebook"></i></a>
							<a href="<?php echo o3_html($this->transfer->url()); ?>" class="btn btn-google share-link" title="Share on Google+"><i class="fa fa-google-plus"></i></a>
							<a href="<?php echo o3_html($this->transfer->url()); ?>" class="btn btn-twitter share-link" title="Share on Twitter"><i class="fa fa-twitter"></i></a>
							<a href="<?php echo o3_html($this->transfer->url()); ?>" class="btn btn-linkedin share-link" title="Share on LinkedIn"><i class="fa fa-linkedin"></i></a>
							<!--
							View: 
							<span></span>
							<div class="clearfix"></div>
							<div class="list-tab">
								<a href="#" class="active"><i class="fa fa-list"></i> Details</a><a href="#"><i class="fa fa-th-large"></i> Icons</a>
							</div>
							-->
						</div>
						<div class="col-sm-12 files-list">
							
							<?php 
							//show images
							if ( count($this->images) > 0 ) {
							?>
								<h3><i class="fa fa-picture-o"></i> Images <small>(<?php echo count($this->images).' '.( count($this->images) == 1 ? 'file' : 'files' ); ?>)</small></h3>
								<hr>
								<ul class="list-icons list-images">								
									<?php
										foreach ( $this->images as $file ) {
											?>
											<li class="item">
												<div>
													<div class="head">
														<div><?php echo o3_html($file->extension()); ?></div>
														<div><?php echo o3_bytes_display( 'vU', $file->size() ); ?></div>	
														<span class="clearfix"></span>
													</div>
													<div class="body">
														<div>
															<a href="<?php echo o3_html($file->preview_url(1)); ?>" title="<?php echo o3_html($file->get('name')); ?>" style="background-image: url('<?php echo o3_html($file->thumb_url(1)); ?>')"></a>
														</div>
													</div>
													<div class="foot">
														<div>
															<span><?php echo o3_html($file->get('name')); ?></span>
															<a href="<?php echo o3_html($file->url()); ?>" title="Download <?php echo o3_html($file->get('name')); ?>"><i class="fa fa-cloud-download"></i></a>
														</div>
													</div>
												</div>
											</li>
											<?php								
										}
									?>
								</ul>
								<div class="clearfix-m"></div>
							<?php 
							}
							?>

							<?php 
							//show videos
							if ( count($this->videos) > 0 ) {
							?>
								<h3><i class="fa fa-video-camera"></i> Videos <small>(<?php echo count($this->videos).' '.( count($this->videos) == 1 ? 'file' : 'files' ); ?>)</small></h3>
								<hr>
								<ul class="list-icons list-video">								
									<?php
										foreach ( $this->videos as $file ) {
											?>
											<li class="item">
												<div>
													<div class="head">
														<div><?php echo o3_html($file->extension()); ?></div>
														<div><?php echo o3_bytes_display( 'vU', $file->size() ); ?></div>	
														<span class="clearfix"></span>
													</div>
													<div class="body">
														<div>
															<a href="<?php echo o3_html($file->preview_url(1)); ?>" title="<?php echo o3_html($file->get('name')); ?>" style="background-image: url('<?php echo o3_html($file->thumb_url(1)); ?>')">
																<i></i>
																<b></b>
																<span style="background-image: url('<?php echo o3_html($file->thumb_url(2)); ?>')"></span>
															</a>	
														</div>
													</div>
													<div class="foot">
														<div>
															<span><?php echo o3_html($file->get('name')); ?></span>
															<a href="<?php echo o3_html($file->url()); ?>" title="Download <?php echo o3_html($file->get('name')); ?>"><i class="fa fa-cloud-download"></i></a>
														</div>
													</div>
												</div>
											</li>
											<?php								
										}
									?>
								</ul>
								<div class="clearfix-m"></div>
							<?php 
							}
							?>

							<?php 
							//show videos
							if ( count($this->audio) > 0 ) {
							?>
								<h3><i class="fa fa-headphones"></i> Audio <small>(<?php echo count($this->audio).' '.( count($this->audio) == 1 ? 'file' : 'files' ); ?>)</small></h3>
								<hr>
								<ul class="list-detail">								
									<?php
										foreach ( $this->audio as $file ) {
											?>
											<li class="item">
												<div>
													<div class="head">
														<div><?php echo o3_html($file->extension()); ?></div>
														<div><?php echo o3_bytes_display( 'vU', $file->size() ); ?></div>	
														<span class="clearfix"></span>
													</div>
													<div class="body audio-player">
														<div>
															<audio>
																<source src="<?php echo o3_html($file->preview_url(1)); ?>" type="audio/mpeg">
																<p class="no-html5-audio">Your browser does not support the audio element.</p>
															</audio>
															<a href="#" title="Play demo" class="play"><i class="fa fa-play"></i> Play demo</a>
															<a href="#" title="Stop" class="stop"><i class="fa fa-stop"></i> Stop</a>
														</div>
													</div>
													<div class="foot">
														<div>
															<span><?php echo o3_html($file->get('name')); ?></span>
															<a href="<?php echo o3_html($file->url()); ?>" title="Download <?php echo o3_html($file->get('name')); ?>"><i class="fa fa-cloud-download"></i></a>
														</div>
													</div>
												</div>
											</li>
											<?php								
										}
									?>
								</ul>
								<div class="clearfix-m"></div>
							<?php
							}
							?>

							<?php 
							//show videos
							if ( count($this->docs) > 0 ) {
							?>
								<h3><i class="fa fa-book"></i> Documents <small>(<?php echo count($this->docs).' '.( count($this->docs) == 1 ? 'file' : 'files' ); ?>)</small></h3>
								<hr>
								<ul class="list-icons list-images">								
									<?php
										foreach ( $this->docs as $file ) {
											?>
											<li class="item">
												<div>
													<div class="head">
														<div><?php echo o3_html($file->extension()); ?></div>
														<div><?php echo o3_bytes_display( 'vU', $file->size() ); ?></div>	
														<span class="clearfix"></span>
													</div>
													<div class="body">
														<div>
															<a href="<?php echo o3_html($file->url()); ?>" title="<?php echo o3_html($file->get('name')); ?>" style="background-image: url('<?php echo o3_html($file->thumb_url(1)); ?>')"></a>
														</div>
													</div>
													<div class="foot">
														<div>
															<span><?php echo o3_html($file->get('name')); ?></span>
															<a href="<?php echo o3_html($file->url()); ?>" title="Download <?php echo o3_html($file->get('name')); ?>"><i class="fa fa-cloud-download"></i></a>
														</div>
													</div>
												</div>
											</li>
											<?php								
										}
									?>
								</ul>
								<div class="clearfix-m"></div>
							<?php 
							}
							?>

							<?php 
							//show videos
							if ( count($this->others) > 0 ) {
							?>
								<h3><i class="fa fa-asterisk"></i> Other <small>(<?php echo count($this->others).' '.( count($this->others) == 1 ? 'file' : 'files' ); ?>)</small></h3>
								<hr>
								<ul class="list-detail">								
									<?php
										foreach ( $this->others as $file ) {
											?>
											<li class="item">
												<div>
													<div class="head">
														<div><?php echo o3_html($file->extension()); ?></div>
														<div><?php echo o3_bytes_display( 'vU', $file->size() ); ?></div>	
														<span class="clearfix"></span>
													</div>
													<div class="body">
														<div>
															
														</div>
													</div>
													<div class="foot">
														<div>
															<span><?php echo o3_html($file->get('name')); ?></span>
															<a href="<?php echo o3_html($this->transfer->file_url($file->get('id'))); ?>" title="Download <?php echo o3_html($file->get('name')); ?>"><i class="fa fa-cloud-download"></i></a>
														</div>
													</div>
												</div>
											</li>
											<?php								
										}
									?>
								</ul>
								<div class="clearfix-m"></div>
							<?php 
							}
							?>

						</div>

						<div class="col-sm-8">
							<?php 
							if ( !$this->transfer->owner()->is_premium() ) {
							?>
								All files will be deleted on <?php echo $this->country()->format_date( $this->transfer->get('expire') ) ?>
							<?php 
							}
							?>
						</div>
						<div class="col-sm-4 text-right">
							
							<a href="<?php echo $this->o3_cms->page_url(CONTACT_PAGE_ID,array( 'tr' => $this->transfer->url() )); ?>" target="_blank" class="btn btn-danger btn-small"><i class="fa fa-exclamation"></i> Report a problem</a>

						</div>

					</div>					
				</div>
			</div> 

		<?php 
		} else {
		?>
			<div class="container">
				<div class="row">
					<div class="col-sm-8">
						
						<div class="clearfix-lg"></div>

						<h3>The download couldn't be found or is expired.</h3>
						
						<div class="clearfix-m"></div>

						<p>Please check if the download link is correct.</p>
						<!--<p>Download link: <a href="javascript:{}"><?php echo o3_html(o3_current_url()); ?></a></p>-->

						<div class="clearfix-lg"></div>

					</div>
				</div>
			</div>
		<?php
		} 
		?>
	
	
	<?php

		//load header
		$this->view( 'o3_cms_template_view_footer' );

	?>

</body>
</html>