(function ($) {

    'use strict';


    function number_format (number, decimals, decPoint, thousandsSep) {
        
        number = (number + '').replace(/[^0-9+\-Ee.]/g, '')
        var n = !isFinite(+number) ? 0 : +number
        var prec = !isFinite(+decimals) ? 0 : Math.abs(decimals)
        var sep = (typeof thousandsSep === 'undefined') ? ',' : thousandsSep
        var dec = (typeof decPoint === 'undefined') ? '.' : decPoint
        var s = ''

        var toFixedFix = function (n, prec) {
            var k = Math.pow(10, prec)
            return '' + (Math.round(n * k) / k)
                    .toFixed(prec)
        }

        s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.')
        if (s[0].length > 3) {
            s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep)
        }
        if ((s[1] || '').length < prec) {
            s[1] = s[1] || ''
            s[1] += new Array(prec - s[1].length + 1).join('0')
        }

        return s.join(dec)
    }
    
    
    //Main output Function
    function inspiryMcOutputFunc(){

        // Getting output div id
        var outputDiv = $("#inspiry-mc-output");

        // Getting total amount value from user
        var mcTotalAmount = parseFloat($("#inspiry-mc-total-amount").val() );

        //Getting down payment value from user
        var mcDownPayment = parseFloat($("#inspiry-mc-down-payment").val() );

        //Getting interest rate value from user
        var mcInterestRate = parseFloat($("#inspiry-mc-interest-rate").val() );

        //Getting mortgage period value from user
        var mcAmortizationPeriod = parseFloat($("#inspiry-mc-mortgage-period").val() );

        //Calculating principal amount by subtracting down payment from total amount
        var principal = mcTotalAmount - mcDownPayment;

        if ( 0 !== mcInterestRate ){

            //Calculating r by this formula ( (InterestRate/100)/12 )
            var r = ((mcInterestRate / 100) / 12);

            // Power calculating by this formula Math.pow(base, exponent)
            var power = Math.pow((1 + r), (mcAmortizationPeriod * 12));

            // Calculating total mortgage
            var monthlyMortgage = principal * ((r * power) / (power - 1));
            
        } else {

            var monthlyMortgage = principal / ( mcAmortizationPeriod * 12 );
        }
       

        //Total mortgage with interest
        var tmwi = monthlyMortgage * mcAmortizationPeriod * 12;

        //Total with down payment
        var tmwdp = tmwi + mcDownPayment;

       // Getting localize php strings
        var outPutString = inspiry_mc_strings.mc_output_string;

        //Currency sign
        var mcCurrencySign = inspiry_mc_strings.mc_currency_sign;

        // Decimal numbers
        var decimalNumbers = inspiry_mc_strings.mc_number_of_decimals;

        //Decimal Separator
        var decimalSeparator = inspiry_mc_strings.mc_decimal_separator;

        //Thousand Separator
        var thousandSeparator = inspiry_mc_strings.mc_thousand_separator;

        //Currency Sign Position
        var currencySignPosition = inspiry_mc_strings.mc_currency_sign_position;

        //Formatting principal amount
        principal= number_format( principal, decimalNumbers, decimalSeparator, thousandSeparator );

        //Assigning currency sign position to principal
        principal = (currencySignPosition == 'before') ? mcCurrencySign+principal : principal+mcCurrencySign;

        //Formatting monthly mortgage amount
        monthlyMortgage= number_format( monthlyMortgage, decimalNumbers, decimalSeparator, thousandSeparator );

        //Assigning currency sign position to monthly Mortgage
        monthlyMortgage = (currencySignPosition == 'before') ? mcCurrencySign+monthlyMortgage : monthlyMortgage+mcCurrencySign;

        //Formatting monthly mortgage with interest amount
        tmwi= number_format( tmwi, decimalNumbers, decimalSeparator, thousandSeparator );

        //Assigning currency sign position to monthly mortgage with interest amount
        tmwi = (currencySignPosition == 'before') ? mcCurrencySign+tmwi : tmwi+mcCurrencySign;

        //Formatting total mortgage with down payment
        tmwdp= number_format( tmwdp, decimalNumbers, decimalSeparator, thousandSeparator );

        //Assigning currency sign position to total mortgage with down payment
        tmwdp = (currencySignPosition == 'before') ? mcCurrencySign+tmwdp : tmwdp+mcCurrencySign;

        outPutString = outPutString.replace( "[mortgage_amount]", principal);
        outPutString = outPutString.replace( "[amortization_years]", mcAmortizationPeriod );
        outPutString = outPutString.replace( "[mortgage_payment]", monthlyMortgage );
        outPutString = outPutString.replace( "[total_mortgage_interest]", tmwi );
        outPutString = outPutString.replace( "[total_mortgage_down_payment]", tmwdp );

        //Displaying output div
        outputDiv.html( "<p>"+outPutString+"</p>").stop(true, true).slideDown();
        outputDiv.html(outputDiv.html().replace(new RegExp("LINEBREAK","g"),"<br>"));
    }


    // Form validation and submission
    if ( jQuery().validate ) {
        $("#inspiry-mc-form").validate({
            rules: {
                field: {
                    number: true,
                    min:0
                }
            },
            submitHandler: function() {
                inspiryMcOutputFunc();
            }
        });
    }

})(jQuery);