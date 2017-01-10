import $ from 'jquery';

class MobileMenu {
	constructor() { //parte eseguita subito appena la classe viene chiamata
	
		//new properties
		this.siteHeader = $(".site-header"); //selects the entire header element from the DOM
		this.menuIcon = $(".site-header__menu-icon"); //selezione dell'elemento icona del menu
		this.menuContent = $(".site-header__menu-content");
		this.events(); //to initiate the events
	}
	
	//lista di eventi da monitorare
	events() {
		this.menuIcon.click(this.toggleTheMenu.bind(this)); // ".click()" è un metodo jquery
	}
	
	toggleTheMenu() {
		this.menuContent.toggleClass("site-header__menu-content--is-visible");
		this.siteHeader.toggleClass("site-header--is-expanded");
		this.menuIcon.toggleClass("site-header__menu-icon--close-x");
	}
}

export default MobileMenu; //per esportare la classe all'esterno