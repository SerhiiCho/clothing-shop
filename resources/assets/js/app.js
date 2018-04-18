import { setInterval } from 'core-js';

/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */


window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('banner', require('./components/Banner.vue'));
Vue.component('items', require('./components/Items.vue'));

const app = new Vue({
    el: '#app'
});

/**
 * JQUERY SUCKS
 */

var opened = false

$('#hamburger').on('click', function() {
	$('#nav-menu').css('top', '0');
	$('#hamburger-container').css('opacity', '0');
    opened = true
});

$('#close-nav-menu').on('click', function() {
	$('#nav-menu').css('top', '-25em');
	$('#hamburger-container').css('opacity', '0.9');
	opened = false
});

$('#close-popup-form-btn').on('click', function() {
	$('#popup-callback').css('top', '-20em');
	$('#overlay').css('opacity', '0');

	setTimeout(() => $('#overlay').css('display', 'none'), 400)
	setTimeout(()=> $('#aim-for-message').empty(), 1000);
});

$(window).scroll(function() {
    if (document.body.scrollTop > 100 || document.documentElement.scrollTop > 100) {
		$('#logo-clothing').css('opacity', '0');
		$('#logo-clothing').css('display', 'none');
		$('#hamburger-container').addClass('hamburger-down');
    } else {
		$('#logo-clothing').css('opacity', '1');
		$('#hamburger-container').removeClass('hamburger-down');
		setTimeout(() => $('#logo-clothing').css('display', 'block'), 250)
    }
});

function openPopup() {
	$('#popup-callback').css('top', '2em');
	$('#overlay').css('display', 'block');
	setTimeout(() => $('#overlay').css('opacity', '1'), 50);
}

$('#nav-callback').on('click', openPopup);
$('#header-callback').on('click', openPopup);

// Contact form
jQuery( document ).ready( function($) {
	$( '#clothingshopContactForm' ).on( 'submit', function(e){
		e.preventDefault();

		if ($( '#aim-for-message' ).html() != "") {
			$( '#aim-for-message' ).empty();
		}

		var name = $( this ).find( '#name' ).val();
		var number = $( this ).find( '#number' ).val();
		var ajaxurl = $( this ).data( 'url' );
		var filter = /^[0-9-+]+$/;

		// If empty
		if ( name === '' || number === '' ) {
			$('#aim-for-message').html('<p class="message center">Все поля дожны быть заполнены</p>');
			return;
		}

		// Validate number
		if ( number.length < 13 || !filter.test( number ) ) {
			$('#aim-for-message').html('<p class="message center">Не правильный формат номера телефона</p>');
			return;
		}

		$.ajax({
			url: ajaxurl,
			type: 'post',
			data: {
				name: name,
				number: number,
				action: 'clothingshop_save_user_contact_form'
			},
			error: function( response ) {
				console.log( response );
			},
			success: function ( response ) {

				if ( response == 0 ) {
					$('#aim-for-message').html('<p class="message center">Произошла ошибка при попытке отправить сообщение</p>');
				} else if ( response == 'error' ) {
					$('#aim-for-message').html('<p class="message center">Вы уже отправили сообщение</p>');
				} else {
					$('#clothingshopContactForm').attr('style', 'display: none');
					$('#aim-for-message').html('<p class="message center">Спасибо, сообщение отправленно</p>');
					setTimeout(()=> $('#clothingshopContactForm').attr('style', 'display: block'), 2000);
					setTimeout(()=> closePopup(), 2000);
					setTimeout(()=> $('#aim-for-message').empty(), 2000);
				}
			}
		});
	});
});
