import MobileMenu from './modules/MobileMenu';
import RevealOnScroll from './modules/RevealOnScroll';
import $ from 'jquery';
import StickyHeader from './modules/StickyHeader';
import Modal from './modules/Modal';

//new instances of the classes (names with lower case letters)
 var mobileMenu = new MobileMenu();
 //in order to have different fading points for the feature-item and the testimonials, 2 differente instances of RevealOnScroll
 //are necessary
 new RevealOnScroll($(".feature-item"), "85%");
 new RevealOnScroll($(".testimonial"), "60%"); 
 var stickyHeader = new StickyHeader();
 var modal = new Modal();
 
 