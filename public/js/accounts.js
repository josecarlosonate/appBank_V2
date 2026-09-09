$(function () {
  $.validator.addMethod("money", function (value, element) {
    const expression = /^\d{1,13}(\.\d{1,2})?$/;

    return this.optional(element) || expression.test(value);
  });

  $("#account-form").validate({
    rules: {
      account_type: {
        required: true,
      },
      balance: {
        required: true,
        money: true,
      },
    },

    messages: {
      account_type: {
        required: "Selecciona un tipo de cuenta.",
      },
      balance: {
        required: "El saldo inicial es obligatorio.",
        money:
          "Ingresa un saldo válido: máximo 13 dígitos enteros y 2 decimales separados por punto, sin separadores de miles.",
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

  /* cuentas inscritas XX-XXXXX-XXX */
  const accountNumberInput = document.getElementById("account_number");
  if (accountNumberInput) {
    accountNumberInput.addEventListener("input", function () {
      let value = this.value.replace(/\D/g, "");
      value = value.substring(0, 10);
      if (value.length > 7) {
        value =
          value.substring(0, 2) +
          "-" +
          value.substring(2, 7) +
          "-" +
          value.substring(7);
      } else if (value.length > 2) {
        value = value.substring(0, 2) + "-" + value.substring(2);
      }
      this.value = value;
      console.log(value);
    });
  }

  $.validator.addMethod("accountNumberFormat", function (value, element) {
    const expression = /^\d{2}-\d{5}-\d{3}$/;

    return this.optional(element) || expression.test(value);
  });

  $("#account-register-form").validate({
    rules: {
      account_number: {
        required: true,
        accountNumberFormat: true,
      },
      document_number: {
        required: true,
        digits: true,
      },
    },

    messages: {
      account_number: {
        required: "Ingresa el número de cuenta.",
        accountNumberFormat: "Completa los 10 dígitos del número de cuenta.",
      },
      document_number: {
        required: "Ingresa el documento del titular.",
        digits: "El documento debe contener únicamente números.",
      },
    },

    errorPlacement: function (error, element) {
      if (
        element.attr("name") === "account_number" ||
        element.attr("name") === "document_number"
      ) {
        error.insertAfter(element.closest(".input-group"));
      } else {
        error.insertAfter(element);
      }
    },
  });
});
