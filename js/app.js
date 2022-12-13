
let Radios = document.querySelectorAll("form div div input[type=\"radio\"]")

var prev = null;

for (var i = 0; i < Radios.length; i++) {
    Radios[i].addEventListener('click', function() {

        // (prev) ? console.log(prev.value): null;
        if (this !== prev) {
            prev = this;
        }

        let textdiv = this.name + "ReasonDiv";
        // let textReason = this.name + "Reason";

        var div = document.getElementById(textdiv);
        // var Reason = document.getElementById(textReason)

        if(this.checked && this.value == "5" || this.value == "4")
        {
            // Reason.type = "text";
            div.style.display = 'flex';
        }
        else
        {
            // Reason.type = "hidden";
            div.style.display = 'none';
        }

    });
}



function start(stablize, speed, operate, program, ability)
{
    $(stablize).prop("checked", true);
    $(speed).prop("checked", true);
    $(operate).prop("checked", true);
    $(program).prop("checked", true);
    $(ability).prop("checked", true);

    let RadiosDetail = document.querySelectorAll("form div div input[type=\"radio\"]")

    for (var i = 0; i < RadiosDetail.length; i++)
    {

        // let text = RadiosDetail[i].name + "Reason";
        let div = RadiosDetail[i].name + "ReasonDiv";

        console.log(RadiosDetail[i])

        if(RadiosDetail[i].checked && (RadiosDetail[i].value == "5" || RadiosDetail[i].value == "4"))
        {
            // document.getElementById(text).type = "text";
            document.getElementById(div).style.display = 'flex';
        }
    }
}