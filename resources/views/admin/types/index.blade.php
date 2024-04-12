@extends('layouts.app')

@section('title', 'Types')


@section('content')
<div class="container mb-4">
    <h1 class="my-4">Lista Tipologie</h1>

    @if(auth()->user()->role == 'admin')
    <a href="{{route('admin.types.create')}}" class="btn btn-primary mb-4"><i class="fa-solid fa-plus fa-lg me-2"></i>Nuovo tipologia</a>
    @endif

    <div class="row g-4">
        <table class="table">
            <thead>
                <th>ID</th>
                <th>Label</th>
                <th>Colore</th>
                <th>Badge</th>
                <th></th>
            </thead>

            <tbody>
                @forelse($types as $type)
                <tr>
                    <td>{{$type->id}}</td>
                    <td>{{$type->label}}</td>
                    <td>{{$type->color}}</td>
                    <td>{!! $type->getBadge() ?? 'Nessuna tipologia' !!}</td>
                    <td>
                        <a href="{{route('admin.types.show', $type)}}"><i class="fa-solid link-primary fa-eye me-2"></i></a>

                        @if(auth()->user()->role == 'admin')
                        <a href="{{route('admin.types.edit', $type)}}"><i class="fa-solid link-primary fa-pencil me-2"></i></a>
                        <button type="button" class="btn btn-link text-danger p-0 pb-1" data-bs-toggle="modal" data-bs-target="#type-{{$type->id}}">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                        @endif


                    </td>
                </tr>

                @empty
                <h2>Nessun Progetto trovato</h2>
                @endforelse
            </tbody>


        </table>
    </div>
    {{$types->links()}}
</div>

@endsection


@section('modal')
<!-- Modal -->
@foreach($types as $type)

<div class="modal fade" id="type-{{$type->id}}" tabindex="-1" aria-labelledby="type-{{$type->id}}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Eliminare {{$type->label}}?</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>L'azione é irreversibile.</p>
                <p><span class="text-danger">Attenzione: </span><strong>L'eliminazione della tipologia comporta l'eliminazione di tutti i progetti ad esso collegati!!! Continuare?</strong></p>
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
@endforeach

@endsection


@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection
