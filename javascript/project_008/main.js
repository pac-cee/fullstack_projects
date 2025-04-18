let count = 0;
function changeCount(val) {
  count += val;
  document.getElementById('count').innerText = count;
}
function resetCount() {
  count = 0;
  document.getElementById('count').innerText = count;
}
