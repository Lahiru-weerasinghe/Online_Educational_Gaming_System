var btnPremium1 = document.getElementsByClassName("btnPremium")[0];
var btnPremium2 = document.getElementsByClassName("btnPremium")[1];
btnPremium1.addEventListener("click", function () {
  document.location.href = "payment.php";
});

btnPremium2.addEventListener("click", function () {
  document.location.href = "payment.php";
});

var btnSwitchValue = "monthly";

var btnSwitch = document.getElementById("btnSwitchRound");

btnSwitch.addEventListener("click", function () {
  var monthlyValue = 9;
  var annualyValue = 0;

  if (btnSwitchValue === "monthly") {
    annualyValue = monthlyValue * 12 * 0.8;

    document.getElementById("value").innerHTML = "$" + annualyValue + "/year";
    btnSwitchValue = "Annualy";
  } else {
    document.getElementById("value").innerHTML = "$" + monthlyValue + "/mon";
    btnSwitchValue = "monthly";
  }
});
