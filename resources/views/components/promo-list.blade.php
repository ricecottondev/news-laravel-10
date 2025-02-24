@props(['data'])

<div class="modal-body">
    <ol class="list-group list-group-flush list-group-numbered">
        @foreach ($data as $item)
            <li
                class="list-group-item d-flex justify-content-between align-items-start px-0 @if ($item['status'] === 'Unread') bg-body-secondary @endif">
                <div class="ms-2 me-auto">
                    <span class="notification-item-promo" data-id="{{ $item['id'] }}">
                        <strong>{{ $item['title'] }}</strong>
                        <br>
                        {{ $item['content'] }}
                    </span>
                </div>
            </li>
        @endforeach
    </ol>
</div>
