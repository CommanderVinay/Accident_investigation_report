<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Incident Search & Report Management</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body { 
          font-family: "Nunito", sans-serif; 
        }

    .filter-label { 
          font-weight: bold; 
         }

    .table th, .table td {
           vertical-align: middle;
         }

    .modal-lg { 
            max-width: 90vw;
           }

  </style>
</head>
<body>
<div class="container mt-5">

    <div class="d-flex justify-content-between align-items-center mt-3">
      <a href="index.html"><button type="button" class="btn btn-primary px-4">Go to Home</button></a>
      <a href="CountermeasureForm.html"><button type="button" class="btn btn-primary px-4">Open Countermeasure Form</button></a>
    </div>
    <hr>
  <h2 class="mb-4 text-center" >Search Incident Reports</h2>
  <form id="searchForm" class="row g-2 align-items-end mb-4" action="" method="POST">
  <!-- Search Input -->
   <div class="col-md-12 text-center px-4">
    <div class="row">
      <div class="col-md-10">
        <input type="text" class="form-control" id="filterInputPerson" name="name" placeholder="Enter the employee name">
      </div>
      <div class="col-md-2">
            <button type="submit" class="btn btn-primary w-100">Search</button>
    </div>
    </div>
  </div>
</form>
  <div class="col-md-12">
    <div class="card mt-4">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Employee ID</th>
                    <th>Employee Name</th>
                    <th>Department</th>
                    <th>Nature of Accident</th>
                    <th>Accident Type</th>
                     <th>Date</th>
                    <!-- <th>Status</th> -->
                    <th>View Details</th>
                </tr>
            </thead>
            <tbody>
                <!-- Results will be injected here -->
                    <tr>
                       <?php
                            require_once 'logIn.php';

                            if (isset($_POST['name']) && $_POST['name'] !== '') {
                                // Search mode
                                $name = mysqli_real_escape_string($conn, $_POST['name']);
                                $query = "
                                    SELECT * FROM incident_reports
                                    WHERE name LIKE '%$name%' 
                                    OR empid LIKE '%$name%' 
                                    OR department LIKE '%$name%'
                                ";
                            } else {
                                // Show all records if no search term is provided
                                $query = "SELECT * FROM incident_reports";
                            }

                            $result = mysqli_query($conn, $query);

                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<tr>";
                                    echo "<td>" . $row['empid'] . "</td>";
                                    echo "<td>" . $row['name'] . "</td>";
                                    echo "<td>" . $row['department'] . "</td>";
                                    echo "<td>" . $row['incident'] . "</td>";
                                    echo "<td>" . $row['accidentType'] . "</td>";
                                    echo "<td>" . $row['date'] . "</td>";
                                    echo "<td> <button class='btn btn-primary btn-sm' onclick='viewDetails(" . $row['id'] . ")'>View</button></td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='7'>No records found</td></tr>";
                            }

                            mysqli_close($conn);
                            ?>

                    </tr>
            </tbody>
        </table>
    </div>
  </div>
</div>

<!-- Modal for viewing details -->
<div class="modal fade" id="viewModal" tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="viewModalLabel">Incident Details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      
      <div class="modal-body" id="modalBody">
        <!-- Details will be injected here -->
      </div>
      <div class="modal-footer">
        <button class="btn btn-success" id="downloadBtn">Download Report</button>
        <button class="btn btn-warning" id="editBtn">Edit Report</button>
        <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
// Show/hide filter input based on dropdown selection
function showMainFilterInput(type) {
  document.getElementById('filterInputDate').classList.add('d-none');
  document.getElementById('filterInputMonthYear').classList.add('d-none');
  document.getElementById('filterInputYear').classList.add('d-none');
  document.getElementById('filterInputPerson').classList.add('d-none');
  document.getElementById('filterInputIncident').classList.add('d-none');
  document.getElementById('filterInputLocation').classList.add('d-none');
  document.getElementById('filterInputAccidentType').classList.add('d-none');
  document.getElementById('filterInputStatus').classList.add('d-none');
  if (type === 'date') {
    document.getElementById('filterInputDate').classList.remove('d-none');
  } else if (type === 'month_year') {
    document.getElementById('filterInputMonthYear').classList.remove('d-none');
  } else if (type === 'year') {
    document.getElementById('filterInputYear').classList.remove('d-none');
  } else if (type === 'search_person') {
    document.getElementById('filterInputPerson').classList.remove('d-none');
  } else if (type === 'incident') {
    document.getElementById('filterInputIncident').classList.remove('d-none');
  } else if (type === 'incident_location') {
    document.getElementById('filterInputLocation').classList.remove('d-none');
  } else if (type === 'accidentType') {
    document.getElementById('filterInputAccidentType').classList.remove('d-none');
  } else if (type === 'status') {
    document.getElementById('filterInputStatus').classList.remove('d-none');
  }
}
document.getElementById('mainFilterType').addEventListener('change', function() {
  showMainFilterInput(this.value);
});
// Initialize default to 'search_person'
showMainFilterInput('search_person');
</script>


<script>
function renderResults(data) {
  const tbody = document.querySelector('#resultsTable tbody');
  tbody.innerHTML = "";
  if (data.length === 0) {
    tbody.innerHTML = '<tr><td colspan="8" class="text-center">No results found.</td></tr>';
    return;
  }
  data.forEach(row => {
    tbody.innerHTML += `
      <tr>
        <td>${row.date}</td>
        <td>${row.name}</td>
        <td>${row.empid}</td>
        <td>${row.department}</td>
        <td>${row.incident}</td>
        <td>${row.accidentType}</td>
        <td>${row.status}</td>
        <td>
          <button class="btn btn-info btn-sm" onclick="viewDetails(${row.id})">View</button>
        </td>
      </tr>
    `;
  });
}





// View details modal
function viewDetails(id) {
   fetch('getDetails.php', {
    method: 'POST',
    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
    body: 'id=' + id
})
    .then(response => response.json())
    .then(details => {
        if (details.error) {
            alert(details.error);
            return;
        }

            let html = `<table class='table table-bordered'>
                <tr><th>Date</th><td>${details.date}</td></tr>
                <tr><th>Name</th><td>${details.name}</td></tr>
                <tr><th>Employee ID</th><td>${details.empid}</td></tr>
                <tr><th>Department</th><td>${details.department}</td></tr>
                <tr><th>Nature of Accident</th><td>${details.incident}</td></tr>
                <tr><th>Accident Type</th><td>${details.accidentType}</td></tr>
                <tr><th>Status</th><td>${details.status}</td></tr>
                <tr><th>Incident Location</th><td>${details.incident_location}</td></tr>
                <tr><th>Machine</th><td>${details.machine}</td></tr>
                <tr><th>Manager</th><td>${details.manager}</td></tr>
                <tr><th>Shift</th><td>${details.shift}</td></tr>
                <tr><th>5 Why Problem</th><td>${details.why_problem}</td></tr>
                <tr><th>Why 1</th><td>${details.whyReason1}</td></tr>
                <tr><th>Why 2</th><td>${details.whyReason2}</td></tr>
                <tr><th>Why 3</th><td>${details.whyReason3}</td></tr>
                <tr><th>Why 4</th><td>${details.whyReason4}</td></tr>
                <tr><th>Why 5</th><td>${details.whyReason5}</td></tr>
            </table>`;

            document.getElementById('modalBody').innerHTML = html;
            new bootstrap.Modal(document.getElementById('viewModal')).show();
        })
        .catch(err => console.error(err));
}


// Download report
document.getElementById('downloadBtn').onclick = function () {
  // Get only the table from modalBody to avoid copying buttons
  const tableContent = document.querySelector('#modalBody table').outerHTML;

  // Open new window
  const printWindow = window.open('', '', 'width=900,height=700');

  // Write the printable content
  printWindow.document.write('<html><head><title>Incident Report</title><style>body{font-family:Arial,sans-serif;padding:20px;}table{width:100%;border-collapse:collapse;}th,td{border:1px solid #000;padding:8px;text-align:left;}h2{text-align:center;margin-bottom:20px;}</style></head><body><h2>Incident Report</h2>' + tableContent + '<script>window.onload=function(){window.print();window.onafterprint=function(){window.close();};};<\/script></body></html>');
  printWindow.document.close();
};



// Edit report (redirect to edit page)
 document.getElementById('editBtn').onclick = function() {
  alert('Edit functionality to be implemented.');
  // window.location.href = 'edit.html?id=' + ...;
};
</script>
</body>
</html>
