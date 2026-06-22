@props([
    'status' => '',
    'icon' => '',
])

@if ($status)
    <script>
        function showToast() {
            toastr.options = {
                positionClass: 'toast-top-right',
                timeOut: 2000,
            };

            toastr[@js($icon)](@js($status));
        }

        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', showToast);
        } else {
            showToast();
        }
    </script>
@endif
