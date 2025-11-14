<script>
    (function () {
        const typeSelect = document.getElementById('applicationType');
        const statusSelect = document.getElementById('applicationStatus');
        const courtField = document.querySelector('.court-field');
        const travelField = document.querySelector('.travel-field');
        const completionField = document.querySelector('.completion-field');

        function toggleFields() {
            const typeValue = typeSelect ? typeSelect.value : '';
            const statusValue = statusSelect ? statusSelect.value : '';

            if (courtField) {
                courtField.style.display = typeValue === 'visit' ? '' : 'none';
            }
            if (travelField) {
                travelField.style.display = typeValue === 'visit' ? '' : 'none';
            }
            if (completionField) {
                completionField.style.display = statusValue === 'completed' ? '' : 'none';
            }
        }

        if (typeSelect) {
            typeSelect.addEventListener('change', toggleFields);
        }
        if (statusSelect) {
            statusSelect.addEventListener('change', toggleFields);
        }

        toggleFields();
    })();
</script>
