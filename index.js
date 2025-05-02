document.getElementById('contactForm').addEventListener('submit', function (e) {
  e.preventDefault();

  const formData = new FormData(this);

  fetch('index.php', {
    method: 'POST',
    body: formData,
  })
    .then((response) => {
      if (!response.ok) throw new Error('Network response was not ok');
      return response.text();
    })
    .then((data) => {
      document.getElementById('contactForm').reset();
    })
    .catch((error) => {
      alert('There was an error sending your message.');
      console.error('Error:', error);
    });
});
