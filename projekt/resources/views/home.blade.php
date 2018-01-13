@extends('layouts.app')
@section('title','U kapucínov')


@section('content')

<section>
    <div class="alert-messages text-center"></div>

    <!-- Mapa -->
    <div class="section-mapa">
        @include('layouts.includes.mapa')
    </div>

    <?php 
    	$miestnost="/img/miestnost.png";
    	$cas="/img/cas.png";
    	$skupina="/img/skupina.png";
	?>
	
    @include('layouts.includes.filter')
</section> 

    <script type="text/javascript">
        function showAlert(message) {
            var htmlAlert = '<div class="alert alert-success">' + message + '</div>';
            $(".alert-messages").prepend(htmlAlert);
            $(".alert-messages .alert").first().hide().fadeIn(200).delay(2000).fadeOut(1000, function () { $(this).remove(); });
        }
    </script>
    @if(session('Status'))
        <script type="text/javascript">
            showAlert("Registrácia prebehla úspešne.");
        </script>
    @endif


@endsection