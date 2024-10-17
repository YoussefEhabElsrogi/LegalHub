<table class="table table-bordered">
    <tbody id="ajax-search_result">
        @forelse ($results as $company)
            <tr>
                <td class="nowrap">{{ $company->client->name }}</td>
                <td class="nowrap">{{ $company->company_name }}</td>
                <td class="nowrap">{{ $company->establishment_fees }} جنيها</td>
                <td class="nowrap">{{ $company->remaining_amount + $company->advance_amount }} جنيها</td>
                <td class="nowrap">{{ $company->advance_amount }} جنيها</td>
                <td class="nowrap">{{ $company->remaining_amount }} جنيها</td>
                <td class="nowrap">
                    @if ($company->notes)
                        {{ $company->notes }}
                    @else
                        <span class="text-danger">غير متوفر ملاحظات</span>
                    @endif
                </td>
                <td class="nowrap">
                    <x-action-buttons :model-id="$company->id" route-prefix="companies" />
                </td>
            </tr>
        @empty
            <x-no-data-message :colspan="8" message="لا يوجد شركات مسجلة الان" />
        @endforelse
    </tbody>
</table>
