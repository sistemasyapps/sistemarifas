<x-filament-panels::page>
	<script type="text/javascript">
		function subirLogo(){

			const logo_file = document.querySelector("#logo_file");

			if(logo_file.files.length != 1) {
		        alert("debe subir el logo")
	          	return;
		    }

			const formData = new FormData();
			formData.append("logo", logo_file.files[0]);

			const linkGuardar = "{{config('app.url')}}/api/uploadLogo";

			fetch(linkGuardar,{
	          	method: "POST",
	          	cache: "no-cache",
	          	body: formData
	        })
	        .then(response => response.json())
        	.catch( error => {
          		alert("error "+error);
        	})
        	.then( res => {
        		console.log("res::> ",res);
        	})
		}
	</script>
	<div>
		<div>
			<div>
				<form enctype="multipart/form-data">
					<input type="file" name="logo_file" id="logo_file" accept="image/*" >
					<button type="button" onclick="subirLogo()">
						Subir
					</button>
				</form>
			</div>
			<div>
				<img src="{{Storage::url($logo)}}" width="300">
			</div>
		</div>
	</div>

</x-filament-panels::page>