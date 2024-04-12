@extends('layouts.app')

@section('title', empty($type->id) ? "Crea Tipologia" : "Modifica Tipologia")

@section('content')
<section>
    <div class="container py-4">

        <a href="{{route('admin.types.index')}}" class="btn btn-primary my-3"><i class="fa-solid fa-table-list me-2"></i>Torna alla lista</a>




        <h1 class="my-3">{{empty($type->id) ? "Crea Tipologia" : "Modifica Tipologia"}}</h1>
        <form action="{{ empty($type->id) ? route('admin.types.store') : route('admin.types.update', $type) }}" method="POST">
            @csrf
            @if($type->id)
            @method('PUT')
            @endif
            <div class="row">
                <div class="col-1">
                    <label for="color" class="form-label">Colore </label>
                    <input type="color" class="form-control @error('color') is-invalid @enderror" id="color" name="color" value="{{ empty($type->id) ? '' : old('color') ?? $type->color }}" required max="7" />
                    @error('color')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="col-11">
                    <label for="label" class="form-label">Nome </label>
                    <input type="text" class="form-control @error('label') is-invalid @enderror" id="label" name="label" value="{{ empty($type->id) ? '' : old('label') ?? $type->label }}" required max="40" />
                    @error('label')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>
            <button type="submit" class="btn btn-success mt-2"><i class="fa-solid fa-floppy-disk me-2"></i>Salva</button>
        </form>

    </div>
</section>
@endsection


@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection
