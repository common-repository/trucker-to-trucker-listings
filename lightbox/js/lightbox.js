/*  Copyright 2013 Trucker To Trucker      This file is part of Trucker To Trucker.    Trucker To Trucker is free software: you can redistribute it and/or modify    it under the terms of the GNU General Public License as published by    the Free Software Foundation, either version 3 of the License, or    (at your option) any later version.    Trucker To Trucker is distributed in the hope that it will be useful,    but WITHOUT ANY WARRANTY; without even the implied warranty of    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the    GNU General Public License for more details.    You should have received a copy of the GNU General Public License    along with Trucker To Trucker.  If not, see <http://www.gnu.org/licenses/>.*/(function($) {

	// Initialize the Lightbox for any links with the 'fancybox' class
	$(".fancybox").fancybox();
	
	// Initialize the Lightbox automatically for any links to images with extensions .jpg, .jpeg, .png or .gif
	$("a[href$='.jpg'], a[href$='.png'], a[href$='.jpeg'], a[href$='.gif']").fancybox();
	
	// Initialize the Lightbox and add rel="gallery" to all gallery images when the gallery is set up using [gallery link="file"] so that a Lightbox Gallery exists
	$(".gallery a[href$='.jpg'], .gallery a[href$='.png'], .gallery a[href$='.jpeg'], .gallery a[href$='.gif']").attr('rel','gallery').fancybox();
	
	// Initalize the Lightbox for any links with the 'video' class and provide improved video embed support
	$(".video").fancybox({
		maxWidth		: 800,
		maxHeight		: 600,
		fitToView		: false,
		width			: '70%',
		height			: '70%',
		autoSize		: false,
		closeClick		: false,
		openEffect		: 'none',
		closeEffect		: 'none'
	});
	
})(jQuery);