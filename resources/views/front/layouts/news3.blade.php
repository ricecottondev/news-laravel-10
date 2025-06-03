<!-- ------------------------------ layout news headlines  -->
<div>
    <div>
        <div class="headlines small">
            <div class="row g-0">
                @for ($index = 0; $index < count($items); $index++)
                    @if ($index > 0 && $index % 3 == 0)
            </div>
            <div class="row g-0">
                @endif
                <div class="col px-3 col-12 col-md">
                    <div class="headlines-item d-flex flex-nowrap column-gap-3">
                        @if ($items[$index]->image)
                            <div class="headlines-img w-25">
                                <div class="ratio ratio-1x1">
                                    <img src="{{ asset('storage/' . $items[$index]->image) }}" class="object-fit-cover"
                                        alt="">
                                </div>
                            </div>
                        @endif
                        <div class="headlines-content w-100">
                            @if (strtoupper($items[$index]->color) == 'P')
                                <h5 class="fs-reset text-danger">
                                @elseif (strtoupper($items[$index]->color) == 'Y')
                                    <h5 class="fs-reset text-warning">
                                    @else
                                        <h5 class="fs-reset">
                            @endif
                                <b class="fw-medium">
                                    <a href="{{ url('/news/' . $items[$index]->slug) }}"
                                        class="text-reset link-hover-underline">
                                        {{ $items[$index]->title }}
                                    </a>
                                </b>
                            </h5>
                            <p><small><small>{{ $items[$index]->created_at->diffForHumans() }}</small></small></p>
                        </div>
                    </div><!-- headlines item -->
                </div><!-- end col -->

                @if ($index < count($items) && ($index + 1) % 3 != 0)
                    <div class="col col-12 col-md-auto">
                        <hr class="d-md-none">
                        <div class="vr h-100 d-none d-md-block"></div>
                    </div><!-- end col -->
                @endif
                @endfor

            </div><!-- end row -->
        </div>
        <div class="px-md-3">
            <hr>
        </div>
    </div>
</div>
<!-- end headlines -->
