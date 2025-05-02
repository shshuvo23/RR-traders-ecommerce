<script src="{{asset('assets/plugins/jquery/jquery.min.js')}}"></script>
<script src="{{asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

{{-- dataTables --}}
<script src="{{asset('assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{ asset('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{ asset('assets/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.html5.js')}}"></script>
<script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
{{-- <script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script> --}}
<script src="{{ asset('assets/plugins/datatables-buttons/js/jszip.min.js')}}"></script>
<script src="{{ asset('assets/plugins/datatables-buttons/js/pdfmake.min.js')}}"></script>
<script src="{{ asset('assets/plugins/datatables-buttons/js/vfs_fonts.js')}}"></script>

<script src="{{asset('assets/adminlte/js/adminlte.min.js')}}"></script>
<script src="{{asset('assets/adminlte/js/custom.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).on("click", "#deleteData", function(e) {
        e.preventDefault();
        var link = $(this).attr("href");
        Swal.fire({
            title: "{{__('messages.common.want_to_delete')}}",
            text: "{{__('messages.common.permanently_delete')}}",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#8bc34a',
            cancelButtonColor: '#d33',
            cancelButtonText: "{{__('messages.common.cancel')}}",
            confirmButtonText: "{{__('messages.common.yes_delete')}}",
        }).then((willDelete) => {
            if (willDelete.isConfirmed) {
                window.location.href = link;
            }
        })
    })
    $(document).on('click','.languageSelection', function () {
        var languageName = $(this).data('prefix-value');
        $.ajax({
            type: 'POST',
            url: '/change-language',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                languageName: languageName
            },
            success: function success() {
                location.reload();
            }
        });
    });
</script>