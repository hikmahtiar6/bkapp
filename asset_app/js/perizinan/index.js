window.PERIZINAN = (function($) {

	return {
		init: function() {
		},

		handleSavePerizinan: function(formEl, dokEl, syaratEl) {
			$(formEl).submit(function(e) {
				e.preventDefault();

				var formData = new FormData($(formEl)[0]);

				$.ajax({
					url: $(this).attr('action'),
					type: 'POST',
					data: {
						dokumen_id: $(dokEl).serializeArray(),
						syarat_id: $(syaratEl).serializeArray()
					},
					beforeSend: function() {
						$(formEl).find('input[type="submit"]').val("Harap tunggu...");
						$(formEl).find('input[type="submit"]').attr('disabled', 'disabled');
					},
					success: function() {
						$(formEl).find('input[type="submit"]').removeAttr('disabled');
						$(formEl).find('input[type="submit"]').val("Simpan");
					}
				});

			});
		}
	}


})(jQuery);