jQuery(document).ready(function() {

    $('a.colorbox').colorbox({
        loop: false,
		minWidth: 400,
		minHeight: 300,
        maxWidth: '100%',
        maxHeight: '100%',
		current: "slika {current} od {total}",
		previous: "nazaj",
		next: "naprej",
		close: "zapri",
		xhrError: "Prislo je do napake.",
		imgError: "Prislo je do napake.",
        title: function(){
            return $('img', this).attr('title');
        }
    });
	
	$('.gallery a').colorbox({
		rel: 'gallery',
        loop: false,
		minWidth: 400,
		minHeight: 300,
        maxWidth: '100%',
        maxHeight: '100%',
		current: "slika {current} od {total}",
		previous: "nazaj",
		next: "naprej",
		close: "zapri",
		xhrError: "Prislo je do napake.",
		imgError: "Prislo je do napake."
		/*title: function(){
            return $('img', this).attr('title');
        }*/
    });

});