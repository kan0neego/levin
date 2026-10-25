(function () {
    // Проверяем, существует ли переменная metrikaOnclick
    if (typeof metrikaOnclick !== 'undefined') {
        // Проходим по всем ключам (селекторам) в объекте metrikaOnclick
        for (var selector in metrikaOnclick) {
            if (metrikaOnclick.hasOwnProperty(selector)) {
                // Находим все элементы, соответствующие селектору
                var elements = document.querySelectorAll(selector);

                // Навешиваем событие на каждый найденный элемент
                elements.forEach(function (element) {
                    element.addEventListener("click", function () {
                        // Выполняем код, указанный в значении объекта
                        eval(metrikaOnclick[selector]);
                    });
                });
            }
        }
    }
})();
