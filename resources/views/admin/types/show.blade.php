@extends('layouts.app')

@section('title', $type->label)

@section('content')
<div class="container mt-4">

    <a href="{{route('admin.types.index')}}" class="btn btn-primary my-3 fs-4">Torna alla lista</a>

    <h2 class="card-title fs-1 my-3">{{$type->label}}</h2>

    <p class="my-3">{!!$type->getBadge()!!}</p>


    @if(auth()->user()->role == 'admin')
    <ul class="d-flex mt-4">
        <li>
            <a href="{{route('admin.types.edit', $type)}}" class="m2-3"><i class="fa-solid link-primary fa-pencil fa-xl me-3"></i></a>

        </li>
        <li>
            <button type="button" class="btn btn-link p-0" data-bs-toggle="modal" data-bs-target="#type-{{$type->id}}">
                <i class="fa-solid link-danger fa-trash fa-xl"></i>
            </button>

        </li>

    </ul>
    @endif

    <div class="projects-related mt-3">
        <h2>Progetti affiliati</h2>

        <table class="table">
            <thead>
                <th>ID</th>
                <th>Titolo</th>

                @if(auth()->user()->role == 'admin')
                <th>Autore</th>
                @endif

                <th>Estratto</th>
                <th></th>
            </thead>

            <tbody>
                @foreach($projects as $project)

                <tr>
                    <td>{{$project->id}}</td>
                    <td>{{$project->title}}</td>
                    @if(auth()->user()->role == 'admin')
                    <td>{{$project->user->name}}</td>
                    @endif
                    <td>{{$project->getAbstract(50)}}</td>
                    <td>

                    </td>
                </tr>

                @endforeach

            </tbody>
        </table>
    </div>
    {{$projects->links()}}
</div>
@endsection

{{-- cdn fontawesone --}}
@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

@section('modal')
<!-- Modal -->
<div class="modal fade" id="type-{{$type->id}}" tabindex="-1" aria-labelledby="type-{{$type->id}}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Eliminare {{$type->label}}?</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                L'azione é irreversibile.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>
                <form action="{{route('admin.types.destroy', $type)}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger">Elimina</button>
                </form>

            </div>
        </div>
    </div>
</div>


@endsection
