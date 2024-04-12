@extends('layouts.app')

@section('title', empty($project->id) ? "Crea Progetto" : "Modifica Progetto")

@section('content')
<section>
    <div class="container py-4">


        {{-- @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
        @endforeach
        </ul>
    </div>
    @endif --}}

    <a href="{{route('admin.projects.index')}}" class="btn btn-primary my-3"><i class="fa-solid fa-table-list me-2"></i>Torna alla lista</a>




    <h1 class="my-3">{{empty($project->id) ? "Crea Progetto" : "Modifica Progetto"}}</h1>
    <form enctype="multipart/form-data" action="{{ empty($project->id) ? route('admin.projects.store') : route('admin.projects.update', $project) }}" method="POST">
        @csrf
        @if($project->id)
        @method('PUT')
        @endif
        <div class="row">

            <div class="col-6">
                <div>
                    <label for="title" class="form-label">Titolo: </label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ empty($project->id) ? '' : old('title') ?? $project->title }}" required max="50" />
                    @error('title')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="mt-2">
                    <label for="type_id" class="form-label">Tipologia: </label>
                    <select name="type_id" id="type_id" class="form-select @error('type_id') is-invalid @enderror">


                        <option class="d-none" value=''>Scegli la tipologia</option>

                        @foreach ($types as $type)

                        <option value="{{ $type->id }}" @if (old('type_id') ?? $project->type_id == $type->id) selected @endif>{{ $type->label }}</option>
                        @endforeach
                    </select>

                    @error('type_id')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="mt-2">
                    <label for="github_url" class="form-label">Github: </label>
                    <input type="url" class="form-control @error('github_url') is-invalid @enderror" id="github_url" name="github_url" value="{{ empty($project->id) ? '' : old("github_url") ?? $project->github_url }}" />
                    @error('github_url')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>

            <div class="col-6">
                <div class="tech">
                    <p class="mb-1">Tecnologie:</p>
                    <div class="d-flex flex-wrap @error('technologies') is-invalid @enderror">
                        @foreach($technologies as $technology)
                        <div class="col-4 mb-1">
                            <label class="form-check-label" for=" technology-{{$technology->id}}">{{$technology->label}}</label>
                            <input {{ in_array($technology->id, old('technologies', $project_technologies_id ?? [])) ? 'checked' : '' }} class="form-check-input @error('technologies') is-invalid @enderror" type="checkbox" value="{{$technology->id}}" id="technology-{{$technology->id}}" name="technologies[]">
                        </div>
                        @endforeach
                    </div>
                    @error('technologies')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="img mt-3">
                    <label for="image" class="form-label">Immagine: </label>
                    <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" value="{{ empty($project->id) ? '' : old("image") ?? $project->image }}" />
                    @error('image')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>


        </div>

        <label for="description" class="form-label">Descrizione: </label>
        <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="4">{{ empty($project->id) ? '' : old("description") ?? $project->description }}</textarea>
        @error('description')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror

        <button type="submit" class="btn btn-success mt-2"><i class="fa-solid fa-floppy-disk me-2"></i>Salva</button>
    </form>

    </div>
</section>
@endsection


@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection
