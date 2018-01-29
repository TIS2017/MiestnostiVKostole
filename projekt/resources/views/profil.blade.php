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
                    <img src="/{{ Auth::user()->image_path }}" alt="fotka" width="200" height="200">
                </td>
             </tr>
             <tr>
                <th class="width-200">TELEFÓNNE Č.:</th>
                <td>{{ Auth::user()->tel }}</td>
             </tr>
         </table>

         <p align="center" class="padding-top">
            <a href="{{ url('/profil/uprava') }}" class="button-reg-login-udaje">UPRAVIŤ ÚDAJE</a>
        </p>
    </div>
    <div class="padding padding-top">
    @if( Auth::user()->is_admin != true)
        <h1 class="h1-text">MOJE SKUPINY</h1>
        @if($mygroups->count()==0 && $subadminGroups->count() == 0)
            <p align=center>Zoznam je prázdny.</p>
        @elseif(!empty($mygroups) || !empty($subadminGroups))
            <table class="filtab">
            <tr>
                <th class="filter">Skupina</th>
                <th class="filter">Miestnosť</th>
                <th class="filter">Čas</th>
                @if($subadminGroups->count() > 0)
                <th class="filter"></th>
                @endif
            </tr>
            @foreach ($mygroups as $group)
            <tr>
                <td class="filter">{{$group->group}}</td>
                <td class="filter">{{$group->room}}</td>
                <td class="filter">{{$group->time}}</td>
            </tr> 
            @endforeach
        @endif 
        @if(!empty($subadminGroups))
            @foreach ($subadminGroups as $group)
            <tr>
                <td class="filter">{{$group->group}}</td>
                <td class="filter">{{$group->room}}</td>
                <td class="filter">{{$group->time}}</td>
                <td class="filter">
                    <a href="/udaje-o-skupine/{{ $group->group }}" class="btn-fix btn-back">spravovať</a>
                </td>
            </tr> 
            @endforeach
        @endif
        </table>
    @else
        <h1 class="h1-text">SKUPINY</h1>
        @if($allgroups->count() > 0)
        <table class="filtab">
            @foreach ($allgroups as $group)
            <tr>
                <td class="filter padding-top">{{$group->name}}</td>
                <td class="filter">
                    <a href="/sprava-skupin/{{$group->name}}" class="btn-back btn-manage">spravovať</a>
                </td>
                <td class="filter">
                <form method="post" action="/profil/{{ $group->id }}/delete" >
                {{ csrf_field() }}
                {{ method_field('DELETE') }}
                    <button type="submit" class="two">ZRUŠIŤ</button>
                </form>
                </td>
            </tr> 
            @endforeach
        </table>
        @endif
        <p align="center" class="padding-top">
            <a href="/profil/vytvor-skupinu" class="button-reg-login-udaje btn-profil">VYTVORIŤ SKUPINU</a><br>
            <a href="/profil/vytvor-clena" class="button-reg-login-udaje btn-profil">VYTVORIŤ ČLENA</a>
        </p>
    @endif
    </div>
</section>   

    <script src="{{ asset('js/custom.js') }}"></script>

    @if(session('Status'))
        <script type="text/javascript">
            showAlert("Registrácia člena prebehla úspešne.");
        </script>
    @elseif(session('Skupina'))
        <script type="text/javascript">
            showAlert("Skupina bola úspešne vytvorená.");
        </script>
    @elseif(session('Update'))
        <script type="text/javascript">
            showAlert("Údaje sú úspešne uložené.");
        </script>
    @endif


@endsection