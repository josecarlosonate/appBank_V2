$(function () {
    $.validator.addMethod('money', function (value, element) {
        const expression = /^\d{1,13}(\.\d{1,2})?$/;

        return expression.test(value);
    });

    $("#account-form").validate({
        rules: {
            account_type: {
                required: true,
            },
            balance: {
                required: true,
                money: true
            },
        },

        messages: {
            account_type: {
                required: "Selecciona un tipo de cuenta.",
            },
            balance: {
                required: "El saldo inicial es obligatorio.",
                money: 'Ingresa un saldo válido: máximo 13 dígitos enteros y 2 decimales separados por punto, sin separadores de miles.'
            },
        },

        errorPlacement: function (error, element) {
            if (element.attr("name") === "balance") {
                error.insertAfter(element.closest(".input-group"));
            } else {
                error.insertAfter(element);
            }
        },
    });
});
