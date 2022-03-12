const url = "http://127.0.0.1:8000"

const pathSearch = () => `/search?query=${$(".search-bar").val()}`

const ajax = (form, path, type) => {
    const data = form?.serialize()

    path = type === "search" ? pathSearch() : path;

    $.ajax({
        type: type !== "search" ? "POST" : "GET",
        url: url+path,
        data: data
    })
        .done(result => {
            if(type !== "delete")
            {
                if(type !== "search")
                {
                    // Menghapus value dari input yang telah dimasukan user
                    $(form).find("input[name='title']").val("")
                    $(form).find("textarea[name='body']").val("")

                    errorMessage([{title}, {body}])

                    $(".btn-close-modal").click()
                }

                if(type === "update")
                {
                    //mengambil value dari judul dan body blog yang telah di update
                    const title = $(".blog-title").html()
                    const body = $(".blog-body").html()

                    $(".btn-edit").attr("onClick", `editForm('${title}', '${body}')`)
                }

                const wrapElement = {
                    create: "list-blog",
                    update: "card-blog",
                    search: $(".search-bar").val() ? "list-blog" : "app"
                }

                $(`#${wrapElement[type]}`).html(result)
            }
            else
            {
                toHome()
            }
        })
        .fail( error => {
            // Ambil property error dari response json yang dikembalikan oleh server, lalu destruct value nya
            const {body, title} = error.responseJSON.errors

            // Jika type dari request adalah create atau update, maka panggil fungsi errorMessage jika terjadi error
            if(type === "update" || type === "create")
            {
                errorMessage([
                    {title},
                    {body}
                ])
            }
        })
        .always(() => {

        })
}

const errorMessage = types => {
    types.map((type) => {
        const _type = Object.keys(type)[0]
        if(value = Object.values(type)[0]) {
            const message = value[0]

            $(`.${_type}-error`).removeClass("d-none")
            $(`.${_type}-error`).html( message )
        } else {
            $(`.${_type}-error`).addClass("d-none");
        }
    })
}

const toHome = () => {
    let stateObj = { id: "100" };
    window.history.replaceState(stateObj, "Home", `${url}/blog`);

    $("body").load(`${url}/blog`);
}
