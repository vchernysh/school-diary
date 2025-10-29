// JavaScript Document

$(document).ready(function() {

	$('.switch .slider').click(function() {
		var current_switch = $(this).parent('.switch').find('input[type="checkbox"]');
		if (current_switch.is(':checked'))
		{
			current_switch.attr('checked', false);
		} else {
			current_switch.attr('checked', true);
		}
	});

	$('.select-subject-marks').change(function() {
		$('.span-subject-marks-loading').html('<i class="fa fa-spinner fa-spin fa-1x fa-fw" aria-hidden="true"></i>');
	});

	$('.head-tr th[data-date-number]').mouseenter(function() {
		var number = parseInt($(this).data('date-number'));
		$('.my_tr > td[data-number-column="'+number+'"]').addClass('selected-cells');
	}).mouseleave(function() {
		var number = parseInt($(this).data('date-number'));
		$('.my_tr > td[data-number-column="'+number+'"]').removeClass('selected-cells');
	});


	$('.head-tr th[data-was-cell]').mouseenter(function() {

		var was_not = $(this).data('was-cell');
		$('.my_tr > td[data-was-not="'+was_not+'"]').addClass('selected-cells-was-not');
	}).mouseleave(function() {
		var was_not = $(this).data('was-cell');
		$('.my_tr > td[data-was-not="'+was_not+'"]').removeClass('selected-cells-was-not');
	});

	$(function () {
		$('[data-toggle="tooltip"]').tooltip({'html': true});
	});

	$('.fancybox').fancybox({
		'transitionIn'		: 'none',
		'transitionOut'		: 'none',
		'titlePosition' 	: 'inside',
		'titleFormat'       : function(title, currentArray, currentIndex, currentOpts) {
		    return '<span id="fancybox-title-over">' + title + '</span>';
		}
	});




	// var content_for_telegram_footer_bot = '<p>За допомогою даного бота ви зможете миттєво отримувати:</p>'+
	// 	'<ul>'+
	// 	'<li>Оцінки і різні повідомлення від викладачів</li>'+
	// 	'<li>Повідомлення від технічної підтримки</li>'+
	// 	'<li>Новини від директора школи або викладачів</li>'+
	// 	'<li>Інформацію про Вашу успішність</li>'+
	// 	'<li>Інформацію про Вас</li>'+
	// 	'<li>Інформацію про персонал школи</li>'+
	// 	'<li>Повідомлення про свята, день народження Ваших друзів і вчителів</li>'+
	// 	'<li>Та багато іншого</li>'+
	// 	'</ul>'+
	// 	'<p>І все це у вашому смартфоні, який завжди у вас під рукою.</p>'+
	// 	'<p class="popover_footer_p">Підключайся до нашої команди! <img src="/images/love-telegram.png" class="love-telegram" alt="Підключайся - і життя стане простіше!"></p>';
	
	// $('.footer_popover').popover({
	// 	'title': '<p style="text-align:center;margin-bottom:0;">Підключіть Telegram Bot системи <b>School Diary</b></p>',
	// 	'content': content_for_telegram_footer_bot,
	// 	'trigger': 'hover',
	// 	'html': true,
	// 	'placement': 'top',
	// });

	$('body').on('click', '.support_chat .panel-footer .send_message_to_support', function() {
		var message = $('.support_chat .panel-footer #btn-input');
		if (message.val().length == 0) {
			message.mouseenter();
		} else {
			message.mouseleave();
			$('.support_chat .panel-footer .send_message_to_support').attr('disabled', true).html('<i class="fa fa-spinner fa-spin fa-1x fa-fw" aria-hidden="true"></i>');
		}
	});

	$('body').on('keyup', '.support_chat .panel-footer #btn-input', function(event) {

		var x = event.which || event.keyCode;
		if (x == 13) {
			if ($('.support_chat .panel-footer .send_message_to_support').attr('disabled') === undefined || $('.support_chat .panel-footer .send_message_to_support').attr('disabled') == false) {
				$('.support_chat .panel-footer .send_message_to_support').click();
			}
		}

	});

	
	$('body').on('click', '.icon_press_to_bottom', function() {
		$('html, body').animate({
		    scrollTop: $('.scrollTopOffset').offset().top
		}, 1000);
	});

	setTimeout(function() {
		$('div.alert button.close').click();
	}, 10000);

	// END $(document).ready(function() {});
});