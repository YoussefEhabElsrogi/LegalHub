<table class="table">
    <tbody class="table-border-bottom-0">
            @foreach ($results as $admin)
                <tr>
                    <td>
                        <i class="ti ti-user ti-lg text-info me-3"></i>
                        <span class="fw-medium">{{ $admin->name }}</span>
                    </td>
                    <td>{{ $admin->email }}</td>
                    <td>{{ $admin->phone }}</td>
                    <td><span class="badge bg-label-success me-1">{{ ucfirst($admin->role ?? 'غير محدد') }}</span>
                    </td>
                    <td>
                        <x-action-buttons :model-id="$admin->id" route-prefix="admins" />
                    </td>
                </tr>
            @endforeach
    </tbody>
</table>
