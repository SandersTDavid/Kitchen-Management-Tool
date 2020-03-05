function radio_toolbar_click (ev) {
  let checked=document.querySelector('input[name="radio"]:checked');

  if(checked) {
    checked.checked=false;
  }

  ev.target.previousElementSibling.checked=true;
}

function capitalizeFLetter() {
   var input = document.getElementById("textbox");
   var x = document.getElementById("textbox"); 
   var string = input.value;
   x.innerHTML = string[0].toUpperCase() +
     string.slice(1);
 }
