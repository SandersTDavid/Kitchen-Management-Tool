function radio_toolbar_click (ev) {
  let checked=document.querySelector('input[name="radio"]:checked');

  if(checked) {
    checked.checked=false;
  }

  ev.target.previousElementSibling.checked=true;
}
