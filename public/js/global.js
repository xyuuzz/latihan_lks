function previewImage() {
    const inputImage = document.querySelector("#image");
    const image = new FileReader();
    image.readAsDataURL(inputImage.files[0]);
    image.onload = e => { // saat image sudah di load, maka :
        $(".img-preview").attr("src", e.target.result);  // ganti value atribut src pada image
    }
}
