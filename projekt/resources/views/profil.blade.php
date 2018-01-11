@extends('layouts.app')
@section('title','Profil')


@section('content')

<section>
    <div class="section">
        <a href="/" class="btn-back">naspäť</a>
        <h1 class="h1-name">MENO PRIEZVISKO</h1>

         <table class="color-white-profil">
            <tr>
                <th>EMAIL:</th>
                <td>niekto@niečo.com</td>
                <td rowspan="2">
                    <img src="/img/profil.jpg" alt="fotka" width="193" height="209">
                </td>
             </tr>
             <tr>
                <th>TELEFÓNNE Č.:</th>
                <td>0900 000 000</td>
             </tr>
         </table>

         <p align="center" class="padding-top">
            <button type="submit" class="button-reg-login-udaje">UPRAVIŤ ÚDAJE</button>
        </p>
    </div>
    <div class="padding padding-top">
        <h1 class="h1-text">MOJE SKUPINY</h1>
        <table class="table">
            <tr>
                <th>MENO PRIEZVISKO</th>
                <th>46</th>
                <th>11:00</th>  
                <th><button type="submit" class="btn-fix btn-back">spravovať</button></th> 
            </tr>      
        </table>
        <a href="vytvor-skupinu.html" class="button-reg-login-udaje btn-profil">VYTVORIŤ SKUPINU</a><br>
        <a href="vytvor-clena.html" class="button-reg-login-udaje btn-profil">VYTVORIŤ ČLENA</a>
    </div>
</section>   

@endsection