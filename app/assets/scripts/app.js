import MobileMenu from './modules/MobileMenu';
import RevealOnScroll from './modules/RevealOnScroll';
import $ from 'jquery';

//new instances of the classes (names with lower case letters)
 var mobileMenu = new MobileMenu();
 
 //in order to have differente fading points for the feature-item and the testimonials, 2 differente instances of RevealOnScroll
 //are necessary
 new RevealOnScroll($(".feature-item"), "85%");
 new RevealOnScroll($(".testimonial"), "60%");
 
 