<div class="card-body text-center">
    <p>{{ $curso->name }}</p>
    <p>{{ $curso->description }}</p>

    <p><strong>Asignaturas:</strong></p>
    @if (count($curso->subjects) > 0)
    @foreach ($curso->subjects as $subject)
    <p>{{ $subject->name }}</p>
    @endforeach
    <p>¿Desea añadir <a class="modallink" href="#modallink{{ $curso->id }}"
        data-bs-toggle="modal" data-bs-target="#modallink{{ $curso->id }}">
        una nueva asignatura?
    </a></p>
    @else
    <p>Este curso no tiene asignaturas. <a class="modallink"
        href="#modallink{{ $curso->id }}" data-bs-toggle="modal"
        data-bs-target="#modallink{{ $curso->id }}">
        ¿Desea crearla?
    </a></p>
    @endif
</div>
