var i = 0;
var images = [];
var time = 3000;

image[0] = 'images/obraz1.jpg';
image[1] = 'images/obraz2.jpg';
image[2] = 'images/obraz3.jpg';
image[3] = 'images/obraz4.jpg';
image[4] = 'images/obraz5.jpg';

function zmiana(){
document.slide.src = image[1];

if(i<image.lenght - 1) {
i++;
}else {
i=0;}

setTimeout("zmiana()", time);
}

window.onload = zmiana;
<img name="slide" width="400" height="200">

