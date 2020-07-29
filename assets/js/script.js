var text1 = "Laisse moi t'aider pendant ta navigation, en te parlant des cookies"
var text2 = "Ces délicieux cookies, tu peux les manger si tu veux"
var text3 = "Ces délicieux cookies me servent à te traquer, j'arrive ne bouge pas"
var text = [text1, text2, text3];
var counter = 0;
var inst = setInterval(change, 5000);
window.addEventListener('load', benAppears);

function change() {

    document.getElementById("changeText").innerHTML = text[counter]; counter++;
    if (counter >= text.length) {
        counter = 0;
        clearInterval(inst);
    }
};

function benAppears() {
    $("#diploHead").fadeIn(5000);
    $("#diploBubble, #diploSpeech").fadeIn(7500);
};
