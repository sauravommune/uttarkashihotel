<div id="page-body">
<style>
    .table-responsive .table{
        width: 100%!important;
    }
</style>
    <div class="section-driver">
        <div class="card">
            
            <div class="table-responsive">
                {{ $payoutTransactionDataTable->table() }}
            </div>
        </div>

    </div>
</div>
{{ $payoutTransactionDataTable->scripts(attributes: ['type' => 'module']) }}