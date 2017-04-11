function show_student_info(id)
{
  var div = document.getElementById(id);
  if (div.style.display == 'none')
  {
    div.style.display = 'block';
    return;
  }
  div.style.display = 'none';
}

function remove_waitlist(id)
{
  if (confirm('Are you sure you would like to remove this person from the waitlist?'))
  {
    var div = document.getElementById('contact-' + id);
    $.ajax({  //use ajax to run the check
              type: "POST",
              url: "ajax/waitlist_remove.ajax.php",
              data: { WaitlistID: id},
              success: function(result) {
              },
              fail: function(result) { console.log('fail'); }
    });
    div.style.display = 'none';
  }
}
