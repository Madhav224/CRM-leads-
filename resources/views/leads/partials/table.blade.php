 <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Action</th>
                        <th>Customer</th>
                        <th>Product / Services</th>
                        <th>Status</th>
                        <th>Source</th>
                        <th>Number</th>
                        <th>Followup Date</th>
                        <th>Next Action</th>
                        <th>Call Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($leads as $lead)
                        <tr>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    {{-- Edit Button --}}
                                        <button type="button" class="btn btn-outline-primary"
                                                onclick="openInteractionModal({{ $lead->id }}, '{{ $lead->followup_date }}', '{{ $lead->status_id }}', '{{ $lead->call_status }}')">
                                            <i class="bi bi-pencil"></i>
                                        </button>


                                     {{-- Delete Form --}}
                                        <form action="{{ route('leads.destroy', $lead->id) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-outline-danger" type="submit">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                </div>
                            </td>
                            <td>{{ $lead->customer }}</td>
                            <td>{{ $lead->product->name ?? '-' }}</td>

                            <td>
                                <span class="badge" style="background-color: {{ $lead->status->color ?? '#808080' }};">
                                    {{ $lead->status->name ?? 'Unknown' }}
                                </span>
                            </td>
                            <td>{{ $lead->source }}</td>
                            <td>{{ $lead->number }}</td>
                           <td>{{ \Carbon\Carbon::parse($lead->followup_date)->format('d M, Y') }}</td>

                            <td>{{ $lead->next_action }}</td>


                            @php
                                $statusColors = [
                                    'Pending' => 'bg-warning text-white',
                                    'Completed' => 'bg-success text-white',
                                    'Scheduled' => 'bg-primary text-white',
                                    'Not Reached' => 'bg-danger text-white',
                                    'In Progress' => 'bg-info text-white',
                                ];
                            @endphp
                           <td>
                                <span class="badge {{ $statusColors[$lead->call_status] ?? 'bg-secondary' }}">
                                    {{ $lead->call_status }}
                                </span>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>

            </table>