@extends('layout')
@section('content')
<div class="container">
    <div class="py-5 text-center">
        <img class="d-block mx-auto mb-4" src="../../assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">
        <h2>Checkout form</h2>
        <p class="lead">Below is an example form built entirely with Bootstrap's form controls. Each required form group has a validation state that can be triggered by attempting to submit the form without completing it.</p>
    </div>
    <div class="col-md-8 order-md-1">
        <h4 class="mb-3">Obrigado por comprar com a gente, volte sempre!!</h4>
        @if($link)
        <h6 class="mb-3">Use o link abaixo para abrir o boleto</h6>
        <h6 class="mb-3"><a href="{{$link}}">{{$link}}</a></h6>
        @endif
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
@endsection