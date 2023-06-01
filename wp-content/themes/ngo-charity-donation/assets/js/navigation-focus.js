var ngo_charity_donation_Keyboard_loop = function (elem) {
  var ngo_charity_donation_tabbable = elem.find('select, input, textarea, button, a').filter(':visible');
  var ngo_charity_donation_firstTabbable = ngo_charity_donation_tabbable.first();
  var ngo_charity_donation_lastTabbable = ngo_charity_donation_tabbable.last();
  ngo_charity_donation_firstTabbable.focus();

  ngo_charity_donation_lastTabbable.on('keydown', function (e) {
    if ((e.which === 9 && !e.shiftKey)) {
      e.preventDefault();
      ngo_charity_donation_firstTabbable.focus();
    }
  });

  ngo_charity_donation_firstTabbable.on('keydown', function (e) {
    if ((e.which === 9 && e.shiftKey)) {
      e.preventDefault();
      ngo_charity_donation_lastTabbable.focus();
    }
  });

  elem.on('keyup', function (e) {
    if (e.keyCode === 27) {
      elem.hide();
    };
  });
};