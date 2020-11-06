$(document).ready(function() {

    $('body').on("keypress keyup blur change", '.xCNInputNumericWithDecimal', function(event) {
        if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
            event.preventDefault();
        }
	});

	$('body').on("keypress keyup blur change", '.xCNNumberandPercent', function(event) {
        if ((event.which < 48 || event.which > 57) && event.keyCode !== 37 && event.keyCode !== 44) {
            event.preventDefault();
        }
    });

    $('body').on("keypress", '.xCNInputNumericWithoutDecimal', function(event) {
        InputId = event.target.id;
        if ((event.which < 48 || event.which > 57)) {
            event.preventDefault();
        }
    });

    $("body").on("keypress keyup blur change", ".xCNInputLength", function(event) {
        var nLength = $(this).data('length');
        var nInputLength = $(this).val().length;
        if(nInputLength >= nLength){
            event.preventDefault();
        }
    });

    $("body").on("keypress keyup blur change", ".xCNInputMaxValue", function(event) {
        var nMaxValue = $(this).data('max');
        var nInputValue = $(this).val();
        console.log(nInputValue > nMaxValue && nMaxValue !== "");
        if(nInputValue > nMaxValue && nMaxValue !== ""){
            $(this).val("");
            event.preventDefault();
        }
    });

    $("body").on("keypress keyup blur change", ".xCNInputMinValue", function(event) {
        var nMinValue = $(this).data('min');
        var nInputValue = $(this).val();
        if(nInputValue < nMinValue && nMinValue !== ""){
            $(this).val("");
            event.preventDefault();
        }
    });

    $(".xCNInputAddressNumber").on("keypress keyup blur", function(event) {
        var tInputVal = $(this).val();
        var tCharacterReg = /^\s*[0-9,/,-]+\s*$/;
        if (!tCharacterReg.test(tInputVal) && tInputVal != '') {
            $(this).val(tInputVal.slice(0, -1));
            event.preventDefault();
        }
    });

    $('.xCNInputWithoutSpc').on("keypress keyup blur", function(event) {
        var tInputVal = $(this).val();
        var tCharacterReg = /^\s*[a-z,A-Z,ก-๙,0-9,@,-]+\s*$/;
        if (!tCharacterReg.test(tInputVal) && tInputVal != '') {
            $(this).val(tInputVal.slice(0, -1));
            event.preventDefault();
        }
    });

    $('.xCNInputWithoutSpcNotThai').on("keypress keyup blur", function(event) {
        var tInputVal = $(this).val();
        var tCharacterReg = /^\s*[a-z,A-Z,0-9,ก-๙]+\s*$/;
        if (!tCharacterReg.test(tInputVal) && tInputVal != '') {
            $(this).val(tInputVal.slice(0, -1));
            event.preventDefault();
        }
    });

    $(".xCNInputOnlyEng").on("keypress keyup blur", function(event) {
        var tInputVal = $(this).val();
        var tCharacterReg = /[A-Za-z0-9]/;
        if (!tCharacterReg.test(tInputVal) && tInputVal != '') {
            $(this).val(tInputVal.slice(0, -1));
            event.preventDefault();
        }
    });

    $(".xCNInputWithoutSingleQuote").on("keypress keyup blur", function(event) {
        var tInputVal = $(this).val();
        var tCharacterReg = /(?=.*['"])/g;
        if (tCharacterReg.test(tInputVal) && tInputVal != '') {
            $(this).val(tInputVal.slice(0, -1));
            event.preventDefault();
        }
    });

    $(".xCNGenarateCodeTextInputValidate").on("keypress keyup blur", function(event) {
        var tInputVal = $(this).val();
        var tCharacterReg = /(?=.*[!\\^;?><,'"])/g;
        if (tCharacterReg.test(tInputVal) && tInputVal != '') {
            $(this).val(tInputVal.slice(0, -1));
            event.preventDefault();
        }
    });

    $(".xCNInputVandingTemperature").on("keypress keyup blur", function(event) {
        var tInputVal = $(this).val();
        var tCharacterReg = /^\s*[0-9\.,-]+\s*$/;
        if (!tCharacterReg.test(tInputVal) && tInputVal != '') {
            $(this).val(tInputVal.slice(0, -1));
            event.preventDefault();
        }
    });

    $("input , textarea").on("keypress keyup blur", function(event) {
        var tInputVal = $(this).val();
        var tCharacterReg = /(?=.*['"])/g;
        if (tCharacterReg.test(tInputVal) && tInputVal != '') {
            $(this).val(tInputVal.slice(0, -1));
            event.preventDefault();
        }
    });

    $(".xCNInputWithoutSingleAndDoubleQuote").on("keypress keyup blur", function(event) {
        var tInputVal = $(this).val();
        var tCharacterReg = /(?=.*[!\^\"\'])/g;
        if (tCharacterReg.test(tInputVal) && tInputVal != '') {
            $(this).val(tInputVal.slice(0, -1));
            event.preventDefault();
        }
    });


});
