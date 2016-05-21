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

		//insert Google Analytics code
		$this->ga_script();
		
		//load header
		$this->view( 'o3_cms_template_view_header' );
		
	?>

			<div id="transfers">
				
				<div class="container">
					<div class="row">

						<div class="col-md-12">
						
							<h2>
								<?php echo $this->logged_user->is_premium() ? 'Your storage' : 'Transfer history'; ?>
							</h2>
							<div class="<?php echo $this->logged_user->is_premium() ? '' : 'none'; ?>">
								<div class="clearfix-xs"></div>
								<h3><?php echo o3_bytes_display('vU',$this->logged_user->storage_free()); ?> free from <?php echo o3_bytes_display('vU',$this->logged_user->storage()); ?></h3>
							</div>
							
						</div>

						<div class="clearfix-lg"></div>

						<div class="col-md-12 white-box">
							<div>
								<h3>Transfers <a href="<?php echo $this->o3_cms()->page_url( TRANSFERS_HISTORY_PAGE_ID ); ?>" title="Refresh"><i class="fa fa-refresh"></i></a></h3>
								<small class="<?php echo $this->logged_user->is_premium() ? '' : 'none'; ?>"><?php echo o3_bytes_display('vU',$this->logged_user->storage_free()); ?> free from <?php echo o3_bytes_display('vU',$this->logged_user->storage()); ?></small>
								
								<div class="clearfix-sm"></div>

								<?php

								if ( $this->show_deleted_message() ) {
								?>
									<div class="form">
										<div class="success-msg block">The transfer was deleted.</div>
									</div>
								<?php	
								}

								$transfers = $this->logged_user()->get_transfers();
								if ( count($transfers) > 0 ) {
								?>	
									<ul class="data-table">
										<li>
											<span>Description / Created on</span>
											<span data-bind="visible: !logged_user.is_premium()">Expires on</span>
											<span class="text-right hidden-xs">Files</span>
											<span class="text-right hidden-xs">Size</span>
											<span class="text-right hidden-xs">Downloads</span>
											<span class="text-center">&nbsp;</span>
										</li>
										<?php
										foreach ( $transfers as $transfer ) {
											$files = $transfer->files_count();
											$downloads = $transfer->downloads();
											?>
											<li data-title="<?php echo o3_html($transfer->share_title()); ?>" data-desc="<?php echo o3_html($transfer->share_desc()); ?>" data-transfer-id="<?php echo o3_html($transfer->get('canonical_id')); ?>" />
												<span>
												<?php
													switch ($transfer->get('way')) {
														case SNAPFER_TRANSFER_EMAIL:
															$recipients = $transfer->recipients();														
															$recipients_count = count($recipients);
															echo 'Sent via email to <a href="javascript:{}" class="recipients-popup" title="'.$recipients_count.' '.( $recipients_count == 1 ? 'recipient' : 'recipients' ).'">'.$recipients_count.' '.( $recipients_count == 1 ? 'recipient' : 'recipients' ).'</a> on '.$this->logged_user()->format_date( $transfer->get('created'), true );
															break;	
														case SNAPFER_TRANSFER_SOCIAL:
															echo 'Uploaded for sharing on social medias on '.$this->logged_user()->format_date($transfer->get('created'), true );
															?>
															<br>Share on:<br>
															<a href="#" class="btn btn-facebook btn-small share-link"><i class="fa fa-facebook"></i> Facebook</a><a href="#" class="btn btn-small btn-google share-link"><i class="fa fa-google-plus"></i> Google+</a><a href="#" class="btn btn-small btn-twitter share-link"><i class="fa fa-twitter"></i> Twitter</a><a href="#" class="btn btn-small btn-linkedin share-link"><i class="fa fa-linkedin"></i> Linkedin</a>
															<?php
															break;
														default:
														case SNAPFER_TRANSFER_DOWNLOAD:
															echo 'Uploaded for grabbing download link on '.$this->logged_user()->format_date($transfer->get('created'), true );
															?>
															<br>
															Download link:<br>
															<input type="text" readonly="readonly" value="<?php echo o3_html($transfer->url()); ?>" onclick="jQuery(this).focus(), jQuery(this).select()" class="transfer-list-input" />
															<a href="#" class="btn btn-small copy-link">Copy link</a>
															<?php
															break;
													}
												?>													
												</span>
												<span data-bind="visible: !logged_user.is_premium()"><?php echo $this->logged_user()->format_date($transfer->get('expire'), true ); ?></span>
												<span class="text-right nobr hidden-xs"><a href="javascript:{}" class="files-popup" title="<?php echo $files.' '.( $files == 1 ? 'file' : 'files' ); ?>"><?php echo $files.' '.( $files == 1 ? 'file' : 'files' ); ?></a></span>
												<span class="text-right nobr hidden-xs"><?php echo o3_bytes_display('vU',$transfer->size()); ?></span>
												<span class="text-right nobr hidden-xs"><?php echo $transfer->downloads().' '.( $downloads == 1 ? 'download' : 'downloads' ); ?></span>
												<span class="text-center">
													
													<div class="visible-xs-block">
														<div class="nobr"><?php echo $files.' '.( $files == 1 ? 'file' : 'files' ); ?></div>
														<div class="nobr"><?php echo o3_bytes_display('vU',$transfer->size()); ?></div>
														<div class="nobr"><?php echo $transfer->downloads().' '.( $downloads == 1 ? 'download' : 'downloads' ); ?></div>
														<div class="clearfix-xs"></div>
													</div>

													<a href="<?php echo o3_html($transfer->zip_url()); ?>" title="Download all files" class="btn btn-small btn-primary"><i class="fa fa-cloud-download"></i></a>
													<a href="<?php echo o3_html($transfer->url()); ?>" title="Open" target="_blank" class="btn btn-small open-link"><i class="fa fa-link"></i></a>
													<a href="#" class="btn btn-small btn-danger delete-link" title="Delete"><i class="fa fa-trash"></i></a>

												</span>
											</li>
											<?php
										}
										?>
									</ul>
								<?php
								} else {
								?>	
									<p>There is no transfers to show.</p>
								<?php
								}
								?>


								<div class="clearfix-m"></div>

								<a href="/#" class="btn"><i class="fa fa-cloud-upload"></i> Send files</a>

							</div>
						</div>


					</div>
				</div>
			</div>

	<?php

		//load header
		$this->view( 'o3_cms_template_view_footer' );

	?>

</body>
</html>