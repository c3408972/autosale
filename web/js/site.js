function InitImage() {

    // Всё загруженные картинки скрываем кроме первой, если обьявление только с одной картинкой, то не показываем листалки.
    $(".imagesAuto").each(function () {
        $(this).find("img:first").addClass("w3-show");
        if ($(this).find("img").length == 1) {
            $(this).find("[change-img]").hide();
        }
    });

    // Событие при клике смены картинок на главной странице
    $("[change-img]").click(function () {
        var lenght = $(this).parent().find("img").length;
        var indexCurrent = $(this).parent().find("img.w3-show").index();
        $(this).parent().find("img.w3-show").removeClass("w3-show");

        if ($(this).attr("change-img") == "prev") {
            if (indexCurrent == 0)
                $(this).parent().find("img:nth(" + (lenght - 1) + ")").addClass("w3-show");
            else
                $(this).parent().find("img:nth(" + (indexCurrent - 1) + ")").addClass("w3-show");
        }

        if ($(this).attr("change-img") == "next") {
            if (indexCurrent == lenght - 1) {
                $(this).parent().find("img:nth(0)").addClass("w3-show");
            }

            else
                $(this).parent().find("img:nth(" + (indexCurrent + 1) + ")").addClass("w3-show");
        }
    });
}

// Метод для отправки фильтров
function Search()
{
    var data = $("#form-filtertAd").serialize();
    $.pjax({
        method: "GET",
        timeout: 4000,
        url: '/',
        container: '#items-search',
        fragment: '#items-search',
        data: data,
    })
}

$(document).ready(function () {

    // Проверяем что загружчик фотографий имеется в документе
    if ($('#files').length > 0) {
        function handleFileSelect(evt) {
            $(this).parent().find(".message").hide();
            $("#form-AddAd .loaderFiles").fadeIn();
            var files = evt.target.files; // FileList object
            $("#list").empty();
            // Loop through the FileList and render image files as thumbnails.
            var index = 0;
            for (var i = 0, f; f = files[i]; i++) {
                // Only process image files.
                if (!f.type.match('image.*')) {
                    continue;
                }

                var reader = new FileReader();

                // Closure to capture the file information.
                reader.onload = (function (theFile) {
                    return function (e) {
                        // Render thumbnail.
                        var span = document.createElement('span');
                        span.innerHTML = ['<img class="thumb" src="', e.target.result, '" title="', theFile.name, '"/></i>'].join('');
                        document.getElementById('list').insertBefore(span, null);
                    };
                })(f);


                // Read in the image file as a data URL.
                reader.readAsDataURL(f);
            }
            $("#form-AddAd .loaderFiles").fadeOut();
        }

        document.getElementById('files').addEventListener('change', handleFileSelect, false);
    }

    // При нажатии поиск по фольтру
    $("#search").click(function () {
        Search();
    });

    // При нажатии выпадалок Региона и Марки, для получения информации аяксом
    $("[name='AdForm[Region]'], [name='FilterForm[Region]']").change(function () {
        var formId = $(this).closest('form').attr('id');
        var modelForm = $(this).closest('form').attr('model-form');
        var selectVal = $("[name='" + modelForm + "[Region]'], #" + formId + " [name='_csrf']").serialize();
        var disabled = true;
        if (modelForm != "AdForm")
        {
            selectVal = selectVal.replace("FilterForm", "AdForm");
            disabled = false;
        }

        $.ajax({
            type: "POST",
            dataType: "json",
            url: "/ad/get-city",
            data: selectVal,
            success: function (data) {
                $(".CityRow").slideDown(200);
                $('#' + formId + ' [name="' + modelForm + '[City]"]').empty();
                if (data.length > 0) {
                    $('#' + formId + ' [name="' + modelForm + '[City]"]').append($("<option></option>").attr({
                        selected: "",
                        value: "",
                        disabled: disabled
                    }).text("Выберите город"));
                    $.each(data, function (key, value) {
                        $('#' + formId + ' [name="' + modelForm + '[City]"]').append($('<option>', {value: value["Id"]}).text(value["Name"]));
                    });
                }
                else {
                    $('#' + formId + ' [name="' + modelForm + '[City]"]').append($("<option></option>").attr({
                        selected: "",
                        value: "",
                        disabled: disabled
                    }).text("Ничего не найдено"));
                }
            }
        });
    });
    $("[name='AdForm[Mark]'], [name='FilterForm[Mark]']").change(function () {
        var formId = $(this).closest('form').attr('id');
        var modelForm = $(this).closest('form').attr('model-form');
        var selectVal = $("[name='" + modelForm + "[Mark]'], #" + formId + " [name='_csrf']").serialize();
        var disabled = true;
        if (modelForm != "AdForm")
        {
            selectVal = selectVal.replace("FilterForm", "AdForm");
            disabled = false;
        }

        $.ajax({
            type: "POST",
            dataType: "json",
            url: "/ad/get-model",
            data: selectVal,
            success: function (data) {
                $(".ModelRow").slideDown(200);
                $('#' + formId + ' [name="' + modelForm + '[Model]"]').empty();
                if (data.length > 0) {
                    $('#' + formId + ' [name="' + modelForm + '[Model]"]').append($("<option></option>").attr({
                        selected: "",
                        value: "",
                        disabled: disabled
                    }).text("Выберите модель"));
                    $.each(data, function (key, value) {
                        $('#' + formId + ' [name="' + modelForm + '[Model]"]').append($('<option>', {value: value["Id"]}).text(value["Name"]));
                    });
                }
                else {
                    $('#' + formId + ' [name="' + modelForm + '[Model]"]').append($("<option></option>").attr({
                        selected: "",
                        value: "",
                        disabled: disabled
                    }).text("Ничего не найдено"));
                }
            }
        });
    });

    // Событие при нажатии кнопки регистраця на главной странице, для вызова модального окна
    $("#reg-btn").click(function () {
        $('#ModalReg').arcticmodal()
        $("#form-reg").trigger('reset');
        $("#messageReg").empty();
    });

    // Событие при нажатии кнопки авторизация на главной странице, для вызова модального окна
    $("#auth-btn").click(function () {
        $('#ModalAuth').arcticmodal();
        $("#form-auth").trigger('reset');
        $("#messageAuth").empty();
    });

    // Событие при нажатии кнопки добавить обьявление на главной странице, для вызова модального окна
    $("#addAd-btn").click(function () {
        $('#ModalAddAd').arcticmodal();
    });

    // Событие при смене селектов при добавлении обьявлений ( что бы сообщения проверки пропадали )
    $(".form-AddAd select").change(function () {
        $(this).parent().find(".message").hide();
    });

    // Событие при нажатии кнопки добавить обьявление
    $("#send-AddAd-btn").click(function () {
        $("#form-AddAd .loader").fadeIn();
        $("#messageAdAdd").hide();
        $(".message").empty();
        var formData = new FormData($('#form-AddAd')[0]);
        $.ajax({
            type: "POST",
            processData: false,
            contentType: false,
            url: "/ad/add-ad",
            data: formData,
            success: function (data) {
                Search();
                $("#form-AddAd .loader").hide();
                if (data.Message["error"]) {
                    var keys = Object.keys(data.Message["error"]);
                    if (typeof data.Message["error"] == "object") {
                        for (var x = 0; x < keys.length; x++) {
                            if (keys[x] == "Images")
                                SetErrorMessage(data.Message["error"][keys[x]][0], '[name="AdForm[Images][]"] + .messageBlock .message');
                            else
                                SetErrorMessage(data.Message["error"][keys[x]][0], '[name="AdForm[' + keys[x] + ']"] + .messageBlock .message');
                        }
                    } else {
                        SetErrorMessage(data.Message["error"], $("#messageAdAdd"));
                    }
                }
                if (data.Message["success"]) {
                    SetSuccessMessage(data.Message["success"], $("#messageAdAdd"));
                    setTimeout(function () {
                        $('#ModalAddAd').arcticmodal('close');
                        $("#form-AddAd").trigger('reset');
                        $(".CityRow, .ModelRow").hide();
                        $("#list").empty();
                        $("#messageAdAdd").empty();
                    }, 2000);
                }
            }
        })
    });

    // Событие при нажатии кнопки регистрации, после заполнения данных формы
    $("#send-register-btn").click(function () {
        $("#form-reg .message").empty();
        $("#form-reg .loader").fadeIn();
        $("#messageReg").hide();
        var dataRegForm = $("#form-reg").serialize();
        $.ajax({
            url: "/user/reg",
            type: "POST",
            dataType: 'json',
            data: dataRegForm,
            success: function (data) {
                $("#form-reg .loader").hide();
                if (data.Message["error"]) {
                    var keys = Object.keys(data.Message["error"]);
                    for (var x = 0; x < keys.length; x++) {

                        SetErrorMessage(data.Message["error"][keys[x]][0], '[name="RegForm[' + keys[x] + ']"] + .messageBlock .message');
                    }
                }

                if (data.Message["success"]) {
                    SetSuccessMessage(data.Message["success"], $("#messageReg"));
                    $("#form-reg").trigger('reset');

                    setTimeout(function () {
                        $('#ModalReg').arcticmodal('close');
                        $('#ModalAuth').arcticmodal();
                    }, 2000);
                }
            }
        });
    });

    // Событие при нажатии кнопки войти после заполнения авторизационных данных
    $("#send-logIn-btn").click(function () {
        $("#form-auth .message").empty();
        $("#form-auth .loader").fadeIn();
        $("#messageAuth").hide();
        var dataAuthForm = $("#form-auth").serialize();
        $.ajax({
            url: "/user/login",
            type: "POST",
            dataType: 'json',
            data: dataAuthForm,
            success: function (data) {
                $("#form-auth .loader").hide();
                if (data.Message["error"]) {
                    var keys = Object.keys(data.Message["error"]);
                    for (var x = 0; x < keys.length; x++) {
                        SetErrorMessage(data.Message["error"][keys[x]][0], '[name="LoginForm[' + keys[x] + ']"] + .messageBlock .message');
                    }
                }
                if (data.Message["success"]) {
                    window.location.reload();
                }
            }
        })
    });

    // Методы для вывода успешных сообщний и ошибочных.
    function SetErrorMessage(text, objectShow) {
        ShowMessage("w3-text-red", text, objectShow);
    };
    function SetSuccessMessage(text, objectShow) {
        ShowMessage("w3-text-green", text, objectShow);
    };

    // Метод для отобрадения сообщений
    function ShowMessage(type, text, objectShow) {
        $(objectShow).removeClass("w3-text-red w3-text-green").addClass(type).empty().append(text).fadeIn(300);
    };
})
;