jQuery(document).ready(function(){
    var $ = jQuery,
    	$transfer = $('#transfer-view');

    if ( $transfer.length > 0 ) {
	
		//init audio players
    	$transfer.find('.audio-player').each(function(){
    		var self = this;

    		self.$this = $(this);
    		self.$play = self.$this.find('.play');
    		self.$stop = self.$this.find('.stop');
    		self.audio = self.$this.find('audio')[0];
    		self.is_html5_audio = self.$this.find('.no-html5-audio').length == 0;
    		self.is_playing = false;

    		//if no html5 support hide play button
    		if ( self.is_html5_audio )
    			self.$this.addClass('no-html5-audio');

    		//on audio player playing
    		self.$this.on('audio-player-playing',function(){
    			self.$this.addClass('playing');
    		});

    		//on audio player stopped
    		self.$this.on('audio-player-stopped',function(){
    			self.$this.removeClass('playing');
    		});

    		//on play click start play
    		self.$play.click(function(event){
    			self.audio.play();
    			event.preventDefault();
    		});

    		//on stop click stop play
    		self.$stop.click(function(event){
    			self.audio.pause();
                self.audio.currentTime = 0;
    			event.preventDefault();
    		});

    		//check audio status
    		setInterval(function(){
    			var playing = !self.audio.paused || self.audio.currentTime;    			
    			if ( playing != self.is_playing ) {
    				self.$this.trigger( playing ? 'audio-player-playing' : 'audio-player-stopped' );
    				self.is_playing = playing;
    			};
    		},100);

    	});

        //set share links
        $transfer.find('.share-link').click(function(event){           
            var $this = $(this),
                $parent = $(this).parent(),
                title = $parent.data('title'),
                desc = $parent.data('desc'),
                url = $(this).attr('href'),
                type = false;

            //stop event devault
            event.preventDefault();

            //get type
            if ( $this.hasClass('btn-google') ) {
                type = 'google';
            } else if ( $this.hasClass('btn-twitter') ) {
                type = 'twitter';                                       
            } else if ( $this.hasClass('btn-linkedin') ) {
                type = 'linkedin';
            } else if ( $this.hasClass('btn-facebook') ) {
                type = 'facebook';
            }

            //share url
            if ( type !== false )
                share( url, type, title, desc );
        });

	};

});