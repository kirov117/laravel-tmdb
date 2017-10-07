let home = {
	movieDetailsModal: function() {
		var btn     = $(this),
			modal   = $('#movie-details-modal'),
			section = modal.find('.modal-section'),
			loader  = modal.find('.modal-loader'),
			title   = btn.closest('tr').find('.original-title').text();

		modal
			.modal('show')
			.find('.modal-title span')
				.text(title);

		section.load(btn.data('url'), function() {
			loader.fadeOut(function() {
				section.fadeIn();
			});
		});
	},
	onMovieDetailsModalHidden: function() {
		var modal   = $(this),
			section = modal.find('.modal-section'),
			loader  = modal.find('.modal-loader');

		loader.show();
		section.hide();
	}
};

$(document)
	.on('click', '.movie-details-link', home.movieDetailsModal)
	.on('hidden.bs.modal', '#movie-details-modal', home.onMovieDetailsModalHidden);

