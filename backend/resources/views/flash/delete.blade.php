@if(session("deleteMessage"))
    <form action="{{ route('pictopeer.deleteLend', ['id' => session("id")]) }}" method="post">
        @method('DELETE')
        @csrf
        <p>{{session('deleteMessage')}}</p>
        <button type="submit" class='btn btn-danger' name="delete">Eliminar</button>
        <a class='btn btn-secondary' href="{{ route('pictopeer') }}">Cancelar</a>
    </form>
@endif
