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



// adds rows to dynamic table and updates a total time
var addTime = [];
function addRow() {
         var userInput1 =  document.querySelector('.input').value;
         var userInput2 =  document.querySelector('.input2').value;
         var userInput3 =  document.querySelector('.input3').value;
// returns a value for food
         function getFood(){
                  var food = userInput1;
                  if (food!=''){
                  return food;
                }
         }
// returns a value for category
         function getCategory(){
                  var category = userInput2;
                  if(category!=''){
                  return category;
                }
         }
// returns a value for time
         function getTime(){
                  var time = userInput3;
                  if(time!=''){
                  return time;
                  }
        }
// returns a value for the table name
        function getTableRef(){
                 var tableRef = document.getElementById('mytable');
                 return tableRef;
        }

// Adds a row with user input to the table
        function getNewRow(){
                 var food = getFood();
                 var category = getCategory();
                 var time = getTime();
                 var tableRef = getTableRef();

                 var foodText = document.createTextNode(food);
                 var categoryText = document.createTextNode(category);
                 var timeText = document.createTextNode(time);

                 var attr = document.createAttribute('draggable');
                 attr.value = 'true';

                 var newRow = tableRef.insertRow(-1);
                 newRow.setAttributeNode(attr);
                 newRow.className = 'draggable';

                 var newCell = newRow.insertCell(0);
                 var newCell2 = newRow.insertCell(1);
                 var newCell3 = newRow.insertCell(2);

                 newCell.appendChild(foodText);
                 newCell2.appendChild(categoryText);
                 newCell3.appendChild(timeText);
                 addEventsDragAndDrop(newRow);
      }


// returns total of time values from array
       function getTotalTime(){
                let total = 0;
                var timeValue = getTime();
                addTime.push(parseInt(timeValue, 10));
                    for(var i in addTime) {
                       total += addTime[i];
                       }
                return total;
        }

//  converts a time value into hours and minutes
       function setTotalTime(){
                var strMins = ' Mins';
                var strHrs = ' Hrs ';
                var total = getTotalTime();
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
getNewRow();
setTotalTime();
}

document.getElementById('btn').addEventListener('click', addRow);
