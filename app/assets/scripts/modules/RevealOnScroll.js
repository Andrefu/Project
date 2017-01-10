import $ from 'jquery';
import waypoints from '../../../../node_modules/waypoints/lib/noframework.waypoints';

class RevealOnScroll{
	constructor(els, offset){
		//new properties. the ordering of the lines IS important
		this.itemsToReveal = els; //element to be revealed with the scrolling
		this.offsetPercentage = offset;
		this.hideInitially(); //running it at the beginning will allow the elements to be hidden initially
		this.createWaypoints();
	}
	
	//class that will initially hide elements
	hideInitially() {
		this.itemsToReveal.addClass("reveal-item"); //addClass is a jquery method
	}
	
	
	createWaypoints() {
		var that = this; //needed in order for the content of that to be correct
		this.itemsToReveal.each(function() { // ".each" allows to run code once for each element
			var currentItem = this;
			new Waypoint({  // Waypoint() is a class of waypoints
				element: currentItem, //DOM element that we want to watch for scrolling
				handler: function() { //What we want to happen when that element is scrolled to
					$(currentItem).addClass("reveal-item--is-visible");
				},
				offset: that.offsetPercentage //imposta la posizione dello scroll rispetto all'elemento in cui iniziare il waypoint
			});
		});
	}
}

export default RevealOnScroll;