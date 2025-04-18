function calculateBMI() {
  const w = parseFloat(document.getElementById('weight').value);
  const h = parseFloat(document.getElementById('height').value) / 100;
  if (w && h) {
    const bmi = (w / (h * h)).toFixed(2);
    document.getElementById('bmi').innerText = 'BMI: ' + bmi;
  } else {
    document.getElementById('bmi').innerText = 'Please enter valid values.';
  }
}
