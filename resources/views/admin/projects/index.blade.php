@extends('layouts.app')

@section('title', 'Projects')


@section('content')
<div class="container mb-4">
    <h1 class="my-4">Lista Progetti</h1>

    <a href="{{route('admin.projects.create')}}" class="btn btn-primary mb-4"><i class="fa-solid fa-plus fa-lg me-2"></i>Nuovo progetto</a>

    <div class="row g-4">
        <table class="table">
            <thead>
                <th>ID</th>
                <th>Titolo</th>
                @if(auth()->user()->role == 'admin')
                <th>Autore</th>
                @endif


                <th>Tipologia</th>
                <th>Tecnologie</th>
                <th>Estratto</th>
                <th></th>
            </thead>

            <tbody>
                @forelse($projects as $project)
                <tr>
                    <td>{{$project->id}}</td>
                    <td>{{$project->title}}</td>
                    @if(auth()->user()->role == 'admin')
                    <td>{{$project->user->name}}</td>
                    @endif
                    <td>{!! $project->type ? $project->type->getBadge() : 'Nessuna tipologia' !!}</td>

                    <td>
                        @forelse($project->technologies as $technology)
                        {!! $technology->getBadge() !!}
                        @empty
                        <p>Nessuna tecnologia</p>
                        @endforelse
                    </td>

                    <td>{{$project->getAbstract(50)}}</td>
                    <td>
                        <a href="{{$project->github_url}}"><i class="fa-brands fa-github  link-dark me-2"></i></a>
                        <a href="{{route('admin.projects.show', $project)}}"><i class="fa-solid link-primary fa-eye me-2"></i></a>
                        <a href="{{route('admin.projects.edit', $project)}}"><i class="fa-solid link-primary fa-pencil me-2"></i></a>
                        <button type="button" class="btn btn-link text-danger p-0 pb-1" data-bs-toggle="modal" data-bs-target="#project-{{$project->id}}">
                            <i class="fa-solid fa-trash"></i>
                        </button>


                    </td>
                </tr>

                @empty
                <h2>Nessun Progetto trovato</h2>
                @endforelse
            </tbody>


        </table>
    </div>
    {{$projects->links()}}
</div>

@endsection


@section('modal')
<!-- Modal -->
@foreach($projects as $project)

<div class="modal fade" id="project-{{$project->id}}" tabindex="-1" aria-labelledby="project-{{$project->id}}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Eliminare {{$project->title}}?</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                L'azione é irreversibile.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>
                <form action="{{route('admin.projects.destroy', $project)}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger">Elimina</button>
                </form>

            </div>
        </div>
    </div>
</div>
@endforeach

@endsection


@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection
