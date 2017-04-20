$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();
});

/*
 * Toggle student information on click of div
 */
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

/*
 * Remove a waitlist name with a given id and hide div
 */
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

/*
 * Remove a student with a given id and hide div
 */
function remove_student(id)
{
  if (confirm('Are you sure you want to remove this student? It CANNOT be undone and will remove the students parents and emergency contact information.'))
  {
    var div = document.getElementById('student-' + id);
    $.ajax({  //use ajax to run the check
              type: "POST",
              url: "ajax/student_remove.ajax.php",
              data: { StudentID: id},
              success: function(result) {
              },
              fail: function(result) { console.log('fail'); }
    });
    div.style.display = 'none';
    document.getElementById(id).style.disply = 'none';
  }
}

/*
 * Remove a class with a given id and hide div
 */
function remove_class(id)
{
  if (confirm('Are you sure you want to remove this class? This action cannot be undone.'))
  {
    var div = document.getElementById('class-' + id);
    $.ajax({  //use ajax to run the check
              type: "POST",
              url: "ajax/class_remove.ajax.php",
              data: { ClassID: id},
              success: function(result) {
              },
              fail: function(result) { console.log('fail'); }
    });
    div.style.display = 'none';
  }
}
