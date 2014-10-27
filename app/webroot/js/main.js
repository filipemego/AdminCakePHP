$(function() {
	
	var timeoutSub;
	$('.right-navbar > li').each(function(i, el) {
		if ($(el).children('.sub-nav-wrapper').length) {
			$(el).on('mouseenter', function(e) {
				$(el).children('.sub-nav-wrapper').stop().slideDown();
			}).on('mouseleave', function(e) {
				$('.sub-nav-wrapper').stop().slideUp();
			});
		}
	});

	// GALERIA
	var SCROLLER = {
		scrollTimer: null,
		wrapper: $('.carousel-galeria'),
		content: $('.galeria-content'),
		wrapperWidth: 0,
		contentWidth: 0,
		timer: null,
		events: {
			interval: function() {
				SCROLLER.timer = setInterval(function() {
					$('.carousel-galeria .galeria-controls a.galeria-right').click();
				}, 7000);
			},
			controls: {
				left: $(document).on('click', '.carousel-galeria .galeria-controls a.galeria-left', function( e ) {
					e.preventDefault();
					SCROLLER.scrollLeft();
				}),
				right: $(document).on('click', '.carousel-galeria .galeria-controls a.galeria-right', function( e ) {
					e.preventDefault();
					SCROLLER.scrollRight();
				})
			},
			resize: null
		},
		init: function() {
			SCROLLER.events.interval();
		},
		scrollRight: function() {
			SCROLLER.stop();
			var active = SCROLLER.content.find('.active'),
				next  = active.next();

			if (!next.length) {
				SCROLLER
					.content
					.find('.galeria-item:first')
					.addClass('fading')
					.animate({
						opacity: 1,
						width: '100%',
						height: '100%',
						top: 0,
						left: 0
					}, 1000, function() {
						active
							.css({
								'width': '120%',
								'height': '120%',
								'top': '-10%',
								'left': '-10%',
								'opacity': 0
							})
							.removeClass('active');
						$(this).removeClass('fading').addClass('active');
					});
			} else {
				next
					.addClass('fading')
					.animate({
						opacity: 1,
						width: '100%',
						height: '100%',
						top: 0,
						left: 0
					}, 1000, function() {
						active
							.css({
								'width': '120%',
								'height': '120%',
								'top': '-10%',
								'left': '-10%',
								'opacity': 0
							})
							.removeClass('active');
						$(this).removeClass('fading').addClass('active');
					});
			}
			SCROLLER.content.find('.galeria-item').each(function(index, el) {
				if ($(this).hasClass('fading')) {
					n = $(this).index()+1;
					$('.galeria-text').text($(this).data('title'));
				}
			});
			$('.galeria-caption-active').text(n);
			SCROLLER.events.interval();
		},
		scrollLeft: function() {
			SCROLLER.stop();
			var active = SCROLLER.content.find('.active'),
				prev  = active.prev();

			if (!prev.length) {
				SCROLLER
					.content
					.find('.galeria-item:last')
					.addClass('fading')
					.animate({
						opacity: 1,
						width: '100%',
						height: '100%',
						top: 0,
						left: 0
					}, 1000, function() {
						active
							.css({
								'width': '120%',
								'height': '120%',
								'top': '-10%',
								'left': '-10%',
								'opacity': 0
							})
							.removeClass('active');
						$(this).removeClass('fading').addClass('active');
					});
			} else {
				prev
					.addClass('fading')
					.animate({
						opacity: 1,
						width: '100%',
						height: '100%',
						top: 0,
						left: 0
					}, 1000, function() {
						active
							.css({
								'width': '120%',
								'height': '120%',
								'top': '-10%',
								'left': '-10%',
								'opacity': 0
							})
							.removeClass('active');
						$(this).removeClass('fading').addClass('active');
					});
			}
			SCROLLER.content.find('.galeria-item').each(function(index, el) {
				if ($(this).hasClass('fading')) {
					n = $(this).index()+1;
					$('.galeria-text').text($(this).data('title'));
				}
			});
			$('.galeria-caption-active').text(n);
			SCROLLER.events.interval();
		},
		stop: function() {
			clearInterval(SCROLLER.timer);
		}
	}
	SCROLLER.init();
	
    $(document).keydown(function(e){
		switch (e.which) {
			case 37:
				SCROLLER.scrollRight();
				break;
				
			case 39:
				SCROLLER.scrollLeft();
				break;
		}
       $('#keypress_con').text(e.which);
    });

    $('.modal-home').modal();

    $(document).on('submit', '.modal-login form', function(e) {
    	e.preventDefault();
    	var data = {
    		'data[User][username]': $('[name="data[User][username]"]').val(),
    		'data[User][password]': $('[name="data[User][password]"]').val()
    	}

    	$.ajax({
    		url: $(this).attr('action'),
    		type: 'post',
    		dataType: 'json',
    		data: data,
    		success: function(data, textStatus, jqXHR) {
    			console.log(data);
    			if (data.status) {
    				location.href = '/dev/area-restrita';
    			} else {
    				$('.modal-login form').prepend('<div class="alert alert-danger">Usuário ou senha incorretos.</div>')
    				$('.modal-login form').find('.alert').delay(5000).fadeOut(function(){$(this).remove()})
    			}
    		}, error: function(data, textStatus, jqXHR) {
    			console.log(data);	
    		}, always: function() {
    			alert('always');
    		}
    	});
    });

    $(document).on('submit', '.modal-contato form', function(e) {
    	var data = $(this).serializeArray();
    	e.preventDefault();
    	$.ajax({
    		url: $(this).attr('action'),
    		type: 'post',
    		dataType: 'json',
    		data: data,
    		success: function(data, textStatus, jqXHR) {
    			console.log(data);
    			if (data.status) {
    				$('.modal-contato form').prepend('<div class="alert alert-success">Mensagem enviada com sucesso. Aguarde o contato.</div>');
    				$('.modal-contato form').find('.alert').delay(5000).fadeOut(function(){$(this).remove()});
    			} else {
					for (var i in data.errors) {
						$('[name="data[Contato]['+i+']"]').after('<span class="text-danger">'+data.errors[i][0]+'</span>');
						$('[name="data[Contato]['+i+']"]').next('.text-danger').delay(7000).fadeOut(function(){$(this).remove()});
					}
    			}
    		}, error: function(data, textStatus, jqXHR) {
				$('.modal-contato form').prepend('<div class="alert alert-danger">Erro ao enviar mensagem. Por favor, tente novamente.</div>');
				$('.modal-contato form').find('.alert').delay(5000).fadeOut(function(){$(this).remove()});
    		}, always: function() {

    		}
    	});
    });

	$(window).resize(function() {		
	    $('.content-body')
			.height( function() {
				var offset = $('.content-body').offset().top,
					windowH = $('body').height();
				if (windowH > 992) {
					return (windowH - offset) - 150 + 'px'
				}
			});

        // update perfect scrollbar
        $('.content-body').perfectScrollbar('update');
	});

	if (!jQuery.browser.mobile) {
	    $('.content-body').perfectScrollbar({
	    	suppressScrollX: true
	    });
	}

	$('.content-body')
		.height( function() {
			var offset = $('.content-body').offset().top,
				windowH = $('body').height();
			if ($('body').width() > 992) {
				return (windowH - offset) - 150 + 'px'
			}
		});
});