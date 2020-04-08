jQuery(document).ready(function($) {
	$('#keyword').on('input', function() {
		var searchKeyword = $(this).val();
		if (searchKeyword.length >= 3) {
			$.post('search.php', { keywords: searchKeyword }, function(data) {
				$('ul#content').empty().addClass('active');
				$.each(data, function() {
					$('ul#content').append('<li>' + this.food_name + " " + this.food_category + " " + this.food_time + '</li>');
				});
			}, "json");
		} else {
			$('ul#content').empty().removeClass('active');
		}
	});
});
