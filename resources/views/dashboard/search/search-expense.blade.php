<table class="table table-hover table-bordered">
    <tbody>
        @forelse ($results as $expense)
            <tr>
                <td>{{ $expense->client->name }}</td>
                <td>{{ $expense->expense_name }}</td>
                <td>{{ number_format($expense->amount, 2) }} جنيهاً</td>
                <td>
                    @if ($expense->notes)
                        {{ $expense->notes }}
                    @else
                        <span class="text-danger">غير متوفر ملاحظات</span>
                    @endif
                </td>
                <td class="text-center">
                    <x-action-buttons :model-id="$expense->id" route-prefix="expenses" />
                </td>
            </tr>
        @empty
            <tr>
                <x-no-data-message :colspan="5" message="لا يوجد مصروفات الان" />
            </tr>
        @endforelse
    </tbody>
</table>
