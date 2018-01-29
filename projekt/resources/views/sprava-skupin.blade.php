@extends('layouts.app')
@section('title','Správa skupín')

@section('content')

@include('layouts.includes.error')
<article>
    <div class="section">
        <a href="/profil" class="btn-back">naspäť</a>
        <h1 class="h1-name">{{ $groupname }}</h1>
    </div>
</article>
<section>
  <div class="alert-messages text-center"></div>
  <div class="container-fluid section-filtracia">
      <form method="post" action="{{action('GroupManagementController@addRoom', $groupname)}}" >
        {{ csrf_field() }}
        <h1 class="h1-text">PRIRADIŤ MIESTNOSŤ</h1>
        <p class="formular" align="center">  

          <select class="vyber" name="room">
              <option value="vyber">--Vyber miestnosť--</option>
              @foreach ($rooms as $room)
              <option value="{{ $room->id }}" {{(Input::old("room") == $room->id ? "selected":"")}}>{{ $room->name }}</option>
              @endforeach
          </select>

          <select class="den" name="day">
              <option value="vyber">--Vyber deň--</option>
              <option value="1" {{ (Input::old("day") == 1 ? "selected":"")}}>Pondelok</option>
              <option value="2" {{ (Input::old("day") == 2 ? "selected":"")}}>Utorok</option>
              <option value="3" {{ (Input::old("day") == 3 ? "selected":"")}}>Streda</option>
              <option value="4" {{ (Input::old("day") == 4 ? "selected":"")}}>Štvrtok</option>
              <option value="5" {{ (Input::old("day") == 5 ? "selected":"")}}>Piatok</option>
              <option value="6" {{ (Input::old("day") == 6 ? "selected":"")}}>Sobota</option>
              <option value="7" {{ (Input::old("day") == 7 ? "selected":"")}}>Nedeľa</option>
          </select>

          <select class="time" name="time">
              <option value="vyber">--čas--</option>
              @for ($i = 8; $i < 21; $i++)
                @if ($i < 10)
                  <option value="0{{ $i }}:00" {{ (Input::old("time") == "0$i:00" ? "selected":"")}} >0{{ $i }}:00</option>
                @else
                  <option value="{{ $i }}:00" {{ (Input::old("time") == "$i:00" ? "selected":"")}}>{{ $i }}:00</option>
                @endif
              @endfor
          </select>

          <button type="submit" class="button-reg-login-udaje">PRIDAJ</i></button>
        </p>
      </form>

      <form method="post" action="{{action('GroupManagementController@addMember', $groupname)}}" >
      {{ csrf_field() }}
          <h1 class="h1-text">PRIDAŤ ČLENA</h1>
          <p class="formular" align="center">  
              <select class="vyber" name="name">
                <option value="vyber">--Vyber člena--</option>
                @foreach ($users as $user)
                    <option value="{{$user->id}}" {{(Input::old("name") == $user->id ? "selected":"")}}>{{$user->firstname}} {{$user->lastname}}</option>
                @endforeach
              </select>
              <select class="den" name="type">
                  <option value="vyber">--Typ použ.--</option>
                  <option value="1" {{ (Input::old("type") == 1 ? "selected":"")}}>obyčajný</option>
                  <option value="2" {{ (Input::old("type") == 2 ? "selected":"")}}>nadužívateľ</option>
                  <option value="3" {{ (Input::old("type") == 3 ? "selected":"")}}>administrátor</option>
              </select>
              <button type="submit" class="button-reg-login-udaje">PRIDAJ</i></button>
          </p>
      </form>
      
    <h1 class="h1-text">ČLENOVIA</h1>
    @if($members->count() == 0)
        <p align=center class="formular">Skupina nemá žiadnych členov.</p>
    @else
    	<table class="filtab formular" align="center">
          @foreach ($members as $member)
          <tr>
              <td class="width-200">{{$member->firstname}}  {{$member->lastname}}</td>
              <td class="width-200">{{$member->email}}</td>
              <td class="width-200">{{$member->tel}}</td>
          </tr>     
          @endforeach    
      </table>    
    @endif
  </div>
  <div class="content">
    <div class="content-second">
    </div>
  </div>
	<div class="padding">		
		  <h1 class="h1-text">ŽIADOSTI</h1>
			<table class="filtab">
			 		<tr>
					   	<th class="width-200">MENO PRIEZVISKO</th>
	   					<th class="width-200">žiadosť o pridanie</th>
              <th class="filter"><button type="submit" class="btn-fix btn-back">schváliť</button></th>
              <th class="filter"><button type="submit" class="btn-fix btn-back">zamietnuť</button></th>
			  	</tr>
          <tr>
					   	<th class="width-200">MIESTNOSŤ</th>
	   					<th class="width-200">11:00</th>
              <th class="filter"><button type="submit" class="btn-fix btn-back">schváliť</button></th>
              <th class="filter"><button type="submit" class="btn-fix btn-back">zamietnuť</button></th>
			  	</tr>
		 	</table>
	 	</div>
</section>

<script src="{{ asset('js/custom.js') }}"></script>

    @if(session('status'))
        <script type="text/javascript">
            showAlert("Miestnosť bola úspešne priradená.");
        </script>
    @elseif(session('StatusMember'))
        <script type="text/javascript">
            showAlert("Člen bol úspešne priradený do tejto skupiny.");
        </script>
    @elseif(session('StatusSubadmin'))
        <script type="text/javascript">
            showAlert("Nadužívateľ bol úspešne priradený do tejto skupiny.");
        </script>
    @elseif(session('StatusAdmin'))
        <script type="text/javascript">
            showAlert("Používateľ bol úspešne priradený ako administrátor.");
        </script>
    @endif
@endsection