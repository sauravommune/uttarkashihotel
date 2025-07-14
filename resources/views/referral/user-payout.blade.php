<x-app-layout>
    <div id="page-body">
        <div class="section-driver">
            <div class="card">
                <div class="row outer-box card-box my-2">
                    <div class="col-lg-12 pb-4 ">
                        <div class="d-flex justify-content-between">

                            <h5>Payouts </h5>
                            <div class="d-flex">
                               <div>
                                    @can('Referral-View')
                                    <a href="{{ route('referral.index') }}" class="btn btn-sm btn-primary">Referrals</a>
                                    @endcan

                               </div>
                            </div>

                        </div>
                        <div class="row">

                           
                            <div class="mb-2 fv-plugins-icon-container col-md-3 fv-row">
                                <label class="form-label" for="name">From Date<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="from_date" name="from_date">
                                <div class="fv-plugins-message-container invalid-feedback"></div>
                            </div>
                            <div class="mb-2 fv-plugins-icon-container col-md-3 fv-row">
                                <label class="form-label" for="name">To Date<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="to_date" name="to_date">
                                <div class="fv-plugins-message-container invalid-feedback"></div>
                            </div>
                            
                            <div class=" fv-plugins-icon-container col-md-3 fv-row">
                                <label class="form-label" for="name">&nbsp;</label>
                                <input type="button" class="btn btn-primary search_btn" value="Search"> 

                            </div>

                        </div>

                    </div>

                </div>


                <div class="table-responsive">
                    {{ $dataTable->table() }}
                </div>
            </div>

        </div>
    </div>
    @push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
    <script>
        $(document).ready(function() {
            $(document).on('click', '.copy', function() {
                var copyText = $(this).data('clipboard-text');
                var $temp = $("<input>");
                $("body").append($temp);
                $temp.val(copyText).select();
                document.execCommand("copy");
                $temp.remove();
                Swal.fire({
                    toast: true
                    , position: 'top-end'
                    , icon: 'success'
                    , title: 'Copied'
                    , showConfirmButton: false
                    , timer: 1500
                });
            });

            $('body').on('click', '.search_btn', function(r) {
                r.preventDefault();
                let table = window.LaravelDataTables['userpayouttransaction-table'];
                table.settings()[0].ajax.data = function(d) {
                    d.user = $('#user').val();
                    d.from_date = $('#from_date').val();
                    d.to_date = $('#to_date').val();
                }
                table.draw();
            })
            
       $('#from_date').flatpickr({
        onChange: function(selectedDates, dateStr, instance) {
            $('#to_date').flatpickr().set('minDate', selectedDates[0]);
            }
        });
        $('#to_date').flatpickr();
           

        });

    </script>
    @endpush
</x-app-layout>
