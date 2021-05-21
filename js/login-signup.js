function login() {
    // document.body.style.overflow = 'hidden';

    document.body.innerHTML +=
        '<div class="background--block">' +
            '<div class="form--block">' +
                '<form class="login--form" action="" method="POST" novalidate autocomplete="off">' +
                    '<div class="title">Вход</div>' +
                    '<div class="field--block">' +
                        '<label for="email">Email</label>' +
                        '<input name="email" type="email" placeholder="Email" required/>' +
                    '</div>' +
                    '<div class="field--block">' +
                        '<label for="password">Пароль</label>' +
                        '<input name="password" type="password" placeholder="Пароль" required/>' +
                    '</div>' +
                    '<button type="submit">Войти</button>' +
                    '<div class="another-form--link">Еще нет аккаунта?<br><a onclick="close_form(); setTimeout(()=>{signup()},300);">Зарегистироваться</a></div>' +
                '</form>' +
                '<button class="close--button" type="button" onclick="close_form();"><svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M11.1751 9.99991L16.4251 4.75824C16.582 4.60132 16.6702 4.3885 16.6702 4.16658C16.6702 3.94466 16.582 3.73183 16.4251 3.57491C16.2682 3.41799 16.0554 3.32983 15.8334 3.32983C15.6115 3.32983 15.3987 3.41799 15.2418 3.57491L10.0001 8.82491L4.75845 3.57491C4.60153 3.41799 4.3887 3.32983 4.16678 3.32983C3.94486 3.32983 3.73203 3.41799 3.57511 3.57491C3.41819 3.73183 3.33004 3.94466 3.33004 4.16658C3.33004 4.3885 3.41819 4.60132 3.57511 4.75824L8.82511 9.99991L3.57511 15.2416C3.497 15.319 3.43501 15.4112 3.3927 15.5128C3.3504 15.6143 3.32861 15.7232 3.32861 15.8332C3.32861 15.9433 3.3504 16.0522 3.3927 16.1537C3.43501 16.2553 3.497 16.3474 3.57511 16.4249C3.65258 16.503 3.74475 16.565 3.8463 16.6073C3.94785 16.6496 4.05677 16.6714 4.16678 16.6714C4.27679 16.6714 4.38571 16.6496 4.48726 16.6073C4.58881 16.565 4.68098 16.503 4.75845 16.4249L10.0001 11.1749L15.2418 16.4249C15.3192 16.503 15.4114 16.565 15.513 16.6073C15.6145 16.6496 15.7234 16.6714 15.8334 16.6714C15.9435 16.6714 16.0524 16.6496 16.1539 16.6073C16.2555 16.565 16.3476 16.503 16.4251 16.4249C16.5032 16.3474 16.5652 16.2553 16.6075 16.1537C16.6498 16.0522 16.6716 15.9433 16.6716 15.8332C16.6716 15.7232 16.6498 15.6143 16.6075 15.5128C16.5652 15.4112 16.5032 15.319 16.4251 15.2416L11.1751 9.99991Z" fill="#ffffff80"/></svg></button>' +
            '</div>' +
        '</div>';
}

function signup() {
    // document.body.style.overflow = 'hidden';

    document.body.innerHTML +=
        '<div class="background--block">' +
            '<div class="form--block">' +
                '<form class="signup--form" action="" method="POST" novalidate autocomplete="off">' +
                    '<div class="title">Регистрация</div>' +
                    '<div class="row--block">' +
                        '<div class="field--block">' +
                            '<label for="surname">Фамилия</label>' +
                            '<input name="surname" type="text" placeholder="Фамилия" required/>' +
                        '</div>' +
                        '<div class="field--block">' +
                            '<label for="name">Имя</label>' +
                            '<input name="name" type="text" placeholder="Имя" required/>' +
                        '</div>' +
                        '<div class="field--block">' +
                            '<label for="patronymic">Отчество</label>' +
                            '<input name="patronymic" type="text" placeholder="Отчество" required/>' +
                        '</div>' +
                    '</div>' +
                    '<div class="row--block" style="justify-content: flex-start;">' +
                        '<div class="field--block">' +
                            '<label for="email">Email</label>' +
                            '<input name="email" type="email" placeholder="Email" required/>' +
                        '</div>' +
                        '<div class="field--block">' +
                            '<label for="phone">Номер телефона</label>' +
                            '<input name="phone" type="text" placeholder="+7 (___) ___-__-__" required/>' +
                        '</div>' +
                    '</div>' +
                    '<div class="row--block">' +
                        '<div class="field--block">' +
                            '<label for="password">Пароль</label>' +
                            '<input name="password" type="password" placeholder="Пароль" required/>' +
                        '</div>' +
                        '<div class="field--block">' +
                            '<label for="password">Подтвердите пароль</label>' +
                            '<input name="password-repeat" type="password" placeholder="Повторите пароль" required/>' +
                        '</div>' +
                        '<div style="display: flex; align-items: flex-end; width: 250px; padding: 15px 0 16px; font-size: 13px; font-family: rubik-light; color: #00000080;">Пароль должен содержать<br>от 8 до 20 символов</div>' +
                    '</div>' +
                    '<button type="submit">Зарегистрироваться</button>' +
                    '<div class="another-form--link">Уже есть аккаунт?<br><a onclick="close_form(); setTimeout(()=>{login()}, 300);">Войти</a></div>' +
                '</form>' +
                '<button class="close--button" type="button" onclick="close_form();"><svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M11.1751 9.99991L16.4251 4.75824C16.582 4.60132 16.6702 4.3885 16.6702 4.16658C16.6702 3.94466 16.582 3.73183 16.4251 3.57491C16.2682 3.41799 16.0554 3.32983 15.8334 3.32983C15.6115 3.32983 15.3987 3.41799 15.2418 3.57491L10.0001 8.82491L4.75845 3.57491C4.60153 3.41799 4.3887 3.32983 4.16678 3.32983C3.94486 3.32983 3.73203 3.41799 3.57511 3.57491C3.41819 3.73183 3.33004 3.94466 3.33004 4.16658C3.33004 4.3885 3.41819 4.60132 3.57511 4.75824L8.82511 9.99991L3.57511 15.2416C3.497 15.319 3.43501 15.4112 3.3927 15.5128C3.3504 15.6143 3.32861 15.7232 3.32861 15.8332C3.32861 15.9433 3.3504 16.0522 3.3927 16.1537C3.43501 16.2553 3.497 16.3474 3.57511 16.4249C3.65258 16.503 3.74475 16.565 3.8463 16.6073C3.94785 16.6496 4.05677 16.6714 4.16678 16.6714C4.27679 16.6714 4.38571 16.6496 4.48726 16.6073C4.58881 16.565 4.68098 16.503 4.75845 16.4249L10.0001 11.1749L15.2418 16.4249C15.3192 16.503 15.4114 16.565 15.513 16.6073C15.6145 16.6496 15.7234 16.6714 15.8334 16.6714C15.9435 16.6714 16.0524 16.6496 16.1539 16.6073C16.2555 16.565 16.3476 16.503 16.4251 16.4249C16.5032 16.3474 16.5652 16.2553 16.6075 16.1537C16.6498 16.0522 16.6716 15.9433 16.6716 15.8332C16.6716 15.7232 16.6498 15.6143 16.6075 15.5128C16.5652 15.4112 16.5032 15.319 16.4251 15.2416L11.1751 9.99991Z" fill="#ffffff80"/></svg></button>' +
            '</div>' +
        '</div>';
}

function close_form() {
    // document.body.style.overflow = 'visible';
    document.querySelector('.background--block').style.opacity = 0;
    document.querySelector('.background--block form').style.opacity = 0;
    setTimeout( () => {
        document.querySelector('.background--block').remove();
    }, 300);
}