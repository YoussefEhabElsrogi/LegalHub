<table class="table table-striped table-hover">
    <tbody id="ajax-search_result">
        @forelse ($results as $session)
            <tr>
                <td>{{ $session->client->name ?? 'غير متوفر' }}</td>
                <td>{{ $session->session_number }}</td>
                <td>{{ $session->session_type }}</td>
                <td>{{ $session->session_date->format('Y-m-d') }}</td>
                <td>{{ $session->opponent_name }}</td>
                <td>
                    @if ($session->session_status === 'سارية')
                        <span class="badge bg-success">{{ $session->session_status }}</span>
                    @elseif ($session->session_status === 'محفوظة')
                        <span class="badge bg-secondary">{{ $session->session_status }}</span>
                    @else
                        <span class="badge bg-warning">{{ $session->session_status }}</span>
                    @endif
                </td>
                <td>
                    <x-action-buttons :model-id="$session->id" route-prefix="sessions" />
                </td>
            </tr>
        @empty
            <x-no-data-message :colspan="7" message="لا يوجد جلسات الان" />
        @endforelse
    </tbody>
</table>
