document.addEventListener('DOMContentLoaded', function() {
  fetch('positions.json')
    .then(r => r.json())
    .then(jobs => {
      const list = document.getElementById('positions-container');
      if (list) {
        list.innerHTML = jobs.map(j => `
          <div class="col-md-4 col-sm-6">
            <div class="single-how-works">
              <div class="single-how-works-icon">
                <i class="fa-solid ${j.icon} fa-2x"></i>
              </div>
              <h2><a href="pozice_detail.html?id=${j.id}">${j.title}</a></h2><br>
              <button class="welcome-hero-btn how-work-btn" onclick="window.location.href='formular.html'">Mám zájem</button>
            </div>
          </div>`).join('');
      }
      const detail = document.getElementById('position-detail');
      if (detail) {
        const params = new URLSearchParams(window.location.search);
        const id = parseInt(params.get('id') || '0', 10);
        const job = jobs.find(j => j.id === id);
        if (!job) {
          window.location.href = 'pozice.html';
          return;
        }
        document.title = job.title;
        detail.innerHTML = `<h1>${job.title}</h1><p>${job.description.replace(/\n/g,'<br>')}</p><p><a href="formular.html" class="welcome-hero-btn">Mám zájem</a></p>`;
      }
    });
});
