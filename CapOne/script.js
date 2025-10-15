document.addEventListener("DOMContentLoaded", function () {
  const form = document.querySelector("#messageForm");
  if (!form) return;

  function sendMessage(event) {
    event.preventDefault();

    const apiKeyEl = document.querySelector("#apiKey");
    let apikey = apiKeyEl ? apiKeyEl.value.trim() : "";
    if (!apikey) {
      try {
        const saved = localStorage.getItem("semaphore_api_key");
        if (saved) apikey = saved;
      } catch (_) {}
    }
    if (!apikey) {
      const result = document.getElementById("result");
      if (result) {
        result.style.display = "block";
        result.className = "alert alert-warning";
        result.textContent =
          "Missing API key. Please enable remembering the key previously or re-add the field.";
      }
      return;
    }
    const number = document.querySelector("#number").value.trim();
    const message = document.querySelector("#message").value.trim();

    const parameters = { apikey, number, message };

    fetch("send_sms.php", {
      method: "POST",
      headers: { "Content-Type": "application/x-www-form-urlencoded" },
      body: new URLSearchParams(parameters),
    })
      .then((response) => response.json())
      .then((output) => {
        const result = document.getElementById("result");
        if (!result) return;

        const markSuccess = (msg) => {
          result.style.display = "block";
          result.className = "alert alert-success";
          result.textContent = msg || "Sent message successfully";
          setTimeout(() => {
            result.style.display = "none";
          }, 2500);
        };
        const markError = (msg) => {
          result.style.display = "block";
          result.className = "alert alert-danger";
          result.textContent = msg || "Failed to send message.";
        };

        if (Array.isArray(output) && output[0]) {
          const status = String(output[0].status || "").toLowerCase();
          if (
            status === "queued" ||
            status === "pending" ||
            status === "success"
          ) {
            markSuccess("Sent message successfully");
            return;
          }
        }

        if (output && output.error) {
          const msg =
            typeof output.error === "string"
              ? output.error
              : output.error.message || "Failed to send message.";
          markError(msg);
          return;
        }

        markSuccess("Sent message successfully");
      })
      .catch((error) => {
        const result = document.getElementById("result");
        if (result) {
          result.style.display = "block";
          result.className = "alert alert-danger";
          result.textContent = "Network error: " + error;
        }
        console.error("Error:", error);
      })
      .finally(() => {
        form.reset();
        const charCount = document.getElementById("charCount");
        if (charCount) charCount.textContent = "0";
      });
  }

  form.addEventListener("submit", sendMessage);
});
