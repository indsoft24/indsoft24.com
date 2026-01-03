// Admin Panel JavaScript

$(document).ready(function () {
  // Sidebar toggle functionality
  $("#sidebarToggle").on("click", function () {
    $(".sidebar").toggleClass("show");
  });

  // Close sidebar when clicking outside on mobile
  $(document).on("click", function (e) {
    if ($(window).width() <= 768) {
      if (!$(e.target).closest(".sidebar, #sidebarToggle").length) {
        $(".sidebar").removeClass("show");
      }
    }
  });

  // Auto-hide alerts after 5 seconds - no animation
  setTimeout(function () {
    $(".alert").hide();
  }, 5000);

  // Confirm delete actions
  $(".btn-delete").on("click", function (e) {
    e.preventDefault();

    if (
      confirm(
        "Are you sure you want to delete this item? This action cannot be undone."
      )
    ) {
      $(this).closest("form").submit();
    }
  });

  // Form validation enhancement
  $("form").on("submit", function (e) {
    const submitBtn = $(this).find('button[type="submit"]');
    const originalText = submitBtn.html();

    submitBtn.prop("disabled", true);
    submitBtn.html('<i class="fas fa-spinner fa-spin"></i> Processing...');

    // Re-enable button after 10 seconds (in case of errors)
    setTimeout(function () {
      submitBtn.prop("disabled", false);
      submitBtn.html(originalText);
    }, 10000);

    // Don't prevent default form submission
    // Let the form submit normally
  });

  // Auto-save draft functionality (for post editor)
  if ($("#post-content").length) {
    let autoSaveTimer;

    $("#post-content").on("input", function () {
      clearTimeout(autoSaveTimer);
      autoSaveTimer = setTimeout(function () {
        // Auto-save logic would go here
      }, 30000); // Save every 30 seconds
    });
  }

  // Image preview functionality
  $('input[type="file"]').on("change", function () {
    const file = this.files[0];
    const preview = $(this).siblings(".image-preview");

    if (file && preview.length) {
      const reader = new FileReader();
      reader.onload = function (e) {
        preview.attr("src", e.target.result).show();
      };
      reader.readAsDataURL(file);
    }
  });

  // Tag input enhancement
  if ($(".tag-input").length) {
    $(".tag-input").on("keypress", function (e) {
      if (e.which === 13) {
        // Enter key
        e.preventDefault();
        const tag = $(this).val().trim();
        if (tag) {
          addTag(tag);
          $(this).val("");
        }
      }
    });
  }

  // Search functionality
  $("#searchInput").on("keyup", function () {
    const searchTerm = $(this).val().toLowerCase();
    $(".searchable-item").each(function () {
      const text = $(this).text().toLowerCase();
      if (text.includes(searchTerm)) {
        $(this).show();
      } else {
        $(this).hide();
      }
    });
  });

  // Sortable tables
  if ($(".sortable-table").length) {
    $(".sortable-table th[data-sort]").on("click", function () {
      const column = $(this).data("sort");
      const order = $(this).hasClass("asc") ? "desc" : "asc";

      // Remove existing sort classes
      $(".sortable-table th").removeClass("asc desc");

      // Add new sort class
      $(this).addClass(order);

      // Sort logic would go here
      // Sort logic would go here
    });
  }

  // Bulk actions
  $(".select-all").on("change", function () {
    const isChecked = $(this).is(":checked");
    $(".item-checkbox").prop("checked", isChecked);
    updateBulkActions();
  });

  $(".item-checkbox").on("change", function () {
    updateBulkActions();
  });

  function updateBulkActions() {
    const checkedItems = $(".item-checkbox:checked").length;
    const bulkActions = $(".bulk-actions");

    if (checkedItems > 0) {
      bulkActions.show();
      bulkActions.find(".selected-count").text(checkedItems);
    } else {
      bulkActions.hide();
    }
  }

  // Rich text editor initialization (if using a WYSIWYG editor)
  if (typeof tinymce !== "undefined") {
    tinymce.init({
      selector: ".rich-editor",
      height: 400,
      menubar: false,
      plugins: [
        "advlist autolink lists link image charmap print preview anchor",
        "searchreplace visualblocks code fullscreen",
        "insertdatetime media table paste code help wordcount",
      ],
      toolbar:
        "undo redo | formatselect | bold italic backcolor | \
                     alignleft aligncenter alignright alignjustify | \
                     bullist numlist outdent indent | removeformat | help",
      content_style:
        "body { font-family: -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif; font-size: 14px; }",
    });
  }

  // Statistics chart initialization (if using Chart.js)
  if (typeof Chart !== "undefined") {
    // Chart initialization code would go here
    // Chart initialization code would go here
  }

  // Real-time notifications (if using WebSockets or Server-Sent Events)
  if (typeof Echo !== "undefined") {
    // Real-time notification code would go here
    // Real-time notification code would go here
  }

  // Keyboard shortcuts
  $(document).on("keydown", function (e) {
    // Ctrl/Cmd + S to save
    if ((e.ctrlKey || e.metaKey) && e.which === 83) {
      e.preventDefault();
      $("form").submit();
    }

    // Ctrl/Cmd + N to create new post
    if ((e.ctrlKey || e.metaKey) && e.which === 78) {
      e.preventDefault();
      window.location.href = $('a[href*="create"]').first().attr("href");
    }
  });

  // Initialize tooltips
  if (typeof bootstrap !== "undefined") {
    var tooltipTriggerList = [].slice.call(
      document.querySelectorAll('[data-bs-toggle="tooltip"]')
    );
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
      return new bootstrap.Tooltip(tooltipTriggerEl);
    });
  }

  // Initialize popovers
  if (typeof bootstrap !== "undefined") {
    var popoverTriggerList = [].slice.call(
      document.querySelectorAll('[data-bs-toggle="popover"]')
    );
    var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
      return new bootstrap.Popover(popoverTriggerEl);
    });
  }

  // Instant scrolling for anchor links - no animation
  $('a[href^="#"]').on("click", function (e) {
    e.preventDefault();
    const target = $(this.getAttribute("href"));
    if (target.length) {
      $("html, body").scrollTop(target.offset().top - 100);
    }
  });

  // Add loading states to buttons
  $(".btn-loading").on("click", function () {
    const btn = $(this);
    const originalText = btn.html();

    btn.prop("disabled", true);
    btn.html('<i class="fas fa-spinner fa-spin"></i> Loading...');

    // Re-enable after 5 seconds
    setTimeout(function () {
      btn.prop("disabled", false);
      btn.html(originalText);
    }, 5000);
  });

  // Animations removed for performance

  // Admin panel JavaScript loaded successfully
});

// Utility functions
function addTag(tag) {
  const tagContainer = $(".tag-container");
  const tagElement = $(`
        <span class="badge bg-primary me-2 mb-2">
            ${tag}
            <button type="button" class="btn-close btn-close-white ms-2" onclick="removeTag(this)"></button>
        </span>
    `);
  tagContainer.append(tagElement);
}

function removeTag(button) {
  $(button).parent().remove();
}

function copyToClipboard(text) {
  navigator.clipboard.writeText(text).then(function () {
    // Show success message
    const toast = $(`
            <div class="toast align-items-center text-white bg-success border-0" role="alert">
                <div class="d-flex">
                    <div class="toast-body">
                        <i class="fas fa-check-circle"></i> Copied to clipboard!
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
                </div>
            </div>
        `);

    $("body").append(toast);
    const bsToast = new bootstrap.Toast(toast[0]);
    bsToast.show();

    // Remove toast after it's hidden
    toast.on("hidden.bs.toast", function () {
      $(this).remove();
    });
  });
}

// Export functions for global use
window.adminUtils = {
  addTag: addTag,
  removeTag: removeTag,
  copyToClipboard: copyToClipboard,
};
