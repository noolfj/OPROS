$(document).ready(function () {
    // Обработчик отправки формы опросника
    $("form").submit(function (e) {
        e.preventDefault(); // Предотвращаем обычную отправку формы

        // Собираем данные из формы
        var formData = $(this).serialize();

        // Отправляем данные на сервер через AJAX
        $.ajax({
            type: "POST", // Метод HTTP-запроса
            url: "obrabotchik.php", // URL для обработки данных на сервере
            data: formData, // Данные, отправляемые на сервер
            success: function (response) {
                // Обработка успешного ответа от сервера
                $("#surveyResults").html(response); // Отображаем результаты опроса
            }
        });
    });
});

