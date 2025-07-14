
var total_assets = 0;
var advances = 0;
var deposits = 0;
var inventory = 0;
var share_capital = 0;
var fv = 0;
var reserves = 0;
var eps = 0;
function round(value, exp) {
    if (typeof exp === 'undefined' || +exp === 0)
        return Math.round(value);

    value = +value;
    exp = +exp;

    if (isNaN(value) || !(typeof exp === 'number' && exp % 1 === 0))
        return NaN;

    // Shift
    value = value.toString().split('e');
    value = Math.round(+(value[0] + 'e' + (value[1] ? (+value[1] + exp) : exp)));

    // Shift back
    value = value.toString().split('e');
    return +(value[0] + 'e' + (value[1] ? (+value[1] - exp) : -exp));
}

function calculation_balance_sheet() {
    share_capital = $('input[name=share_capital]').val() ? parseFloat($('input[name=share_capital]').val()) : 0;
    fv = $('input[name=fv]').val() ? parseFloat($('input[name=fv]').val()) : 0;
    reserves = $('input[name=reserves]').val() ? parseFloat($('input[name=reserves]').val()) : 0;
    var borrowings = $('input[name=borrowings]').val() ? parseFloat($('input[name=borrowings]').val()) : 0;
    deposits = $('input[name=deposits]').val() ? parseFloat($('input[name=deposits]').val()) :
        0;
    var other_liabilities = $('input[name=other_liabilities]').val() ? parseFloat($('input[name=other_liabilities]')
        .val()) : 0;

    var total_liabilities = share_capital + reserves + borrowings + deposits + other_liabilities;
    $('input[name=total_liabilities]').val(round(total_liabilities, 2));

    /////////////////////////////////////////

    var fixed_assets = $('input[name=fixed_assets]').val() ? parseFloat($('input[name=fixed_assets]').val()) : 0;
    var cash_and_balance = $('input[name=cash_and_balance]').val() ? parseFloat($('input[name=cash_and_balance]').val()) : 0;
    var investments = $('input[name=investments]').val() ? parseFloat($('input[name=investments]').val()) : 0;
    advances = $('input[name=advances]').val() ? parseFloat($('input[name=advances]')
        .val()) : 0;
    var other_assets = $('input[name=other_assets]').val() ? parseFloat($('input[name=other_assets]')
        .val()) : 0;

    total_assets = fixed_assets + cash_and_balance + investments + advances + other_assets;
    $('input[name=total_assets]').val(round(total_assets, 2));

}

function calculation_p_l_statement() {
    var interest_earned = $('input[name=interest_earned]').val() ? parseFloat($('input[name=interest_earned]').val()) : 0;
    var other_income = $('input[name=other_income]').val() ? parseFloat($('input[name=other_income]').val()) : 0;
    var interest_expended = $('input[name=interest_expended]').val() ? parseFloat($('input[name=interest_expended]').val()) : 0;
    var operating_expenses = $('input[name=operating_expenses]').val() ? parseFloat($('input[name=operating_expenses]').val()) : 0;
    var provisions_and_contingencies = $('input[name=provisions_and_contingencies]').val() ? parseFloat($('input[name=provisions_and_contingencies]').val()) : 0;
    var pat = $('input[name=pat]').val() ? parseFloat($('input[name=pat]').val()) : 0;



    eps = pat / (share_capital / fv);
    $('input[name=eps]').val(round(eps, 2));

    var g_npa = $('input[name=g_npa]').val() ? parseFloat($('input[name=g_npa]').val()) : 0;
    var n_npa = $('input[name=n_npa]').val() ? parseFloat($('input[name=n_npa]').val()) : 0;

    $('.g_npa').val(g_npa);
    $('.n_npa').val(n_npa);

}

function calculation_cash_flow_statement() {
    var pbt_cash_flow_statement = $('input[name=pbt_cash_flow_statement]').val() ? parseFloat($(
        'input[name=pbt_cash_flow_statement]').val()) : 0;
    var opbwc = $('input[name=opbwc]').val() ? parseFloat($('input[name=opbwc]').val()) : 0;
    var team_deposite = $('input[name=team_deposite]').val() ?
        parseFloat($('input[name=team_deposite]').val()) : 0;
    var cash_flow_statement_investment = $('input[name=cash_flow_statement_investment]').val() ? parseFloat($('input[name=cash_flow_statement_investment]').val()) : 0;
    var cash_flow_statement_advances = $('input[name=cash_flow_statement_advances]').val() ? parseFloat(
        $('input[name=cash_flow_statement_advances]').val()) : 0;
    var cash_flow_statement_deposits = $('input[name=cash_flow_statement_deposits]').val() ? parseFloat($('input[name=cash_flow_statement_deposits]').val()) : 0;
    var cash_flow_statement_others = $('input[name=cash_flow_statement_others]').val() ? parseFloat($(
        'input[name=cash_flow_statement_others]').val()) : 0;
    var tax_cash_flow_statement = $('input[name=tax_cash_flow_statement]').val() ? parseFloat($(
        'input[name=tax_cash_flow_statement]').val()) : 0;


    ///////////////////////////////////////////////
    var working_capital_change = team_deposite + cash_flow_statement_investment + cash_flow_statement_advances + cash_flow_statement_deposits + cash_flow_statement_others;
    $('input[name=working_capital_change]').val(round(working_capital_change, 2));

    var cash_generated_from_operations = opbwc + working_capital_change;
    $('input[name=cash_generated_from_operations]').val(round(cash_generated_from_operations, 2));

    var cash_flow_from_operations = cash_generated_from_operations - tax_cash_flow_statement;
    $('input[name=cash_flow_from_operations]').val(round(cash_flow_from_operations, 2));

    /////////////////////////////////////////////////////
    var purchase_of_ppe = $('input[name=purchase_of_ppe]').val() ? parseFloat($('input[name=purchase_of_ppe]')
        .val()) : 0;
    var sale_of_ppe = $('input[name=sale_of_ppe]').val() ? parseFloat($('input[name=sale_of_ppe]').val()) : 0;
    var others = $('input[name=others]').val() ? parseFloat($('input[name=others]').val()) : 0;

    var purchase_of_investment = $('input[name=purchase_of_investment]').val() ? parseFloat($(
        'input[name=purchase_of_investment]').val()) : 0;
    var sale_of_investment = $('input[name=sale_of_investment]').val() ? parseFloat($(
        'input[name=sale_of_investment]').val()) : 0;

    var cash_flow_from_investment = purchase_of_ppe + sale_of_ppe + others + purchase_of_investment + sale_of_investment;
    $('input[name=cash_flow_from_investment]').val(round(cash_flow_from_investment, 2));

    ////////////////////////////////////
    var borrowing = $('input[name=borrowing]').val() ? parseFloat($('input[name=borrowing]').val()) : 0;
    var dividend_cash_flow_statement = $('input[name=dividend_cash_flow_statement]').val() ? parseFloat($(
        'input[name=dividend_cash_flow_statement]').val()) : 0;
    var equity = $('input[name=equity]').val() ? parseFloat($('input[name=equity]').val()) : 0;
    var others_from_financing = $('input[name=others_from_financing]').val() ? parseFloat($(
        'input[name=others_from_financing]').val()) : 0;
  
    var repayment_of_borrowing = $('input[name=repayment_of_borrowing]').val() ? parseFloat($(
        'input[name=repayment_of_borrowing]').val()) : 0;

    var cash_flow_from_financing = borrowing + dividend_cash_flow_statement + equity + others_from_financing  + repayment_of_borrowing;
    $('input[name=cash_flow_from_financing]').val(round(cash_flow_from_financing, 2));

    /////////////////////////////////
    var cash_at_the_start = $('input[name=cash_at_the_start]').val() ? parseFloat($('input[name=cash_at_the_start]')
        .val()) : 0;

    var net_cash_generated = cash_flow_from_investment + cash_flow_from_operations + cash_flow_from_financing;
    $('input[name=net_cash_generated]').val(round(net_cash_generated, 2));
    
    var cash_at_the_end = net_cash_generated + cash_at_the_start;
    $('input[name=cash_at_the_end]').val(round(cash_at_the_end, 2));
    
    $('.advances').val(advances);
    $('.deposits').val(deposits);
    
    var book_value = ((share_capital + reserves) / (share_capital / fv)); 
    $('input[name=book_value]').val(round(book_value, 2));
    
    var pat = $('input[name=pat]').val() ? parseFloat($('input[name=pat]').val()) : 0;
    var return_on_equity = pat / (share_capital + reserves);
    $('input[name=return_on_equity]').val(round(return_on_equity * 100, 2));
    
    var share_price = $('input[name=share_price]').val() ? parseFloat($('input[name=share_price]').val()) : 0;
    var p_b = share_price / book_value;
    $('input[name=p_b]').val(round(p_b, 2));
    console.log(p_b);
    
    var p_e = share_price / eps;
    $('input[name=p_e]').val(round(p_e, 2));



}

$(document).ready(function () {

    $('body').on('input', 'input[name="holding[]"]', function(){
        let percentage = 0;
        $('input[name="holding[]"]').map(function(){
            percentage += parseFloat( $(this).val() ? $(this).val() : 0 );
        });
        if( percentage > 100 ){
            $(this).val(0);
            Swal.fire({
                text: 'Total Percentage should be less than or equal to 100%',
                icon: "error",
                buttonsStyling: false,
                confirmButtonText: "Ok, got it!",
                customClass: {
                    confirmButton: "btn btn-success"
                },
                timer: 2000,
            })
        }
    });

    $('body').on('click', '.shareholdingpattern-add-btn', function(){
        let html = `<div class="d-flex justify-content-between align-items-center mb-5 shareholdingpattern-div">
            <input type="text" class="form-control form-control-sm mb-3 mb-lg-0" name="holding_cat[]" placeholder="Category" value="" />
            <input type="number" class="form-control form-control-sm mx-2 mb-3 mb-lg-0" name="holding[]" placeholder="Holding Percentage" value="" />
            <a href="javascript:void(0);" class="btn-icon mx-5 shareholdingpattern-remove-btn">
                <i class="la la-trash fs-4 text-white bg-danger fw-bolder p-1"></i>
            </a>
        </div>`;
        $('.shareholdingpattern-div-container').append(html);
    });

    $('body').on('click', '.shareholdingpattern-remove-btn', function(){
        $(this).parent('.shareholdingpattern-div').remove();
    });

    $('form').on('focus', 'input[type=number]', function (e) {
        $(this).on('wheel.disableScroll', function (e) {
            e.preventDefault()
        })
    })
    $('form').on('blur', 'input[type=number]', function (e) {
        $(this).off('wheel.disableScroll')
    })

    $('.balance_sheet').keyup(function () {
        allfunctioncalculate();

    });

    $('.p_l_statement').keyup(function () {
        allfunctioncalculate();
    });

    $('.cash_flow_statement').keyup(function () {
        allfunctioncalculate();
    });

    function allfunctioncalculate() {
        calculation_balance_sheet();
        calculation_p_l_statement();
        calculation_cash_flow_statement();
    }

});