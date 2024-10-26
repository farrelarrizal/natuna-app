@foreach($variables as $item)
    <div class="col-md-6 px-4">
        <div class="flex-grow-1 mx-2">
            <div class="div d-flex">
                <p class="text-muted mb-1">{{ $item->name }}</p>
                @if($item->key_variable == 1)
                    <span class="badge bg-light-primary mx-2">Key Variable</span>
                @endif
            </div>
            <p class="mb-0">{{ $item->value }}
                @if($item->level != 'NULL')
                    <span class="mx-2">({{ $item->level }})</span>
                @endif
            </p>
        </div>
        <hr class="border border-primary-subtle" />
    </div>
@endforeach
