<!-- flatpickr -->
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
    flatpickr(document.getElementById('due_date'), {
        locale: 'ja',
        dateFormat: "Y/m/d",
        minDate: new Date()
    });
</script>