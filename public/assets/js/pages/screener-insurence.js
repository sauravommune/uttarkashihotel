
var total_assets = 0;
var advances = 0;
var deposits = 0;
var inventory = 0;
var share_capital = 0;
var fv = 0;
var reserves = 0;
var eps = 0;
var claims_incurred = 0;
var commission = 0;
var operating_expenses = 0;
var nep = 0;
var gwp = 0;
var premium_earned = 0;
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
    reserves_and_surplus = $('input[name=reserves_and_surplus]').val() ? parseFloat($('input[name=reserves_and_surplus]').val()) : 0;
    var current_liabilities = $('input[name=current_liabilities]').val() ? parseFloat($('input[name=current_liabilities]').val()) : 0;
    provisions = $('input[name=provisions]').val() ? parseFloat($('input[name=provisions]').val()) :
        0;
    var other_liabilities = $('input[name=other_liabilities]').val() ? parseFloat($('input[name=other_liabilities]')
        .val()) : 0;

    var total_liabilities = share_capital + reserves_and_surplus + current_liabilities + provisions + other_liabilities;
    $('input[name=total_liabilities]').val(round(total_liabilities, 2));

    /////////////////////////////////////////

    var fixed_assets = $('input[name=fixed_assets]').val() ? parseFloat($('input[name=fixed_assets]').val()) : 0;
    var cash_and_balance = $('input[name=cash_and_balance]').val() ? parseFloat($('input[name=cash_and_balance]').val()) : 0;
    var investment_shareholder = $('input[name=investment_shareholder]').val() ? parseFloat($('input[name=investment_shareholder]').val()) : 0;
    var investment_policyholder = $('input[name=investment_policyholder]').val() ? parseFloat($('input[name=investment_policyholder]').val()) : 0;
    var advance_and_other_assets = $('input[name=advance_and_other_assets]').val() ? parseFloat($('input[name=advance_and_other_assets]').val()) : 0;

    total_assets = fixed_assets + cash_and_balance + investment_shareholder + investment_policyholder + advance_and_other_assets;
    $('input[name=total_assets]').val(round(total_assets, 2));

}

function calculation_p_l_statement() {
    gwp = $('input[name=gwp]').val() ? parseFloat($('input[name=gwp]').val()) : 0;
    nep = $('input[name=nep]').val() ? parseFloat($('input[name=nep]').val()) : 0;
    premium_earned = $('input[name=premium_earned]').val() ? parseFloat($('input[name=premium_earned]').val()) : 0;
    var pl_on_sale_of_investment = $('input[name=pl_on_sale_of_investment]').val() ? parseFloat($('input[name=pl_on_sale_of_investment]').val()) : 0;
    var interest_dividend_rent = $('input[name=interest_dividend_rent]').val() ? parseFloat($('input[name=interest_dividend_rent]').val()) : 0;
    var other_revenue = $('input[name=other_revenue]').val() ? parseFloat($('input[name=other_revenue]').val()) : 0;

    var total_revenue = premium_earned + pl_on_sale_of_investment + interest_dividend_rent + other_revenue;
    $('input[name=total_revenue]').val(round(total_revenue, 2));

    claims_incurred = $('input[name=claims_incurred]').val() ? parseFloat($('input[name=claims_incurred]').val()) : 0;
    commission = $('input[name=commission]').val() ? parseFloat($('input[name=commission]').val()) : 0;
    operating_expenses = $('input[name=operating_expenses]').val() ? parseFloat($('input[name=operating_expenses]').val()) : 0;
    var others_revenue_account = $('input[name=others_revenue_account]').val() ? parseFloat($('input[name=others_revenue_account]').val()) : 0;

    var operating_profit = total_revenue - claims_incurred - commission - operating_expenses - others_revenue_account;
    $('input[name=operating_profit]').val(round(operating_profit, 2));


    var income_from_investment = $('input[name=income_from_investment]').val() ? parseFloat($('input[name=income_from_investment]').val()) : 0;
    var other_income_revenue = $('input[name=other_income_revenue]').val() ? parseFloat($('input[name=other_income_revenue]').val()) : 0;
    var other_expense_revenue = $('input[name=other_expense_revenue]').val() ? parseFloat($('input[name=other_expense_revenue]').val()) : 0;
    var pbt = $('input[name=pbt]').val() ? parseFloat($('input[name=pbt]').val()) : 0;
    var tax = $('input[name=tax]').val() ? parseFloat($('input[name=tax]').val()) : 0;

    var pat = pbt - tax;
    $('input[name=pat]').val(round(pat, 2));

    eps = pat / (share_capital / fv);
    $('input[name=eps]').val(round(eps, 2));

}

function calculation_cash_flow_statement() {
    var premium_from_policy_shareholder = $('input[name=premium_from_policy_shareholder]').val() ? parseFloat($(
        'input[name=premium_from_policy_shareholder]').val()) : 0;
    var payment_to_re_insurers = $('input[name=payment_to_re_insurers]').val() ? parseFloat($('input[name=payment_to_re_insurers]').val()) : 0;
    var payment_to_co_insurers_net_recovery = $('input[name=payment_to_co_insurers_net_recovery]').val() ?
        parseFloat($('input[name=payment_to_co_insurers_net_recovery]').val()) : 0;
    var payment_of_claims = $('input[name=payment_of_claims]').val() ? parseFloat($('input[name=payment_of_claims]').val()) : 0;
    var payment_of_commission = $('input[name=payment_of_commission]').val() ? parseFloat(
        $('input[name=payment_of_commission]').val()) : 0;
    var payment_of_other_operating_expenses = $('input[name=payment_of_other_operating_expenses]').val() ? parseFloat($('input[name=payment_of_other_operating_expenses]').val()) : 0;
    var cash_flow_statement_others = $('input[name=cash_flow_statement_others]').val() ? parseFloat($(
        'input[name=cash_flow_statement_others]').val()) : 0;
    var tax_cash_flow_statement = $('input[name=tax_cash_flow_statement]').val() ? parseFloat($(
        'input[name=tax_cash_flow_statement]').val()) : 0;


    var cash_flow_from_operations = premium_from_policy_shareholder + payment_to_re_insurers + payment_to_co_insurers_net_recovery + payment_of_claims + payment_of_commission + payment_of_other_operating_expenses + cash_flow_statement_others + tax_cash_flow_statement;
    $('input[name=cash_flow_from_operations]').val(round(cash_flow_from_operations, 2));

    /////////////////////////////////////////////////////
    var purchase_of_fixed_assets = $('input[name=purchase_of_fixed_assets]').val() ? parseFloat($('input[name=purchase_of_fixed_assets]')
        .val()) : 0;
    var sale_of_fixed_assets = $('input[name=sale_of_fixed_assets]').val() ? parseFloat($('input[name=sale_of_fixed_assets]').val()) : 0;
    var purchase_of_investment = $('input[name=purchase_of_investment]').val() ? parseFloat($('input[name=purchase_of_investment]').val()) : 0;

    var sale_of_investment = $('input[name=sale_of_investment]').val() ? parseFloat($(
        'input[name=sale_of_investment]').val()) : 0;

    var cash_flow_from_investing_others = $('input[name=cash_flow_from_investing_others]').val() ? parseFloat($(
        'input[name=cash_flow_from_investing_others]').val()) : 0;

    var cash_flow_from_investment = purchase_of_fixed_assets + sale_of_fixed_assets + purchase_of_investment + sale_of_investment + cash_flow_from_investing_others;
    $('input[name=cash_flow_from_investment]').val(round(cash_flow_from_investment, 2));

    ////////////////////////////////////
    var sale_of_equity_shares = $('input[name=sale_of_equity_shares]').val() ? parseFloat($('input[name=sale_of_equity_shares]').val()) : 0;
    var proceeds_from_borrowing = $('input[name=proceeds_from_borrowing]').val() ? parseFloat($(
        'input[name=proceeds_from_borrowing]').val()) : 0;
    var repayments_from_borrowing = $('input[name=repayments_from_borrowing]').val() ? parseFloat($('input[name=repayments_from_borrowing]').val()) : 0;
    var others_from_financing = $('input[name=others_from_financing]').val() ? parseFloat($(
        'input[name=others_from_financing]').val()) : 0;

    var cash_flow_from_financing = sale_of_equity_shares + proceeds_from_borrowing + repayments_from_borrowing + others_from_financing;
    $('input[name=cash_flow_from_financing]').val(round(cash_flow_from_financing, 2));

    /////////////////////////////////
    var cash_at_the_start = $('input[name=cash_at_the_start]').val() ? parseFloat($('input[name=cash_at_the_start]')
        .val()) : 0;

    var net_cash_generated = cash_flow_from_investment + cash_flow_from_operations + cash_flow_from_financing;
    $('input[name=net_cash_generated]').val(round(net_cash_generated, 2));

    var cash_at_the_end = net_cash_generated + cash_at_the_start;
    $('input[name=cash_at_the_end]').val(round(cash_at_the_end, 2));


    var combined_ratio = (claims_incurred + commission + operating_expenses) / (premium_earned);
    $('input[name=combined_ratio]').val(round(combined_ratio * 100, 2));

    var net_loss_ratio = ((claims_incurred) / (premium_earned));
    $('input[name=net_loss_ratio]').val(round(net_loss_ratio, 2));

    var mcap_gwp = ($('input[name=share_price]').val() * (share_capital / fv) / gwp);
    $('input[name=mcap_gwp]').val(round(mcap_gwp, 2));

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