@extends('layouts.app')
@section('style')
<link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/basic.css" rel="stylesheet" type="text/css" />
<style type="text/css">
    .dz-image img {
    width: 100%;
    height: 100%;
}
.dropzone.dz-started .dz-message {
	display: block !important;
}
.dropzone {
	border: 2px dashed #028AF4 !important;
    padding: 10%;
}
.dropzone .dz-preview.dz-complete .dz-success-mark {
    opacity: 1;
}
.dropzone .dz-preview.dz-error .dz-success-mark {
    opacity: 0;
}
.dropzone .dz-preview .dz-error-message{
	top: 144px;
}
</style>

@endsection
@section('content')


                    <section class="content container-fluid">
                        <div class="row">
                                <div class="com-sm-12">
                                        <h3 class="">LAravel Multiple IMages upload</h3>
                                        <form method="POST" action="{{url('fileuploaded')}}" enctype="multipart/form-data" class="dropzone" id="dropzone">
                                            {{ csrf_field() }}
                                            <div class="dz-default dz-message"><h4>Drop files Here or Click to Upload</h4></div>
                                        </form>
                                </div>
                        </div>
                </section>
                <section class="content-header">
                    <h1>Media Library</h1>
                    <div class="container">
                        {{-- <div class="row" id="div1"> --}}
                        <div class="gallery_product col-lg-4 col-md-4 col-sm-4 col-xs-6 filter sprinkle" id="div1">

                </div>
                        {{-- </div> --}}
                        </div>

            </section>
@endsection
@section('jquery')
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/dropzone.js"></script>
<script type="text/javascript">
   Dropzone.options.dropzone =
         {
	    maxFiles: 10,
            maxFilesize: 4,
            //~ renameFile: function(file) {
                //~ var dt = new Date();
                //~ var time = dt.getTime();
               //~ return time+"-"+file.name;    // to rename file name but i didn't use it. i renamed file with php in controller.
            //~ },
            acceptedFiles: ".jpeg,.jpg,.png,.gif",
            addRemoveLinks: true,
            timeout: 50000,
            init:function() {

				// Get images
				var myDropzone = this;
				$.ajax({
					url: 'getimages',
					type: 'GET',
					dataType: 'json',
					success: function(data){
                        // debugger
                        // $("#div1").html(data);
					//console.log(data);
					$.each(data, function (key, value) {
                        // debugger
                        var div = document.createElement('div');

                        var x = document.createElement("IMG");
                        var anc = document.createElement("A");
                        var id = value.id;
                       //debugger
                    let _url = "{{url('fileuploaded/delete/')}}"+'/'+id;
                        anc.setAttribute('href', _url);
                        anc.setAttribute('value', 'Remove');
                        anc.setAttribute('id', value.id);
                        anc.innerHTML = "Delete Image";
                        x.setAttribute('src', value.path);
                        x.setAttribute('alt', 'image');
                        x.setAttribute('height', '200px');
                        x.setAttribute('width', '200px');
                        div.appendChild(x);
                        div.appendChild(anc);
                        //debugger
                        $("#div1").append(div);
						// var file = {name: value.name, size: value.size};
						// myDropzone.options.addedfile.call(myDropzone, file);

						// myDropzone.options.thumbnail.call(myDropzone, file, value.path);
						// myDropzone.emit("complete", file);
					});
					}
				});
			},
            removedfile: function(file)
            {
				if (this.options.dictRemoveFile) {
				  return Dropzone.confirm("Are You Sure to "+this.options.dictRemoveFile, function() {
					if(file.previewElement.id != ""){
						var name = file.previewElement.id;
					}else{
						var name = file.name;
					}
					//console.log(name);
					$.ajax({
						headers: {
							  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
							  },
						type: 'POST',
						url: 'fileuploaded/delete',
						data: {filename: name},
						success: function (data){
							alert(data.success +" File has been successfully removed!");
						},
						error: function(e) {
							console.log(e);
						}});
						var fileRef;
						return (fileRef = file.previewElement) != null ?
						fileRef.parentNode.removeChild(file.previewElement) : void 0;
				   });
			    }
            },

            success: function(file, response)
            {
				file.previewElement.id = response.success;
				//console.log(file);
				// set new images names in dropzone’s preview box.
                var olddatadzname = file.previewElement.querySelector("[data-dz-name]");
				file.previewElement.querySelector("img").alt = response.success;
				olddatadzname.innerHTML = response.success;
            },
            error: function(file, response)
            {
               if($.type(response) === "string")
					var message = response; //dropzone sends it's own error messages in string
				else
					var message = response.message;
				file.previewElement.classList.add("dz-error");
				_ref = file.previewElement.querySelectorAll("[data-dz-errormessage]");
				_results = [];
				for (_i = 0, _len = _ref.length; _i < _len; _i++) {
					node = _ref[_i];
					_results.push(node.textContent = message);
				}
				return _results;
            }

};

</script>

@endsection
