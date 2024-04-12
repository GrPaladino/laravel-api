@extends('layouts.app')

@section('title', $project->title)

@section('content')
<div class="container mt-4">

    <a href="{{route('admin.projects.index')}}" class="btn btn-primary my-3 fs-4">Torna alla lista</a>

    {{-- @dd($project) --}}


    <h2 class="card-title fs-1 mt-3">{{$project->title}}</h2>
    <div class="d-flex mt-5">

        <div class="img me-5" style="width: 18rem;">
            <img src="{{ asset('storage/' . $project->image)}}" class="card-img-top" alt="{{$project->image}}">
        </div>
        <div class="card-body d-flex flex-column justify-content-between">

            <div class="description">
                <p class="card-text">{{$project->description}}</p>
                <p><strong>Tipologia: </strong>{!! $project->type ? $project->type->getBadge() : 'Nessuna tipologia' !!}</p>
                <p><strong>Tecnologie utilizzate: </strong>

                    @foreach($project->technologies as $technology)

                    {!! $technology ? $technology->getBadge() : 'Nessuna tecnologia' !!}
                    @endforeach
                </p>

            </div>
            <div class="links text-start">
                <a href="{{$project->github_url}}" class="mb-3"><i class="fa-brands fa-github link-dark fa-2xl me-3"></i></a>
                <a href="{{route('admin.projects.edit', $project)}}" class="mb-3"><i class="fa-solid link-primary fa-pencil fa-xl me-3"></i></a>
                <button type="button" class="btn btn-link p-0" data-bs-toggle="modal" data-bs-target="#project-{{$project->id}}">
                    <i class="fa-solid link-danger fa-trash fa-xl"></i>
                </button>

            </div>
        </div>
    </div>
</div>
@endsection

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

@section('modal')
<!-- Modal -->
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



@endsection
