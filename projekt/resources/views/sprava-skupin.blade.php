@extends('layouts.app')
@section('title','Správa skupín')

@section('content')

<article>
    <div class="section">
        <a href="/profil" class="btn-back">naspäť</a>
        <h1 class="h1-name">NÁZOV SKUPINY</h1>
    </div>
</article>
<section>
  <div class="container-fluid section-filtracia">

  <?php /* toto moze len admin*/ ?>
      <form class="formular">
        <h1 class="h1-text">PRIRADIŤ MIESTNOSŤ</h1>
        <p class="formular" align="center">  
          <select class="vyber" name="miestnost" id="miestnost">
            <option value="vyber">--Vyber miestnosť--</option>
            <option value="1">55</option>
          </select>
          <select class="den" name="den" id="den">
            <option value="vyber">--Vyber deň--</option>
            <option value="1">Pondelok</option>
            <option value="2">Utorok</option>
            <option value="3">Streda</option>
            <option value="4">Štvrtok</option>
            <option value="5">Piatok</option>
            <option value="6">Sobota</option>
            <option value="7">Nedeľa</option>
          </select>
          <select class="od" name="od" id="od">
            <option value="vyber">--od--</option>
            <option value="1">11hod</option>
          </select>
          <select class="do" name="do" id="do">
            <option value="vyber">--do--</option>
            <option value="1">12hod</option>
          </select>
          <button type="submit" class="button-reg-login-udaje">PRIDAJ</i></button>
        </p>
      </form>

      <form class="formular">
        <h1 class="h1-text">PRIDAŤ ČLENA</h1>
        <p class="formular" align="center">  
          <select class="vyber" name="meno" id="meno">
            <option value="vyber">--Vyber člena--</option>
            <option value="1">Jano Mrkvicka</option>
          </select>
          <select class="den" name="pouz" id="pouz">
            <option value="vyber">--Typ pouz--</option>
            <option value="1">obyc</option>
            <option value="2">naduz</option>
            <option value="3">admin</option>
          </select>
          <button type="submit" class="button-reg-login-udaje">PRIDAJ</i></button>
        </p>
      </form>
      <?php /*-------------------------------*/ ?>
      
    <h1 class="h1-text">ČLENOVIA</h1>
  	<table class="filtab" align="center">
  	 	<tr>
  		 <th class="width-200">MENO PRIEZVISKO</th>
       <th class="width-200">meno@nieco.com</th>
       <th class="width-200">0900 000 000</th>
  	  </tr>		
      <tr>
  		 <th class="width-200">MENO PRIEZVISKO</th>
       <th class="width-200">meno@nieco.com</th>
       <th class="width-200">0900 000 000</th>
  	  </tr> 	
 	 	</table>  
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

@endsection