
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
  var listItens = document.querySelectorAll('.draggable');
  [].forEach.call(listItens, function(item) {
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

var listItens = document.querySelectorAll('.draggable');
[].forEach.call(listItens, function(item) {
  addEventsDragAndDrop(item);
});


 function addRow(mytable) {
 var newItem = document.createTextNode(document.querySelector('.input').value);
 var category = document.createTextNode("Cook");
 var time = document.createTextNode("time");
 document.querySelector('.input').value = '';
  // Get a reference to the table
  if (newItem != '') {
  var tableRef = document.getElementById(mytable);
  var attr = document.createAttribute('draggable');
  attr.value = 'true';
  // Insert a row at the end of the table
  var newRow = tableRef.insertRow(-1);
  newRow.setAttributeNode(attr);
  newRow.className = 'draggable';

  // Insert a cell in the row at index 0
  var newCell = newRow.insertCell(0);
  var newCell2 = newRow.insertCell(1);
  var newCell3 = newRow.insertCell(2);

   var newText = newItem;
   var newText2 = category;
   var newText3 = time;

  newCell.appendChild(newItem);
  newCell2.appendChild(newText2);
  newCell3.appendChild(newText3);
  addEventsDragAndDrop(newRow);
   }
   //not working for some reason
  else {
    document.getElementById("msg").innerHTML = "Please enter a name";
  }
}


  document.getElementById('btn').addEventListener('click', function(){addRow('mytable');});
