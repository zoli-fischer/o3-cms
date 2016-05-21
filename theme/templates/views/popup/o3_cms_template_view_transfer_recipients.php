<ul class="data-table">
	<li>
		<span>Recipient</span>
		<span class="text-right hidden-xs">Sent on</span>
		<span class="text-right hidden-xs">Downloaded on</span>
		<span class="text-center">Re-send</span>
	</li>
<?php
//show list of recipients
foreach ( $this->transfer->recipients() as $recipient ) {
?>
	<li>
		<span>
			<?php echo o3_html($recipient->get('email')); ?>
		</span>
		<span class="text-right">
			<?php echo o3_html($this->country()->format_date($recipient->get('sent'),true)); ?>
		</span>
		<span class="text-right">
			<?php echo $recipient->get('first_open') === null ? 'never' : o3_html($this->country()->format_date($recipient->get('first_open'),true)); ?>
		</span>
		<span class="text-center">
			<a href="javascript:{}" onclick="resend2recipient(<?php echo $recipient->get('id'); ?>,'<?php echo $this->transfer->get('canonical_id'); ?>')" title="Re-send" class="btn btn-small btn-primary"><i class="fa fa fa-paper-plane"></i></a>
		</span>		
	</li>
<?php
}
?>
</ul>

<script>
	//define function if not defined
	if ( typeof window.resend2recipient !== 'function' ) {
		//resend recepient email
		window.resend2recipient = function(recipient_id,transfer_id) {
			alert('Under construction');
			/*window.snapfer.ajax( 
				'resend2recipient', 
				{
					recipient_id: recipient_id,
					transfer_id: transfer_id
				}, 
				function(){
					alert('Success');
				},
				function(){ 
					alert('Error');
				},
				function(){
					alert('Error');
				});
			*/
		}
	};
</script>