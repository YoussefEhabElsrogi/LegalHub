<li>
    <a class="dropdown-item" href="javascript:void(0)" onclick="confirmDeleteEmail()">
        <i class="ti ti-trash me-2 ti-sm"></i>
        <span class="align-middle">حذف الأيميل</span>
    </a>
</li>

<form id="delete-email-form" action="{{ route('profile.destroy', Auth::user()->id) }}" method="POST"
    style="display: none;">
    @csrf
    @method('DELETE')
</form>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function confirmDeleteEmail() {
        Swal.fire({
            title: 'تحذير',
            text: 'هل أنت متأكد أنك تريد حذف الأيميل؟ هذه العملية لا يمكن التراجع عنها!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'نعم، احذف!'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-email-form').submit();
            }
        });
    }
</script>
