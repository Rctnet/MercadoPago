@extends('layout')
@section('content')
  <div class="container">
    <div class="py-5 text-center">
      <img class="d-block mx-auto mb-4" src="../../assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">
      <h2>Checkout form</h2>
      <p class="lead">Below is an example form built entirely with Bootstrap's form controls. Each required form group has a validation state that can be triggered by attempting to submit the form without completing it.</p>
    </div>

    <div class="row">
      <div class="col-md-4 order-md-2 mb-4">
        <h4 class="d-flex justify-content-between align-items-center mb-3">
          <span class="text-muted">Your cart</span>
          <span class="badge badge-secondary badge-pill">3</span>
        </h4>
        <ul class="list-group mb-3">
          <li class="list-group-item d-flex justify-content-between lh-condensed">
            <div>
              <h6 class="my-0">Product name</h6>
              <small class="text-muted">Brief description</small>
            </div>
            <span class="text-muted">$12</span>
          </li>
          <li class="list-group-item d-flex justify-content-between lh-condensed">
            <div>
              <h6 class="my-0">Second product</h6>
              <small class="text-muted">Brief description</small>
            </div>
            <span class="text-muted">$8</span>
          </li>
          <li class="list-group-item d-flex justify-content-between lh-condensed">
            <div>
              <h6 class="my-0">Third item</h6>
              <small class="text-muted">Brief description</small>
            </div>
            <span class="text-muted">$5</span>
          </li>
          <li class="list-group-item d-flex justify-content-between bg-light">
            <div class="text-success">
              <h6 class="my-0">Promo code</h6>
              <small>EXAMPLECODE</small>
            </div>
            <span class="text-success">-$5</span>
          </li>
          <li class="list-group-item d-flex justify-content-between">
            <span>Total (R$)</span>
            <strong>100</strong>
          </li>
        </ul>
      </div>

      <div class="col-md-8 order-md-1">
        <h4 class="mb-3">Dados Pessoais</h4>
        <form class="needs-validation" novalidate id="form-checkout" method="post" action="/process_payment">
          <input type="hidden" name="transaction_amount" value="100">
          <div>


            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="payerFirstName">Nome</label>
                <input id="form-checkout__payerFirstName" class="form-control" name="payerFirstName" type="text">
                <div class="invalid-feedback">
                  Valid first name is required.
                </div>
              </div>
              <div class="col-md-6 mb-3">
                <label for="payerLastName">Sobrenome</label>
                <input id="form-checkout__payerLastName" class="form-control" name="payerLastName" type="text">
                <div class="invalid-feedback">
                  Valid last name is required.
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="mb-3">
              <label for="form-checkout__cardholderEmail">Email</label>
              <input type="email" class="form-control" id="form-checkout__cardholderEmail" name="cardholderEmail" placeholder="you@example.com">
              <div class="invalid-feedback">
                Please enter a valid email address for shipping updates.
              </div>
            </div>
            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="form-checkout__issuer">CPF/CNPJ</label>
                <select id="form-checkout__identificationType" name="identificationType" class="form-control"></select>
                <div class="invalid-feedback">
                  Valid first name is required.
                </div>

              </div>
              <div class="col-md-6 mb-3">
                <label for="form-checkout__issuer">Numero do documento</label>
                <input type="text" id="form-checkout__identificationNumber" name="identificationNumber" class="form-control" />
                <div class="invalid-feedback">
                  Valid first name is required.
                </div>

              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-3 mb-3">
              <label for="cep">CEP</label>
              <input type="text" class="form-control" id="cep" name="cep" placeholder="" required>
              <div class="invalid-feedback">
                Insira um CEP valido
              </div>
            </div>
            <div class="col-md-7 mb-3">
              <label for="street_name">Logradouro</label>
              <input type="text" class="form-control" id="street_name" name="street_name" placeholder="Rua/Avenida/Alameda" required>
              <div class="invalid-feedback">
                Please enter your shipping address.
              </div>
            </div>
            <div class="col-md-2 mb-3">
              <label for="street_number">Numero</label>
              <input type="text" class="form-control" id="street_number" name="street_number" placeholder="" required>
              <div class="invalid-feedback">
                Please enter your shipping address.
              </div>
            </div>
          </div>
          <div class="row">
            <div class="mb-3">
              <label for="neighborhood">Bairro </label>
              <input type="text" class="form-control" id="neighborhood" name="neighborhood" placeholder="">
            </div>
            </div>
          <div class="row">
            <div class="col-md-6 mb-3">
              <label for="city">Cidade </label>
              <input type="text" class="form-control" id="city" name="city" placeholder="">
            </div>

            <div class="col-md-6 mb-3">
              <label for="state">Estado</label>
              <select class="custom-select d-block w-100 form-control" id="state" name="state" required>
                <option value="">Escolha um...</option>
                <option value="AC">Acre</option>
                <option value="AL">Alagoas</option>
                <option value="AP">Amapá</option>
                <option value="AM">Amazonas</option>
                <option value="BA">Bahia</option>
                <option value="CE">Ceará</option>
                <option value="DF">Distrito Federal</option>
                <option value="ES">Espírito Santo</option>
                <option value="GO">Goiás</option>
                <option value="MA">Maranhão</option>
                <option value="MT">Mato Grosso</option>
                <option value="MS">Mato Grosso do Sul</option>
                <option value="MG">Minas Gerais</option>
                <option value="PA">Pará</option>
                <option value="PB">Paraíba</option>
                <option value="PR">Paraná</option>
                <option value="PE">Pernambuco</option>
                <option value="PI">Piauí</option>
                <option value="RJ">Rio de Janeiro</option>
                <option value="RN">Rio Grande do Norte</option>
                <option value="RS">Rio Grande do Sul</option>
                <option value="RO">Rondônia</option>
                <option value="RR">Roraima</option>
                <option value="SC">Santa Catarina</option>
                <option value="SP">São Paulo</option>
                <option value="SE">Sergipe</option>
                <option value="TO">Tocantins</option>
                <option value="EX">Estrangeiro</option>
              </select>
              <div class="invalid-feedback">
                Insira um estado valido por favor.
              </div>
            </div>

          </div>


          <h4 class="mb-3">Tipo de pagamento</h4>

          <div class="d-block my-3">
            <div class="custom-control custom-radio">
              <input id="credit" name="paymentMethod" type="radio" class="custom-control-input" value="credit" checked required>
              <label class="custom-control-label" for="credit">Cartão</label>
            </div>
            <div class="custom-control custom-radio">
              <input id="billet" name="paymentMethod" type="radio" class="custom-control-input" value="billet" required>
              <label class="custom-control-label" for="paypal">Boleto</label>
            </div>
          </div>
          <h4 class="mb-3">Pagamento com Cartão</h4>
          <div class="row">
            <div class="col-md-6 mb-3">
              <label for="form-checkout__cardholderName">Nome como está no cartão</label>
              <input type="text" class="form-control" id="form-checkout__cardholderName" placeholder="">
            </div>
            <div class="col-md-6 mb-3">
              <label for="form-checkout__cardNumber">Numero do Cartão</label>
              <div style="height: 35px;" class="form-control" id="form-checkout__cardNumber"></div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6 mb-3">
              <label for="form-checkout__issuer">Emissor do cartão</label>
              <select class="form-control" id="form-checkout__issuer"></select>
            </div>
            <div class="col-md-6 mb-3">
              <label for="form-checkout__issuer">Parcelas</label>
              <select class="form-control" id="form-checkout__installments"></select>
            </div>
          </div>
          <div class="row">
            <div class="col-md-3 mb-3">
              <label for="checkout__expirationDate">Expiration</label>
              <div style="height: 35px;" class="form-control" id="form-checkout__expirationDate"></div>
            </div>
            <div class="col-md-3 mb-3">
              <label for="cc-cvv">CVV</label>
              <div style="height: 35px;" class="form-control" id="form-checkout__securityCode"></div>
            </div>
          </div>
          <hr class="mb-4">
          <h4 id="validation-error-messages"></h4>
          <button class="btn btn-primary btn-lg btn-block" id="form-checkout__submit" onclick="formSubmit()" type="button">Pagar</button>
          <progress style="display: none;" value="0" class="progress-bar">Carregando...</progress>
        </form>
      </div>
    </div>
  </div>

  <footer class="my-5 pt-5 text-muted text-center text-small">
    <p class="mb-1">&copy; 2017-2018 Company Name</p>
    <ul class="list-inline">
      <li class="list-inline-item"><a href="#">Privacy</a></li>
      <li class="list-inline-item"><a href="#">Terms</a></li>
      <li class="list-inline-item"><a href="#">Support</a></li>
    </ul>
  </footer>
  </div>

  <!-- Bootstrap core JavaScript
    ================================================== -->
  <!-- Placed at the end of the document so the pages load faster -->
  <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
  <script>
    window.jQuery || document.write('<script src="../../assets/js/vendor/jquery-slim.min.js"><\/script>')
  </script>
  <script src="https://sdk.mercadopago.com/js/v2"></script>
  <script>
    const mp = new MercadoPago("TEST-2da1a4b3-6ce6-4044-b610-00718add9291");
  </script>
  <script src="js/pages/payform.js"></script>
  <script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (function() {
      'use strict';

      window.addEventListener('load', function() {
        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.getElementsByClassName('needs-validation');

        // Loop over them and prevent submission
        var validation = Array.prototype.filter.call(forms, function(form) {
          form.addEventListener('submit', function(event) {
            if (form.checkValidity() === false) {
              event.preventDefault();
              event.stopPropagation();
            }
            form.classList.add('was-validated');
          }, false);
        });
      }, false);
    })();
  </script>
@endsection