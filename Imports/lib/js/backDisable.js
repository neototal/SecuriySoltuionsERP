function preventBack(){window.history.forward(0);}
setTimeout("preventBack()",0);
window.onunload=function (){null};