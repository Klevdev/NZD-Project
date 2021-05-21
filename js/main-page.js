function field_increment(increment) {
    let value = Number(document.getElementById('count').value.replace(" чел.", ""));

    if (increment === true)
        value++;
    else
        if (value > 1)
            value--;

    document.getElementById('count').value = value + ' чел.';
}