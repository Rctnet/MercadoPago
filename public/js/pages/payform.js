
(async function getIdentificationTypes() {
    try {
        const identificationTypes = await mp.getIdentificationTypes();
        const identificationTypeElement = document.getElementById('form-checkout__identificationType');

        createSelectOptions(identificationTypeElement, identificationTypes);
    } catch (e) {
        return console.error('Error getting identificationTypes: ', e);
    }
})();

function createSelectOptions(elem, options, labelsAndKeys = { label: "name", value: "id" }) {
    const { label, value } = labelsAndKeys;

    elem.options.length = 0;

    const tempOptions = document.createDocumentFragment();

    options.forEach(option => {
        const optValue = option[value];
        const optLabel = option[label];

        const opt = document.createElement('option');
        opt.value = optValue;
        opt.textContent = optLabel;

        tempOptions.appendChild(opt);
    });

    elem.appendChild(tempOptions);
}

const formSubmit = () => {
    const paymentMethod = $('[name=paymentMethod]:checked');
    console.log(paymentMethod)
    if (paymentMethod.val() == 'credit') {
        cardForm.submit();
    } else if (paymentMethod.val() == 'billet') {
        if ($("#form-checkout")[0].checkValidity()) {
            console.log($("#form-checkout").serializeArray());
            var unindexed_array = $("#form-checkout").serializeArray();
            var indexed_array = {};

            $.map(unindexed_array, function (n, i) {
                indexed_array[n['name']] = n['value'];
            });
            // $("#form-checkout__submit")[0].disabled = true;
             var formData = new FormData($("#form-checkout")[0]);
            // console.log(formData);
            $.ajax({
                type: 'POST',
                url: '/process_payment',
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function(data) {
                    window.location.assign('/thanks_page?link='+data.link)
                },
                error: function(data) {
                    console.log("error");
                    alert(data.responseJSON.message);
                }
    
            });
        //    var retorno =  fetch("", {
        //         method: "POST",
        //         headers: {
        //             "Content-Type": "application/json",
        //         },
        //         body: JSON.stringify(indexed_array),
        //     }).then(async (response)=>{
        //         console.log(response);
        //         console.log(response.body);
        //         console.log(response.message);
        //         console.log(response.errors);
        //         console.log(response.json());
        //         return response.json();
        //     })
        //     .then(async (object) =>{
        //       if (object.errors) {
        //         dispatch(update_errors(response));
        //         throw new Error(object.errors);
        //       } else {
        //         console.log("succeed json re");
        //         dispatch(update_user(json));
        //       }
        //     }).catch(function(error) {
        //         console.log('There has been a problem with your fetch operation: ' + error.message);
        //       });
         //   console.log(retorno);
        } else {
            cardForm.submit();
        }
    }
}
const payButton = document.getElementById("form-checkout__submit");
const validationErrorMessages= document.getElementById('validation-error-messages');
const cardForm = mp.cardForm({
    amount: "100",
    iframe: true,
    form: {
        id: "form-checkout",
        cardNumber: {
            id: "form-checkout__cardNumber",
            placeholder: "Número do cartão",
        },
        expirationDate: {
            id: "form-checkout__expirationDate",
            placeholder: "MM/YY",
        },
        securityCode: {
            id: "form-checkout__securityCode",
            placeholder: "Código de segurança",
        },
        cardholderName: {
            id: "form-checkout__cardholderName",
            placeholder: "Titular do cartão",
        },
        issuer: {
            id: "form-checkout__issuer",
            placeholder: "Banco emissor",
        },
        installments: {
            id: "form-checkout__installments",
            placeholder: "Parcelas",
        },
        identificationType: {
            id: "form-checkout__identificationType",
            placeholder: "Tipo de documento",
        },
        identificationNumber: {
            id: "form-checkout__identificationNumber",
            placeholder: "Número do documento",
        },
        cardholderEmail: {
            id: "form-checkout__cardholderEmail",
            placeholder: "E-mail",
        }
    },
    callbacks: {
        onFormMounted: error => {
            if (error) return console.warn("Form Mounted handling error: ", error);
            console.log("Form mounted");
        },
        oneerror: error =>{
            console.log(error)
        },
        onSubmit: event => {
            event.preventDefault();
            const {
                paymentMethodId: payment_method_id,
                issuerId: issuer_id,
                cardholderEmail: email,
                amount,
                token,
                installments,
                identificationNumber,
                identificationType,
            } = cardForm.getCardFormData();

            fetch("/process_payment", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                },
                body: JSON.stringify({
                    token,
                    issuer_id,
                    payment_method_id,
                    transaction_amount: Number(amount),
                    installments: Number(installments),
                    description: "Descrição do produto",
                    payer: {
                        email,
                        identification: {
                            type: identificationType,
                            number: identificationNumber,
                        },
                    },
                }),
            })
            .then(result => {
                if(!result.hasOwnProperty("error_message")) {
                    document.getElementById("success-response").style.display = "block";
                    document.getElementById("payment-id").innerText = result.id;
                    document.getElementById("payment-status").innerText = result.status;
                    document.getElementById("payment-detail").innerText = result.detail;
                } else {
                    document.getElementById("error-message").textContent = result.error_message;
                    document.getElementById("fail-response").style.display = "block";
                }
                
                $('.container__payment').fadeOut(500);
                setTimeout(() => { $('.container__result').show(500).fadeIn(); }, 500);
            })
            .catch(error => {
                alert("Unexpected error\n"+JSON.stringify(error));
            });

        },
        onFetching: (resource) => {
            console.log("Fetching resource: ", resource);

            // Animate progress bar
            const progressBar = document.querySelector(".progress-bar");
            progressBar.removeAttribute("value");

            return () => {
                progressBar.setAttribute("value", "0");
            };
        },
        onCardTokenReceived: (errorData, token) => {
            if (errorData && errorData.error.fieldErrors.length !== 0) {
                errorData.error.fieldErrors.forEach(errorMessage => {
                    alert(errorMessage);
                });
            }

            return token;
        },
        onValidityChange: (error, field) => {
            const input = document.getElementById(form[field].id);
            removeFieldErrorMessages(input, validationErrorMessages);
            addFieldErrorMessages(input, validationErrorMessages, error);
            enableOrDisablePayButton(validationErrorMessages, payButton);
        }
    },
});
function removeFieldErrorMessages(input, validationErrorMessages) {
    Array.from(validationErrorMessages.children).forEach(child => {
        const shouldRemoveChild = child.id.includes(input.id);
        if (shouldRemoveChild) {
            validationErrorMessages.removeChild(child);
        }
    });
}

function addFieldErrorMessages(input, validationErrorMessages, error) {
    if (error) {
        input.classList.add('validation-error');
        error.forEach((e, index) => {
            const p = document.createElement('p');
            p.id = `${input.id}-${index}`;
            p.innerText = e.message;
            validationErrorMessages.appendChild(p);
        });
    } else {
        input.classList.remove('validation-error');
    }
}

function enableOrDisablePayButton(validationErrorMessages, payButton) {
    if (validationErrorMessages.children.length > 0) {
        payButton.setAttribute('disabled', true);
    } else {
        payButton.removeAttribute('disabled');
    }
}