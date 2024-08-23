<div>
    
</div>
@push('scripts')
    <script>
        window.addEventListener('login_success', event => {
            setTimeout(() => {
                window.location.href = "{{ route('app.home') }}";
            }, 500);
        });
    </script>
@endpush
