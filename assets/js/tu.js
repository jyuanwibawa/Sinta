    // AUTO REFRESH MONITORING
    setInterval(() => {
      const container = document.getElementById("laporan-ob-container");
      if (!container) return;

      fetch("DashboardTu/get_laporan_ajax")
        .then(response => response.text())
        .then(html => {
          container.innerHTML = html;
        })
        .catch(err => console.error("Gagal refresh laporan:", err));
    }, 5000);

    // AUTO REFRESH VERIFIKASI
    setInterval(() => {
      const verifContainer = document.querySelector(".verif-list");
      if (!verifContainer) return;

      fetch("DashboardTu/get_verifikasi_ajax")
        .then(response => response.text())
        .then(html => {
          verifContainer.innerHTML = html;
        })
        .catch(err => console.error("Gagal refresh verifikasi:", err));
    }, 5000);

    // DOM READY
    document.addEventListener("DOMContentLoaded", () => {

  
      // SIDEBAR NAVIGATION
      const items = document.querySelectorAll(".menu-item");
      const sections = document.querySelectorAll("[data-page-section]");

      function showPage(page) {
        sections.forEach(sec => {
          sec.style.display = (sec.dataset.pageSection === page) ? "block" : "none";
        });
      }

      items.forEach(item => {
        item.addEventListener("click", () => {
          items.forEach(i => i.classList.remove("active"));
          item.classList.add("active");

          const page = item.getAttribute("data-page");
          showPage(page);
        });
      });

      // Default halaman
      showPage("dashboard");


      // MODAL EVALUASI
      const modalBackdrop = document.getElementById("modal-evaluasi");
      const modalIdInput  = document.getElementById("modal-id");
      const modalNama     = document.getElementById("modal-nama");
      const modalLokasi   = document.getElementById("modal-lokasi");

      document.addEventListener("click", (e) => {

        if (e.target.classList.contains("open-modal")) {

          const id     = e.target.dataset.id;
          const nama   = e.target.dataset.nama;
          const lokasi = e.target.dataset.lokasi;

          if (modalIdInput) modalIdInput.value = id;
          if (modalNama) modalNama.innerText = "OB: " + nama;
          if (modalLokasi) modalLokasi.innerText = "Area: " + lokasi;

          if (modalBackdrop) {
            modalBackdrop.style.display = "flex";
          }
        }

        if (e.target.id === "close-modal" || e.target.hasAttribute("data-close-modal")) {
          if (modalBackdrop) {
            modalBackdrop.style.display = "none";
          }
        }

      });

      // sumbit evaluasi menggunakan ajax
      document.addEventListener("submit", function (e) {

        if (e.target && e.target.id === "form-evaluasi") {
          e.preventDefault(); 

          const form = e.target;
          const formData = new FormData(form);

          const activeButton = document.activeElement;
          if (activeButton && activeButton.name === "status_verifikasi") {
            formData.set("status_verifikasi", activeButton.value);
          }

          fetch(form.action, {
            method: "POST",
            body: formData,
            headers: {
              "X-Requested-With": "XMLHttpRequest" 
            }
          })
          .then(res => res.json())
          .then(data => {
            if (data.status === "success") {

              if (modalBackdrop) modalBackdrop.style.display = "none";

              // Refresh daftar verifikasi agar warna & status berubah
              const verifContainer = document.querySelector(".verif-list");
              if (verifContainer) {
                fetch("DashboardTu/get_verifikasi_ajax")
                  .then(res => res.text())
                  .then(html => {
                    verifContainer.innerHTML = html;
                  });
              }

            } else {
              alert("Gagal menyimpan evaluasi.");
            }
          })
          .catch(err => {
            console.error("Gagal simpan evaluasi:", err);
            alert("Terjadi kesalahan saat menyimpan evaluasi.");
          });
        }

      });

    });

