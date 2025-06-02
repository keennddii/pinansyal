<?php
session_start();
$_SESSION['username'] = 'admin'; // ← test lang, wag sa live

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>All Booking Requests</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <style>
    body {
      background-color: #f8f9fa;
    }
    .card {
      border: none;
      border-radius: 1rem;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }
    .table thead {
      background-color: #343a40;
      color: white;
    }
  </style>
</head>
<body>
<div class="container py-5">
  <h2 class="mb-4">Booking Requests</h2>
  <ul class="nav nav-tabs" id="bookingTabs" role="tablist">
    <li class="nav-item" role="presentation">
      <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#vehicle-tab" type="button" role="tab">Vehicle</button>
    </li>
    <li class="nav-item" role="presentation">
      <button class="nav-link" data-bs-toggle="tab" data-bs-target="#hotel-tab" type="button" role="tab">Hotel</button>
    </li>
    <li class="nav-item" role="presentation">
      <button class="nav-link" data-bs-toggle="tab" data-bs-target="#tour-tab" type="button" role="tab">Tour</button>
    </li>
  </ul>

  <div class="tab-content mt-4">
    <!-- Vehicle Bookings -->
    <div class="tab-pane fade show active" id="vehicle-tab" role="tabpanel">
      <div class="card shadow-sm">
        <div class="card-body">
          <button onclick="loadVehicleBookings()" class="btn btn-outline-primary mb-3">Refresh Vehicle Bookings</button>
          <div class="table-responsive">
            <table class="table table-bordered table-hover">
              <thead class="table-dark">
                <tr>
                  <th>#</th>
                  <th>Full Name</th>
                  <th>Total Price</th>
                  <th>Created At</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody id="vehicle-body">
                <tr><td colspan="6" class="text-center">Loading...</td></tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

<!-- Hotel Bookings -->
<div class="tab-pane fade" id="hotel-tab" role="tabpanel">
  <div class="card shadow-sm">
    <div class="card-body">
      <button onclick="loadHotelBookings()" class="btn btn-outline-primary mb-3">Refresh Hotel Bookings</button>
      <div class="table-responsive">
        <table class="table table-bordered table-hover">
          <thead class="table-dark">
            <tr>
              <th>#</th>
              <th>Full Name</th>
              <th>Total Price</th>
              <th>Created At</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody id="hotel-body">
            <tr><td colspan="7" class="text-center">Loading...</td></tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>


 <!-- Tour Bookings -->
<div class="tab-pane fade" id="tour-tab" role="tabpanel">
  <div class="card shadow-sm">
    <div class="card-body">
      <button onclick="loadTourBookings()" class="btn btn-outline-primary mb-3">Refresh Tour Bookings</button>
      <div class="table-responsive">
        <table class="table table-bordered table-hover">
          <thead class="table-dark">
            <tr>
              <th>#</th>
              <th>Full Name</th> 
              <th>Booking Date</th> 
              <th>Total Price</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody id="tour-body">
            <tr><td colspan="6" class="text-center">Loading...</td></tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>


<script>
function markAsDone(bookingId, bookingType) {
  Swal.fire({
    title: "Are you sure?",
    text: "Do you want to mark this booking as done?",
    icon: "question",
    showCancelButton: true,
    confirmButtonText: "Yes, mark as done!",
    cancelButtonText: "Cancel"
  }).then((result) => {
    if (result.isConfirmed) {
      fetch("api/encode-booking.php", {
        method: "POST",
        headers: {
          "Content-Type": "application/x-www-form-urlencoded"
        },
        body: `booking_id=${bookingId}&booking_type=${bookingType}`
      })
      .then(response => response.text()) // ← change to text to catch HTML errors
      .then(text => {
        try {
          const data = JSON.parse(text);
          if (data.status === "success") {
            Swal.fire("Success", data.message, "success").then(() => {
              location.reload();
            });
          } else if (data.status === "exists") {
            Swal.fire("Info", data.message, "info");
          } else {
            Swal.fire("Error", data.message, "error");
          }
        } catch (e) {
          console.error("JSON parse error:", e);
          console.log("Raw response:", text); // ← ito output ng error like <br><b>PHP Warning...
          Swal.fire("Error", "Invalid response from server.", "error");
        }
      })
      .catch(error => {
        console.error("Fetch error:", error);
        Swal.fire("Error", "Something went wrong.", "error");
      });
    }
  });
}


async function loadVehicleBookings() {
  try {
    const res = await fetch("api/vehicle-bookings.php");  
    const json = await res.json();
    let rows = "";

    if (json.status === "success") {
      json.data.forEach((booking, i) => {
        rows += `
          <tr>
            <td>${i + 1}</td>
            <td>${booking.full_name}</td>
            <td>₱${Number(booking.total_price).toLocaleString()}</td>
            <td>${new Date(booking.created_at).toLocaleString()}</td>
            <td>
              ${booking.encoded
                ? '<span class="badge bg-success">Encoded</span>'
                : `<button class="btn btn-primary btn-sm" onclick="markAsDone(${booking.id}, 'vehicle')">Mark as Done</button>`
              }
            </td>
          </tr>`;
      });
    } else {
      rows = `<tr><td colspan="6" class="text-center">No bookings found.</td></tr>`;
    }

    document.getElementById("vehicle-body").innerHTML = rows;
  } catch (err) {
    document.getElementById("vehicle-body").innerHTML = `<tr><td colspan="6" class="text-danger text-center">Error loading data</td></tr>`;
  }
}

async function loadHotelBookings() {
  try {
    const res = await fetch("api/hotel-bookings.php");
    const json = await res.json();
    let rows = "";

    if (json.status === "success") {
      json.data.forEach((booking, i) => {
        rows += `
          <tr>
            <td>${i + 1}</td>
            <td>${booking.full_name}</td>
            <td>₱${Number(booking.total_price).toLocaleString()}</td>
            <td>${(booking.created_at).toLocaleString()}</td>
<td>
      ${booking.encoded
        ? '<span class="badge bg-success">Encoded</span>'
        : `<button class="btn btn-primary btn-sm" onclick="markAsDone(${booking.id}, 'hotel')">Mark as Done</button>`
      }
    </td>
          </tr>`;
      });
    } else {
      rows = `<tr><td colspan="7" class="text-center">No bookings found.</td></tr>`;
    }

    document.getElementById("hotel-body").innerHTML = rows;
  } catch (err) {
    document.getElementById("hotel-body").innerHTML = `<tr><td colspan="7" class="text-danger text-center">Error loading data</td></tr>`;
  }
}

async function loadTourBookings() {
  try {
    const res = await fetch("api/tour-bookings.php");
    const json = await res.json();
    let rows = "";

    if (json.status === "success") {
      json.data.forEach((booking, i) => {
        rows += `
          <tr>
            <td>${i + 1}</td>
            <td>${booking.full_name}</td>
            <td>${new Date(booking.created_at).toLocaleString()}</td>
            <td>₱${Number(booking.total_price).toLocaleString()}</td>
<td>
      ${booking.encoded
        ? '<span class="badge bg-success">Encoded</span>'
        : `<button class="btn btn-primary btn-sm" onclick="markAsDone(${booking.id}, 'tour')">Mark as Done</button>`
      }
    </td>
          </tr>`;
      });
    } else {
      rows = `<tr><td colspan="6" class="text-center">No bookings found.</td></tr>`;
    }

    document.getElementById("tour-body").innerHTML = rows;
  } catch (err) {
    document.getElementById("tour-body").innerHTML = `<tr><td colspan="6" class="text-danger text-center">Error loading data</td></tr>`;
  }
}


// Load initial tab content
window.onload = function () {
  loadVehicleBookings();
  loadHotelBookings();
  loadTourBookings();
};

</script>
<!-- for view -->
<script>
  function viewBooking(id, type) {
  fetch(`api/get-booking-info.php?id=${id}&type=${type}`)
    .then(res => res.json())
    .then(data => {
      if (data.status === 'success') {
        const info = data.booking;
        let html = `<div class="table-responsive"><table class="table table-bordered">`;

        for (const key in info) {
          html += `
            <tr>
              <th class="bg-light text-capitalize">${key.replaceAll('_', ' ')}</th>
              <td>${info[key]}</td>
            </tr>`;
        }

        html += `</table></div>`;
        document.getElementById('bookingInfoContent').innerHTML = html;
        const modal = new bootstrap.Modal(document.getElementById('bookingInfoModal'));
        modal.show();
      } else {
        Swal.fire("Error", "Booking not found.", "error");
      }
    })
    .catch(err => {
      console.error(err);
      Swal.fire("Error", "Failed to fetch booking info.", "error");
    });
}

</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
