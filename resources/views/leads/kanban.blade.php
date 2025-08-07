@extends('layouts.layout1')

@section('title', 'kanban page')


@section('content')
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>

    <div class="content-wrapper">
        <div class="content-header row"></div>
        <div class="content-body">
            <div class="card">
                <div class="card-body">
                  <div class="d-flex justify-content-between align-items-center mb-3">
                        <h3 class="mb-0">Leads Kanban View</h3>
                        <a href="{{ route('leads.index') }}" class="btn btn-primary">← Back to Lead View</a>
                    </div>

    <div class="row">
        @foreach($statuses as $status)
            <div class="col-md-4 mb-4">
                <div class="card border-0 shadow-sm">
                    <div class="card-header text-white fw-bolder" style="background-color: {{ $status->color ?? '#6c757d' }}">
                        {{ $status->name }}
                    </div>
                    <div class="card-body" style="min-height: 300px; background-color: #f8f9fa;">
                        @forelse($status->leads as $lead)
                            <div class="card mb-2 mt-1 shadow-lg">
                                <div class="card-body p-2">
                                    <h6 class="mb-1">{{ $lead->customer }}</h6>
                                    <small class="text-muted">📞 {{ $lead->number }}</small><br>
                                    <small>📆 {{ $lead->followup_date ? \Carbon\Carbon::parse($lead->followup_date)->format('d M Y') : 'No Date' }}</small>
                                    @if($lead->call_status)

                                     @php
                                $statusColors = [
                                    'Pending' => 'bg-warning text-white',
                                    'Completed' => 'bg-success text-white',
                                    'Scheduled' => 'bg-primary text-white',
                                    'Not Reached' => 'bg-danger text-white',
                                    'In Progress' => 'bg-info text-white',
                                ];
                            @endphp
                                        <div class="mt-2">
                                            <span class="badge {{ $statusColors[$lead->call_status] ?? 'bg-secondary' }}">
                                    {{ $lead->call_status }}
                                </span>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @empty
                            <p class="text-muted">No leads</p>
                        @endforelse
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    </div>
</div>
</div>
</div>
</div>
@endsection
