<form action="{{ route('messages.send') }}" method="POST">
    @csrf

    <div class="mb-4">
        <label>Destinataire</label>
        <select name="receiver_id" required>
            @foreach($users as $user)
                <option value="{{ $user->id }}">
                    {{ $user->name }} ({{ $user->role }})
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-4">
        <label>Message</label>
        <textarea name="contenu" required></textarea>
    </div>

    <button type="submit">Envoyer</button>
</form>
