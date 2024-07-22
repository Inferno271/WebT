function validateForm(event) {
  event.preventDefault(); // Предотвращаем отправку формы по умолчанию

  // Получаем значения полей формы
  const name = document.getElementById('name').value.trim();
  const gender = document.querySelector('input[name="gender"]:checked');
  const email = document.getElementById('email').value.trim();
  const phone = document.getElementById('phone').value.trim();
  const comment = document.getElementById('comment').value.trim();

  // Создаем экземпляр класса FormValidation
  const validator = new FormValidation();

  // Задаем правила валидации для каждого поля
  validator.setRule('name', 'isNotEmpty');
  validator.setRule('gender', 'isNotEmpty');
  validator.setRule('email', 'isNotEmpty');
  validator.setRule('email', 'isEmail');
  validator.setRule('phone', 'isNotEmpty');
  validator.setRule('phone', 'isPhone');
  validator.setRule('comment', 'isNotEmpty');

  // Передаем значения полей в метод валидации
  validator.validate({
    name: name,
    gender: gender ? gender.value : '', // Если пол не выбран, передаем пустую строку
    email: email,
    phone: phone,
    comment: comment
  });

  // Получаем массив ошибок из объекта FormValidation
  const errors = validator.getErrors();

  // Если есть ошибки, отображаем их
  if (errors.length > 0) {
    // Удаляем предыдущие сообщения об ошибках
    const existingErrorContainer = document.getElementById('error-container');
    if (existingErrorContainer) {
      existingErrorContainer.remove();
    }

    // Создаем контейнер для ошибок
    const errorContainer = document.createElement('ul');
    errorContainer.id = 'error-container'; // Присваиваем контейнеру идентификатор

    errors.forEach((error) => {
      const errorItem = document.createElement('li');
      errorItem.textContent = error;
      errorContainer.appendChild(errorItem);
    });

    // Вставляем контейнер с ошибками перед формой
    const form = document.getElementById('contact-form');
    form.parentNode.insertBefore(errorContainer, form);

    // Подсвечиваем поля с ошибками их выделяя красным цветом
    const errorFields = document.querySelectorAll('#contact-form input:invalid, #contact-form textarea:invalid');
    errorFields.forEach((field) => {
      field.classList.add('error');
    });
  } else {
    // Если ошибок нет, можно отправить форму
    document.getElementById('contact-form').submit();
  }
}
