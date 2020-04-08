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
   var food = document.createTextNode(document.querySelector('.input').value);
   var category = document.createTextNode(document.querySelector('.input2').value);
   var time = document.createTextNode(document.querySelector('.input3').value);
    document.querySelector('.input').value = '';
     document.querySelector('.input2').value = '';
      document.querySelector('.input3').value = '';
  if (food != '') {
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

    newCell.appendChild(food);
    newCell2.appendChild(category);
    newCell3.appendChild(time);
    addEventsDragAndDrop(newRow);

}
  const timeValue = newCell3.innerHTML;
  let total = 0;
  addtime.push(parseInt(timeValue, 10));
  for(var i in addtime) {
     total += addtime[i];
     }

   if (total <60){
      document.getElementById("totalTime").innerHTML = total + strMins;
      }
   else{
        var hours = (total / 60);
        var rhours = Math.floor(hours);
        var minutes = (hours - rhours) * 60;
        var rminutes = Math.round(minutes);
        document.getElementById("totalTime").innerHTML = rhours + strHrs + rminutes + strMins ;
       }
}


  document.getElementById('btn').addEventListener('click', function(){addRow('mytable');});
