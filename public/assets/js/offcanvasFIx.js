
    // Fallback to ensure offcanvas can be closed programmatically
    document.addEventListener('DOMContentLoaded', function () {
      try {
        var off = document.getElementById('sidebarMenu');
        if (!off) return;
        // Create/get bootstrap Offcanvas instance
        var oc = window.bootstrap && window.bootstrap.Offcanvas && window.bootstrap.Offcanvas.getOrCreateInstance
          ? window.bootstrap.Offcanvas.getOrCreateInstance(off)
          : null;

        // If data-api failed for some reason, wire close button to hide()
        var closeBtn = off.querySelector('[data-bs-dismiss="offcanvas"]');
        if (closeBtn && oc) {
          closeBtn.addEventListener('click', function (e) {
            e.preventDefault();
            oc.hide();
          });
        }

        // Also close when clicking backdrop manually (defensive)
        document.addEventListener('click', function (e) {
          var backdrop = document.querySelector('.offcanvas-backdrop');
          if (!backdrop) return;
          if (e.target === backdrop && oc) oc.hide();
        });
      } catch (err) {
        console.error('Offcanvas fallback error:', err);
      }
    });