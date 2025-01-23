@if (session('success'))
    <script>
        window.onload = function() {
            Swal.fire({
                icon: 'success',
                title: 'Successfully!',
                text: "{{ session('success') }}",
                showConfirmButton: true,
                timer: 40000
            });
        };
    </script>
@endif