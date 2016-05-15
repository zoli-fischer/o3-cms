<!DOCTYPE HTML>
<html lang="en">
<head>

	<?php 

		//load html head
		$this->view( 'o3_cms_template_view_html_head' );


		//load transfer viewer app
		$this->parent->body_js(O3_CMS_THEME_DIR.'/js/snapfer/snapfer.viewer.app.js');
		
		//load transfer viewer item app
		$this->parent->body_js(O3_CMS_THEME_DIR.'/js/snapfer/snapfer.viewer.item.app.js');


	?>

</head>
<body class="<?php echo o3_ua_body_classes(); ?>">	
	
	<?php
			
		//insert Google Analytics code
		$this->ga_script();
		
		//load header
		$this->view( 'o3_cms_template_view_header' );
		
	?>

		<div id="transfer-view-top">			
			<div class="container">
				<div class="row">
					<div class="col-sm-12">

						<h1><?php echo $this->page_title(); ?></h1>
						
						<?php 
							echo $this->ad_tag();
						?>						

					</div>

					<div>
						
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
														<div class="<?php echo $file->has_thumb(1) ? '' : 'no-thumb'; ?> <?php echo $file->has_preview(1) ? '' : 'no-preview'; ?>">
															<a href="<?php echo $file->has_preview(1) ? o3_html($file->preview_url(1)) : 'javascript:{}'; ?>" 
																title="<?php echo o3_html($file->get('name')); ?>"
																data-download="<?php echo o3_html($file->url()); ?>"
																data-preview="<?php echo $file->has_preview(2) ? o3_html($file->preview_url(2)) : ''; ?>"
																data-type="<?php echo o3_html($file->get('type')); ?>"
																data-size="<?php echo o3_html($file->size()); ?>"
																data-ext="<?php echo o3_html($file->extension()); ?>"
																data-ref="transfer-viewer"
																style="background-image: url('<?php echo $file->has_thumb(1) ? o3_html($file->thumb_url(1)) : ''; ?>')">
																<i class="fa fa-picture-o"></i>
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
														<div class="<?php echo $file->has_thumb(1) ? '' : 'no-thumb'; ?> <?php echo $file->has_preview(1) ? '' : 'no-preview'; ?>">
															<a href="<?php echo $file->has_preview(1) ? o3_html($file->preview_url(1)) : 'javascript:{}'; ?>" 
																title="<?php echo o3_html($file->get('name')); ?>"
																data-download="<?php echo o3_html($file->url()); ?>"
																data-preview="<?php echo $file->has_preview(2) ? o3_html($file->preview_url(2)) : ''; ?>"
																data-type="<?php echo o3_html($file->get('type')); ?>"
																data-size="<?php echo o3_html($file->size()); ?>"
																data-ext="<?php echo o3_html($file->extension()); ?>"
																data-ref="transfer-viewer"
																style="background-image: url('<?php echo $file->has_thumb(1) ? o3_html($file->thumb_url(1)) : ''; ?>')">
																<i class="fa fa-video-camera"></i>
																<u></u>
																<b></b>
																<span style="background-image: url('<?php echo $file->has_thumb(2) ? o3_html($file->thumb_url(2)) : ''; ?>')"></span>
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
														<div class="<?php echo $file->has_preview(1) ? '' : 'no-preview'; ?>">
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
														<div class="<?php echo $file->has_thumb(1) ? '' : 'no-thumb'; ?> <?php echo $file->has_preview(1) ? '' : 'no-preview'; ?>">
															<a href="<?php echo $file->has_preview(1) ? o3_html($file->preview_url(1)) : 'javascript:{}'; ?>" 
																title="<?php echo o3_html($file->get('name')); ?>" 
																data-download="<?php echo o3_html($file->url()); ?>"
																data-preview="<?php echo $file->has_preview(2) ? o3_html($file->preview_url(2)) : ''; ?>"
																data-pages="<?php echo o3_html($file->get('pages')); ?>"
																data-type="<?php echo o3_html($file->get('type')); ?>"
																data-size="<?php echo o3_html($file->size()); ?>"
																data-ext="<?php echo o3_html($file->extension()); ?>"
																data-ref="transfer-viewer"
																style="background-image: url('<?php echo $file->has_thumb(1) ? o3_html($file->thumb_url(1)) : ''; ?>')">
																<i class="fa fa-book"></i>
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

	<!--Transfer viewer-->
	<div id="transfer-viewer" data-bind="css: { 'visible': viewer.visible(), 'with-bottom': viewer.current_item().is_doc() }">
		<div class="overlay"></div>
		<div class="top">
			<div>
				<a href="#" title="Download" class="download icon green" data-bind="attr: { href: viewer.current_item().url }"><i class="fa fa-cloud-download"></i></a>
				<span class="title" data-bind="text: viewer.current_item().title+' - '+o3_bytes_display(viewer.current_item().size,2)"></span>					
				<span class="index"><u data-bind="text: viewer.current() + 1"></u> of <u data-bind="text: viewer.items().length"></u></span>
				<span class="close icon" data-bind="click: viewer.hide"><i class="fa fa-times"></i></span>				
			</div>
		</div>
		<div class="bottom">
			<div class="zoom">
				<select data-bind="value: viewer.zoom, valueUpdate: 'keyup'">
					<option value="1">100%</option>
					<option value="1.5">150%</option>
					<option value="2">200%</option>
				</select>
			</div>
			<div class="pages">
				<span class="up icon" data-bind="click: viewer.current_item().prev_page, css: { 'disabled': !viewer.current_item().allow_prev_page() }"><i class="fa fa-angle-up"></i></span>	
				<span class="page"><u data-bind="text: viewer.current_item().current_page() + 1"></u> of <u data-bind="text: viewer.current_item().pages"></u></span>
				<span class="down icon" data-bind="click: viewer.current_item().next_page, css: { 'disabled': !viewer.current_item().allow_next_page() }"><i class="fa fa-angle-down"></i></span>	
			</div>
		</div>
		<div class="body">

			<div class="image" 
				data-bind="visible: viewer.current_item().is_image() && viewer.current_item().loaded(), 
							style: { 
								'background-image': viewer.current_item().is_image() ? 'url(\''+viewer.current_item().image_url()+'\')' : '',
								'background-size': viewer.image_bg_size()
							}"></div>

			<div class="video" data-bind="
				visible: viewer.current_item().is_video(),
				html: viewer.video_tag()">
				<video ></video>
			</div>

			<div class="document" data-bind="visible: viewer.current_item().is_doc() && viewer.current_item().loaded()">
				<img data-bind="attr: { 
									src: viewer.current_item().is_doc() ? viewer.current_item().image_url() : ''									
								},
								css: {
									'scale-15': viewer.zoom() == 1.5,
									'scale-20': viewer.zoom() == 2
								}"/>
			</div>

			<div class="loader" data-bind="css: { 'show': ( viewer.current_item().is_image() || viewer.current_item().is_doc() ) && !viewer.current_item().loaded() }"></div>

		</div>
		<span class="left icon" data-bind="click: viewer.prev, css: { 'disabled': !viewer.allow_prev() }"><i class="fa fa-angle-left"></i></span>
		<span class="right icon" data-bind="click: viewer.next, css: { 'disabled': !viewer.allow_next() }"><i class="fa fa-angle-right"></i></span>

	</div>

</body>
</html>