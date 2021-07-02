
document.getElementById("ul1").addEventListener("click",function(e) {
    var tgt = e.target;
    if (tgt.tagName.toUpperCase() == "LI") {
      tgt.parentNode.removeChild(tgt); // or tgt.remove();
    }
  });