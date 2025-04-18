function calculateTip() {
  const bill = parseFloat(document.getElementById('bill').value);
  const tip = parseFloat(document.getElementById('tip').value);
  if (bill && tip >= 0) {
    const tipAmount = bill * (tip / 100);
    const total = bill + tipAmount;
    document.getElementById('total').innerText = `Tip: $${tipAmount.toFixed(2)}, Total: $${total.toFixed(2)}`;
  } else {
    document.getElementById('total').innerText = 'Please enter valid values.';
  }
}
