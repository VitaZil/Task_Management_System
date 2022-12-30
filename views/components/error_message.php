<?php if (isset($_GET['message'])): ?>
    <div x-data="{show: true}" x-init="setTimeout(() => show = false, 3000)" x-show="show"
        class="fixed top-6 left-1/2 transform -translate-x-1/2 px-48 py-3 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-green-200 dark:text-green-800"" role="alert">
  <span class="absolute inset-y-0 left-0 flex items-center ml-4">
    <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20"><path
            d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
            clip-rule="evenodd" fill-rule="evenodd"></path></svg>
  </span>
        <p class="ml-6"><?= $_GET['message'] ?></p>
    </div>
<?php endif; ?>