const showPreview = (id) => {
	const image = document.querySelector(`#${id}`);
	const imgPreview = document.querySelector(".img-preview");
	imgPreview.style.display = "block";

	const oFReader = new FileReader();
	oFReader.readAsDataURL(image.files[0]);

	oFReader.onload = (oFREvent) => {
		imgPreview.src = oFREvent.target.result;
	};
};
