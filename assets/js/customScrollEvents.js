$(document).ready(function(){
  // disableScroll();
  isSmallScreen = false;
  // Execute on load
  checkWidth();
  // Bind event listener
  $(window).resize(checkWidth);

  function checkWidth() {
    var width = (window.innerWidth > 0) ? window.innerWidth : screen.width;
    if (width > 760)
    { 
        isSmallScreen = false;
        return;
    }
    else if (width <= 760 && isSmallScreen == true)
        return;
    
    isSmallScreen = true;
      //assuming single table on a page find the table
      $table = $("tbody");
      $thead = $("thead>tr");
      $tableheaders = $thead.children();

      $tableheaders.each( function( index ) {
        //search within table'
        $th = $( "th:nth-of-type("+(index+1)+")" , $thead);
        $content = $th.text()+":";

        $td = $( "td:nth-of-type("+(index+1)+")" , $table);
        $td.append('<style> td:nth-of-type('+(index+1)+'):before { content: "'+$content+'"; }</style>')
        $td.before().css("content", $content);
      });
  }


  });


// left: 37, up: 38, right: 39, down: 40,
// spacebar: 32, pageup: 33, pagedown: 34, end: 35, home: 36
// var keys = { 38: 1, 40: 1};

// function preventDefault(e) {
//   e = e || codesnippet.event;
//   if (e.preventDefault)
//       e.preventDefault();
//   e.returnValue = false;  
// }

// function preventDefaultForScrollKeys(e) {
//     if (keys[e.keyCode]) {
//         preventDefault(e);
//         return false;
//     }
// }

// function disableScroll() {
//   if (codesnippet.addEventListener) // older FF
//       codesnippet.addEventListener('DOMMouseScroll', preventDefault, false);
//   codesnippet.onwheel = preventDefault; // modern standard
//   codesnippet.onmousewheel = document.onmousewheel = preventDefault; // older browsers, IE
//   codesnippet.ontouchmove  = preventDefault; // mobile
//   document.onkeydown  = preventDefaultForScrollKeys;
// }

// function enableScroll() {
//     if (codesnippet.removeEventListener)
//         codesnippet.removeEventListener('DOMMouseScroll', preventDefault, false);
//     codesnippet.onmousewheel = document.onmousewheel = null; 
//     codesnippet.onwheel = null; 
//     codesnippet.ontouchmove = null;  
//     document.onkeydown = null;  
// }
