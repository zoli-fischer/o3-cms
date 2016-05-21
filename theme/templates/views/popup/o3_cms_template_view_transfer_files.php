<ul class="data-table">
	<li>
		<span>Filename</span>
		<span class="text-right hidden-xs">Size</span>
		<span class="text-right hidden-xs">Downloads</span>
		<span class="text-center">&nbsp;</span>
	</li>

<?php
//show list of files
foreach ( $this->transfer->files() as $file ) {
?>
	<li>
		<span>
			<?php echo o3_html($file->get('name')); ?>
		</span>
		<span class="text-right">
			<?php echo o3_bytes_display('vU',$file->size()); ?>
		</span>
		<span class="text-center">
			<?php echo intval($file->get('downloads')); ?>
		</span>
		<span class="text-center">
			<a href="<?php echo o3_html($file->url()); ?>" title="Download" class="btn btn-small btn-primary"><i class="fa fa-cloud-download"></i></a>
		</span>		
	</li>
<?php
}
?>
</ul>