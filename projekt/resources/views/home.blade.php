@extends('layouts.app')
@section('title','U kapucínov')


@section('content')

<section>
    <div class="alert-messages text-center"></div>

    <!-- Mapa -->
    <div class="section-mapa">
        @include('layouts.includes.map')
    </div>

    <?php 
    	$miestnost="/img/miestnost.png";
    	$cas="/img/cas.png";
    	$skupina="/img/skupina.png";
	?>
	
    @include('layouts.includes.filter')
</section> 

    <script src="{{ asset('js/custom.js') }}"></script>
    @if(session('Status'))
        <script type="text/javascript">
            showAlert("Registrácia prebehla úspešne.");
        </script>
    @endif


@endsection