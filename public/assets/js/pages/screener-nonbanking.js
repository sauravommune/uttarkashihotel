var total_assets = 0;
var trade_receivables = 0;
var trade_payables = 0;
var inventory = 0;
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
    var share_capital = $('input[name=share_capital]').val() ? parseFloat($('input[name=share_capital]').val()) : 0;
    var fv = $('input[name=fv]').val() ? parseFloat($('input[name=fv]').val()) : 0;
    var reserves = $('input[name=reserves]').val() ? parseFloat($('input[name=reserves]').val()) : 0;
    var borrowings = $('input[name=borrowings]').val() ? parseFloat($('input[name=borrowings]').val()) : 0;
    trade_payables = $('input[name=trade_payables]').val() ? parseFloat($('input[name=trade_payables]').val()) :
        0;
    var other_liabilities = $('input[name=other_liabilities]').val() ? parseFloat($('input[name=other_liabilities]')
        .val()) : 0;

    var total_liabilities = share_capital + reserves + borrowings + trade_payables + other_liabilities;
    $('input[name=total_liabilities]').val(round(total_liabilities, 2));

    /////////////////////////////////////////

    var fixed_assets = $('input[name=fixed_assets]').val() ? parseFloat($('input[name=fixed_assets]').val()) : 0;
    var cwip = $('input[name=cwip]').val() ? parseFloat($('input[name=cwip]').val()) : 0;
    var investments = $('input[name=investments]').val() ? parseFloat($('input[name=investments]').val()) : 0;
    trade_receivables = $('input[name=trade_receivables]').val() ? parseFloat($('input[name=trade_receivables]')
        .val()) : 0;
    inventory = $('input[name=inventory]').val() ? parseFloat($('input[name=inventory]').val()) :
        0;
    var other_assets = $('input[name=other_assets]').val() ? parseFloat($('input[name=other_assets]')
        .val()) : 0;

    total_assets = fixed_assets + cwip + investments + trade_receivables + inventory + other_assets;
    $('input[name=total_assets]').val(round(total_assets, 2));

}

function calculation_p_l_statement() {
    var revenue = $('input[name=revenue]').val() ? parseFloat($('input[name=revenue]').val()) : 0;
    var cost_of_material_consumed = $('input[name=cost_of_material_consumed]').val() ? parseFloat($(
        'input[name=cost_of_material_consumed]').val()) : 0;
    var gross_margins = ((revenue - cost_of_material_consumed) / revenue) * 100;
    $('input[name=gross_margins], .gross_margins').val(round(gross_margins, 2));

    ////////////////////////////////

    var change_in_inventory = $('input[name=change_in_inventory]').val() ? parseFloat($(
        'input[name=change_in_inventory]').val()) : 0;
    var employee_benefit_expenses = $('input[name=employee_benefit_expenses]').val() ? parseFloat($(
        'input[name=employee_benefit_expenses]').val()) : 0;
    var other_expenses = $('input[name=other_expenses]').val() ? parseFloat($('input[name=other_expenses]').val()) :
        0;
    var ebitda = revenue - cost_of_material_consumed - change_in_inventory - employee_benefit_expenses - other_expenses;
    $('input[name=ebitda]').val(round(ebitda, 2));

    var opm = ((ebitda) / revenue) * 100;
    $('input[name=opm],.opm').val(round(opm, 2));

    //////////////////////////////

    var other_income = $('input[name=other_income]').val() ? parseFloat($('input[name=other_income]').val()) : 0;
    var finance_cost = $('input[name=finance_cost]').val() ? parseFloat($('input[name=finance_cost]').val()) : 0;
    var d_and_a = $('input[name=d_and_a]').val() ? parseFloat($('input[name=d_and_a]').val()) : 0;
    var ebit = ebitda - d_and_a;
    $('input[name=ebit]').val(round(ebit, 2));

   

    var ebit_margins = ((ebit) / revenue) * 100;
    $('input[name=ebit_margins],.ebit_margins').val(round(ebit_margins, 2));

    //////////////////////////////
    var pbt = $('input[name=pbt]').val() ? parseFloat($('input[name=pbt]').val()) : 0;
    var pbt_margins = ((pbt) / revenue) * 100;
    $('input[name=pbt_margins]').val(round(pbt_margins, 2));

    //////////////////////////////
    var tax = $('input[name=tax]').val() ? parseFloat($('input[name=tax]').val()) : 0;
    var pat = pbt - tax;
    var npm = ((pat) / revenue) * 100;
    $('input[name=npm],.npm').val(round(npm, 2));
    $('input[name=pat]').val(round(pat, 2));

    var share_capital = $('input[name=share_capital]').val() ? parseFloat($('input[name=share_capital]').val()) : 0;
    var fv = $('input[name=fv]').val() ? parseFloat($('input[name=fv]').val()) : 0;
    var reserves = $('input[name=reserves]').val() ? parseFloat($('input[name=reserves]').val()) : 0;
    var borrowings = $('input[name=borrowings]').val() ? parseFloat($('input[name=borrowings]').val()) : 0;


    var eps = pat / (share_capital / fv);
    $('input[name=eps]').val(round(eps, 2));
    
    var return_on_capital_employed = (ebit / (share_capital + reserves + borrowings));
    $('input[name=return_on_capital_employed]').val(round(return_on_capital_employed * 100, 2));

    var return_on_equity = (pat / (share_capital + reserves));
    $('input[name=return_on_equity]').val(round(return_on_equity * 100, 2));

    var interest_coverage_ratio = (ebit / finance_cost);
    $('input[name=interest_coverage_ratio]').val(round(interest_coverage_ratio, 2));

    var debt_equity = (borrowings / (share_capital + reserves));
    $('input[name=debt_equity]').val(round(debt_equity, 2));

    var debtor = (trade_receivables / (revenue / 365));
    $('input[name=debtor]').val(round(debtor));

    var creditor_days = (trade_payables / (cost_of_material_consumed / 365));
    $('input[name=creditor_days]').val(round(creditor_days));

    var inventory_days = (inventory / (cost_of_material_consumed / 365));
    $('input[name=inventory_days]').val(round(inventory_days));

    var cash_conversion_cycle = debtor + inventory_days - creditor_days;
    $('input[name=cash_conversion_cycle]').val(round(cash_conversion_cycle, 2));

   

}

function calculation_cash_flow_statement() {
    var pbt_cash_flow_statement = $('input[name=pbt_cash_flow_statement]').val() ? parseFloat($(
        'input[name=pbt_cash_flow_statement]').val()) : 0;
    var opbwc = $('input[name=opbwc]').val() ? parseFloat($('input[name=opbwc]').val()) : 0;
    var change_in_receivables = $('input[name=change_in_receivables]').val() ?
        parseFloat($('input[name=change_in_receivables]').val()) : 0;
    var change_in_inventories = $('input[name=change_in_inventories]').val() ? parseFloat($('input[name=change_in_inventories]').val()) : 0;
    var change_in_payables = $('input[name=change_in_payables]').val() ? parseFloat(
        $('input[name=change_in_payables]').val()) : 0;
    var other_changes = $('input[name=other_changes]').val() ? parseFloat($('input[name=other_changes]').val()) : 0;
    var tax_cash_flow_statement = $('input[name=tax_cash_flow_statement]').val() ? parseFloat($(
        'input[name=tax_cash_flow_statement]').val()) : 0;


    ///////////////////////////////////////////////
    var working_capital_change = change_in_receivables + change_in_inventories +
        change_in_payables + other_changes;
    $('input[name=working_capital_change]').val(round(working_capital_change, 2));

    var cash_generated_from_operations = opbwc + working_capital_change;
    $('input[name=cash_generated_from_operations]').val(round(cash_generated_from_operations, 2));

    var cash_flow_from_operations = cash_generated_from_operations + tax_cash_flow_statement;
    $('input[name=cash_flow_from_operations]').val(round(cash_flow_from_operations, 2));

    /////////////////////////////////////////////////////
    var purchase_of_ppe = $('input[name=purchase_of_ppe]').val() ? parseFloat($('input[name=purchase_of_ppe]')
        .val()) : 0;
    var sale_of_ppe = $('input[name=sale_of_ppe]').val() ? parseFloat($('input[name=sale_of_ppe]').val()) : 0;
    var others = $('input[name=others]').val() ? parseFloat($('input[name=others]').val()) : 0;
    var cash_flow_from_investment = purchase_of_ppe + sale_of_ppe + others;
    $('input[name=cash_flow_from_investment]').val(round(cash_flow_from_investment, 2));

    ////////////////////////////////////
    var borrowing = $('input[name=borrowing]').val() ? parseFloat($('input[name=borrowing]').val()) : 0;
    var dividend_cash_flow_statement = $('input[name=dividend_cash_flow_statement]').val() ? parseFloat($(
        'input[name=dividend_cash_flow_statement]').val()) : 0;
    var equity = $('input[name=equity]').val() ? parseFloat($('input[name=equity]').val()) : 0;
    var others_from_financing = $('input[name=others_from_financing]').val() ? parseFloat($(
        'input[name=others_from_financing]').val()) : 0;
    var cash_flow_from_financing = borrowing + dividend_cash_flow_statement + equity + others_from_financing;
    $('input[name=cash_flow_from_financing]').val(round(cash_flow_from_financing, 2));

    /////////////////////////////////
    var cash_at_the_start = $('input[name=cash_at_the_start]').val() ? parseFloat($('input[name=cash_at_the_start]')
        .val()) : 0;

    var net_cash_generated = cash_flow_from_operations + cash_flow_from_investment + cash_flow_from_financing;
    $('input[name=net_cash_generated]').val(round(net_cash_generated, 2));

    var cash_at_the_end = net_cash_generated + cash_at_the_start;
    $('input[name=cash_at_the_end]').val(round(cash_at_the_end, 2));

    var revenue = $('input[name=revenue]').val() ? parseFloat($('input[name=revenue]').val()) : 0;

    var cfo_sales = cash_flow_from_operations / revenue;
    $('input[name=cfo_sales]').val(round(cfo_sales * 100, 2));

    var cfo_total_assets = cash_flow_from_operations / total_assets;
    $('input[name=cfo_total_assets]').val(round(cfo_total_assets * 100, 2));

    var borrowings = $('input[name=borrowings]').val() ? parseFloat($('input[name=borrowings]').val()) : 0;

    var cfo_total_debts = cash_flow_from_operations / borrowings;
    $('input[name=cfo_total_debts]').val(round(cfo_total_debts * 100, 2));

}

$(document).ready(function(){

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
    
    function allfunctioncalculate(){
        calculation_balance_sheet();
        calculation_p_l_statement();
        calculation_cash_flow_statement();
    }
});