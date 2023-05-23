window.addEventListener('load', function() {
  document.getElementById('images').style.display = 'none';
  document.getElementById('login').style.visibility = 'block';

  document.getElementById('btnLogin').onclick = function() {
    var password = document.getElementById('password').value;
    if (password === document.getElementById('content').innerHTML) {
      document.getElementById('login').style.visibility = 'none';
      document.getElementById('images').style.display = 'block';
    }
    else {
      alert('Invalid password!');
    }
  };
});
