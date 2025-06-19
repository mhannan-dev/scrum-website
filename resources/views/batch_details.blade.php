<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Global Expert | Batch Batches</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f8f9fa;
      font-family: 'Segoe UI', sans-serif;
    }
    .batch-card {
      transition: transform 0.2s ease-in-out;
    }
    .batch-card:hover {
      transform: translateY(-5px);
    }
    .card-title {
      font-size: 1.25rem;
      font-weight: 600;
    }
    .card-subtitle {
      font-size: 1rem;
      color: #6c757d;
    }
    .enroll-btn {
      background-color: #0d6efd;
      color: #fff;
      font-weight: 500;
    }
    .enroll-btn:hover {
      background-color: #084298;
    }
  </style>
</head>
<body>

  <div class="container py-5">
    <div class="text-center mb-5">
      <h1 class="fw-bold">Available Course Batches</h1>
      <p class="text-muted">Choose the batch that fits your schedule and start learning today.</p>
    </div>

    <div class="row g-4">

      <!-- Batch Card 1 -->
      <div class="col-md-6 col-lg-4">
        <div class="card batch-card shadow-sm h-100">
          <div class="card-body">
            <h5 class="card-title">Full Stack Web Development</h5>
            <h6 class="card-subtitle mb-2">Instructor: Jane Doe</h6>
            <p class="card-text">
              Start Date: <strong>July 1, 2025</strong><br>
              Timing: <strong>Mon-Fri, 6PM - 8PM</strong><br>
              Duration: <strong>12 Weeks</strong>
            </p>
            <a href="#" class="btn enroll-btn w-100">Enroll Now</a>
          </div>
        </div>
      </div>

      <!-- Batch Card 2 -->
      <div class="col-md-6 col-lg-4">
        <div class="card batch-card shadow-sm h-100">
          <div class="card-body">
            <h5 class="card-title">Data Science with Python</h5>
            <h6 class="card-subtitle mb-2">Instructor: John Smith</h6>
            <p class="card-text">
              Start Date: <strong>July 15, 2025</strong><br>
              Timing: <strong>Sat-Sun, 10AM - 2PM</strong><br>
              Duration: <strong>10 Weeks</strong>
            </p>
            <a href="#" class="btn enroll-btn w-100">Enroll Now</a>
          </div>
        </div>
      </div>

      <!-- Batch Card 3 -->
      <div class="col-md-6 col-lg-4">
        <div class="card batch-card shadow-sm h-100">
          <div class="card-body">
            <h5 class="card-title">UI/UX Design Fundamentals</h5>
            <h6 class="card-subtitle mb-2">Instructor: Emily Zhang</h6>
            <p class="card-text">
              Start Date: <strong>August 1, 2025</strong><br>
              Timing: <strong>Tue-Thu, 7PM - 9PM</strong><br>
              Duration: <strong>8 Weeks</strong>
            </p>
            <a href="#" class="btn enroll-btn w-100">Enroll Now</a>
          </div>
        </div>
      </div>

    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
