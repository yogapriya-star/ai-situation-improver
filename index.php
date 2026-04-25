<?php include("includes/header.php"); ?>

  <!-- HEADER -->
  <div class="text-center mb-4">
    <h2 class="text-3xl font-bold text-gray-800">
      ✨ AI Situation Improver
    </h2>
    <p class="text-gray-500 text-sm mt-1">
      Transform your raw situation into a professional summary with key insights.
    </p>
  </div>

  <!-- INPUT SECTION -->
  <div class="flex flex-col gap-4">

    <textarea id="input"
      class="w-full p-4 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none transition"
      rows="4"
      placeholder="Enter 1-2 line situation..."></textarea>

    <p id="inputError" class="text-red-500 text-sm hidden text-left">
      Please enter a situation
    </p>

    <button onclick="generateSituation()"
      class="w-full bg-gradient-to-r from-blue-500 to-indigo-600 text-white py-3 rounded-lg font-semibold hover:scale-[1.02] transition-all shadow-md">
      🚀 Generate Improved Version
    </button>

  </div>

  <!-- OUTPUT -->
  <div id="output"
    class="hidden mt-5 p-5 bg-gray-50 border border-gray-200 rounded-xl flex-1 overflow-y-auto custom-scroll">

    <div class="flex justify-between items-center mb-3 sticky top-0 bg-gray-50 z-10">
      <h3 class="font-semibold text-gray-800">📄 Result</h3>

     <button id="copyBtn"
    onclick="copyText()"
    class="text-sm bg-gray-100 px-3 py-1 rounded hover:bg-gray-200 transition flex items-center gap-1"
    title="Copy">
    
    <span id="copyIcon">📋</span>
    <span id="copyLabel">Copy</span>
</button>
    </div>

    <div id="resultText"
      class="text-gray-700 text-sm leading-relaxed"></div>
  </div>

  <?php include("includes/footer.php"); ?>
