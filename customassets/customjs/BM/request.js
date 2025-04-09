
  // When the allocation modal is about to be shown,
  // retrieve the request_id from the button's data attribute and set it to the hidden input.
  var allocationModal = document.getElementById('allocationModal');
  allocationModal.addEventListener('show.bs.modal', function (event) {
    var button = event.relatedTarget; // Button that triggered the modal
    var requestId = button.getAttribute('data-request-id'); // Get request_id from data attribute
    // Set this request_id in the hidden input field
    allocationModal.querySelector('#allocationRequestId').value = requestId;
  });

