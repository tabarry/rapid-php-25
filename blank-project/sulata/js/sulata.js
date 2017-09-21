
//Keep session live
function suStayAlive(url) {
    $.post(url);
}

//Reset form
function suReset(frmName) {


    var elements = document.getElementById(frmName).elements;



    for (i = 0; i < elements.length; i++) {

        field_type = elements[i].type.toLowerCase();

        switch (field_type) {

            case "text":
            case "password":
            case "textarea":
            case "hidden":

                elements[i].value = "";
                break;

            case "radio":
            case "checkbox":
                if (elements[i].checked) {
                    elements[i].checked = false;
                }
                break;

            case "select-one":
            case "select-multi":
                elements[i].selectedIndex = 0;
                break;

            default:
                break;
        }
    }
}
//Redirect
function suRedirect(url) {
    parent.window.location.href = url;
}

////To reload a dropdown
//function suReload(ele,url,sql){
//    $('#'+ele).load(url+'?q='+sql);
//}

//Disable submit button
function suToggleButton(arg) {
    if (arg == 1) {
        if (parent.$('#suForm')) {
            parent.$("#suForm").submit(function(event) {
                if (parent.$('#Submit')) {
                    parent.$("#Submit").val("Processing..");
                    parent.$("#Submit").css("cursor", "default");
                    parent.$("#Submit").attr("disabled", true);
                }
            });
        }
    } else {
        if (parent.$('#suForm')) {
            if (parent.$('#Submit')) {
                parent.$("#Submit").val("Submit");
                parent.$("#Submit").css("cursor", "Pointer");
                parent.$("#Submit").attr("disabled", false);
            }
        }
    }
}
//Reload dropdown
function suReload(ele, url, tbl, f1, f2) {
    url = url + 'reload.php';
    $('#' + ele).load(url + '?tbl=' + tbl + '&f1=' + f1 + '&f2=' + f2);
}
//Reload dropdown
function suReload2(ele, url, tbl, f1, f2, tblb, f1b, f2b, id) {
    url = url + 'reload.php';
    $('#' + ele).load(url + '?type=chk&tbl=' + tbl + '&f1=' + f1 + '&f2=' + f2 + '&tblb=' + tblb + '&f1b=' + f1b + '&f2b=' + f2b + '&id=' + id);
}
//Search dropdown
//Sample code
//<input type="text" id="realtxt" onKeyUp="suSearchCombo(this.id,'mediafile__Category')">
function suSearchCombo(searchBox, searchCombo) {
    var input = document.getElementById(searchBox).value.toLowerCase();
    var output = document.getElementById(searchCombo).options;
    for (var i = 0; i < output.length; i++) {
        if (output[i].text.indexOf(input) >= 0) {
            output[i].selected = true;
        }
        if (document.getElementById(searchBox).value == '') {
            output[0].selected = true;
        }
    }
}


//Delete row and confirm
function delById(id, warning) {
    c = confirm(warning);
    if (c == false) {
        return false;

    } else {
        if ($('#' + id + '_del')) {
            $('#' + id + '_del').hide();
        }
        if ($('#' + id + '_edit')) {
            $('#' + id + '_edit').hide();
        }
        if ($('#' + id + '_duplicate')) {
            $('#' + id + '_duplicate').hide();
        }
        if ($('#' + id + '_restore')) {
            $('#' + id + '_restore').show();
        }
        if ($('#' + id + ' header')) {
            $('#' + id + ' header').addClass('strike-through');
        }
        if ($('#' + id + ' h1')) {
            $('#' + id + ' h1').addClass('strike-through');
        }
        if ($('#' + id + ' p')) {
            $('#' + id + ' p').addClass('strike-through');
        }
        if ($('#' + id + ' label')) {
            $('#' + id + ' label').addClass('strike-through');
        }
        if ($('#' + id + ' .card')) {
            $('#' + id + ' .card').addClass('deleted-bg');
            $('#' + id + ' .card').addClass('red-border');
        }
        if ($('#' + id + ' td')) {
            $('#' + id + ' td').addClass('strike-through');
            $('#' + id + ' td').addClass('deleted-bg');
        }

        return true;
    }
}
//Restore row and confirm
function restoreById(id) {
    if ($('#' + id + '_del')) {
        $('#' + id + '_del').show();
    }
    if ($('#' + id + '_edit')) {
        $('#' + id + '_edit').show();
    }
    if ($('#' + id + '_duplicate')) {
        $('#' + id + '_duplicate').show();
    }
    if ($('#' + id + '_restore')) {
        $('#' + id + '_restore').hide();
    }
    if ($('#' + id + ' h1')) {
        $('#' + id + ' h1').removeClass('strike-through');
    }
    if ($('#' + id + ' p')) {
        $('#' + id + ' p').removeClass('strike-through');
    }
    if ($('#' + id + ' label')) {
        $('#' + id + ' label').removeClass('strike-through');
    }
    if ($('#' + id + ' .card')) {
        $('#' + id + ' .card').removeClass('deleted-bg');
        $('#' + id + ' .card').removeClass('red-border');
    }
    if ($('#' + id + ' td')) {
        $('#' + id + ' td').removeClass('strike-through');
        $('#' + id + ' td').removeClass('deleted-bg');
    }

}
//Checkbox Area
function loadCheckbox(id, txt, fld) {
    //Add new value
    oldVal = $('#checkboxArea').html();
    newVal = "<table class=\"checkTable\" id=\"chkTbl" + id + "\"><tr><td class=\"checkTd\">" + txt + "</td><td class=\"checkTdCancel\" onclick=\"removeCheckbox('" + id + "')\"><a href=\"javascript:;\" onclick=\"removeCheckbox('" + id + "')\">x</a></td></tr><input type=\"hidden\" value=\"" + id + "\" name=\"" + fld + "[]\"></table>";
    $('#checkboxArea').html(oldVal + newVal);
    //Hide old value
    $('#chk' + id).hide();
}

function removeCheckbox(id) {
    $('#chk' + id).show();
    $('#chkTbl' + id).remove();
}

function toggleCheckboxClass(state, id) {
    if (state == 'over') {
        $('#fa' + id).removeClass('fa fa-square-o');
        $('#fa' + id).addClass('fa fa-check-square-o');
    } else {
        $('#fa' + id).removeClass('fa fa-check-square-o');
        $('#fa' + id).addClass('fa fa-square-o');

    }
}
//Password stength validator
function doStrongPassword(passwordEle, outputEle) {
    var tip = "At least 8 characters, 1 uppercase and 1 number.";
    var outputHidden = $('#' + outputEle + '_hidden');
    //TextBox left blank.
    if ($('#' + passwordEle).val().length == 0) {
        $('#' + outputEle).html('');
        return;
    }

    //Regular Expressions.
    var regex = new Array();
    regex.push("[A-Z]"); //Uppercase Alphabet.
    regex.push("[a-z]"); //Lowercase Alphabet.
    regex.push("[0-9]"); //Digit.
    regex.push("[$@$!%*#?&]"); //Special Character.

    var passed = 0;

    //Validate for each Regular Expression.
    for (var i = 0; i < regex.length; i++) {
        if (new RegExp(regex[i]).test($('#' + passwordEle).val())) {
            passed++;
        }
    }


    //Validate for length of Password.
    if (passed > 2 && $('#' + passwordEle).val().length > 8) {
        passed++;
    }

    //Display status.
    var color = "";
    var strength = "";
    switch (passed) {
        case 0:
        case 1:
            strength = tip;
            color = "red";
            break;
        case 2:
            strength = "Good";
            color = "darkorange";
            break;
        case 3:
        case 4:
            strength = "Strong";
            color = "green";
            break;
        case 5:
            strength = "Very Strong";
            color = "darkgreen";
            break;
    }
    $('#' + outputEle).html(strength);
    $('#' + outputEle).css("color", color);
    outputHidden.val(passed);
}
//Slugify text
function doSlugify(text, spaceCharacter)
{
    return text.toString().toLowerCase()
            .replace(/\s+/g, spaceCharacter)           // Replace spaces with -
            .replace(/[^\w\-]+/g, '')       // Remove all non-word chars
            .replace(/\-\-+/g, spaceCharacter)         // Replace multiple - with single -
            .replace(/^-+/, '')             // Trim - from start of text
            .replace(/-+$/, '');            // Trim - from end of text
}
//Sleep, delay, wait
function sleep(milliseconds) {
    var start = new Date().getTime();
    for (var i = 0; i < 1e7; i++) {
        if ((new Date().getTime() - start) > milliseconds) {
            break;
        }
    }
}
