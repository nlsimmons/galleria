const fn = require('./functions.js')

fn.listen(
	'.button-delete-image',
	'click',
	function(e) {
		if( !confirm("Are you sure you want to delete this image?") )
			e.preventDefault()
	}
)
fn.listen(
	'.button-delete-album',
	'click',
	function(e) {
		if( !confirm("Are you sure you want to delete this album?") )
			e.preventDefault()
	}
)