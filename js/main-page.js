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

function suggestStation(input) {
    let string = input.value.trim();
    if (string.length < 2) return;
    
    let request = new XMLHttpRequest();
    let requestPath = `/search_trips/suggest_stations?string=${string}`;
    request.open('GET', requestPath, true);
    request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    request.onload = () => {
        if (request.status != 200) {
            customAlert('Техническая ошибка', 'Попробуйте позже');
            console.error(request.responseText);
            return;
        }
        if (request.responseText != '0') {
            let stations;
            try {
                stations = JSON.parse(request.responseText);
            } catch (exception) {
                alert(exception.message);
                return;
            }
            // console.log(stations);
            let suggestions = document.createElement('div');
            suggestions.className = 'suggestions';
            suggestions.dataset.fieldId = input.id;
            stations.forEach((station) => {
                suggestions.innerHTML += `<div class="suggestion" onclick="inputStation(this)" data-station-id="${station.id}">${station.name}</div>`
            });
            input.after(suggestions);
        }
        return;
    };
    request.send();
}

function inputStation(suggestion) {
    let fieldId = suggestion.parentNode.dataset.fieldId;
    let field = document.getElementById(fieldId);

    field.dataset.stationId = suggestion.dataset.stationId;
    field.value = suggestion.innerText;
    suggestion.parentNode.parentNode.removeChild(suggestion.parentNode); // проще не работает
}

function searchTrips(form) {
    let stationFrom = form.querySelector('input[name="station_from"]').dataset.stationId;
    let stationTo = form.querySelector('input[name="station_to"]').dataset.stationId;
    let date = form.querySelector('input[name="date"]').value;
    let count = parseInt(form.querySelector('input[name="count"]').value);
    if (stationFrom == '') {
        let errorPopup = document.createElement('div');
        errorPopup.className = 'error-popup';
        errorPopup.innerText = 'Пожалуйста, выберите станцию из списка предложенных';
        form.querySelector('input[name="station_from"]').after(errorPopup);
        setTimeout(() => {
            errorPopup.style.opacity = 1;
        }, 200);
        setTimeout(() => {
            errorPopup.style.opacity = 0;
        }, 4800);
        setTimeout(() => {
            errorPopup.remove();
        }, 5000);
        return;
    }
    if (stationTo == '') {
        let errorPopup = document.createElement('div');
        errorPopup.className = 'error-popup';
        errorPopup.innerText = 'Пожалуйста, выберите станцию из списка предложенных';
        form.querySelector('input[name="station_to"]').after(errorPopup);
        setTimeout(() => {
            errorPopup.style.opacity = 1;
        }, 200);
        setTimeout(() => {
            errorPopup.style.opacity = 0;
        }, 4800);
        setTimeout(() => {
            errorPopup.remove();
        }, 5000);
        return;
    }
    // console.log(stationFrom, stationTo, date, count);
    window.location.href = `/search_trips?from=${stationFrom}&to=${stationTo}&date=${date}&count=${count}`;
}