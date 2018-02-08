@extends('layouts.app')
@section('title','Úprava údajov')

@section('content')
<section>
	<div class="alert-messages text-center"></div>
	<div class="section">
		@include('layouts.includes.error')
		<a href="/profil" class="btn-back">naspäť</a>
		<h1 class="center h1-text2">
		 	<h1 class="h1-name">Úprava údajov</h1>
	    </h1>
	    @if(!empty($user))
	    @foreach ($user as $u)
	    <form class="formular" method="POST" action="{{ url('/profil/uprava/edit') }}" enctype="multipart/form-data">
	    {{ csrf_field() }}
	    	<p class="formular" align="center">
		    	<input type="text" placeholder="MENO" name="firstname" value="{{ $u->firstname }}" required>
		    	<input type="text" placeholder="EMAIL" name="email" value="{{ $u->email }}"><br>
		    	<input type="text" placeholder="PRIEZVISKO" name="lastname" value="{{ $u->lastname }}" required>
		    	<input type="text" placeholder="PRIHLASOVACIE MENO" name="username" value="{{ $u->username }}" required><br>
		    	<input type="text" placeholder="TELEFÓNNE ČÍSLO" name="tel" value="{{ $u->tel }}" ><br>
		    	<label for="files">Nahrať fotku:</label>
	    		<input type="file" id="files" name="file" class="file" multiple><br>
	    		<button type="submit" class="button-reg-login-udaje">Uložiť</button><br>
	    		<button type="button" class="button-reg-login-udaje" data-toggle="modal" data-target="#myModal">Zmeniť heslo</button>
	    	</p>
    	</form>
    	@endforeach
    	<div class="modal fade" id="myModal" role="dialog">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
				    	<button type="button" class="close" data-dismiss="modal">&times;</button>
				        <h4 class="modal-title">Zmena hesla</h4>
				    </div>
				    <div class="modal-body" align="center">
				        <form class="formular" method="POST" action="{{action('profilController@updatePassword')}}">
	    				{{ csrf_field() }}
						    <div class="form-group">
						        <input type="password" name="old_password" placeholder="STARÉ HESLO" required>
						    </div>
						    <div class="form-group">
						        <input type="password" name="password" placeholder="NOVÉ HESLO" required>
						    </div>
						    <button type="submit" class="btn-back" style="background: rgb(43,17,0);">Uložiť</button>
					    </form>
				    </div>
				</div>
			</div>
		</div>
    	@endif
    </div>

</section>
<script src="{{ asset('js/custom.js') }}"></script>
@if(session('Status'))
    <script type="text/javascript">
    	showModal();
        showAlert("Zadali ste nesprávne heslo.","alert-danger");
    </script>
@elseif(session('MinPass'))
	<script type="text/javascript">
    	showModal();
        showAlert("Heslo musí mať aspoň 6 znakov.","alert-danger");
    </script>
@elseif(session('Succes'))
	<script type="text/javascript">
        showAlert("Heslo bolo úspešne zmenené.");
    </script>
@endif
@endsection