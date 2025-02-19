@props(['requests'])

<ul>
    @foreach ( $requests as $request )
        <li>
            {{ $request->user->name }}
            <form action="{{ route('friend.acceptRequest', $request->user_id) }}" method="POST" style="display:inline;">
                @csrf
                <button type="submit" class="btn btn-success">Accept</button>
            </form>
            <form action="{{ route('friend.rejectRequest', $request->user_id) }}" method="POST" style="display:inline;">
                @csrf
                <button type="submit" class="btn btn-danger">Reject</button>
            </form>
        </li>   
    @endforeach
</ul>