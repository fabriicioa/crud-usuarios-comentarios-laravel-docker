@extends('layouts.app')

@section('title', 'Listagem dos usuários')

@section('content')

    <h1> 
        Listagem de usuarios
    </h1>

    <form action=" {{ route('users.index') }} " method="GET">
        <input type="text" name="search" placeholder="Pesquisar" >
        <button>Pesquisar</button>
    </form>

    <h3>
        <a href="{{ route('users.create') }}"> Criar Novo Usuário</a> 
    </h3>

    <ul>
        @foreach($users as $user)
            <li>
                @if ($user->image)
                    <img src="{{ url("storage/{$user->image}") }}" alt="{{$user->image}}" style="width:10rem; heigth: 10rem;">
                @else
                    <img src="{{ url("storage/app/public/users/defaut.jpg") }}" alt="{{$user->image}}" style="width:10rem; heigth: 10rem;">
                @endif
                
                {{ $user->name }} - 
                {{ $user->email }}
                | <a href="{{ route('users.show', ['id' => $user->id])}}">Visualizar</a>
                | <a href="{{ route('users.edit', ['id' => $user->id])}}">Editar</a>
                | <a href="{{ route('comments.index', ['id' => $user->id])}}">Comentários ({{ $user->comments->count() }})</a>
                
                | <form action="{{ route('users.destroy', $user->id)}}" method="POST" >
                    @csrf
                    @method('delete')
                    <button type="submit">Deletar</button>
                </form>
            </li>
            
        @endforeach
    </ul>

    <div class="py-4">
        {{ $users->appends([
            'search' => request()->get('search', '')
        ])->links() }}
    </div>

@endsection
