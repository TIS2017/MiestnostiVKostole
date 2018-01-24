@extends('layouts.app')
@section('title','Vytvorenie skupiny')

@section('content')
<section>
	<div class="section">
    <a href="/profil" class="btn-back">naspäť</a>
    @include('layouts.includes.error')
		<h1 class="center h1-text2">
		 	<span class="h1-a active1">VYTVORENIE SKUPINY</span>
	    </h1>
	    	<form class="formular" method="POST" action="/profil/vytvor-skupinu">
	    	{{ csrf_field() }}
	          	<p class="formular" align="center">
			    	<input type="text" placeholder="NÁZOV SKUPINY" name="name" value="{{ old('name') }}" required><br>
			    	<select class="vyber" name="subadmin" id="meno">
			            <option value="vyber">--VYBER VEDÚCEHO--</option>
			            @if(!empty($users))
		                    @foreach ($users as $user)
		                        <option value="{{$user->id}}">{{$user->firstname}} {{$user->lastname}}</option>
		                    @endforeach
		                @endif
			        </select><br>
		    		<button type="submit" class="button-reg-login-udaje">REGISTER</button>
	          	</p>
    		</form>
    </div>


</section>

@endsection