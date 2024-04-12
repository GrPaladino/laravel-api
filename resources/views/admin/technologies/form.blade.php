@extends('layouts.app')

@section('title', empty($technology->id) ? "Crea Tecnologia" : "Modifica Tecnologia")

@section('content')
<section>
    <div class="container py-4">

        <a href="{{route('admin.technologies.index')}}" class="btn btn-primary my-3"><i class="fa-solid fa-table-list me-2"></i>Torna alla lista</a>




        <h1 class="my-3">{{empty($technology->id) ? "Crea Tecnologia" : "Modifica Tecnologia"}}</h1>
        <form action="{{ empty($technology->id) ? route('admin.technologies.store') : route('admin.technologies.update', $technology) }}" method="POST">
            @csrf
            @if($technology->id)
            @method('PUT')
            @endif
            <div class="row">
                <div class="col-1">
                    <label for="color" class="form-label">Colore </label>
                    <input type="color" class="form-control @error('color') is-invalid @enderror" id="color" name="color" value="{{ empty($technology->id) ? '' : old('color') ?? $technology->color }}" required max="7" />
                    @error('color')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="col-11">
                    <label for="label" class="form-label">Nome </label>
                    <input type="text" class="form-control @error('label') is-invalid @enderror" id="label" name="label" value="{{ empty($technology->id) ? '' : old('label') ?? $technology->label }}" required max="40" />
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
