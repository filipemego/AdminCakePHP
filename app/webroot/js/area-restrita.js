$(function() {
	$('.modal-calendario').on('show.bs.modal', function (e) {
		var url = $(this).data('href');
		$(this).find('.modal-body').html();
		$.ajax({
			url: url,
			dataType: 'html',
			success: function(data, textStatus, jqHXR) {
				console.log(jqHXR);
				if (jqHXR.status == 200) {
					$('.modal-calendario').find('.modal-body').html(data);
					$('[data-toggle="popover"]').popover({html:true});
				}
			}, error: function(data, textStatus, jqHXR) {
				console.log(data);
			}, always: function() {
				$('[data-toggle="popover"]').popover({html:true});
			}
		});
	});

	$('.modal-comunicado').on('show.bs.modal', function (e) {
		var url = $(this).data('href');
		$(this).find('.modal-body').html();
		$.ajax({
			url: url,
			dataType: 'html',
			success: function(data, textStatus, jqHXR) {
				console.log(jqHXR);
				if (jqHXR.status == 200) {
					$('.modal-comunicado').find('.modal-body').html(data);
					$('[data-toggle="popover"]').popover({html:true});
				}
			}, error: function(data, textStatus, jqHXR) {
				console.log(data);
			}, always: function() {
				$('[data-toggle="popover"]').popover({html:true});
			}
		});
	});

	$('.modal-rotina').on('show.bs.modal', function (e) {
		var url = $(this).data('href');
		$(this).find('.modal-body').html('');
		$.ajax({
			url: url,
			dataType: 'html',
			success: function(data, textStatus, jqHXR) {
				console.log(jqHXR);
				if (jqHXR.status == 200) {
					$('.modal-rotina').find('.modal-body').html(data);
					$('[data-toggle="popover"]').popover({html:true});
				}
			}, error: function(data, textStatus, jqHXR) {
				console.log(data);
			}, always: function() {
				$('[data-toggle="popover"]').popover({html:true});
			}
		});
	});

	$('.modal-cardapio').on('show.bs.modal', function (e) {
		var url = $(this).data('href');
		$(this).find('.modal-body').html('');
		$.ajax({
			url: url,
			dataType: 'html',
			success: function(data, textStatus, jqHXR) {
				console.log(jqHXR);
				if (jqHXR.status == 200) {
					$('.modal-cardapio').find('.modal-body').html(data);
					$('[data-toggle="popover"]').popover({html:true});
				}
			}, error: function(data, textStatus, jqHXR) {
				console.log(data);
			}, always: function() {
				$('[data-toggle="popover"]').popover({html:true});
			}
		});
	});

	$('.modal-galeria').on('show.bs.modal', function (e) {
		var url = $(this).data('href');
		$(this).find('.modal-body').html('');
		$.ajax({
			url: url,
			dataType: 'html',
			success: function(data, textStatus, jqHXR) {
				console.log(jqHXR);
				if (jqHXR.status == 200) {
					$('.modal-galeria').find('.modal-body').html(data);
					$('[data-toggle="popover"]').popover({html:true});
				}
			}, error: function(data, textStatus, jqHXR) {
				console.log(data);
			}, always: function() {
				$('[data-toggle="popover"]').popover({html:true});
			}
		});
	});

    $('.modal').on('hidden.bs.modal', function(event) {
    	$(this).removeClass('fv-modal-stack');
    	$('body').data('fv_open_modals', $('body').data('fv_open_modals') - 1);
    });

    $('.modal').on('show.bs.modal', function(e) {
    	var modalBody = $(this).find('.modal-body');
    	modalBody.html('<i class="fa fa-spinner fa-spin"></i>');
    	if ($(e.relatedTarget).data('href')) {
    		$(this).find('.modal-header').append($(e.relatedTarget).data('title'));
    		$(this).find('.modal-body').load($(e.relatedTarget).data('href'));
    	}
    });

    $('.modal').on('shown.bs.modal', function(event) {
    	// keep track of the number of open modals
    	if (typeof($('body').data('fv_open_modals')) == 'undefined') {
    		$('body').data('fv_open_modals', 0);
    	}
    	// if the z-index of this modal has been set, ignore.
    	if ($(this).hasClass('fv-modal-stack')) {
    		return;
    	}
    	$(this).addClass('fv-modal-stack');
    	$('body').data('fv_open_modals', $('body').data('fv_open_modals') + 1);
    	$(this).css('z-index', 1040 + (10 * $('body').data('fv_open_modals')));
    	$('.modal-backdrop').not('.fv-modal-stack')
    		.css('z-index', 1039 + (10 * $('body').data('fv_open_modals')));
    	$('.modal-backdrop').not('fv-modal-stack')
    		.addClass('fv-modal-stack');
    });
});