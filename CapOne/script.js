const form = document.querySelector("#messageForm").value;
function sendMessage(event) {
  event.preventDefault();

  const apikey = document.querySelector("#apiKey").value;
  const number = document.querySelector("#number").value;
  const message = document.querySelector("#message").value;

  const parameters = {
    apikey,
    number,
    message,
  };

  fetch("https://api.semaphore.co/api/v4/messages", {
    method: "POST",
    headers: {
      "Content-Type": "application/x-www-form-urlencoded",
    },
    body: new URLSearchParams(parameters),
  })
    .then((response) => response.text())
    .then((output) => {
      console.log(output);
    })
    .catch((error) => {
      console.error("Error:", error);
    });
  form.reset();
}

form.addEventListener("submit", sendMessage);
