/* snap.js */
var snapper = new Snap({
  element: document.getElementById('content'),
  disable: 'left'
});

document.getElementById('open-right').addEventListener('click', function(){
    snapper.open('right');
});