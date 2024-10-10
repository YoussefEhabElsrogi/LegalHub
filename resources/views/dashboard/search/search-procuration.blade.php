<table class="table table-bordered table-hover">
    <tbody id="ajax-search_result">
        @forelse ($results as $procuration)
            <tr>
                <td>{{ $procuration->client->name ?? 'غير متوفر' }}</td>
                <td>{{ $procuration->authorization_number }}</td>
                <td>{{ $procuration->notebook_number }}</td>
                <td>{{ $procuration->notes ?? 'لا يوجد ملاحظات' }}</td>
                <td>
                    <x-action-buttons :model-id="$procuration->id" route-prefix="procurations" />
                </td>
            </tr>
        @empty
            <x-no-data-message :colspan="5" message="لا يوجد توكيلات الان" />
        @endforelse
    </tbody>
</table>
