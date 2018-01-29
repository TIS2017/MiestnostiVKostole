@extends('layouts.app')
@section('title','Údaje o skupine')
@section('content')

@if($is_subadmin>0)
<article>
    <div class="section">
        <a href="/" class="btn-back">naspäť</a>
        <h1 class="h1-name">{{$groupName}}</h1>
    </div>
</article>
<section>
  <div class="container-fluid section-filtracia">
      
    <h1 class="h1-text">ČLENOVIA</h1>
    @if(!empty($members))
        @if($members->count()==0)
            <p align=center>Skupina nemá žiadnych členov.</p>
        @else
            <table class="filtab" align="center">
            @foreach ($members as $member)
                <tr>
                    <td class="width-200">{{$member->firstname}}  {{$member->lastname}}</td>
                    <td class="width-200">{{$member->email}}</td>
                    <td class="width-200">{{$member->tel}}</td>
              </tr>     
              @endforeach    
            </table>  
        @endif
    @endif
  </div>
  <div class="content">
    <div class="content-second">
    </div>
  </div>
    <div class="padding">       
        <h1 class="h1-text">ŽIADOSTI</h1>
        @if(!empty($requests))
            @if($requests->count()==0)
                <p align=center>V tejto skupine sa nenachádzajú žiadne žiadosti.</p>
            @else
                <table class="filtab">
                @foreach ($requests as $request)
                    <tr>
                        <th class="width-200">{{$request->firstname}}  {{$request->lastname}}</th>
                        <th class="width-200">žiadosť o pridanie</th>
                        <form method="post" action="/udaje-o-skupine/{{ $groupName }}/{{ $request->group_id}}" >
                        {{ csrf_field() }}
                            <th class="filter"><button type="submit" class="btn-fix btn-back">schváliť</button></th>
                        </form>
                        <form method="post" action="/udaje-o-skupine/{{ $groupName }}/{{ $request->group_id}}" >
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                            <th class="filter"><button type="submit" class="btn-fix btn-back">zamietnuť</button></th>
                        </form>
                    </tr>
                @endforeach  
                </table>
            @endif
        @endif
    </div>

    @else
    <section>
        <div class="alert-messages text-center"></div>
        <div class="section padding-bottom">
            <a href="/" class="btn-back">naspäť</a>

            @if(!empty($subadmin_data))
                    @foreach ($subadmin_data as $data)
                        <h1 class="h1-name">{{$groupName}}</h1>
                        <table class="color-white-profil">
                            <tr>
                                <th class="width-200">VEDÚCI SKUPINY:</th>
                                <td class="width-200">{{$data->firstname}} {{$data->lastname}}</td>
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
                                    <td class="width-200">{{$data->email}}</td>
                                </tr>
                                <tr>
                                    <th class="width-200">TELEFÓNNE Č.:</th>
                                    <td class="width-200">{{$data->tel}}</td>
                                </tr>
                            @endif
                        </table>
                    @endforeach
            @endif
        </div>

        @if (Auth::check () && $subadmin_data->count()!=0)
        <div>
             <h1 class="h1-text">ČLENOVIA</h1>
                @if(!empty($members))
                    @if($members->count()==0)
                        <p align=center>Skupina nemá žiadnych členov.</p>
                    @else
                        <table class="filtab">
                        @foreach ($members as $member)
                            <tr>
                            <th class="mena">{{$member->firstname}}  {{$member->lastname}}</th>
                            </tr>          
                        @endforeach
                        </table>
                    @endif

                    @if($is_member < 1)
                        <form method="post" action="/udaje-o-skupine/{{ $groupName }}" >
                        {{ csrf_field() }}
                            <p class="vstupdoskup" align="center">
                                <button type="submit" class="button-reg-login-udaje btn-profil">VSTÚPIŤ DO SKUPINY</button>
                            </p>
                        </form>
                    @endif
                @endif
        </div>
        @endif
    @endif
</section> 
    <script src="{{ asset('js/custom.js') }}"></script>
    @if(session('Status'))
        <script type="text/javascript">
            showAlert("Žiadosť bola úspešne odoslaná.");
        </script>
    @endif 

@endsection