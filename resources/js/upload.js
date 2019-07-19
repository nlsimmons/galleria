const fn = require('./functions.js')
const EXIF = require('exif-js')

fn.listen(
	'#add-image-button',
	'click',
	function(e) {
		if( fn.qs('#add-image-modal') )
			fn.qs('#add-image-modal').classList.add('is-active')
	}
)
fn.listen(
	'#add-image-modal .modal-background',
	'click',
	function(e) {
		if( fn.qs('#add-image-modal') )
			fn.qs('#add-image-modal').classList.remove('is-active')
	}
)

fn.listen(
	'#add-image-simple',
	'change',
	function(e) {
		let images = fn.qs('#add-image-simple').files
		let album_id = fn.qs('#album_id') ? fn.qs('#album_id').value : ''

		let upload_count = images.length
		let uploads_complete = 0

		let uri = album_id ? `/upload/album/${album_id}/image` : '/upload/image'

		for(let image of images) {
			fn.request('post', uri, { image } )
				.then( res => {
					console.log(res)
					fn.notify('success', 'Image uploaded')
				})
				.catch( err => {
					uploads_complete++
					fn.notify('error', 'An error occurred')
					console.log(err)
				})
				.finally( () => {
					if( ++uploads_complete >= upload_count )
					{
						window.location.reload()
					}
				})
		}
	}
)

if( fn.qs('#dragndrop') && can_drag_upload() )
{
    fn.qs('#dragndrop').classList.remove('disabled')
    fn.qs('#no-dragndrop').classList.add('disabled')

    fn.listen(
    	'.draggable',
    	'drag dragstart dragend dragover dragenter dragleave drop',
    	function(e) {
    		e.preventDefault();
    		e.stopPropagation();
    	}, true
    )
    fn.listen(
    	'.draggable',
    	'dragover dragenter',
    	function(e) {
    		document.querySelectorAll('.draggable').forEach( el => {
    			el.classList.add('is-dragover')
    		})
    	}, true
	)
	fn.listen(
    	'.draggable',
    	'dragleave dragend drop',
    	function(e) {
    		document.querySelectorAll('.draggable').forEach( el => {
    			el.classList.remove('is-dragover')
    		})
    	}, true
	)
    fn.listen(
    	'.draggable',
    	'drop',
    	function(e) {
    		loadFiles(e.dataTransfer.files)

    		fn.qs('.uploads-active').classList.remove('uploads-active')
    		fn.qs('#uploads__staging').classList.add('uploads-active')

    	}, true
    )

    fn.listen(
		'input#new-image',
		'change',
		function() {
			let files = fn.qs('input#new-image').files
			loadFiles(files)

			fn.qs('.uploads-active').classList.remove('uploads-active')
			fn.qs('#uploads__staging').classList.add('uploads-active')
		}
	)

	fn.listen(
		'document .img-delete',
		'click',
		function(e) {
			fn.parent(e, '.img-preview-container').remove()
		}
	)

	fn.listen(
		'button#upload-album-button',
		'click',
		submitNewAlbum
	)
	fn.listen(
		'button#upload-image-button',
		'click',
		submitNewImage
	)

	fn.qs('#uploads__initial').classList.add('uploads-active')
}

/* * * * Functions * * * */

function submitNewImage() {
	//
}

function submitNewAlbum() {

	fn.request('POST', '/upload/album/new', {
		title: fn.qs('#upload-title').value
	})
	.then( JSON.parse )
	.then( res => {

		let id = res.id
		fn.qsa('img.img-preview').forEach( el => {
			fn.request('POST', `/upload/album/${id}`, {
				image: el.src
			})
			.then(res => {
				console.log(res)
			})
			.catch(err => {
				console.log(err)
			})
		})
	})
}

function can_drag_upload() {
    return function() {
        let div = document.createElement('div');
        return ('draggable' in div) || ('ondragstart' in div && 'ondrop' in div)
    }() && function() {
        return 'FormData' in window;
    }() && function () {
        return 'FileReader' in window;
    }()
}

function loadFiles(files) {
	for(let file of files)
	{
		let container = document.createElement('div')
		container.classList.add('img-preview-container')
		fn.qs('#uploads__staging #upload-images').append(container)

		EXIF.getData(file, function() {
			let orientation = this.exifdata.Orientation
			let fr = new FileReader();

			fr.onload = function() {
	    		resetOrientation(this.result, orientation, appendImage, container)
	    	}

		    fr.readAsDataURL(file);
		})
	}
}

// Taken from StackOverflow
function resetOrientation(srcBase64, srcOrientation, callback, container) {
  	var img = new Image();

  	img.onload = function() {
    	var width = img.width,
        	height = img.height,
        	canvas = document.createElement('canvas'),
        	ctx = canvas.getContext("2d");

	    // set proper canvas dimensions before transform & export
	    if (4 < srcOrientation && srcOrientation < 9) {
	      	canvas.width = height;
	      	canvas.height = width;
	    }
	    else
	    {
	      	canvas.width = width;
	      	canvas.height = height;
	    }

	    // transform context before drawing image
	    switch (srcOrientation) {
			case 2: ctx.transform(-1, 0, 0, 1, width, 0); break;
			case 3: ctx.transform(-1, 0, 0, -1, width, height); break;
			case 4: ctx.transform(1, 0, 0, -1, 0, height); break;
			case 5: ctx.transform(0, 1, 1, 0, 0, 0); break;
			case 6: ctx.transform(0, 1, -1, 0, height, 0); break;
			case 7: ctx.transform(0, -1, -1, 0, height, width); break;
			case 8: ctx.transform(0, -1, 1, 0, 0, width); break;
			default: break;
	    }

	    // draw image
	    ctx.drawImage(img, 0, 0);

	    // export base64
	    callback(canvas.toDataURL(), container);
  	};

  	img.src = srcBase64;
};

function appendImage(data, container) {
	let html =
		`<div class="img-preview-controls">
			<span class="img-delete"><i class="fas fa-times-circle"></i></span>
			<div class="img-options">
				<button type="button" class="button">
					<i class="fas fa-undo-alt"></i>
				</button>
				<button type="button" class="button">
					<i class="fas fa-redo-alt"></i>
				</button>
			</div>
		</div>
		<img class="img-preview" src="${data}">
	</div>`

	container.innerHTML = html
}