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
