$(document).ready(function(){
      //this initializes all the modals
      $(".modal").dialog({
			bgiframe: true,
			autoOpen: false,
			width:944,
			modal: true,
      height: 2000,
			resizeable:false
		  });
		  
		  //this initializes all the "close" buttons on all the modals
		  $(".modal .modalBack a").click(function(){
		     $(".modal").dialog("close");
		  });
		  
		  //this is just for demo purposes on how to pop a modal from a html page
		  $(".openModal1").click(function(){
		     $(".modalMusic").dialog("open");
		  });
		  
});

//Instructions for flash
//you know how you create a link in flash? 
//so instead of a url like "http://www.yahoo.com", you put in "javascript:mdlMusic()" and that should pop the modal

function mdlMusic()
{
  $(".modalMusic").dialog("open");
}
