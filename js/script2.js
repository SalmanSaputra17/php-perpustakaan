	// membuat event ketika keyword ditulis
	$('#keyword').on('keyup', function () {

		// munculkan loader
		// $('.loader').show();
		
		// proses ajax menggunakan load
		// $('#container').load('ajax/siswa.php?keyword=' + $('#keyword').val());

		// $.get()
		$.get('../ajax/buku.php?keyword=' + $('#keyword').val(), function (data) {

			$('#container').html(data);
			// $('.loader').hide();

		});
	
	});



