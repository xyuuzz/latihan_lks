$(".addCabang").on("click", () => {
    $(".formCabang").toggleClass("d-none");
    let isi = $(".formCabang").hasClass("d-none") ? "Tambahkan Data" : "Kembali";
    $(".addCabang").html(isi);
});

// $(".editBranch").on("click", () => {
//     $(".fieldNamaCabang .active").toggleClass("d-none");
//     $(".fieldNamaCabang .edit").toggleClass("d-none");
// });

$("tbody").on("click", function(e) {
    if(e.target.classList.contains("editBranch"))
    {
        let edit = e.target.parentElement.parentElement.previousElementSibling.previousElementSibling;
        edit.firstElementChild.classList.toggle("d-none");
        edit.lastElementChild.classList.toggle("d-none");

        e.target.parentElement.classList.toggle("d-none");

        if(e.target.classList.contains("genBranch"))
        {
            e.target.parentElement.nextElementSibling.classList.toggle("d-none");
        }
        else
        {
            e.target.parentElement.previousElementSibling.classList.toggle("d-none");
        }
    }
});

// jika el dengan id start time mengalami event keyup, jalankan fungsi
$("#start_time").on("keyup", () => {
    if($("#start_time").val().length === 4) // jika value dari el nya berjumlah 4
    {
        let val = $("#start_time").val(); // mengambil value
        let ke_1 = "" + val[0] + val[1]; // ambil element dengan index 0 dan 1
        let ke_2 = "" + val[2] + val[3]; // ambil element dengan index 2 dan 3

        // jika admin memasukan pukul 24, otomatis ubah ke pukul 00
        if(ke_1 == "24")
        {
            ke_1 = "00";
        }

        $("#start_time").val(`${ke_1}:${ke_2}`); // gabungkan el dan buat agar bentuknya seperti jam
    }
});


function previewImage() {
    const inputImage = document.querySelector("#image");
    const image = new FileReader();
    image.readAsDataURL(inputImage.files[0]);
    image.onload = e => { // saat image sudah di load, maka :
        $(".").attr("src", e.target.result);  // ganti value atribut src pada image
    }
}
