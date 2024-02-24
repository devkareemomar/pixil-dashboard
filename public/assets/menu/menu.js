var arraydata = [];

function getmenus(with_feedback) {
    arraydata = [];
    $('#spinsavemenu').show();

    var cont = 0;
    $('#menu-to-edit li').each(function (index) {
        var dept = 0;
        for (var i = 0; i < $('#menu-to-edit li').length; i++) {
            var n = $(this)
                .attr('class')
                .indexOf('menu-item-depth-' + i);
            if (n != -1) {
                dept = i;
            }
        }
        var textoiner = $(this)
            .find('.item-edit')
            .text();
        var id = this.id.split('-');
        var textoexplotado = textoiner.split('|');
        var padre = 0;
        if (
            !!textoexplotado[textoexplotado.length - 2] &&
            textoexplotado[textoexplotado.length - 2] != id[2]
        ) {
            padre = textoexplotado[textoexplotado.length - 2];
        }
        arraydata.push({
            depth: dept,
            id: id[2],
            parent_id: padre,
            sort: cont
        });
        cont++;
    });
    updateitem(0, with_feedback);
    actualizarmenu();
}

function addcustommenu(type) {
    $('#spincustomu').show();

    // Create a FormData object
    var formData = new FormData();

    // Get file inputs and form values
    if ($('#custom-menu-item-image')[0]) {
        var imageFile = $('#custom-menu-item-image')[0].files[0];
    }
    if ($('#custom-menu-item-image')[0]) {
        var iconFile = $('#custom-menu-item-icon')[0].files[0];
    }
    var labelmenu = $('#custom-menu-item-name').val();
    var idmenu = $('#idmenu').val();
    var is_mega = $('#custom-menu-item-is_mega').val();
    var linkmenu = $('#custom-menu-item-url').val();
    var page_id = $('#custom-menu-item-page_id').val();
    var project_id = $('#custom-menu-item-project_id').val();
    var news_id = $('#custom-menu-item-news_id').val();
    var form_id = $('#custom-menu-item-form_id').val();
    if(type == 'page'){
        formData.append('page_id', page_id);
        var labelmenu = $('#custom-menu-item-name_page').val();
    }
    if(type == 'project'){
        formData.append('project_id', project_id);
        var labelmenu = $('#custom-menu-item-name_project').val();
    }
    if(type == 'news'){
        formData.append('news_id', news_id);
        var labelmenu = $('#custom-menu-item-name_news').val();
    }
    if(type == 'form'){
        formData.append('form_id', form_id);
        var labelmenu = $('#custom-menu-item-name_form').val();
    }


    // Append data to FormData
    formData.append('image', imageFile);
    formData.append('icon', iconFile);
    formData.append('labelmenu', labelmenu);
    formData.append('idmenu', idmenu);
    formData.append('is_mega', is_mega);
    formData.append('linkmenu', linkmenu);
    formData.append('type', type);


    $.ajax({
        data: formData,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },

        url: addcustommenur,
        contentType: false,
        processData: false,
        type: 'POST',
        success: function (response) {
            window.location.reload();
        },
        complete: function () {
            $('#spincustomu').hide();
        }
    });
}

function updateitem(id = 0, with_feedback = false) {
    if (id) {
        var formData = new FormData();

        // Get file inputs and form values
        var label = $('#idlabelmenu_' + id).val();
        var clases = $('#clases_menu_' + id).val();
        var url = $('#url_menu_' + id).val();
        var is_mega = $('#is_mega_' + id).val();
        var iconFile = $('#icon_menu_' + id)[0].files[0];
        var imageFile = $('#image_menu_' + id)[0].files[0];

        // Append data to FormData
        formData.append('id', id);
        formData.append('label', label);
        formData.append('clases', clases);
        formData.append('url', url);
        formData.append('is_mega', is_mega);
        formData.append('iconFile', iconFile);
        formData.append('imageFile', imageFile);


        var data = formData;
    } else {
        var arr_data = [];
        $('.menu-item-settings').each(function (k, v) {
            var formData = new FormData();

            // Get file inputs and form values
            var id = $(this).find('.edit-menu-item-id').val();
            var label = $(this).find('.edit-menu-item-title').val();
            var clases = $(this).find('.edit-menu-item-classes').val();
            var url = $(this).find('.edit-menu-item-url').val();
            var is_mega = $(this).find('.edit-menu-item-is_mega').is(":checked") ? 1 : 0;
            var iconFile = $(this).find('.edit-menu-item-icon')[0].files[0];
            var imageFile = $(this).find('.edit-menu-item-image')[0].files[0];

            // Append data to FormData
            formData.append('id', id);
            formData.append('label', label);
            formData.append('clases', clases);
            formData.append('url', url);
            formData.append('is_mega', is_mega);
            formData.append('icon', iconFile);
            formData.append('image', imageFile);

            arr_data.push(formData);
        });

        var data = {arraydata: arr_data};
    }
    if (data.arraydata) {
        data.arraydata.forEach(function (item) {
            $.ajax({
                data: item,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: updateitemr,
                contentType: false,
                processData: false,
                type: 'POST',
                beforeSend: function (xhr) {
                    if (id) {
                        $('#spincustomu2').show();
                    }
                },
                success: function (response) {
                    if(with_feedback){
                        Swal.fire({
                            type: 'success',
                            title: 'Changes saved successfully',
                            showConfirmButton: false,
                            timer: 2000
                        })
                    }

                },
                complete: function () {
                    if (id) {
                        $('#spincustomu2').hide();
                    }
                }
            });
        });
    } else {
        $.ajax({
            data: data,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: updateitemr,
            contentType: false,
            processData: false,
            type: 'POST',
            beforeSend: function (xhr) {
                if (id) {
                    $('#spincustomu2').show();
                }
            },
            success: function (response) {

            },
            complete: function () {
                if (id) {
                    $('#spincustomu2').hide();
                }
            }
        });
    }
}

function actualizarmenu() {
    $.ajax({
        dataType: 'json',
        data: {
            arraydata: arraydata,
            menuname: $('#menu-name').val(),
            idmenu: $('#idmenu').val(),
            position: $('#menu-position').val(),
            locale: $('#menu-locale').val(),
            is_active: $('[name="menu-is_active"]').is(':checked') ? 1 : 0
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: generatemenucontrolr,
        type: 'POST',
        beforeSend: function (xhr) {
            $('#spincustomu2').show();
        },
        success: function (response) {
            console.log('aqu llega');
        },
        complete: function () {
            $('#spincustomu2').hide();
        }
    });
}

function deleteitem(id) {
    $.ajax({
        dataType: 'json',
        data: {
            id: id
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },

        url: deleteitemmenur,
        type: 'POST',
        success: function (response) {
        }
    });
}

function deletemenu() {
    var r = confirm('Do you want to delete this menu ?');
    if (r == true) {
        $.ajax({
            dataType: 'json',

            data: {
                id: $('#idmenu').val()
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },

            url: deletemenugr,
            type: 'POST',
            beforeSend: function (xhr) {
                $('#spincustomu2').show();
            },
            success: function (response) {
                if (!response.error) {
                    alert(response.resp);
                    window.location = menuwr;
                } else {
                    alert(response.resp);
                }
            },
            complete: function () {
                $('#spincustomu2').hide();
            }
        });
    } else {
        return false;
    }
}

function createnewmenu() {
    if (!!$('#menu-name').val()) {
        $.ajax({
            dataType: 'json',

            data: {
                menuname: $('#menu-name').val(),
                position: $('#menu-position').val(),
                locale: $('#menu-locale').val(),
                is_active: $('[name="menu-is_active"]').is(':checked') ? 1 : 0
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: createnewmenur,
            type: 'POST',
            success: function (response) {
                window.location = menuwr + '?menu=' + response.resp;
            }
        });
    } else {
        alert('Enter menu name!');
        $('#menu-name').focus();
        return false;
    }
}

function insertParam(key, value) {
    key = encodeURI(key);
    value = encodeURI(value);

    var kvp = document.location.search.substr(1).split('&');

    var i = kvp.length;
    var x;
    while (i--) {
        x = kvp[i].split('=');

        if (x[0] == key) {
            x[1] = value;
            kvp[i] = x.join('=');
            break;
        }
    }

    if (i < 0) {
        kvp[kvp.length] = [key, value].join('=');
    }

    //this will reload the page, it's likely better to store this until finished
    document.location.search = kvp.join('&');
}

wpNavMenu.registerChange = function () {
    getmenus();
};
