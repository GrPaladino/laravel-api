<x-mail::message>
    # Ciao {{$username}}

    ## Il tuo progetto "{{$project_title}}" é stato creato

    <x-mail::button :url="$project_url">
        View Order
    </x-mail::button>

    Thanks,<br>
    {{ config('app.name') }}
</x-mail::message>
