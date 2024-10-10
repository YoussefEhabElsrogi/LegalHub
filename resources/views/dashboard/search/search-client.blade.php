<table class="table table-hover table-bordered table-striped text-center align-middle">
    <tbody id="ajax-search_result">
        @forelse($results as $client)
            <tr>
                <td class="d-flex align-items-center justify-content-center">
                    <i class="ti ti-user ti-lg text-info me-2"></i>
                    <span class="fw-bold">{{ $client->name }}</span>
                </td>
                <td>{{ $client->phone }}</td>
                <td>{{ $client->national_id }}</td>
                <td>
                    <x-action-buttons :model-id="$client->id" route-prefix="clients" />
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="4">
                    <x-no-data-message :colspan="4" message="لا يوجد عملاء الان" />
                </td>
            </tr>
        @endforelse
    </tbody>
</table>
