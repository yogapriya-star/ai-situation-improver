async function generateSituation() {
  const input = document.getElementById("input").value;
  const outputDiv = document.getElementById("output");
  const resultText = document.getElementById("resultText");
  const textarea = document.getElementById("input");
  const errorText = document.getElementById("inputError"); // ✅ FIX
  textarea.addEventListener("input", function () {
    if (this.value.trim()) {
      errorText.classList.add("hidden");
      this.classList.remove("border-red-500");
    }
  });
  if (!input.trim()) {
    errorText.classList.remove("hidden");

    textarea.classList.add("border-red-500");
    textarea.classList.remove("focus:ring-blue-400");

    return;
  } else {
    errorText.classList.add("hidden");

    textarea.classList.remove("border-red-500");
    textarea.classList.add("focus:ring-blue-400");
  }

  // 🔄 Premium loading popup
  Swal.fire({
    title: "Generating...",
    text: "AI is improving your situation ✨",
    allowOutsideClick: false,
    didOpen: () => {
      Swal.showLoading();
    },
  });

  try {
    const res = await fetch("api/generate.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify({ input }),
    });

    const data = await res.json();

    Swal.close();

    if (data.success) {
      // ✨ Format output
      const formatted = formatOutput(data.output);

      resultText.innerHTML = formatted;
      outputDiv.classList.remove("hidden");

      Swal.fire({
        icon: "success",
        title: "Done!",
        text: "Your improved situation is ready 🚀",
        timer: 1200,
        showConfirmButton: false,
      });
    } else {
      Swal.fire({
        icon: "error",
        title: "Error",
        text: data.error || "Something went wrong",
      });
    }
  } catch (err) {
    Swal.close();

    Swal.fire({
      icon: "error",
      title: "Server Error",
      text: "Unable to connect. Try again.",
    });
  }
}
function formatOutput(text) {
  let paragraph = "";
  let points = [];

  // Normalize
  text = text.replace(/\r/g, "").trim();

  // Split by Key Points
  let parts = text.split(/Key Points:/i);

  if (parts.length > 1) {
    paragraph = parts[0].trim();

    points = parts[1]
      .split("\n")
      .map((line) => {
        return line
          .replace(/^[-•*]/, "") // remove bullets
          .replace(/\*\*/g, "") // remove bold **
          .replace(/^[0-9]+\./, "") // remove numbered list
          .replace(/:$/, "") // remove ending :
          .trim();
      })
      .filter(
        (line) =>
          line.length > 5 && // remove short junk
          !line.toLowerCase().includes("here"), // remove junk lines
      );
  } else {
    // fallback
    const lines = text.split("\n").filter((l) => l.trim());

    paragraph = lines[0];

    points = lines.slice(1).map((line) =>
      line
        .replace(/^[-•*]/, "")
        .replace(/\*\*/g, "")
        .trim(),
    );
  }

  // Clean paragraph
  paragraph = paragraph
    .replace(/Here is.*?:/i, "")
    .replace(/Here are.*?:/i, "")
    .trim();

  // Build UI
  let html = `
    <div class="mb-4">
        <p class="text-gray-700 leading-relaxed">${paragraph}</p>
    </div>
  `;

  if (points.length) {
    html += `
      <div class="mt-4">
        <h4 class="font-semibold text-gray-800 mb-2">Key Points:</h4>
        <ul class="list-disc pl-5 space-y-2 text-gray-700">
    `;

    points.slice(0, 3).forEach((p) => {
      html += `<li>${p}</li>`;
    });

    html += `</ul></div>`;
  }

  return html;
}
function copyText() {
  const text = document.getElementById("resultText").innerText;
  const btn = document.getElementById("copyBtn");
  const icon = document.getElementById("copyIcon");
  const label = document.getElementById("copyLabel");

  // ✅ Fallback method (works everywhere)
  const temp = document.createElement("textarea");
  temp.value = text;
  document.body.appendChild(temp);
  temp.select();
  document.execCommand("copy");
  document.body.removeChild(temp);

  // ✅ UI feedback
  btn.classList.remove("bg-gray-100");
  btn.classList.add("bg-green-500", "text-white");

  icon.innerText = "✅";
  label.innerText = "Copied";
  btn.title = "Copied";

  Swal.fire({
    toast: true,
    position: "top-end",
    icon: "success",
    title: "Copied!",
    showConfirmButton: false,
    timer: 1000,
  });

  setTimeout(() => {
    btn.classList.remove("bg-green-500", "text-white");
    btn.classList.add("bg-gray-100");

    icon.innerText = "📋";
    label.innerText = "Copy";
    btn.title = "Copy";
  }, 3000);
}
