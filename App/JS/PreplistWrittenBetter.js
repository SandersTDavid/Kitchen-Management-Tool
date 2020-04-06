var btn = document.querySelector('.add');
var remove = document.querySelector('.draggable');

function dragStart(e) {
  this.style.opacity = '0.4';
  dragSrcEl = this;
  e.dataTransfer.effectAllowed = 'move';
  e.dataTransfer.setData('text/html', this.innerHTML);
};

function dragEnter(e) {
  this.classList.add('over');
}

function dragLeave(e) {
  e.stopPropagation();
  this.classList.remove('over');
}

function dragOver(e) {
  e.preventDefault();
  e.dataTransfer.dropEffect = 'move';
  return false;
}

function dragDrop(e) {
  if (dragSrcEl != this) {
    dragSrcEl.innerHTML = this.innerHTML;
    this.innerHTML = e.dataTransfer.getData('text/html');
  }
  return false;
}

function dragEnd(e) {
  var listItems = document.querySelectorAll('.draggable');
  [].forEach.call(listItems, function(item) {
    item.classList.remove('over');
  });
  this.style.opacity = '1';
}

function addEventsDragAndDrop(el) {
  el.addEventListener('dragstart', dragStart, false);
  el.addEventListener('dragenter', dragEnter, false);
  el.addEventListener('dragover', dragOver, false);
  el.addEventListener('dragleave', dragLeave, false);
  el.addEventListener('drop', dragDrop, false);
  el.addEventListener('dragend', dragEnd, false);
}

var listItems = document.querySelectorAll('.draggable');
[].forEach.call(listItems, function(item) {
  addEventsDragAndDrop(item);
});

 var strMins = ' Mins';
 var strHrs = ' Hrs ';
 var addtime =[];
 function addRow(mytable) {

}

function getTime()){

}

function setTime(){

}

function toMinsHrs(){

}

function restrictBoxInput(){
  
}

  document.getElementById('btn').addEventListener('click', function(){addRow('mytable');});

  function clearText() {
    document.getElementById("search").reset();
    document.getElementById("search2").reset();
    document.getElementById("search3").reset();
  }
