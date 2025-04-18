const number = Math.floor(Math.random() * 100) + 1;
function checkGuess() {
  const guess = parseInt(document.getElementById('guess').value, 10);
  const feedback = document.getElementById('feedback');
  if (guess === number) {
    feedback.innerText = 'Correct!';
  } else if (guess < number) {
    feedback.innerText = 'Too low!';
  } else {
    feedback.innerText = 'Too high!';
  }
}
