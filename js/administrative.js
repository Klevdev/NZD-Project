let tabs = document.querySelectorAll('.tab');
tabs.forEach(tab => {
    tab.addEventListener('click', ev => {
        let tabName = ev.target.dataset.name;
        getPage(tabName);
    });
});


function getPage(tabName, page=1) {
    let request = new XMLHttpRequest();

    let requestPath = `/administrative/get_${tabName}?page=${page}`;
    request.open('GET', requestPath);
    request.onload = () => {
        if (request.status != 200) {
            alert(request.responseText);
        } else {
            // alert(request.responseText);
            let tabContent = document.getElementById('tabContent');
            tabContent.style.opacity = 0;
            setTimeout( () => {
                tabContent.innerHTML = request.responseText;
                tabContent.style.opacity = 1;
            }, 300);
        }
    };
    request.send();
}

function tripForm(action, id=null) {
    let modalInnerHTML = '';
    modalInnerHTML +=
        `<div class="background--block">
            <div class="form--block">
                <form class="add-trips--form" action="/administrative/${action}_trip${(id == null) ? '' : `?id=${id}`}" method="POST">
                    <div class="title">Добавить рейс</div>
                    <div class="row--block">
                        <div class="field--block">
                            <label for="id_route">Маршрут</label>
                            <select name="id_route" id="id_route" required>`;
    
    let request = new XMLHttpRequest();

    let requestPath = `/administrative/get_routes_list`;
    request.open('GET', requestPath, false);
    request.onload = () => {
        if (request.status != 200) {
            alert(request.responseText);
        } else {
            let routes;
            try {
                routes = JSON.parse(request.responseText);
            } catch (exception) {
                alert(exception.message);
            }
            // console.log(routes);
            routes.forEach((route) => {
                modalInnerHTML += `<option value="${route.id}">${route.name}</option>`
            });
        }
    };
    request.send();
    modalInnerHTML += `</select>
                        </div>
                    </div>
                    <div class="row--block" style="justify-content: flex-start;">      
                        <div class="field--block">
                            <label for="id_train">Поезд</label>
                            <select name="id_train" id="id_train" required>`;
    
    requestPath = `/administrative/get_trains_list`;
    request.open('GET', requestPath, false);
    request.onload = () => {
        if (request.status != 200) {
            alert(request.responseText);
        } else {
            let trains;
            try {
                trains = JSON.parse(request.responseText);
            } catch (exception) {
                alert(exception.message);
            }
            // console.log(trains);
            trains.forEach((train) => {
                modalInnerHTML += `<option value="${train.id}">${(''+train.id).padStart(5, '0')} (${train.name})</option>`
            });
        }
    };
    request.send();       
    modalInnerHTML +=`</select>
                        </div>
                    </div>
                    <div class="row--block" style="justify-content: flex-start;">
                        <div class="field--block">
                            <label for="req_callback">Дата и время отбытия</label>
                            <input type="text" name="start_time" id="start_time" placeholder="2021.12.01 00:00:00"/>
                        </div>
                    </div>
                    <button type="submit">Добавить</button>
                </form>
                <button class="close--button" type="button" onclick="close_form();"><svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M11.1751 9.99991L16.4251 4.75824C16.582 4.60132 16.6702 4.3885 16.6702 4.16658C16.6702 3.94466 16.582 3.73183 16.4251 3.57491C16.2682 3.41799 16.0554 3.32983 15.8334 3.32983C15.6115 3.32983 15.3987 3.41799 15.2418 3.57491L10.0001 8.82491L4.75845 3.57491C4.60153 3.41799 4.3887 3.32983 4.16678 3.32983C3.94486 3.32983 3.73203 3.41799 3.57511 3.57491C3.41819 3.73183 3.33004 3.94466 3.33004 4.16658C3.33004 4.3885 3.41819 4.60132 3.57511 4.75824L8.82511 9.99991L3.57511 15.2416C3.497 15.319 3.43501 15.4112 3.3927 15.5128C3.3504 15.6143 3.32861 15.7232 3.32861 15.8332C3.32861 15.9433 3.3504 16.0522 3.3927 16.1537C3.43501 16.2553 3.497 16.3474 3.57511 16.4249C3.65258 16.503 3.74475 16.565 3.8463 16.6073C3.94785 16.6496 4.05677 16.6714 4.16678 16.6714C4.27679 16.6714 4.38571 16.6496 4.48726 16.6073C4.58881 16.565 4.68098 16.503 4.75845 16.4249L10.0001 11.1749L15.2418 16.4249C15.3192 16.503 15.4114 16.565 15.513 16.6073C15.6145 16.6496 15.7234 16.6714 15.8334 16.6714C15.9435 16.6714 16.0524 16.6496 16.1539 16.6073C16.2555 16.565 16.3476 16.503 16.4251 16.4249C16.5032 16.3474 16.5652 16.2553 16.6075 16.1537C16.6498 16.0522 16.6716 15.9433 16.6716 15.8332C16.6716 15.7232 16.6498 15.6143 16.6075 15.5128C16.5652 15.4112 16.5032 15.319 16.4251 15.2416L11.1751 9.99991Z" fill="#ffffff80"/></svg></button>
            </div>
        </div>`;
    document.body.innerHTML += modalInnerHTML;
}

function trainForm(action) {
    document.body.innerHTML +=
        `<div class="background--block">
            <div class="form--block">
                <form class="add-trains--form" action="/administrative/${action}_train" method="POST">
                    <div class="title">Добавить поезд</div>
                    <div class="row--block">
                        <div class="field--block">
                            <label for="train_type">Тип поезда</label>
                            <select name="train_type" required>
                                <option value="1">Тип 1</option>
                                <option value="2">Тип 2</option>
                                <option value="3">Тип 3</option>
                                <option value="4">Тип 4</option>
                            </select>
                        </div>
                    </div>
                    <div class="row--block" style="justify-content: flex-start;">
                        <div class="field--block">
                            <label>Количество сидячих вагонов</label>
                            <input type="number" class="input-num" name="carriages[1]" min=0 max=15/>
                            <label>Количество плацкартных вагонов</label>
                            <input type="number" class="input-num" name="carriages[2]" min=0 max=15/>
                        </div>
                    </div>
                    <div class="row--block" style="justify-content: flex-start;">
                        <div class="field--block">
                            <label>Количество вагонов купе</label>
                            <input type="number" class="input-num" name="carriages[3]" min=0 max=15/>
                            <label>Количество вагонов "комфорт"</label>
                            <input type="number" class="input-num" name="carriages[4]" min=0 max=15/>
                        </div>
                    </div>
                    <button type="submit">Добавить</button>
                </form>
                <button class="close--button" type="button" onclick="close_form();"><svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M11.1751 9.99991L16.4251 4.75824C16.582 4.60132 16.6702 4.3885 16.6702 4.16658C16.6702 3.94466 16.582 3.73183 16.4251 3.57491C16.2682 3.41799 16.0554 3.32983 15.8334 3.32983C15.6115 3.32983 15.3987 3.41799 15.2418 3.57491L10.0001 8.82491L4.75845 3.57491C4.60153 3.41799 4.3887 3.32983 4.16678 3.32983C3.94486 3.32983 3.73203 3.41799 3.57511 3.57491C3.41819 3.73183 3.33004 3.94466 3.33004 4.16658C3.33004 4.3885 3.41819 4.60132 3.57511 4.75824L8.82511 9.99991L3.57511 15.2416C3.497 15.319 3.43501 15.4112 3.3927 15.5128C3.3504 15.6143 3.32861 15.7232 3.32861 15.8332C3.32861 15.9433 3.3504 16.0522 3.3927 16.1537C3.43501 16.2553 3.497 16.3474 3.57511 16.4249C3.65258 16.503 3.74475 16.565 3.8463 16.6073C3.94785 16.6496 4.05677 16.6714 4.16678 16.6714C4.27679 16.6714 4.38571 16.6496 4.48726 16.6073C4.58881 16.565 4.68098 16.503 4.75845 16.4249L10.0001 11.1749L15.2418 16.4249C15.3192 16.503 15.4114 16.565 15.513 16.6073C15.6145 16.6496 15.7234 16.6714 15.8334 16.6714C15.9435 16.6714 16.0524 16.6496 16.1539 16.6073C16.2555 16.565 16.3476 16.503 16.4251 16.4249C16.5032 16.3474 16.5652 16.2553 16.6075 16.1537C16.6498 16.0522 16.6716 15.9433 16.6716 15.8332C16.6716 15.7232 16.6498 15.6143 16.6075 15.5128C16.5652 15.4112 16.5032 15.319 16.4251 15.2416L11.1751 9.99991Z" fill="#ffffff80"/></svg></button>
            </div>
        </div>`;
}

function fieldIncrement(counter, increment) {
    let value = Number(document.getElementById(`count${counter}`).value.replace(" ваг.", ""));

    if (increment === true)
        value++;
    else
        if (value > 1) value--;

    document.getElementById('count').value = value + ' ваг.';
}
