jQuery(document).ready(function(){
    var $ = jQuery,
    	$transfers = $('#transfers');

    if ( $transfers.length > 0 ) {

    	$transfers.find('.success-msg').parent().delay(5000).fadeOut();

    	//set copy to clipboard link
	    $transfers.find('.copy-link').click(function(event){
	    	var $this = $(this);

	    	//stop event devault
	    	event.preventDefault();

	    	//copy to clipboard
	    	try {
				var $d = $this.prev();
				$d.focus();
				$d.select();
				document.execCommand("copy");
				alert('The download link has been copied.');
			} catch (n) {};
	    });

	    //set share links
	    $transfers.find('.share-link').click(function(event){	   		
	   		var $this = $(this),
	   			$parent = $(this).parents('li'),
	   			title = $parent.data('title'),
                desc = $parent.data('desc'),
	   			url = $parent.find('.open-link').attr('href'),
	   			type = 'facebook';

	   		//stop event devault
	    	event.preventDefault();

	    	//get type
            if ( $this.hasClass('btn-google') ) {
                type = 'google'; 
                title = '';                       
                desc = '';
            } else if ( $this.hasClass('btn-twitter') ) {
                type = 'twitter';                                       
            } else if ( $this.hasClass('btn-linkedin') ) {
                type = 'linkedin';
            } else if ( $this.hasClass('btn-facebook') ) {
                type = 'facebook';
                title = '';                       
                desc = '';
            }

	    	//share url
	    	share( url, type, title, desc  );
	   	});

	    //set delete buttons
	   	$transfers.find('.delete-link').click(function(event){	   		
	   		var $this = $(this),
	   			transfer_id = $this.data('transfer-id');

	   		//stop event devault
	    	event.preventDefault();

	    	if ( confirm('Are you sure you want to delete this transfer?') ) {

	    		window.snapfer.ajax( 
	    			'delete_transfer',
	    			{
	    				id: transfer_id
	    			},
	    			function( event ) {},
	    			function( event ) {
	    				alert('An error occurred. Please try again.');
	    			},
	    			function( event ) {
	    				alert('An error occurred. Please try again.');
	    			}
	    		);
 
	    	};

	   	});	   	

	};

});