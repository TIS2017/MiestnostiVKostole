@extends('layouts.app')
@section('title','Profil')


@section('content')

<section>
    <div class="section">
        <a href="/" class="btn-back">naspäť</a>
        <h1 class="h1-name">MENO PRIEZVISKO</h1>

         <table class="color-white-profil" align="center">
            <tr>
                <th class="width-200">EMAIL:</th>
                <td>niekto@niečo.com</td>
                <td rowspan="2">
                    <img src="/img/profil.jpg" alt="fotka" width="193" height="209">
                </td>
             </tr>
             <tr>
                <th class="width-200">TELEFÓNNE Č.:</th>
                <td>0900 000 000</td>
             </tr>
         </table>

         <p align="center" class="padding-top">
            <button type="submit" class="button-reg-login-udaje">UPRAVIŤ ÚDAJE</button>
        </p>
    </div>
    <div class="padding padding-top">
        <h1 class="h1-text">MOJE SKUPINY</h1>
        <table class="filtab">
            <tr>
                <th class="filter">SKUPINA</th>
                <th class="filter">46</th>
                <th class="filter">11:00</th>
                @if( Auth::user()->is_admin == true) 
                <?php //neskor dat aj moznost spravovania pre naduzivatela 
                ?>
                    <th class="filter">
                        <a href="/sprava-skupin" class="btn-fix btn-back">spravovať</a>
                    </th>
                    <th class="filter"><button type="submit" class="btn-fix btn-back">ZRUŠIŤ</button></th>
                @endif
            </tr>      
        </table>

        @if( Auth::user()->is_admin == true)
            <a href="/profil/vytvor-skupinu" class="button-reg-login-udaje btn-profil">VYTVORIŤ SKUPINU</a><br>
            <a href="/profil/vytvor-clena" class="button-reg-login-udaje btn-profil">VYTVORIŤ ČLENA</a>
        @endif
    </div>
</section>   

@endsection