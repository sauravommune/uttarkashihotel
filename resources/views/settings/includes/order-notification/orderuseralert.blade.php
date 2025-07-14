<div class="card-body">

    <form class="kt-form kt-form--fit mb-15" id="serach_form">
        <div class="row mb-6">
            <div class="col-lg-3 mb-lg-0 mb-6">
                <label>Search :</label>
                <input type="text" class="form-control datatable-input" @if(isset($company)) placeholder="Username "
                    @else placeholder="Company name or Username " @endif name="search" />
            </div>
            <div class="col-lg-3 mt-8">
                <button class="btn btn-primary btn-primary--icon" id="kt_search">
                    <span>
                        <i class="la la-search"></i>
                        <span>Search</span>
                    </span>
                </button>&#160;&#160;
                <button class="btn btn-secondary btn-secondary--icon" id="kt_reset">
                    <span>
                        <i class="la la-close"></i>
                        <span>Reset</span>
                    </span>
                </button></div>
        </div>



    </form>

    @if(session()->has('status'))
    <div class="alert alert-success" role="alert">{{session('status')}}</div>
    @endif
    <!--begin: Datatable-->
    <table class="table table-separate table-head-custom table-checkable" id="datatable_example">
        <thead>
            <tr>
                <th></th>
                <th>Company Name</th>
            </tr>
        </thead>
    </table>
    <!--end: Datatable-->
</div>

