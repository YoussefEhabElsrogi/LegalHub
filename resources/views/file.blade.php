<form action="/power-of-attorneys" method="POST">
    @csrf
    <!-- بيانات التوكيل -->
    <label>رقم التوكيل:</label>
    <input type="text" name="power_of_attorney_number" required>

    <!-- بيانات الموكلين -->
    <div id="clients">
        <div class="client">
            <label>اسم الموكل:</label>
            <input type="text" name="clients[0][name]" required>

            <label>الرقم القومي:</label>
            <input type="text" name="clients[0][national_id]" required>
        </div>
    </div>

    <button type="button" id="add-client">إضافة موكل جديد</button>

    <button type="submit">حفظ</button>
</form>

<script>
    let clientIndex = 1;
    document.getElementById('add-client').addEventListener('click', function() {
        const newClient = `
            <div class="client">
                <label>اسم الموكل:</label>
                <input type="text" name="clients[${clientIndex}][name]" required>

                <label>الرقم القومي:</label>
                <input type="text" name="clients[${clientIndex}][national_id]" required>
            </div>
        `;
        document.getElementById('clients').insertAdjacentHTML('beforeend', newClient);
        clientIndex++;
    });
</script>
