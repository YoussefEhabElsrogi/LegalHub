<table class="table table-bordered">
    <tbody id="ajax-search_result">
        @forelse ($results as $company)
            <tr>
                <td>{{ $company->client->name }}</td>
                <td>{{ $company->establishment_fees }} جنيها</td>
                <td>{{ $company->remaining_amount + $company->advance_amount }} جنيها</td>
                <td>{{ $company->advance_amount }} جنيها</td>
                <td>{{ $company->remaining_amount }} جنيها</td>
                <td>
                    @if ($company->notes)
                        {{ $company->notes }}
                    @else
                        <span class="text-danger">غير متوفر ملاحظات</span>
                    @endif
                </td>
                <td>
                    <x-action-buttons :model-id="$company->id" route-prefix="companies" />
                </td>
            </tr>
        @empty
            <x-no-data-message :colspan="7" message="لا يوجد شركات مسجلة الان" />
        @endforelse
    </tbody>
</table>
