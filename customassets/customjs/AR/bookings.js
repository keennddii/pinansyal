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
        credentials: 'include',
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
  document.getElementById("vehicle-body").innerHTML = `<tr><td colspan="6" class="text-center text-muted">Loading...</td></tr>`;
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
  document.getElementById("hotel-body").innerHTML = `<tr><td colspan="7" class="text-center text-muted">Loading...</td></tr>`;
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
            <td>${new Date(booking.created_at).toLocaleString()}</td>
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
  document.getElementById("tour-body").innerHTML = `<tr><td colspan="6" class="text-center text-muted">Loading...</td></tr>`;
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
