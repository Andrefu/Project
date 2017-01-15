import $ from 'jquery';
import waypoints from '../../../../node_modules/waypoints/lib/noframework.waypoints';
import smoothScroll from 'jquery-smooth-scroll';

class StickyHeader {
	constructor() {
		this.siteHeader = $(".site-header");
		this.headerTriggerElement = $(".large-hero__title"); //elemento che farà partire il waypoint
		this.createHeaderWaypoint();
		this.pageSections = $(".page-section");
		this.headerLinks = $(".primary-nav a");
		this.createPageSectionWaypoints();
		this.addSmoothScrolling();
	}
	
	//metodo per far scorrere lentamente in corrispondenza della sezione del sito
	addSmoothScrolling() {
		this.headerLinks.smoothScroll();
	}
	
	createHeaderWaypoint() {
		var that = this;
		new Waypoint({
			element: this.headerTriggerElement[0],		//JS expects a JS native DOM element but headerTriggerElement is jquery object
			handler: function(direction) {						//with [0] we can access the native DOM element of the jquery object.
					if (direction == "down") {
						that.siteHeader.addClass("site-header--dark");  //se lo scroll è verso il basso viene selezionata la classe site-header--dark
					}
					else {
						that.siteHeader.removeClass("site-header--dark"); //in tutti gli altri casi viene tolta la classe site-header--dark
					}
				}
		});
	}
	
	createPageSectionWaypoints() {
		var that = this;
		this.pageSections.each(function() {
			var currentPageSection = this;
			new Waypoint({
				element: currentPageSection,
				handler: function(direction) {
					if(direction == "down") {
						var matchingHeaderLink = currentPageSection.getAttribute("data-matching-link"); //getAttribute is a method to access attributes
						that.headerLinks.removeClass("is-current-link");
						$(matchingHeaderLink).addClass("is-current-link");
					}
				},
				offset: "18%"
			});
			
			new Waypoint({
				element: currentPageSection,
				handler: function(direction) {
					if(direction == "up") {
						var matchingHeaderLink = currentPageSection.getAttribute("data-matching-link"); //getAttribute is a method to access attributes
						that.headerLinks.removeClass("is-current-link");
						$(matchingHeaderLink).addClass("is-current-link");
					}
				},
				offset: "-40%"
			});
		});
	}
}

export default StickyHeader;