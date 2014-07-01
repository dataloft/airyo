<div id="footer" class="navbar-default" role="navigation">
	<div class="container">
		<div class="navbar-left">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-2">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span> 
				<span class="icon-bar"></span> 
			</button>
			<p class="navbar-brand text-muted"><small>&copy; Airyo 2014</small></p>
		</div>
		<?if(isset($usermenu)):?>
		<div class="nav collapse navbar-collapse" id="bs-example-navbar-collapse-2">
			<p class="navbar-text navbar-right">
				<span class="glyphicon glyphicon-user"></span> 
				<a href="/admin/settings" style="margin-right: 20px;">Андрей Цветков</a> 
				<span class="glyphicon glyphicon-log-out"></span> 
				<a href="/admin/logout">Выйти</a>
			</p>
		</div>
		<?endif?>
	</div>
</div>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="/i/js/main.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed --> 
<script src="/themes/airyo/js/bootstrap.min.js"></script>

<script src="/i/FileUpload/js/vendor/jquery.ui.widget.js"></script>
<!-- The Load Image plugin is included for the preview images and image resizing functionality -->
<script src="/i/FileUpload/js/load-image.min.js"></script>
<!-- The Canvas to Blob plugin is included for image resizing functionality -->
<script src="/i/FileUpload/js/canvas-to-blob.min.js"></script>
<!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
<script src="/i/FileUpload/js/jquery.iframe-transport.js"></script>
<!-- The basic File Upload plugin -->
<script src="/i/FileUpload/js/jquery.fileupload.js"></script>
<!-- The File Upload processing plugin -->
<script src="/i/FileUpload/js/jquery.fileupload-process.js"></script>
<!-- The File Upload image preview & resize plugin -->
<script src="/i/FileUpload/js/jquery.fileupload-image.js"></script>
<!-- The File Upload audio preview plugin -->
<script src="/i/FileUpload/js/jquery.fileupload-audio.js"></script>
<!-- The File Upload video preview plugin -->
<script src="/i/FileUpload/js/jquery.fileupload-video.js"></script>
<!-- The File Upload validation plugin -->
<script src="/i/FileUpload/js/jquery.fileupload-validate.js"></script>

<script>
    $(function () {
       /*
        */
        'use strict';
        // Change this to the location of your server-side upload handler:
        var url = '/admin/files/upload';
        $('#fileupload').fileupload({
            url: url,
            dataType: 'json',
            dropZone: $('#dropzone'),
            done: function (e, data) {
              /*  $.each(data.result.files, function (index, file) {
                    $('<p/>').text(file.name).appendTo('#files');
                });*/
              window.location.replace(data.result.path);

            },
            progressall: function (e, data) {
                var progress = parseInt(data.loaded / data.total * 100, 10);
                $('#progress .progress-bar').css(
                    'width',
                    progress + '%'
                );
            },
            start: function () {
                $('#progress').removeClass('hidden');
            }
        }).prop('disabled', !$.support.fileInput)
            .parent().addClass($.support.fileInput ? undefined : 'disabled');
    });
    $(document).bind('drop dragover', function (e) {
        e.stopPropagation();
        e.preventDefault();
    });
    $('.dropzone').bind('dragleave', function (e) {
        $('.dropzone').removeClass('in hover');
    });
    $(document).bind('dragover', function (e)
    {
        var dropZone = $('.dropzone'),
            foundDropzone,
            timeout = window.dropZoneTimeout;
        dropZone.addClass('in');
        if (!timeout)
        {

        }
        else
        {
            clearTimeout(timeout);
        }
        var found = false,
            node = e.target;

        do{

            if ($(node).hasClass('dropzone'))
            {
                found = true;
                foundDropzone = $(node);
                break;
            }

            node = node.parentNode;

        }while (node != null);

        dropZone.removeClass('in hover');

        if (found)
        {
            foundDropzone.addClass('hover');
        }

        window.dropZoneTimeout = setTimeout(function ()
        {
            window.dropZoneTimeout = null;
            dropZone.removeClass('in hover');
        }, 1000);
    });
   /* $(document).bind('dragover', function (e) {
        var dropZone = $('#dropzone'),
            timeout = window.dropZoneTimeout;
        if (!timeout) {
            dropZone.addClass('in');
        } else {
            clearTimeout(timeout);
        }
        var found = false,
            node = e.target;
        do {
            if (node === dropZone[0]) {
                found = true;
                break;
            }
            node = node.parentNode;
        } while (node != null);
        if (found) {
            dropZone.addClass('hover');
        } else {
            dropZone.removeClass('hover');
        }
        window.dropZoneTimeout = setTimeout(function () {
            window.dropZoneTimeout = null;
            dropZone.removeClass('in hover');
        }, 100);
    });*/
</script>

</body>
</html>