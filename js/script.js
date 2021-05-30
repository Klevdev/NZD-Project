function close_form() {
    // document.body.style.overflow = 'visible';
    let bg = document.querySelector('.background--block');
    let form = document.querySelector('.background--block form');
    if (bg === null || form === null) return;
    bg.style.opacity = 0;
    form.style.opacity = 0;
    setTimeout( () => {
        document.querySelector('.background--block').remove();
    }, 300);
}

function comment_train(id) {
    // document.body.style.overflow = 'hidden';

    document.body.innerHTML +=
        `<div class="background--block">
            <div class="form--block">
                <form class="login--form" action="/trains/comments?id=` + id + `" method="POST" novalidate autocomplete="off">
                    <div class="title">Оставить комментарий</div>
                    <div class="field--block" style="width: 100%;">
                        <label for="rating">Рейтинг</label>
                        <div class="rating-area">
                            <input type="radio" id="star-5" name="rating" value="5">
                            <label for="star-5" title="Оценка «5»"></label>
                            <input type="radio" id="star-4" name="rating" value="4">
                            <label for="star-4" title="Оценка «4»"></label>    
                            <input type="radio" id="star-3" name="rating" value="3">
                            <label for="star-3" title="Оценка «3»"></label>  
                            <input type="radio" id="star-2" name="rating" value="2">
                            <label for="star-2" title="Оценка «2»"></label>    
                            <input type="radio" id="star-1" name="rating" value="1" checked>
                            <label for="star-1" title="Оценка «1»"></label>
                        </div>
                    </div>
                    <div class="field--block">
                        <label for="comment">Комментарий</label>
                        <textarea name="comment" placeholder="Комментарий" required></textarea>
                    </div>
                    <input type="hidden" name="id_train" value="` + id + `">
                    <button type="submit">Отправить</button>
                </form>
                <button class="close--button" type="button" onclick="close_form();"><svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M11.1751 9.99991L16.4251 4.75824C16.582 4.60132 16.6702 4.3885 16.6702 4.16658C16.6702 3.94466 16.582 3.73183 16.4251 3.57491C16.2682 3.41799 16.0554 3.32983 15.8334 3.32983C15.6115 3.32983 15.3987 3.41799 15.2418 3.57491L10.0001 8.82491L4.75845 3.57491C4.60153 3.41799 4.3887 3.32983 4.16678 3.32983C3.94486 3.32983 3.73203 3.41799 3.57511 3.57491C3.41819 3.73183 3.33004 3.94466 3.33004 4.16658C3.33004 4.3885 3.41819 4.60132 3.57511 4.75824L8.82511 9.99991L3.57511 15.2416C3.497 15.319 3.43501 15.4112 3.3927 15.5128C3.3504 15.6143 3.32861 15.7232 3.32861 15.8332C3.32861 15.9433 3.3504 16.0522 3.3927 16.1537C3.43501 16.2553 3.497 16.3474 3.57511 16.4249C3.65258 16.503 3.74475 16.565 3.8463 16.6073C3.94785 16.6496 4.05677 16.6714 4.16678 16.6714C4.27679 16.6714 4.38571 16.6496 4.48726 16.6073C4.58881 16.565 4.68098 16.503 4.75845 16.4249L10.0001 11.1749L15.2418 16.4249C15.3192 16.503 15.4114 16.565 15.513 16.6073C15.6145 16.6496 15.7234 16.6714 15.8334 16.6714C15.9435 16.6714 16.0524 16.6496 16.1539 16.6073C16.2555 16.565 16.3476 16.503 16.4251 16.4249C16.5032 16.3474 16.5652 16.2553 16.6075 16.1537C16.6498 16.0522 16.6716 15.9433 16.6716 15.8332C16.6716 15.7232 16.6498 15.6143 16.6075 15.5128C16.5652 15.4112 16.5032 15.319 16.4251 15.2416L11.1751 9.99991Z" fill="#ffffff80"/></svg></button>
            </div>
        </div>`;
}

function sendMessageForm() {
    document.body.innerHTML +=
        `<div class="background--block">
            <div class="form--block">
                <form class="" action="" method="POST" onsubmit="event.preventDefault();validate(this, actuallySendTheMessage);">
                    <div class="title">Оставить сообщение</div>
                    <div class="row--block">
                        <div class="field--block" style="margin-right: 30px">
                            <label for="name">Ваше имя</label>
                            <input type="text" name="name" id="name" placeholder="Б. Ю. Александров"/>
                        </div>
                        <div class="field--block">
                            <label for="email">E-mail</label>
                            <input type="text" name="email" id="email" placeholder="example@email.com"/>
                        </div>
                    </div>
                    <div class="row--block" style="justify-content: flex-start;">
                        <div class="field--block" style="margin-right: 30px">
                            <label for="phone">Телефон</label>
                            <input type="text" name="phone" id="phone" placeholder="+79001234567" oninput="switchCallbackTimeInput()"/>
                            <div class="field--block" style="padding-top: 20px; display:flex; align-items: center; ">
                                <input type="checkbox" name="req_callback" id="req_callback" style="margin-right: 10px" onchange="switchCallbackTimeInput()"/>
                                <label for="req_callback" style="font-size: 1rem; position: relative; top: 2px;">Перезвоните мне</label>
                            </div>
                        </div>
                        <div class="field--block">
                            <label for="req_callback">Время для звонка</label>
                            <input type="text" name="callback_time" id="callback_time" placeholder="14:00" disabled/>
                        </div>
                    </div>
                    <div class="row--block" style="justify-content: flex-start;">
                        <div class="field--block">
                            <label for="text">Ваше сообщение</label>
                            <textarea name="text" id="text" placeholder="Сообщение до 250 символов"></textarea>
                        </div>
                    </div>
                    <button type="submit">Отправить</button>
                </form>
                <button class="close--button" type="button" onclick="close_form();"><svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M11.1751 9.99991L16.4251 4.75824C16.582 4.60132 16.6702 4.3885 16.6702 4.16658C16.6702 3.94466 16.582 3.73183 16.4251 3.57491C16.2682 3.41799 16.0554 3.32983 15.8334 3.32983C15.6115 3.32983 15.3987 3.41799 15.2418 3.57491L10.0001 8.82491L4.75845 3.57491C4.60153 3.41799 4.3887 3.32983 4.16678 3.32983C3.94486 3.32983 3.73203 3.41799 3.57511 3.57491C3.41819 3.73183 3.33004 3.94466 3.33004 4.16658C3.33004 4.3885 3.41819 4.60132 3.57511 4.75824L8.82511 9.99991L3.57511 15.2416C3.497 15.319 3.43501 15.4112 3.3927 15.5128C3.3504 15.6143 3.32861 15.7232 3.32861 15.8332C3.32861 15.9433 3.3504 16.0522 3.3927 16.1537C3.43501 16.2553 3.497 16.3474 3.57511 16.4249C3.65258 16.503 3.74475 16.565 3.8463 16.6073C3.94785 16.6496 4.05677 16.6714 4.16678 16.6714C4.27679 16.6714 4.38571 16.6496 4.48726 16.6073C4.58881 16.565 4.68098 16.503 4.75845 16.4249L10.0001 11.1749L15.2418 16.4249C15.3192 16.503 15.4114 16.565 15.513 16.6073C15.6145 16.6496 15.7234 16.6714 15.8334 16.6714C15.9435 16.6714 16.0524 16.6496 16.1539 16.6073C16.2555 16.565 16.3476 16.503 16.4251 16.4249C16.5032 16.3474 16.5652 16.2553 16.6075 16.1537C16.6498 16.0522 16.6716 15.9433 16.6716 15.8332C16.6716 15.7232 16.6498 15.6143 16.6075 15.5128C16.5652 15.4112 16.5032 15.319 16.4251 15.2416L11.1751 9.99991Z" fill="#ffffff80"/></svg></button>
            </div>
        </div>`;
}

function switchCallbackTimeInput() {
    let input = document.getElementById('callback_time');
    if (document.getElementById('req_callback').checked && document.getElementById('phone').value) {
        input.disabled = false;
    } else {
        input.disabled = true;
    }
}

function validate(form, submitFunction=false) {
    let params = gatherFormValues(form);

    let request = new XMLHttpRequest();

    let requestPath = `/validate/post`;
    request.open('POST', requestPath, true);
    request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    request.onload = () => {
        if (request.status !== 200) {
            customAlert('Техническая ошибка', 'Попробуйте позже');
            console.error(request.responseText);
            return;
        }
        if (request.responseText !== 'OK') {
            let errors = JSON.parse(request.responseText);
            for(let field in errors) {
                let errorPopup = document.createElement('div');
                errorPopup.className = 'error-popup';
                errorPopup.innerText = errors[field];
                document.querySelector(`*[name="${field}"]`).after(errorPopup);
                setTimeout(() => {
                    errorPopup.style.opacity = 1;
                }, 200);
                setTimeout(() => {
                    errorPopup.style.opacity = 0;
                }, 4800);
                setTimeout(() => {
                    errorPopup.remove();
                }, 5000);
            }
            return;
        }
        if (submitFunction) {
            submitFunction(params);
            return;
        }
        form.submit();
    };
    request.send(params);
}

function actuallySendTheMessage(params) {
    let request = new XMLHttpRequest();

    let requestPath = `/feedback/send_message`;
    request.open('POST', requestPath, true);
    request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    request.onload = () => {
        if (request.status !== 200) {
            customAlert('Техническая ошибка', 'Попробуйте позже');
            console.error(request.responseText);
            return;
        }
        if (request.responseText !== 'OK') {
            customAlert('Произошла ошибка', "<pre>"+request.responseText+"</pre>");
            return;
        }
        customAlert('Сообщение отправлено', 'Мы обязательно прочтём ваше сообщение и перезвоним');
        return;
    };
    request.send(params);
}

function customAlert(title, message="") {
    close_form();
    setTimeout( () => {
        document.body.innerHTML +=
            `<div class="background--block">
                <div class="form--block">
                    <form>
                        <div class="title">${title}</div>
                        <div style="font-family: montserrat-regular;">${message}</div>
                    </form>        
                <button class="close--button" type="button" onclick="close_form();"><svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M11.1751 9.99991L16.4251 4.75824C16.582 4.60132 16.6702 4.3885 16.6702 4.16658C16.6702 3.94466 16.582 3.73183 16.4251 3.57491C16.2682 3.41799 16.0554 3.32983 15.8334 3.32983C15.6115 3.32983 15.3987 3.41799 15.2418 3.57491L10.0001 8.82491L4.75845 3.57491C4.60153 3.41799 4.3887 3.32983 4.16678 3.32983C3.94486 3.32983 3.73203 3.41799 3.57511 3.57491C3.41819 3.73183 3.33004 3.94466 3.33004 4.16658C3.33004 4.3885 3.41819 4.60132 3.57511 4.75824L8.82511 9.99991L3.57511 15.2416C3.497 15.319 3.43501 15.4112 3.3927 15.5128C3.3504 15.6143 3.32861 15.7232 3.32861 15.8332C3.32861 15.9433 3.3504 16.0522 3.3927 16.1537C3.43501 16.2553 3.497 16.3474 3.57511 16.4249C3.65258 16.503 3.74475 16.565 3.8463 16.6073C3.94785 16.6496 4.05677 16.6714 4.16678 16.6714C4.27679 16.6714 4.38571 16.6496 4.48726 16.6073C4.58881 16.565 4.68098 16.503 4.75845 16.4249L10.0001 11.1749L15.2418 16.4249C15.3192 16.503 15.4114 16.565 15.513 16.6073C15.6145 16.6496 15.7234 16.6714 15.8334 16.6714C15.9435 16.6714 16.0524 16.6496 16.1539 16.6073C16.2555 16.565 16.3476 16.503 16.4251 16.4249C16.5032 16.3474 16.5652 16.2553 16.6075 16.1537C16.6498 16.0522 16.6716 15.9433 16.6716 15.8332C16.6716 15.7232 16.6498 15.6143 16.6075 15.5128C16.5652 15.4112 16.5032 15.319 16.4251 15.2416L11.1751 9.99991Z" fill="#ffffff80"/></svg></button>
                </div>
            </div>`;
    }, 300);
}

function customPrompt(title, message, primaryLink, secondaryLink, primaryLinkText, secondaryLinkText) {
    close_form();
    setTimeout( () => {
        document.body.innerHTML +=
            `<div class="background--block">
                <div class="form--block">
                    <form>
                        <div class="title">${title}</div>
                        <div style="font-family: montserrat-regular;">${message}</div>
                        <div style="display: flex;">
                            <a href="${primaryLink}" style="margin-right: 25px">${primaryLinkText}</a>
                            <a href="${secondaryLink}">${secondaryLinkText}</a>
                        </div>        
                    </form>
                <button class="close--button" type="button" onclick="close_form();"><svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M11.1751 9.99991L16.4251 4.75824C16.582 4.60132 16.6702 4.3885 16.6702 4.16658C16.6702 3.94466 16.582 3.73183 16.4251 3.57491C16.2682 3.41799 16.0554 3.32983 15.8334 3.32983C15.6115 3.32983 15.3987 3.41799 15.2418 3.57491L10.0001 8.82491L4.75845 3.57491C4.60153 3.41799 4.3887 3.32983 4.16678 3.32983C3.94486 3.32983 3.73203 3.41799 3.57511 3.57491C3.41819 3.73183 3.33004 3.94466 3.33004 4.16658C3.33004 4.3885 3.41819 4.60132 3.57511 4.75824L8.82511 9.99991L3.57511 15.2416C3.497 15.319 3.43501 15.4112 3.3927 15.5128C3.3504 15.6143 3.32861 15.7232 3.32861 15.8332C3.32861 15.9433 3.3504 16.0522 3.3927 16.1537C3.43501 16.2553 3.497 16.3474 3.57511 16.4249C3.65258 16.503 3.74475 16.565 3.8463 16.6073C3.94785 16.6496 4.05677 16.6714 4.16678 16.6714C4.27679 16.6714 4.38571 16.6496 4.48726 16.6073C4.58881 16.565 4.68098 16.503 4.75845 16.4249L10.0001 11.1749L15.2418 16.4249C15.3192 16.503 15.4114 16.565 15.513 16.6073C15.6145 16.6496 15.7234 16.6714 15.8334 16.6714C15.9435 16.6714 16.0524 16.6496 16.1539 16.6073C16.2555 16.565 16.3476 16.503 16.4251 16.4249C16.5032 16.3474 16.5652 16.2553 16.6075 16.1537C16.6498 16.0522 16.6716 15.9433 16.6716 15.8332C16.6716 15.7232 16.6498 15.6143 16.6075 15.5128C16.5652 15.4112 16.5032 15.319 16.4251 15.2416L11.1751 9.99991Z" fill="#ffffff80"/></svg></button>
                </div>
            </div>`;
    }, 300);
}

function gatherFormValues(form) {
    let valuesString = '';
    let inputs = form.querySelectorAll("input[name], textarea");
    inputs.forEach(input => {
        if (!input.disabled) {
            valuesString += `${input.name}=`;
            if (input.type == 'checkbox')
                valuesString += `${input.checked}&`;
            else
                valuesString += `${input.value}&`;
        }
    });
    valuesString = valuesString.slice(0, -1);
    console.log(valuesString);
    
    return valuesString;
}

function popup_menu() {

}