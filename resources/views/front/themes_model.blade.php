    {{-- START: Call Waiter Modal --}}
    <div class="modal fade" id="callWaiterModal" tabindex="-1" role="dialog" aria-labelledby="callWaiterModalTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">{{ __('Call Waiter') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @php
                        $tables = \App\Table::where('status', 1)->get();
                    @endphp
                    <form id="callWaiterForm" action="{{ route('front.callwaiter') }}" method="GET">
                        <select class="form-control" name="table" required>
                            <option value="" disabled selected>{{ __('Select a Table') }}</option>
                            @foreach ($tables as $table)
                                <option value="{{ $table->table_no }}">{{ __('Table') }} -
                                    {{ $table->table_no }}
                                </option>
                            @endforeach
                        </select>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="submit" form="callWaiterForm" class="btn btn-lg btn-primary">
                        {{ __('Call Waiter') }}
                    </button>
                </div>
            </div>
        </div>
    </div>
    {{-- END: Call Waiter Modal --}}
