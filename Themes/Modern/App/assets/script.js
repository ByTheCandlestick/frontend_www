// enable :active on touch devices
document.addEventListener("touchstart", function() {},false);

// the good stuff
var $tabController = $('.tab-controller li');
var $tabContent = $('.tab-content');
var defaultActiveTab = 4; 

$(document).ready(function() {
  $('body').fadeIn(); 
  
  $tabController.eq(defaultActiveTab).addClass('active'); // show X tab by default
  $tabContent.eq(defaultActiveTab).addClass('active'); // show X content by default  
  
  $tabController.on('click', function() {
	var tabNumber = $(this).index(); // get index number of clicked tab

	if ($(this).hasClass('active')) { // if clicked tab already has active class
	  console.log('Tab ' + tabNumber + ' is already active - do nothing');
	  return; // do nothing

	} else {
	  console.log('Tab ' + tabNumber + ' is active');
	  $tabController.removeClass('active'); // remove active class from all tab controllers
	  $(this).addClass('active'); // add active class to currently clicked tab controller

	  $tabContent.removeClass('active').detach(); // remove active class from all tab content and detach 
	  $tabContent.eq(tabNumber).addClass('active').appendTo('.tab-content-container'); // add active class to show tab content based on clicked tab controller and append previously detached element
	}

  });
  
});

