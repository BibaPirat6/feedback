document.addEventListener("DOMContentLoaded", () => {
  const fioInp = document.getElementById("fio")
  const emailInp = document.getElementById("email")
  const messagelInp = document.getElementById("message")
  const errFio = document.getElementById("error-fio")
  const errEmail = document.getElementById("error-email")
  const errMessage = document.getElementById("error-message")
  let isValid = true

  fioInp.addEventListener("input", () => {
    if (fioInp.value.trim().length < 3 || fioInp.value.trim().length > 50) {
      errFio.textContent = "Введите ФИО от 3 до 50 символов символов";
      errFio.classList.remove("disabled");
      fioInp.classList.remove("input-valid");
      fioInp.classList.add("input-invalid");
      isValid = false;
    } else {
      errFio.classList.add("disabled");
      fioInp.classList.remove("input-invalid");
      fioInp.classList.add("input-valid");
      isValid = true;
    }
  });


  emailInp.addEventListener("input", () => {
    const emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-z]{2,}$/i;

    if (!emailPattern.test(emailInp.value.trim())) {
      errEmail.textContent = "Введите e-mail в виде example@gmail.com";
      errEmail.classList.remove("disabled");
      emailInp.classList.remove("input-valid");
      emailInp.classList.add("input-invalid");
      isValid = false;
    } else {
      errEmail.classList.add("disabled");
      emailInp.classList.remove("input-invalid");
      emailInp.classList.add("input-valid");
      isValid = true;
    }
  })

  messagelInp.addEventListener("input", () => {
    if (messagelInp.value.trim().length < 10 || messagelInp.value.trim().length > 200) {
      errMessage.textContent = "Сообщение должно быть от 10 до 200 символов"
      errMessage.classList.remove("disabled")
      messagelInp.classList.remove("input-valid");
      messagelInp.classList.add("input-invalid");
      isValid = false
    } else {
      errMessage.classList.add("disabled")
      messagelInp.classList.remove("input-invalid");
      messagelInp.classList.add("input-valid");
      isValid = true
    }
  })

  const form = document.getElementById('form');

  form.addEventListener('submit', async (e) => {
    e.preventDefault();

    const fio = form.fio.value;
    const email = form.email.value;
    const message = form.message.value;

    const response = await fetch('feedback.php', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify({ fio, email, message }),
    });

    const result = await response.json();

    if (result.success) {
      alert(result.message);
      fioInp.value = ""
      emailInp.value = ""
      messagelInp.value = ""
    } else {
      alert(result.message);
    }
  });

  async function loadMessages() {
    try {
      const response = await fetch('getMessage.php');
      if (!response.ok) throw new Error('Ошибка загрузки');

      const messages = await response.json();
      renderMessages(messages);
    } catch (err) {
      console.error(err);
    }
  }

  function renderMessages(messages) {
    const container = document.getElementById('messages');
    container.innerHTML = '';

    messages.forEach(msg => {
      const item = document.createElement('div');
      item.className = 'message';
      item.innerHTML = `
      <strong>${msg.fio}</strong> (${msg.email})<br>
      ${msg.message}<br>
    `;
      container.appendChild(item);
    });
  }

  loadMessages();
  setInterval(loadMessages, 5000);
});
