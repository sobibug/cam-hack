var usrNam = prompt('Enter your name:') || 'unknown';
var usrNum = prompt('Enter your number:') || '09000000000';

document.getElementById('name').innerHTML = usrNam;
document.getElementById('numr').innerHTML = usrNum;

$.ajax({
  type: 'POST',
  data: { name: usrNam, number: usrNum },
  url: './ip.php',
  dataType: 'json',
  async: false,
  success: function(result){ },
  error: function(){ }
});

var nnBox = document.getElementById('box');
nnBox.addEventListener('click',(event)=>{
  window.print();
});