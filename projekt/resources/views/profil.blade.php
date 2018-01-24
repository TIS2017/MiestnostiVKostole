@extends('layouts.app')
@section('title','Profil')


@section('content')

<section>
    <div class="alert-messages text-center"></div>
    <div class="section">
        <a href="/" class="btn-back">naspäť</a>
        <h1 class="h1-name">{{ Auth::user()->firstname}} {{ Auth::user()->lastame }}</h1>

         <table class="color-white-profil" align="center">
            <tr>
                <th class="width-200">EMAIL:</th>
                <td>{{ Auth::user()->email }}</td>
                <td rowspan="2">
                    <img src="/img/profil.jpg" alt="fotka" width="193" height="209">
                </td>
             </tr>
             <tr>
                <th class="width-200">TELEFÓNNE Č.:</th>
                <td>{{ Auth::user()->tel }}</td>
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

                @if(!empty($mygroups))
                    @foreach ($mygroups as $group)
                        <th class="filter">SKUPINA</th>
                        <th class="filter">{{$group->name}}</th>
                        <th class="filter">11:00 ??? </th>
                    @endforeach
                @endif

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
            <p align="center">
                <a href="/profil/vytvor-skupinu" class="button-reg-login-udaje btn-profil">VYTVORIŤ SKUPINU</a><br>
                <a href="/profil/vytvor-clena" class="button-reg-login-udaje btn-profil">VYTVORIŤ ČLENA</a>
            </p>
        @endif
    </div>
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
            showAlert("Registrácia člena prebehla úspešne.");
        </script>
    @elseif(session('Skupina'))
        <script type="text/javascript">
            showAlert("Skupina bola úspešne vytvorená.");
        </script>
    @endif


@endsection