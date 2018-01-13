@extends('layouts.app')
@section('title','Údaje o skupine')


@section('content')

<section>
    <div class="section padding-bottom">
        <a href="{{ redirect()->back()->getTargetUrl() }}" class="btn-back">naspäť</a>
        <h1 class="h1-name">NÁZOV SKUPINY</h1>
         <table class="color-white-profil">
            <tr>
                <th class="width-200">VEDÚCI SKUPINY:</th>
                <td class="width-200">MENO PRIEZVISKO</td>
                @if (Auth::check ())
                    <td rowspan="3" class="width-200">
                @else
                <td class="width-200" >
                @endif
                    <img src="/img/profil.jpg" alt="fotka" width="193" height="209">
                </td>
            </tr>
            @if (Auth::check ())
                <tr>
                    <th class="width-200">EMAIL:</th>
                    <td class="width-200">niekto@niečo.com</td>
                </tr>
                <tr>
                    <th class="width-200">TELEFÓNNE Č.:</th>
                    <td class="width-200">0900 000 000</td>
                </tr>
            @endif
         </table>
    </div>

    @if (Auth::check ())
    <div>
      <h1 class="h1-text">ČLENOVIA</h1>
        <table class="filtab">
             <tr>
             <th class="mena">MENO PRIEZVISKO</th>
             </tr>          
        </table>
        <p class="vstupdoskup" align="center">
           <button type="submit" class="button-reg-login-udaje btn-profil">VSTÚPIŤ DO SKUPINY</button>
        </p>
    </div> 
    @endif

</section>   

@endsection