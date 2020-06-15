$(document).on('click', 'button[type="button"]', function(event) {

    let id = this.id;

    // console.log("id");
    // console.log(id);

    if (id === 'btnEliminateModal') {

        let idCoche = $(this).data("id");

        $('#ajaxDelete').attr("data-id", idCoche);

        // console.log("idCoche");
        // console.log(idCoche);

    }

    else if (id === 'btnEditateModal') {

        let idCoche = $(this).data("id");

        $('#ajaxUpdate').attr("data-id", idCoche);

        // console.log("idCoche");
        // console.log(idCoche);

    }

})
