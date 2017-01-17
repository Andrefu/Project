import $ from 'jquery';

class  Modal {
	constructor() {
		this.openModalButton = $(".open-modal");
		this.modal = $(".modal");
		this.closeModalButton = $(".modal__close");
		this.events();
	}
	
	events() {
		//clicking the open modal button
		this.openModalButton.click(this.openModal.bind(this));  //.click() is a jquery method.The argument in () is what we want it to execute
		//clicking the x close modal button
		this.closeModalButton.click(this.closeModal.bind(this)); // .bind(this) keeps the this keyword to its value otherwise its changed
		//push any key on keyboard
		$(document).keyup(this.keyPressHandler.bind(this)); //$(document) selects entire document
	}
	
	keyPressHandler(e) {
		if(e.keyCode == 27) { //escape key has a value of 27
			this.closeModal();
		}
	}
	
	openModal() {
		this.modal.addClass("modal--is-visible");
		return false; //when a href has the #, return false prevents the page from scrolling up to the top
	}
	
	closeModal() {
		this.modal.removeClass("modal--is-visible");
	}
}

export default Modal;