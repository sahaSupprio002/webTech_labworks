
document.getElementById("submit").onclick  =function(){
    const selectedColor = document.getElementById('color').value;
    document.getElementById('box1').style.backgroundColor = selectedColor;
}