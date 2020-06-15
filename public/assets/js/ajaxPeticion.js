(function() {

    /* global $ */

    // var csrf = null;

    var genericAjax = function(url, data, type, callBack) {
        $.ajax({
                url: url,
                data: data,
                type: type,
                dataType: 'json',
            })
            .done(function(json) {
                console.log('ajax done');
                // console.log(json);
                callBack(json);
            })
            .fail(function(xhr, status, errorThrown) {
                console.log('ajax fail');
                // console.log(url);// console.log(data);
                // console.log(type);
                // console.log(callBack);
            })
            .always(function(xhr, status) {
                console.log('ajax always');
            });
    };

    var formAjax = function(url, data, type, callBack) {
        $.ajax({
                url: url,
                data: data,
                type: type,
                processData: false,
                contentType: false,
                dataType: 'json',
            })
            .done(function(json) {
                console.log('ajax done');
                console.log(json);
                callBack(json);
            })
            .fail(function(xhr, status, errorThrown) {
                console.log('ajax fail');
            })
            .always(function(xhr, status) {
                console.log('ajax always');
            });
    };

    var simpleAjax = function(url, callBack) {
        genericAjax(url, null, 'get', callBack);
    };


    // console.log('ahora');



    genericAjax('ajaxPeticionCoches ', null, 'get', function(ajax) {


        // console.log('ajax');
        // console.log(ajax);


        var getPageLink = function(page) {
            return `<li class="page-item" style="list-style: none !important;">
                        <a class="page-link active-page " data-page="${page}" href="#">${page}</a>
                    </li>`;
        }

        var getPaginator = function(data) {
            // console.log('data ');
            // console.log(data);
            let previousOn =
                `<li class="page-item" style="list-style: none !important;"  aria-label="Ã‚Â« Anterior">
                    <a class="page-link active-page" href="#" data-page="${data.current_page-1}" rel="previous" aria-label="Ã‚Â« Anterior">Previous</a>
                </li>`;

            let previousOff =
                `<li class="page-item disabled" style="list-style: none !important;" aria-disabled="true" aria-label="Ã‚Â« Anterior">
                    <span class="page-link" aria-hidden="true">Previous</span>
                </li>`;
            let nextOn =
                `<li class="page-item" style="list-style: none !important;">
                    <a class="page-link active-page" style="list-style: none !important;" data-page="${data.current_page+1}" href="#" rel="next" aria-label="Siguiente Ã‚Â»">Next</a>
                </li>`;
            let nextOff =
                `<li class="page-item disabled" style="list-style: none !important;" aria-disabled="true" aria-label="Siguiente Ã‚Â»">
                    <span class="page-link" aria-hidden="true">Next</span>
                </li>`;
            let current =
                `<li class="page-item active" style="list-style: none !important;" aria-current="page">
                    <span class="page-link">${data.current_page}</span>
                </li>`;
            let between =
                `<li class="page-item disabled" style="list-style: none !important;" aria-disabled="true">
                    <span class="page-link">...</span>
                </li>`;


            var result = '';
            if (data.current_page == 1) {
                result += previousOff;
            }
            else {
                result += previousOn;
            }
            if (data.current_page > 2) {
                result += between;
            }

            for (var i = data.current_page - 2; i <= data.current_page + 2; i++) {
                if (i < 1) {

                }
                else if (i > data.last_page) {

                }
                else if (i == data.current_page) {
                    result += current;
                }
                else {
                    result += getPageLink(i);
                }
            }

            if (data.current_page < data.last_page - 1) {
                result += between;
            }
            if (data.current_page == data.last_page) {
                result += nextOff;
            }
            else {
                result += nextOn;
            }
            return result;

        }


        function getParameterByName(name) {
            name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
            var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
                results = regex.exec(location.search);
            return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
        }

        var getBody = function(response) {
            var ajaxdata = response.data;
            var content = '';
            for (var i = 0; i < ajaxdata.length; i++) {
                content += getCochesTable(ajaxdata[i], response.authenticated, response.rooturl);
            }
            return content;
        };


        var getCochesTable = function(row, authenticated, rootUrl) {
            var content = '';

            // content += '<th scope="row">' + row.id + '</th>';
            content += '<td>' + row.id + '</td>';
            content += '<td>' + row.marca + '</td>';
            content += '<td>' + row.modelo + '</td>';
            content += '<td>' + row.motor + '</td>';
            content += '<td>' + row.potencia + '</td>';
            content += '<td>' +
                '<button type="button" id="btnEditateModal" class="btn btn-outline-info" data-id="' + row.id + '" data-toggle="modal" data-target="#modalEdit">Editar</button>&nbsp;' +
                '<button type="button" id="btnEliminateModal" class="btn btn-outline-danger" data-id="' + row.id + '" data-toggle="modal" data-target="#modalDelete">Eliminar</button>' +
                '</td>';

            return '<tr>' + content + '</tr>';
        };

        var request = function(pagenumber, history = true) {
            genericAjax('ajaxPeticionCoches', { page: pagenumber }, 'get', function(param1) {
                // console.log('param1');
                // console.log(param1);
                $('#tBody').empty();
                $('#ajaxLink').empty();
                $('#tBody').append(getBody(param1));
                $('#ajaxLink').append(getPaginator(param1));
                if (history) {
                    window.history.pushState({ id: pagenumber }, null, '?page=' + pagenumber);
                }
            });
        }

        window.onpopstate = function(e) {
            console.log('e:');
            console.log(e);
            var id = e.state.id;
            request(id, false);
        };

        if ($('#tBody').length > 0) {
            var page = getParameterByName('page');
            if (!page) {
                page = 1;
            }
            request(page);
        }

        $('#ajaxLink').on('click', '.active-page', function(event) {
            event.preventDefault();
            console.log($(this).attr('data-page'));
            var page = $(this).attr('data-page');
            request(page);
        });




        // ------------------------------------------------------------------------------
        // CREAR
        // ------------------------------------------------------------------------------

        $('#botonCrear').click(function() {

            var marcaVal = $('#marcar').val();
            var modeloVal = $('#modcar').val();
            var motorVal = $('#motcar').val();
            var potenciaVal = $('#potcar').val();

            // console.log(datos);

            genericAjax('storeCoche', { marca: marcaVal, modelo: modeloVal, motor: motorVal, potencia: potenciaVal }, 'get', function(ajax) {
                if (ajax.response) {
                    // $('#marcar, #modcar, #motcar, #potcar').val('');

                    $('#ModalNew').modal('hide');


                    $('#mensaje').removeClass('alert-warning');
                    $('#mensaje').removeClass('alert-danger');
                    $('#mensaje').addClass('alert-success')
                    $('#mensaje').attr("style", "display:block")
                    $('#mensaje').text(ajax.mensaje);

                    request(page);

                    setTimeout(function() {
                        $("#mensaje").fadeOut(1500);
                    }, 3000);

                }
                else {
                    $('#mensaje').addClass('alert-danger')
                    $('#mensaje').attr("style", "display:block")
                    $('#mensaje').text('Error: operación no realizada.');
                }
            });
        });





        // ------------------------------------------------------------------------------
        // DATOS PARA EDITAR
        // ------------------------------------------------------------------------------
        $(document).delegate("#btnEditateModal", "click", function(e) {

            var id = $(this).attr("data-id");


            // console.log(id);

            genericAjax('editCoche/' + id, null, 'get', function(ajax) {

                $('#marcare').val(ajax.marca);
                $('#modcare').val(ajax.modelo);
                $('#motcare').val(ajax.motor);
                $('#potcare').val(ajax.potencia);

            });

        });



        // ------------------------------------------------------------------------------
        // ACTUALIZAR
        // ------------------------------------------------------------------------------
        $(document).delegate("#ajaxUpdate", "click", function(e) {

            var id = $(this).attr("data-id");

            var marcaVal = $('#marcare').val();
            var modeloVal = $('#modcare').val();
            var motorVal = $('#motcare').val();
            var potenciaVal = $('#potcare').val();

            // console.log(id);

            genericAjax('updateCoche/' + id, { marca: marcaVal, modelo: modeloVal, motor: motorVal, potencia: potenciaVal }, 'get', function(ajax) {

                if (ajax.response) {

                    $('#modalEdit').modal('hide');


                    $('#mensaje').removeClass('alert-warning');
                    $('#mensaje').removeClass('alert-danger');
                    $('#mensaje').addClass(ajax.clasecss);
                    $('#mensaje').attr("style", "display:block");
                    $('#mensaje').text(ajax.mensaje);

                    request(page);

                    setTimeout(function() {
                        $("#mensaje").fadeOut(1500);
                    }, 3000);

                }
                else {
                    $('#mensaje').addClass('alert-danger');
                    $('#mensaje').attr("style", "display:block");
                    $('#mensaje').text('Error: operación no realizada.');
                }

            });

        });




        // ------------------------------------------------------------------------------
        // ELIMINAR
        // ------------------------------------------------------------------------------
        $(document).delegate("#ajaxDelete", "click", function(e) {

            var id = $(this).attr("data-id");

            // console.log(id);

            genericAjax('cocheDelete/' + id, { id: id }, 'get', function(ajax) {

                if (ajax.response) {
                    // $('#marcar, #modcar, #motcar, #potcar').val('');

                    $('#modalDelete').modal('hide');

                    $('#mensaje').removeClass('alert-warning');
                    $('#mensaje').removeClass('alert-danger');
                    $('#mensaje').addClass('alert-success');
                    $('#mensaje').attr("style", "display:block");
                    $('#mensaje').text(ajax.mensaje);


                    request(page);

                    setTimeout(function() {
                        $("#mensaje").fadeOut(1500);
                    }, 3000);

                }
                else {
                    $('#mensaje').addClass('alert-danger')
                    $('#mensaje').attr("style", "display:block")
                    $('#mensaje').text('Error: operación no realizada.');
                }

            });

        });







        // var genericAjax = function(url, data, type, callBack) {
        //     $.ajax({
        //             url: url,
        //             data: data,
        //             type: type,
        //             dataType: 'json',
        //         })
        //         .done(function(json) {
        //             console.log('ajax done');
        //             // console.log(json);
        //             callBack(json);
        //         })
        //         .fail(function(xhr, status, errorThrown) {
        //             console.log('ajax fail');
        //             // console.log(url);// console.log(data);
        //             // console.log(type);
        //             // console.log(callBack);
        //         })
        //         .always(function(xhr, status) {
        //             console.log('ajax always');
        //         });
        // };






    });

})();
