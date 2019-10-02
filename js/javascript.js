$(document).ready(
    function() {
    var clickButtonForm=$(".clickButtonForm");
        clickButtonForm.submit(function(){ //функция , которая работает после срабатывания кнопка
            event.preventDefault();
            var inputLoginValue = $("#login");
            var inputPasswordValue = $("#password");
            var inputConfirmPasswordValue = $("#confirmPassword"); //помещаем в переменные
            var inputEmailValue = $("#email");
            var inputNameValue = $("#name");
            if(inputLoginValue.val() == "" || inputPasswordValue.val() == "" || inputConfirmPasswordValue.val() == "" || inputEmailValue.val() == "" || inputNameValue.val() == ""){
                $("#error").text("Вы не заполненли все поля").renoveClass("success").addClass("error").show().delay(5000).fadeOut(500);
            }
            else{
                $.ajax({
                    url: "registration.php",
                    type: "POST",
                    data: {login: inputLoginValue.val(),password: inputPasswordValue.val(),confirmPassword: inputConfirmPasswordValue.val(),email: inputEmailValue.val(),name: inputNameValue.val()}

                    success: function(data) {
                        if(data == 0) {
                            $("#error").text("вы успешно зарегистрировались").renaveClass("error").addClass("success").show().delay(5000).fadeOut(500);
                        }
                        if(data == email_busy){
                            $("#error").text("Пользователь с таким email-ом уже зарегистрирован(").renoveClass("success").addClass("error").show().delay(5000).fadeOut(500);
                        }
                        if(data == login_busy){
                            $("#error").text("Пользователь с таким login-ом уже зарегистрирован(").renoveClass("success").addClass("error").show().delay(5000).fadeOut(500);
                        }
                        if(data == passwords_do_not_match){
                            $("#error").text("Пароли не совпадают .").renoveClass("success").addClass("error").show().delay(5000).fadeOut(500);
                        }
                    }
                })
            }
        });
    });