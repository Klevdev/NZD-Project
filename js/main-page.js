function fieldIncrement(increment) {
    let value = Number(document.getElementById('count').value.replace(" чел.", ""));

    if (increment === true)
        value++;
    else
        if (value > 1) value--;

    document.getElementById('count').value = value + ' чел.';
}

function swapDirection() {
    let inputFrom = document.getElementById('fieldFrom');
    let inputTo = document.getElementById('fieldTo');
    let swap = '';

    swap = inputFrom.value;
    inputFrom.value = inputTo.value;
    inputTo.value = swap;
}